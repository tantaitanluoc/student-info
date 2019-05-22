-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 22, 2019 lúc 10:27 PM
-- Phiên bản máy phục vụ: 10.1.40-MariaDB
-- Phiên bản PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `student_info`
--
CREATE DATABASE IF NOT EXISTS `student_info` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `student_info`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhsach_sv`
--

CREATE TABLE `danhsach_sv` (
  `mssv` char(8) NOT NULL,
  `hoten` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `gioitinh` varchar(5) DEFAULT NULL,
  `sdt` char(11) DEFAULT NULL,
  `ngaysinh` char(10) DEFAULT NULL,
  `lop` char(10) DEFAULT NULL,
  `diachi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `danhsach_sv`
--

INSERT INTO `danhsach_sv` (`mssv`, `hoten`, `gioitinh`, `sdt`, `ngaysinh`, `lop`, `diachi`) VALUES
('B1203094', 'jdfosf', 'Nam', '799680910', '35828', 'DI15V7A2', 'Cáº§n ThÆ¡'),
('B1234932', 'Æ°3www', 'Nam', '799680912', '35830', 'DI15V7A2', 'Cáº§n ThÆ¡'),
('B1240020', 'zÃ¡dfs', 'PÃª Ä', '799680918', '35836', 'DI15V7A2', 'KiÃªn Giang'),
('B1402000', 'ewr', 'PÃª Ä', '799680920', '35838', 'DI15V7A2', 'SÃ³c TrÄƒng'),
('B1409234', 'rÃªtrter', 'Ná»¯', '799680915', '35833', 'DI15V7A1', 'VÄ©nh Long'),
('B1500028', 'Æ°erwer', 'PÃª Ä', '799680919', '35837', 'DI15V7A2', 'SÃ³c TrÄƒng'),
('B1500048', 'QuÃ¡ch ÄÃ¬nh Khang', 'Ná»¯', '799680908', '35550', 'DI15V7A1', 'KiÃªn Giang'),
('B1502888', 'bjvobij', 'Ná»¯', '799680916', '35834', 'DI15V7A1', 'VÄ©nh Long'),
('B1507152', 'Äá»— VÄƒn TÃ i', 'Nam', '799680907', '35464', 'DI15V7A1', 'SÃ³c TrÄƒng'),
('B1507153', 'VÃµ Táº¥n TÃ i', 'Nam', '799680906', '35728', 'DI15V7A1', 'TÃ¢n LÆ°á»£c BÃ¬nh TÃ¢n VÄ©nh Long'),
('B1507238', 'oppofs', 'Ná»¯', '799680914', '35832', 'DI15V7A2', 'VÄ©nh Long'),
('B1507239', 'vxc', 'Nam', '799680913', '35831', 'DI15V7A2', 'Cáº§n ThÆ¡'),
('B1508382', 'vsd', 'Ná»¯', '799680917', '35835', 'DI15V7A1', 'SÃ³c TrÄƒng'),
('B1949233', 'idjfsio', 'Ná»¯', '799680909', '35827', 'DI15V7A2', 'Cáº§n ThÆ¡'),
('B9324929', 'vds', 'Nam', '799680911', '35829', 'DI15V7A2', 'Cáº§n ThÆ¡');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `danhsach_sv`
--
ALTER TABLE `danhsach_sv`
  ADD PRIMARY KEY (`mssv`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
