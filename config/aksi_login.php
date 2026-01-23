<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Login...</title>
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
session_start();
include 'koneksi.php';

$email    = $_POST['email'];
$password = md5($_POST['password']);
$level    = $_POST['level'];
$remember = isset($_POST['remember']) ? $_POST['remember'] : '';

// Cek pengguna di Database
$query = "SELECT * FROM tb_user WHERE email='$email' AND password='$password' AND role='$level'";
$login = mysqli_query($koneksi, $query);
$cek   = mysqli_num_rows($login);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    // Session untuk admin dan pengguna 
    $_SESSION['status_login'] = true;
    $_SESSION['id_user']      = $data['id_user'];
    $_SESSION['nama_user']    = $data['nama']; 
    $_SESSION['role']         = $data['role'];

    // Cookies
    if ($remember == 'true') {
        // Simpan email di cookie selama 30 hari
        setcookie('user_email', $email, time() + (3600 * 24 * 30), "/");
        // Simpan status remember
        setcookie('remember_me', 'checked', time() + (3600 * 24 * 30), "/");
    } else {
        // Jika tidak dicentang, hapus cookie yang ada
        setcookie('user_email', '', time() - 3600, "/");
        setcookie('remember_me', '', time() - 3600, "/");
    }

    if ($data['role'] == 'admin') {
        $link_tujuan = '../admin/index.php';
        $pesan_tambahan = "Anda masuk sebagai Admin";
    
    } else if ($data['role'] == 'penyewa') {
        $link_tujuan = '../penyewa/';
        $pesan_tambahan = "Siap menjelajahi mobil impian?";
    }

    $sapaan = "Selamat Datang, " . $data['nama'];

    // Popup sukses
    echo "<script>
        Swal.fire({
            title: 'Login Berhasil!',
            text: '$sapaan. $pesan_tambahan',
            icon: 'success',
            confirmButtonText: 'Lanjut',
            confirmButtonColor: '#ffc107', 
            background: '#fff',
            color: '#000',
            timer: 3000,
            timerProgressBar: true
        }).then((result) => {
            window.location.href = '$link_tujuan';
        });
    </script>";

} else {
    // Popup gagal
    echo "<script>
        Swal.fire({
            title: 'Login Gagal!',
            text: 'Cek kembali Email, Password, atau Role Anda.',
            icon: 'error',
            confirmButtonText: 'Coba Lagi',
            confirmButtonColor: '#d33',
            background: '#fff',
            color: '#000'
        }).then((result) => {
            window.location.href = '../index.php?page=login';
        });
    </script>";
}
?>

</body>

</html>