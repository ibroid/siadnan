<?php

defined("BASEPATH") or die("Kuya Batok");

class Auth extends CI_Controller
{
    public EloquentDatabase $ed;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('EloquentDatabase', null, 'ed');
    }

    public function index()
    {
        $this->load->page("public/login")->layout('auth_layout');
    }

    public function login()
    {
        try {
            $u = $this->mathcIdentifier();
            $this->matchPassword($u->password, $u->salt);


            $this->storeSession($u->toArray());

            redirect(base_url("/dashboard"));
        } catch (\Throwable $th) {

            $this->session->set_flashdata('flash_error', $this->load->component('flash_alert', [
                'type' => 'secondary',
                'mesg' => $th->getMessage(),
                'text' => 'Silahkan masukan kredensi anda kembali. Pastikan Semuanya benar'
            ]));

            redirect(base_url("/auth"));
        }
    }

    private function matchPassword($password, $salt)
    {
        if (!password_verify(R_Input::pos('login')['password'] . $salt, $password)) {
            throw new Exception("Password tidak sama", 1);
        }
    }

    private function mathcIdentifier(): UserEntity
    {
        $u = UserEntity::with('profile')->where('identifier', R_Input::pos('login')['identifier'])->first();
        if (!$u) {
            throw new Exception("User tidak ditemukan", 1);
        }
        return $u;
    }

    private function storeSession(array $data)
    {
        $this->session->set_userdata(['user_login' => $data]);
    }

    public function logout()
    {
        R_Input::mustPost();
        $this->destroySession();
        redirect(base_url());
    }

    private function destroySession()
    {
        $this->session->sess_destroy();
    }
}
