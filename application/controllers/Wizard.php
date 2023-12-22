<?php

require_once APPPATH . "/traits/JenisPengajuanApi.php";
require_once APPPATH . "/traits/PersyaratanPengajuanApi.php";
require_once APPPATH . "/traits/PegawaiApi.php";
require_once APPPATH . "/traits/PengajuanApi.php";
require_once APPPATH . "/traits/PersyaratanApi.php";
class Wizard extends R_Controller
{
    use JenisPengajuanApi;
    use PersyaratanPengajuanApi;
    use PegawaiApi;
    use PersyaratanApi;
    use PengajuanApi;

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

        $pengajuan = $this->getPengajuan($id);

        if ($pengajuan->status == 5) {
            Redirect::wfe("Berkas tidak dapat dirubah karna sedang dalam pembuatan SK")->go($_SERVER["HTTP_REFERER"]);
        }

        if ($pengajuan->status == 2) {
            Redirect::wfe("Berkas tidak dapat dirubah sampai pemeriksaan selesai")->go($_SERVER["HTTP_REFERER"]);
        }

        if (!$pengajuan) {
            set_status_header(404);
            exit;
        }

        $this->load->page('user/wizard', [
            "jenis_pengajuan" => $this->getJenisPengajuan($pengajuan->jenis_pengajuan_id),
            "pengajuan" => $pengajuan
        ])->layout('auth_layout');
    }

    public function save_persyaratan()
    {
        R_Input::mustPost();

        try {
            $data = [
                "filename" => $this->uploadPersyaratanPengajuan(R_Input::pos("persyaratan_id"), 'file'),
                "pengajuan_id" => R_Input::pos("pengajuan_id"),
                "tanggal_upload" => date("Y-m-d"),
                "persyaratan_id" => R_Input::pos("persyaratan_id"),
                "pegawai_id" => R_Input::pos("pegawai_id"),
            ];

            $this->addPersyaratanPengajuan($data);

            echo json_encode(
                [
                    $this->load->component(
                        "pengajuan/riwayat_upload",
                        [
                            "p" => $this->findPersyaratanPengajuanWhere([
                                "pegawai_id" => $data["pegawai_id"],
                                "persyaratan_id" => $data["persyaratan_id"],
                                "pengajuan_id" => $data["pengajuan_id"]
                            ])->get()
                        ]
                    ),
                    R_Input::pos("persyaratan_id")
                ]
            );
        } catch (\Throwable $th) {
            //throw $th;
            set_status_header(400);
            echo $th->getMessage();
        }
    }

    public function delete_berkas($id = null)
    {
        R_Input::mustPost();

        if ($id == null) {
            set_status_header(404);
            exit();
        }

        try {
            $persyaratanPengajuan = $this->findPersyaratanPengajuanWhere(["id" => $id])->first()->toArray();

            $this->deletePersyaratanPengajuan($id);

            echo json_encode(
                [
                    $this->load->component(
                        "pengajuan/riwayat_upload",
                        [
                            "p" => $this->findPersyaratanPengajuanWhere([
                                "pegawai_id" => $persyaratanPengajuan["pegawai_id"],
                                "persyaratan_id" => $persyaratanPengajuan["persyaratan_id"],
                                "pengajuan_id" => $persyaratanPengajuan["pengajuan_id"]
                            ])->get()
                        ]
                    ),
                    $persyaratanPengajuan["persyaratan_id"]
                ]
            );
        } catch (\Throwable $th) {
            //throw $th;
            set_status_header(400);
            echo $th->getMessage();
        }
    }
}
