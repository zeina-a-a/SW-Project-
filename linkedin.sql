-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 08:03 PM
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
-- Database: `linkedin`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `body` varchar(250) NOT NULL,
  `author` varchar(100) NOT NULL,
  `timestamp` date NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`, `author`, `timestamp`, `userId`) VALUES
(1, 'hellllooooo', 'helooooooooooooooooooo', 'sama', '0000-00-00', 3),
(3, 'nnn', '2222222', 'Zeina', '0000-00-00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `connections`
--

CREATE TABLE `connections` (
  `connectionId` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `status` enum('Accepted','Rejected','Pending','') NOT NULL DEFAULT 'Pending',
  `sentAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `connections`
--

INSERT INTO `connections` (`connectionId`, `senderId`, `receiverId`, `status`, `sentAt`) VALUES
(2, 3, 4, 'Pending', '2025-05-08'),
(3, 3, 2, 'Accepted', '2025-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `studying_at` varchar(160) NOT NULL,
  `from_year` date NOT NULL,
  `to_year` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `user_id`, `studying_at`, `from_year`, `to_year`, `description`) VALUES
(2, 2, 'saaaaaaaaad', '2025-05-07', '2025-05-08', 'saaaaaaaaaaaaaaaaaaaaaadddddd'),
(3, 3, 'samaaaaaaaaaaa', '2025-05-02', '2025-05-09', 'ssssssammmmmmmmmmmmmmmmmmmmmmmmmaaaaa ');

-- --------------------------------------------------------

--
-- Table structure for table `eventrequests`
--

CREATE TABLE `eventrequests` (
  `userId` int(11) NOT NULL,
  `eventId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventrequests`
--

INSERT INTO `eventrequests` (`userId`, `eventId`) VALUES
(2, 22);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `postedBy` varchar(255) NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `postedBy`, `imagePath`, `userId`) VALUES
(21, 'Event Gamed', 'You will like this event I\'m sure', 'seif', '', 7),
(22, 'Event Gamed2', 'I\'m sure you will like this event', 'seif', 'uploads/events/681cc6dc359ab_group3.jpg', 7),
(23, 'hellllooooo', 'hhhhhelllllllllo', 'zanzoona', 'uploads/events/681ced81b29db_facebook-office.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `work_at` varchar(150) NOT NULL,
  `from_year` year(4) NOT NULL,
  `to_year` year(4) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groupmembers`
--

CREATE TABLE `groupmembers` (
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `adminId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupId`, `name`, `description`, `adminId`) VALUES
(2, 'ZFRS', 'teaaaaaaaaammm grouuuuuuuuup ', 3);

-- --------------------------------------------------------

--
-- Table structure for table `jobapplications`
--

CREATE TABLE `jobapplications` (
  `userId` int(11) NOT NULL,
  `jobId` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `expectedSalary` decimal(10,0) NOT NULL,
  `yearsOfExperience` int(11) NOT NULL,
  `appliedAt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobapplications`
--

INSERT INTO `jobapplications` (`userId`, `jobId`, `fullName`, `email`, `phone`, `resume`, `expectedSalary`, `yearsOfExperience`, `appliedAt`) VALUES
(3, 1, 'sammaaaa', 'samasamy@gmail.com', '332323', 'njjfeflif', 4, 1, '2025-05-05'),
(3, 2, 'sama', 'samasamy68@gmail.com', '8878786', '../../Views/uploads/18-17-23_Zeina-Abdelhameed-Ahmed-FlowCV-Resume-20250221.pdf', 5, 11, '2025-05-05'),
(3, 3, 'sama', 'samasamy68@gmail.com', '8878786', '../../Views/uploads/19-30-26_Zeina-Abdelhameed-Ahmed-FlowCV-Resume-20250221.pdf', 5, 11, '2025-05-05'),
(5, 1, 'ganna', 'gannasamy532@gmail.com', '8878786', '../../Views/uploads/19-36-23_Zeina-Abdelhameed-Ahmed-FlowCV-Resume-20250221.pdf', 5, 11, '2025-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `jobTitle` varchar(50) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `jobDescription` text NOT NULL,
  `employmentType` enum('Full-time','Part-time','Contract','Internship','Freelance') NOT NULL,
  `location` enum('On-site','Remote','Hybrid','') NOT NULL,
  `city` varchar(100) NOT NULL,
  `salary` decimal(10,0) NOT NULL,
  `applicationDeadline` date NOT NULL,
  `contactEmail` varchar(100) NOT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `empId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `jobTitle`, `companyName`, `jobDescription`, `employmentType`, `location`, `city`, `salary`, `applicationDeadline`, `contactEmail`, `createdAt`, `empId`) VALUES
