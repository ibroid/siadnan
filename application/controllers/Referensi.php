<?php

require_once APPPATH . "traits/SatkerApi.php";
require_once APPPATH . "traits/PegawaiApi.php";
require_once APPPATH . "traits/JenisPengajuanApi.php";
require_once APPPATH . "traits/PersyaratanApi.php";

class Referensi extends R_Controller
{
    use SatkerApi;
    use PegawaiApi;
    use JenisPengajuanApi;
    use PersyaratanApi;

    public function __construct()
    {
        parent::__construct();
        $this->addons->init([
            'js' => [
                '<script src="' . base_url("/assets/js/form-validation-custom.js") . '"></script>',
            ]
        ]);
    }

    public function index()
    {
        $this->load->page('referensi/referensi', [
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

        $this->load->page('referensi/referensi_pegawai', [
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
            $this->load->page('referensi/referensi_add_pegawai', [
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
                $this->load->page('referensi/referensi_edit_pegawai', [
                    'page_name' => 'Referensi Data',
                    'breadcumb' => 'Referensi / ' . $satker->nama_satker . ' / Pegawai / Tambah',
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

    public function pengajuan()
    {
        $this->load->page('referensi/referensi_pengajuan', [
            'page_name' => 'Referensi Data',
            'breadcumb' => 'Referensi / Pengajuan',
            'pengajuan' => $this->getJenisPengajuan()
        ])->layout('dashboard_layout');
    }

    public function add_pengajuan()
    {
        if (R_Input::isPost()) {
            try {

                $data = [
                    "nama_pengajuan" => R_Input::pos("namaPengajuan"),
                    "deskripsi" => R_Input::pos("deskripsi"),
                    "persyaratan_text" => R_Input::pos("persyaratan")
                ];

                $this->addJenisPengajuan($data);

                Redirect::wfa([
                    'type' => 'success',
                    'mesg' => 'Berhasil Menambahkan Jenis Pengajuan',
                    'text' => ''
                ])->go('/referensi/pengajuan');
            } catch (\Throwable $th) {
                Redirect::wfe($th->getMessage())->go("/referensi/pengajuan");
            }
        } else {
            $this->load->page('referensi/referensi_add_pengajuan', [
                'page_name' => 'Referensi Data',
                'breadcumb' => 'Referensi / Pengajuan / Tambah',
            ])->layout('dashboard_layout');
        }
    }

    public function edit_pengajuan($id = null)
    {
        if ($id == null) {
            set_status_header(404);
            exit();
        }

        if (R_Input::isPost()) {

            try {

                $data = [
                    "nama_pengajuan" => R_Input::pos("namaPengajuan"),
                    "deskripsi" => R_Input::pos("deskripsi"),
                    "persyaratan_text" => R_Input::pos("persyaratan")
                ];

                $this->updateJenisPengajuan($id, $data);

                Redirect::wfa([
                    'type' => 'success',
                    'mesg' => 'Berhasil Menambahkan Jenis Pengajuan',
                    'text' => ''
                ])->go("/referensi/pengajuan");
            } catch (\Throwable $th) {

                Redirect::wfe($th->getMessage());
            }
        } else {

            $pengajuan = $this->getJenisPengajuan($id);
            if (!$pengajuan) {
                set_status_header(404);
                exit();
            }

            $this->load->page('referensi/referensi_edit_pengajuan', [
                'page_name' => 'Referensi Data',
                'breadcumb' => 'Referensi / Pengajuan / Edit',
                'pengajuan' => $pengajuan
            ])->layout('dashboard_layout');
        }
    }

    public function hapus_pengajuan($id = null)
    {
        if ($id == null) {
            set_status_header(404);
            exit();
        }

        R_Input::mustPost();
        try {
            $this->deleteJenisPengajuan($id);

            echo json_encode(["message" => "Sukses"]);
        } catch (\Throwable $th) {

            set_status_header(400, $th->getMessage());
            echo json_encode(["message" => $th->getMessage()]);
        }
    }

    public function req_pengajuan($id = null)
    {
        if ($id == null) {
            set_status_header(404);
            exit();
        }

        $pengajuan = $this->getJenisPengajuan($id);

        if (!$pengajuan) {
            set_status_header(404);
            exit();
        }

        $this->load->page('referensi/referensi_reqs_pengajuan', [
            'page_name' => 'Referensi Data',
            'breadcumb' => 'Referensi / Pengajuan / Persyaratan',
            'pengajuan' => $pengajuan
        ])->layout('dashboard_layout');
    }

    function pengajuan_add_persyaratan($id = null)
    {
        if ($id == null) {
            set_status_header(404);
            exit();
        }

        R_Input::mustPost();
        try {
            $data = [
                "persyaratan" => R_Input::pos("persyaratan"),
                "detail" => R_Input::pos("detail"),
                "max_size" => R_Input::pos("max_size"),
                "pengajuan_id" => $id
            ];

            $this->addPersyaratan($data);

            Redirect::wfa([
                'type' => 'success',
                'mesg' => 'Berhasil Menambahkan Jenis Pengajuan',
                'text' => ''
            ])->go($_SERVER['HTTP_REFERER']);
        } catch (\Throwable $th) {

            Redirect::wfe($th->getMessage())->go($_SERVER['HTTP_REFERER']);
        }
    }

    public function hapus_persyaratan($id = null)
    {
        if ($id == null) {
            set_status_header(404);
            exit();
        }

        R_Input::mustPost();
        try {
            $this->deletePersyaratan($id);

            echo json_encode(['text' => "Success"]);
        } catch (\Throwable $th) {
            echo json_encode(['text' => $th->getMessage()]);
        }
    }

    public function pengajuan_update_persyaratan($id = null)
    {
        if ($id == null) {
            set_status_header(404);
            exit();
        }

        R_Input::mustPost();

        try {
            $data = [
                "persyaratan" => R_Input::pos("persyaratan"),
                "detail" => R_Input::pos("detail"),
                "max_size" => R_Input::pos("max_size"),
                // "pengajuan_id" => $id
            ];

            $this->updatePersyaratan($id, $data);

            Redirect::wfa([
                'type' => 'success',
                'mesg' => 'Berhasil Mengubah Persyaratan',
                'text' => ''
            ])->go($_SERVER['HTTP_REFERER']);

        } catch (\Throwable $th) {

            Redirect::wfe($th->getMessage())->go($_SERVER['HTTP_REFERER']);
        }

    }
}
