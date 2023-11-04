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
								<form class="theme-form" method="POST" autocomplete="off" action="<?= base_url('setup/init_db') ?>">
									<h4>Unlock </h4>
									<div class="form-group">
										<label class="col-form-label">Masukan Password untuk memulai pemasangan database</label>
										<div class="form-input position-relative">
											<input class="form-control" type="password" name="login[password]" required="" placeholder="*********">
											<div class="show-hide"><span class="show"> </span></div>
										</div>
									</div>
									<div class="form-group mb-0">
										<div class="alert alert-light-secondary" role="alert">
											<h5 class="alert-heading pb-2 txt-secondary">Kebijakan</h5>
											<p>Saya memahami dan bertanggung jawab atas aksi yang akan di eksekusi setelah ini.</p>
											<hr>
											<p class="mb-0">Developer tidak bertanggung jawab jika ada data yang terhapus.</p>
											<div class="checkbox p-0">
												<input name="login[setuju]" id="checkbox1" type="checkbox" required>
												<label class="text-muted" for="checkbox1">Saya Setuju</label>
											</div>
										</div>

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