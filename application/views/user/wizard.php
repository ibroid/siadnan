<?php

function colorStatus($status = 0)
{
	if ($status == 2) {
		return "warning";
	}

	if ($status == 1) {
		return "success";
	}

	return "secondary";
}
?>
<div class="container-fluid ">
	<div class="row">
		<div class="col-12 p-0">
			<div>
				<div class="theme-form">
					<div class="wizard-4" id="wizard">
						<ul>
							<li>
								<a href="<?= base_url('pengajuan') ?>" class="btn btn-outline">
									<i class="fa fa-arrow-left"></i>
									Kembali
								</a>
							</li>
							<?php foreach ($pengajuan->persyaratan as $n => $p) { ?>
								<li>
									<a href="#step-<?= ++$n ?>">
										<h4>
											<?= $n ?>
										</h4>
										<h5>
											<?= $p->persyaratan ?>
										</h5><small>Lengkapi untuk melanjutkan</small>
									</a>
								</li>
							<?php } ?>

							<li> <img src="<?= base_url() ?>assets/images/login/icon.png" alt="looginpage"></li>
						</ul>
						<?php foreach ($pengajuan->persyaratan as $n => $p) { ?>
							<div id="step-<?= ++$n ?>">
								<div class="wizard-title">
									<h2>
										<?= $p->persyaratan ?>
									</h2>
									<h5 class="text-muted mb-4">
										<?= $p->detail ?>
									</h5>
								</div>
								<div class="login-main" style="width:800px">
									<div class="theme-form">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="name">Upload Disini.
														Maksimal
														<?= $p->max_size ?> KB
													</label>
													<form class="dropzone dz-clickable" id="singleFileUpload"
														action="<?= base_url("wizard/save_persyaratan/" . $p->id) ?>" method="POST"
														enctype="multipart/form-data">
														<input type="hidden" name="pengajuan_id" value="<?= $pengajuan->id ?>">
														<div class="dropzone-wrapper">
															<div class="dz-message needsclick"><i class="icon-cloud-up"></i>
																<h6>Drop files here or click to upload.</h6><span class="note needsclick"></span>
															</div>
														</div>
													</form>
												</div>
											</div>
											<div class="col-sm-6">
												<strong>Riwayat Upload</strong>
												<div class="accordion dark-accordion" id="accordionPanelsStayOpenExample">
													<?php foreach ($p->persyaratan_pengajuan as $i => $ps) { ?>
														<div class="accordion-item">
															<h2 class="accordion-header" id="panelsStayOpen-headingOne">
																<button
																	class="accordion-button gap-2 accordion-light-<?= colorStatus($ps->status) ?> active txt-<?= colorStatus($ps->status) ?> collapsed"
																	type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne"
																	aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
																	<?= date('d F Y', strtotime($ps->tanggal_upload)) ?>
																</button>
															</h2>
															<div class="accordion-collapse collapse" id="panelsStayOpen-collapseOne"
																aria-labelledby="panelsStayOpen-headingOne" style="">
																<div class="accordion-body">
																	<p>
																		<?= !$ps->catatan ? "Menunggu Pemeriksaan" : $ps->catatan . ". Diperiksa tanggal " . date('d F Y', strtotime($ps->tanggal_diperiksa)) ?>
																	</p>
																	<a class="btn btn-light btn-sm text-primary" href="">Download File</a>
																</div>
															</div>
														</div>
													<?php } ?>
												</div>
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
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	document.addEventListener("DOMContentLoaded", () => {

		function fetchRiwayat() {

		}

		(function () {
			var DropzoneExample = (function () {
				var DropzoneDemos = function () {
					Dropzone.options.singleFileUpload = {
						paramName: "file",
						maxFiles: 1,
						acceptedFiles: "application/pdf",
						addRemoveLinks: true,
						/**
						 * @param {File} file
						 * @param {Function} done
						 */
						accept(file, done) {
							if (file.type !== "application/pdf") {

								return done(new Error("Failed"))
							}

							return done()
						},
						init() {
							this.on("error", (file, message) => {
								Swal.fire("Terjadi Kesalahan", message, "error")
							});

							this.on("success", (file, message) => {
								Swal.fire("Upload Berhasil", "", "success")
							});
						}
					};
				};
				return {
					init: function () {
						DropzoneDemos();
					},
				};
			})();
			DropzoneExample.init();
		})();
	})
</script>