<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing...</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    body {
        font-family: sans-serif;
        background-color: #212529;
    }
    </style>
</head>

<body>

    <?php
include 'koneksi.php';
session_start();

if (isset($_POST['proses_sewa'])) {
    $id_user         = $_SESSION['id_user'];
    $id_mobil        = $_POST['id_mobil'];
    $tanggal_mulai   = $_POST['tanggal_mulai']; 
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $total_harga     = $_POST['total_harga'];
    $tanggal_bayar   = date('Y-m-d'); 

    $query_sewa = mysqli_query($koneksi, "INSERT INTO tb_sewa (id_user, id_mobil, tanggal_mulai, tanggal_selesai, total_harga) 
                VALUES ('$id_user', '$id_mobil', '$tanggal_mulai', '$tanggal_selesai', '$total_harga')");

    if ($query_sewa) {
        $id_sewa_baru = mysqli_insert_id($koneksi);

        mysqli_query($koneksi, "INSERT INTO tb_pembayaran (id_sewa, tanggal_bayar, total_harga, metode_pembayaran, status) 
                        VALUES ('$id_sewa_baru', '$tanggal_bayar', '$total_harga', 'Tunai', 'Pending')");

        mysqli_query($koneksi, "UPDATE tb_mobil SET status = 'Disewa' WHERE id_mobil = '$id_mobil'");

        echo "<script>
        Swal.fire({
            title: 'Pemesanan berhasil!',
            text: 'Silakan bayar tunai saat pengambilan unit.',
            icon: 'success',
            confirmButtonText: 'Lanjut',
            confirmButtonColor: '#ffc107', 
            background: '#fff',
            color: '#000',
            timer: 3000,
            timerProgressBar: true
        }).then((result) => {
            window.location.href = '../penyewa/index.php?page=riwayat';
        });
    </script>";
    }
}
?>

</body>

</html>