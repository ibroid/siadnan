<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3><?= $page_name ?></h3>
                    <p>Pengadilan Agama Jakarta Utara</p>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item"><?= $breadcumb ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="page-content">
            <div class="row">
                <div class="col-xl-12 set-col-12 box-col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Data Pegawai</h4>
                            <p>Atur referensi pegawai anda disini</p>
                            <?php foreach ($satkers as $n => $satker) { ?>
                                <a href="<?= base_url('referensi/pegawai?satker=' . $satker->kode_satker) ?>" class="btn btn-outline-primary"><?= $satker->nama_satker ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 set-col-12 box-col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Jenis Pengajuan</h4>
                            <p>Atur referensi jenis pengajuan yang akan digunakan di Satuan Tingkat Pertama</p>
                            <a href="<?= base_url('referensi/pengajuan') ?>" class="btn btn-outline-info">Referensi Pengajuan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>