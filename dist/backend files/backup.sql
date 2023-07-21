-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 10:04 PM
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
-- Database: `hospital-portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `doctorID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `licenseNumber` int(11) NOT NULL,
  `ptrNumber` int(11) NOT NULL,
  `specialty` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`doctorID`, `name`, `password`, `licenseNumber`, `ptrNumber`, `specialty`, `email`, `mobile_number`, `address`, `birthdate`, `gender`) VALUES
(1, 'Dr Cha', 'finn', 1, 1, 'Internal Medicine', 'test@gmail.com', 22222, 'narra', '2023-07-20', 'Female'),
(2, 'Dr. Atlas', 'finn', 2, 0, 'Obstetrician-Gynecologist', 'finn@gmail.com', 2222, 'narra', '2023-07-25', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentID` int(10) NOT NULL,
  `userID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `doctorName` varchar(255) NOT NULL,
  `specialty` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `contactnumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentID`, `userID`, `doctorID`, `date`, `time`, `doctorName`, `specialty`, `username`, `useremail`, `contactnumber`) VALUES
(1, 1, 1, '2023-07-25', '9:00 am', 'Dr Cha', 'Internal Medicine', 'Mathew James Muyco', 'mjmuyco13@gmail.com', '2147483647'),
(2, 1, 2, '2023-07-21', '10:00 am', 'Dr. Atlas', 'Obstetrician-Gynecologist', 'Mathew James Muyco', 'mjmuyco13@gmail.com', '2147483647');

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `financeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `agenda` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`financeID`, `userID`, `agenda`, `doctor`, `amount`, `date`, `status`) VALUES
(1, 2, 'Check up', 'Dr. Cha', 500, '2023-07-18', 'Paid'),
(3, 1, 'test', 'test', 1000, '2023-07-05', 'paid'),
(4, 1, 'Pills', 'Dr. Cha', 1000, '2023-07-06', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `illness`
--

CREATE TABLE `illness` (
  `illnessID` int(11) NOT NULL,
  `Illness` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `notes` varchar(255) NOT NULL,
  `userID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `illness`
--

INSERT INTO `illness` (`illnessID`, `Illness`, `date`, `notes`, `userID`, `doctorID`, `status`) VALUES
(1, 'Diabetes', '2023-07-20', 'Prescribed by Dr. Cha', 1, 1, 'Ongoing Treatment'),
(2, 'PCOS', '2023-07-15', 'Prescribed by Dr.Atlas', 1, 2, 'Ongoing Treatment'),
(4, 'Diabetes', '2023-07-20', 'Prescribed by Dr. Cha', 2, 1, 'Ongoing Treatment'),
(5, 'PCOS', '2023-07-15', 'Prescribed by Dr.Atlas', 2, 2, 'Ongoing Treatment');

-- --------------------------------------------------------

--
-- Table structure for table `lab_results`
--

CREATE TABLE `lab_results` (
  `labresultID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` date NOT NULL,
  `lab_test` varchar(255) NOT NULL,
  `lab_result` varchar(255) NOT NULL,
  `normal_range` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_results`
--

INSERT INTO `lab_results` (`labresultID`, `doctorID`, `userID`, `date`, `lab_test`, `lab_result`, `normal_range`) VALUES
(1, 1, 1, '2023-07-28', 'FBS(Glucose)', '7.78 mmol/L', '30.9 - 6.4 mmol/L'),
(2, 2, 2, '2023-07-21', 'FBS(Glucose)', '7.78 mmol/L', '30.9 - 6.4 mmol/L');

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `medicineID` int(11) NOT NULL,
  `illnessID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `medicine` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `prescription_date` date NOT NULL,
  `prescription_notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medication`
--

INSERT INTO `medication` (`medicineID`, `illnessID`, `userID`, `doctorID`, `medicine`, `dosage`, `notes`, `schedule`, `prescription_date`, `prescription_notes`) VALUES
(1, 1, 1, 1, 'Metformin', '50/500mg', 'Take one (1) tablet after breakfast and dinner ', 'Everyday ', '2023-07-12', 'Prescribed'),
(2, 1, 1, 1, 'Dapagliflozin + Metformin', '10/1000mg', 'Take one (1) tablet after lunch', 'Everyday', '2023-07-12', 'Prescribed'),
(3, 2, 1, 2, '(Utrogestan)', '200mg', 'Take one (1) tablet after breakfast. Only for 10 days before expected menstruation ', '10 days, everyday, before menstruation', '2023-07-12', 'Prescribed'),
(4, 2, 1, 2, 'Multivitamins + Minerals', '500mg', 'Take one (1) tablet a day', 'Everyday', '2023-07-12', 'Prescribed'),
(5, 4, 2, 1, 'Metformin', '50/500mg', 'Take one (1) tablet after breakfast and dinner ', 'Everyday ', '2023-07-12', 'Prescribed'),
(6, 4, 2, 1, 'Dapagliflozin + Metformin', '10/1000mg', 'Take one (1) tablet after lunch', 'Everyday', '2023-07-12', 'Prescribed'),
(7, 5, 2, 2, '(Utrogestan)', '200mg', 'Take one (1) tablet after breakfast. Only for 10 days before expected menstruation ', '10 days, everyday, before menstruation', '2023-07-12', 'Prescribed'),
(8, 5, 2, 2, 'Multivitamins + Minerals', '500mg', 'Take one (1) tablet a day', 'Everyday', '2023-07-12', 'Prescribed');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `noteID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`noteID`, `userID`, `doctorID`, `notes`) VALUES
(1, 1, 1, 'Due to your medication, you might get dehydrated so drink lots of water.'),
(2, 1, 1, 'Don’t skip meals.'),
(3, 2, 2, 'Due to your medication, you might get dehydrated so drink lots of water.'),
(4, 2, 1, 'Don’t skip meals.');

-- --------------------------------------------------------

--
-- Table structure for table `patient details`
--

CREATE TABLE `patient details` (
  `patientID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `Age` int(11) NOT NULL,
  `Blood` varchar(10) NOT NULL,
  `Height` int(11) NOT NULL,
  `Weight` int(11) NOT NULL,
  `Temperature` decimal(11,0) NOT NULL,
  `Oxygen Level` int(11) NOT NULL,
  `Pulse Rate` int(11) NOT NULL,
  `Blood Pressure` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `root`
--

CREATE TABLE `root` (
  `rootID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `root`
--

INSERT INTO `root` (`rootID`, `adminID`, `password`) VALUES
(1, 1111, 1111);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `day` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleID`, `doctorID`, `day`) VALUES
(1, 1, '1,2,4'),
(2, 2, '2,3,5');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `timeID` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `doctorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`timeID`, `time`, `status`, `doctorID`) VALUES
(1, '8:00 am', 'enabled', 1),
(2, '9:00 am', 'disabled', 1),
(3, '10:00 am', 'enabled', 1),
(4, '11:00 am', 'enabled', 1),
(5, '2:00 pm', 'enabled', 1),
(6, '3:00 pm', 'enabled', 1),
(7, '4:00 pm', 'enabled', 1),
(8, '5:00 pm', 'enabled', 1),
(9, '6:00 pm', 'enabled', 1),
(10, '7:00 pm', 'enabled', 1),
(11, '8:00 am', 'enabled', 2),
(12, '9:00 am', 'enabled', 2),
(13, '10:00 am', 'disabled', 2),
(14, '11:00 am', 'enabled', 2),
(15, '2:00 pm', 'enabled', 2),
(16, '3:00 pm', 'enabled', 2),
(17, '4:00 pm', 'enabled', 2),
(18, '5:00 pm', 'enabled', 2),
(19, '6:00 pm', 'enabled', 2),
(20, '7:00 pm', 'enabled', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `contact_number` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `family` varchar(255) NOT NULL,
  `family_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `doctorID`, `first_name`, `last_name`, `email`, `gender`, `birth_date`, `contact_number`, `password`, `address`, `family`, `family_number`) VALUES
