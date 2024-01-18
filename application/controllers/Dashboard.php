<?php

class Dashboard extends R_Controller
{

    public function index()
    {
        $this->load->page('user/dashboard', [
            "dashboard_pengadilan" => SatkerEntity::all()
        ])->layout('dashboard_layout');
    }
}
