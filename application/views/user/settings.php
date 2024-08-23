<?php

$is_user_tab = (isset($_GET['add_user']) or isset($_GET['edit_user']) or count($_GET) == 0);

$is_profile_tab = (isset($_GET['add_profile']) or isset($_GET['edit_profile']) or isset($_GET['set_pegawai_profile']));

$is_satker_tab = (isset($_GET['add_satker']) or isset($_GET['edit_satker']));

$is_pengaturan_tab = (isset($_GET['add_pengaturan']) or isset($_GET['edit_pengaturan']));

?>

<div class="page-body">
	<div class="container-fluid">
		<div class="page-title">
			<div class="row">
				<div class="col-6">
					<h3><?= $page_name ?></h3>
					<!-- <p>Pengadilan Agama Jakarta Utara</p> -->
				</div>
				<div class="col-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="index.html">
								<svg class="stroke-icon">
									<use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
								</svg>
							</a>
						</li>
						<li class="breadcrumb-item"><?= $breadcumb ?></li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<?= $this->session->flashdata('flash_alert') ?>
		<?= $this->session->flashdata('flash_error') ?>
	</div>
	<div class="container-fluid">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4>Pengaturan Aplikasi</h4>
							<p class="f-m-light mt-1">
								Silahkan sesuaikan dengan lingkungan Peradilan anda.</p>
						</div>
						<div class="card-body">
							<div class="row shopping-wizard">
								<div class="col-12">
									<div class="row shipping-form g-5">
										<div class="col-xl-8 shipping-border">
											<div class="nav nav-pills horizontal-options shipping-options" id="cart-options-tab" role="tablist" aria-orientation="vertical">

												<a class="nav-link b-r-0 <?= $is_user_tab ? 'active' : '' ?>" id="bill-wizard-tab" data-bs-toggle="pill" href="#bill-wizard" role="tab" aria-controls="bill-wizard" aria-selected="<?= $is_user_tab ? 'true' : 'false' ?>">
													<div class="cart-options">
														<div class="stroke-icon-wizard"><i class="fa fa-user"></i></div>
														<div class="cart-options-content">
															<h6>Pengguna</h6>
														</div>
													</div>
												</a>

												<a class="nav-link b-r-0 <?= $is_profile_tab ? 'active' : '' ?>" id="ship-wizard-tab" data-bs-toggle="pill" href="#ship-wizard" role="tab" aria-controls="ship-wizard" aria-selected="<?= $is_profile_tab ? 'true' : 'false' ?>" tabindex="-1">
													<div class="cart-options">
														<div class="stroke-icon-wizard"><i class="fa fa-users"></i></div>
														<div class="cart-options-content">
															<h6>Profile</h6>
														</div>
													</div>
												</a>

												<a class="nav-link b-r-0 <?= $is_satker_tab ? 'active' : '' ?>" id="payment-wizard-tab" data-bs-toggle="pill" href="#payment-wizard" role="tab" aria-controls="payment-wizard" aria-selected="<?= $is_profile_tab ? 'true' : 'false' ?>" tabindex="-1">
													<div class="cart-options">
														<div class="stroke-icon-wizard"><i class="fa fa-building"></i></div>
														<div class="cart-options-content">
															<h6>Satker</h6>
														</div>
													</div>
												</a>

												<a class="nav-link b-r-0 <?= $is_pengaturan_tab ? 'active' : '' ?>" id="finish-wizard-tab" data-bs-toggle="pill" href="#finish-wizard" role="tab" aria-controls="finish-wizard" aria-selected="<?= $is_pengaturan_tab ? 'true' : 'false' ?>" tabindex="-1">
													<div class="cart-options">
														<div class="stroke-icon-wizard"><i class="fa fa-gear"></i></div>
														<div class="cart-options-content">
															<h6>Pengaturan</h6>
														</div>
													</div>
												</a>

											</div>
											<div class="tab-content dark-field shipping-content" id="cart-options-tabContent">
												<div class="tab-pane fade <?= $is_user_tab ? 'active show' : '' ?>" id="bill-wizard" role="tabpanel" aria-labelledby="bill-wizard-tab">
													<h6>Pengaturan Pengguna Aplikasi </h6>
													<p class="f-light">Tabel Pengguna </p>
													<div class="text-end">
														<form action="<?= base_url('settings') ?>">
															<button name="add_user" value="true" class="btn btn-success">Tambah User Baru</button>
														</form>
													</div>
													<hr>
													<?= $this->load->component('table_user') ?>
												</div>
												<div class="tab-pane fade <?= $is_profile_tab ? 'active show' : '' ?> shipping-wizard" id="ship-wizard" role="tabpanel" aria-labelledby="ship-wizard-tab">
													<h6>Profile Information</h6>
													<p class="f-light">Tabel Daftar Profile</p>
													<div class="text-end">
														<form action="<?= base_url('settings') ?>">
															<button name="add_profile" value="true" class="btn btn-success">Tambah Profile Baru</button>
														</form>
													</div>
													<hr>
													<?= $this->load->component('table_profile') ?>
												</div>
												<div class="tab-pane fade <?= $is_satker_tab ? 'active show' : '' ?> shipping-wizard" id="payment-wizard" role="tabpanel" aria-labelledby="payment-wizard-tab">
													<h6>Satuan Kerja Information</h6>
													<p class="f-light">Tabel daftar satuan kerja</p>
													<?= $this->load->component('table_satker') ?>
												</div>
												<div class="tab-pane fade <?= $is_pengaturan_tab ? 'active show' : '' ?> shipping-wizard finish-wizard1" id="finish-wizard" role="tabpanel" aria-labelledby="finish-wizard-tab">
													<?= $this->load->component('table_pengaturan') ?>
												</div>
											</div>
										</div>
										<div class="col-xl-4">
											<?= $form ?>
											<?php if (!empty(array_keys($_GET))) { ?>
												<a class="text-danger" href="<?= base_url('/settings') ?>">Batalkan</a>
											<?php } ?>
										</div>
									</div>
								</div>
								<!-- Container-fluid Ends-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>