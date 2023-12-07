<strong>Riwayat Upload</strong>
<p>Klik tanggal upload untuk melihat detail</p>
<div class="accordion dark-accordion" id="accordionPanelsStayOpenExample">
    <?php foreach ($p->persyaratan_pengajuan as $i => $ps) { ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne<?= $ps->id ?>">
                <button
                    class="accordion-button gap-2 accordion-light-<?= _colorStatus($ps->status) ?> active txt-<?= _colorStatus($ps->status) ?> collapsed"
                    type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?= $ps->id ?>"
                    aria-expanded="false" aria-controls="panelsStayOpen-collapseOne<?= $ps->id ?>">
                    <?= date('d F Y', strtotime($ps->tanggal_upload)) ?>
                </button>
            </h2>
            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseOne<?= $ps->id ?>"
                aria-labelledby="panelsStayOpen-headingOne<?= $ps->id ?>" style="">
                <div class="accordion-body">
                    <p>
                        <?= !$ps->catatan ? "Menunggu Pemeriksaan" : $ps->catatan . ". Diperiksa tanggal " . date('d F Y', strtotime($ps->tanggal_diperiksa)) ?>
                    </p>
                    <a target="_blank" class="btn btn-light btn-sm text-primary"
                        href="<?= base_url("/uploads/berkas/" . $ps->filename) ?>">Download File</a>
                    <a class="btn btn-light btn-sm text-danger"
                        href="<?= base_url("/pengajuan/delete_berkas/" . $ps->id) ?>">Delete File</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>