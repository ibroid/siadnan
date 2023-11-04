<div class="page-wrapper">
	<div class="container-fluid p-0">
		<!-- Unlock page start-->
		<div class="authentication-main mt-0">
			<div class="row">
				<div class="col-12">
					<div class="login-card login-dark">
						<div>
							<div class="alert alert-light-primary" role="alert">
								<h5 class="alert-heading pb-2 txt-primary">Mohon Perhatian</h5>
								<p>Halaman ini adalah halaman untuk membuat database dan tabel yang akan digunakan aplikasi ini. Sebaiknya aksi ini dilakukan saat aplikasi pertama kali di pasang</p>
								<hr>
								<p class="mb-0">Jika anda melakukan aksi ini untuk kedua kali nya, maka data yang sudah ada pada database akan hilang.</p>
							</div>
							<?= $this->session->flashdata('flash_alert') ?>
							<div><a class="logo" href="index.html"><img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
							<div class="login-main">
								<form class="theme-form" method="POST" autocomplete="off" action="<?= base_url('setup/start_init') ?>">
									<h4>Database Initialize </h4>
									<div class="form-group">
										<label class="col-form-label">Host/Addreass Database</label>
										<div class="form-input position-relative">
											<input class="form-control" type="text" name="db_host" required placeholder="127.0.0.1">
										</div>
										<label class="col-form-label">Database Name</label>
										<div class="form-input position-relative">
											<input class="form-control" type="text" name="db_name" required placeholder="db_example">
										</div>
										<label class="col-form-label">Database User</label>
										<div class="form-input position-relative">
											<input class="form-control" type="text" name="db_user" required placeholder="root">
										</div>
										<label class="col-form-label">Database Password (isi dengan spasi apabila tidak menggunakan password)</label>
										<div class="form-input position-relative">
											<input class="form-control" type="text" name="db_pass" required placeholder="password">
										</div>
									</div>
									<div class="form-group mb-0">

										<button class="btn btn-primary btn-block w-100" type="submit">Start </button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>