<?php
session_start();
if (empty($_SESSION['role']=='admin')) {
  header("location:../index.php");
}
include '../components/header.php';

if (isset($_GET['page'])) {
  $page = $_GET['page'];

  switch ($page) {
    case 'about':
      include '../pages/about.php';
      break;
      case 'kelola_mobil':
      include 'kelola_mobil.php';
      break;
      case 'kelola_pengguna':
      include 'kelola_pengguna.php';
      break;
      case 'kelola_sewa':
      include 'kelola_sewa.php';
      break;
      default:
      echo "Halman tidak tersedia";
  }
} else {
  include 'home.php';
}
include '../components/footer.php';
?>
<script src="../assets/js/script.js"></script>