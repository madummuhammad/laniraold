-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Bulan Mei 2023 pada 06.13
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnd_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`id`, `name`, `img`) VALUES
(1, 'D&D', 'IMG_3909.PNG'),
(2, 'Lanira Daily', 'IMG_3040.PNG'),
(3, 'Divana Hijab', 'IMG_5103.PNG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `confirm_payment`
--

CREATE TABLE `confirm_payment` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `deposit` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `confirm_payment`
--

INSERT INTO `confirm_payment` (`id`, `order_id`, `nama`, `bank`, `jumlah`, `deposit`, `tanggal`, `bukti`) VALUES
(2, 7, 'Test', 'BCA', 20000, '', '2023-05-16', '20230516050300swift IOS.png'),
(12, 6, 'aat', 'BCA', 83000, '2500', '2023-05-17', '202305170457012.png'),
(14, 6, 'aat', 'BCA', 54000, '4000', '2023-05-17', '20230517045812Untitled.png'),
(19, 12, 'aat', 'bca', 58450, '25000', '2023-05-22', '20230522050747Untitled1.png'),
(20, 12, 'aat', 'bca', 33450, '33450', '2023-05-22', '20230522051022swift IOS.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `footer_content`
--

CREATE TABLE `footer_content` (
  `id` int(11) NOT NULL,
  `about` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `phone` text NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `footer_content`
--

INSERT INTO `footer_content` (`id`, `about`, `contact`, `phone`, `email`) VALUES
(1, 'Now you can browse privately, and other people who use this device won’t see your activity. However, downloads, bookmarks and reading list items will be saved.', 'Jl bandar 3 no 11A kel sepanjang  Kec taman sidoarjo  Kode pos 61257', '', 'divanahijab556@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_wa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`id`, `nama`, `email`, `password`, `no_wa`) VALUES
(1, 'aat', 'ausathaulia@gmail.com', 'fc484e54710fe8d1ddecf6faf910e202', '082299160032'),
(17, 'test', 'test@gmail.com', 'fc484e54710fe8d1ddecf6faf910e202', '082299160031');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_time` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `confirm_payment` varchar(255) NOT NULL,
  `member_id` varchar(255) NOT NULL,
  `order_email` varchar(255) NOT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `order_tel` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `distrik` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `ekspedisi` varchar(255) NOT NULL,
  `paket` varchar(255) NOT NULL,
  `estimasi` varchar(255) NOT NULL,
  `ongkir` varchar(255) NOT NULL,
  `berat` varchar(255) NOT NULL,
  `voucher` varchar(255) NOT NULL,
  `resi` varchar(100) NOT NULL,
  `total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `order_time`, `order_status`, `confirm_payment`, `member_id`, `order_email`, `nama_penerima`, `order_tel`, `address`, `phone`, `provinsi`, `distrik`, `tipe`, `ekspedisi`, `paket`, `estimasi`, `ongkir`, `berat`, `voucher`, `resi`, `total`) VALUES
(4, '2023-05-15', 'order', 'Not Uploaded', '1', 'ausathaulia@gmail.com', 'Aulia Ausath', '082299160032', 'Bekasi', '082299160032', 'Jawa Barat', 'Bekasi', 'Kota', 'pos', 'Pos Nextday', '1 HARI Hari', '16000', '0', '', '', '92500'),
(5, '2023-05-15', 'order', 'On Checking', '1', 'ausathaulia@gmail.com', 'Aat', '082299160032', 'Cipinang', '082299160032', 'DKI Jakarta', 'Jakarta Timur', 'Kota', 'pos', 'Pos Reguler', '2 HARI Hari', '7000', '0', '', '', '24500'),
(6, '2023-04-16', 'order', 'On Checking', '1', 'ausathaulia@gmail.com', 'Aat', '082299160032', 'Jati Asih', '082299160032', 'Jawa Barat', 'Bekasi', 'Kota', 'jne', 'OKE', '2-3 Hari', '9000', '1.9', '', '123', '74000'),
(7, '2023-05-16', 'order', 'On Checking', '17', 'test@gmail.com', 'Test', '082299160031', 'Jakarta Selatan', '082299160032', 'DKI Jakarta', 'Jakarta Selatan', 'Kota', 'tiki', 'ECO', '3 Hari', '8000', '0.2', '', '321', '12000'),
(12, '2023-05-22', 'order', 'On Checking', '1', 'ausathaulia@gmail.com', 'Aulia Ausath', '082299160032', 'bekasi', '123', 'DKI Jakarta', 'Jakarta Selatan', 'Kota', 'tiki', 'REG', '2 Hari', '9000', '0.7', '', '', '49450');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_item`
--

CREATE TABLE `orders_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `size_id` varchar(255) NOT NULL,
  `ct_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders_item`
--

INSERT INTO `orders_item` (`id`, `order_id`, `product_id`, `product_name`, `qty`, `price`, `size_id`, `ct_status`) VALUES
(3, 4, '1', 'produk 1', '1', '12000', '1', 'order'),
(4, 4, '2', 'produk 2', '2', '14500', '4', 'order'),
(5, 4, '3', 'produk 3', '1', '11500', '7', 'order'),
(6, 4, '5', 'produk 5', '1', '17000', '23', 'order'),
(7, 4, '1', 'produk 1', '2', '11500', '2', 'order'),
(8, 5, '3', 'produk 3', '1', '12500', '5', 'order'),
(9, 5, '4', 'produk 4', '2', '6000', '10', 'order'),
(10, 6, '4', 'produk 4', '4', '6000', '10', 'order'),
(11, 6, '6', 'produk 6', '2', '25000', '25', 'order'),
(12, 7, '1', 'produk 1', '1', '12000', '1', 'order'),
(17, 12, '8', 'produk 7', '1', '24750', '29', 'order'),
(18, 12, '6', 'produk 6', '1', '24700', '25', 'order');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link_katalog` varchar(255) NOT NULL,
  `diskon_produk` int(20) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `type_product` enum('Ready Stok','PO') NOT NULL,
  `berat` decimal(15,2) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `link_katalog`, `diskon_produk`, `brand_id`, `deskripsi`, `type_product`, `berat`, `photo`, `status`) VALUES
(1, 'produk 1', '', 0, 2, 'lorem ipsum dolor sit amet', 'Ready Stok', '0.20', '20230511104029Untitled.png', 'Publish'),
(2, 'produk 2', '', 0, 3, 'lorem ipsum dolor sit amet', 'PO', '0.25', '20230511104554environtment.png', 'Publish'),
(3, 'produk 3', '', 0, 1, 'lorem ipsum dolor sit amet', 'PO', '0.30', '20230512034723Untitled2.png', 'Publish'),
(4, 'produk 4', '', 0, 3, 'lorem ipsum dolor sit amet', 'PO', '0.30', '20230512035422swift IOS.png', 'Publish'),
(5, 'produk 5', '', 0, 2, 'tes produk update', 'PO', '0.22', '202305120624352.png', 'Publish'),
(6, 'produk 6', '', 300, 1, 'tes', 'PO', '0.35', '202305160342132.png', 'Publish'),
(8, 'produk 7', 'https://www.google.com/', 250, 1, 'test', 'Ready Stok', '0.35', '20230522040145environtment.png', 'Publish');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `stok` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size`, `stok`, `price`) VALUES
(1, 1, 'S', '10', '12000'),
(2, 1, 'X', '3', '11500'),
(3, 1, 'M', '4', '13000'),
(4, 2, 'X', '6', '14500'),
(5, 3, 'XL', '30', '12500'),
(6, 3, 'S', '20', '13000'),
(7, 3, 'M', '15', '11500'),
(8, 4, 'S', '3', '5000'),
(9, 4, 'M', '4', '5500'),
(10, 4, 'L', '5', '6000'),
(12, 5, 'XL', '1', '15000'),
(23, 5, 'L', '3', '17000'),
(24, 5, 'M', '1', '23500'),
(25, 6, 'S', '38', '25000'),
(28, 7, 'a', '2', '2'),
(29, 8, 'L', '1', '25000'),
(30, 9, 'a', '2', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id`, `gambar`) VALUES
(2, '202305191033232.png'),
(3, '20230519105058Untitled2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('supervisor','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'supervisor', '01cfcd4f6b8770febfb40cb906715822', 'supervisor'),
(2, 'admin', '01cfcd4f6b8770febfb40cb906715822', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `confirm_payment`
--
ALTER TABLE `confirm_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `footer_content`
--
ALTER TABLE `footer_content`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `confirm_payment`
--
ALTER TABLE `confirm_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `footer_content`
--
ALTER TABLE `footer_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
