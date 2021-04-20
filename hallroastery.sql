-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jan 2021 pada 13.27
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hallroastery`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--

CREATE TABLE `bahan` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `desc` varchar(25) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`id`, `name`, `desc`, `stok`, `satuan`) VALUES
(29, 'Coffe late update', '-', 4003, 1),
(30, 'Vietnam drip', '-', 2000, 1),
(31, 'Laporan', '-', 45, 2),
(32, 'Bean gunung pasaman', '-', 4, 1),
(33, 'Esspreso hitam', '-', 15000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahanin`
--

CREATE TABLE `bahanin` (
  `id` int(11) NOT NULL,
  `bahan_id` int(11) NOT NULL,
  `stok_in` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `bahanin_at` date NOT NULL,
  `create_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahanin`
--

INSERT INTO `bahanin` (`id`, `bahan_id`, `stok_in`, `total_harga`, `supply_id`, `bahanin_at`, `create_at`) VALUES
(18, 32, 2, 0, 0, '2021-01-04', '2021-01-17'),
(19, 32, 2, 150000, 0, '2021-01-04', '2021-01-17'),
(20, 29, 3, 150000, 0, '2021-01-12', '2021-01-17'),
(21, 30, 2000, 150000, 0, '2021-01-14', '2021-01-17'),
(22, 31, 21, 150000, 0, '2021-01-12', '2021-01-17'),
(23, 29, 2000, 150000, 0, '2021-01-05', '2021-01-17'),
(24, 31, 21, 150000, 0, '2021-01-12', '2021-01-18'),
(25, 31, 3, 150000, 0, '2021-01-06', '2021-01-18'),
(26, 29, 2000, 150000, 0, '2021-01-04', '2021-01-18'),
(27, 33, 15000, 150000, 0, '2021-01-15', '2021-01-21');

--
-- Trigger `bahanin`
--
DELIMITER $$
CREATE TRIGGER `addStok` AFTER INSERT ON `bahanin` FOR EACH ROW BEGIN
	UPDATE bahan
    SET stok=stok+new.stok_in
    WHERE bahan.id=new.bahan_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_order`
--

CREATE TABLE `detail_order` (
  `id_order` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_order`
--

INSERT INTO `detail_order` (`id_order`, `item`, `qty`) VALUES
(3, 17, 1),
(3, 6, 1),
(6, 17, 1),
(7, 19, 1),
(8, 19, 2),
(9, 19, 2),
(9, 6, 1),
(10, 19, 1),
(10, 6, 2),
(11, 17, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `desc` varchar(25) NOT NULL,
  `price_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id`, `name`, `desc`, `price_id`, `kategori_id`) VALUES
(6, 'Vietnam drip', '-', 1, 6),
(17, ' Coffe late', '-', 1, 6),
(18, 'Coffe late Ice', '-', 2, 6),
(19, 'Americano', '-', 1, 6),
(20, 'y', 'h', 7, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `fullname` varchar(25) NOT NULL,
  `place` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(55) NOT NULL,
  `role` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL,
  `account` int(11) NOT NULL,
  `img` varchar(25) NOT NULL,
  `salary` int(11) NOT NULL,
  `gender` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `fullname`, `place`, `date`, `address`, `role`, `status`, `account`, `img`, `salary`, `gender`) VALUES
(1, 'Valda aulya', 'padang', '2020-09-01', '0', 'Admin', 'Contract', 0, 'defaul.jpg', 5000000, 'wanita'),
(2, 'Boby', 'padang', '2021-01-01', '0', 'Barista', 'Trial', 0, 'default.jpg', 10000000, 'pria'),
(3, 'Akbar', 'Bonjo', '2021-01-01', 'padang', 'Barista', 'Trial', 0, 'default.jpg', 1000000, 'pria');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `desc` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `name`, `desc`) VALUES
(6, 'Coffe', '-'),
(7, 'Non Coffe', '-'),
(9, 'Tea', '-'),
(10, 'Soft drink', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `name`, `role_id`) VALUES
(22, 'bahan', 1),
(24, 'item', 1),
(26, 'bahan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(7, '2021-01-11-042754', 'App\\Database\\Migrations\\Role', 'default', 'App', 1610444326, 1),
(8, '2021-01-11-044416', 'App\\Database\\Migrations\\Users', 'default', 'App', 1610444327, 1),
(9, '2021-01-11-181931', 'App\\Database\\Migrations\\AddIsActiveUser', 'default', 'App', 1610444327, 1),
(10, '2021-01-12-171021', 'App\\Database\\Migrations\\Menu', 'default', 'App', 1610471590, 2),
(11, '2021-01-14-052443', 'App\\Database\\Migrations\\Kategori', 'default', 'App', 1610603550, 3),
(12, '2021-01-14-095536', 'App\\Database\\Migrations\\Item', 'default', 'App', 1610618882, 4),
(13, '2021-01-14-100619', 'App\\Database\\Migrations\\Price', 'default', 'App', 1610618882, 4),
(14, '2021-01-15-144430', 'App\\Database\\Migrations\\Bahan', 'default', 'App', 1610775289, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `costumer` varchar(25) NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `costumer`, `total_transaksi`, `create_at`, `status`) VALUES
(2, 'gg', 0, '2021-01-25 10:07:52', 0),
(3, 'ibobdb', 455000, '2021-01-25 10:09:36', 1),
(4, 'gg', 20000, '2021-01-25 10:11:30', 1),
(5, 'boby', 5000, '2021-01-25 23:15:42', 1),
(6, 'bobo', 185000, '2021-01-25 23:18:01', 1),
(7, 'boby', 5000, '2021-01-25 23:32:33', 1),
(8, 'ibobdb', 30000, '2021-01-25 23:33:53', 1),
(9, 'asdas', 45000, '2021-01-26 18:02:19', 1),
(10, 'boby', 45000, '2021-01-26 20:32:03', 1),
(11, 'aa', 30000, '2021-01-26 20:34:06', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `price_item`
--

CREATE TABLE `price_item` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `price_item`
--

INSERT INTO `price_item` (`id`, `name`, `price`) VALUES
(0, '-', 0),
(1, 'Harga 1', 15000),
(2, 'Harga 2', 20000),
(4, 'harga 3', 25000),
(5, 'harga 4', 30000),
(6, 'harga 5', 35000),
(7, 'harga 6', 40000),
(8, 'harga 7', 45000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `desc` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `name`, `desc`) VALUES
(1, 'owner', ''),
(2, 'admin', ''),
(3, 'kasir', ''),
(4, 'dapur', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `kd` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id`, `name`, `kd`) VALUES
(1, 'kilogram', 'kg'),
(2, 'gram', 'g'),
(3, 'liter', 'L'),
(4, 'pcs', 'pcs'),
(5, 'box', 'box');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_menu`
--

CREATE TABLE `sub_menu` (
  `menu_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `href` varchar(255) NOT NULL,
  `icon` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(16) NOT NULL,
  `role_id` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `telp`, `role_id`, `avatar`, `create_at`, `update_at`, `is_active`) VALUES
(3, 'ibobdb05', 'bobynugraha19@gmail.com', '$2y$10$xXnrgAcP4DyTdohU/vW4HOJdwaat2T2J7BcpRq.Va0qWhc7Qzagt2', '', 1, 'default.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satuan_satuan_id_foreign` (`satuan`);

--
-- Indeks untuk tabel `bahanin`
--
ALTER TABLE `bahanin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bahanin_bahan_id_foreign` (`bahan_id`);

--
-- Indeks untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD KEY `id_order` (`id_order`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_price_id_foreign` (`price_id`),
  ADD KEY `items_kategori_id_foreign` (`kategori_id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `menu_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `price_item`
--
ALTER TABLE `price_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD KEY `sub_menu_menu_id_foreign` (`menu_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `bahanin`
--
ALTER TABLE `bahanin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `price_item`
--
ALTER TABLE `price_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD CONSTRAINT `satuan_satuan_id_foreign` FOREIGN KEY (`satuan`) REFERENCES `satuan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `bahanin`
--
ALTER TABLE `bahanin`
  ADD CONSTRAINT `bahanin_bahan_id_foreign` FOREIGN KEY (`bahan_id`) REFERENCES `bahan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `detail_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `items_price_id_foreign` FOREIGN KEY (`price_id`) REFERENCES `price_item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD CONSTRAINT `sub_menu_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
