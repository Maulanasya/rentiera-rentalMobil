<div style="
    background-image: url('/rentiera/assets/images/bgCarsgarage.jpg'); /* Menggunakan Root Path */
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
                <h6 class="text-warning fw-bold text-uppercase letter-spacing-2 mb-3">Katalog Armada</h6>
                <h1 class="display-4 fw-bold mb-3">Pilih Mobil Impian Anda</h1>
                <p class="lead">Berbagai pilihan unit terbaik siap menemani perjalanan Anda dengan nyaman dan aman.</p>
            </div>
        </div>
    </div>
</div>

<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="row mb-5 align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <h3 class="fw-bold mb-0">Tersedia <span class="text-warning">Semua Unit</span></h3>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <?php
            if (file_exists('config/koneksi.php')) {
                include 'config/koneksi.php';
            } else {
                include '../config/koneksi.php';
            }

            $query = mysqli_query($koneksi, "SELECT * FROM tb_mobil ORDER BY id_mobil DESC");
            while ($data = mysqli_fetch_assoc($query)) { 
                $status_mobil = strtolower($data['status']);
                $bg_color = ($status_mobil == 'tersedia') ? 'bg-success' : (($status_mobil == 'disewa') ? 'bg-warning' : 'bg-danger');
                $text_color = ($status_mobil == 'disewa') ? 'text-dark' : 'text-white';
            ?>

            <div class="col-md-6 col-lg-4" data-aos="zoom-in">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                    <div style="height: 250px; overflow: hidden; position: relative;">
                        <img src="/rentiera/assets/images/<?php echo $data['gambar']; ?>" class="w-100 h-100"
                            style="object-fit: cover; object-position: center;" alt="<?php echo $data['merk']; ?>">
                        <span
                            class="position-absolute top-0 end-0 m-3 badge <?php echo $bg_color . ' ' . $text_color; ?> shadow-sm rounded-pill px-3 py-2">
                            <i class="bi bi-circle-fill small me-1"></i> <?php echo ucfirst($status_mobil); ?>
                        </span>
                    </div>

                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h4 class="fw-bold mb-1"><?php echo $data['merk'] . " " . $data['tipe']; ?></h4>
                                <small class="text-secondary">
                                    <i class="bi bi-calendar4 me-1"></i> <?php echo $data['tahun']; ?> &bull;
                                    <i class="bi bi-gear-wide-connected mx-1"></i> <?php echo $data['jenis']; ?>
                                </small>
                            </div>
                            <div class="text-end">
                                <h5 class="fw-bold text-primary mb-0">Rp
                                    <?php echo number_format($data['harga_sewa_harian'], 0, ',', '.'); ?></h5>
                                <small class="text-muted">/hari</small>
                            </div>
                        </div>

                        <hr class="border-secondary opacity-10 my-3">

                        <?php if ($status_mobil == 'tersedia') : ?>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'penyewa') : ?>
                        <button type="button" class="btn btn-dark w-100 rounded-pill py-3 fw-bold mt-auto"
                            data-bs-toggle="modal" data-bs-target="#modalSewa<?php echo $data['id_mobil']; ?>">
                            Sewa Sekarang <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                        <?php else : ?>
                        <a href="index.php?page=registrasi"
                            class="btn btn-dark w-100 rounded-pill py-3 fw-bold mt-auto">
                            Sewa Sekarang <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <?php endif; ?>
                        <?php else : ?>
                        <button type="button" class="btn btn-secondary w-100 rounded-pill py-3 fw-bold mt-auto"
                            disabled>
                            Tidak Tersedia
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalSewa<?php echo $data['id_mobil']; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0 shadow">
                        <div class="modal-header border-0 p-4 pb-0">
                            <h5 class="fw-bold">Konfirmasi Penyewaan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="../config/aksi_sewa.php" method="POST">
                            <div class="modal-body p-4">
                                <input type="hidden" name="id_mobil" value="<?php echo $data['id_mobil']; ?>">
                                <input type="hidden" id="hargaHarian<?php echo $data['id_mobil']; ?>"
                                    value="<?php echo $data['harga_sewa_harian']; ?>">

                                <div class="mb-3">
                                    <label class="small fw-bold mb-2">Mobil Pilihan</label>
                                    <input type="text" class="form-control bg-light border-0"
                                        value="<?php echo $data['merk'].' '.$data['tipe']; ?>" readonly>
                                </div>

                                <div class="row g-3">
                                    <div class="col-6">
                                        <label class="small fw-bold mb-2">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai"
                                            id="tglMulai<?php echo $data['id_mobil']; ?>"
                                            class="form-control border-0 bg-light" required
                                            onchange="hitungOtomatis(<?php echo $data['id_mobil']; ?>)">
                                    </div>
                                    <div class="col-6">
                                        <label class="small fw-bold mb-2">Durasi (Hari)</label>
                                        <input type="number" name="durasi" id="durasi<?php echo $data['id_mobil']; ?>"
                                            class="form-control border-0 bg-light" min="1" placeholder="0" required
                                            oninput="hitungOtomatis(<?php echo $data['id_mobil']; ?>)">
                                    </div>
                                    <div class="col-12">
                                        <div class="p-3 rounded-4 bg-dark text-white shadow-sm mt-2">
                                            <div class="d-flex justify-content-between mb-1">
                                                <small class="opacity-75">Tanggal Kembali:</small>
                                                <span class="fw-bold text-warning"
                                                    id="tglKembali<?php echo $data['id_mobil']; ?>">-</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="opacity-75">Total Estimasi:</small>
                                                <h4 class="fw-bold text-warning mb-0"
                                                    id="tampilTotal<?php echo $data['id_mobil']; ?>">Rp 0</h4>
                                            </div>
                                            <input type="hidden" name="tanggal_selesai"
                                                id="inputKembali<?php echo $data['id_mobil']; ?>">
                                            <input type="hidden" name="total_harga"
                                                id="inputTotal<?php echo $data['id_mobil']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 text-center">
                                    <hr class="border-secondary opacity-10 mb-4">
                                    <div class="d-inline-block px-4 py-2 rounded-pill bg-light border">
                                        <i class="bi bi-cash-stack text-success me-2"></i>
                                        <span class="small fw-semibold text-muted">Metode Pembayaran: </span>
                                        <span class="small fw-bold text-dark">Bayar Tunai di Tempat</span>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer border-0 p-4 pt-0">
                                <button type="submit" name="proses_sewa"
                                    class="btn btn-warning w-100 rounded-pill py-3 fw-bold shadow-sm">
                                    KONFIRMASI SEWA SEKARANG
                                </button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>
</section>
<script src="/rentiera/assets/js/script.js"></script>