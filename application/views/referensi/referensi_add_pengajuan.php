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
                                <h4 class="card-title mb-0">Form Pengajuan</h4>
                                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-3">
                                            <?= JenisPengajuanForm::input("NamaPengajuan", (object) [
                                                'placeholder' => 'Nama/Judul Pengajuan'
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-3">
                                            <label for="">Deskripsi Pengajuan</label><span class="txt-danger">*</span>
                                            <textarea minlength="100" required name="deskripsi" cols="10" rows="5" class="form-control" placeholder="Deskripsikan Pengajuan Ini. Contoh : Pengajuan untuk pegawai yang akan pensuin ..."></textarea>
                                            <div class="valid-tooltip">Looks Good !</div>
                                            <div class="invalid-tooltip">Check Again !</div>
                                            <div class="text-end">
                                                <i class="text-small text-danger">Wajib. Minimal 100 Huruf</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-3">
                                            <label for="">Persyaratan Pengajuan</label><span class="txt-danger">*</span>
                                            <textarea minlength="100" required name="persyaratan" cols="10" rows="5" class="form-control" placeholder="1. Scan KK&#10;2. Scan KTP&#10;3. Scan Dokumen lainnya"></textarea>
                                            <div class="valid-tooltip">Looks Good !</div>
                                            <div class="invalid-tooltip">Check Again !</div>
                                            <div class="text-end">
                                                <i class="text-small text-danger">Wajib. Minimal 100 Huruf</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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