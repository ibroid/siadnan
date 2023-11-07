<?php

require_once APPPATH . "traits/SatkerApi.php";
require_once APPPATH . "traits/PegawaiApi.php";

class Referensi extends R_Controller
{
    use SatkerApi;
    use PegawaiApi;

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
        $satker = SatkerEntity::where('kode_satker', R_Input::gett("satker"))->first();

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
}
