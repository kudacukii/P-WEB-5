<?php
include "service/database.php";
session_start();
$login_message = "";

if(isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
  }

if(isset($_POST['login'])) {
    $nama = $_POST['nama'];
    $NPM = $_POST['NPM'];
    $hash_NPM = hash("sha256", $NPM);
  
    $sql = "SELECT * FROM users WHERE nama ='$nama' AND NPM='$hash_NPM'";
  
    $result = $db->query($sql);
  
    if($result->num_rows > 0) {
        $data = $result->fetch_assoc();
      
        $_SESSION["nama"] = $data["nama"];
        $_SESSION["is_login"] = true;
      
        header("location: dashboard.php");
      
      } else {
        $login_message = "akun tidak ditemukan";
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
    <?php include "layout/header.html" ?>
    <h3>MASUK AKUN</h3>
    <i><?= $login_message ?></i>
    <form action="login.php" method="POST">
        <input type="text" placeholder="nama" name="nama"/>
        <input type="NPM" placeholder="NPM" name="NPM"/>
        <button type="submit" name="login">Masuk</button>
    </form>
    <?php include "Layout/footer.html" ?>
</body>
</html>