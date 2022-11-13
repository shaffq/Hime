-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 12:07 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `himev2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `types` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `client_description` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`username`, `password`, `types`, `first_name`, `last_name`, `profile_photo`, `email`, `contact_no`, `address`, `city`, `state`, `postcode`, `client_description`, `website`) VALUES
('client1', 'client1', 'Organization', 'UniKL', 'University Kuala Lumpur', NULL, 'enquiries@unikl.edu.my', '0321754000', '1016, Jalan Sultan Ismail', 'Kuala Lumpur', 'Wilayah Persekutuan Kuala Lumpur', '50250', 'UniKL at a glance is the leading entrepreneurial technical university in Malaysia based in the heart of Malaysia\'s capital and commerce area.', 'www.unikl.edu.my'),
('client2', 'client2', 'Personal', 'Adrian', 'Brewer', NULL, 'adrian@gmail.com', '011234567891', '10 Jalan 3/109C Taman Abadi Indah', 'Kuantan', 'Pahang', '58100', 'Co-founder and Head of Design at HH Agency.', 'www.adrian.com');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `contract_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `f_username` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `contract_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`contract_id`, `job_id`, `f_username`, `payment_id`, `contract_status`) VALUES
(1, 1, 'shaffq', 'pi_3LonK4FIeo8lkpej0EXpxF8m', 'Completed'),
(2, 3, 'shaffq', 'pi_3LossOFIeo8lkpej1aAc1Saj', 'Completed'),
(3, 2, 'shaffq', 'pi_3LotIwFIeo8lkpej1N09nifC', 'RequestCompleted'),
(4, 4, 'shaffq', 'pi_3Lyp97FIeo8lkpej05D6Jgiz', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `contract_payment`
--

CREATE TABLE `contract_payment` (
  `payment_id` varchar(255) NOT NULL,
  `application_id` int(11) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_payment`
--

INSERT INTO `contract_payment` (`payment_id`, `application_id`, `payment_amount`, `payment_status`) VALUES
('pi_3LonK4FIeo8lkpej0EXpxF8m', 1, '91.50', 'Received'),
('pi_3LossOFIeo8lkpej1aAc1Saj', 4, '20.00', 'Received'),
('pi_3LotIwFIeo8lkpej1N09nifC', 2, '35.00', 'Received'),
('pi_3Lyp97FIeo8lkpej05D6Jgiz', 5, '600.00', 'Received');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer`
--

CREATE TABLE `freelancer` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `about_me` text DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freelancer`
--

