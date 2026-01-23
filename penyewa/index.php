<?php
session_start();
if (empty($_SESSION['role']=='penyewa')) {
  header("location:../index.php");
}

include '../components/header.php';

if (isset($_GET['page'])) {
  $page = $_GET['page'];

  switch ($page) {
    case 'about':
      include '../pages/about.php';
      break;
      case 'produk':
      include '../pages/produk.php';
      break;
      case 'riwayat':
      include 'riwayat.php';
      break;
      case 'faq':
      include '../pages/faq.php';
      break;
      case 'contact';
      include '../pages/contact.php';
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