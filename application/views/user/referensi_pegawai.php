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

<script>
	window.onload = () => {
		$("#table-pegawai").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/referensi/pegawai_datatable",
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
			],
		})
	}
</script>