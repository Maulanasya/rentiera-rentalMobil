<div class="py-5"
    style="background: linear-gradient(135deg, #0b1c2c 0%, #1a2a3a 100%); margin-top: -100px; padding-top: 150px !important; border-radius: 0 0 50px 50px;">
    <div class="container text-white text-center">
        <h6 class="text-warning fw-bold text-uppercase letter-spacing-2 mb-2">Manajemen</h6>
        <h2 class="display-5 fw-bold mb-3">Kelola <span class="text-warning">Mobil</span></h2>
        <p class="text-white-50 lead mb-4">Pantau ketersediaan, perbarui spesifikasi, atau tambahkan unit terbaru ke
            katalog.</p>

        <button type="button" class="btn btn-warning rounded-pill px-5 py-3 fw-bold shadow-lg transform-hover"
            data-bs-toggle="modal" data-bs-target="#modalTambahMobil">
            <i class="bi bi-plus-lg me-2"></i> Tambah Mobil Baru
        </button>

        <a href="../config/laporan_mobil.php" target="_blank"
            class="btn btn-outline-light rounded-pill px-5 py-3 fw-bold shadow-lg transform-hover">
            <i class="bi bi-printer me-2"></i> Cetak Laporan
        </a>
    </div>
</div>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4 mb-5 mt-n5">
            <?php
            include '../config/koneksi.php';
            $total_unit = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_mobil FROM tb_mobil"));
            $tersedia = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_mobil FROM tb_mobil WHERE status='tersedia'"));
            ?>
            <div class="col-md-6" data-aos="fade-right">
                <div
                    class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3 border-start border-primary border-4">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary"><i
                            class="bi bi-car-front fs-3 text-light"></i></div>
                    <div>
                        <h4 class="fw-bold mb-0"><?php echo $total_unit; ?></h4><small class="text-muted">Total
                            Unit</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <div
                    class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3 border-start border-success border-4">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success"><i
                            class="bi bi-check-circle fs-3 text-light"></i></div>
                    <div>
                        <h4 class="fw-bold mb-0"><?php echo $tersedia; ?></h4><small class="text-muted">Unit
                            Tersedia</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM tb_mobil ORDER BY id_mobil DESC");
            while ($data = mysqli_fetch_assoc($query)) { 
                
                $status_mobil = $data['status'];
                $bg_color = ($status_mobil == 'tersedia') ? 'bg-success' : (($status_mobil == 'disewa') ? 'bg-warning' : 'bg-danger');
                $text_color = ($status_mobil == 'disewa') ? 'text-dark' : 'text-white';
            ?>

            <div class="col-md-6 col-lg-6" data-aos="zoom-in">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden card-hover">
                    <div style="height: 300px; overflow: hidden; position: relative;">
                        <img src="../assets/images/<?php echo $data['gambar']; ?>" class="w-100 h-100"
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

                        <div class="row g-2 mb-4">
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-2 text-center">
                                    <small class="text-muted d-block small">Warna</small>
                                    <span class="fw-semibold text-dark"><?php echo $data['warna']; ?></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-2 text-center">
                                    <small class="text-muted d-block small">Plat Nomor</small>
                                    <span class="fw-semibold text-dark"><?php echo $data['no_plat']; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-auto">
                            <button type="button" class="btn btn-warning w-100 rounded-pill py-2 fw-bold"
                                data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $data['id_mobil']; ?>">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </button>
                            <a href="../config/aksi_mobil.php?aksi=hapus&id=<?php echo $data['id_mobil']; ?>"
                                class="btn btn-outline-danger w-100 rounded-pill py-2 fw-bold"
                                onclick="return confirm('Yakin ingin menghapus mobil <?php echo $data['tipe']; ?>?')">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalEdit<?php echo $data['id_mobil']; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0 shadow">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="fw-bold">Edit Keseluruhan Data Mobil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="../config/aksi_mobil.php?aksi=edit" method="POST" enctype="multipart/form-data">
                            <div class="modal-body p-4">
                                <input type="hidden" name="id_mobil" value="<?php echo $data['id_mobil']; ?>">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="small fw-bold">No. Plat</label>
                                        <input type="text" name="no_plat" class="form-control"
                                            value="<?php echo $data['no_plat']; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small fw-bold">Merk</label>
                                        <input type="text" name="merk" class="form-control"
                                            value="<?php echo $data['merk']; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small fw-bold">Tipe</label>
                                        <input type="text" name="tipe" class="form-control"
                                            value="<?php echo $data['tipe']; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small fw-bold">Jenis Mobil</label>
                                        <input type="text" name="jenis" class="form-control"
                                            value="<?php echo $data['jenis']; ?>" required>


                                    </div>
                                    <div class="col-md-4">
                                        <label class="small fw-bold">Tahun</label>
                                        <input type="number" name="tahun" class="form-control"
                                            value="<?php echo $data['tahun']; ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small fw-bold">Warna</label>
                                        <input type="text" name="warna" class="form-control"
                                            value="<?php echo $data['warna']; ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small fw-bold">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="tersedia"
                                                <?php echo ($data['status'] == 'tersedia') ? 'selected' : ''; ?>>
                                                Tersedia</option>
                                            <option value="disewa"
                                                <?php echo ($data['status'] == 'disewa') ? 'selected' : ''; ?>>
                                                Disewa</option>
                                            <option value="servis"
                                                <?php echo ($data['status'] == 'servis') ? 'selected' : ''; ?>>
                                                Servis</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="small fw-bold">Harga Sewa Harian (Rp)</label>
                                        <input type="number" name="harga" class="form-control"
                                            value="<?php echo $data['harga_sewa_harian']; ?>" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="small fw-bold">Ganti Gambar (Biarkan kosong jika tidak
                                            diganti)</label>
                                        <input type="file" name="gambar" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="submit" class="btn btn-dark w-100 rounded-pill py-3 fw-bold">SIMPAN
                                    PERUBAHAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>
</section>

<div class="modal fade" id="modalTambahMobil" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold">Input Armada Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="../config/aksi_mobil.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="small fw-bold mb-1">No. Plat</label><input type="text"
                                name="no_plat" class="form-control rounded-3" placeholder="D 1234 ABC" required></div>
                        <div class="col-md-6"><label class="small fw-bold mb-1">Merk</label><input type="text"
                                name="merk" class="form-control rounded-3" placeholder="Toyota" required></div>
                        <div class="col-md-6"><label class="small fw-bold mb-1">Tipe</label><input type="text"
                                name="tipe" class="form-control rounded-3" placeholder="Avanza" required></div>
                        <div class="col-md-6">
                            <label class="small fw-bold">Jenis Mobil</label>
                            <input type="text" name="jenis" class="form-control" required>
                        </div>
                        <div class="col-md-6"><label class="small fw-bold mb-1">Harga Sewa/Hari (Rp)</label><input
                                type="number" name="harga" class="form-control rounded-3" required></div>
                        <div class="col-md-6"><label class="small fw-bold mb-1">Upload Gambar</label><input type="file"
                                name="gambar" class="form-control rounded-3" required></div>
                        <div class="col-md-4"><label class="small fw-bold mb-1">Tahun</label><input type="number"
                                name="tahun" class="form-control rounded-3" required></div>
                        <div class="col-md-4"><label class="small fw-bold mb-1">Warna</label><input type="text"
                                name="warna" class="form-control rounded-3" required></div>
                        <div class="col-md-4">
                            <label class="small fw-bold mb-1">Status Awal</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="tersedia">Tersedia</option>
                                <option value="servis">Servis</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-warning w-100 rounded-pill py-3 fw-bold shadow">TAMBAHKAN KE
                        KATALOG</button>
                </div>
            </form>
        </div>
    </div>
</div>