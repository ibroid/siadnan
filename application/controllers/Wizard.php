<?php

require_once APPPATH . "/traits/JenisPengajuanApi.php";
require_once APPPATH . "/traits/PersyaratanPengajuanApi.php";
require_once APPPATH . "/traits/PegawaiApi.php";
require_once APPPATH . "/traits/PersyaratanApi.php";
class Wizard extends R_Controller
{
    use JenisPengajuanApi;
    use PersyaratanPengajuanApi;
    use PegawaiApi;
    use PersyaratanApi;

    public Addons $addons;

    public function pengajuan($id = null, $pegawaiId = null)
    {
        if ($id == null or $pegawaiId == null) {
            set_status_header(404);
            exit;
        }

        $this->addons->init([
            'js' => ['<script src="' . base_url() . 'assets/js/dropzone/dropzone.js"></script>'],
            'css' => ['<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/vendors/dropzone.css">']
        ]);

        $jenis_pengajuan = $this->getJenisPengajuan($id);

        $pegawai = $this->getPegawai($pegawaiId);

        if (!$jenis_pengajuan or !$pegawai) {
            set_status_header(404);
            exit;
        }

        $this->load->page('user/wizard', [
            "jenis_pengajuan" => $jenis_pengajuan,
            "pegawai" => $pegawai,
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
                "persyaratan_id" => $id,
                "pegawai_id" => R_Input::pos("pegawai_id"),
            ];

            $this->addPersyaratanPengajuan($data);

            echo json_encode([$this->load->component("pengajuan/riwayat_upload", ['p' => $this->getPersyaratan($id, R_Input::pos("pengajuan_id"))]), $id]);
        } catch (\Throwable $th) {
            //throw $th;
            set_status_header(400);
            echo $th->getMessage();
        }
    }

}
