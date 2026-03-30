<?php
session_start();
include "db.php";

if(!isset($_SESSION['status_login'])){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, "
SELECT * FROM input_aspirasi
JOIN siswa ON input_aspirasi.nis = siswa.nis
JOIN kategori ON input_aspirasi.id_kategori = kategori.id_kategori
JOIN aspirasi ON input_aspirasi.id_pelaporan = aspirasi.id_pelaporan
WHERE input_aspirasi.id_pelaporan = '$id'
");

$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Detail Aspirasi</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<div class="top-bar">
    
    <a href="dashboard.php" class="btn-back">← Kembali</a>
</div>

<div class="card-detail">

<p><strong>Nama Siswa:</strong> <?php echo $data['nama']; ?></p>
</div>

</div>

</body>
</html>