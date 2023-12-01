<?php

require_once APPPATH . "/traits/JenisPengajuanApi.php";

class Pengajuan extends R_Controller
{

    use JenisPengajuanApi;
    public function index()
    {
        $this->load->page('pengajuan/pengajuan', [
            'page_name' => 'Pengajuan baru',
            'breadcumb' => 'Pengajuan',
            'pengajuan' => $this->getJenisPengajuan(),
        ])->layout('dashboard_layout');
    }
}
