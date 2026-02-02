-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2026 at 01:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rentiera`
--
-- --------------------------------------------------------
--
-- Table structure for table `tb_mobil`
--
CREATE TABLE
  `tb_mobil` (
    `id_mobil` int (11) NOT NULL,
    `no_plat` varchar(15) NOT NULL,
    `merk` varchar(255) NOT NULL,
    `tipe` varchar(255) NOT NULL,
    `jenis` varchar(255) NOT NULL,
    `tahun` year (4) NOT NULL,
    `warna` varchar(255) NOT NULL,
    `harga_sewa_harian` int (11) NOT NULL,
    `status` enum ('tersedia', 'disewa', 'servis') NOT NULL,
    `gambar` varchar(255) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `tb_mobil`
--
INSERT INTO
  `tb_mobil` (
    `id_mobil`,
    `no_plat`,
    `merk`,
    `tipe`,
    `jenis`,
    `tahun`,
    `warna`,
    `harga_sewa_harian`,
    `status`,
    `gambar`
  )
VALUES
  (
    1,
    'D 1234 AB',
    'Toyota',
    'Raize',
    'SUV',
    '2022',
    'Merah',
    450000,
    'tersedia',
    'toyotaRaize.jpg'
  ),
  (
    2,
    'D 5678 BD',
    'Toyota',
    'Innova Reborn',
    'MPV',
    '2021',
    'Hitam',
    600000,
    'tersedia',
    'innovaR.jpg'
  ),
  (
    3,
    'D 9012 FAI',
    'Honda',
    'Brio',
    'City Car',
    '2023',
    'Putih',
    350000,
    'tersedia',
    'hondaBrio.jpg'
  ),
  (
    4,
    'D 3456 DAB',
    'Mitsubishi',
    'Pajero Sport',
    'SUV',
    '2022',
    'Putih',
    1200000,
    'tersedia',
    'pajeroS.png'
  ),
  (
    5,
    'D 6154 XN',
    'Toyota',
    'Camry',
    'SUV',
    '2018',
    'Putih',
    700000,
    'tersedia',
    'camry.jpg'
  ),
  (
    6,
    'D 5895 HAU',
    'Toyota',
    'Vellfire',
    'MPV',
    '2019',
    'Putih',
    1100000,
    'tersedia',
    'toyotaVellfire.jpg'
  ),
  (
    7,
    'D 1234 ABC',
    'Wuling',
    'Confero',
    'MPV',
    '2022',
    'Merah',
    350000,
    'tersedia',
    'confero.jpg'
  ),
  (
    8,
    'D 5678 DEF',
    'Daihatsu',
    'Ayla',
    'City Car',
    '2021',
    'Putih',
    250000,
    'tersedia',
    'daihatsuAyla.jpg'
  ),
  (
    9,
    'D 9012 GHI',
    'Suzuki',
    'Ertiga',
    'MPV',
    '2023',
    'Putih',
    400000,
    'tersedia',
    'ertiga.jpg'
  ),
  (
    10,
    'D 3456 JKL',
    'Honda',
    'HR-V',
    'SUV',
    '2022',
    'Putih',
    600000,
    'tersedia',
    'hrv.jpg'
  ),
  (
    11,
    'D 7890 MNO',
    'Hyundai',
    'i10',
    'City Car',
    '2020',
    'Biru',
    300000,
    'tersedia',
    'hyundaiI10.jpg'
  ),
  (
    12,
    'D 1122 PQR',
    'Hyundai',
    'Staria',
    'Luxury MPV',
    '2023',
    'Hitam',
    1200000,
    'tersedia',
    'hyundaiStaria.jpg'
  ),
  (
    13,
    'D 3344 STU',
    'Kia',
    'Picanto',
    'City Car',
    '2021',
    'Putih',
    300000,
    'tersedia',
    'kiaPicanto.jpg'
  ),
  (
    14,
    'D 5566 VWX',
    'Honda',
    'Mobilio',
    'MPV',
    '2021',
    'Putih',
    400000,
    'tersedia',
    'mobilio.jpg'
  ),
  (
    15,
    'D 7788 YZA',
    'Suzuki',
    'Ignis',
    'City Car',
    '2022',
    'Putih',
    350000,
    'tersedia',
    'suzukiIgnis.jpg'
  ),
  (
    16,
    'D 9900 BCD',
    'Toyota',
    'Agya',
    'City Car',
    '2023',
    'Putih',
    300000,
    'tersedia',
    'toyotaAgya.jpg'
  ),
  (
    17,
    'D 2233 EFG',
    'Toyota',
    'Alphard',
    'Premium MPV',
    '2024',
    'Hitam',
    2500000,
    'tersedia',
    'alphard.jpg'
  ),
  (
    18,
    'D 4455 HIJ',
    'Toyota',
    'Rush',
    'SUV',
    '2022',
    'Putih',
    500000,
    'tersedia',
    'toyotaRush.jpg'
  ),
  (
    19,
    'D 8821 XYZ',
    'Mitsubishi',
    'Xpander',
    'MPV',
    '2023',
    'Putih',
    550000,
    'tersedia',
    'xpander.jpg'
  );

-- --------------------------------------------------------
--
-- Table structure for table `tb_pembayaran`
--
CREATE TABLE
  `tb_pembayaran` (
    `id_pembayaran` int (11) NOT NULL,
    `id_sewa` int (11) NOT NULL,
    `tanggal_bayar` date NOT NULL,
    `total_harga` int (11) NOT NULL,
    `status` enum ('Pending', 'Lunas', 'Batal') DEFAULT 'Pending',
    `metode_pembayaran` enum ('QRIS', 'Tunai') NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `tb_sewa`
--
CREATE TABLE
  `tb_sewa` (
    `id_sewa` int (11) NOT NULL,
    `id_user` int (11) NOT NULL,
    `id_mobil` int (11) NOT NULL,
    `tanggal_mulai` date NOT NULL,
    `tanggal_selesai` date NOT NULL,
    `total_harga` int (11) NOT NULL,
    `status_kembali` enum ('Belum', 'Sudah') DEFAULT 'Belum'
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `tb_testimoni`
--
CREATE TABLE
  `tb_testimoni` (
    `id_testimoni` int (11) NOT NULL,
    `nama` varchar(255) NOT NULL,
    `pekerjaan` varchar(255) NOT NULL,
    `gambar` varchar(255) NOT NULL,
    `rating` int (11) NOT NULL,
    `pesan` text NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `tb_testimoni`
--
INSERT INTO
  `tb_testimoni` (
    `id_testimoni`,
    `nama`,
    `pekerjaan`,
    `gambar`,
    `rating`,
    `pesan`
  )
VALUES
  (
    1,
    'Diki Wahyu',
    'Pengusaha',
    'user1.jpg',
    5,
    'Unit sangat terawat, bersih, dan wangi! Proses lepas kuncinya cepat dan sangat memudahkan. Rekomendasi terbaik!.'
  ),
  (
    2,
    'Haura Shafa',
    'Traveler',
    'user2.jpg',
    5,
    'Proses sewa gampang banget, gak ribet. Harga juga bersaing dibanding rental lain. Pasti bakal sewa lagi kalau ke Bandung.'
  ),
  (
    3,
    'Taufik Ismail',
    'Designer',
    'user3.jpg',
    4,
    'Unit mobil terawat dengan baik. Admin fast response saat dihubungi malam hari. Terima kasih Rentiera!'
  );

-- --------------------------------------------------------
--
-- Table structure for table `tb_user`
--
CREATE TABLE
  `tb_user` (
    `id_user` int (11) NOT NULL,
    `nama` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` enum ('admin', 'penyewa') NOT NULL,
    `telp` varchar(15) NOT NULL,
    `alamat` text NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--
