-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10 Nov 2022 pada 04.37
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbeternal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `accessoriesproduct`
--

CREATE TABLE `accessoriesproduct` (
  `id` int(4) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` varchar(30) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `accessoriesproduct`
--

INSERT INTO `accessoriesproduct` (`id`, `nama`, `deskripsi`, `harga`, `foto`) VALUES
(1, 'Redragon K630 RGB', 'Hotswappable mechanical Outemu Brown Switch, Quite/soft touch/durable keys, 61 keys, detachable cable, portable for travel, N-Key rollover / Anti-ghosting, RGB backlighting', 'Rp 505.000', 'redragon k630 rgb.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(4) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `penulis` varchar(75) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `tanggal`, `penulis`, `foto`) VALUES
(1, 'Klevv luncurkan memori komputer dukung prosesor Intel Gen ke-13', 'Serang (ANTARA) - Klevv, merek memori yang diperkenalkan Essencore, menghadirkan memori komputer U-DIMM dan SO-DIMM standar DDR5 terbaru dengan kecepatan 5600MT/s yang dirancang untuk mendukung prosesor RYZEN seri 7000 terbaru AMD dan platform AM5 serta prosesor Intel Raptor Lake Generasi ke-13 dan motherboard Z790  Jajaran memori terbaru ini menawarkan kecepatan yang sangat tinggi dengan rasio daya terhadap kinerja yang lebih efisien. Memori U-DIMM dan SO-DIMM ini dihadirkan untuk memenuhi permintaan komputasi berkecepatan tinggi yang terus meningkat seiring kian beragamnya pilihan produk.  Memori ini dirancang sesuai standar JEDEC merupakan anggota terbaru dari jajaran DDR5 U-DIMM dan SO-DIMM Klevv dengan memori 4800 MT/s yang sudah ada sebelumnya.  Tersedia dalam kapasitas 16GB per modul dengan opsi paket tunggal (16GBx1) dan ganda (16GBx2), memori Klevv DDR5 terbaru telah diuji QVL dan disetujui oleh merek motherboard terkemuka termasuk Asus, Asrock, Gigabyte, dan MSI di seluruh produk motherboard yang se', '2022-11-09', 'banten.antaranews.com', 'IMG-20221109-WA0049_800x533.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id` int(4) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `email` varchar(75) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id`, `nama`, `email`, `nohp`, `pesan`) VALUES
(1, 'Ahmad Khoirudin', 'ahmadk@gmail.com', '081328363750', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi quia similique consequatur vel eum consectetur. In fugiat voluptas dolorum repellat?'),
(2, 'Fittra Marga Ardana', 'fittracakomoli6@gmail.com', '081328363850', 'Visual Studio Code adalah perangkat lunak penyunting kode-sumber buatan Microsoft untuk Linux, macOS, dan Windows. Visual Studio Code menyediakan fitur seperti penyorotan sintaksis, penyelesaian kode, kutipan kode, merefaktor kode, pengawakutuan, dan Git.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hardwareproduct`
--

CREATE TABLE `hardwareproduct` (
  `id` int(4) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` varchar(30) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hardwareproduct`
--

INSERT INTO `hardwareproduct` (`id`, `nama`, `deskripsi`, `harga`, `foto`) VALUES
(1, 'MSI-MPG-X570S', 'Supports AMD Ryzen 5000 series, 5000 G-series, 4000 G-series, 3000 series, 3000 G-series, 2000 series and 2000 G-series desktop processors Supports DDR4 Memory, up to 5300+(OC) MHz Lightning Fast Game experience', 'Rp 4.999.000', 'MSI-MPG-X570S.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(4) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `email` varchar(75) NOT NULL,
  `barang` text NOT NULL,
  `harga` varchar(30) NOT NULL,
  `metode` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(4) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` varchar(30) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `nama`, `deskripsi`, `harga`, `foto`) VALUES
(1, 'Microsoft Office', 'Microsoft Office adalah layanan yang dibuat oleh microsoft guna menunjang peralatan komputer', 'Rp 150.000', 'office.jpg'),
(2, 'Adobe Premiere', 'Adobe Premiere adalah software editing video yang dibuat oleh adobe dengan fitur yang lengkap', 'Rp 240.000', 'Adobe-Premiere-Pro-CC2.webp'),
(3, 'Smadav AntiVirus', 'Samdav Antivirus melindungi perangkat anda dari virus virus berbahaya yang dapat merusak sistem', 'Rp 50.000', 'Smadav Pro 2021 Rev 14.6.2 Terbaru Full.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `id` int(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `hashtag` varchar(30) NOT NULL,
  `slogan1` varchar(50) NOT NULL,
  `slogan2` varchar(50) NOT NULL,
  `sejarah` text NOT NULL,
  `pendiri` varchar(75) NOT NULL,
  `tanggalberdiri` date NOT NULL,
  `logo` text NOT NULL,
  `foto` text NOT NULL,
  `linkgmaps` text NOT NULL,
  `email` varchar(75) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`id`, `nama`, `hashtag`, `slogan1`, `slogan2`, `sejarah`, `pendiri`, `tanggalberdiri`, `logo`, `foto`, `linkgmaps`, `email`, `telepon`, `alamat`) VALUES
(1, 'Eternal Computer', '#NextLevelComputer', 'The world in your hands', 'Computer For All.', 'Eternal Computer menghadirkan produk-produk Elektronik Komputer berkualitas dan juga sofware komputer seperti Motherboard, CPU, dan komponen-komponen PC lainnya. Disini juga menyediakan software-software berbasis desktop. Tak lupa juga aksesoris-aksesoris desktop yang akan membuat kalian ketagihan. Dengan mengedepankan kualitas produk, kualitas layanan penjualan serta after-sales service. Eternal Computer senantiasa berusaha untuk terus maksimal melayani kebutuhan anda dalam mendapatkan produk elektronik komputer yang anda butuhkan. Didukung oleh staff-staff profesional yang telah berpengalaman dalam memberikan rekomendasi produk serta spesifikasi yang sesuai dengan kebutuhan dan budget anda.', 'Fittra Marga Ardana, M.Kom', '2020-11-14', 'logo1.png', 'fotogedung.jpg', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3247.417104096155!2d111.03689065161996!3d-6.830903790927823!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70cc56a3b59975%3A0xe380806081a442c9!2sMassho%20Komputer!5e1!3m2!1sid!2sid!4v1667853819944!5m2!1sid!2sid\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'eternalindoteam@gmail.com', '081328363850', 'Jl. Gabus, Mojolawaran, Sugihrejo, Kec. Gabus, Kabupaten Pati, Jawa Tengah 59173');

-- --------------------------------------------------------

--
-- Struktur dari tabel `softwareproduct`
--

CREATE TABLE `softwareproduct` (
  `id` int(4) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` varchar(30) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `softwareproduct`
--

INSERT INTO `softwareproduct` (`id`, `nama`, `deskripsi`, `harga`, `foto`) VALUES
(2, 'Visual Studio Code', 'Visual Studio Code adalah perangkat lunak penyunting kode-sumber buatan Microsoft untuk Linux, macOS, dan Windows. Visual Studio Code menyediakan fitur seperti penyorotan sintaksis, penyelesaian kode, kutipan kode, merefaktor kode, pengawakutuan, dan Git.', 'Rp 500.000', 'vscode.jpg'),
(3, 'Blender', 'Blender adalah perangkat lunak sumber terbuka grafika komputer 3D. Perangkat lunak ini digunakan untuk membuat film animasi, efek visual, model cetak 3D, aplikasi 3D interaktif, dan permainan video.', 'Rp 500.000', 'blender.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `username` varchar(75) NOT NULL,
  `email` varchar(75) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `foto` text NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `email`, `telepon`, `foto`, `password`) VALUES
(1, 'Fittra Marga Ardana', 'fittracakomoli', 'fittracakomoli6@gmail.com', '081328363850', 'DSC_0617.JPG', 'fittra999'),
(2, 'Taufiqul Hakim', 'aim17', 'aim@gmail.com', '081328363550', 'DSC_0155.JPG', 'aim999');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessoriesproduct`
--
ALTER TABLE `accessoriesproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hardwareproduct`
--
ALTER TABLE `hardwareproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `softwareproduct`
--
ALTER TABLE `softwareproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessoriesproduct`
--
ALTER TABLE `accessoriesproduct`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hardwareproduct`
--
ALTER TABLE `hardwareproduct`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `softwareproduct`
--
ALTER TABLE `softwareproduct`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
