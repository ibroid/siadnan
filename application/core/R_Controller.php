<?php

require_once APPPATH . 'libraries/EntityValidation.php';

class R_Controller extends CI_Controller
{
    public $user = [];

    public EloquentDatabase $ed;

    public CI_DB $database;

    public PegawaiEntity $pegawai;

    public Addons $addons;

    public bool $is_admin = false;

    public CI_Session $session;

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_login'))) {

            $this->session->set_flashdata(
                'flash_error',
                $this->load->component('flash_alert', [
                    'type' => 'secondary',
                    'mesg' => 'Anda perlu login terlebih dahulu',
                    'text' => 'Silahkan masukan kredensi anda. Pastikan Semuanya benar'
                ])
            );

            redirect(base_url('auth'));
        }

        $this->user = $this->session->userdata('user_login');
        $this->load->database();
        $this->load->library('EloquentDatabase', null, 'ed');
        $this->pegawai = PegawaiEntity::find($this->user['profile']['pegawai_id']);
        if ($this->user["level"] == "Admin" || $this->user["level"] == "Developer") {
            $this->is_admin = true;
        }
    }
}
