<div class="page-body">
	<?= $this->load->component('page_title', compact('breadcumb', 'page_name')) ?>
	<div class="container-fluid">
		<div class="row starter-main">
			<div class="col-sm-12">
				<?= $this->session->flashdata("flash_alert") ?>
				<?= $this->session->flashdata("flash_error") ?>
				<div class="card">
					<div class="card-header">
						<h5>Daftar Pengajuan Administrasi</h5>
						<div class="text-end">

							<a href="<?= base_url('referensi/add_pengajuan') ?>" class="btn btn-primary">Tambah Pengajuan <i class="fa fa-plus"></i>
							</a>

						</div>
						<div class="card-header-right">
							<ul class="list-unstyled card-option">
								<li><i class="fa fa-spin fa-cog"></i></li>
								<li><i class="view-html fa fa-code"></i></li>
								<li><i class="icofont icofont-maximize full-card"></i></li>
								<li><i class="icofont icofont-minus minimize-card"></i></li>
								<li><i class="icofont icofont-refresh reload-card"></i></li>
								<li><i class="icofont icofont-error close-card"></i></li>
							</ul>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="display table table-hover" id="table-pegawai">
								<thead>
									<tr class="text-center">
										<th>No</th>
										<th>Jenis Pengajuan</th>

										<th>Deskripsi</th>
										<th>Requirement</th>
										<th>Persyaratan</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($pengajuan as $k => $p) { ?>
										<tr>
											<td><?= ++$k ?></td>
											<td><?= $p->nama_pengajuan ?></td>
											<td><?= $p->deskripsi ?></td>
											<td>
												<a href="<?= base_url("/referensi/req_pengajuan/" . $p->id) ?>" class="btn btn-light">Atur</i></a>
											</td>
											<td><?= $p->persyaratan_text ?></td>
											<td>
												<input class="tgl tgl-skewed" id="cb3" type="checkbox" <?= ($p->status == 1) ? "checked" : "" ?>>
												<label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="cb3"></label>
											</td>
											<td>
												<ul class="action" style="list-style-type: none;">
													<li class="edit"> <a href="<?= base_url("/referensi/edit_pengajuan/" . $p->id) ?>"><i class="icon-pencil-alt"></i></a></li>
													<li class="delete"><a href="javascript:void(0)" onclick="confirmDelete(<?= $p->id ?>)"><i class="icon-trash"></i></a></li>
												</ul>
											</td>
										</tr>
									<?php } ?>
								</tbody>

							</table>
						</div>
					</div>
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

			fetch("<?= base_url('/referensi/hapus_pengajuan/') ?>" + id, {
					method: "POST"
				}).then(res => {
					if (!res.ok) {
						throw new Error(res.statusText)
					}
					return res.text()
				})
				.then(res => {
					Swal.fire("Pegawai berhasil dihapus").then(() => location.reload());
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