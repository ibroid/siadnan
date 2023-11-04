<?php

function levelColor($level)
{
  $data =  [
    'Developer' => 'success',
    'Administrator' => 'primary',
    'Operator' => 'secondary'
  ];

  return $data[$level];
}

?>

<table class="table table-hovered">
  <thead>
    <tr>
      <th>No</th>
      <th>Identifier</th>
      <th>Level</th>
      <th>Aksi</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach (UserEntity::all() as $i => $user) { ?>
      <tr>
        <td><?= ++$i ?></td>
        <td><?= $user->identifier ?> </td>
        <td><span class="badge badge-<?= levelColor($user->level) ?> digits"> <?= $user->level ?></span></td>
        <td>
          <div class="btn-group btn-group" role="group" aria-label="Basic example">
            <?= $this->load->component('edit_button_user', compact('user')) ?>
            <?= $this->load->component('delete_button_user', compact('user')) ?>
          </div>
        </td>
        <td><?= $user->status ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    $(".form-delete-user").each((i, el) => {
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