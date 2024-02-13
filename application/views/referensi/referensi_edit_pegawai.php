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
                        <form accept="<?= base_url("referensi/edit_pegawai/$pegawai->id/$satker->id") ?>" class="row g-3 needs-validation mega-inline card" novalidate="" method="POST" enctype="multipart/form-data">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Form Ubah Pegawai</h4>
                                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-3">
                                            <?= PegawaiForm::input('NamaLengkap', (object) [
                                                'placeholder' => 'Nama lengkap dengan gelar',
                                                'label' => 'Nama Lengkap',
                                                'value' => $pegawai->nama_lengkap
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-3">
                                            <?= PegawaiForm::input('Nip', (object) [
                                                'placeholder' => 'NIP tanpa titik',
                                                'label' => 'NIP',
                                                'value' => $pegawai->nip
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Pangkat Golongan</label>
                                            <select required name="pangkat" id="select-golongan" class="form-control">
                                                <option selected><?= $pegawai->pangkat ?></option>
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
                                                <option>Kepala Bagian Perencanaan dan Kepegawaian</option>
                                                <option>Kepala Bagian Umum dan Keuangan</option>
                                                <option>Panitera Muda Banding</option>
                                                <option>Panitera Muda Hukum</option>
                                                <option>Panitera Muda Gugatan</option>
                                                <option>Panitera Muda Permohonan</option>
                                                <option>Panitera Pengganti</option>
                                                <option>Hakim</option>
                                                <option>Hakim Tinggi</option>
                                                <option>Jurusita</option>
                                                <option>Jurusita Pengganti</option>
                                                <option>Kepala Sub Bagian Keuangan dan Pelaporan</option>
                                                <option>Kepala Sub Bagian Kepegawaian dan TI</option>
                                                <option>Kepala Sub Bagian Rencana Program dan Anggaran</option>
                                                <option>Kepala Sub Bagian Tata Usaha dan Rumah Tangga</option>
                                                <option>Kepala Sub Bagian Kepegawaian, Organisasi dan Tata Laksana</option>
                                                <option>Kepala Sub Bagian Perencanaan, Teknologi Informasi dan Pelaporan</option>
                                                <option>Analis Pengelolaan Keuangan APBN Ahli Madya</option>
                                                <option>Analis Pengelolaan Keuangan APBN Ahli Muda</option>
                                                <option>Arsiparis Ahli Pertama</option>
                                                <option>Pranata Komputer Ahli Pertama</option>
                                                <option>Pengelola Pengadaan Barang/Jasa Ahli Pertama</option>
                                                <option>Analis Sumber Daya Manusia Aparatur Ahli Pertama</option>
                                                <option>Perencana Ahli Pertama</option>
                                                <option>Pranata Keuangan APBN Pelaksana Lanjutan/Mahir</option>
                                                <option>Pranata Keuangan APBN Mahir</option>
                                                <option>Pranata Sumber Daya Manusia Aparatur Terampil</option>
                                                <option>Pranata Keuangan APBN Terampil</option>
                                                <option>Arsiparis Pelaksana</option>
                                                <option>Arsiparis Terampil</option>
                                                <option>Operator - Penata Layanan Operasional</option>
                                                <option>Klerek - Analis Perkara Peradilan</option>
                                                <option>Klerek - Pengolah Data dan Informasi</option>
                                                <option>Klerek - Penata Keprotokolan</option>
                                                <option>Klerek - Pengelola Penanganan Perkara</option>
                                                <option>Operator - Teknisi Sarana dan Prasarana</option>
                                                <option>Klerek - Penelaah Teknis Kebijakan</option>
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
                                            <br>
                                            <img height="200" src="<?= $pegawai->pass_foto ?>" alt="Pass Foto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <a class="btn btn-secondary" href="<?= base_url('referensi/pegawai?satker=' . $satker->kode_satker) ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
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