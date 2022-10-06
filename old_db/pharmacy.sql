-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2022 at 11:23 AM
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
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentials`
--

CREATE TABLE `admin_credentials` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `USERNAME` varchar(50) COLLATE utf16_bin NOT NULL,
  `PASSWORD` varchar(50) COLLATE utf16_bin NOT NULL,
  `IS_LOGGED_IN` varchar(50) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `admin_credentials`
--

INSERT INTO `admin_credentials` (`ID`, `user_id`, `USERNAME`, `PASSWORD`, `IS_LOGGED_IN`) VALUES
(1, 1, 'Admin', 'admin123', 'true'),
(2, 2, 'Halima', 'halima123', 'true'),
(7, 6, 'Hamphrey', 'hamphrey123', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `INVOICE_ID` int(11) NOT NULL,
  `NET_TOTAL` double NOT NULL DEFAULT 0,
  `INVOICE_DATE` date NOT NULL DEFAULT current_timestamp(),
  `TOTAL_AMOUNT` double NOT NULL,
  `TOTAL_DISCOUNT` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`INVOICE_ID`, `NET_TOTAL`, `INVOICE_DATE`, `TOTAL_AMOUNT`, `TOTAL_DISCOUNT`) VALUES
(4, 2520.96, '2022-08-20', 2626, 105.04),
(5, 2626, '2022-08-20', 2626, 0),
(6, 14.55, '2022-08-20', 15, 0.45),
(7, 5161.66, '2022-08-20', 5267, 105.34),
(9, 74.7, '2022-08-20', 75, 0.3),
(10, 5199.48, '2022-08-23', 5252, 52.52),
(11, 215.6, '2022-08-30', 220, 4.4),
(12, 1120, '2022-08-30', 1120, 0);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `PACKING` varchar(20) COLLATE utf16_bin NOT NULL,
  `GENERIC_NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `SUPPLIER_NAME` varchar(100) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`ID`, `NAME`, `PACKING`, `GENERIC_NAME`, `SUPPLIER_NAME`) VALUES
(1, 'Nicip Plus', '10TAB', 'Paracetamole', 'Kilimani Pharmacy'),
(2, 'Crosin', '10tab', 'Hdsgvkvajkcbja', 'Kiran Pharma'),
(4, 'Dolo 650', '15tab', 'paracetamole', 'BDPL PHARMA'),
(5, 'Gelusil', '10TAB', 'Mint Flab', 'Desai Pharma'),
(6, 'MeriPhlomin', '15TAB', 'Merip', 'Desai Pharma'),
(8, 'HEDEX', '10TAB', 'Hedex', 'Kilimani Pharmacy'),
(10, 'Pathomills', '100MLS', 'PathoMills', 'Desans Pharma'),
(11, 'MUCOLIN', '100MLS', 'Mucolin', 'Kilimani Pharmacy'),
(12, 'PHENOPHLAIN', '10TAB', 'Phenol', 'Madawa Agencies'),
(13, 'ZUMA', '10TAB', 'Zuma', 'Mmasy Medical Supplies LTD'),
(14, 'HEDEX', '15TAB', 'Hedex', 'Mmasy Medical Supplies LTD');

-- --------------------------------------------------------

--
-- Table structure for table `medicines_stock`
--

CREATE TABLE `medicines_stock` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `BATCH_ID` varchar(20) COLLATE utf16_bin NOT NULL,
  `EXPIRY_DATE` varchar(10) COLLATE utf16_bin NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `MRP` double NOT NULL,
  `RATE` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `medicines_stock`
--

