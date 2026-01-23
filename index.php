<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentiera-Rental Mobil</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
    <div class="main-wrapper container-fluid p-0">

        <section class="hero-section position-relative" style="border-top: 1px solid transparent;">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded-5 mt-4 mx-4 px-3 shadow-sm custom-navbar sticky-top"
                style="z-index: 9999; border-radius: 30px;">
                <div class="container-fluid">

                    <a class="navbar-brand fw-bold text-warning" href="index.php">Rentiera</a>

                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse pb-3 pb-lg-0" id="navbarNav">
                        <ul class="navbar-nav mx-auto gap-3 text-center my-3 my-lg-0">
                            <li class="nav-item"><a class="nav-link fw-semibold text-light" href="index.php">Beranda</a>
                            </li>
                            <li class="nav-item"><a class="nav-link fw-semibold text-light"
                                    href="index.php?page=about">Tentang</a></li>
                            <li class="nav-item"><a class="nav-link fw-semibold text-light"
                                    href="index.php?page=produk">Produk</a></li>
                            <li class="nav-item"><a class="nav-link fw-semibold text-light"
                                    href="index.php?page=faq">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link fw-semibold text-light"
                                    href="index.php?page=contact">Kontak</a></li>
                        </ul>

                        <div class="d-flex flex-column flex-lg-row gap-2 justify-content-center">
                            <a href="index.php?page=registrasi"
                                class="btn btn-warning rounded-pill px-4 fw-bold">Daftar</a>
                            <a href="index.php?page=login"
                                class="btn btn-outline-warning rounded-pill px-4 fw-bold">Masuk</a>
                        </div>

                    </div>
                </div>
            </nav>

            <?php
if (isset($_GET['page'])) {
    $page= $_GET['page'];

    switch ($page) {
    case 'login':
    include 'login.php';
    break;
    case 'registrasi':
    include 'registrasi.php';
    break;
    case 'about';
    include 'pages/about.php';
    break;
    case 'produk';
    include 'pages/produk.php';
    break;
    case 'faq';
    include 'pages/faq.php';
    break;
    case 'contact';
    include 'pages/contact.php';
    break;
    default:
    echo "Halaman tidak tersedia";
    break;
}
} else {
    include 'home.php'; 
}
?>




            <!-- footer -->
            <?php 
    $halaman_sekarang = isset($_GET['page']) ? $_GET['page'] : 'home';

    $halaman_tanpa_footer = ['login', 'registrasi'];

    if (!in_array($halaman_sekarang, $halaman_tanpa_footer)) { 
?>

            <footer class="bg-dark text-light pt-5 pb-4 mt-5"
                style="border-top-left-radius: 50px; border-top-right-radius: 50px;">
                <div class="container text-center text-md-start">
                    <div class="row text-center text-md-start">

                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h4 class="text-uppercase mb-4 font-weight-bold text-warning">Rentiera</h4>
                            <p>Partner perjalanan terbaikmu. Temukan kendaraan impian dengan harga terjangkau dan proses
                                yang mudah.</p>
                        </div>

                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold text-warning">Mengapa Rentiera?</h6>
                            <p>Unit Terawat & Bersih</p>
                            <p>Layanan Lepas Kunci</p>
                            <p>Respon Cepat 24/7</p>
                        </div>

                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold text-warning">Contact</h6>
                            <p><i class="fas fa-home mr-3"></i> Bandung, Indonesia</p>
                            <p><i class="fas fa-envelope mr-3"></i> rentiera@gmail.com</p>
                            <p><i class="fas fa-phone mr-3"></i> +62 856 5962 6847</p>
                        </div>

                    </div>

                    <hr class="mb-4 border-secondary">

                    <div class="row align-items-center">
                        <div class="col-md-7 col-lg-8">
                            <p>Copyright ©2024 All rights reserved by:
                                <strong class="text-warning">Rentiera</strong>
                            </p>
                        </div>
                        <div class="col-md-5 col-lg-4">
                            <div class="text-center text-md-end">
                                <ul class="list-unstyled list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i
                                                class="bi bi-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i
                                                class="bi bi-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i
                                                class="bi bi-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <?php } ?>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous">
            </script>
            <script src="assets/js/script.js"></script>
            <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
            <script>
            AOS.init();
            </script>
</body>

</html>