<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $query = mysqli_query($koneksi,
    "SELECT * FROM users WHERE username='$user' AND password='$pass'");

    if(mysqli_num_rows($query) > 0){
        $data = mysqli_fetch_assoc($query);
        $_SESSION['user'] = $data;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Login gagal!');</script>";
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* 🔥 BACKGROUND WARNA LOGIN */
body {
    background: linear-gradient(135deg, #fff3b0, #ff8fab);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* CARD LOGIN */
.card {
    width: 350px;
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(234, 89, 89, 0.2);
}

/* HEADER (opsional kalau mau dipakai) */
h3 {
    text-align: center;
    margin-bottom: 20px;
    color: #efce18;
}
</style>

<div class="card p-4">

<h3>Login Perpustakaan</h3>

<form method="post">
    <input class="form-control mb-2" name="username" placeholder="Username">
    <input class="form-control mb-2" name="password" type="password" placeholder="Password">
    <button class="btn btn-primary w-100" name="login">Login</button>
</form>

</div>