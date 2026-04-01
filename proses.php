<?php
include "db.php";

$nis = $_POST['nis'];
$id_kategori = $_POST['id_kategori'];
$lokasi = $_POST['lokasi'];
$ket = $_POST['ket'];

// 1️⃣ Cek apakah NIS terdaftar
$cek_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis'");

if(mysqli_num_rows($cek_siswa) == 0){
    echo "<script>
            alert('NIS tidak terdaftar! Silakan daftar terlebih dahulu.');
            window.location='index.php';
          </script>";
    exit;
}

// 2️⃣ Simpan ke input_aspirasi
mysqli_query($conn, "INSERT INTO input_aspirasi
(nis, id_kategori, lokasi, ket)
VALUES ('$nis', '$id_kategori', '$lokasi', '$ket')");

// 3️⃣ Ambil id_pelaporan terakhir
$id_pelaporan = mysqli_insert_id($conn);

// 4️⃣ Simpan status awal ke tabel aspirasi
mysqli_query($conn, "INSERT INTO aspirasi
(status, id_pelaporan, feedback)
VALUES ('Menunggu', '$id_pelaporan', '')");

echo "<script>
        alert('Aspirasi berhasil dikirim!');
        window.location='index.php';
      </script>";
?>