<?php
include 'koneksi.php';
require_once ('../assets/fpdf/fpdf.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id_mobil, no_plat, merk, tipe, jenis, tahun, warna, harga_sewa_harian, status FROM tb_mobil");

    // PDF
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'LAPORAN DATA MOBIL RENTIERA', 0, 1, 'C');
    $pdf->Ln(5);

    //Header tabel
    $pdf->Cell(10, 10, 'Id', 1, 0, 'C');
    $pdf->Cell(35, 10, 'No Plat', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Merk', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Tipe', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Jenis', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Tahun', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Warna', 1, 0, 'C');
    $pdf->Cell(45, 10, 'Harga Sewa Harian', 1, 0, 'C');
    $pdf->Cell(45, 10, 'Status', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 11);

    //Data tabel
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(10, 10, $row['id_mobil'], 1, 0, 'C');
        $pdf->Cell(35, 10, $row['no_plat'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['merk'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['tipe'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['jenis'], 1, 0, 'C');
        $pdf->Cell(20, 10, $row['tahun'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['warna'], 1, 0, 'C');
        $pdf->Cell(45, 10, $row['harga_sewa_harian'], 1, 0, 'C');
        $pdf->Cell(45, 10, $row['status'], 1, 1, 'C');

    }

    $pdf->Output('I', 'laporan_mobil.pdf');

} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>