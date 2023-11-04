<?php
$user = $this->session->userdata('user_login');
if ($user['profile']['pegawai_id'] == 0) {
    $satkerInPengaturan = PengaturanEntity::where('variabel', 'ptb')->pluck('value')->first();
    $satker = $satkerInPengaturan;
} else {
    $pegawai = PegawaiEntity::where('id', $user['profile']['pegawai_id'])->first();
    $satkerInUser = SatkerEntity::where('id', $pegawai->satker_id)->pluck('nama_satker')->first();
    $satker =  $satkerInUser;
}
?>

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3><?= $page_name ?></h3>
                <p><?= $satker ?></p>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><?= $breadcumb ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>