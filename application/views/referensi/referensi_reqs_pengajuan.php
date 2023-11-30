<div class="page-body">
    <?= $this->load->component('page_title', compact('breadcumb', 'page_name')) ?>
    <div class="container-fluid">
        <?= $this->session->flashdata('flash_alert') ?>
        <?= $this->session->flashdata('flash_error') ?>
    </div>
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-xl-5">
                        <form accept="<?= base_url('referensi/add_pengajuan') ?>" class="row g-3 needs-validation mega-inline card" novalidate="" method="POST" enctype="multipart/form-data">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Persyaratan Untuk <?= $pengajuan->nama_pengajuan ?></h4>
                                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                            </div>
                            <div class="card-body">

                            </div>
                            <div class="card-footer text-end">
                                <a class="btn btn-secondary" href="<?= base_url('referensi/pengajuan') ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button class="btn btn-primary" type="submit">Simpan <i class="fa fa-save"></i></button>
                            </div>
                        </form>
                        <br><br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>