-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 08:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmanest_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` varchar(100) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `email`, `password`, `phone`, `role`, `avatar`) VALUES
(1, 'Rajib', 'Hossain', 'rajib@gmail.com', 'rajib', '01752477208', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(20) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_status`) VALUES
(15, 'Antibiotics', 1),
(26, 'Antivirals', 1),
(27, 'Antifungals', 1),
(28, 'Analgesics', 2),
(29, 'Antipyretics', 1),
(30, ' Bronchodilators', 1),
(31, 'Corticosteroids', 1),
(32, 'Diuretics', 1),
(33, 'Immunosuppressants', 1),
(34, 'Proton Pump Inhibitors', 1),
(35, 'Statins', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(20) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` varchar(20) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `fname`, `lname`, `email`, `password`, `phone`, `role`, `avatar`) VALUES
(1, 'Ruka', 'Akther', 'ruka@gmail.com', 'ruka', '01752477210', 'manager', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(10) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `shelf_no` varchar(50) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `m_type` varchar(50) NOT NULL,
  `genetic` varchar(50) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `status` int(10) NOT NULL,
  `medicine_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `m_name`, `shelf_no`, `manufacturer`, `m_type`, `genetic`, `supplier`, `status`, `medicine_image`) VALUES
(5, 'Napa', 'N', 'Beximco Pharmaceuticals Ltd.', 'Tablet', 'Paracetamol', ' Md Sipon Ali', 1, 'uploads/napa-300x300.png'),
(10, 'Montela', 'M', 'Beximco Pharmaceuticals Ltd.', 'Capsule', 'Montelukast', ' Ali ', 1, 'uploads/esoral.jpg'),
(11, 'Amodis', 'A', 'ACI Limited', 'Tablet', 'Amlodipine', ' Md Rajib', 1, 'uploads/esoral.jpg'),
(12, 'Napa', 'T', 'Beximco Pharmaceuticals Ltd.', 'Tablet', 'Paracetamol', ' Md Sipon Ali', 1, 'uploads/napa-300x300.png'),
(13, 'Azithrocin', 'A', 'Square Pharmaceuticals Ltd.', 'Tablet', 'Azithromycin', ' Md Rajib', 1, 'uploads/images.jpeg'),
(15, 'Neotack', 'N', 'Incepta Pharmaceuticals Ltd.', 'Tablet', 'Omeprazole + Domperidone', ' Ali ', 1, 'uploads/esoral.jpg'),
(16, 'Ibuspray', 'I', 'Square Pharmaceuticals Ltd.', 'Tablet', 'Ibuprofen', ' Md Sipon Ali', 1, 'uploads/esoral.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_stock`
--

CREATE TABLE `medicine_stock` (
  `id` int(10) NOT NULL,
  `batch_no` varchar(25) DEFAULT NULL,
  `medicine_id` int(10) NOT NULL,
  `quantity` int(15) NOT NULL,
  `supp_price` double(10,2) NOT NULL,
  `sell_price` double(10,2) NOT NULL,
  `expire_date` date NOT NULL,
  `purchase_invoice` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_stock`
--

INSERT INTO `medicine_stock` (`id`, `batch_no`, `medicine_id`, `quantity`, `supp_price`, `sell_price`, `expire_date`, `purchase_invoice`) VALUES
(18, 'NAP323', 5, 300, 1.00, 3.00, '2025-11-19', 42811653),
(19, 'AME321', 10, 400, 12.00, 7.00, '2027-07-19', 42811653),
(20, 'AMO342', 11, 500, 5.00, 15.00, '2026-07-19', 42811653),
(21, 'AZI345', 13, 200, 20.00, 22.00, '2027-12-19', 51555220);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_type`
--

CREATE TABLE `medicine_type` (
  `id` int(10) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `type_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_type`
--

INSERT INTO `medicine_type` (`id`, `type_name`, `type_status`) VALUES
(1, 'Tablet', '1'),
(2, 'Capsule', '1'),
(3, 'Syrup', '1'),
(4, 'Suspension', '1'),
(5, 'Injection', '1'),
(6, 'Ampoule', '2'),
(7, 'Vial', '1'),
(8, 'Ointment', '1'),
(9, 'Cream', '1'),
(10, 'Gel', '1'),
(11, 'Inhaler', '1'),
(12, 'Nebulizer Solution', '1'),
(13, 'Drops', '1'),
(14, 'Suppository', '1'),
(15, 'Lozenge', '1'),
(16, 'Powder', '2'),
(17, 'Granules', '1'),
(18, 'Spray', '1'),
(19, 'Liquid Bottle', '1'),
(20, 'Patch', '2');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(10) NOT NULL,
  `invoice` int(13) NOT NULL,
  `supp_name` int(11) NOT NULL,
  `purch_date` date NOT NULL,
  `total_amount` double(10,2) NOT NULL,
  `discount` int(5) DEFAULT NULL,
  `receive_amount` double(10,2) DEFAULT NULL,
  `due_amount` double(10,2) DEFAULT NULL,
  `status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `invoice`, `supp_name`, `purch_date`, `total_amount`, `discount`, `receive_amount`, `due_amount`, `status`) VALUES
(18, 42811653, 6, '2025-01-19', 7600.00, 0, 7600.00, 0.00, 0),
(19, 51555220, 7, '2025-01-19', 4000.00, 0, 4000.00, 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_quantity`
--

CREATE TABLE `purchase_quantity` (
  `id` int(10) NOT NULL,
  `medicine_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `per_price` double(10,2) NOT NULL,
  `total_cost` double(10,2) NOT NULL,
  `purchase_invoice` int(15) NOT NULL,
  `batch_no` varchar(100) DEFAULT NULL,
  `sell_price` double(10,2) DEFAULT NULL,
  `expire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_quantity`
--

INSERT INTO `purchase_quantity` (`id`, `medicine_id`, `quantity`, `per_price`, `total_cost`, `purchase_invoice`, `batch_no`, `sell_price`, `expire_date`) VALUES
(16, 5, 300, 1.00, 300.00, 42811653, 'NAP323', 3.00, '2025-11-19'),
(17, 11, 400, 12.00, 4800.00, 42811653, 'AMO342', 15.00, '2026-07-19'),
(18, 10, 500, 5.00, 2500.00, 42811653, 'AME321', 7.00, '2027-07-19'),
(19, 13, 200, 20.00, 4000.00, 51555220, 'AZI345', 22.00, '2027-12-19');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_add`
--

CREATE TABLE `supplier_add` (
  `id` int(10) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `balance` double(10,2) DEFAULT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_add`
--

INSERT INTO `supplier_add` (`id`, `supplier_name`, `company`, `mobile`, `email`, `address`, `city`, `state`, `balance`, `status`) VALUES
(6, ' Md Rajib', 'Square', '01752477208', 'rajib@gmail.com', 'mirpur dhaka', 'dhaka', 'dhaka', NULL, 1),
(7, ' Md Sipon Ali', 'Beximco', '0175247720', 'siponali@gmail.com', 'Dhanmondi 27', 'Dhaka', 'Dhaka', NULL, 1),
(8, ' Ali ', 'Incepta', '0175247733', 'ali@gmail.com', 'Gazipur', 'Gazipur', 'Dhaka', NULL, 1),
(9, ' Mustafijur', 'Opsonin', '0175247711', 'mustafijur@gmail.com', '60 FEET', 'Dhaka', 'Dhaka', NULL, 1),
(10, ' Akbar Mia', 'Opsonin', '0175247711', 'akbar@gmail.com', 'Dhanmondi 29', 'Dhaka', 'Dhaka', NULL, 1),
(11, ' Ismail Hossain', 'ACI', '01828896738', 'ismail07.hossain@gmail.com', 'komisonar bhari Agargaon', 'Dhaka', 'Dhaka', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(10) NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `unit_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `unit_name`, `unit_status`) VALUES
(2, 'Pack', '1'),
(4, 'Box', '1'),
(5, '1 strip = 10 pice', '1'),
(6, 'Pic', '2'),
(7, 'Bottle', '1'),
(8, 'Carton', '1'),
(9, 'Pallet', '1'),
(12, 'whole box', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_stock`
--
ALTER TABLE `medicine_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_type`
--
ALTER TABLE `medicine_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_quantity`
--
ALTER TABLE `purchase_quantity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_add`
--
ALTER TABLE `supplier_add`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `medicine_stock`
--
ALTER TABLE `medicine_stock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `medicine_type`
--
ALTER TABLE `medicine_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `purchase_quantity`
--
ALTER TABLE `purchase_quantity`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `supplier_add`
--
ALTER TABLE `supplier_add`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
