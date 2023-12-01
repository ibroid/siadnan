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
		if (is_dir("./assets")) {
			$this->load->page('/setup', [
				'page_name' => '/setup'
			])->layout('auth_layout');
		} else {
			$this->assets();
		}
	}

	private function auth()
	{
		$password = '$2y$10$4avh1k37XsjEyMLili7imeX7.mzBgxTvOrvnCoQJvzy1BmwSZaNMe';
		$salt = 'openParse';
		if (!password_verify(R_Input::pos('login')['password'] . $salt, $password)) {

			$this->session->set_flashdata('flash_alert', $this->load->component('flash_alert', [
				'mesg' => 'Terjadi Kesalahan',
				'text' => 'Password Salah',
				'type' => 'secondary'
			]));

			redirect(base_url('/setup'));
		}
	}

	public function init_db()
	{
		R_Input::mustPost();

		if (!isset($_SERVER['HTTP_REFERER'])) {
			redirect(base_url('/setup'));
		}


		if ($_SERVER['HTTP_REFERER'] != base_url('/setup')) {
			redirect(base_url('/setup'));
		}

		$this->auth();

		$this->load->page('init_db', [
			'page_name' => 'Setup DB',
			'password' => R_Input::pos('login')['password']
		])->layout('auth_layout');
	}

	public function start_init()
	{
		R_Input::mustPost();

		if (!isset($_SERVER['HTTP_REFERER'])) {
			redirect(base_url('/setup'));
		}

		if ($_SERVER['HTTP_REFERER'] != base_url('setup/init_db')) {
			redirect(base_url('/setup'));
		}

		try {
			$this->CreateDB();

			$this->InitFile();

			$this->load->database();
			$this->load->library('EloquentDatabase', null, 'ed');

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

		// $resModAutoload = $this->RunGoHelper("--do=auto_db");

		$this->flash_message .= $resModDbFile . '<br>'; # . $resModAutoload . '<br>';
	}

	function RunGoHelper($par = null)
	{
		$path = str_replace('\\', '/', FCPATH) . "go_helper";
		$gofile = $path . "/go_helper_" . $this->OsType();

		// if ($this->OsType() != "WINNT") {
		// 	$gofile = "sudo " . $gofile;
		// }

		$proc = proc_open(
			"cd $path && $gofile $par --pass=" . R_Input::pos('login')['password'],
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
		switch (R_Input::pos('method')) {
			case 'direct':
				$this->init_assets_direct();
				break;
			case 'go_helper':
				$this->init_assets_go_helper();
				break;

			default:
				$this->init_assets_shell();
				break;
		}
	}

	private function init_assets_shell()
	{
		R_Input::mustPost();
		$path = str_replace('\\', '/', FCPATH);

		$link_assets = $this->RunGoHelper("--do=link_assets");
		$bash = "mkdir ./assets && cd assets && curl -sS $link_assets > assets.zip && unzip assets.zip && rm assets.zip";

		$proc = proc_open(
			$bash,
			[['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']],
			$pipes,
		);


		foreach ($pipes as $pipe) {
			echo stream_get_contents($pipe) . '<br>';
		}

		proc_close($proc);

		$urlSetup = base_url('/setup');

		echo "<h1>Jika anda di windows. Silahkan copy script di bawah lalu paste di Git Bash Windows. Pastikan Git Bash dibuka di folder aplikasi</h1>";
		echo "<h3>Pastikan Ada Internet</h3>";
		echo $bash . '<br>';
		echo "<img src='/uploads/git_tutorial.png' src='git_turorial.png' /><br>";
		echo "<img src='/uploads/git_tutorial_2.png' src='git_turorial_2.png' /><br>";
		// echo "<a href=\"$urlSetup\">Lanjut Ke Setup DB</a>";
	}

	private function init_assets_direct()
	{
		$root = str_replace('\\', '/', FCPATH);

		$link_assets = $this->RunGoHelper("--do=link_assets");
		// prindie($link_assets);

		$zipFileName = 'assets.zip';

		$downloadPath = $root . $zipFileName;

		$extractPath = './assets';

		try {

			$ch = curl_init();

			$fp = fopen("assets.zip", 'w+');

			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			// curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_URL, $link_assets);

			$out = curl_exec($ch);

			curl_close($ch);
			fwrite($fp, $out);
			fclose($fp);
		} catch (\Throwable $th) {
			unlink($root . "assets");
			throw $th;
		}

		$zip = new ZipArchive;
		if ($zip->open($downloadPath) === TRUE) {
			$zip->extractTo($extractPath);
			$zip->close();
			echo 'File ZIP berhasil diekstrak. <a href="/setup">Kembali</a>';
		} else {
			echo 'Gagal mengekstrak file ZIP.';
		}
	}

	private function init_assets_go_helper()
	{
		try {
			$res = $this->RunGoHelper("--do=download_assets");
			echo $res;
			echo "<br>";
			echo '<h1>Assets berhasil dipasang.</h1> <a href="/setup">Kembali</a>';
		} catch (\Throwable $th) {
			throw $th;
		}
	}

	private function Seed()
	{
		EloquentDatabase::table('user')->insert([
			[
				'identifier' => 'dev_siadnan',
				'password' => password_hash('tampan_dan_berani' . 'sd9Lk0Rh', PASSWORD_BCRYPT),
				'status' => 1,
				'level' => 1,
				'salt' => 'sd9Lk0Rh',
				'profile_id' => 1,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			],
			[
				'identifier' => 'admin_siadnan',
				'password' => password_hash('ptadkijakarta' . 'Djl8mk20', PASSWORD_BCRYPT),
				'status' => 1,
				'level' => 2,
				'salt' => 'Djl8mk20',
				'profile_id' => 2,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			]
		]);

		EloquentDatabase::table('profile')->insert(
			[
				[
					'nama_lengkap' => 'Imal Maulana',
					'nomor_telepon' => '6289636811489',
					'email' => 'imal@gmail.com',
					'avatar' => '',
					'pegawai_id' => 1,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				],
				[
					'nama_lengkap' => 'Cut Muthia Andini',
					'nomor_telepon' => '6289636811489',
					'email' => 'andini@gmail.com',
					'avatar' => '',
					'pegawai_id' => 0,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				],
			]
		);

		EloquentDatabase::table('pengaturan')->insert([
			[
				'variabel' => 'ptb',
				'value' => 'PENGADILAN TINGGI AGMA DKI JAKARTA',
				'keterangan' => 'Nama Pengadilan Tingkat Banding',
				'type' => 'text',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			],
		]);

		EloquentDatabase::table('satker')->insert([
			[
				'nama_satker' => 'PENGADILAN AGAMA JAKARTA UTARA',
				'kode_satker' => '400622',
				'telepon_satker' => '02143934701',
				'email_satker' => 'sekretariat.pajakartautara@gmail.com',
				'logo_satker' => 'paju.png',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			],
		]);

		EloquentDatabase::table('pegawai')->insert([
			[
				'nama_lengkap' => 'Maulana Malik Ibrahim',
				'nip' => '000000000000',
				'jabatan' => 'PPNPN',
				'pangkat' => 'PPNPN',
				'satker_id' => 1,
				'picture' => 'nopic',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			]
		]);

		$this->flash_message .= "Seeder Success <br>";
	}
}
