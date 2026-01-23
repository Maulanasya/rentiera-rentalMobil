<?php
include 'koneksi.php';

$aksi = $_GET['aksi'];

// Tambah mobil
if ($aksi == 'tambah') {
    $no_plat = $_POST['no_plat'];
    $merk    = $_POST['merk'];
    $tipe    = $_POST['tipe'];
    $jenis   = $_POST['jenis'];
    $tahun   = $_POST['tahun'];
    $warna   = $_POST['warna'];
    $harga   = $_POST['harga'];
    $status  = $_POST['status'];

    // Kelola Upload Gambar
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file  = $_FILES['gambar']['tmp_name'];
    $direktori = "../assets/images/" . $nama_file;

    if (move_uploaded_file($tmp_file, $direktori)) {
        $sql = "INSERT INTO tb_mobil (no_plat, merk, tipe, jenis, tahun, warna, harga_sewa_harian, status, gambar) 
                VALUES ('$no_plat', '$merk', '$tipe', '$jenis', '$tahun', '$warna', '$harga', '$status', '$nama_file')";
        
        if (mysqli_query($koneksi, $sql)) {
            echo "<script>alert('Data Mobil Berhasil Diupdate!'); window.location='../admin/index.php?page=kelola_mobil';</script>";
        }
    }
}

// Edit mobil 
if ($aksi == 'edit') {
    $id      = $_POST['id_mobil'];
    $no_plat = $_POST['no_plat'];
    $merk    = $_POST['merk'];
    $tipe    = $_POST['tipe'];
    $jenis   = $_POST['jenis'];
    $tahun   = $_POST['tahun'];
    $warna   = $_POST['warna'];
    $harga   = $_POST['harga'];
    $status  = $_POST['status'];

    $nama_gambar = $_FILES['gambar']['name'];
    
    if ($nama_gambar != "") {
        // Logika Ganti Gambar
        $tmp_gambar = $_FILES['gambar']['tmp_name'];
        
        // Menghapus gambar lama
        $cek = mysqli_query($koneksi, "SELECT gambar FROM tb_mobil WHERE id_mobil = '$id'");
        $old = mysqli_fetch_assoc($cek);
        if(file_exists("../assets/images/".$old['gambar'])) {
            unlink("../assets/images/".$old['gambar']);
        }

        move_uploaded_file($tmp_gambar, "../assets/images/" . $nama_gambar);
        
        $sql = "UPDATE tb_mobil SET 
                no_plat='$no_plat', merk='$merk', tipe='$tipe', jenis='$jenis', 
                tahun='$tahun', warna='$warna', harga_sewa_harian='$harga', 
                status='$status', gambar='$nama_gambar' 
                WHERE id_mobil='$id'";
    } else {
        // Update tanpa ganti gambar
        $sql = "UPDATE tb_mobil SET 
                no_plat='$no_plat', merk='$merk', tipe='$tipe', jenis='$jenis', 
                tahun='$tahun', warna='$warna', harga_sewa_harian='$harga', 
                status='$status' 
                WHERE id_mobil='$id'";
    }

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data Mobil Berhasil Diupdate!'); window.location='../admin/index.php?page=kelola_mobil';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

// Hapus mobil
} elseif ($aksi == 'hapus') {
    $id = $_GET['id'];
    $cek = mysqli_query($koneksi, "SELECT gambar FROM tb_mobil WHERE id_mobil = '$id'");
    $old = mysqli_fetch_assoc($cek);
    if(file_exists("../assets/images/".$old['gambar'])) {
        unlink("../assets/images/".$old['gambar']);
    }

    mysqli_query($koneksi, "DELETE FROM tb_mobil WHERE id_mobil = '$id'");
    header("location:../admin/index.php");
}
?>