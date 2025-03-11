<?php
include "service/database.php";
session_start();
$register_message = "";

if(isset($_SESSION["is_login"])) {
  header("location: dashboard.php");
}

if(isset($_POST["register"])){
  $nama = $_POST["nama"];
  $NPM = $_POST["NPM"];
  $hash_NPM = hash("sha256", $NPM);

  try {
    $sql = "INSERT INTO users (nama, NPM) VALUES ('$nama', '$hash_NPM')";

    if($db->query($sql)) {
      $register_message = "daftar akun berhasil, silahkan login";
    } else {
      $register_message = "daftar akun gagal, silahkan coba lagi";
    }
  } catch (mysqli_sql_exception) {
    $register_message = "nama sudah ada, silahkan ganti yang lain";
  }
  $db->close();
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "Layout/header.html" ?>
    <h3>DAFTAR AKUN</h3>
    <i><?=$register_message ?></i>

    <form action="register.php" method="POST">
        <input type="text" placeholder="nama" name="nama"/>
        <input type="NPM" placeholder="NPM" name="NPM"/>
        <button type="submit" name="register">daftar sekarang</button>
    </form>
    <?php include "Layout/footer.html" ?>
</body>
</html>