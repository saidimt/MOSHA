-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2022 at 02:00 PM
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
(1, 1, 'Admin', 'admin123', 'false'),
(2, 2, 'Halima', 'halima123', 'false'),
(3, 3, 'David', 'david123', 'false'),
(4, 4, 'Khalisa', 'khalisa123', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `Category_Type` varchar(50) NOT NULL,
  `Description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `Category_Type`, `Description`) VALUES
(1, 'Syrup', 'Syrup suitable for coughs and lung diseases.'),
(2, 'Pain Killers', 'Suitable for headaches and pains.'),
(3, 'Tablets', 'Suitable  for headaches and consumed with water.'),
(4, 'Dose', 'Doses are suitable for complex diseases.'),
(5, 'Skin Liquid', 'Skin Liquid Doses are best and efficient for skin illness.'),
(9, 'Vaccine', 'Vaccines are for Pandemics.');

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
(9, 74.7, '2022-08-20', 75, 0.3),
(10, 5199.48, '2022-08-23', 5252, 52.52),
(11, 2970, '2022-09-03', 3000, 30);

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
(1, 'Crosin', 'Tablets', 'Crosin175', 'Kiran Pharma'),
(2, 'Dolo 650', 'Tablets', 'paracetamole', 'BDPL PHARMA'),
(3, 'Gelusil', 'Tablets', 'Mint Flab', 'Desai Pharma'),
(4, 'MeriPhlomin', 'Pain Killers', 'Merip', 'Desai Pharma'),
(5, 'Hedex', 'Pain Killers', 'Hedex', 'Kilimani Pharmacy'),
(6, 'Pathomills', 'Syrup', 'PathoMills', 'Desans Pharma'),
(7, 'Zuma', 'Syrup', 'Zuma', 'Kilimani Pharmacy'),
(8, 'Johnson Johnson', 'Vaccine', 'JJ', 'BDPL PHARMA'),
(9, 'Lemonade Phenol', 'Syrup', 'Lemonade', 'Kilimani Pharmacy'),
(20, 'Coflin', 'Syrup', 'Coflin', 'Desans Pharma');

-- --------------------------------------------------------

--
-- Table structure for table `medicines_stock`
--

CREATE TABLE `medicines_stock` (
  `ID` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
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

INSERT INTO `medicines_stock` (`ID`, `medicine_id`, `NAME`, `BATCH_ID`, `EXPIRY_DATE`, `QUANTITY`, `MRP`, `RATE`) VALUES
(1, 1, 'Crosin', 'CROS12', '12/34', 5, 2626, 26),
(2, 2, 'Gelusil', 'G327', '12/42', 7, 15, 12),
(3, 3, 'Dolo 650', 'DOLO327', '09/23', 12, 300, 200),
(4, 4, 'MeriPhlomin', 'MP220', '05/24', 51, 700, 500),
(5, 7, 'Zuma', 'ZUM22', '12/24', 14, 1500, 1000),
(6, 8, 'Johnson Johnson', 'JJ300', '07/23', 40, 15000, 10000),
(8, 5, 'Hedex', 'HED22', '04/23', 30, 300, 150),
(10, 20, 'Coflin', 'COF22', '07/23', 15, 4500, 3500);

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
('Kilimani Pharmacy', 4322, 9, '2022-08-21', 400, 'PAID'),
('Kilimani Pharmacy', 3322, 10, '2022-08-21', 400, 'PAID'),
('Kilimani Pharmacy', 64653, 11, '2022-08-31', 20000, 'PAID'),
('BDPL PHARMA', 7848, 12, '2022-09-06', 400000, 'PAID'),
('Kilimani Pharmacy', 647, 13, '2022-09-07', 3750, 'PAID'),
('Kilimani Pharmacy', 454, 14, '2022-09-07', 750, 'PAID'),
('Desans Pharma', 553, 15, '2022-09-07', 60000, 'PAID'),
('Desans Pharma', 436, 16, '2022-09-07', 52500, 'PAID');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `ID` int(11) NOT NULL,
  `INVOICE_NUMBER` int(11) NOT NULL,
  `DATE` date NOT NULL DEFAULT current_timestamp(),
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

INSERT INTO `sales` (`ID`, `INVOICE_NUMBER`, `DATE`, `MEDICINE_NAME`, `BATCH_ID`, `EXPIRY_DATE`, `QUANTITY`, `MRP`, `DISCOUNT`, `TOTAL`) VALUES
(3, 9, '2022-08-20', 'Gelusil', 'G327', '12/42', 1, 15, 2, 14.7),
(4, 9, '2022-08-20', 'Dolo 650', 'DOLO327', '01/23', 2, 30, 0, 60),
(5, 10, '2022-08-23', 'Crosin', 'CROS12', '12/34', 2, 2626, 1, 5199.48),
(6, 11, '2022-09-03', 'ZUMA', 'ZUM22', '12/24', 2, 1500, 1, 2970);

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
(9, 'Kilimani Pharmacy', 'kilimanipharmacy@gmail.com', '763868363', 'P.O Box 22893 Moshi, Tanzania');

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
(3, 'David', 'Mushi', 'mushidavid@gmail.com', '0746653421', 'Pharmacist'),
(4, 'Khalisa', 'Geofrey', 'khalisageofrey@gmail.com', '0775645109', 'Owner');

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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

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
  ADD UNIQUE KEY `BATCH_ID` (`BATCH_ID`),
  ADD KEY `medicine_stock_foreign_key` (`medicine_id`);

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `invoice_sale_foreign_key` (`INVOICE_NUMBER`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `INVOICE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD CONSTRAINT `admin_credentials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  ADD CONSTRAINT `medicine_stock_foreign_key` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `invoice_sale_foreign_key` FOREIGN KEY (`INVOICE_NUMBER`) REFERENCES `invoices` (`INVOICE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
