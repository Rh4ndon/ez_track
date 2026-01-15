-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 14, 2026 at 08:56 AM
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
-- Database: `eztrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `type` enum('activity','quiz','exam','performance') NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `total_grade` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$vFBhpeNtzmholobcejTSgOt4FgUREzbSYU8NuDWN9NL6V1ChsDPpu', '2026-01-05 14:07:43', '2026-01-05 14:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `grade_level` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `grade_level`, `section_name`, `created_at`, `updated_at`) VALUES
(5, '10', 'Larry', '2026-01-06 06:49:22', '2026-01-06 07:07:49'),
(6, '9', 'Peony', '2026-01-06 06:49:29', '2026-01-06 06:49:29'),
(7, '8', 'Yellow-Wood', '2026-01-06 06:49:37', '2026-01-06 06:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `lrn` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_initial` char(2) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `lrn`, `email`, `first_name`, `last_name`, `middle_initial`, `gender`, `photo`, `section_id`, `password`, `created_at`, `updated_at`) VALUES
(2, '0123456789101112', 'daverhandon@gmail.com', 'Sample', 'Student', 'V', 'male', '1768301636_Sample_Student_sample.jpeg', 5, '$2y$10$L67UZZOA1M82B2aS.q1k1.lrGwG5.ADvBdTM8dNP4mbN/HTCFlomi', '2026-01-12 19:48:53', '2026-01-14 03:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `student_progress`
--

CREATE TABLE `student_progress` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `progress` enum('0','1') NOT NULL DEFAULT '0',
  `student_grade` decimal(5,2) DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `description`, `icon`, `time`, `created_at`, `updated_at`) VALUES
(1, 'TLE', 'Technology and Livelihood Education', 'fa-tools', NULL, '2026-01-14 04:06:45', '2026-01-14 05:08:32'),
(2, 'MAPEH', 'Music, Arts, PE, and Health', 'fa-music', NULL, '2026-01-14 04:06:45', '2026-01-14 05:08:29'),
(3, 'SCIENCE', 'Science', 'fa-flask', NULL, '2026-01-14 04:06:45', '2026-01-14 04:06:45'),
(4, 'ENGLISH', 'English', 'fa-book', NULL, '2026-01-14 04:06:45', '2026-01-14 04:06:45'),
(5, 'MATH', 'Mathematics', 'fa-calculator', NULL, '2026-01-14 04:06:45', '2026-01-14 04:06:45'),
(6, 'ESP', 'Edukasyon sa Pagpapakatao', 'fa-hands-helping', NULL, '2026-01-14 04:06:45', '2026-01-14 04:06:45'),
(7, 'FILIPINO', 'Filipino', 'fa-language', NULL, '2026-01-14 04:06:45', '2026-01-14 04:06:45'),
(8, 'AP', 'Araling Panlipunan', 'fa-globe-asia', NULL, '2026-01-14 04:06:45', '2026-01-14 04:06:45'),
(9, 'SPECIAL', 'Specialization Subject', 'fa-asterisk', NULL, '2026-01-14 04:06:45', '2026-01-14 04:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_initial` char(2) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `section_handled` int(11) DEFAULT NULL,
  `subject_handled` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `email`, `first_name`, `last_name`, `middle_initial`, `gender`, `photo`, `section_handled`, `subject_handled`, `password`, `created_at`, `updated_at`) VALUES
(2, 'dragecave@gmail.com', 'Koro', 'Sensei', 'I', 'male', '1768361682_Sampless_Teacher_koro-sensei.jpg', 6, 1, '$2y$10$uRObMaYHzKJmuro2MPsKI.7b9sOMkGI32kYtD5pcaTNOuthtFCUqq', '2026-01-12 03:11:38', '2026-01-14 05:58:40'),
(5, 'sample@gmail.com', 'New', 'Teacher', 'J', 'female', '1768190269_New_Teacher_images.jpg', 7, NULL, '$2y$10$q3KWgfOvgrO67dKehnvsFOan9lVT45xTL1BeIRVJKWoS4tIQxK.pS', '2026-01-12 03:56:50', '2026-01-12 03:57:49'),
(6, 'another@gmail.com', 'Another', 'Teacher', 'K', 'female', '1768190241_Another_Teacher_4790ed97bab39b6983c0eab51b1a6309.jpg', 5, NULL, '$2y$10$Dkpv9cg9bJa2Ka.g4xD0be5btar5kp1hmVUepk3mhKxI98PSSCSVS', '2026-01-12 03:57:21', '2026-01-12 03:57:21'),
(7, 'master@gmail.com', 'Master', 'Teacher', 'L', 'female', '1768369836_Master_Teacher_sensei.jpeg', NULL, 4, '$2y$10$8pYYYzqOSe8mww4Mh.2uwuORrCmveiGO8FlP5Ojgav3o5rHGka0Dq', '2026-01-14 05:43:15', '2026-01-14 06:02:50'),
(8, 'newsample@gmail.com', 'NewSample', 'Teacher', 'M', 'female', '1768370532_NewSample_Teacher_2416065.webp', NULL, 3, '$2y$10$pBCpE.vxVavGDBhlJNj7w.6Y.yexsfNX86cv3FGIEMgon/AZeFUl.', '2026-01-14 06:01:55', '2026-01-14 06:02:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `section_identifier` (`grade_level`,`section_name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lrn` (`lrn`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `student_progress`
--
ALTER TABLE `student_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_activity` (`student_id`,`activity_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`subject_name`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `section_handled` (`section_handled`),
  ADD KEY `subject_handled` (`subject_handled`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_progress`
--
ALTER TABLE `student_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_subject` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `student_progress`
--
ALTER TABLE `student_progress`
  ADD CONSTRAINT `student_progress_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_progress_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`section_handled`) REFERENCES `sections` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `teachers_ibfk_subject` FOREIGN KEY (`subject_handled`) REFERENCES `subjects` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
