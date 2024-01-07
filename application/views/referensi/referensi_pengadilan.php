<div class="page-body">
  <?= $this->load->component('page_title', compact('breadcumb', 'page_name')) ?>
  <div class="container-fluid">
    <?= $this->session->flashdata('flash_alert') ?>
    <?= $this->session->flashdata('flash_error') ?>
  </div>
  <div class="container-fluid">
    <div class="edit-profile">
      <div class="row">
        <div class="d-flex justify-content-center">
          <div class="col-xl-4">
            <form action="<?= base_url('/referensi/simpan_satker/' . $satker->id) ?>" class="row g-3 needs-validation mega-inline card" novalidate="" method="POST" enctype="multipart/form-data">
              <div class="card-header">
                <h4 class="card-title mb-0">Sesuaikan Profile Pengadilan</h4>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
              </div>
              <div class="card-body">
                <div class="row shipping-method g-3">
                  <div class="col-12">
                    <div class="card-wrapper border rounded-3 pay-info light-card">
                      <div class="row">

                        <div class="col-md-12">
                          <?= SatkerForm::input('NamaSatker', (object)[
                            'placeholder' => 'Ketik Nama Satuan Kerja',
                            'min' => '10',
                            'value' => $satker->nama_satker
                          ]) ?>
                        </div>
                        <div class="col-md-12">
                          <?= SatkerForm::input('KodeSatker', (object)[
                            'placeholder' => 'Kode satker ada di sipp',
                            'value' => $satker->kode_satker
                          ]) ?>
                        </div>
                        <div class="col-md-12">
                          <?= SatkerForm::input('TeleponSatker', (object)[
                            'placeholder' => '(021) XXXX',
                            'value' => $satker->telepon_satker
                          ]) ?>
                        </div>
                        <div class="col-md-12">
                          <?= SatkerForm::input('EmailSatker', (object)[
                            'placeholder' => 'paxxxx@email.com',
                            'min' => '10',
                            'value' => $satker->email_satker
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
                    <img id="preview-logo" width="200" alt="preview logo" src="<?= base_url($satker->logo_full_path) ?>">
                  </div>
                </div>
              </div>
              <div class="card-footer text-end">
                <button class="btn btn-primary" type="submit">Simpan <i class="fa fa-save"></i></button>
              </div>
            </form>
            <br><br><br><br>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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