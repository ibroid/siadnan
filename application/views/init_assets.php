<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siadnan | Setup Assets</title>
</head>

<body>

    <form action="<?= base_url('setup/init_assets') ?>" method="post">
        <label for="password">Masukan Password</label>
        <input type="password" required name="login[password]" id="password" placeholder="*****">
        <button>Install</button>
    </form>

</body>

</html>