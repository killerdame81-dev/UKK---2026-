<?php
session_start();

// Hapus semua session
session_destroy();

// Kembali ke login
header("Location: login.php");
exit;
?>