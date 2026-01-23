<?php
include 'config/koneksi.php';

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $level = $_POST['level']; 

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE email='$email' AND password='$password' AND role='$level'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['status_login'] = true;
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama_user'] = $data['nama_lengkap'];
        $_SESSION['role'] = $data['role'];

        echo "<script>
            alert('Login Berhasil! Selamat Datang, " . $data['nama_lengkap'] . "');
            window.location.href='index.php';
        </script>";
    } else {
        echo "<script>
            alert('Login Gagal! Email, Password, atau Role salah.');
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

    <div style="
        position: absolute; 
        top: 0; left: 0; right: 0; bottom: 0; 
        background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 100%);
        z-index: -1; 
    "></div>


    <?php 
        // Mengambil data dari cookie jika tersedia
        $saved_email   = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : ''; 
        $is_remembered = isset($_COOKIE['remember_me']) ? $_COOKIE['remember_me'] : '';
    ?>
    <div class="glass-card">

        <div class="text-center mb-4">
            <h2 class="fw-bold">Welcome Back!</h2>
            <p class="text-secondary">Masuk untuk mengelola perjalananmu</p>
        </div>

        <form action="config/aksi_login.php" method="POST">

            <div class="mb-3 position-relative">
                <i class="bi bi-envelope input-icon"></i>
                <input type="text" class="form-control form-control-aesthetic" name="email" placeholder="Email Address"
                    required>
            </div>

            <div class="mb-3 position-relative">
                <i class="bi bi-key input-icon"></i>
                <input type="password" class="form-control form-control-aesthetic" name="password"
                    placeholder="Password" required>
            </div>

            <div class="mb-4 position-relative">
                <i class="bi bi-person-badge input-icon"></i>
                <select class="form-control form-control-aesthetic form-select ps-5" name="level"
                    style="cursor: pointer;">
                    <option value="penyewa">Penyewa</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" name="kirim" class="btn-login-glow mb-4">
                LOGIN SEKARANG
            </button>

            <div class="mb-3 form-check ms-1">
                <input type="checkbox" name="remember" value="true" class="form-check-input" id="rememberCheck"
                    <?php echo $is_remembered; ?>>
                <label class="form-check-label text-dark small" for="rememberCheck" style="cursor:pointer;">Ingat
                    Saya</label>
            </div>

            <div class="text-center pt-3 border-top">
                <small class="text-secondary">Belum punya akun?
                    <a href="index.php?page=registrasi" class="text-warning fw-bold text-decoration-none">Daftar
                        Disini</a>
                </small>
            </div>

        </form>
    </div>
</div>