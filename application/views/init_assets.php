<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikawaii | Setup Assets</title>
</head>

<body>
    <center>
        <h1>Setup Assets</h1>
        <?= $this->session->userdata('flash_alert') ?>
        <form id="form-setup" action="<?= base_url('setup/init_assets') ?>" method="post">
            <h4>Masukan Password</h4>
            <label for="password"> Password</label>
            <input type="password" required name="login[password]" id="password" placeholder="*****">
            <br>
            <br>
            <h4>Pilih Metode Install</h4>
            <input required type="radio" name="method" value="direct">
            <label for="metthod">Direct</label><br>
            <i>Pastikan library php ZipArchive dan php CURL sudah enable</i><br><br>
            <input required type="radio" name="method" value="go_helper">
            <label for="metthod">Go Helper</label><br>
            <i>Direkomendasikan menggunakan metode ini</i><br><br>
            <input required type="radio" name="method" value="shell">
            <label for="metthod">Shell</label><br>
            <i>Pastikan sudah terinstall Git https://git-scm.com/downloads. Kecuali linux</i>
            <br>
            <br>
            <button>Install</button>
        </form>
        <h4>Cara Install Assets Manual</h4>
        <ul>
            <li>Buka folder aplikasi</li>
            <li>Open file get_assets_link.bat</li>
            <li>Masukan password lalu enter</li>
            <li>Copy lalu buka di browser</li>
            <li>Hasil download nya ekstrak ke folder assets di folder aplikasi</li>
        </ul>
        <br>
        <h1 id="notif"></h1>
    </center>
    <script>
        window.onload = () => {
            document.getElementById("form-setup").addEventListener('submit', () => {
                document.getElementById("notif").innerText = "MOHON TUNNGU :)"
            })
        }
    </script>

</body>

</html>