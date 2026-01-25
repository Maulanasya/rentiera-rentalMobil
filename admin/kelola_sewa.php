<?php
include '../config/koneksi.php'; 
?>

<div class="py-5"
    style="background: linear-gradient(135deg, #0b1c2c 0%, #1a2a3a 100%); margin-top: -100px; padding-top: 150px !important; border-radius: 0 0 50px 50px;">
    <div class="container text-white text-center">
        <h6 class="text-warning fw-bold text-uppercase letter-spacing-2 mb-2">Manajemen</h6>
        <h2 class="display-5 fw-bold mb-3">Kelola <span class="text-warning">Transaksi Sewa</span></h2>
        <p class="text-white-50 lead mb-4">Verifikasi pembayaran tunai dan pantau seluruh aktivitas penyewaan mobil.</p>
        <a href="../config/laporan_sewa.php" target="_blank"
            class="btn btn-outline-light rounded-pill px-5 py-3 fw-bold shadow-lg transform-hover">
            <i class="bi bi-printer me-2"></i> Cetak Laporan
        </a>
    </div>
</div>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-3 mb-4 mt-n5 position-relative" style="z-index: 3;" data-aos="fade-right">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-warning border-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-warning p-3 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                            style="width: 55px; height: 55px;">
                            <i class="bi bi-cash text-light fs-3"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Menunggu Bayar</small>
                            <h4 class="fw-bold mb-0">
                                <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE status='Pending'")); ?>
                                Unit
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden" data-aos="fade-left">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="p-3">ID / Penyewa</th>
                            <th class="p-3">Mobil</th>
                            <th class="p-3">Jadwal & Durasi</th>
                            <th class="p-3">Total Bayar</th>
                            <th class="p-3">Status Bayar</th>
                            <th class="text-center p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT s.*, m.merk, m.tipe, u.nama, p.status as status_bayar, p.id_pembayaran 
                                FROM tb_sewa s
                                JOIN tb_mobil m ON s.id_mobil = m.id_mobil
                                JOIN tb_user u ON s.id_user = u.id_user
                                JOIN tb_pembayaran p ON s.id_sewa = p.id_sewa
                                ORDER BY s.id_sewa DESC";
                        
                        $query = mysqli_query($koneksi, $sql);

                        if (mysqli_num_rows($query) == 0) {
                            echo "<tr><td colspan='6' class='text-center py-5 text-muted'>Belum ada transaksi yang masuk.</td></tr>";
                        }

                        while ($row = mysqli_fetch_assoc($query)) {
                            $status = $row['status_bayar'];
                            $badge_color = ($status == 'Lunas') ? 'bg-success' : (($status == 'Batal') ? 'bg-danger' : 'bg-warning text-dark');
                        ?>
                        <tr>
                            <td class="p-3">
                                <span class="fw-bold text-dark">#<?php echo $row['id_sewa']; ?></span>
                                <small class="d-block text-muted"><?php echo $row['nama']; ?></small>
                            </td>
                            <td>
                                <span class="fw-semibold"><?php echo $row['merk'] . " " . $row['tipe']; ?></span>
                            </td>
                            <td>
                                <small class="d-block text-secondary">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    <?php echo date('d/m/y', strtotime($row['tanggal_mulai'])); ?> -
                                    <?php echo date('d/m/y', strtotime($row['tanggal_selesai'])); ?>
                                </small>
                            </td>
                            <td class="fw-bold text-primary">
                                Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <span class="badge <?php echo $badge_color; ?> px-3 py-2 rounded-pill">
                                    <?php echo $status; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?php if ($status == 'Pending') : ?>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="../config/aksi_konfirmasi.php?id_bayar=<?php echo $row['id_pembayaran']; ?>&status=Lunas"
                                        class="btn btn-sm btn-success rounded-pill px-3 shadow-sm"
                                        onclick="return confirm('Konfirmasi pembayaran tunai?')">ACC</a>
                                    <a href="../config/aksi_konfirmasi.php?id_bayar=<?php echo $row['id_pembayaran']; ?>&status=Batal"
                                        class="btn btn-sm btn-outline-danger rounded-pill px-3">Batal</a>
                                </div>

                                <?php elseif ($status == 'Lunas') : ?>
                                <?php if ($row['status_kembali'] == 'Belum') : ?>
                                <a href="../config/aksi_selesai.php?id_sewa=<?php echo $row['id_sewa']; ?>&id_mobil=<?php echo $row['id_mobil']; ?>"
                                    class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm"
                                    onclick="return confirm('Pastikan unit mobil sudah kembali dengan baik. Selesaikan transaksi?')">
                                    <i class="bi bi-check-circle me-1"></i> Terima Unit
                                </a>
                                <?php else : ?>
                                <button class="btn btn-sm btn-secondary rounded-pill px-3 shadow-sm" disabled>
                                    <i class="bi bi-house-check me-1"></i> Telah Dikembalikan
                                </button>
                                <?php endif; ?>

                                <?php else : ?>
                                <span class="text-danger fw-bold small"><i class="bi bi-x-circle me-1"></i> Transaksi
                                    Batal</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-4" data-aos="fade-right">
            <div class="col-12 text-center">
                <p class="small text-secondary italic">
                    <i class="bi bi-shield-lock-fill me-1"></i> Seluruh data transaksi di atas terenkripsi dan hanya
                    dapat dikelola oleh Admin Rentiera.
                </p>
            </div>
        </div>
    </div>
</section>