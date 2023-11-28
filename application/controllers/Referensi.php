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
            return Redirect::wfe('Satker tidak ditemukan')->go('/dashboard');
        }

        $this->load->page('user/referensi_pegawai', [
            'page_name' => 'Referensi Data',
            'breadcumb' => 'Referensi / ' . $satker->nama_satker . ' / Pegawai',
            'satker' => $satker
        ])->layout('dashboard_layout');
    }

    public function pegawai_datatable_api($idSatker = null)
    {
        if ($idSatker == null) {
            set_status_header(404);
            exit();
        }

        R_Input::mustPost();
        try {
            $this->datatable_pegawai($idSatker);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function add_pegawai()
    {
        $satker = $this->satker_by_kode(R_Input::gett("satker"));
        if (!$satker) {
            return Redirect::wfe('Satker tidak ditemukan')->go('/dashboard');
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

    public function pass_foto($id = null)
    {
        try {
            $passFoto = $this->passFoto($id);
            echo $passFoto;
        } catch (\Throwable $th) {
            if ($th->getCode() == 400) {
                set_status_header($th->getCode(), $th->getMessage());
            } else {
                throw $th;
            }
        }
    }

    public function pegawai_edit($id = null, $satker_id = null)
    {
        try {
            $pegawai = $this->getPegawai($id);
            $satker = $this->get_satker($satker_id);

            if (R_Input::isPost()) {

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

                $this->updatePegawai($id, $data);

                Redirect::wfa([
                    'type' => 'success',
                    'mesg' => 'Berhasil Menambahkan Pegawai',
                    'text' => ''
                ])->go('/referensi/pegawai?satker=' . $satker->kode_satker);
                // prindie($_FILES);
            } else {
                $this->load->page('user/referensi_edit_pegawai', [
                    'page_name' => 'Referensi Data',
                    'breadcumb' => 'Referensi /  / Pegawai / Tambah',
                    'pegawai' => $pegawai,
                    'satker' => $satker
                ])->layout('dashboard_layout');
            }
        } catch (\Throwable $th) {

            return Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
        }
    }

    public function hapus_pegawai($id = null)
    {
        R_Input::mustPost();
        try {
            $this->deleteUser($id);
            echo json_encode(['text' => "Success"]);
        } catch (\Throwable $th) {
            echo json_encode(['text' => $th->getMessage()]);
        }
    }
}
