<div class="text-end">
  <form action="<?= base_url('settings') ?>">
    <button name="add_satker" value="true" class="btn btn-success">Tambah Satker Baru</button>
  </form>
</div>
<hr>

<table class="table table-hover">
  <thead>
    <tr>
      <th>Logo</th>
      <th>Satker</th>
      <th>Kontak</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach (SatkerEntity::get() as $i => $satker) { ?>
      <tr>
        <td><img width="50" src="<?= base_url($satker->logo_full_path) ?>" alt=""> </td>
        <td><?= $satker->nama_satker . '<br>' . $satker->email_satker ?></td>
        <td><?= $satker->telepon_satker  ?></td>
        <td>
          <div class="btn-group" role="group">
            <button class="btn btn-light dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilihan</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <a class="dropdown-item" href="<?= base_url('/settings?edit_satker=' . $satker->id) ?>">Ubah</a>
              <form class="form-delete-satker" action="<?= base_url("/settings/remove_satker") ?>" method="post">
                <input type="hidden" value="<?= $satker->id ?>" name="id">
                <button class="dropdown-item">Hapus</button>
              </form>
            </div>
          </div>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    $(".form-delete-satker").each((i, el) => {
      $(el).on("submit", (e) => {
        e.preventDefault()

        swal({
          title: "Apa anda yakin ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            $(el).unbind('submit')
            $(el).submit()
          } else {
            swal("Your imaginary file is safe!");
          }
        })
      })
    })

    $("#cart-options-tab").on("change", (e) => console.log('ok'))
  })
</script>