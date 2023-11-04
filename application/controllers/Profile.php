<?php

require_once APPPATH . 'traits/PegawaiApi.php';
require_once APPPATH . 'traits/ProfileApi.php';

class Profile extends R_Controller
{
    use PegawaiApi;
    use ProfileApi;

    public function index()
    {
        $this->addons->init([
            'js' => [
                '<script src="../assets/js/form-validation-custom.js"></script>',
                '<script src="../assets/js/typeahead/handlebars.js"></script>',
                '<script src="../assets/js/typeahead/typeahead.bundle.js"></script>'
            ]
        ]);

        $this->load->page('profile/form', [
            'page_name' => 'User Profile',
            'breadcumb' => 'Dashboard / Profile'
        ])->layout('dashboard_layout');
    }

    public function save()
    {
        R_Input::mustPost();

        try {
            // prindie(R_Input::pos());

            $this->saveToProfile();
            if (isset($_POST['edit_cred'])) {
                $this->saveToUser();
            }

            $this->session->set_flashdata('flash_alert', $this->load->component('flash_alert', [
                'type' => 'success',
                'mesg' => 'Perubahan Berhasil',
                'text' => 'Perubahan akan terjadi apabila anda logout'
            ]));
        } catch (\Throwable $th) {

            $this->session->set_flashdata('flash_error', $this->load->component('flash_alert', [
                'type' => 'secondary',
                'mesg' => $th->getMessage(),
                'text' => 'Silahkan masukan kredensi anda kembali. Pastikan Semuanya benar'
            ]));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    private function saveToProfile()
    {
        ProfileEntity::where('id', $this->user['profile']['id'])->update([
            'nama_lengkap' => R_Input::pos('nama_lengkap'),
            'nomor_telepon' => R_Input::pos('nomor_telepon'),
            'email' => R_Input::pos('email'),
            'avatar' => R_Input::pos('avatar'),
        ]);
    }

    private function saveToUser()
    {
        $newPassword = password_hash(R_Input::pos('login')['password'] . $this->user['salt'], PASSWORD_BCRYPT);

        UserEntity::where('id', $this->user['id'])->update([
            'identifier' =>  R_Input::pos('identifier'),
            'password' => (R_Input::pos('login')['password'] == '') ? $this->user['password'] : $newPassword,
        ]);
    }

    public function set_pegawai()
    {
        R_Input::mustPost();
        try {
            ProfileEntity::where('id', $this->user['profile_id'])->update(['pegawai_id' => R_Input::pos('pegawai_id')]);

            $this->session->set_flashdata('flash_alert', $this->load->component('flash_alert', [
                'type' => 'success',
                'mesg' => 'Perubahan Berhasil',
                'text' => 'Perubahan akan terjadi apabila anda logout'
            ]));
        } catch (\Throwable $th) {
            $this->session->set_flashdata('flash_error', $this->load->component('flash_alert', [
                'type' => 'secondary',
                'mesg' => $th->getMessage(),
                'text' => 'Silahkan masukan kredensi anda kembali. Pastikan Semuanya benar'
            ]));
        }
    }
}