INSERT INTO
  `tb_user` (
    `id_user`,
    `nama`,
    `email`,
    `password`,
    `role`,
    `telp`,
    `alamat`
  )
VALUES
  (
    1,
    'Maulana Yusuf Syawaludin',
    'mysya005@gmail.com',
    '0192023a7bbd73250516f069df18b500', --admin123
    'admin',
    '085632497232',
    'Cimareme'
  ),
  (
    2,
    'Diki Wahyu Permana',
    'dikwahyu@gmail.com',
    '0192023a7bbd73250516f069df18b500',
    'admin',
    '085235861342',
    'Buah Batu'
  ),
  (
    3,
    'Taufik Ismail',
    'taufik15mail@gmail.com',
    '0192023a7bbd73250516f069df18b500',
    'admin',
    '083546522875',
    'Kiaracondong'
  ),
  (
    4,
    'Haura Shafa Asila',
    'haura@gmail.com',
    '202cb962ac59075b964b07152d234b70',
    'penyewa',
    '082377245941',
    'Cimaung'
  ),
  (
    5,
    'Sherryl Azizah Aulia',
    'sherylAz@gmail.com',
    '202cb962ac59075b964b07152d234b70',
    'penyewa',
    '087259326758',
    'Kopo'
  ),
  (
    6,
    'Adrian Fathurrahman',
    'adrianajah@gmail.com',
    '202cb962ac59075b964b07152d234b70',
    'penyewa',
    '08537842227',
    'Cibaduyut'
  );

--
-- Indexes for dumped tables
--
--
-- Indexes for table `tb_mobil`
--
ALTER TABLE `tb_mobil` ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran` ADD PRIMARY KEY (`id_pembayaran`),
ADD KEY `id_booking` (`id_sewa`);

--
-- Indexes for table `tb_sewa`
--
ALTER TABLE `tb_sewa` ADD PRIMARY KEY (`id_sewa`),
ADD KEY `id_mobil` (`id_mobil`),
ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_testimoni`
--
ALTER TABLE `tb_testimoni` ADD PRIMARY KEY (`id_testimoni`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user` ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `tb_mobil`
--
ALTER TABLE `tb_mobil` MODIFY `id_mobil` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 20;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran` MODIFY `id_pembayaran` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 18;

--
-- AUTO_INCREMENT for table `tb_sewa`
--
ALTER TABLE `tb_sewa` MODIFY `id_sewa` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 26;

--
-- AUTO_INCREMENT for table `tb_testimoni`
--
ALTER TABLE `tb_testimoni` MODIFY `id_testimoni` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user` MODIFY `id_user` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 30;

--
-- Constraints for dumped tables
--
--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran` ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`id_sewa`) REFERENCES `tb_sewa` (`id_sewa`);

--
-- Constraints for table `tb_sewa`
--
ALTER TABLE `tb_sewa` ADD CONSTRAINT `tb_sewa_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `tb_mobil` (`id_mobil`),
ADD CONSTRAINT `tb_sewa_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;