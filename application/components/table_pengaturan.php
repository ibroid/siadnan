<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>Keterangan</th>
        <th>Variable</th>
        <th>Value</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (PengaturanEntity::get() as $n => $pengaturan) { ?>
        <tr>
          <td><?= $pengaturan->keterangan ?></td>
          <td><?= $pengaturan->variable ?></td>
          <td><?= $pengaturan->value ?></td>
          <td>
            <a href="<?= base_url('/settings?edit_pengaturan=' . $pengaturan->variable) ?>" class="btn btn-warning">Ubah</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>