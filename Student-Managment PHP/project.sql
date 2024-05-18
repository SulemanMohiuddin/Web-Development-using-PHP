-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 05:30 AM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `course_id`, `student_id`, `date`, `status`) VALUES
(1, 1, 1, '2024-04-21', 'present'),
(2, 1, 2, '2024-04-21', 'absent'),
(3, 2, 1, '2024-04-21', 'present'),
(4, 2, 2, '2024-04-21', 'Present'),
(5, 1, 1, '2024-04-22', 'present'),
(6, 1, 2, '2024-04-22', 'absent'),
(7, 2, 1, '2024-04-22', 'Present'),
(8, 2, 2, '2024-04-22', 'Present'),
(9, 1, 1, '2024-04-23', 'absent'),
(10, 1, 2, '2024-04-23', 'present'),
(11, 2, 1, '2024-04-23', 'Present'),
(12, 2, 2, '2024-04-23', 'Absent'),
(13, 1, 1, '2024-04-24', 'present'),
(14, 1, 2, '2024-04-24', 'absent'),
(15, 2, 1, '2024-04-24', 'present'),
(16, 2, 2, '2024-04-24', 'Present'),
(17, 1, 1, '2024-04-25', 'absent'),
(18, 1, 2, '2024-04-25', 'present'),
(19, 2, 1, '2024-04-25', 'present'),
(20, 2, 2, '2024-04-25', 'present'),
(21, 1, 1, '2024-04-26', 'present'),
(22, 1, 2, '2024-04-26', 'absent'),
(23, 2, 1, '2024-04-26', 'present'),
(24, 2, 2, '2024-04-26', 'present'),
(25, 1, 1, '2024-04-27', 'absent'),
(26, 1, 2, '2024-04-27', 'present'),
(27, 2, 1, '2024-04-27', 'present'),
(28, 2, 2, '2024-04-27', 'present');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `faculty_id`) VALUES
(1, 'Database Management', 1),
(2, 'Software Engineering', 2),
(3, 'Computer Networks', 1),
(4, 'Web Development', 2),
(5, 'Data Structures', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `user_id`, `name`) VALUES
(1, 'F1', 'Faculty One'),
(2, 'F2', 'Faculty Two');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `assignment_type` varchar(20) DEFAULT NULL,
  `grade` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `course_id`, `student_id`, `assignment_type`, `grade`) VALUES
(1, 1, 1, 'assignment', 85.50),
(2, 1, 2, 'assignment', 78.00),
(3, 2, 1, 'assignment', 90.00),
(4, 2, 2, 'assignment', 88.50);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `permission_type` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `role`, `permission_type`, `description`) VALUES
(1, 'admin', 'view', 'View all Attendance\r\n'),
(2, 'admin', 'view', 'View all Grades\r\n'),
(3, 'admin', 'modify', 'Manage courses\r\n'),
(4, 'admin', 'modify', 'Assign faculty\r\n'),
(6, 'admin', 'view', 'View all Users\r\n'),
(7, 'faculty', 'take_attendance', 'Attendance\r\n'),
(8, 'faculty', 'view', 'View Attendance\r\n'),
(9, 'faculty', 'view', 'View Students\r\n'),
(11, 'faculty', 'view', 'View Grades\r\n'),
(12, 'student', 'view', 'Attendace\r\n'),
(13, 'student', 'view', 'Marks\r\n'),
(14, 'student', 'update_view', 'Personal details\r\n'),
(15, 'student', 'view', 'Courses');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `courses` varchar(255) DEFAULT NULL,
  `course_ids` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_id`, `name`, `courses`, `course_ids`) VALUES
(1, 'S1', 'Student One', 'Math, English', '1'),
(2, 'S2', 'Student Two', 'Science, History', '3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','faculty','admin') NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `role`, `profile_pic`) VALUES
('A1', 'Admin1', '123', 'admin', 'default-pp.png'),
('A2', 'Admin2', '123', 'admin', 'default-pp.png'),
('A3', 'Admin3', '123', 'admin', 'default-pp.png'),
('F1', 'Professor Anderson', '123', 'faculty', 'default-pp.png'),
('F2', 'Dr. Brown', '123', 'faculty', 'default-pp.png'),
('F3', 'Ms. Wilson', '123', 'faculty', 'default-pp.png'),
('S1', 'John Doe', '123', 'student', 'default-pp.png'),
('S2', 'Alice Smith', '123', 'student', 'default-pp.png'),
('S3', 'Bob Johnson', '123', 'student', 'default-pp.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
