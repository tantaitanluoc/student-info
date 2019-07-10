--
-- Code by Vo Tan Tai
-- Contact me: tantaivo2015@gmail.com
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE `student_info`;
USE `student_info`;

CREATE TABLE `danhsach_sv` (
  `tt` int(11) DEFAULT NULL,
  `ma_so_lop` char(8) DEFAULT NULL,
  `mshv` char(8) NOT NULL,
  `sbdc` int(11) DEFAULT NULL,
  `hoten` varchar(100) DEFAULT NULL,
  `phai` varchar(5) DEFAULT NULL,
  `ngay_sinh` char(10) DEFAULT NULL,
  `noi_sinh` varchar(100) DEFAULT NULL,
  `ten_nganh` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `username` varchar(8) NOT NULL,
  `password` varchar(500) DEFAULT NULL,
  `salt` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `danhsach_sv`
  ADD PRIMARY KEY (`mshv`);
COMMIT;

ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

INSERT INTO `users` (`username`, `password`, `salt`) VALUES
('admin', 'ba515c4e4567d90572369556d32359e531dc662ad00b71f76942a108ec585b6a', 'EpUSE');
COMMIT;

