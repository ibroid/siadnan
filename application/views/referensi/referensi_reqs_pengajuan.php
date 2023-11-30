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
					<div class="col-xl-7">
						<div class="row g-3  mega-inline card">
							<div class="card-header">
								<h4 class="card-title mb-0">Persyaratan Untuk
									<?= $pengajuan->nama_pengajuan ?>
								</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<p>
										<?= $pengajuan->persyaratan_text ?>
									</p>
									<div class="col-sm-5">
										<p class="text-primary">Klik Untuk Melihat Detail</p>
										<div class="list-group" id="list-tab" role="tablist">
											<?php foreach ($pengajuan->persyaratan as $n => $p) { ?>
												<a class="list-group-item list-group-item-action list-hover-primary"
													id="list-home-list<?= $p->id ?>" data-bs-toggle="list" href="#list-home<?= $p->id ?>" role="tab"
													aria-controls="list-home<?= $p->id ?>" aria-selected="true">
													<?= $p->persyaratan ?>
												</a>
											<?php } ?>
										</div>
									</div>
									<div class="col-sm-7">
										<div class="tab-content" id="nav-tabContent">
											<?php foreach ($pengajuan->persyaratan as $n => $f) { ?>
												<div class="tab-pane fade list-behaviors" id="list-home<?= $f->id ?>" role="tabpanel"
													aria-labelledby="list-home-list<?= $p->id ?>">
													<div class="flex-space align-items-center list-light-dark contact-profile p-3">
														<ul class="d-flex flex-column gap-2">
															<li> <strong>Nama Syarat : </strong>
																<?= $f->persyaratan ?>
															</li>
															<li><strong>Detail : </strong>
																<?= $f->detail ?>
															</li>
															<li><strong>Max Size : </strong>
																<?= $f->max_size ?>KB
															</li>
															<li>
																<button data-bs-toggle="modal" data-bs-target="#exampleModallogin<?= $f->id ?>"
																	class="btn btn-warning btn-sm">Edit</button>
																<button onclick="confirmDelete(<?= $f->id ?>)"
																	class="btn btn-danger btn-sm">Hapus</button>
															</li>
														</ul>
													</div>
												</div>
												<div class="modal fade" id="exampleModallogin<?= $f->id ?>" tabindex="-1"
													aria-labelledby="exampleModallogin" aria-hidden="true" style="display: none;">
													<div class="modal-dialog modal-dialog-centered" role="document">
														<div class="modal-content dark-sign-up">
															<div class="modal-body  text-start">
																<div class="modal-toggle-wrapper">
																	<h5>Ubah Persyaratan Untuk
																		<?= $pengajuan->nama_pengajuan ?>
																	</h5>
																	<form class="row g-3 needs-validation" novalidate method="post"
																		action="<?= base_url("/referensi/pengajuan_update_persyaratan/" . $f->id) ?>">
																		<div class="col-md-12">
																			<label class="form-label" for="input-nama-pengajuan">Nama Pengajuan</label>
																			<input value="<?= $f->persyaratan ?>" class="form-control" id="input-nama-pengajuan"
																				type="text" placeholder="Contoh : Scan SK" name="persyaratan" required>
																		</div>
																		<div class="col-md-12">
																			<label class="form-label" for="textarea-detail">Detail</label>
																			<textarea name="detail" id="textarea-detail" cols="10" rows="5"
																				placeholder="Contoh : Scan Surat Keputusan Kenaikan Pangkat ..."
																				class="form-control" required><?= $f->detail ?></textarea>
																		</div>
																		<div class="col-md-12">
																			<label class="form-label" for="select-max-size">Ukuran Maksimal</label>
																			<select name="max_size" required id="select-max-size"
																				class="form-control form-select">
																				<option value="1024">1 MB</option>
																				<option selected value="2048">2 MB</option>
																				<option value="3072">3 MB</option>
																				<option value="4096">4 MB</option>
																				<option value="5120">5 MB</option>
																				<option value="6144">6 MB</option>
																				<option value="7168">7 MB</option>
																				<option value="8192">8 MB</option>
																			</select>
																		</div>
																		<div class=" col-12">
																			<button class="btn btn-primary" type="submit">Simpan </button>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer text-end">
								<a class="btn btn-secondary" href="<?= base_url('referensi/pengajuan') ?>"><i
										class="fa fa-arrow-left"></i> Kembali</a>
								<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModallogin">Tambah <i
										class="fa fa-plus"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModallogin" tabindex="-1" aria-labelledby="exampleModallogin" aria-hidden="true"
	style="display: none;">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content dark-sign-up">
			<div class="modal-body  text-start">
				<div class="modal-toggle-wrapper">
					<h5>Tambah Persyaratan Untuk
						<?= $pengajuan->nama_pengajuan ?>
					</h5>
					<form class="row g-3 needs-validation" novalidate method="post"
						action="<?= base_url("/referensi/pengajuan_add_persyaratan/" . $pengajuan->id) ?>">
						<div class="col-md-12">
							<label class="form-label" for="input-nama-pengajuan">Nama Pengajuan</label>
							<input class="form-control" id="input-nama-pengajuan" type="text" placeholder="Contoh : Scan SK"
								name="persyaratan" required>
						</div>
						<div class="col-md-12">
							<label class="form-label" for="textarea-detail">Detail</label>
							<textarea name="detail" id="textarea-detail" cols="10" rows="5"
								placeholder="Contoh : Scan Surat Keputusan Kenaikan Pangkat ..." class="form-control"
								required></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label" for="select-max-size">Ukuran Maksimal</label>
							<select name="max_size" required id="select-max-size" class="form-control form-select">
								<option value="1024">1 MB</option>
								<option selected value="2048">2 MB</option>
								<option value="3072">3 MB</option>
								<option value="4096">4 MB</option>
								<option value="5120">5 MB</option>
								<option value="6144">6 MB</option>
								<option value="7168">7 MB</option>
								<option value="8192">8 MB</option>
							</select>
						</div>
						<div class=" col-12">
							<button class="btn btn-primary" type="submit">Simpan </button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	async function confirmDelete(id) {
		const {
			isConfirmed
		} = await Swal.fire({
			title: "Apa anda yakin",
			text: "Aksi ini tidak bisa dibatalkan",
			icon: "warning",
			showCancelButton: true,
			cancelButtonText: "Batalkan",
			confirmButtonText: "Yakin"
		})

		if (isConfirmed) {
			Swal.fire({
				title: "Mohon Tunggu",
				willOpen: () => Swal.showLoading(),
				allowOutsideClick: false,
				showConfirmButton: false,
				backDrop: false,
			})

			fetch("<?= base_url('/referensi/hapus_persyaratan/') ?>" + id, {
				method: "POST"
			}).then(res => {
				if (!res.ok) {
					throw new Error(res.statusText)
				}
				return res.text()
			})
				.then(res => {
					Swal.fire("Persyaratan berhasil dihapus").then(() => location.reload());
				})
				.catch(err => {
					console.log(err)
					Swal.fire({
						title: err.message,
						icon: "error"
					})
				})
		}
	}
</script>