(1, 'job', 'job', '.netttttttt', 'Freelance', 'Remote', 'cairo', 12, '2025-05-05', 'zanzoon235@gmail.com', '2025-05-05', 2),
(2, 'job2 ', 'jobbbbbbbb', 'doooooot neeeeett', 'Part-time', 'On-site', 'cairo', 12, '2025-05-05', 'zanzoon235@gmail.com', '2025-05-05', 2),
(3, 'new job ro ', 'roooo', 'jobbbbbbb', 'Full-time', 'Hybrid', 'cairo', 12, '2025-05-05', 'rowidagamal33@gmail.com', '2025-05-05', 4),
(4, 'new job ro ', 'roooo', 'kihoiho', 'Full-time', 'Remote', 'cairo', 12, '2025-05-05', 'rowidagamal33@gmail.com', '2025-05-05', 4);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `language_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `imagePath`, `createdAt`, `userId`) VALUES
(1, '', '', '2025-05-05', 2),
(2, 'heloooooooooooo', '../../Views/uploads/03-11-00_admin4.jpg', '2025-05-05', 2),
(4, 'fallaaaaaaaaa7aaaaaaaaaaaaaa samaaaaaaaaaaaa', '', '2025-05-05', 3),
(5, 'اناااااااا فلااااحةةةةة (كود) و فلاااااااحةةة  عاممةةةةةة نسسسيت اقول اني فلاحة', '', '2025-05-05', 3);

-- --------------------------------------------------------

--
-- Table structure for table `savedjobs`
--

CREATE TABLE `savedjobs` (
  `userId` int(11) NOT NULL,
  `jobId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savedjobs`
--

INSERT INTO `savedjobs` (`userId`, `jobId`) VALUES
(3, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `skill_name` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `profilePhoto` varchar(255) NOT NULL,
  `isEmployer` tinyint(1) NOT NULL DEFAULT 0,
  `isPremium` tinyint(1) NOT NULL DEFAULT 0,
  `coverPhoto` varchar(255) NOT NULL DEFAULT '../../Assets/images/resources/timeline-1.jpg',
  `connectionCount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `createdAt`, `profilePhoto`, `isEmployer`, `isPremium`, `coverPhoto`, `connectionCount`) VALUES
(2, 'Zeina', 'zanzoona', 'zanzoon235@gmail.com', '123', '2025-05-05', '../../Views/uploads/02-27-18_group1.jpg', 1, 0, '', 0),
(3, 'sama', 'ss', 'samasamy68@gmail.com', '123', '2025-05-05', '../../Views/uploads/03-45-45_commenter-3.jpg', 0, 1, '../../Assets/images/timeline-1.jpg', 11),
(4, 'rowida', 'rowida g', 'rowidagamal33@gmail.com', '123', '2025-05-05', '../../Views/uploads/19-24-45_nearly1.jpg', 1, 0, '../../Assets/images/resources/timeline-1.jpg', 0),
(5, 'ganna', 'g s', 'gannasamy532@gmail.com', '123', '2025-05-05', '../../Views/uploads/19-35-35_admin4.jpg', 0, 0, '../../Assets/images/resources/timeline-1.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`connectionId`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`user_id`);

--
-- Indexes for table `eventrequests`
--
ALTER TABLE `eventrequests`
  ADD PRIMARY KEY (`userId`,`eventId`),
  ADD KEY `eventId` (`eventId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`user_id`);

--
-- Indexes for table `groupmembers`
--
ALTER TABLE `groupmembers`
  ADD PRIMARY KEY (`groupId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupId`),
  ADD KEY `adminId` (`adminId`);

--
-- Indexes for table `jobapplications`
--
ALTER TABLE `jobapplications`
  ADD PRIMARY KEY (`userId`,`jobId`),
  ADD KEY `jobId` (`jobId`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empId` (`empId`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `savedjobs`
--
ALTER TABLE `savedjobs`
  ADD PRIMARY KEY (`userId`,`jobId`),
  ADD KEY `jobId` (`jobId`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `connections`
--
ALTER TABLE `connections`
  MODIFY `connectionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eventrequests`
--
ALTER TABLE `eventrequests`
  ADD CONSTRAINT `eventrequests_ibfk_1` FOREIGN KEY (`eventId`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventrequests_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groupmembers`
--
ALTER TABLE `groupmembers`
  ADD CONSTRAINT `groupmembers_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `groups` (`groupId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupmembers_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobapplications`
--
ALTER TABLE `jobapplications`
  ADD CONSTRAINT `jobapplications_ibfk_1` FOREIGN KEY (`jobId`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobapplications_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`empId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `languages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `savedjobs`
--
ALTER TABLE `savedjobs`
  ADD CONSTRAINT `savedjobs_ibfk_1` FOREIGN KEY (`jobId`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `savedjobs_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
