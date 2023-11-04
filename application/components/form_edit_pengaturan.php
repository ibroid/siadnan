<form action="<?= base_url('/settings/edit_pengaturan/' . $pengaturan->variable) ?>" novalidate class="needs-validation custom-input" autocomplete="off" method="post" enctype="multipart/form-data">
  <div class="payment-info-wrapper">
    <div class="row shipping-method g-3">
      <div class="col-12">
        <div class="card-wrapper border rounded-3 pay-info light-card">
          <div class="row">
            <div class="col-md-12">
              <label for="input-variable">Masukan Value</label>
              <input type="text" value="<?= $pengaturan->value ?>" maxlength="556" required name="value" class="form-control" placeholder="Sesuaikan dengan kebutuhan">
              <div class="invalid-feedback">Check Again</div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="col-12">
        <div class="card-wrapper border rounded-3 light-card">
          <div>
            <div class="col-12">
              <label class="form-label" for="upload-logo">Upload Logo</label>
              <input type="hidden"  name="logoSatker">
              <input class="form-control" id="upload-logo" type="file" aria-label="file example" name="logo">
              <div class="invalid-feedback">Invalid form file selected</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <img id="preview-logo" alt="preview logo" >
      </div> -->
      <div class="col-12 text-end">
        <button class="btn btn-primary">Simpan<i class="fa fa-save proceed-next pe-2"></i></button>
      </div>
    </div>
  </div>
</form>