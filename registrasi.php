<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Registrasi...</title>
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
include 'config/koneksi.php';

if (isset($_POST['kirim'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = 'penyewa';
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $query = mysqli_query($koneksi, "INSERT INTO tb_user VALUES (NULL, '$nama','$email','$password','$role','$telp','$alamat')");

    if($query) {
        echo "<script>
        Swal.fire({
            title: 'Registrasi Berhasil!',
            text: 'Silahkan login, untuk melanjutkan perjalanan anda',
            icon: 'success',
            confirmButtonText: 'Lanjut',
            confirmButtonColor: '#ffc107', 
            background: '#fff',
            color: '#000',
            timer: 3000,
            timerProgressBar: true
        }).then((result) => {
            window.location.href = 'index.php?page=login';
        });
    </script>";
    }
}
?>



    <link rel="stylesheet" href="assets/css/style.css">

    <div style="
    background-image: url('assets/images/imgRegis.jpg');
    background-size: cover;
    background-position: center;
    width: 100%; 
    height: 115vh;
    margin-top: -140px; 
    padding-top: 140px; 
    position: relative; 
    z-index: 1; 
    display: flex;
    justify-content: center;
    align-items: center;
">

        <!-- Overlay -->
        <div style="
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.4));
        z-index: 0;
    "></div>

        <!-- Card -->
        <div class="glass-card" style="z-index: 1;">

            <div class="text-center mb-4">
                <h2 class="fw-bold">Buat Akun Baru</h2>
                <p class="text-secondary">Daftar untuk mulai menyewa mobil</p>
            </div>

            <form method="POST">

                <div class="mb-3 position-relative">
                    <i class="bi bi-person input-icon"></i>
                    <input type="text" class="form-control form-control-aesthetic" name="nama"
                        placeholder="Nama Lengkap" required>
                </div>

                <div class="mb-3 position-relative">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" class="form-control form-control-aesthetic" name="email"
                        placeholder="Email Address" required>
                </div>

                <div class="mb-3 position-relative">
                    <i class="bi bi-whatsapp input-icon"></i>
                    <input type="text" class="form-control form-control-aesthetic" name="telp"
                        placeholder="Nomor Telepon" required>
                </div>

                <div class="mb-3 position-relative">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" class="form-control form-control-aesthetic" name="password"
                        placeholder="Password" required>
                </div>

                <div class="mb-4 position-relative">
                    <i class="bi bi-geo-alt input-icon"></i>
                    <input type="text" class="form-control form-control-aesthetic" name="alamat"
                        placeholder="Alamat Lengkap" required>
                </div>

                <button type="submit" name="kirim" class="btn-login-glow mb-4">
                    DAFTAR SEKARANG
                </button>

                <div class="text-center pt-3 border-top">
                    <small class="text-secondary">
                        Sudah punya akun?
                        <a href="index.php?page=login" class="text-warning fw-bold text-decoration-none">
                            Login Disini
                        </a>
                    </small>
                </div>

            </form>
        </div>
    </div>

</body>

</html>