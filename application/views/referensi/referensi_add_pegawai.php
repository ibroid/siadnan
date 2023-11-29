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
            <form accept="<?= base_url('referensi/add_pegawai?satker=' . R_Input::gett('satker')) ?>" class="row g-3 needs-validation mega-inline card" novalidate="" method="POST" enctype="multipart/form-data">
              <div class="card-header">
                <h4 class="card-title mb-0">Form Tambah Pegawai</h4>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <div class="mb-3">
                      <?= PegawaiForm::input('NamaLengkap', (object) [
                        'placeholder' => 'Nama lengkap dengan gelar',
                        'label' => 'Nama Lengkap'
                      ]) ?>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="mb-3">
                      <?= PegawaiForm::input('Nip', (object) [
                        'placeholder' => 'NIP tanpa titik',
                        'label' => 'NIP',
                      ]) ?>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="mb-3">
                      <label class="form-label">Pangkat Golongan</label>
                      <select required name="pangkat" id="select-golongan" class="form-control">
                        <option selected="" disabled="" value="">Pilih Golongan ..</option>
                        <option>Juru Muda (I/a)</option>
                        <option>Juru Muda Tingkat I (I/b)</option>
                        <option>Juru (I/c)</option>
                        <option>Juru Tingkat I (I/d)</option>
                        <option>Pengatur Muda (II/a)</option>
                        <option>Pengatur Muda Tingkat I (II/b)</option>
                        <option>Pengatur (II/c)</option>
                        <option>Pengatur Tingkat I (II/d)</option>
                        <option>Penata Muda (III/a)</option>
                        <option>Penata Muda Tingkat I (III/b)</option>
                        <option>Penata (III/c)</option>
                        <option>Penata Tingkat I (III/d)</option>
                        <option>Pembina (IV/a)</option>
                        <option>Pembina Tingkat I (IV/b)</option>
                        <option>Pembina Utama Muda (IV/c)</option>
                        <option>Pembina Utama Madya (IV/d)</option>
                        <option>Pembina Utama (IV/e)</option>
                        <option>Non Asn (--)</option>
                      </select>
                      <div class="invalid-tooltip">Check Again !</div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="mb-3">
                      <label class="form-label">Jabatan</label>
                      <select required name="jabatan" id="select-jabatan" class="form-control">
                        <option selected="" disabled="" value="">Pilih Jabatan ..</option>
                        <option>Ketua</option>
                        <option>Wakil Ketua</option>
                        <option>Panitera</option>
                        <option>Sekretaris</option>
                        <option>Panitera Muda Hukum</option>
                        <option>Panitera Pengganti</option>
                        <option>Hakim </option>
                        <option>Jurusita</option>
                        <option>Jurusita Pengganti</option>
                        <option>Panitera Muda Permohonan</option>
                        <option>Panitera Muda Gugatan</option>
                        <option>Kasubbag Umum dan Keuangan</option>
                        <option>Kasubbag Perencanaan, IT dan Pelaporan</option>
                        <option>Kasubbag Kepegawaian, Organisasi dan Tata Laksana</option>
                        <option>Bendahara Pengeluaran</option>
                        <option>Bendahara Penerimaan</option>
                        <option>Analis Pengelolaan Keuangan APBN</option>
                        <option>Analis Perkara Peradilan</option>
                        <option>Pengelola Perkara </option>
                        <option>Pengelola Perkara </option>
                        <option>Pengelola BMN</option>
                        <option>Analis Kepegawaian</option>
                        <option>Pranata Komputer</option>
                        <option>PPNPN</option>
                      </select>
                      <div class="invalid-tooltip">Check Again !</div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <div class="mb-3">
                      <label class="form-label">Upload Pass Foto</label>
                      <input name="pas_foto" class="form-control" type="file">
                      <small class="text-danger">Belum Wajib</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-end">
                <a class="btn btn-secondary" href="<?= base_url('referensi/pegawai?satker=' . R_Input::gett('satker')) ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
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

</script>