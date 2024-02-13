<?php

require_once APPPATH . "/traits/PengaturanApi.php";
require_once APPPATH . "/traits/PengajuanApi.php";
require_once APPPATH . "/traits/PersyaratanPengajuanApi.php";

class Dashboard extends R_Controller
{
    use PengaturanApi;
    use PengajuanApi;
    use PersyaratanPengajuanApi;

    public function index()
    {
        $data =  [
            "dashboard_pengadilan" =>  $this->is_admin ? SatkerEntity::all() : [$this->pegawai->satker],
            "pengaturan" => $this->plucking_pengaturan(),
            "admin" => $this->is_admin,
        ];
        if ($this->is_admin) {
            $data["berkas"] = $this->findPersyaratanPengajuan();
            $data["pengajuans"] = $this->getPengajuan();
        }
        $this->load->page('user/dashboard', $data)->layout('dashboard_layout');
    }
}
