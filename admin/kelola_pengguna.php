<?php
include '../config/koneksi.php'; 
?>

<div class="py-5"
    style="background: linear-gradient(135deg, #0b1c2c 0%, #1a2a3a 100%); margin-top: -100px; padding-top: 150px !important; border-radius: 0 0 50px 50px;">
    <div class="container text-white text-center">
        <h6 class="text-warning fw-bold text-uppercase letter-spacing-2 mb-2">Manajemen</h6>
        <h2 class="display-5 fw-bold mb-3">Kelola <span class="text-warning">Pengguna</span></h2>
        <p class="text-white-50 lead mb-4">Tambah, perbarui, atau hapus akun akses sistem Rentiera.</p>
        <button type="button" class="btn btn-warning rounded-pill px-5 py-3 fw-bold shadow-lg transform-hover"
            data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-person-plus-fill me-2"></i> Tambah Pengguna Baru
        </button>
    </div>
</div>

<section class="py-5 bg-light">

    <div class="container pb-5">
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-warning border-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-muted d-block mb-1">Total Pengguna</small>
                            <h3 class="fw-bold mb-0">
                                <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_user")); ?></h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-people-fill text-light fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-danger border-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-muted d-block mb-1">Administrator</small>
                            <h3 class="fw-bold mb-0">
                                <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_user WHERE role='admin'")); ?>
                            </h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-shield-lock-fill text-light fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-info border-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-muted d-block mb-1">Total Penyewa</small>
                            <h3 class="fw-bold mb-0">
                                <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_user WHERE role='penyewa'")); ?>
                            </h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-person-check-fill text-light fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="container">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mt-n5" data-aos="fade-left">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                            <th class="p-3">ID</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Role</th>
                            <th class="p-3">No Telepon</th>
                            <th class="p-3">Alamat</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM tb_user ORDER BY id_user DESC");
                        while ($row = mysqli_fetch_assoc($query)) {
                            $role_color = ($row['role'] == 'admin') ? 'bg-danger' : 'bg-info';
                        ?>
                        <tr class="text-center">
                            <td class="p-3 fw-bold">#<?php echo $row['id_user']; ?></td>
                            <td class="text-start"><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td>
                                <span class="badge <?php echo $role_color; ?> px-3 py-2 rounded-pill">
                                    <?php echo ucfirst($row['role']); ?>
                                </span>
                            </td>
                            <td><?php echo $row['telp'] ?? '-'; ?></td>
                            <td class="text-start"><?php echo $row['alamat'] ?? '-'; ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit<?php echo $row['id_user']; ?>">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                    <a href="../config/aksi_pengguna.php?hapus=<?php echo $row['id_user']; ?>"
                                        class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                        onclick="return confirm('Hapus pengguna ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEdit<?php echo $row['id_user']; ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4 border-0">
                                    <form action="../config/aksi_pengguna.php" method="POST">
                                        <div class="modal-header border-0 p-4">
                                            <h5 class="fw-bold">Edit Profil User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4 pt-0 text-start">
                                            <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
                                            <div class="mb-3">
                                                <label class="small fw-bold">Nama Lengkap</label>
                                                <input type="text" name="nama" class="form-control rounded-3"
                                                    value="<?php echo $row['nama']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small fw-bold">Email</label>
                                                <input type="email" name="email" class="form-control rounded-3"
                                                    value="<?php echo $row['email']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small fw-bold">No Telepon</label>
                                                <input type="text" name="telp" class="form-control rounded-3"
                                                    value="<?php echo $row['telp']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="small fw-bold">Alamat</label>
                                                <textarea name="alamat" class="form-control rounded-3"
                                                    rows="2"><?php echo $row['alamat']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small fw-bold">Role Akses</label>
                                                <select name="role" class="form-select rounded-3">
                                                    <option value="admin"
                                                        <?php if($row['role'] == 'admin') echo 'selected'; ?>>Admin
                                                    </option>
                                                    <option value="penyewa"
                                                        <?php if($row['role'] == 'penyewa') echo 'selected'; ?>>Penyewa
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 p-4 pt-0">
                                            <button type="submit" name="edit_user"
                                                class="btn btn-dark w-100 rounded-pill py-2 fw-bold">Simpan
                                                Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4" data-aos="fade-right">
            <div class="col-12 text-center">
                <p class="small text-secondary italic">
                    <i class="bi bi-shield-lock-fill me-1"></i> Data di atas merupakan ringkasan akses real-time dari
                    database Rentiera.
                </p>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <form action="../config/aksi_pengguna.php" method="POST">
                <div class="modal-header border-0 p-4">
                    <h5 class="fw-bold">Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <div class="mb-3">
                        <label class="small fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control rounded-3" placeholder="Nama asli..."
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Email</label>
                        <input type="email" name="email" class="form-control rounded-3" placeholder="email@contoh.com"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">No Telepon</label>
                        <input type="text" name="telp" class="form-control rounded-3" placeholder="081234567xxx"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Alamat</label>
                        <textarea name="alamat" class="form-control rounded-3" rows="2" placeholder="Alamat lengkap..."
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Password</label>
                        <input type="password" name="password" class="form-control rounded-3" placeholder="********"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Role Akses</label>
                        <select name="role" class="form-select rounded-3">
                            <option value="penyewa">Penyewa</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" name="tambah_user"
                        class="btn btn-warning w-100 rounded-pill py-2 fw-bold">Daftarkan Pengguna</button>
                </div>
            </form>
        </div>
    </div>
</div>