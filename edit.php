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
JOIN aspirasi ON input_aspirasi.id_pelaporan = aspirasi.id_pelaporan
WHERE input_aspirasi.id_pelaporan = '$id'
");

$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Aspirasi</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<div class="top-bar">
    <h2>Edit Aspirasi</h2>
    <a href="dashboard.php" class="btn-back" style="padding: 20px 10px;">← Kembali</a>
</div>

<form method="POST">

    <label>Status</label>
    <select name="status" required>
        <option value="Menunggu" <?php if($data['status']=='Menunggu') echo "selected"; ?>>Menunggu</option>
        <option value="Proses" <?php if($data['status']=='Proses') echo "selected"; ?>>Proses</option>
        <option value="Selesai" <?php if($data['status']=='Selesai') echo "selected"; ?>>Selesai</option>
    </select>

    <label>Feedback</label>
    <textarea name="feedback" required><?php echo $data['feedback']; ?></textarea>

    <button type="submit" name="update">Update</button>

</form>

</div>

</body>
</html>

<?php
if(isset($_POST['update'])){
    $status = $_POST['status'];
    $feedback = $_POST['feedback'];

    mysqli_query($conn, "
    UPDATE aspirasi 
    SET status='$status', feedback='$feedback'
    WHERE id_pelaporan='$id'
    ");

    echo "<script>
            alert('Data berhasil diupdate');
            window.location='dashboard.php';
          </script>";
}
?>