(1, 1, 'Mathew James', 'Muyco', 'mjmuyco13@gmail.com', 'Male', '2023-07-11', 2147483647, 'finn', 'Blk 11 Lot 5 Phase O (old) Brgy Narra Francisco Homes San Jose Del Monte Bulacan', 'Mathew James Palma Muyco', 2147483647),
(2, 1, 'Finn', 'Steiner', 'mathewjamespmuyco@iskolarngbayan.pup.edu.ph', 'Male', '2023-07-06', 11111, 'finn', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`doctorID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentID`),
  ADD KEY `apppointment_ibfk_2` (`userID`),
  ADD KEY `doctorID` (`doctorID`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`financeID`),
  ADD KEY `finance_ibfk_1` (`userID`);

--
-- Indexes for table `illness`
--
ALTER TABLE `illness`
  ADD PRIMARY KEY (`illnessID`),
  ADD KEY `medicine_ibfk_1` (`userID`),
  ADD KEY `illness_ibfk_2` (`doctorID`);

--
-- Indexes for table `lab_results`
--
ALTER TABLE `lab_results`
  ADD PRIMARY KEY (`labresultID`),
  ADD KEY `doctorID` (`doctorID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `medication`
--
ALTER TABLE `medication`
  ADD PRIMARY KEY (`medicineID`),
  ADD KEY `medication_ibfk_1` (`illnessID`),
  ADD KEY `medication_ibfk_2` (`userID`),
  ADD KEY `doctorID` (`doctorID`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`noteID`),
  ADD KEY `doctorID` (`doctorID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `patient details`
--
ALTER TABLE `patient details`
  ADD PRIMARY KEY (`patientID`),
  ADD KEY `patient details_ibfk_1` (`userID`);

--
-- Indexes for table `root`
--
ALTER TABLE `root`
  ADD PRIMARY KEY (`rootID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleID`),
  ADD KEY `docID` (`doctorID`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`timeID`),
  ADD KEY `doctorID` (`doctorID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `doctorID` (`doctorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `doctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `financeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `illness`
--
ALTER TABLE `illness`
  MODIFY `illnessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lab_results`
--
ALTER TABLE `lab_results`
  MODIFY `labresultID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medication`
--
ALTER TABLE `medication`
  MODIFY `medicineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `noteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient details`
--
ALTER TABLE `patient details`
  MODIFY `patientID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `root`
--
ALTER TABLE `root`
  MODIFY `rootID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `timeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`doctorID`) REFERENCES `admin` (`doctorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `finance`
--
ALTER TABLE `finance`
  ADD CONSTRAINT `finance_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `illness`
--
ALTER TABLE `illness`
  ADD CONSTRAINT `illness_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `illness_ibfk_2` FOREIGN KEY (`doctorID`) REFERENCES `admin` (`doctorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lab_results`
--
ALTER TABLE `lab_results`
  ADD CONSTRAINT `lab_results_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `admin` (`doctorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lab_results_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medication`
--
ALTER TABLE `medication`
  ADD CONSTRAINT `medication_ibfk_1` FOREIGN KEY (`illnessID`) REFERENCES `illness` (`illnessID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medication_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medication_ibfk_3` FOREIGN KEY (`doctorID`) REFERENCES `admin` (`doctorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `admin` (`doctorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient details`
--
ALTER TABLE `patient details`
  ADD CONSTRAINT `patient details_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `admin` (`doctorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `time`
--
ALTER TABLE `time`
  ADD CONSTRAINT `time_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `admin` (`doctorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `admin` (`doctorID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
