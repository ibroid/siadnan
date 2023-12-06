<div class="page-body">
    <div class="container-fluid">
        <?= $this->load->component("page_title") ?>
        <?= $this->session->flashdata("flash_alert") ?>
        <?= $this->session->flashdata("flash_error") ?>
    </div>
    <div class="container-fluid">
        <div class="row starter-main">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            <?= $pengajuan->nama_pengajuan ?>
                        </h5>
                        <div class="card-header-right">
                            <!-- <ul class="list-unstyled card-option">
                                <li><i class="fa fa-spin fa-cog"></i></li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li> -->
                            </ul>
                            <button data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                class="btn btn-primary">Tambah Pengajuan Baru</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-6">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Pangkat</th>
                                        <th>TMT</th>
                                        <th>Status</th>
                                        <th>Golongan</th>
                                        <th>Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody>
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
            <form action="<?= base_url("pengajuan/save_pegawai") ?>" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <?= $pengajuan->nama_pengajuan ?> Baru
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-pegawai">
                    <h6>Pilih Pegawai</h6>
                    <div class="row">
                        <div class="col-sm">
                            <label for="input-pegawai">Nama Pegawai</label>
                            <input required type="text" class="form-control" name="pegawai" id="input-pegawai">
                        </div>
                        <div class="col-sm">
                            <label for="input-pegawai">Tanggal Pengajuan</label>
                            <input required type="text" class="form-control flatpickr-input datetime-local"
                                name="tanggal_pengajuan">
                        </div>
                    </div>
                    <input type="hidden" name="id" id="hidden-input-pegawai">
                    <input type="hidden" name="pengajuan_id" value="<?= $pengajuan->id ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="button-save-pegawai" disabled class="btn btn-primary">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {

        const inputNamaPegawai = $("#input-pegawai")

        var pegawai = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace("value"),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: `<?= base_url('pegawai/type_suggest') ?>?query=%QUERY&satker_id=${<?= $satker->id ?>}`,
                wildcard: "%QUERY",
            },
        });

        inputNamaPegawai.typeahead(null, {
            name: 'pegawai',
            source: pegawai,
            display: 'nama_lengkap'
        });

        inputNamaPegawai.on("typeahead:select", (e, selection) => {
            $.ajax({
                url: "<?= base_url('pengajuan/detail_pegawai/') ?>" + selection.id,
                accepts: "text/html",
                success(html) {
                    $("#modal-body-pegawai").append(html)
                },
                error(error) {
                    console.log(error)
                    $("#modal-body-pegawai").append("Error : " + error.statusText + "<br>" + error.responseText)
                }
            })

            if (selection.id != null) {
                $("#button-save-pegawai").attr('disabled', false)
            }

            $("#hidden-input-pegawai").val(selection.id)
        })
    })
</script>