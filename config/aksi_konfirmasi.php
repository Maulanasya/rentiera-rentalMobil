<?php
include 'koneksi.php'; 
session_start();

if (isset($_GET['id_bayar']) && isset($_GET['status'])) {
    $id_bayar = $_GET['id_bayar'];
    $status = $_GET['status'];
    $update = mysqli_query($koneksi, "UPDATE tb_pembayaran SET status = '$status' WHERE id_pembayaran = '$id_bayar'");

    if ($update) {
        if ($status == 'Batal') {
            $query_mobil = "SELECT s.id_mobil FROM tb_sewa s 
                            JOIN tb_pembayaran p ON s.id_sewa = p.id_sewa 
                            WHERE p.id_pembayaran = '$id_bayar'";
            $data_bayar = mysqli_fetch_assoc(mysqli_query($koneksi, $query_mobil));
            $id_mobil = $data_bayar['id_mobil'];
            
            mysqli_query($koneksi, "UPDATE tb_mobil SET status = 'Tersedia' WHERE id_mobil = '$id_mobil'");
        }

        echo "<script>
                alert('Berhasil memperbarui status transaksi!'); 
                window.location='../admin/index.php?page=kelola_sewa';
            </script>"; 
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }
}
?>