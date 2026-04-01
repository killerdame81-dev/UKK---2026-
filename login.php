<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-box">
        <h2>Login Admin</h2>

        <form method="POST">
            <input type="text" name="user" placeholder="Username" required>
            <input type="password" name="pass" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</div>

</body>
</html>

<?php
if(isset($_POST['login'])){
    $user = mysqli_real_escape_string($conn,$_POST['user']);
    $pass = mysqli_real_escape_string($conn,$_POST['pass']);

    $cek = mysqli_query($conn,"SELECT * FROM admin 
        WHERE username='$user' 
        AND password='".MD5($pass)."'");

    if(mysqli_num_rows($cek) > 0){
        $_SESSION['status_login'] = true;
        header("Location: dashboard.php");
        exit;
    }else{
        echo "<script>alert('Username atau Password salah!')</script>";
    }
}
?>