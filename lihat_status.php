<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Aspirasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-wrapper">
<div class="login-box">

<h2>Data Aspirasi</h2>

<?php

$query = mysqli_query($conn, "
SELECT * FROM input_aspirasi
JOIN aspirasi ON input_aspirasi.id_pelaporan = aspirasi.id_pelaporan
JOIN kategori ON input_aspirasi.id_kategori = kategori.id_kategori
ORDER BY input_aspirasi.tanggal DESC
");

if(mysqli_num_rows($query) == 0){
    echo "<p style='color:red;'>Belum ada data aspirasi.</p>";
} else {

    echo "<table class='table'>
            <tr>
                <th>NIS</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Feedback</th>
            </tr>";

    while($data = mysqli_fetch_array($query)){

        echo "<tr>
                <td>$data[nis]</td>
                <td>$data[ket_kategori]</td>
                <td>$data[lokasi]</td>
                <td>";

        echo "<span class='badge $data[status]'>$data[status]</span>";

        echo "</td>
                <td>";

        if(!empty($data['feedback'])){
            echo "<span style='color:green;'>Sudah Dibalas</span><br>";
            echo $data['feedback'];
        } else {
            echo "<span style='color:red;'>Belum ada feedback</span>";
        }

        echo "</td>
              </tr>";
    }

    echo "</table>";
}
?>

<br>
<a href="index.php" class="btn-back">← Kembali</a>

</div>
</div>

</body>
</html>