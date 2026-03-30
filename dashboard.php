<?php
session_start();
include "db.php";

if(!isset($_SESSION['status_login'])){
    header("Location: login.php");
    exit;
}

// FILTER TANGGAL
if(isset($_GET['tanggal']) && $_GET['tanggal'] != ''){
    $tgl = $_GET['tanggal'];

    $query = mysqli_query($conn, "
    SELECT * FROM input_aspirasi
    JOIN siswa ON input_aspirasi.nis = siswa.nis
    JOIN kategori ON input_aspirasi.id_kategori = kategori.id_kategori
    JOIN aspirasi ON input_aspirasi.id_pelaporan = aspirasi.id_pelaporan
    WHERE DATE(input_aspirasi.tanggal) = '$tgl'
    AND aspirasi.status != 'Selesai'
    ORDER BY input_aspirasi.tanggal DESC
    ");

}else{

    $query = mysqli_query($conn, "
    SELECT * FROM input_aspirasi
    JOIN siswa ON input_aspirasi.nis = siswa.nis
    JOIN kategori ON input_aspirasi.id_kategori = kategori.id_kategori
    JOIN aspirasi ON input_aspirasi.id_pelaporan = aspirasi.id_pelaporan
    WHERE aspirasi.status != 'Selesai'
    ORDER BY input_aspirasi.tanggal DESC
    ");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard Admin</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<!-- TOP BAR -->
<div class="top-bar">
    <a href="selesai.php" class="btn-back">Laporan Selesai</a>
    <a href="logout.php" class="btn-back">Logout</a>
</div>

<!-- FILTER -->
<form method="GET">
    <input type="date" name="tanggal" value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : '' ?>">
    <button type="submit">Filter</button>
    <a href="dashboard.php" class="btn-back">Reset</a>
    <a href="?tanggal=<?= date('Y-m-d') ?>" class="btn-back">Hari Ini</a>
</form>

<br>

<!-- TABEL -->
<table class="table">
<tr>
    <th>NIS</th>
    <th>Kategori</th>
    <th>Lokasi</th>
    <th>Keterangan</th>
    <th>Status</th>
    <th>Waktu Kirim</th>
    <th>Aksi</th>
</tr>

<?php while($data = mysqli_fetch_array($query)) { ?>

<tr onclick="window.location='detail.php?id=<?= $data['id_pelaporan']; ?>'">

    <td><?= $data['nis']; ?></td>
    <td><?= $data['ket_kategori']; ?></td>
    <td><?= $data['lokasi']; ?></td>
    <td><?= $data['ket']; ?></td>

    <td>
        <span class="badge <?= $data['status']; ?>">
            <?= $data['status']; ?>
        </span>
    </td>

    <td>
        <?= date('d-m-Y H:i', strtotime($data['tanggal'])); ?>
    </td>

    <td>
        <a href="edit.php?id=<?= $data['id_pelaporan']; ?>" class="btn-edit" onclick="event.stopPropagation();">
            Edit
        </a>
    </td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>