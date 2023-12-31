<div class="page-body">
	<?= $this->load->component('page_title', compact('breadcumb', 'page_name')) ?>
	<div class="container-fluid">
		<div class="row starter-main">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5>Daftar Pegawai</h5>
						<div class="text-end">

							<a href="<?= base_url('referensi/add_pegawai?satker=' . R_Input::gett('satker')) ?>" class="btn btn-primary">Tambah Pegawai <i class="fa fa-plus"></i>
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
							<table class="display" id="table-pegawai">
								<thead>
									<tr>
										<th rowspan="2">Nama</th>
										<th colspan="5">Information</th>

									</tr>
									<tr>
										<th>NIP</th>
										<th>Jabatan</th>
										<th>Pangkat</th>
										<th>Status</th>
										<th>Foto</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody></tbody>

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
	window.onload = () => {

		$("#table-pegawai").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?= base_url("/referensi/pegawai_datatable_api/" . $satker->id) ?>",
				"type": "POST"
			},
			"columns": [{
					"data": "nama"
				},
				{
					"data": "nip"
				},
				{
					"data": "jabatan"
				},
				{
					"data": "pangkat"
				},
				{
					"data": "status"
				},
				{
					"data": "foto"
				},
				{
					"data": "action"
				},
			],
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

			fetch("<?= base_url('/referensi/hapus_pegawai/') ?>" + id, {
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

	function showPassFoto(id) {
		Swal.fire({
			title: "Mohon Tunggu",
			willOpen: () => Swal.showLoading(),
			allowOutsideClick: false,
			showConfirmButton: false,
			backDrop: false,
		})

		fetch("<?= base_url('/referensi/pass_foto/') ?>" + id).then(res => {
				if (!res.ok) {
					throw new Error(res.statusText)
				}
				return res.text()
			})
			.then(res => {
				Swal.fire({
					imageUrl: "<?= base_url() ?>" + res,
					// imageHeight: 1500,
					imageAlt: "Pass Foto Pegawai"
				});

			})
			.catch(err => {
				console.log(err)
				Swal.fire({
					title: err.message,
					icon: "error"
				})
			})
	}
</script>