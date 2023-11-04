<form class="row g-3 needs-validation custom-input" novalidate="" autocomplete="off" method="POST" action="<?= base_url('settings/edit_profile/' . $profile->id) ?>">

  <div class="col-xxl-12 col-sm-6">
    <?= ProfileForm::input(
      'NamaLengkap',
      (object)[
        'min' => 3,
        'placeholder' =>
        'Masukan Nama Lengkap Anda ..',
        'value' => $profile->nama_lengkap
      ]
    ) ?>
  </div>

  <div class="col-xxl-12 col-sm-6">
    <?= ProfileForm::input(
      'NomorTelepon',
      (object)[
        'min' => 3,
        'placeholder' => 'Contoh : 6281xxxxx',
        'value' => $profile->nomor_telepon
      ]
    ) ?>
  </div>

  <div class="col-xxl-12 col-sm-6">
    <?= ProfileForm::input(
      'Email',
      (object)[
        'min' => 3,
        'placeholder' => 'myname@email.com',
        'value' => $profile->email
      ]
    ) ?>
  </div>

  <div class="col-xxl-12 col-sm-6">
    <label for="inputAvatar" class="form-label">Ketik Avatar Anda</label>
    <input value="<?= $profile->avatar ?>" name="avatar" type="text" class="form-control" id="inputAvatar">
    <hr>
    <img id="imgAvatar" class="b-r-10" src="https://api.dicebear.com/7.x/adventurer/svg?size=128&backgroundColor=b6e3f4&seed=<?= $profile->avatar ?>" alt="avatar" />
  </div>

  <div class="col-12 text-end">
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</form>

<script>
  window.onload = () => {
    console.log('ok')
    $("#inputAvatar").on("input", (e) => {
      $("#imgAvatar").attr("src", "https://api.dicebear.com/7.x/adventurer/svg?size=128&backgroundColor=b6e3f4&seed=" + e.target.value)
    })
  }
</script>