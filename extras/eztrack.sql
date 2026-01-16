-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2026 at 12:21 PM
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
  `teacher_id` int(11) DEFAULT NULL,
  `total_grade` decimal(5,2) NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `activity_name`, `type`, `subject_id`, `teacher_id`, `total_grade`, `deadline`, `created_at`, `updated_at`) VALUES
(5, 'Sample Activity 1', 'activity', 3, 2, 50.00, '2026-01-23 00:00:00', '2026-01-16 07:12:20', '2026-01-16 09:36:49'),
(6, 'Sample Activity 2', 'activity', 3, 2, 50.00, '2026-01-30 00:00:00', '2026-01-16 08:12:48', '2026-01-16 08:12:48'),
(7, 'Sample Activity 3', 'activity', 3, 2, 60.00, '2026-02-06 00:00:00', '2026-01-16 08:13:08', '2026-01-16 08:13:08'),
(9, 'Sample Activity 4', 'activity', 3, 2, 60.00, '2026-02-05 00:00:00', '2026-01-16 08:54:52', '2026-01-16 08:54:52'),
(10, 'Sample Activity 5', 'activity', 3, 2, 40.00, '2026-02-13 00:00:00', '2026-01-16 09:29:20', '2026-01-16 09:29:20'),
(11, 'Sample Exam', 'exam', 3, 2, 100.00, '2026-02-20 00:00:00', '2026-01-16 09:35:23', '2026-01-16 09:35:23'),
(12, 'Act 1', 'activity', 2, 6, 50.00, '2026-01-23 00:00:00', '2026-01-16 09:49:23', '2026-01-16 09:49:23');

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
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL DEFAULT 'Monday',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room` varchar(50) DEFAULT NULL,
  `academic_year` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `teacher_id`, `subject_id`, `section_id`, `day_of_week`, `start_time`, `end_time`, `room`, `academic_year`, `created_at`, `updated_at`) VALUES
(19, 2, 1, 5, 'Monday', '07:00:00', '08:00:00', NULL, NULL, '2026-01-15 09:00:20', '2026-01-15 09:00:20'),
(20, 2, 1, 5, 'Wednesday', '07:00:00', '08:00:00', NULL, NULL, '2026-01-15 09:01:35', '2026-01-15 09:01:35'),
(21, 2, 1, 5, 'Friday', '07:00:00', '08:00:00', NULL, NULL, '2026-01-15 09:01:52', '2026-01-15 09:01:52'),
(22, 5, 2, 5, 'Monday', '08:00:00', '09:00:00', NULL, NULL, '2026-01-15 09:02:26', '2026-01-15 09:02:26'),
(23, 5, 2, 5, 'Wednesday', '08:00:00', '09:00:00', NULL, NULL, '2026-01-15 09:02:43', '2026-01-15 09:03:01'),
(24, 5, 2, 5, 'Friday', '08:00:00', '09:00:00', NULL, NULL, '2026-01-15 09:03:42', '2026-01-15 09:03:42'),
(25, 6, 3, 5, 'Monday', '09:30:00', '10:30:00', NULL, NULL, '2026-01-15 09:04:13', '2026-01-15 09:04:13'),
(26, 6, 3, 5, 'Wednesday', '09:30:00', '10:30:00', NULL, NULL, '2026-01-15 09:04:35', '2026-01-15 09:04:35'),
(27, 5, 3, 5, 'Friday', '09:30:00', '10:30:00', NULL, NULL, '2026-01-15 09:05:06', '2026-01-15 09:05:06'),
(28, 7, 4, 5, 'Monday', '10:30:00', '11:30:00', NULL, NULL, '2026-01-15 09:05:48', '2026-01-15 09:05:48'),
(29, 7, 4, 5, 'Wednesday', '10:30:00', '11:30:00', NULL, NULL, '2026-01-15 09:06:20', '2026-01-15 09:06:20'),
(30, 7, 4, 5, 'Friday', '10:30:00', '11:30:00', NULL, NULL, '2026-01-15 09:06:48', '2026-01-15 09:06:48'),
(31, 8, 5, 5, 'Monday', '13:00:00', '14:00:00', NULL, NULL, '2026-01-15 09:10:02', '2026-01-15 09:10:02'),
(32, 8, 5, 5, 'Wednesday', '13:00:00', '14:00:00', NULL, NULL, '2026-01-15 09:11:02', '2026-01-15 09:11:15'),
(33, 8, 5, 5, 'Friday', '13:00:00', '14:00:00', NULL, NULL, '2026-01-15 09:11:49', '2026-01-15 09:12:05'),
(34, 9, 6, 5, 'Monday', '14:00:00', '15:00:00', NULL, NULL, '2026-01-15 09:12:37', '2026-01-15 09:12:37'),
(35, 9, 6, 5, 'Wednesday', '14:00:00', '15:00:00', NULL, NULL, '2026-01-15 09:12:57', '2026-01-15 09:12:57'),
(36, 9, 6, 5, 'Friday', '14:00:00', '15:00:00', NULL, NULL, '2026-01-15 09:13:25', '2026-01-15 09:13:25'),
(37, 7, 7, 5, 'Monday', '15:30:00', '16:30:00', NULL, NULL, '2026-01-15 09:14:32', '2026-01-15 09:16:26'),
(38, 7, 7, 5, 'Wednesday', '15:30:00', '16:30:00', NULL, NULL, '2026-01-15 09:14:48', '2026-01-15 09:16:36'),
(39, 7, 7, 5, 'Friday', '15:30:00', '16:30:00', NULL, NULL, '2026-01-15 09:15:13', '2026-01-15 09:16:45'),
(40, 2, 10, 5, 'Tuesday', '07:00:00', '08:30:00', NULL, NULL, '2026-01-15 09:17:25', '2026-01-15 09:18:05'),
(41, 2, 10, 5, 'Thursday', '07:00:00', '08:30:00', NULL, NULL, '2026-01-15 09:17:43', '2026-01-15 09:18:14'),
(42, 9, 8, 5, 'Tuesday', '09:00:00', '10:30:00', NULL, NULL, '2026-01-15 09:18:51', '2026-01-15 09:18:51'),
(43, 9, 8, 5, 'Thursday', '09:00:00', '10:30:00', NULL, NULL, '2026-01-15 09:19:27', '2026-01-15 09:19:27');

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
(7, '8', 'Yellow-Wood', '2026-01-06 06:49:37', '2026-01-06 06:49:37'),
(10, '7', 'Example', '2026-01-15 01:05:03', '2026-01-15 01:05:03');

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
(3, '0123456789101112', 'daverhandon@gmail.com', 'Sample', 'Student', 'V', 'male', '1768438370_Dave Rhandon_Blas_sample.jpeg', 5, '$2y$10$SvR5UaV8CtpSSLxLyDQTWOFHOrU.3qyGKW.EZDKWDKMkd4QQATXfq', '2026-01-15 00:52:34', '2026-01-15 08:57:39'),
(4, '0123456789101113', 'dragecave@gmail.com', 'New', 'Student', '', 'male', '1768441944_New_Student_w6akeOS6RHqSxNR1VWL8SA.webp', 7, '$2y$10$7CGQ7O8tdei4wRekiEPCwuTaRv.m254QscHS64NYCPu6845noxYzu', '2026-01-15 01:51:11', '2026-01-15 01:52:24');

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

--
-- Dumping data for table `student_progress`
--

INSERT INTO `student_progress` (`id`, `student_id`, `activity_id`, `progress`, `student_grade`, `submitted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 5, '1', NULL, '2026-01-16 11:17:52', '2026-01-16 07:12:20', '2026-01-16 11:17:52'),
(2, 3, 6, '0', NULL, '2026-01-16 11:15:54', '2026-01-16 08:12:48', '2026-01-16 11:17:55'),
(3, 3, 7, '0', NULL, '2026-01-16 11:15:57', '2026-01-16 08:13:08', '2026-01-16 11:17:58'),
(5, 3, 9, '1', NULL, '2026-01-16 11:16:25', '2026-01-16 08:54:52', '2026-01-16 11:16:25'),
(6, 3, 10, '1', NULL, '2026-01-16 11:16:31', '2026-01-16 09:29:20', '2026-01-16 11:16:31'),
(7, 3, 11, '0', NULL, '2026-01-16 11:18:21', '2026-01-16 09:35:23', '2026-01-16 11:18:23'),
(8, 3, 12, '0', NULL, '2026-01-16 11:18:09', '2026-01-16 09:49:24', '2026-01-16 11:18:10');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `grade_level` enum('1','2','3','4','5','6','7','8','9','10','11','12') DEFAULT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `grade_level`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'TLE', '10', 'Technology and Livelihood Education', '🔧', '2026-01-14 04:06:45', '2026-01-15 08:57:52'),
(2, 'MAPEH', '10', 'Music, Arts, PE, and Health', '🎵', '2026-01-14 04:06:45', '2026-01-15 08:58:00'),
(3, 'SCIENCE', '10', 'Science', '🔬', '2026-01-14 04:06:45', '2026-01-15 08:59:11'),
(4, 'ENGLISH', '10', 'English', '📚', '2026-01-14 04:06:45', '2026-01-15 08:59:16'),
(5, 'MATH', '10', 'Mathematics', '🧮', '2026-01-14 04:06:45', '2026-01-15 08:59:22'),
(6, 'ESP', '10', 'Edukasyon sa Pagpapakatao', '❤️', '2026-01-14 04:06:45', '2026-01-15 08:59:27'),
(7, 'FILIPINO', '10', 'Filipino', '🇵🇭', '2026-01-14 04:06:45', '2026-01-15 08:59:32'),
(8, 'AP', '10', 'Araling Panlipunan', '🏛️', '2026-01-14 04:06:45', '2026-01-15 08:59:38'),
(10, 'SPECIAL', '10', 'Specialization Subject', '⭐', '2026-01-14 09:47:44', '2026-01-15 08:59:45'),
(16, 'TLE', '8', 'Technology Livelihood Education', '🔧', '2026-01-14 10:18:51', '2026-01-14 10:18:51'),
(17, 'MAPEH', '8', 'Music, Arts, PE, and Health', '🎨', '2026-01-14 10:19:26', '2026-01-14 10:19:26');

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
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `email`, `first_name`, `last_name`, `middle_initial`, `gender`, `photo`, `section_handled`, `password`, `created_at`, `updated_at`) VALUES
(2, 'dragecave@gmail.com', 'Koro', 'Sensei', 'I', 'male', '1768361682_Sampless_Teacher_koro-sensei.jpg', 6, '$2y$10$uRObMaYHzKJmuro2MPsKI.7b9sOMkGI32kYtD5pcaTNOuthtFCUqq', '2026-01-12 03:11:38', '2026-01-15 00:48:21'),
(5, 'sample@gmail.com', 'New', 'Teacher', 'J', 'female', '1768190269_New_Teacher_images.jpg', 7, '$2y$10$q3KWgfOvgrO67dKehnvsFOan9lVT45xTL1BeIRVJKWoS4tIQxK.pS', '2026-01-12 03:56:50', '2026-01-12 03:57:49'),
(6, 'daverhandon@gmail.com', 'Another', 'Teacher', 'K', 'female', '1768190241_Another_Teacher_4790ed97bab39b6983c0eab51b1a6309.jpg', 5, '$2y$10$Dkpv9cg9bJa2Ka.g4xD0be5btar5kp1hmVUepk3mhKxI98PSSCSVS', '2026-01-12 03:57:21', '2026-01-16 09:47:52'),
(7, 'master@gmail.com', 'Master', 'Teacher', 'L', 'female', '1768369836_Master_Teacher_sensei.jpeg', NULL, '$2y$10$8pYYYzqOSe8mww4Mh.2uwuORrCmveiGO8FlP5Ojgav3o5rHGka0Dq', '2026-01-14 05:43:15', '2026-01-14 06:02:50'),
(8, 'newsample@gmail.com', 'NewSample', 'Teacher', 'M', 'female', '1768370532_NewSample_Teacher_2416065.webp', NULL, '$2y$10$pBCpE.vxVavGDBhlJNj7w.6Y.yexsfNX86cv3FGIEMgon/AZeFUl.', '2026-01-14 06:01:55', '2026-01-14 06:02:39'),
(9, 'kakashi@gmail.com', 'Si', 'Kakashi', 'R', 'male', '1768380404_Sir_Kakashi_kakashi.jpg', NULL, '$2y$10$imx0eXC1Q7Itp4P6LkDVQOevNIawD0slzhnomkwz5t44QZDrWPdY6', '2026-01-14 08:46:44', '2026-01-14 08:46:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_teacher` (`teacher_id`),
  ADD KEY `idx_subject` (`subject_id`),
  ADD KEY `idx_section` (`section_id`),
  ADD KEY `idx_day` (`day_of_week`),
  ADD KEY `idx_academic_year` (`academic_year`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `section_handled` (`section_handled`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_progress`
--
ALTER TABLE `student_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_subject` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `activities_ibfk_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `fk_section_schedule` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subject_schedule` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_teacher_schedule` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`section_handled`) REFERENCES `sections` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
