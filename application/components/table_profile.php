<?php

function buttonPegawai($id)
{
  $url = base_url('/settings?set_pegawai_profile=' . $id);
  return "<a href=\"$url\" class=\"btn btn-sm btn-secondary\">Set Pegawai</a>";
}

?>

<div class="table-responsive">
  <table class="table table-hovered">
    <thead>
      <tr>
        <td>Avatar</td>
        <td>Nama Lengkap</td>
        <td>Telepon</td>
        <td>Email</td>
        <td width="200">Pegawai</td>
        <td>Aksi</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach (ProfileEntity::all() as $n => $profile) { ?>
        <tr>
          <!-- <td><?= ++$n ?></td> -->
          <td> <img class="b-r-10" src="https://api.dicebear.com/7.x/adventurer/svg?size=45&backgroundColor=b6e3f4&seed=<?= $profile->avatar ?>" alt="avatar" /></td>
          <td><?= $profile->nama_lengkap ?></td>
          <td><?= $profile->nomor_telepon ?></td>
          <td><?= $profile->email ?></td>
          <td><?= ($profile->pegawai) ? $profile->pegawai->nama_lengkap : buttonPegawai($profile->id) ?></td>
          <td>
            <div class="btn-group" role="group">
              <button class="btn btn-light dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilihan</button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="<?= base_url('/settings?edit_profile=' . $profile->id) ?>">Ubah</a>
                <form class="form-delete-profile" action="<?= base_url("/settings/remove_profile") ?>" method="post">
                  <input type="hidden" value="<?= $profile->id ?>" name="id">
                  <button class="dropdown-item">Hapus</button>
                </form>
              </div>
            </div>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    $(".form-delete-profile").each((i, el) => {
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