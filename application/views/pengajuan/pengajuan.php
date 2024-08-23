<div class="page-body">
	<div class="container-fluid">
		<div class="page-title">
			<div class="row">
				<div class="col-6">
					<h3>Pengajuan Baru</h3>
					<!-- <p>Pengadilan Agama Jakarta Utara</p> -->
				</div>
				<div class="col-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">
								<svg class="stroke-icon">
									<use href="<?= base_url() ?>assets/svg/icon-sprite.svg#stroke-home"></use>
								</svg></a></li>
						<li class="breadcrumb-item">Pengajuan</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="page-content">
			<div class="row">
				<?php if ($pengajuan->count() == 0) { ?>
					<div class="alert alert-secondary">
						<h4>Belum ada sarana pengajuan yang tersedia</h4>
					</div>
				<?php } ?>
				<?php foreach ($pengajuan as $k => $p) { ?>
					<div class="col-xxl-6 col-sm-6 box-col-6">
						<div class="card profile-box">
							<div class="card-body">
								<div class="media media-wrapper justify-content-between">
									<div class="media-body">
										<div class="greeting-user">
											<h4 class="f-w-600">
												<?= $p->nama_pengajuan ?>
											</h4>
											<p>
												<?= $p->deskripsi ?>
											</p>
											<h6>
												<?= $p->persyaratan->count() ?> Persyaratan
											</h6>
											<div class="whatsnew-btn">
												<a href="<?= base_url('/pengajuan/pegawai/' . $p->id) ?>" class="btn btn-outline-white">
													Ajukan Sekarang</a>
											</div>
										</div>
									</div>
									<div>
										<div class="clockbox">
											<svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
												<g id="face">
													<circle class="circle" cx="300" cy="300" r="253.9"></circle>
													<path class="hour-marks" d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6">
													</path>
													<circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
												</g>
												<g id="hour" style="transform: rotate(437.183deg);">
													<path class="hour-hand" d="M300.5 298V142"></path>
													<circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
												</g>
												<g id="minute" style="transform: rotate(211.9deg);">
													<path class="minute-hand" d="M300.5 298V67"> </path>
													<circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
												</g>
												<g id="second" style="transform: rotate(474deg);">
													<path class="second-hand" d="M300.5 350V55"></path>
													<circle class="sizing-box" cx="300" cy="300" r="253.9"> </circle>
												</g>
											</svg>
										</div>
										<div class="badge f-10 p-0" id="txt">2:35 PM</div>
									</div>
								</div>
								<div class="cartoon"><img class="img-fluid" src="<?= base_url() ?>assets/images/dashboard/cartoon.svg" alt="vector women with leptop"></div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>