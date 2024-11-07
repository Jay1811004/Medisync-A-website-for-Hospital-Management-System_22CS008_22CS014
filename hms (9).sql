-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 09:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `profile`) VALUES
(1, 'Devendra', 'd123', '');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `doctor_id` varchar(100) NOT NULL,
  `appointment_date` varchar(100) NOT NULL,
  `symptoms` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date_booked` varchar(100) NOT NULL,
  `patient_id` int(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `amount_paid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `firstname`, `surname`, `gender`, `phone`, `doctor_id`, `appointment_date`, `symptoms`, `status`, `date_booked`, `patient_id`, `description`, `amount_paid`) VALUES
(1, 'Yuvraj', 'Chauhan', 'Male', '9945152789', '5', '2024-10-08', 'chest pain', 'Discharge', '2024-09-08 15:07:28', 1, 'do ecg', 800),
(2, 'Yuvraj', 'Chauhan', 'Male', '9945152789', '1', '2024-10-10', 'stomach ache', 'Discharge', '2024-10-09 12:01:07', 1, 'avoid consuming oily food', 2000),
(3, 'Harmit', 'Patel', 'Male', '987421782', '1', '2024-10-11', 'nausea', 'Discharge', '2024-10-09 12:17:16', 2, 'Take sufficient rest and drink more water', 800),
(4, 'Harmit', 'Patel', 'Male', '987421782', '1', '2024-10-17', 'Throat Pain', 'Discharge', '2024-10-09 12:19:31', 2, 'Drink warm water', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `experience` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salary` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `date_reg` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `profile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `firstname`, `surname`, `username`, `email`, `gender`, `phone`, `city`, `qualification`, `experience`, `password`, `salary`, `department`, `date_reg`, `status`, `profile`) VALUES
(1, 'Jayesh', 'Patel', 'jayesh', 'jayesh.patel123@gmail.com', 'Male', '9876543210', 'Ankleshwar', 'MBBS', '5', '12345678', '75000', 'General Medicine', '2019-08-15', 'Approved', ''),
(2, 'Mehul', 'Shah', 'mehul', 'mehul.shah456@gmail.com', 'Male', '9876543211', 'Surat', 'MD', '6', '12345678', '78000', 'General Medicine', '2020-04-12', 'Approved', ''),
(3, 'Pooja', 'Desai', 'pooja', 'pooja.desai789@gmail.com', 'Female', '9876543212', 'Vadodara', 'DCH', '4', '12345678', '70000', 'Pediatrics', '2019-06-18', 'Approved', 'Screenshot_2024-09-08_210925-removebg-preview.png'),
(4, 'Vijay', 'Thakkar', 'vijay', 'vijay.thakkar321@gmail.com', 'Male', '9876543213', 'Bharuch', 'DNB', '5', '12345678', '73000', 'Pediatrics', '2020-03-20', 'Approved', ''),
(5, 'Kiran', 'Patel', 'kiran', 'kiran.patel654@gmail.com', 'Female', '9876543214', 'Surat', 'DM', '7', '12345678', '90000', 'Cardiology', '2018-09-25', 'Approved', ''),
(6, 'Hiren', 'Mehta', 'hiren', 'hiren.mehta987@gmail.com', 'Male', '9876543215', 'Navsari', 'MS', '6', '12345678', '82000', 'Orthopedics', '2019-12-10', 'Approved', ''),
(7, 'Sneha', 'Joshi', 'sneha', 'sneha.joshi654@gmail.com', 'Female', '9876543216', 'Vadodara', 'DNB', '5', '12345678', '80000', 'Orthopedics', '2021-05-22', 'Approved', ''),
(8, 'Alpa', 'Shah', 'alpa', 'alpa.shah321@gmail.com', 'Female', '9876543217', 'Bharuch', 'BPT', '4', '12345678', '75000', 'Physiotherapy', '2020-07-14', 'Approved', ''),
(9, 'Parth', 'Vyas', 'parth', 'parth.vyas987@gmail.com', 'Male', '9876543218', 'Surat', 'MPT', '5', '12345678', '78000', 'Physiotherapy', '2019-11-30', 'Approved', ''),
(10, 'Suresh', 'Shah', 'suresh', 'suresh.shah654@gmail.com', 'Male', '9876543219', 'Ankleshwar', 'MS', '8', '12345678', '85000', 'Ophthalmology', '2018-01-15', 'Approved', ''),
(11, 'Payal', 'Patel', 'payal', 'payal.patel321@gmail.com', 'Female', '9876543220', 'Navsari', 'DDV', '7', '12345678', '87000', 'Dermatology', '2020-09-25', 'Approved', ''),
(12, 'neepa', 'shah', 'neepa', 'neepa7514@gmail.com', 'Female', '9547812458', 'Surat', 'M.D.', '5', '12345678', '0', '', '2024-09-08 15:33:58', 'pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(100) NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `patient` varchar(100) NOT NULL,
  `date_discharge` varchar(100) NOT NULL,
  `amount_paid` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `doctor`, `patient`, `date_discharge`, `amount_paid`, `description`) VALUES
