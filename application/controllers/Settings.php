<?php

require_once APPPATH . 'traits/UserApi.php';
require_once APPPATH . 'traits/ProfileApi.php';
require_once APPPATH . 'traits/SatkerApi.php';
require_once APPPATH . 'traits/PengaturanApi.php';

class Settings extends R_Controller
{
    use UserApi;
    use ProfileApi;
    use SatkerApi;
    use PengaturanApi;

    public function index()
    {

        $this->addons->init([
            'js' => [
                '<script src="../assets/js/form-validation-custom.js"></script>',
                '<script src="../assets/js/typeahead/handlebars.js"></script>',
                '<script src="../assets/js/typeahead/typeahead.bundle.js"></script>',
                '<script src="../assets/js/sweet-alert/sweetalert.min.js"></script>'
            ],
            'css' => [
                '<link rel="stylesheet" type="text/css" href="../assets/css/vendors/sweetalert2.css">'
            ]
        ]);

        $this->load->page('user/settings', [
            'page_name' => 'Settings Akun',
            'breadcumb' => 'Settings',
            'form' => $this->showForm()
        ])->layout('dashboard_layout');
    }

    private function showForm()
    {

        if (isset($_GET['add_user'])) {

            return $this->load->component('form_add_user');
        } else if (isset($_GET['edit_user'])) {

            return $this->load->component('form_edit_user', [
                'user' => UserEntity::find(R_Input::gett('edit_user'))
            ]);
        } else if (isset($_GET['add_profile'])) {

            return $this->load->component('form_add_profile');
        } else if (isset($_GET['edit_profile'])) {

            return $this->load->component('form_edit_profile', [
                'profile' => $this->get_profile(R_Input::gett('edit_profile'))
            ]);
        } else if (isset($_GET['set_pegawai_profile'])) {

            return $this->load->component('form_set_pegawai_profile');
        } else if (isset($_GET['add_satker'])) {

            return $this->load->component('form_add_satker');
        } else if (isset($_GET['edit_satker'])) {

            return $this->load->component('form_edit_satker', [
                'satker' => $this->get_satker(R_Input::gett('edit_satker'))
            ]);
        } else if (isset($_GET['edit_pengaturan'])) {

            return $this->load->component('form_edit_pengaturan', [
                'pengaturan' => $this->get_pengaturan(R_Input::gett('edit_pengaturan'))
            ]);
        } else {
            return '';
        }
    }

    public function save_user($id = null)
    {
        // prindie(R_Input::pos());
        try {
            $salt = salt();
            $data = [
                'salt' => $salt,
                'identifier' => R_Input::pos('identifier'),
                'password' => R_Input::pos('login')['password'] . $salt,
                'level' => R_Input::pos('level'),
                'profile_id' => R_Input::pos('profile_id'),
                'status' => 1,
            ];
            // prindie($data);
            if ($id != null) {

                $this->update_user($id, $data);
            } else {
                $this->insert_user($data);
            }

            Redirect::wfa([
                'type' => 'success',
                'mesg' => 'Aksi Berhasil',
                'text' => 'Data berhasil di insert'
            ])->go('/settings');
        } catch (\Throwable $th) {

            Redirect::wfe($th->getMessage())->go($_SERVER['HTTP_REFERER']);
        }
    }

    public function remove_user($id = null)
    {
        try {
            $this->delete_user($id);

            Redirect::wfa([
                'type' => 'warning',
                'mesg' => 'Aksi Berhasil',
                'text' => '<strong>Data berhasil di Hapus</strong>'
            ])->go('/settings');
        } catch (\Throwable $th) {

            Redirect::wfe($th->getMessage())->go('/settings');
        }
    }

    public function save_profile($id = null)
    {
        R_Input::mustPost();

        try {
            $data = [
                'nama_lengkap' => R_Input::pos('nama_lengkap'),
                'nomor_telepon' => R_Input::pos('nomor_telepon'),
                'email' => R_Input::pos('email'),
                'avatar' => R_Input::pos('avatar'),
                'pegawai_id' => 0
            ];

            if ($id) {
                $this->update_profile($id, $data);
            } else {
                $this->insert_profile($data);
            }

            Redirect::wfa([
                'type' => 'success',
                'mesg' => 'Aksi Berhasil',
                'text' => '<strong>Profile baru berhasil ditambahkan</strong>'
            ])->go('/settings');
        } catch (\Throwable $th) {
            //throw $th;
            Redirect::wfe($th->getMessage())->go('/settings');
        }
    }

