<?php
if (!isset($_SESSION['role'])) {
    header("Location: index.php?page=login");
    exit;
}

$role = $_SESSION['role'];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded-5 mt-4 mx-4 px-3 shadow-sm custom-navbar sticky-top"
    style="z-index: 9999; border-radius: 30px;">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold text-warning" href="index.php">Rentiera</a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse pb-3 pb-lg-0" id="navbarNav">

            <!-- MENU -->
            <ul class="navbar-nav mx-auto gap-3 text-center my-3 my-lg-0">

                <?php if ($role === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-light" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-light" href="index.php?page=about">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-light" href="index.php?page=kelola_mobil">Kelola Mobil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-light" href="index.php?page=kelola_pengguna">Kelola Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-light" href="index.php?page=kelola_sewa">Kelola Sewa</a>
                </li>

                <?php elseif ($role === 'penyewa'): ?>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-light" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-light" href="index.php?page=about">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-light" href="index.php?page=produk">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-light" href="index.php?page=riwayat">Riwayat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-light" href="index.php?page=faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-light" href="index.php?page=contact">Kontak</a>
                </li>
                <?php endif; ?>

            </ul>

            <div class="d-flex justify-content-center">
                <a href="../config/aksi_logout.php" class="btn btn-danger rounded-pill px-4 fw-bold">
                    Keluar
                </a>
            </div>

        </div>
    </div>
</nav>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-grow-1">