INSERT INTO `medicines_stock` (`ID`, `NAME`, `BATCH_ID`, `EXPIRY_DATE`, `QUANTITY`, `MRP`, `RATE`) VALUES
(1, 'Crosin', 'CROS12', '12/34', 5, 2626, 26),
(2, 'Gelusil', 'G327', '12/42', 7, 15, 12),
(3, 'Dolo 650', 'DOLO327', '09/23', 9, 300, 200),
(4, 'Nicip Plus', 'NI325', '05/22', 53, 32.65, 28),
(5, 'HEDEX', 'HED22', '12/23', 36, 400, 200),
(6, 'MUCOLIN', 'MUC22', '08/24', 70, 2500, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_info`
--

CREATE TABLE `pharmacy_info` (
  `ID` int(11) NOT NULL,
  `PHARMACY_NAME` varchar(50) NOT NULL,
  `ADDRESS` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `CONTACT_NUMBER` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacy_info`
--

INSERT INTO `pharmacy_info` (`ID`, `PHARMACY_NAME`, `ADDRESS`, `EMAIL`, `CONTACT_NUMBER`) VALUES
(100, 'E-Pharmacy', 'P.O Box 1259 Dodoma, Tanzania', 'info@e-pharmacy.co.tz', 622001000);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `SUPPLIER_NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `INVOICE_NUMBER` int(11) NOT NULL,
  `VOUCHER_NUMBER` int(11) NOT NULL,
  `PURCHASE_DATE` varchar(10) COLLATE utf16_bin NOT NULL,
  `TOTAL_AMOUNT` double NOT NULL,
  `PAYMENT_STATUS` varchar(20) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`SUPPLIER_NAME`, `INVOICE_NUMBER`, `VOUCHER_NUMBER`, `PURCHASE_DATE`, `TOTAL_AMOUNT`, `PAYMENT_STATUS`) VALUES
('Kilimani Pharmacy', 12, 1, '2022-08-20', 600, 'PAID'),
('Kilimani Pharmacy', 45467, 3, '2022-08-20', 3846, 'PAID'),
('Desans Pharma', 334, 5, '2022-08-20', 150000, 'PAID'),
('Kilimani Pharmacy', 654, 15, '2022-08-24', 40000, 'PAID'),
('Mmasy Medical Supplies LTD', 18426, 16, '2022-08-30', 106000, 'PAID');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `ID` int(11) NOT NULL,
  `INVOICE_NUMBER` int(11) NOT NULL,
  `MEDICINE_NAME` varchar(50) NOT NULL,
  `BATCH_ID` varchar(50) NOT NULL,
  `EXPIRY_DATE` varchar(50) NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `MRP` int(11) NOT NULL,
  `DISCOUNT` double NOT NULL,
  `TOTAL` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`ID`, `INVOICE_NUMBER`, `MEDICINE_NAME`, `BATCH_ID`, `EXPIRY_DATE`, `QUANTITY`, `MRP`, `DISCOUNT`, `TOTAL`) VALUES
(3, 9, 'Gelusil', 'G327', '12/42', 1, 15, 2, 14.7),
(4, 9, 'Dolo 650', 'DOLO327', '01/23', 2, 30, 0, 60),
(5, 10, 'Crosin', 'CROS12', '12/34', 2, 2626, 1, 5199.48),
(6, 11, 'HEDEX', 'HED22', '12/23', 2, 110, 2, 215.6),
(7, 12, 'HEDEX', 'HED22', '12/23', 2, 110, 0, 220),
(8, 12, 'Dolo 650', 'DOLO327', '09/23', 3, 300, 0, 900);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `EMAIL` varchar(100) COLLATE utf16_bin NOT NULL,
  `CONTACT_NUMBER` varchar(10) COLLATE utf16_bin NOT NULL,
  `ADDRESS` varchar(100) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`ID`, `NAME`, `EMAIL`, `CONTACT_NUMBER`, `ADDRESS`) VALUES
(1, 'Desans Pharma', 'desanpharma@gmail.com', '0789687421', 'P.O Box 3347 Dar es Salaam, Tanznia'),
(2, 'BDPL PHARMA', 'bdplpharma@gmail.com', '0645632963', 'P.O Box 3394 Dodoma, Tanzania'),
(9, 'Kilimani Pharmacy', 'kilimanipharmacy@gmail.com', '763868363', 'P.O Box 22893 Moshi, Tanzania'),
(30, 'Mmasy Medical Supplies LTD', 'mmasymedicalsupplies@info.co.tz', '0678387238', 'P.O Box 28837, Tanga Tanzania.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `firstname`, `lastname`, `email`, `contact_number`, `role`) VALUES
(1, 'Admin', 'Clintonn', 'Admin@epharmacy', '0654899387', 'Admin'),
(2, 'Halima', 'Ahmad', 'halima@epharmacy.co.tz', '0784656343', 'Cashier'),
(6, 'Hamphrey', 'Urio', 'Urio@gmail.com', '0777489384', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`INVOICE_ID`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `BATCH_ID` (`BATCH_ID`);

--
-- Indexes for table `pharmacy_info`
--
ALTER TABLE `pharmacy_info`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`VOUCHER_NUMBER`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `INVOICE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pharmacy_info`
--
ALTER TABLE `pharmacy_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `VOUCHER_NUMBER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD CONSTRAINT `admin_credentials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
