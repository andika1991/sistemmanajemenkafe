-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 03:51 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemenkafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `nama_pelanggan`, `alamat`, `email`, `nomor_telepon`) VALUES
(1, 'Andika Fikri Azhari', 'Cilacap', 'ANDIKAPSW30@GMAIL.COM', '087788758');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `foto_barang` blob DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `kondisi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `foto_produk` blob DEFAULT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `nama_menu`, `foto_produk`, `harga`, `deskripsi`) VALUES
(1, '12123412233333sssw', 0x4c414d50202831292e6a7067, '12000', 'fgrhg');

-- --------------------------------------------------------

--
-- Table structure for table `metodepembayaran`
--

CREATE TABLE `metodepembayaran` (
  `id_metode` int(11) NOT NULL,
  `nama_metode` varchar(100) DEFAULT NULL,
  `kategori_metode` varchar(100) DEFAULT NULL,
  `logo_metode` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `metodepembayaran`
--

INSERT INTO `metodepembayaran` (`id_metode`, `nama_metode`, `kategori_metode`, `logo_metode`) VALUES
(2, 'Shopepay', 'e-Wallet', 0x53686f7065655061792d4c6f676f2d504e472d31303830702d566563746f723639436f6d2d31303234783435302e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `tanggal_pesanan` date DEFAULT NULL,
  `total_harga` decimal(10,0) DEFAULT NULL,
  `status_pesanan` varchar(50) DEFAULT NULL,
  `menudibeli` varchar(1255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `id_metode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `tanggal_pesanan`, `total_harga`, `status_pesanan`, `menudibeli`, `customer_id`, `id_metode`) VALUES
(2, '2024-06-15', '2000000', 'Sukses', 'AYAM GORENG', NULL, NULL),
(3, '2024-06-14', '23000', 'Sukses', 'Coffe , Teh ,Koka kola', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservasi_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `tanggal_reservasi` date DEFAULT NULL,
  `jumlah_orang` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `nama_staff` varchar(100) DEFAULT NULL,
  `nomor_telepon` varchar(13) DEFAULT NULL,
  `posisi` varchar(100) DEFAULT NULL,
  `gaji` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `nama_supplier` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`) VALUES
(1, 'Andika', 'Azhari', 'andikapsw30@gmail.com', '$2y$10$pmUwduoA3.9/fl7TU88op.6dLbhPvIWvbmeNlP3Guw85iEmhufxQ2', '2024-06-01 13:11:44'),
(3, 'AKI', 'Azhari', 'andikapSFFsw30@gmail.com', '$2y$10$tTPdHt2IYGM9oo77m9abTOVueVHcvtXQkvJm8Lu3ZF2XE4vggY/rC', '2024-06-01 13:20:59'),
(4, 'Adim', 'adam', 'adimadam11@gmail.com', '$2y$10$W2IhSONTZYLLeCfvEYm4qeRPuDYdEu6BN5MdiATaCP9kCRL/4jTDC', '2024-06-01 14:19:59'),
(5, 'Adik', 'Aqik', 'akik123@gmail.com', '$2y$10$Spxl.Oyv7L9lpg8pJ4OuAOJ9sajm16f8PZgkQFxyIROc2sI0Pmffu', '2024-06-01 14:33:36'),
(6, 'Andika', 'Azhari', 'adib123@gmail.com', '$2y$10$nf4fYZMgGnqWzU8QMlXoN.aO7IgU4N6YYjXMUVokRun/7OpcDAPT2', '2024-06-02 02:38:56'),
(7, '', '', '', '$2y$10$HrVfIb6uzv/j0fQv7htk7On4g3e7Vu.k871o2j4g4gyJdUS.BAZaS', '2024-06-02 03:02:29'),
(9, 'abik', 'abak', 'abikabak123@gmail.com', '$2y$10$nVY4DJqCHw4bjs0buloh1ehTrrDta0ncaVqAZZJo.LUzeBovqZ.fG', '2024-06-02 03:12:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `metodepembayaran`
--
ALTER TABLE `metodepembayaran`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_customer` (`customer_id`),
  ADD KEY `fk_payment` (`id_metode`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservasi_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `metodepembayaran`
--
ALTER TABLE `metodepembayaran`
  MODIFY `id_metode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `fk_payment` FOREIGN KEY (`id_metode`) REFERENCES `metodepembayaran` (`id_metode`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
