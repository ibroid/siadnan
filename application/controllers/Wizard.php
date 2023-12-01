<?php

require_once APPPATH . "/traits/JenisPengajuanApi.php";
require_once APPPATH . "/traits/PersyaratanPengajuanApi.php";
class Wizard extends R_Controller
{
    use JenisPengajuanApi;
    use PersyaratanPengajuanApi;

    public Addons $addons;

    public function pengajuan($id = null)
    {
        if ($id == null) {
            set_status_header(404);
            exit;
        }

        $this->addons->init([
            'js' => ['<script src="' . base_url() . 'assets/js/dropzone/dropzone.js"></script>'],
            'css' => ['<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/vendors/dropzone.css">']
        ]);

        $this->load->page('user/wizard', [
            "pengajuan" => $this->getJenisPengajuan($id),
        ])->layout('auth_layout');
    }

    public function save_persyaratan($id = null)
    {
        if ($id == null) {
            set_status_header(404);
            exit;
        }

        try {
            $data = [
                "filename" => $this->uploadPersyaratanPengajuan($id, 'file'),
                "pengajuan_id" => R_Input::pos("pengajuan_id"),
                "tanggal_upload" => date("Y-m-d"),
                "persyaratan_id" => $id
            ];

            $this->addPersyaratanPengajuan($data);

            echo json_encode(["status" => "success"]);
        } catch (\Throwable $th) {
            //throw $th;
            set_status_header(400);
            echo $th->getMessage();
        }
    }
}
