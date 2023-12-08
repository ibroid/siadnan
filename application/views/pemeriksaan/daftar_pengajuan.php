<div class="page-body">
    <?= $this->load->component("page_title") ?>
    <?= $this->session->flashdata("flash_alert") ?>
    <?= $this->session->flashdata("flash_error") ?>

    <div class="container-fluid">
        <div class="row starter-main">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Pengajuan Dalam Proses</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa-spin fa-cog"></i></li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-6">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Nama</th>
                                        <th colspan="6" class="text-center">Information Pegawai</th>
                                    </tr>
                                    <tr>
                                        <th>Satker</th>
                                        <th>Jabatan</th>
                                        <th>Pangkat</th>
                                        <th>Berkas</th>
                                        <th>Pengajuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pengajuan as $n => $p) { ?>
                                        <tr>
                                            <td>
                                                <?= ++$n ?>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="media"><img class="rounded-circle img-50 me-3"
                                                        src="<?= $p->pegawai->pass_foto ?>">
                                                    <div class="media-body align-self-center">
                                                        <div>
                                                            <?= $p->pegawai->nama_lengkap ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?= $p->pegawai->satker->nama_satker ?>
                                            </td>
                                            <td>
                                                <?= $p->pegawai->jabatan ?>
                                            </td>
                                            <td>
                                                <?= $p->pegawai->pangkat ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('/pemeriksaan/berkas/' . $p->id) ?>"
                                                    class="btn btn-warning btn-sm text-white">Periksa </a>
                                            </td>
                                            <td>
                                                <?= $p->pengajuan->nama_pengajuan ?>
                                            </td>
                                            <td>
                                                <?php if ($p->status == 4) { ?>
                                                    <div class="alert alert-light-primary p-1" role="alert">
                                                        <p class="text-small text-primary">Pengajuan ini sudah dikabulkan. Klik
                                                            <a href="#">Disini</a> untuk mengubah
                                                            surat keputusan
                                                        </p>
                                                    </div>
                                                <?php } else { ?>
                                                    <a onclick="setDataIid(<?= $p->id ?>)" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop"
                                                        class="btn btn-success btn-sm">Kabulkan</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="<?= base_url("pemeriksaan/dikabulkan") ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Isi Surat Keputusan
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-pegawai">
                    <input type="hidden" name="id" id="hidden-pengajuan-id">
                    <div class="row">
                        <div class="col-sm">
                            <label for="input-pegawai">Tanggal Ditinjau</label>
                            <input required type="date" class="form-control flatpickr-input datetime-local"
                                name="tanggal_ditinjau">
                        </div>
                        <div class="col-sm">
                            <label for="input-pegawai">Nama Asesor (Yang Memeriksa Berkas)</label>
                            <input required type="text" class="form-control" name="asesor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label for="input-pegawai">Surat Keputusan</label>
                            <input required type="file" class="form-control form-upload form-file"
                                name="surat_keputusan">
                        </div>
                    </div>
                    <input type="hidden" name="id" id="hidden-input-pegawai">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function setDataIid(id) {
        document.getElementById("hidden-pengajuan-id").value = id;
    }
</script>