<?php

class Pengajuan extends CI_Controller
{

    public function index()
    {
        $this->load->page('user/pengajuan', [
            'page_name' => 'Pengajuan baru',
            'breadcumb' => 'Pengajuan'
        ])->layout('dashboard_layout');
    }
}
