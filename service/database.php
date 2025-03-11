<?php
$hostname = "localhost";
$nama = "root";
$NPM = "";
$database_name = "buku_tamu";
$db = mysqli_connect($hostname, $nama, $NPM, $database_name);
if($db->connect_error) {
  echo "koneksi database rusak";
  die("error!");
}
?>