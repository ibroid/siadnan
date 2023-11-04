<?php

class Dashboard extends R_Controller
{

    public function index()
    {
        $this->load->page('user/dashboard')->layout('dashboard_layout');
    }
}
