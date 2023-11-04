<div class="shipping-info">
  <h5>Add User </h5>
  <form action="<?= base_url('settings/save_user') ?>" class="row g-3 needs-validation mega-inline" novalidate="" method="POST">
    <div class="col-xxl-12 col-sm-12">
      <label class="form-label" for="validation-firstname-wizard">Identifier<span class="txt-danger">*</span></label>
      <input minlength="5" name="identifier" class="form-control" id="validation-firstname-wizard" type="text" placeholder="Enter first name" required="">
      <div class="invalid-tooltip">Check Again!</div>
      <div class="valid-tooltip">Looks good!</div>
    </div>
    <div class="col-xxl-12 col-sm-12">
      <label class="form-label" for="validation-lastname-wizard">Password<span class="txt-danger">*</span></label>
      <input minlength="8" name="login[password]" class="form-control" id="validation-lastname-wizard" type="password" placeholder="Enter last name" required="">
      <div class="show-hide"><span class="show"> </span></div>
      <div class="invalid-tooltip">Check Again!</div>
      <div class="valid-tooltip">Looks good!</div>
    </div>
    <div class="col-xxl-12 col-sm-12 megaoptions-border-space-sm">
      <center>
        <h6>Jenis User</h6>
        <hr>
      </center>
      <div class="card">
        <div class="media p-20">
          <div class="form-check radio radio-secondary m-0 w-100">
            <input required class="form-check-input" id="radio21" type="radio" name="level" value="3">
            <label class="form-check-label mb-0 w-100" for="radio21">
              <span class="media-body">
                <span class="mt-0 mega-title-badge">Operator<span class="badge badge-secondary pull-right digits"> OPT
                  </span>
                </span>
                <span>Operator Satker Tingkat Pertama</span>
              </span>
            </label>
            <div class="invalid-tooltip">Check Again!</div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="media p-20">
          <div class="form-check radio radio-primary m-0 w-100">
            <input required class="form-check-input" id="radio22" type="radio" name="level" value="3">
            <label class="form-check-label mb-0 w-100" for="radio22">
              <span class="media-body">
                <span class="mt-0 mega-title-badge">
                  Admin
                  <span class="badge badge-primary pull-right digits"> ADM</span>
                </span>
                <span>Admin Peradilan Tingkat Banding</span>
              </span>
            </label>
            <div class="invalid-tooltip">Check Again!</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xxl-12 col-sm-12">
      <label class="form-label" for="validation-profile-wizard">Ketik dan Pilih Profile<span class="txt-danger">*</span></label>
      <input minlength="5" class="form-control" id="validation-profile-wizard" type="text" placeholder="" required="">
      <input type="hidden" required id="hidden-profile-id" name="profile_id">
      <small class="text-secondary">*Apabila nama anda tidak muncul. Hubungi Admin PTA</small>
      <div class="invalid-tooltip">Check Again!</div>
      <div class="valid-tooltip">Looks good!</div>
    </div>
    <div class="col-12 text-end">
      <button class="btn btn-primary">Save</button>
    </div>
  </form>
</div>
<br>

<script>
  window.onload = () => {

    var profile = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace("value"),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      remote: {
        url: `<?= base_url('profile/suggest_autocomplete') ?>?query=%QUERY`,
        wildcard: "%QUERY",
      },
    });

    $("#validation-profile-wizard").typeahead(null, {
      name: 'profile',
      source: profile,
      display: 'nama_lengkap'
    });

    $("#validation-profile-wizard").on("typeahead:select", (e, selection) => {
      $("#hidden-profile-id").val(selection.id)
    })
  }
</script>