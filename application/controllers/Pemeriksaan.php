<?php

use Illuminate\Support\Collection;

require_once APPPATH . 'traits/PengaturanApi.php';
require_once APPPATH . 'traits/PengajuanApi.php';
require_once APPPATH . 'traits/PersyaratanPengajuanApi.php';

class Pemeriksaan extends R_Controller
{
	use PengaturanApi;
	use PengajuanApi;
	use PersyaratanPengajuanApi;

	public function __construct()
	{
		parent::__construct();
		$this->addons->init([
			'js' => [
				'<script src="' . base_url() . '/assets/js/form-validation-custom.js"></script>' . "\n",
				'<script src="' . base_url() . '/assets/js/typeahead/handlebars.js"></script>' . "\n",
				'<script src="' . base_url() . '/assets/js/typeahead/typeahead.bundle.js"></script>' . "\n",
				'<script src="' . base_url() . '/assets/js/flat-pickr/flatpickr.js"></script>' . "\n",
				'<script>flatpickr(".datetime-local", {});</script>' . "\n"
			],
			'css' => [
				'<link rel="stylesheet" type="text/css" href="' . base_url() . '/assets/css/vendors/flatpickr/flatpickr.min.css">' . "\n"
			]
		]);
	}

	public function index()
	{

		$this->load->page('pemeriksaan/daftar_pengajuan', [
			'pengaturan' => $this->plucking_pengaturan(),
			'pengajuan' => $this->getPengajuan(),
			'breadcumb' => 'Pemeriksaan',
			'page_name' => 'Pemeriksaan Pengajuan'
		])->layout('dashboard_layout');
	}

	public function berkas($id = null)
	{
		if ($id == null) {
			set_status_header(404);
			exit;
		}

		try {
			$pengajuan = $this->getPengajuan($id);

			if ($pengajuan->persyaratan_pengajuan->count() == 0) {
				throw new Exception("Admin satuan kerja belum melengkapi berkas untuk pegawai ini", 400);
			}

			$this->load->page('pemeriksaan/berkas', [
				'breadcumb' => 'Pemeriksaan / ' . str_replace("Pengajuan", "", $pengajuan->pengajuan->nama_pengajuan) . " / " . $pengajuan->pegawai->nama_lengkap,
				'page_name' => 'Pemeriksaan ' . $pengajuan->pengajuan->nama_pengajuan . " " . $pengajuan->pegawai->nama_lengkap,
				// 'persyaratan_pengajuan' => $this->findPersyaratanPengajuanWhere(["pengajuan_id" => $id])->get()
				'pengajuan' => $pengajuan,
			])->layout('dashboard_layout');
		} catch (\Throwable $th) {

			Redirect::wfe($th->getMessage())->go($_SERVER['HTTP_REFERER']);
		}
	}

	public function save_resp_persyaratan()
	{
		R_Input::mustPost();

		try {
			$data = [
				"tanggal_diperiksa" => R_Input::pos("tanggal_diperiksa") == null ? date("Y-m-d") : R_Input::pos("tanggal_diperiksa"),
				"status" => R_Input::pos("status"),
				"catatan" => R_Input::pos("catatan")
			];

			$pp = $this->updatePersyaratanPengajuan(R_Input::pos("id"), $data);

			$this->session->set_userdata("riwayat_pemeriksaan_berkas", [[
				"persyaratan" => $pp->persyaratan->persyaratan,
				"status" => $pp->status == 1 ? "Diterima" : "Ditolak",
				"catatan" => $pp->catatan
			], ...($this->session->userdata("riwayat_pemeriksaan_berkas") ?? [])]);

			Redirect::wfa([
				"mesg" => "Berhasil Menyimpan Respon",
				"text" => "Pastikan anda memerhatikan riwayat pemeriksaan berkas",
				"type" => "success",
			])->go($_SERVER["HTTP_REFERER"]);
		} catch (\Exception $th) {

			Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
		}
	}

	public function done($id)
	{
		try {
			// throw new Exception("Fungsi ini sedang maintenance", 1);

			$pengajuan = $this->getPengajuan($id);

			$berkasDiperiksa = collect($this->session->userdata("riwayat_pemeriksaan_berkas"));

			$ditolakFiltered = $berkasDiperiksa->firstWhere("status", "Ditolak");

			if ($ditolakFiltered) {
				$pengajuan->update(["status" => 3]);
			} else {
				$pengajuan->update(["status" => 4]);
			}

			$this->session->unset_userdata("riwayat_pemeriksaan_berkas");
			Redirect::wfa([
				"mesg" => "Pemeriksaan Berhasil",
				"text" => "",
				"type" => "success",
			])->go("/pemeriksaan");
		} catch (\Throwable $th) {

			Redirect::wfe($th->getMessage())->go("/pemeriksaan");
		}
	}

	public function dikabulkan()
	{
		R_Input::mustPost();

		try {

			$pengajuan = $this->getPengajuan(R_Input::pos("id"));

			$pengajuan->update([
				"status" => 4,
				"asesor" => R_Input::pos("asesor"),
				"tanggal_ditinjau" => R_Input::pos("tanggal_ditinjau") == null ? date("Y-m-d") : R_Input::pos("tanggal_ditinjau"),
				"surat_keputusan" => $this->uploadPengajuanSuratKeputusan("surat_keputusan")
			]);


			Redirect::wfa([
				"mesg" => "Pemeriksaan Berhasil",
				"text" => "",
				"type" => "success",
			])->go("/pemeriksaan");
		} catch (\Throwable $th) {

			Redirect::wfe($th->getMessage())->go("/pemeriksaan");
		}
	}

	public function pembatalan($id = null)
	{
		try {
			$pengajuan = $this->getPengajuan($id);
			$deleteFile = $this->hapusSKPengabulan($pengajuan->surat_keputusan);
			$pengajuan->update(
				[
					"surat_keputusan" => "",
					"asesor" => "",
					"tanggal_ditinjau" => NULL,
					"status" => 3,
				]
			);

			$this->session->set_flashdata("flash_alert", $this->load->component("flash_alert", [
				"text" => $deleteFile ? "File SK Berhasil dihapus" : "Terjadi kesalahan saat menghapus file SK dari server",
				"mesg" => "Pengabulan dibatalkan",
				"type" => "success"
			]));

			echo json_encode(["message" => "Berhasil"]);
		} catch (\Throwable $th) {
			$this->session->set_flashdata("flash_error", $this->load->component("flash_alert", [
				"mesg" => $th->getMessage(),
				"text" => "Terjadi kesalahaan saat membatalkan pengabulan",
				"type" => "secondary"
			]));

			// set_status_header(400);
			echo json_encode(["message" => $th->getMessage()]);
		}
	}

	public function batalkan_berkas($id)
	{
		try {
			$pp = $this->findPersyaratanPengajuan($id);
			$pp->update([
				"tanggal_diperiksa" => NULL,
				"status" => NULL,
				"catatan" => NULL
			]);

			redirect($_SERVER["HTTP_REFERER"]);
		} catch (\Throwable $th) {
			//throw $th;
			Redirect::wfe($th->getMessage())->go($_SERVER["HTTP_REFERER"]);
		}
	}
}
