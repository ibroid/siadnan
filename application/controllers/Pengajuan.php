<?php

require_once APPPATH . "/traits/JenisPengajuanApi.php";
require_once APPPATH . "/traits/PengajuanApi.php";
require_once APPPATH . "/traits/PersyaratanPengajuanApi.php";
require_once APPPATH . "/traits/SatkerApi.php";
require_once APPPATH . "/traits/PegawaiApi.php";

class Pengajuan extends R_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    use JenisPengajuanApi;
    use PengajuanApi;
    use SatkerApi;
    use PegawaiApi;

    public function index()
    {
        $this->load->page('pengajuan/pengajuan', [
            'page_name' => 'Pengajuan baru',
            'breadcumb' => 'Pengajuan',
            'pengajuan' => $this->getJenisPengajuan()->where("status", 1),
        ])->layout('dashboard_layout');
    }

    function pegawai($id = null)
    {
        if ($id == null) {
            set_status_header(404);
            exit();
        }

        $this->addons->init([
            'js' => [
                '<script src="' . base_url() . '/assets/js/form-validation-custom.js"></script>',
                '<script src="' . base_url() . '/assets/js/typeahead/handlebars.js"></script>',
                '<script src="' . base_url() . '/assets/js/typeahead/typeahead.bundle.js"></script>',
                '<script src="' . base_url() . '/assets/js/flat-pickr/flatpickr.js"></script>',
                '<script>flatpickr(".datetime-local", {});</script>'
            ],
            'css' => [
                '<link rel="stylesheet" type="text/css" href="' . base_url() . '/assets/css/vendors/flatpickr/flatpickr.min.css">'
            ]
        ]);

        $this->load->page('pengajuan/pengajuan_pegawai', [
            'page_name' => 'Pengajuan baru',
            'breadcumb' => 'Pengajuan / Pegawai',
            'jenis_pengajuan' => $this->getJenisPengajuan($id),
            'pengajuan' => $this->getPengajuanByJenisId($id),
            'satker' => $this->get_satker($this->pegawai->satker_id),
        ])->layout('dashboard_layout');
    }

    function detail_pegawai($id = null)
    {
        if ($id == null) {
            set_status_header(404);
            exit();
        }

        $pegawai = $this->getPegawai($id);

        echo $this->load->component("pengajuan/detail_pegawai", compact("pegawai"));
    }

    public function save_pegawai()
    {
        R_Input::mustPost();
        try {
            $this->savePengajuan([
                'pegawai_id' => R_Input::pos('id'),
                'tanggal_pengajuan' => R_Input::pos('tanggal_pengajuan'),
                'jenis_pengajuan_id' => R_Input::pos('pengajuan_id'),
            ]);


            Redirect::wfa([
                'type' => 'success',
                'mesg' => 'Pegawai berhasil diajukan',
                'text' => 'Silahkan refresh apabila data tidak tampil'
            ])->go('/pengajuan/pegawai/' . R_Input::pos('pengajuan_id'));
        } catch (\Throwable $th) {

            Redirect::wfe($th->getMessage())->go($_SERVER['HTTP_REFERER']);
        }
    }
}
