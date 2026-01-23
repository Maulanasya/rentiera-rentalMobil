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

// Menambahkan pengguna
if (isset($_POST['tambah_user'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];      
    $alamat = $_POST['alamat'];
    $password = md5($_POST['password']);
    $role = $_POST['role']; 

    $sql = "INSERT INTO tb_user (nama, email, telp, alamat, password, role) 
            VALUES ('$nama', '$email', '$telp', '$alamat', '$password', '$role')";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        echo "<script>
            setTimeout(function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Pengguna baru bernama $nama telah ditambahkan.',
                    icon: 'success',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#ffc107',
                    timer: 2500,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = '../admin/index.php?page=kelola_pengguna';
                });
            }, 100);
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Terjadi kesalahan sistem saat menambah data.',
                icon: 'error',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.history.back();
            });
        </script>";
    }
}

// Edit pengguna
if (isset($_POST['edit_user'])) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $role = $_POST['role'];

    $sql = "UPDATE tb_user SET nama='$nama', email='$email', telp='$telp', alamat='$alamat', role='$role' WHERE id_user='$id_user'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        echo "<script>
            setTimeout(function() {
                Swal.fire({
                    title: 'Berhasil diperbarui',
                    text: 'Data profil $nama telah diperbarui.',
                    icon: 'success',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#ffc107',
                    timer: 2500,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = '../admin/index.php?page=kelola_pengguna';
                });
            }, 100);
        </script>";
    }
}

// Hapus pengguna
if (isset($_GET['hapus'])) {
    $id_user = $_GET['hapus'];

    //Jika user masih punya transaksi aktif
    $cek_sewa = mysqli_query($koneksi, "SELECT * FROM tb_sewa WHERE id_user='$id_user'");
    
    if (mysqli_num_rows($cek_sewa) > 0) {
        // Jika gagal karena ada riwayat transaksi
        echo "<script>
            Swal.fire({
                title: 'Gagal Menghapus!',
                text: 'User ini tidak bisa dihapus karena masih memiliki riwayat transaksi di Rentiera.',
                icon: 'warning',
                confirmButtonColor: '#ffc107'
            }).then(() => {
                window.location.href = '../admin/index.php?page=kelola_pengguna';
            });
        </script>";
    } else {
        // Proses hapus jika data sudah clear
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_user='$id_user'");
        
        if ($hapus) {
            echo "<script>
                Swal.fire({
                    title: 'Terhapus!',
                    text: 'Data pengguna telah berhasil dihapus dari sistem.',
                    icon: 'success',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#ffc107',
                    timer: 2500,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = '../admin/index.php?page=kelola_pengguna';
                });
            </script>";
        }
    }
}
?>

</body>

</html>