<form action="<?= base_url('/settings/save_satker') ?>" novalidate class="needs-validation custom-input" autocomplete="off" method="post" enctype="multipart/form-data">
  <div class="payment-info-wrapper">
    <div class="row shipping-method g-3">
      <div class="col-12">
        <div class="card-wrapper border rounded-3 pay-info light-card">
          <div class="row">

            <div class="col-md-12">
              <?= SatkerForm::input('NamaSatker', (object)[
                'placeholder' => 'Ketik Nama Satuan Kerja',
                'min' => '10'
              ]) ?>
            </div>
            <div class="col-md-12">
              <?= SatkerForm::input('KodeSatker', (object)[
                'placeholder' => 'Kode satker ada di sipp',
              ]) ?>
            </div>
            <div class="col-md-12">
              <?= SatkerForm::input('TeleponSatker', (object)[
                'placeholder' => '(021) XXXX',
              ]) ?>
            </div>
            <div class="col-md-12">
              <?= SatkerForm::input('EmailSatker', (object)[
                'placeholder' => 'paxxxx@email.com',
                'min' => '10'
              ]) ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card-wrapper border rounded-3 light-card">
          <div>
            <div class="col-12">
              <label class="form-label" for="upload-logo">Upload Logo</label>
              <input class="form-control" id="upload-logo" type="file" aria-label="file example" required="" name="logo">
              <div class="invalid-feedback">Invalid form file selected</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <img id="preview-logo" alt="preview logo">
      </div>
      <div class="col-12 text-end">
        <button class="btn btn-primary">Simpan<i class="fa fa-save proceed-next pe-2"></i></button>
      </div>
    </div>
  </div>
</form>
<script>
  window.onload = () => {

    $("#upload-logo").change(previewImage)

    function previewImage(event) {
      var input = event.target;
      var preview = document.getElementById('preview-logo');

      var reader = new FileReader();
      reader.onload = function() {
        var dataURL = reader.result;
        preview.src = dataURL;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>