<?php

class Referensi extends CI_Controller
{
    public function index()
    {
        $this->load->page('user/referensi', [
            'page_name' => 'Referensi Data',
            'breadcumb' => 'Referensi'
        ])->layout('dashboard_layout');
    }

    public function pegawai()
    {
        $this->load->page('user/referensi_pegawai', [
            'page_name' => 'Referensi Data',
            'breadcumb' => 'Referensi'
        ])->layout('dashboard_layout');
    }
}
