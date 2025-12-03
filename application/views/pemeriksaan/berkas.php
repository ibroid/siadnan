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
							<div class="card-body">
								<div class="row">
									<div class="col-6">
										<div class="card widget-1" style="background: none;">
											<div class="card-body">
												<div class="widget-content">
													<div class="widget-round success">
														<div class="bg-round">
															<svg>
																<use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#return-box"> </use>
															</svg>
															<svg class="half-circle svg-fill">
																<use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#halfcircle"></use>
															</svg>
														</div>
													</div>
													<div>
														<h4> <span class="counter" data-target="845"><?= $pengajuan->persyaratan_pengajuan->where('status', true)->count() ?></span></h4><span class="f-light">Sudah Diperiksa</span>
													</div>
												</div>
												<div class="font-danger f-w-500"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-down bookmark-search me-1">
														<polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline>
														<polyline points="17 18 23 18 23 12"></polyline>
													</svg><span class="txt-danger">-40%</span></div>
											</div>
										</div>
									</div>
									<div class="col-6">
										<div class="card widget-1" style="background: none;">
											<div class="card-body">
												<div class="widget-content">
													<div class="widget-round warning">
														<div class="bg-round">
															<svg>
																<use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#return-box"> </use>
															</svg>
															<svg class="half-circle svg-fill">
																<use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#halfcircle"></use>
															</svg>
														</div>
													</div>
													<div>
														<h4> <span class="counter" data-target="845"><?= $pengajuan->persyaratan_pengajuan->where('status', false)->count() ?></span></h4><span class="f-light">Belum Diperiksa</span>
													</div>
												</div>
												<div class="font-danger f-w-500"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-down bookmark-search me-1">
														<polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline>
														<polyline points="17 18 23 18 23 12"></polyline>
													</svg><span class="txt-danger">-40%</span></div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-5">
										<p class="text-primary">Klik Untuk Melihat Detail</p>
										<div class="list-group" id="list-tab" role="tablist">
											<?php foreach ($pengajuan->pengajuan->persyaratan as $n => $p) { ?>
												<a class="list-group-item list-group-item-action list-hover-primary" id="list-home-list<?= $p->id ?>" data-bs-toggle="list" href="#list-home<?= $p->id ?>" role="tab" aria-controls="list-home<?= $p->id ?>" aria-selected="true">
													<?= $p->persyaratan ?>
												</a>
											<?php } ?>
										</div>
									</div>
									<div class="col-sm-7">
										<div class="tab-content" id="nav-tabContent">
											<?php foreach ($pengajuan->pengajuan->persyaratan as $m => $c) { ?>
												<div class="tab-pane fade list-behaviors" id="list-home<?= $c->id ?>" role="tabpanel" aria-labelledby="list-home-list<?= $c->id ?>">
													<?php foreach ($pengajuan->persyaratan_pengajuan as $k => $f) { ?>
														<?php if ($f->persyaratan_id == $c->id) { ?>
															<?php if ($f->status) { ?>
																<div class=" align-items-center list-light-dark contact-profile p-3">
																	<strong>Riwayat Pemeriksaan</strong>
																	<ul class="d-flex flex-column gap-2">
																		<li> <strong>Tanggal Periksa : </strong>
																			<?= $f->human_tanggal_diperiksa ?>
																		</li>
																		<li><strong>Keterangan : </strong>
																			<?= $f->catatan ?>
																		</li>
																		<li><strong>Status : </strong>
																			<?= $f->status == 1 ? "Diterima" : "Ditolak" ?>
																		</li>
																	</ul>
																	<div class="text-end">
																		<a href="<?= base_url("/pemeriksaan/batalkan_berkas/$f->id") ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Batalkan</a>
																		<a target="_blank" href="<?= base_url($f->berkas) ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Download</a>
																	</div>
																</div>
																<hr>
															<?php } else { ?>
																<div class=" align-items-center list-light-dark contact-profile p-3">
																	<ul class="d-flex flex-column gap-2">
																		<li> <strong>Nama Syarat : </strong>
																			<?= $f->persyaratan->persyaratan ?>
																		</li>
																		<li><strong>Detail : </strong>
																			<?= $f->persyaratan->detail ?>
																		</li>
																		<li><strong>Max Size : </strong>
																			<?= $f->persyaratan->max_size ?>KB
																		</li>
																		<li>
																			<a target="_blank" href="<?= base_url($f->berkas) ?>" class="btn btn-primary btn-sm">Download</a>
																		</li>
																	</ul>
																	<form novalidate action="<?= base_url("/pemeriksaan/save_resp_persyaratan") ?>" method="post" class="needs-validation row mt-4 d-flex flex-column gap-2">
																		<input type="hidden" value="<?= $f->id ?>" name="id">
																		<div class="form-group">

																			<label for="">Tulis Catatan</label>
																			<textarea cols="20" class="form-control form-textarea" placeholder="Contoh : Berkas sudah sesuai" required name="catatan"><?= $f->catatan ?></textarea>
																		</div>
																		<div class="form-group">
																			<label for="">Tanggal Diperiksa</label>
																			<input value="<?= $f->tanggal_diperiksa ?>" required type="date" class="form-control flatpickr-input datetime-local" name="tanggal_diperiksa">
																		</div>
																		<div class="form-group">
																			<label for="">Status</label>
																			<select required name="status" class="form-control form-select">
																				<option <?= ($f->status == 1) ? "selected" : "" ?> value="1">Diterima</option>
																				<option <?= ($f->status == 2) ? "selected" : "" ?> value="2">Ditolak</option>
																			</select>
																		</div>
																		<div class="form-group">
																			<button class="btn btn-sm btn-success mt-2">Simpan</button>
																		</div>
																	</form>
																</div>
															<?php } ?>
														<?php } ?>
													<?php } ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<?php if ($this->session->userdata("riwayat_pemeriksaan_berkas")) { ?>
									<div class="row p-3 mt-3">
										<div class="text-center mb-2">
											<h5>Riwayat Penyetujuan Berkas</h5>
										</div>
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Persyaratan</th>
													<th>Status</th>
													<th>Catatan</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($this->session->userdata("riwayat_pemeriksaan_berkas") as $d) { ?>
													<tr>
														<td><?= $d["persyaratan"] ?></td>
														<td><?= $d["status"] ?></td>
														<td><?= $d["catatan"] ?></td>
													</tr>
												<?php } ?>
												<tr>
													<td colspan="3" class="text-end">
														<div role="alert" class="alert alert-secondary text-start">
															<strong>PENTING !</strong> Klik selesai apabila sudah selesai memeriksa semua berkas
														</div>
														<a class="btn btn-success" href="<?= base_url("/pemeriksaan/done/" . $pengajuan->id) ?>"><i class="fa fa-check"></i> Pemeriksaan Selesai</a>
													</td>
												</tr>

											</tbody>
										</table>
									</div>
								<?php } ?>
							</div>
							<div class="card-footer text-end d-flex justify-content-between">
								<a class="btn btn-secondary" href="<?= base_url("/pemeriksaan") ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
								<a onclick="batalkan_pemeriksaan()" class="btn btn-danger" href="javascript:void(0)"><i class="fa fa-trash"></i> Batalkan Pemeriksaan</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	function batalkan_pemeriksaan() {
		Swal.fire({
			title: "Apa anda yakin",
			text: "Membatalkan pemeriksaan akan menghapus semua data pemeriksaan berkas ini",
			icon: "warning",
			showCancelButton: true,
			cancelButtonText: "Batalkan",
			confirmButtonText: "Yakin"
		}).then(({
			isConfirmed
		}) => {
			if (isConfirmed) {
				window.location.href = "<?= base_url("/pemeriksaan/batalkan_pemeriksaan/" . $pengajuan->id) ?>";
			}
		})
	}
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