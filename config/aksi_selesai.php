<?php
include 'koneksi.php';

if (isset($_GET['id_sewa']) && isset($_GET['id_mobil'])) {
    $id_sewa  = $_GET['id_sewa'];
    $id_mobil = $_GET['id_mobil'];

    // Jika selesai disewa mobil menjadi tersedia kembali
    $update_mobil = mysqli_query($koneksi, "UPDATE tb_mobil SET status = 'Tersedia' WHERE id_mobil = '$id_mobil'");

    // Tandai transaksi sewa ini sudah mengembalikan unit
    $update_sewa = mysqli_query($koneksi, "UPDATE tb_sewa SET status_kembali = 'Sudah' WHERE id_sewa = '$id_sewa'");

    if ($update_mobil && $update_sewa) {
        echo "<!DOCTYPE html><html><head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <link rel='stylesheet' href='../assets/css/style.css'>
            </head><body style='background: linear-gradient(135deg, #0b1c2c 0%, #1a2a3a 100%); min-height: 100vh;'>";
        
        echo "<script>
            Swal.fire({
                title: 'Transaksi Selesai!',
                text: 'Unit mobil telah diterima kembali dan berstatus Tersedia.',
                icon: 'success',
                confirmButtonColor: '#ffc107'
            }).then(() => {
                window.location.href = '../admin/index.php?page=kelola_sewa';
            });
        </script></body></html>";
    }
}
?>