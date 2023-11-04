<?php

class Setup extends CI_Controller
{

	public $flash_message = "";

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->page('setup', [
			'page_name' => 'Setup'
		])->layout('auth_layout');
	}

	private function auth()
	{
		$password = '$2y$10$4avh1k37XsjEyMLili7imeX7.mzBgxTvOrvnCoQJvzy1BmwSZaNMe';
		$salt = 'openParse';
		if (!password_verify(R_Input::pos('login')['password'] . $salt, $password)) {

			$this->session->set_flashdata('flash_alert', $this->load->component('flash_alert', [
				'mesg' => 'Terjadi Kesalahan', 'text' => 'Password Salah', 'type' => 'secondary'
			]));

			redirect(base_url('setup'));
		}
	}

	public function init_db()
	{
		R_Input::mustPost();

		if (!isset($_SERVER['HTTP_REFERER'])) {
			redirect(base_url('setup'));
		}


		if ($_SERVER['HTTP_REFERER'] != base_url('setup')) {
			redirect(base_url('setup'));
		}

		$this->auth();

		$this->load->page('init_db', [
			'page_name' => 'Setup DB'
		])->layout('auth_layout');
	}

	public function start_init()
	{
		R_Input::mustPost();

		if (!isset($_SERVER['HTTP_REFERER'])) {
			redirect(base_url('setup'));
		}

		if ($_SERVER['HTTP_REFERER'] != base_url('setup/init_db')) {
			redirect(base_url('setup'));
		}

		try {
			$this->CreateDB();

			$this->InitFile();

			$this->Migrate();

			$this->Seed();
		} catch (\Throwable $th) {
			throw $th;
		}

		$this->session->set_flashdata('flash_alert', $this->load->component('flash_alert', [
			'mesg' => 'Notifikasi Inisialisasi Database',
			'text' => $this->flash_message,
			'type' => 'success'
		]));
		redirect('/setup');
	}

	private function Migrate()
	{
		R_Input::mustPost();

		$this->load->library('migration');
		if ($this->migration->current() === FALSE) {
			throw new Error($this->migration->error_string());
		}

		$this->flash_message .= "Migrate Success <br>";
	}

	private function Seed()
	{
		UserEntity::create([
			'identifier' => 'dev_siadnan',
			'password' => password_hash('tampan_dan_berani' . 'sd9Lk0Rh', PASSWORD_BCRYPT),
			'status' => 1,
			'level' => 1,
			'salt' => 'sd9Lk0Rh',
			'profileId' => 1,
			'createdAt' => date('Y-m-d H:i:s'),
			'updatedAt' => date('Y-m-d H:i:s'),
		]);

		UserEntity::create([
			'identifier' => 'admin_siadnan',
			'password' => password_hash('youmaywantthis' . 'Djl8mk20', PASSWORD_BCRYPT),
			'status' => 1,
			'level' => 2,
			'salt' => 'Djl8mk20',
			'profileId' => 2,
			'createdAt' => date('Y-m-d H:i:s'),
			'updatedAt' => date('Y-m-d H:i:s'),
		]);

		ProfileEntity::create([
			'namaLengkap' => 'Imal Maulana 😎',
			'nomorTelepon' => '6289636811489',
			'email' => 'imal@gmail.com',
			'avatar' => '',
			'pegawaiId' => 1,
			'createdAt' => date('Y-m-d H:i:s'),
			'updatedAt' => date('Y-m-d H:i:s'),
		]);

		ProfileEntity::create([
			'namaLengkap' => 'Cut Muthia Andini 👩🏻‍🦰',
			'nomorTelepon' => '6289636811489',
			'email' => 'andini@gmail.com',
			'avatar' => '',
			'pegawaiId' => 0,
			'createdAt' => date('Y-m-d H:i:s'),
			'updatedAt' => date('Y-m-d H:i:s'),
		]);

		PengaturanEntity::create([
			'variabel' => 'ptb',
			'value' => 'PENGADILAN TINGGI AGMA DKI JAKARTA 🏢',
			'keterangan' => 'Nama Pengadilan Tingkat Banding',
			'createdAt' => date('Y-m-d H:i:s'),
			'updatedAt' => date('Y-m-d H:i:s')
		]);

		SatkerEntity::create([
			'namaSatker' => 'PENGADILAN AGAMA JAKARTA UTARA',
			'kodeSatker' => '400622',
			'teleponSatker' => '02143934701',
			'emailSatker' => 'sekretariat.pajakartautara@gmail.com',
			'logoSatker' => 'paju.png',
			'createdAt' => date('Y-m-d H:i:s'),
			'updatedAt' => date('Y-m-d H:i:s'),
		]);

		$this->flash_message .= "Seeder Success <br>";
	}

	private function CreateDB()
	{
		$mysql = new mysqli(R_Input::pos('db_host'), R_Input::pos('db_user'), R_Input::pos('db_pass') == ' ' ? null : R_Input::pos('db_pass'));

		if ($mysql->connect_error) {
			throw new Error("Gagal konek db host :" . $mysql->connect_error);
		}

		$name = R_Input::pos('db_name');

		$mysql->query("DROP DATABASE IF EXISTS $name");

		if (!$mysql->query("CREATE DATABASE $name")) {
			throw new Error("Gagal create db");
		}

		$mysql->close();
	}

	private function InitFile()
	{
		$db_host = R_Input::pos('db_host');
		$db_name = R_Input::pos('db_name');
		$db_user = R_Input::pos('db_user');
		$db_pass = R_Input::pos('db_pass') == ' ' ? '' : R_Input::pos('db_pass');

		$resModDbFile = $this->RunGoHelper("--do=init_db --db_host=$db_host --db_name=$db_name --db_user=$db_user --db_pass=$db_pass");

		$resModAutoload = $this->RunGoHelper("--do=auto_db");

		$this->flash_message .= $resModDbFile . '<br>' . $resModAutoload . '<br>';
	}

	function RunGoHelper($par = null)
	{
		$path = str_replace('\\', '/', FCPATH) . "go_helper";
		$gofile = $path . "/go_helper_" . $this->OsType();

		// if ($this->OsType() != "WINNT") {
		// 	$gofile = "sudo " . $gofile;
		// }

		$proc = proc_open(
			"cd $path && $gofile $par",
			[['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']],
			$pipes,
		);

		$result = "";

		foreach ($pipes as $pipe) {
			try {
				$result .= stream_get_contents($pipe);
			} catch (\Throwable $th) {
				//throw $th;
			}
		}

		proc_close($proc);
		return $result;
	}

	private function OsType()
	{
		switch (PHP_OS) {
			case 'WINNT':
				return 'win.exe';
				break;
			case 'Linux':
				return 'linux';
				break;
			default:
				return 'mac';
				break;
		}
	}

	public function assets()
	{
		$this->load->view('init_assets');
	}

	public function init_assets()
	{
		R_Input::mustPost();

		if (!isset($_SERVER['HTTP_REFERER'])) {
			redirect(base_url('setup/assets'));
		}

		$this->auth();

		$path = str_replace('\\', '/', FCPATH);

		$proc = proc_open(
			"cd $path && get_assets.sh",
			[['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']],
			$pipes,
		);


		foreach ($pipes as $pipe) {
			echo stream_get_contents($pipe) . '<br>';
		}

		proc_close($proc);

		$urlSetup = base_url('setup');

		echo "<h1>Jika running di windows. Open With Git</h1>";
		echo "<h1>Pastikan Ada Internet</h1>";
		echo "<a href=\"$urlSetup\">Lanjut Ke Setup DB</a>";
	}
}
