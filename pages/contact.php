<?php
// PERBAIKAN 1: Logika cerdas mencari file koneksi agar tidak error di HP
if (file_exists('config/koneksi.php')) {
    include 'config/koneksi.php'; // Jika dipanggil dari index utama
} else {
    include '../config/koneksi.php'; // Jika dipanggil dari folder pages/
}

if (isset($_POST['kirim_pesan'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Pesan Berhasil Dikirim!',
                text: 'Terima kasih, tim Rentiera akan segera menghubungi Anda.',
                icon: 'success',
                confirmButtonColor: '#ffc107',
                timer: 3000,
                timerProgressBar: true
            }).then(() => {
                window.location.href = 'index.php?page=contact';
            });
        });
    </script>";
}
?>

<div style="
    background-image: url('/rentiera/assets/images/bgCarsgarage.jpg');
    background-size: cover;
    background-position: center;
    height: 50vh; 
    width: 100%; 
    position: relative; 
    margin-top: -100px; 
    padding-top: 100px; 
    z-index: 1;
">
    <div style="
        position: absolute; 
        top: 0; left: 0; right: 0; bottom: 0; 
        background: linear-gradient(to bottom, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 100%);
    "></div>

    <div class="container h-100 position-relative" style="z-index: 2;">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 text-white">
                <h6 class="text-warning fw-bold text-uppercase letter-spacing-2 mb-3">Hubungi Kami</h6>
                <h1 class="display-3 fw-bold mb-3">
                    Kami Siap <span class="text-warning">Melayani</span> Anda
                </h1>
                <p class="lead mb-0">
                    Punya pertanyaan mengenai armada atau butuh penawaran khusus? Jangan ragu untuk menghubungi tim
                    kami.
                </p>
            </div>
        </div>
    </div>
</div>

<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5">
                <h6 class="text-warning fw-bold text-uppercase" data-aos="fade-right">Informasi Kontak</h6>
                <h2 class="display-6 fw-bold text-dark mb-4" data-aos="fade-right">Mari Berdiskusi Dengan <span
                        class="text-warning">Kami</span></h2>
                <p class="text-secondary mb-5" data-aos="fade-right">
                    Kantor kami terbuka untuk kunjungan setiap hari. Silakan hubungi kami melalui saluran di bawah ini
                    untuk respon yang lebih cepat.
                </p>

                <div class="d-flex flex-column gap-4" data-aos="fade-right">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-4">
                            <i class="bi bi-geo-alt-fill text-dark fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Lokasi Kantor</h6>
                            <p class="text-secondary mb-0">Bandung, Jawa Barat, Indonesia</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-4">
                            <i class="bi bi-envelope-paper-fill text-dark fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Email Resmi</h6>
                            <p class="text-secondary mb-0">rentiera@gmail.com</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-4">
                            <i class="bi bi-whatsapp text-dark fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Layanan WhatsApp</h6>
                            <p class="text-secondary mb-0">+62 856 5962 6847</p>
                        </div>
                    </div>
                </div>

                <div class="mt-5" data-aos="fade-right">
                    <h6 class="fw-bold mb-3">Ikuti Kami</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-dark rounded-circle p-2 shadow-sm"
                            style="width: 45px; height: 45px;"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-dark rounded-circle p-2 shadow-sm"
                            style="width: 45px; height: 45px;"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-dark rounded-circle p-2 shadow-sm"
                            style="width: 45px; height: 45px;"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left">
                <div class="card border-0 shadow-lg rounded-5 p-4 p-md-5">
                    <h4 class="fw-bold mb-4">Kirim Pesan Langsung</h4>
                    <form method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small fw-bold mb-2">Nama Lengkap</label>
                                <input type="text" class="form-control rounded-3 p-3 bg-light border-0"
                                    placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold mb-2">Email Aktif</label>
                                <input type="email" class="form-control rounded-3 p-3 bg-light border-0"
                                    placeholder="nama@email.com" required>
                            </div>
                            <div class="col-12">
                                <label class="small fw-bold mb-2">Subjek</label>
                                <input type="text" class="form-control rounded-3 p-3 bg-light border-0"
                                    placeholder="Tujuan pesan Anda" required>
                            </div>
                            <div class="col-12">
                                <label class="small fw-bold mb-2">Pesan Anda</label>
                                <textarea class="form-control rounded-3 p-3 bg-light border-0" rows="5"
                                    placeholder="Tuliskan pesan atau pertanyaan Anda di sini..." required></textarea>
                            </div>
                            <div class="col-12 pt-3">
                                <button type="submit" name="kirim_pesan"
                                    class="btn btn-warning w-100 rounded-pill py-3 fw-bold shadow-lg">
                                    KIRIM PESAN SEKARANG <i class="bi bi-send-fill ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="w-100" style="height: 400px; filter: grayscale(100%) contrast(1.2); opacity: 0.8;" data-aos="fade-down">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862248!2d107.5731164!3d-6.9034443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146050350e183435!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>