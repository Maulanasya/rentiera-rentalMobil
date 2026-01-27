<?php
include 'koneksi.php';
require_once('../assets/fpdf/fpdf.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query untuk mengambil data sewa 
    $sql = "SELECT s.id_sewa, u.nama, m.merk, m.tipe, s.tanggal_mulai, s.tanggal_selesai, s.total_harga, p.status 
            FROM tb_sewa s
            JOIN tb_user u ON s.id_user = u.id_user
            JOIN tb_mobil m ON s.id_mobil = m.id_mobil
            JOIN tb_pembayaran p ON s.id_sewa = p.id_sewa
            ORDER BY s.id_sewa DESC";

    $stmt = $pdo->query($sql);

    // PDF Landscape
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();
    
    // Header Laporan
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'LAPORAN PENYEWAAN MOBIL RENTIERA', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    
    $pdf->Ln(10);

    // Header Tabel
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetFillColor(230, 230, 230); 
    $pdf->Cell(10, 10, 'No', 1, 0, 'C', true);
    $pdf->Cell(45, 10, 'Nama Penyewa', 1, 0, 'C', true);
    $pdf->Cell(45, 10, 'Unit Armada', 1, 0, 'C', true);
    $pdf->Cell(35, 10, 'Tgl Mulai', 1, 0, 'C', true);
    $pdf->Cell(35, 10, 'Tgl Selesai', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Total Bayar', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Status Bayar', 1, 1, 'C', true);

    $pdf->SetFont('Arial', '', 10);
    $no = 1;

    // Looping Data Tabel
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(10, 10, $no++, 1, 0, 'C');
        $pdf->Cell(45, 10, $row['nama'], 1, 0, 'L');
        $pdf->Cell(45, 10, $row['merk'] . ' ' . $row['tipe'], 1, 0, 'L');
        $pdf->Cell(35, 10, date('d/m/Y', strtotime($row['tanggal_mulai'])), 1, 0, 'C');
        $pdf->Cell(35, 10, date('d/m/Y', strtotime($row['tanggal_selesai'])), 1, 0, 'C');
        $pdf->Cell(40, 10, 'Rp ' . number_format($row['total_harga'], 0, ',', '.'), 1, 0, 'R');
        $pdf->Cell(40, 10, $row['status'], 1, 1, 'C');
    }

    $pdf->Output('I', 'laporan_sewa_rentiera.pdf');

} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>