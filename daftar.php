<?php
include "db.php";

if(isset($_POST['daftar'])){
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    // buat NIS otomatis (pakai waktu sekarang)
    $nis = date("His"); 

    mysqli_query($conn,"INSERT INTO siswa (nis,nama,kelas)
    VALUES ('$nis','$nama','$kelas')");

    echo "<script>
    alert('Pendaftaran berhasil! NIS kamu: $nis');
    window.location='index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Daftar Siswa</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-wrapper">
<div class="login-box">

<h2>Daftar Siswa Baru</h2>

<form method="POST">
<label>Nama</label>
<input type="text" name="nama" required>

<label>Kelas</label>
<input type="text" name="kelas" required>

<button type="submit" name="daftar">Daftar</button>
</form>

</div>
</div>

</body>
</html>