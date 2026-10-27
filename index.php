<?php
$nama = $email = $nilai = "";
$status = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama  = trim($_POST["nama"]);
    $email = trim($_POST["email"]);
    $nilai = $_POST["nilai"];

    // Validasi
    if ($nama == "" || $email == "" || $nilai === "") {
        $error = "Semua field wajib diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } elseif (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
        $error = "Nilai harus berupa angka 0-100!";
    } else {
        // STRUKTUR KENDALI
        if ($nilai > 70) {
            $status = "Lulus";
        } elseif ($nilai < 70) {
            $status = "Remedial";
        } else {
            $status = "Lulus"; // nilai tepat 70
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nilai Ujian</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f4f8; display: flex; justify-content: center; padding: 40px; }
        .box { background: #fff; padding: 25px; border-radius: 10px; width: 350px; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        input { width: 100%; padding: 8px; margin: 5px 0 15px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #2563eb; color: #fff; border: 0; border-radius: 5px; cursor: pointer; }
        .error { color: #b91c1c; margin-bottom: 10px; }
        .hasil { margin-top: 20px; padding: 15px; background: #eef2ff; border-radius: 8px; }
        .Lulus { color: green; font-weight: bold; }
        .Remedial { color: red; font-weight: bold; }
    </style>
</head>
<body>
<div class="box">
    <h2>Form Nilai Ujian</h2>

    <?php if ($error != ""): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>">

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>">

        <label>Nilai Ujian</label>
        <input type="number" name="nilai" min="0" max="100" value="<?= htmlspecialchars($nilai) ?>">

        <button type="submit">Kirim</button>
    </form>

    <?php if ($status != ""): ?>
        <div class="hasil">
            <p><b>Nama:</b> <?= htmlspecialchars($nama) ?></p>
            <p><b>Email:</b> <?= htmlspecialchars($email) ?></p>
            <p><b>Nilai:</b> <?= htmlspecialchars($nilai) ?></p>
            <p><b>Status:</b> <span class="<?= $status ?>"><?= $status ?></span></p>
        </div>
    <?php endif; ?>
</div>
</body>
</html>