    public function set_pegawai()
    {
        R_Input::mustPost();
        try {
            ProfileEntity::where('id', R_Input::pos('id'))->update(['pegawai_id' => R_Input::pos('pegawai_id')]);

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

    public function remove_profile()
    {
        R_Input::mustPost();
        // prindie($_POST);
        try {
            $this->delete_profile(R_Input::pos('id'));

            Redirect::wfa([
                'type' => 'warning',
                'mesg' => 'Aksi Berhasil',
                'text' => '<strong>Profile Telah dihapus</strong>'
            ])->go('/settings');
        } catch (\Throwable $th) {
            //throw $th;
            Redirect::wfe($th->getMessage())->go('/settings');
        }
    }

    public function edit_profile($id = null)
    {
        // prindie($_POST);
        R_Input::mustPost();
        try {
            $this->update_profile($id, [
                'nama_lengkap' => R_Input::pos('nama_lengkap'),
                'nomor_telepon' => R_Input::pos('nomor_telepon'),
                'email' => R_Input::pos('email'),
                'avatar' => R_Input::pos('avatar')
            ]);

            Redirect::wfa([
                'type' => 'success',
                'mesg' => 'Aksi Berhasil',
                'text' => '<strong>Profile telah diperbaharui</strong>'
            ])->go('/settings');
        } catch (\Throwable $th) {
            //throw $th;
            Redirect::wfe($th->getMessage())->go('/settings');
        }
    }

    public function save_satker()
    {
        R_Input::mustPost();
        // prindie($_FILES);

        try {
            $logo_satker = $this->upload_logo_satker('logo');
            $data = [
                'nama_satker' => R_Input::pos('namaSatker'),
                'kode_satker' => R_Input::pos('kodeSatker'),
                'telepon_satker' => R_Input::pos('teleponSatker'),
                'email_satker' => R_Input::pos('emailSatker'),
                'logo_satker' => $logo_satker
            ];

            $this->insert_satker($data);

            Redirect::wfa([
                'type' => 'success',
                'mesg' => 'Aksi Berhasil',
                'text' => '<strong>Satker baru telah disimpan</strong>'
            ])->go('/settings');
        } catch (\Throwable $th) {
            //throw $th;
            Redirect::wfe($th->getMessage())->go('/settings');
        }
    }

    public function edit_satker($id = null)
    {
        R_Input::mustPost();

        try {
            $logo_satker = (isset($_FILES['logo']) && $_FILES['logo']['size'] > 0) ? $this->upload_logo_satker('logo') : null;

            $data = [
                'nama_satker' => R_Input::pos('namaSatker'),
                'kode_satker' => R_Input::pos('kodeSatker'),
                'telepon_satker' => R_Input::pos('teleponSatker'),
                'email_satker' => R_Input::pos('emailSatker'),
            ];

            if ($logo_satker) {
                $data['logo_satker'] = $logo_satker;

                $this->delete_logo_satker(R_Input::pos('logoSatker'));
            }

            $this->update_satker($id, $data);

            Redirect::wfa([
                'type' => 'success',
                'mesg' => 'Aksi Berhasil',
                'text' => '<strong>Satker telah diperbaharui</strong>'
            ])->go('/settings');
        } catch (\Throwable $th) {
            //throw $th;
            Redirect::wfe($th->getMessage())->go('/settings');
        }
    }

    public function remove_satker()
    {
        R_Input::mustPost();

        try {
            $satker = $this->get_satker(R_Input::pos('id'));

            $this->delete_logo_satker($satker->logo_satker);
            $this->delete_satker(R_Input::pos('id'));

            Redirect::wfa([
                'type' => 'success',
                'mesg' => 'Aksi Berhasil',
                'text' => '<strong>Satker telah diperbaharui</strong>'
            ])->go('/settings');
        } catch (\Throwable $th) {
            //throw $th;
            Redirect::wfe($th->getMessage())->go('/settings');
        }
    }

    public function edit_pengaturan($var = null)
    {
        R_Input::mustPost();
        try {

            $this->update_pengaturan($var, R_Input::pos('value'));

            Redirect::wfa([
                'type' => 'success',
                'mesg' => 'Aksi Berhasil',
                'text' => '<strong>Pengaturan telah diperbaharui</strong>'
            ])->go('/settings');
        } catch (\Throwable $th) {
            throw $th;
            Redirect::wfe($th->getMessage())->go('/settings');
        }
    }
}
