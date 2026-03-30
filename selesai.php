<?php
session_start();
include "db.php";

if(!isset($_SESSION['status_login'])){
    header("Location: login.php");
    exit;
}

$query = mysqli_query($conn, "
SELECT * FROM input_aspirasi
JOIN siswa ON input_aspirasi.nis = siswa.nis
JOIN kategori ON input_aspirasi.id_kategori = kategori.id_kategori
JOIN aspirasi ON input_aspirasi.id_pelaporan = aspirasi.id_pelaporan
WHERE aspirasi.status = 'Selesai'
ORDER BY input_aspirasi.tanggal DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Aspirasi Selesai</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<div class="top-bar">
    <h2>Data Aspirasi Selesai</h2>
    <a href="dashboard.php" class="btn-back">← Laporan Aktif</a>
</div>

<table class="table">
<tr>
    <th>NIS</th>
    <th>Kategori</th>
    <th>Lokasi</th>
    <th>Keterangan</th>
    <th>Status</th>
    <th>Feedback</th>
    <th>Waktu</th>
</tr>

<?php while($data = mysqli_fetch_array($query)) { ?>

<tr>
    <td><?php echo $data['nis']; ?></td>
    <td><?php echo $data['ket_kategori']; ?></td>
    <td><?php echo $data['lokasi']; ?></td>
    <td><?php echo $data['ket']; ?></td>

    <td>
        <span class="badge Selesai">
            <?php echo $data['status']; ?>
        </span>
    </td>

    <td><?php echo $data['feedback']; ?></td>

    <td>
        <?php echo date('d-m-Y H:i', strtotime($data['tanggal'])); ?>
    </td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>