INSERT INTO `freelancer` (`username`, `password`, `first_name`, `last_name`, `profile_photo`, `email`, `contact_no`, `birthdate`, `gender`, `address`, `city`, `state`, `postcode`, `bio`, `about_me`, `skills`, `languages`, `service`, `resume`) VALUES
('aidil', 'aidil', 'Aidil', 'Maula', NULL, 'aidilmaula@gmail.com', '011286649862', '2022-10-13', 'Male', '9 Jalan Kebun 8/AU2', 'Ipoh', 'Perak', '31150', 'This is my bio', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Tutor', 'Tamil', 'On Site', NULL),
('pheonix', 'pheonix', 'Pheonix', 'Baker', NULL, 'pheonix@gmail.com', '011234563764', '2018-02-13', 'Male', '10 Jalan U7/9 Taman Indah', 'Klang', 'Selangor', '87000', 'Special Education Teacher', 'I am a hard working, honest individual. I am a good timekeeper, always willing to learn new skills. I am friendly, helpful and polite, have a good sense of humor. I am able to work independently in busy environments and also within a team setting. I am outgoing and tactful, and able to listen effectively when solving problems.', 'Sign Language', 'English', 'On Site', NULL),
('shaffq', 'shaffq', 'Wan Shafiq', 'Wan Ahmad Sufian', NULL, 'wanshafiq3800@gmail.com', '01123748065', '2022-09-01', 'Male', '23 Jalan Fatwa 4, U2/46D Taman TTDI Jaya', 'Shah Alam', 'Selangor', '40150', 'High School English Teacher', 'I grew up in Shah Alam, Selangor and graduated with a Bachelor of Science in English Education degree from Millersville University in 2001 and a Master of Education in Teaching and Learning degree from Lock Haven University in 2009.', 'Tutor', 'English', 'Both', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_edu`
--

CREATE TABLE `freelancer_edu` (
  `id` int(11) NOT NULL,
  `f_username` varchar(255) NOT NULL,
  `institute` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start_date` year(4) NOT NULL,
  `end_date` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freelancer_edu`
--

INSERT INTO `freelancer_edu` (`id`, `f_username`, `institute`, `specialization`, `description`, `start_date`, `end_date`) VALUES
(1, 'shaffq', 'University Kuala Lumpur Malaysian Institute of Information Technology', 'Bachelor of Information Technology (Hons) Software Engineering', 'Recipient of Deans List for all six semesters (September 2019,\r\nJanuary 2020, July 2020, January 2021, July 2021 and January\r\n2022)', 2019, 2023),
(2, 'shaffq', 'Kolej Mara Kulim', 'Foundation in Science & Technology (FiST)', 'CGPA: 3.79', 2018, 2019),
(3, 'aidil', 'University of Malaya', 'Bachelor of Accounting', 'Graduated with First Class Honours', 2018, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_fav`
--

CREATE TABLE `freelancer_fav` (
  `fav_id` int(11) NOT NULL,
  `f_username` varchar(255) NOT NULL,
  `job_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freelancer_fav`
--

INSERT INTO `freelancer_fav` (`fav_id`, `f_username`, `job_id`) VALUES
(1, 'aidil', 4),
(2, 'shaffq', 4),
(3, 'shaffq', 5);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_social`
--

CREATE TABLE `freelancer_social` (
  `id` int(11) NOT NULL,
  `f_username` varchar(255) NOT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freelancer_social`
--

INSERT INTO `freelancer_social` (`id`, `f_username`, `instagram`, `linkedin`, `facebook`) VALUES
(1, 'shaffq', 'https://www.instagram.com/shaffq', 'https://www.linkedin.com/in/wan-shafiq-001137226', '-'),
(2, 'aidil', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_work`
--

CREATE TABLE `freelancer_work` (
  `id` int(11) NOT NULL,
  `f_username` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start_date` year(4) NOT NULL,
  `end_date` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freelancer_work`
--

INSERT INTO `freelancer_work` (`id`, `f_username`, `company`, `position`, `description`, `start_date`, `end_date`) VALUES
(1, 'shaffq', '2019 Malaysian MotoGP', 'Customer Service', 'Responsible for the product management, product design, research and product partnership teams at Google', 2019, 2019),
(2, 'aidil', 'Kumon ', 'Teacher', 'Part-Timer', 2020, 2020),
(3, 'aidil', 'Schoollah Malaysia', 'Head of Editor', 'Volunteer for SLRamadhan 2.0', 2019, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `c_username` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `job_description` text NOT NULL,
  `job_instruction` text DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `budget` decimal(15,2) NOT NULL,
  `budget_type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `location_type` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `duration` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `job_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `c_username`, `title`, `job_description`, `job_instruction`, `category`, `language`, `budget`, `budget_type`, `location`, `location_type`, `date`, `time_start`, `time_end`, `duration`, `date_created`, `job_status`) VALUES
(1, 'client1', 'Sign Language Interpreters', 'We are looking for experienced sign language interpreters to help facilitate communication between students, faculty, staff, and visitors who are deaf, hard of hearing, and hearing through the use of sign language or oral interpretation/transliteration.', 'Park at Gate B', 'Translating', 'English', '15.00', 'Hourly', 'Kuala Lumpur', 'On-Site', '2022-10-01', '08:00:00', '15:00:00', 6, '2022-09-22', 'completed'),
(2, 'client2', 'High School English - Home Tutor', 'Looking for experienced English tutor for higher education syllabus', NULL, 'Tutoring', 'English', '6.00', 'Hourly', 'Johor Baharu', 'On-Site', '2022-10-12', '13:00:00', '18:00:00', 5, '2022-09-22', 'unavailable'),
(3, 'client1', 'Olympiad Math Tutor', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'Hello', 'Tutoring', 'Mandarin', '8.00', 'Hourly', 'Google Meet', 'Remote', '2022-10-02', '10:00:00', '00:00:00', 2, '2022-09-24', 'completed'),
(4, 'client1', 'Photoshop Workshop', 'Looking for certified Adobe freelancer to teach student basics in Photoshop', NULL, 'Workshop', 'English', '600.00', 'Fixed', 'Quill City Mall', 'On-Site', '2022-10-05', '09:00:00', '17:00:00', 8, '2022-10-04', 'unavailable'),
(5, 'client1', 'Event Translator', 'Looking for translator who is fluent in English and Mandarin', NULL, 'Translation', 'Mandarin', '70.00', 'Fixed', 'UniKL MIIT', 'Remote', '2022-11-06', '18:45:00', '19:45:00', 1, '2022-11-05', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `job_application`
--

CREATE TABLE `job_application` (
  `application_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `f_username` varchar(255) NOT NULL,
  `bid` decimal(15,2) NOT NULL,
  `message` text NOT NULL,
  `additional_file` varchar(255) DEFAULT NULL,
  `application_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_application`
--

INSERT INTO `job_application` (`application_id`, `job_id`, `f_username`, `bid`, `message`, `additional_file`, `application_status`) VALUES
(1, 1, 'shaffq', '15.25', 'Hi, I am interested', NULL, 'Completed'),
(2, 2, 'shaffq', '7.00', 'Hire me please', NULL, 'Hired'),
(3, 1, 'pheonix', '17.00', 'Hello', NULL, 'Rejected'),
(4, 3, 'shaffq', '10.00', 'Good in Math', NULL, 'Completed'),
(5, 4, 'shaffq', '600.00', 'Test', NULL, 'Hired'),
(6, 5, 'shaffq', '90.00', 'Test', NULL, 'Applied'),
(7, 5, 'aidil', '70.00', 'Test', NULL, 'Applied');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `f_username` varchar(255) NOT NULL,
  `c_username` varchar(255) NOT NULL,
  `review_type` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `review_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `job_id`, `f_username`, `c_username`, `review_type`, `rating`, `feedback`, `review_time`) VALUES
(1, 1, 'shaffq', 'client1', 'c-f', '5', 'Good', '2022-10-03 15:46:16'),
(2, 1, 'shaffq', 'client1', 'f-c', '3.5', 'Easy to communicate', '2022-10-03 15:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `wallet_id` int(11) NOT NULL,
  `f_username` varchar(255) NOT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `total_earned` decimal(15,2) NOT NULL,
  `balance` decimal(15,2) DEFAULT NULL,
  `withdrawn` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`wallet_id`, `f_username`, `bank`, `account_no`, `total_earned`, `balance`, `withdrawn`) VALUES
(1, 'shaffq', 'Maybank', '162107078929', '111.50', '111.50', '0.00'),
(2, 'pheonix', 'Mayabank', '162107078929', '0.00', '0.00', '0.00'),
(3, 'aidil', NULL, NULL, '0.00', '0.00', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `f_username` (`f_username`);

--
-- Indexes for table `contract_payment`
--
ALTER TABLE `contract_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `freelancer`
--
ALTER TABLE `freelancer`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `freelancer_edu`
--
ALTER TABLE `freelancer_edu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_username` (`f_username`);

--
-- Indexes for table `freelancer_fav`
--
ALTER TABLE `freelancer_fav`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `freelancer_social`
--
ALTER TABLE `freelancer_social`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_username` (`f_username`);

--
-- Indexes for table `freelancer_work`
--
ALTER TABLE `freelancer_work`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_username` (`f_username`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `c_username` (`c_username`);

--
-- Indexes for table `job_application`
--
ALTER TABLE `job_application`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `f_username` (`f_username`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `f_username` (`f_username`),
  ADD KEY `c_username` (`c_username`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`wallet_id`),
  ADD KEY `f_username` (`f_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `freelancer_edu`
--
ALTER TABLE `freelancer_edu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `freelancer_fav`
--
ALTER TABLE `freelancer_fav`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `freelancer_social`
--
ALTER TABLE `freelancer_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `freelancer_work`
--
ALTER TABLE `freelancer_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_application`
--
ALTER TABLE `job_application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `contract_payment` (`payment_id`),
  ADD CONSTRAINT `contract_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`),
  ADD CONSTRAINT `contract_ibfk_3` FOREIGN KEY (`f_username`) REFERENCES `freelancer` (`username`);

--
-- Constraints for table `contract_payment`
--
ALTER TABLE `contract_payment`
  ADD CONSTRAINT `contract_payment_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `job_application` (`application_id`);

--
-- Constraints for table `freelancer_edu`
--
ALTER TABLE `freelancer_edu`
  ADD CONSTRAINT `freelancer_edu_ibfk_1` FOREIGN KEY (`f_username`) REFERENCES `freelancer` (`username`);

--
-- Constraints for table `freelancer_fav`
--
ALTER TABLE `freelancer_fav`
  ADD CONSTRAINT `freelancer_fav_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`);

--
-- Constraints for table `freelancer_social`
--
ALTER TABLE `freelancer_social`
  ADD CONSTRAINT `freelancer_social_ibfk_1` FOREIGN KEY (`f_username`) REFERENCES `freelancer` (`username`);

--
-- Constraints for table `freelancer_work`
--
ALTER TABLE `freelancer_work`
  ADD CONSTRAINT `freelancer_work_ibfk_1` FOREIGN KEY (`f_username`) REFERENCES `freelancer` (`username`);

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`c_username`) REFERENCES `client` (`username`);

--
-- Constraints for table `job_application`
--
ALTER TABLE `job_application`
  ADD CONSTRAINT `job_application_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`),
  ADD CONSTRAINT `job_application_ibfk_2` FOREIGN KEY (`f_username`) REFERENCES `freelancer` (`username`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`f_username`) REFERENCES `freelancer` (`username`),
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`c_username`) REFERENCES `client` (`username`);

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`f_username`) REFERENCES `freelancer` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
