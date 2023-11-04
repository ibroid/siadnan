<?php

$user = $this->session->userdata('user_login');

?>

<div class="page-body">
	<?= $this->load->component('page_title', ['page_name' => $page_name, 'breadcumb' => $breadcumb]) ?>

	<div class="container-fluid">
		<?= $this->session->flashdata('flash_alert') ?>
		<?= $this->session->flashdata('flash_error') ?>
	</div>
	<div class="container-fluid">
		<div class="row started-main">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4>Vertical validation wizard </h4>
						<p class="f-m-light mt-1">
							Fill up your true details and next proceed.</p>
					</div>
					<div class="card-body">
						<div class="vertical-main-wizard">
							<div class="row g-3">
								<div class="col-xxl-3 col-xl-4 col-12">
									<div class="nav flex-column header-vertical-wizard" id="wizard-tab" role="tablist" aria-orientation="vertical">
										<a class="nav-link active" id="wizard-contact-tab" data-bs-toggle="pill" href="#wizard-contact" role="tab" aria-controls="wizard-contact" aria-selected="true">
											<div class="vertical-wizard">
												<div class="stroke-icon-wizard"><i class="fa fa-user"></i></div>
												<div class="vertical-wizard-content">
													<h6>Profile</h6>
													<p>Add your details </p>
												</div>
											</div>
										</a>
										<a class="nav-link" id="wizard-cart-tab" data-bs-toggle="pill" href="#wizard-cart" role="tab" aria-controls="wizard-cart" aria-selected="false" tabindex="-1">
											<div class="vertical-wizard">
												<div class="stroke-icon-wizard"><i class="fa fa-chain-broken"></i></div>
												<div class="vertical-wizard-content">
													<h6>Pegawai</h6>
													<p>Link data pegawai</p>
												</div>
											</div>
										</a>
									</div>
								</div>
								<div class="col-xxl-9 col-xl-8 col-12">
									<div class="tab-content" id="wizard-tabContent">
										<div class="tab-pane fade active show" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">

											<!-- 
												*
												* Form Edit Profile
												*
											 -->
											<form class="row g-3 needs-validation custom-input" novalidate="" autocomplete="off" method="POST" action="<?= base_url('profile/save') ?>">

												<div class="col-xxl-4 col-sm-6">
													<?= ProfileForm::input(
														'NamaLengkap',
														(object)[
															'min' => 3,
															'placeholder' =>
															'Masukan Nama Lengkap Anda ..',
															'value' => $user['profile']['nama_lengkap']
														]
													) ?>
												</div>

												<div class="col-xxl-4 col-sm-6">
													<?= ProfileForm::input(
														'NomorTelepon',
														(object)[
															'min' => 3,
															'placeholder' => 'Contoh : 6281xxxxx',
															'value' => $user['profile']['nomor_telepon']
														]
													) ?>
												</div>

												<div class="col-xxl-4 col-sm-6">
													<?= ProfileForm::input(
														'Email',
														(object)[
															'min' => 3,
															'placeholder' => 'myname@email.com',
															'value' => $user['profile']['email']
														]
													) ?>
												</div>

												<div class="col-xxl-4 col-sm-6">
													<label for="inputAvatar" class="form-label">Ketik Avatar Anda</label>
													<input name="avatar" value="<?= $user['profile']['avatar'] ?>" type="text" class="form-control" id="inputAvatar">
													<hr>
													<img id="imgAvatar" class="b-r-10" src="https://api.dicebear.com/7.x/adventurer/svg?size=128&backgroundColor=b6e3f4&seed=<?= $user['profile']['avatar'] ?>" alt="avatar" />
												</div>

												<div class="col-xxl-4 col-sm-6">
													<label for="inputIdentifier" class="form-label">Identifier</label>
													<input name="identifier" value="<?= $user['identifier'] ?>" disabled="true" type="text" class="form-control" id="inputIdentifier">
													<small class="text-danger">* Digunakan saat login</small>
												</div>

												<div class="col-xxl-4 col-sm-6 ">
													<label for="inputPassword" class="form-label">Password</label>
													<input minlength="8" name="login[password]" placeholder="********" disabled="true" type="password" class="form-control" id="inputPassword">
													<!-- <small class="text-danger">* Kosongkan Apabila tidak ingin merubah password</small> -->
													<div class="show-hide"><span class="show"> </span></div>
												</div>


												<div class="col-12">
													<div class="form-check">
														<input name="edit_cred" value="1" class="form-check-input" id="invalidCheck-n" type="checkbox">
														<label class="form-check-label" for="invalidCheck-n">Aktifkan Edit Identifier dan Password.</label>
													</div>
												</div>
												<div class="col-12 text-end">
													<button type="submit" class="btn btn-primary">Save</button>
												</div>
											</form>
										</div>

										<div class="tab-pane fade" id="wizard-cart" role="tabpanel" aria-labelledby="wizard-cart-tab">
											<form class="row g-3 needs-validation custom-input" novalidate="">
												<div class="col-xxl-6 col-sm-8">
													<label for="selectSatker">Satker Anda</label>
													<select class="form-select" required id="selectSatker" aria-label=".form-select-sm example">
														<option selected disabled>Pilih Satu </option>
														<?php foreach (SatkerEntity::all() as $satker) { ?>
															<option value="<?= $satker->id ?>"><?= $satker->nama_satker ?> </option>
														<?php } ?>
													</select>
												</div>

												<div class="col-xxl-6 col-sm-8">
													<label for="inputNamaPegawai">Ketik dan Pilih Nama Pegawai</label>
													<div id="prefetch">
														<input id="inputNamaPegawai" class="typeahead form-control" type="text" placeholder="Ketik Nama Anda" required>
														<small class="text-danger">*Jika nama anda tidak muncul. Hubungi Admin PTA</small>
													</div>
												</div>
												<div class="col-12 text-end">
													<!-- <button class="btn btn-primary">Previous</button> -->
													<button type="button" disabled="true" id="btnSavePegawaiId" class="btn btn-primary">Save</button>
												</div>
											</form>
										</div>
										<!-- <div class="tab-pane fade custom-input" id="wizard-banking" role="tabpanel" aria-labelledby="wizard-banking-tab">
											<form class="row g-3 mb-3 needs-validation" novalidate="">
												<div class="col-md-12">
													<div class="accordion dark-accordion" id="accordionExample-a">
														<div class="accordion-item">
															<h2 class="accordion-header" id="headingOne-a">
																<button class="accordion-button collapsed accordion-light-primary txt-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-a" aria-expanded="true" aria-controls="collapseOne-a">NET BANKING<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down svg-color">
																		<polyline points="6 9 12 15 18 9"></polyline>
																	</svg></button>
															</h2>
															<div class="accordion-collapse collapse" id="collapseOne-a" aria-labelledby="headingOne-a" data-bs-parent="#accordionExample-a">
																<div class="accordion-body weight-title card-wrapper">
																	<h6 class="sub-title f-14">SELECT YOUR BANK</h6>
																	<div class="row choose-bank">
																		<div class="col-sm-6">
																			<div class="form-check radio radio-primary">
																				<input class="form-check-input" id="flexRadioDefault-z" type="radio" name="flexRadioDefault-v">
																				<label class="form-check-label" for="flexRadioDefault-z">Industrial &amp; Commercial Bank</label>
																			</div>
																			<div class="form-check radio radio-primary">
																				<input class="form-check-input" id="flexRadioDefault-y" type="radio" name="flexRadioDefault-v">
																				<label class="form-check-label" for="flexRadioDefault-y">Agricultural Bank</label>
																			</div>
																			<div class="form-check radio radio-primary">
																				<input class="form-check-input" id="flexRadioDefault-x" type="radio" name="flexRadioDefault-v" checked="">
																				<label class="form-check-label" for="flexRadioDefault-x">JPMorgan Chase &amp; Co.</label>
																			</div>
																		</div>
																		<div class="col-sm-6">
																			<div class="form-check radio radio-primary">
																				<input class="form-check-input" id="flexRadioDefault-w" type="radio" name="flexRadioDefault-v">
																				<label class="form-check-label" for="flexRadioDefault-w">Construction Bank Corp.</label>
																			</div>
																			<div class="form-check radio radio-primary">
																				<input class="form-check-input" id="flexRadioDefault-v" type="radio" name="flexRadioDefault-v">
																				<label class="form-check-label" for="flexRadioDefault-v">Bank of America</label>
																			</div>
																			<div class="form-check radio radio-primary">
																				<input class="form-check-input" id="flexRadioDefault-u" type="radio" name="flexRadioDefault-v">
																				<label class="form-check-label" for="flexRadioDefault-u">HDFC Bank</label>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-12">
													<textarea class="form-control" id="validationTextarea24" placeholder="Your Feedback" required=""></textarea>
													<div class="invalid-feedback">Please enter a message in the textarea.</div>
												</div>
												<div class="col-12">
													<div class="form-check mb-0">
														<input class="form-check-input" id="invalidCheck67" type="checkbox" value="" required="">
														<label class="form-check-label mb-0" for="invalidCheck67">Agree to terms and conditions</label>
														<div class="invalid-feedback">You must agree before submitting.</div>
													</div>
												</div>
												<div class="col-12 text-end">
													<button class="btn btn-success">Finish</button>
												</div>
											</form>
										</div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	window.onload = () => {

		$("#invalidCheck-n").on("change", (e) => {
			console.log(e.target.checked)
			$("#inputPassword").attr('disabled', !e.target.checked)
			$("#inputIdentifier").attr('disabled', !e.target.checked)
		});

		$("#inputAvatar").on("input", (e) => {
			$("#imgAvatar").attr("src", "https://api.dicebear.com/7.x/adventurer/svg?size=128&backgroundColor=b6e3f4&seed=Ar" + e.target.value)
		})

		selectSatker = $("#selectSatker")
		inputNamaPegawai = $("#prefetch .typeahead")

		inputNamaPegawai.attr('disabled', true)

		selectSatker.on('change', (e) => {
			if (selectSatker.val() == null) {
				inputNamaPegawai.attr('disabled', true)
			} else {
				inputNamaPegawai.attr('disabled', false)
			}

			initTypeahead(selectSatker.val())
		})

		function initTypeahead(id) {
			var pegawai = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace("value"),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				remote: {
					url: `<?= base_url('pegawai/type_suggest') ?>?query=%QUERY&satker_id=${id}`,
					wildcard: "%QUERY",
				},
			});

			inputNamaPegawai.typeahead(null, {
				name: 'pegawai',
				source: pegawai,
				display: 'nama_lengkap'
			});
		}

		var bodySelectPegawai = new FormData()

		inputNamaPegawai.on("typeahead:select", (e, selection) => {
			bodySelectPegawai.append('pegawai_id', selection.id);
			if (selection.id != null) {
				$("#btnSavePegawaiId").attr('disabled', false)
			}
		})

		$("#btnSavePegawaiId").on('click', (e) => {
			$("#btnSavePegawaiId").attr('disabled', true)
			$("#btnSavePegawaiId").text('Mohon Tunggu')

			$.ajax({
				url: "<?= base_url('/profile/set_pegawai') ?>",
				method: "POST",
				data: bodySelectPegawai,
				processData: false,
				contentType: false,
				success(data) {
					console.log(data)
				},
				error() {
					alert(error.messsage)
				},
				complete() {
					$("#btnSavePegawaiId").attr('disabled', false)
					$("#btnSavePegawaiId").text('Save')
					location.reload()
				}
			})
		})

	}
</script>