(1, 'kiran', 'Yuvraj', '2024-09-08 15:15:11', '800', 'do ecg'),
(2, 'jayesh', 'Harmit', '2024-10-09 12:27:59', '800', 'Take sufficient rest and drink more water'),
(3, 'jayesh', 'Harmit', '2024-10-09 12:32:33', '1000', 'Drink warm water'),
(4, 'jayesh', 'Yuvraj', '2024-10-09 13:36:34', '2000', 'v+');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_reg` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `firstname`, `surname`, `username`, `email`, `gender`, `phone`, `city`, `password`, `date_reg`, `profile`) VALUES
(1, 'Yuvraj', 'Chauhan', 'yuvraj', 'yuvraj4322@gmail.com', 'Male', '9945152789', 'Surat', '123', '2024-09-08 15:05:29', 'doctor.jpg'),
(2, 'Harmit', 'Patel', 'harmit', 'harmit4735@gmail.com', 'Male', '987421782', 'Bharuch', '123', '2024-10-09 12:15:59', 'doctor.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `username` varchar(100) NOT NULL,
  `date_send` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `experience` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `date_reg` varchar(100) NOT NULL,
  `salary` int(10) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstname`, `surname`, `username`, `email`, `gender`, `phone`, `city`, `qualification`, `role`, `experience`, `password`, `status`, `date_reg`, `salary`, `department`) VALUES
