<?php
include '../config/koneksi.php'; 

$id_user = $_SESSION['id_user']; 
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
                <h6 class="text-warning fw-bold text-uppercase letter-spacing-2 mb-3">Riwayat Sewa</h6>
                <h1 class="display-3 fw-bold mb-3">
                    Pesanan <span class="text-warning">terakhir</span> Anda
                </h1>
                <p class="lead mb-0">
                    Pantau status pembayaran dan jadwal perjalanan Anda di sini.
                </p>
            </div>
        </div>
    </div>
</div>

<section class="py-5 bg-light" data-aos="fade-down">
    <div class="container">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mt-n5">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="p-3">Mobil</th>
                            <th>Jadwal Sewa</th>
                            <th>Total Bayar</th>
                            <th>Status Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT s.*, m.merk, m.tipe, p.status as status_bayar 
                                FROM tb_sewa s 
                                JOIN tb_mobil m ON s.id_mobil = m.id_mobil 
                                JOIN tb_pembayaran p ON s.id_sewa = p.id_sewa 
                                WHERE s.id_user = '$id_user' 
                                ORDER BY s.id_sewa DESC";
                        
                        $query = mysqli_query($koneksi, $sql);

                        if (!$query) {
                            echo "<tr><td colspan='4' class='text-center py-3'>Error Query: " . mysqli_error($koneksi) . "</td></tr>";
                        } elseif (mysqli_num_rows($query) == 0) {
                            echo "<tr><td colspan='4' class='text-center py-5 text-muted'>Belum ada transaksi sewa.</td></tr>";
                        } else {
                            while ($row = mysqli_fetch_assoc($query)) {
                                $status = $row['status_bayar'];
                                $badge_color = ($status == 'Lunas') ? 'bg-success' : (($status == 'Batal') ? 'bg-danger' : 'bg-warning text-dark');
                        ?>
                        <tr>
                            <td class="p-3">
                                <span class="fw-bold"><?php echo $row['merk'] . " " . $row['tipe']; ?></span>
                                <small class="d-block text-muted">ID #<?php echo $row['id_sewa']; ?></small>
                            </td>
                            <td>
                                <small class="d-block">Mulai:
                                    <?php echo date('d/m/Y', strtotime($row['tanggal_mulai'])); ?></small>
                                <small class="d-block">Selesai:
                                    <?php echo date('d/m/Y', strtotime($row['tanggal_selesai'])); ?></small>
                            </td>
                            <td class="fw-bold text-primary">Rp
                                <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                            <td>
                                <span class="badge <?php echo $badge_color; ?> px-3 py-2 rounded-pill">
                                    <?php echo $status; ?>
                                </span>
                            </td>
                        </tr>
                        <?php 
                            } 
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="container pb-5">
    <div class="row g-4">
        <div class="col-md-8" data-aos="fade-right">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <h6 class="fw-bold mb-3"><i class="bi bi-info-circle text-primary me-2"></i> Langkah Selanjutnya</h6>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="d-flex gap-3 mb-3">
                            <div class="text-warning fs-4"><i class="bi bi-1-circle-fill"></i></div>
                            <p class="small text-secondary mb-0">Kunjungi kantor Rentiera sesuai jadwal pengambilan yang
                                Anda pilih.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex gap-3 mb-3">
                            <div class="text-warning fs-4"><i class="bi bi-2-circle-fill"></i></div>
                            <p class="small text-secondary mb-0">Tunjukkan <strong>ID Sewa</strong> kepada petugas kami
                                di lokasi.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex gap-3 mb-0">
                            <div class="text-warning fs-4"><i class="bi bi-3-circle-fill"></i></div>
                            <p class="small text-secondary mb-0">Lakukan pembayaran tunai dan verifikasi data identitas
                                (KTP/SIM).</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex gap-3 mb-0">
                            <div class="text-warning fs-4"><i class="bi bi-4-circle-fill"></i></div>
                            <p class="small text-secondary mb-0">Cek kondisi unit bersama petugas, ambil kunci, dan
                                selamat berkendara!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-left">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-dark text-white">
                <h6 class="fw-bold mb-3 text-warning">Butuh Bantuan?</h6>
                <p class="small opacity-75 mb-4">Jika Anda mengalami kendala atau ingin melakukan pembatalan jadwal,
                    silakan hubungi tim kami.</p>
                <a href="https://wa.me/6285659626847" class="btn btn-outline-warning w-100 rounded-pill mb-2">
                    <i class="bi bi-whatsapp me-2"></i> WhatsApp Customer Service
                </a>
                <small class="text-center d-block opacity-50 mt-2">Jam Operasional: 08:00 - 21:00</small>
            </div>
        </div>
    </div>
</div>