<?php

require_once APPPATH . "traits/SatkerApi.php";
require_once APPPATH . "traits/PegawaiApi.php";

class Referensi extends R_Controller
{
    use SatkerApi;
    use PegawaiApi;


    public function __construct()
    {
        parent::__construct();
        $this->addons->init([
            'js' => [
                '<script src="../assets/js/form-validation-custom.js"></script>',
            ]
        ]);
    }


    public function index()
    {
        $this->load->page('user/referensi', [
            'page_name' => 'Referensi Data',
            'breadcumb' => 'Referensi',
            'satkers' => $this->get_satker(),
        ])->layout('dashboard_layout');
    }

    public function pegawai()
    {
        $satker = $this->satker_by_kode(R_Input::gett("satker"));

        if (!$satker) {
            return Redirect::wfe('Satker tidak ditemukan')->go('/settings');
        }

        $this->load->page('user/referensi_pegawai', [
            'page_name' => 'Referensi Data',
            'breadcumb' => 'Referensi / ' . $satker->nama_satker . ' / Pegawai',
        ])->layout('dashboard_layout');
    }

    public function pegawai_datatable()
    {
        R_Input::mustPost();
        try {
            $this->datatable_pegawai();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function add_pegawai()
    {
        $satker = $this->satker_by_kode(R_Input::gett("satker"));
        if (!$satker) {
            return Redirect::wfe('Satker tidak ditemukan')->go('/settings');
        }

        if (R_Input::isPost()) {
            try {
                $satker = $this->satker_by_kode(R_Input::gett('satker'));

                $data = [
                    'nama_lengkap' => R_Input::pos('namaLengkap'),
                    'nip' => R_Input::pos('nip'),
                    'pangkat' => R_Input::pos('pangkat'),
                    'jabatan' => R_Input::pos('jabatan'),
                    'picture' => 'nopic',
                    'satker_id' => $satker->id
                ];

                if (isset($_FILES['pas_foto']) && $_FILES['pas_foto']['size'] > 0) {
                    $data['picture'] = $this->upload_pass_foto('pas_foto');
                }

                $this->insert_pegawai($data);

                Redirect::wfa([
                    'type' => 'success',
                    'mesg' => 'Berhasil Menambahkan Pegawai',
                    'text' => ''
                ])->go('/referensi/pegawai?satker=' . R_Input::gett('satker'));
            } catch (\Throwable $th) {
                return Redirect::wfe($th->getMessage())->go('/referensi/add_pegawai?satker=' . R_Input::gett('satker'));
            }
        } else {
            $this->load->page('user/referensi_add_pegawai', [
                'page_name' => 'Referensi Data',
                'breadcumb' => 'Referensi / ' . $satker->nama_satker . ' / Pegawai / Tambah',
            ])->layout('dashboard_layout');
        }
    }
}