(1, 'Nisha', 'Kumar', 'nisha', 'nisha.kumar9876543211@gmail.com', 'Female', '9876543211', 'Surat', 'B.Sc Nursing', 'nurse', '5 years', 'nisha123', 'Approved', '2021-05-15', 30000, 'General Medicine'),
(2, 'Rajesh', 'Mehra', 'rajesh', 'rajesh.mehra9876543212@gmail.com', 'Male', '9876543212', 'Surat', 'M.Sc Nursing', 'nurse', '6 years', 'rajesh123', 'Approved', '2020-09-22', 32000, 'General Medicine'),
(3, 'Seema', 'Rani', 'seema', 'seema.rani9876543213@gmail.com', 'Female', '9876543213', 'Surat', 'B.Sc Nursing', 'nurse', '4 years', 'seema123', 'Approved', '2021-01-11', 28000, 'General Medicine'),
(4, 'Amit', 'Patel', 'amit', 'amit.patel9876543214@gmail.com', 'Male', '9876543214', 'Surat', 'M.Sc Nursing', 'nurse', '5 years', 'amit123', 'Approved', '2020-07-30', 30000, 'General Medicine'),
(5, 'Anjali', 'Verma', 'anjali', 'anjali.verma9876543215@gmail.com', 'Female', '9876543215', 'Surat', 'B.Sc Nursing', 'nurse', '5 years', 'anjali123', 'Approved', '2021-02-20', 29000, 'Pediatrics'),
(6, 'Ravi', 'Sharma', 'ravi', 'ravi.sharma9876543216@gmail.com', 'Male', '9876543216', 'Surat', 'M.Sc Nursing', 'nurse', '6 years', 'ravi123', 'Approved', '2020-08-18', 31000, 'Pediatrics'),
(7, 'Sita', 'Yadav', 'sita', 'sita.yadav9876543217@gmail.com', 'Female', '9876543217', 'Surat', 'B.Sc Nursing', 'nurse', '4 years', 'sita123', 'Approved', '2021-07-25', 28000, 'Pediatrics'),
(8, 'Manoj', 'Singh', 'manoj', 'manoj.singh9876543218@gmail.com', 'Male', '9876543218', 'Surat', 'M.Sc Nursing', 'nurse', '5 years', 'manoj123', 'Approved', '2020-04-14', 30000, 'Pediatrics'),
(9, 'Aarti', 'Mehta', 'aarti', 'aarti.mehta9876543219@gmail.com', 'Female', '9876543219', 'Surat', 'B.Sc Nursing', 'nurse', '4 years', 'aarti123', 'Approved', '2022-03-18', 29000, 'Cardiology'),
(10, 'Ravi', 'Patel', 'ravi', 'ravi.patel9876543220@gmail.com', 'Male', '9876543220', 'Surat', 'M.Sc Nursing', 'nurse', '5 years', 'ravi123', 'Approved', '2021-11-05', 31000, 'Cardiology'),
(11, 'Priya', 'Joshi', 'priya', 'priya.joshi9876543221@gmail.com', 'Female', '9876543221', 'Surat', 'B.Sc Nursing', 'nurse', '3 years', 'priya123', 'Approved', '2022-08-25', 27000, 'Orthopedics'),
(12, 'Rohit', 'Sharma', 'rohit', 'rohit.sharma9876543222@gmail.com', 'Male', '9876543222', 'Surat', 'M.Sc Nursing', 'nurse', '4 years', 'rohit123', 'Approved', '2021-12-12', 29000, 'Orthopedics'),
(13, 'Asha', 'Sinha', 'asha', 'asha.sinha9876543223@gmail.com', 'Female', '9876543223', 'Surat', 'B.Sc Nursing', 'nurse', '3 years', 'asha123', 'Approved', '2022-04-15', 27000, 'Orthopedics'),
(14, 'Vikram', 'Patel', 'vikram', 'vikram.patel9876543224@gmail.com', 'Male', '9876543224', 'Surat', 'M.Sc Nursing', 'nurse', '4 years', 'vikram123', 'Approved', '2021-10-10', 29000, 'Orthopedics'),
(15, 'Anita', 'Rao', 'anita', 'anita.rao9876543225@gmail.com', 'Female', '9876543225', 'Surat', 'B.Sc Nursing', 'nurse', '2 years', 'anita123', 'Approved', '2023-04-10', 26000, 'Physiotherapy'),
(16, 'Suresh', 'Singh', 'suresh', 'suresh.singh9876543226@gmail.com', 'Male', '9876543226', 'Surat', 'M.Sc Nursing', 'nurse', '3 years', 'suresh123', 'Approved', '2022-05-29', 28000, 'Physiotherapy'),
(17, 'Meena', 'Jain', 'meena', 'meena.jain9876543227@gmail.com', 'Female', '9876543227', 'Surat', 'B.Sc Nursing', 'nurse', '1 year', 'meena123', 'Approved', '2023-06-15', 25000, 'Ophthalmology'),
(18, 'Vikram', 'Kumar', 'vikram', 'vikram.kumar9876543228@gmail.com', 'Male', '9876543228', 'Surat', 'M.Sc Nursing', 'nurse', '2 years', 'vikram123', 'Approved', '2022-09-10', 27000, 'Ophthalmology'),
(19, 'Rita', 'Mishra', 'rita', 'rita.mishra9876543229@gmail.com', 'Female', '9876543229', 'Surat', 'B.Sc Nursing', 'nurse', '1 year', 'rita123', 'Approved', '2023-07-20', 26000, 'Dermatology'),
(20, 'Amit', 'Patel', 'amit', 'amit.patel9876543230@gmail.com', 'Male', '9876543230', 'Surat', 'M.Sc Nursing', 'nurse', '2 years', 'amit123', 'Approved', '2022-11-12', 28000, 'Dermatology'),
(21, 'Kunal', 'Mehta', 'kunal123', 'kunal.mehta1@gmail.com', 'Male', '9876543204', 'Surat', 'B.Pharm', 'Pharmacist', '5', '12345678', 'Approved', '2019-03-15', 35000, ''),
(22, 'Maya', 'Rani', 'maya456', 'maya.rani2@gmail.com', 'Female', '9876543205', 'Surat', 'M.Pharm', 'Pharmacist', '4', '12345678', 'Approved', '2020-08-22', 34000, ''),
(23, 'Ravi', 'Patel', 'ravi789', 'ravi.patel3@gmail.com', 'Male', '9876543206', 'Surat', 'B.Pharm', 'Pharmacist', '3', '12345678', 'Approved', '2021-11-05', 32000, ''),
(24, 'Aarti', 'Patel', 'aarti123', 'aarti.patel1@gmail.com', 'Female', '9876543201', 'Surat', 'B.A.', 'Receptionist', '2', '12345678', 'Approved', '2022-05-15', 25000, ''),
(25, 'Ravi', 'Sharma', 'ravi456', 'ravi.sharma2@gmail.com', 'Male', '9876543202', 'Surat', 'B.Com', 'Receptionist', '3', '12345678', 'Approved', '2021-07-20', 27000, ''),
(26, 'Neeta', 'Desai', 'neeta789', 'neeta.desai3@gmail.com', 'Female', '9876543203', 'Surat', 'B.Sc', 'Receptionist', '2', '12345678', 'Approved', '2023-01-10', 25000, ''),
(27, 'Radhi', 'Patel', 'Radhi', 'radhi7845@gmail.com', 'Female', '9745187235', 'Surat', 'MBA', 'receptionist', '2', '12345678', 'pending', '2024-09-08 15:26:38', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
