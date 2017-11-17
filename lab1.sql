-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2017 at 10:31 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab1`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `instructor_name` varchar(255) NOT NULL,
  `credit_hours` smallint(6) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `instructor_name`, `credit_hours`, `dept_id`) VALUES
(16, 'programming', 'conditional, looping, file I/O, structs, all in C', 'Saleh El-Shehaby', 3, 1),
(17, 'database systems', 'data modelling, ER diagrams, SQL, query optimization, Indexes, and functional dependencies', 'Yasser Fouad', 4, 1),
(18, 'Operating Systems', 'Scheduling, Synchronization, Semaphores, Processes, threads, file systems, protection, memory management', 'Ahmed El-Sayed', 3, 1),
(19, 'Algorithms', 'Divide and Conquer, Dynamic Programming, Greedy Algorithms, Amortization', 'Amr El-Marsy', 3, 1),
(20, 'Compilers', 'Lexical Analysis, Grammars, Finite Automata, Parsing, Code Generation, optimization, Garbage Collection', 'Nagia Ghanem', 3, 1),
(21, 'Thermo Dynamics', 'Laws of Thermo Dynamics, ...', 'Ma3rafsh', 3, 2),
(22, 'Electric Circuits', 'mesh Analysis, nodal Analysis, thevinen, kirchoff, AC', 'Bassem Mokhtar', 3, 2),
(23, 'Strength of Materials', 'stress, strain, bla bla', 'Someone', 3, 2),
(24, 'Mechanics of Dynamics', 'Impulse, momentum, energe, force, ...', 'Abdelfattah Rizk', 3, 2),
(25, 'Chemistry', 'reactions, moles, more useless stuff', 'Za3toot', 3, 3),
(26, 'Fluid Dynamics', 'how fluids flow', 'Name here', 3, 3),
(27, 'Concrete', 'Mixing cement with water', 'bardo ma3rafsh', 3, 4),
(28, 'Drawing', 'Missing view, autocad', 'maged naguib', 3, 4),
(29, 'Oil Rigs', 'some useless stuff', 'Mobil 1', 3, 5),
(30, 'Fishing', 'how to fish for fish', 'EL Sayyad', 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`) VALUES
(1, 'Computer and Communication Engineering', 'student will learn how to program in several languages and Fundamentals of CS'),
(2, 'Electro-Mechanical Engineering', 'student will learn the fundamentals of electrical and mechanical engineering and their composite applications'),
(3, 'Pertro-Chemical Engineering', 'Chemistry and Pertoleum refinement'),
(4, 'Construction and Archeticture Engineering', 'How to build a skyscrapper'),
(5, 'Off-Shore and Coastal Engineering', 'How to fish for fish and get paid a lot');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `course_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`course_id`, `sid`) VALUES
(16, 10),
(17, 10),
(18, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dept_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `registered_at`, `dept_id`) VALUES
(10, 'Abdelrahman', 'abdoumohamed96@gmail.com', '1234', '2017-11-17 17:40:03', 1),
(11, 'hindawy', 'hindawy@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2017-11-17 21:02:07', 3),
(12, 'islam', 'solom@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2017-11-17 21:09:55', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`course_id`,`sid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_dept_id` (`dept_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_dept_id` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
