<?php include "db.php"; ?> 
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Aspirasi Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1 class="title">Sistem Aspirasi Siswa</h1>

<div class="login-wrapper">
<div class="login-box"  style="padding-right: 35px;">

<h2>Kirim Aspirasi</h2>
<p class="subtitle">Suara kamu penting untuk perubahan</p>

<form method="POST" action="proses.php">

<label>NIS</label>
<input type="number" name="nis" required>
<small>Belum punya NIS? <a href="daftar.php">Daftar disini</a></small>

<label>Kategori</label>
<select name="id_kategori" required>
<option value="">-- Pilih Kategori --</option>
<?php
$kat = mysqli_query($conn,"SELECT * FROM kategori");
while($k = mysqli_fetch_array($kat)){
echo "<option value='$k[id_kategori]'>$k[ket_kategori]</option>";
}
?>
</select>

<label>Lokasi</label>
<input type="text" name="lokasi" required>

<label>Keterangan</label>
<textarea name="ket" required></textarea>

<button type="submit">Kirim Aspirasi</button>
<a href="lihat_status.php" class="btn-view">Lihat Status Aspirasi</a>

</form>
</div>
</div>

</body>
</html>