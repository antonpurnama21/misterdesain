-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2020 at 10:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mr_design`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookings`
--

CREATE TABLE `tbl_bookings` (
  `id_booking` varchar(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `phone_num` varchar(20) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `id_service` varchar(11) DEFAULT NULL,
  `layout_file_path` varchar(255) DEFAULT NULL,
  `status_booking` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id_category` varchar(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id_category`, `category_name`, `created_on`, `updated_on`) VALUES
('C01', 'Project Perencanaan', '2020-01-20 03:27:03', '2020-01-20 03:27:57'),
('C02', 'Project Pembangunan', '2020-01-20 03:27:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_profiles`
--

CREATE TABLE `tbl_company_profiles` (
  `id` int(10) NOT NULL,
  `about` text DEFAULT NULL,
  `a_vision` text DEFAULT NULL,
  `a_mission` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `telp_or_email` varchar(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_company_profiles`
--

INSERT INTO `tbl_company_profiles` (`id`, `about`, `a_vision`, `a_mission`, `address`, `telp_or_email`, `created_on`, `updated_on`) VALUES
(1, 'Mitra Rajasa Design (MR-Design) adalah konsultan arsitek yang fokus pada pembuatan perencanaan bangunan Hunian, Gedung kantor, Ruko, Rukan dan komersial. Serta dilengkapi oleh perhitungan Analisi Struktur sebagai daya dukung dalam pembuatan dan perencanaan konstruksi bangunan, dan juga menyediakan jasa perencanaan / desain renovasi atau bangun baru. MR-Design didirikan pada Januari 2020 bekerjasama dengan partner partner terbaik antara lain bersama : tenaga ahli teknis, interior & furniture, 3D Architectural Visualization, illustration artist dan kontraktor yang biasa menangani project pemerintahan. Kami memiliki prinsip untuk mendirikan biro konsultan rumah dan komersial berbasis riset. sehingga Sumber Daya Manusia yang bersama kami minimal berkualifikasi cumlaude, atau berprestasi, atau berpengalaman 5 tahun ke atas, enjoy di bidang yang dikerjakannya, selalu openmind  untuk terus belajar meningkatkan kualitas produk dan mengerjakan perencanaan dengan sepenuh hati', 'Menyediakan jasa konsultasi arsitektur professional untuk kenyamanan hunian bagi seluruh kalangan di Indonesia. MR-Design berupaya dalam mencegah penurunan kualitas lingkungan dari pembangunan yang tidak tertib melalui desain yang nyaman, aman, unik, estetik dan sustainable. Serta pemanfaatan teknologi informasi terupdate sesuai dengan jamannya agar dapat menghasilkan output arsitektur terbaik yang solutif dan harmoni bagi manusia dan alam.', '1. Mempelajari berbagai disiplin ilmu khususnya di bidang komunikasi dan NLP untuk membantu klien menemukan dan menyampaikan aspirasi desainnya yang paling dalam.\r\n2. Memberikan desain atau perencanaan terbaik yang dilakukan sepenuh hati dengan passion dan study yang konsisten. Didampingi teknik sipil sebagai ahli struktur, visual artist sebagai ahli visualisasi dan ahli furniture sebagai penyedia interior.\r\n3. Menyediakan Jasa Perencanaan yang terjangkau seluruh kalangan dengan kualitas SDM professional, bersertifikasi dan artistik.\r\n4. Mensosialisasikan kepedulian terhadap dampak lingkungan dan sosialnya.\r\n5. Taat Menerapkan aturan pemerintah yang berlaku.\r\n\r\nCakupan area layanan arsitek kami Online seluruh indonesia. Untuk konsultasi langsung meliputi Sukabumi, Jabodetabek, Bandung. Kantor pusat berada di Kota Sukabumi.', 'Kota Sukabumi, JawaBarat', '021-0020-110 / company@domain.co.id', '2020-01-21 03:27:59', '2020-03-08 01:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_experts`
--

CREATE TABLE `tbl_experts` (
  `id_expert` varchar(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `id_position` varchar(255) DEFAULT NULL,
  `last_edu` varchar(255) DEFAULT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_experts`
--

INSERT INTO `tbl_experts` (`id_expert`, `full_name`, `id_position`, `last_edu`, `expertise`, `photo`, `created_on`, `updated_on`) VALUES
('E1014', 'Akbar Zainal Mutaqin', 'D02', NULL, '(Desain Arsitektur, RAB Arsitektur)', 'assets/img/expert/E1014.jpg', '2020-03-08 01:18:23', NULL),
('E1487', 'Eric Puja Kusuma, A.Md.T', 'D04', NULL, 'Surveyor', 'assets/img/expert/E1487.jpg', '2020-03-08 00:08:30', NULL),
('E1522', 'Fajar, ST', 'D02', NULL, 'Chief Arsitektur  (Desain Arsitektur, Animation Presentation)', 'assets/img/expert/E1522.jpg', '2020-03-08 00:04:02', NULL),
('E1569', 'Iqbal Maulana, A.Md.T', 'D03', NULL, 'Mekanikal Elektrikal Plumbing', 'assets/img/expert/E1569.jpg', '2020-03-08 00:07:08', NULL),
('E1722', 'Rami J.C, A.Md.T', 'D07', NULL, 'Civil Engineering, 3D Visual Rendering, 3D Animation Architecture, Video Editting, Estimator, Founder Of MR. Design', 'assets/img/expert/E1941.JPG', '2020-03-08 01:01:09', NULL),
('E1798', 'Yusuf, A.Md.T', 'D04', NULL, 'Site Engineer', 'assets/img/expert/E1798.jpg', '2020-03-08 00:08:03', NULL),
('E1810', 'Ridwan Arifin, A.Md.T', 'D01', NULL, 'Civil Engineering, Structure Design, Structure Estimate, Estimator Engineering', 'assets/img/expert/E1810.jpg', '2020-03-08 00:02:53', NULL),
('E1828', 'Muhamad Wildan, A.Md.T', 'D04', NULL, 'Site Manager Interior', 'assets/img/expert/E1828.jpg', '2020-03-08 00:07:33', NULL),
('E1904', 'Moch. Erwin Nursihab, A.M', 'D06', NULL, 'Accounting', 'assets/img/expert/E1904.jpg', '2020-03-08 00:09:24', NULL),
('E1941', 'Dikri Maulana, S.Ars', 'D07', NULL, 'Senior Architect, Steel specialist, Expert on technical drawing and estimator. Graduate from UMJ. Focus design on : Social Building, Wide Span Building, Education and Mosque. D’Artchitect Founder', 'assets/img/expert/E1722.jpg', '2020-03-08 01:01:57', NULL),
('E1976', 'Muhammad Wilman', 'D05', NULL, '(Drafter Arsitektur, Struktur, Interior)', 'assets/img/expert/E1976.jpg', '2020-03-08 00:08:55', NULL),
('E1990', 'Dima Ujiana, S.Ds', 'D02', NULL, 'Chief Interior (Desain Interior, Animation Presentation, RAB Interior)', 'assets/img/expert/E1990.jpg', '2020-03-08 00:05:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_galleries`
--

CREATE TABLE `tbl_galleries` (
  `id_gallery` varchar(11) NOT NULL,
  `id_category` varchar(10) DEFAULT NULL,
  `id_service` varchar(10) DEFAULT NULL,
  `type_gallery` enum('Interior','Exterior') DEFAULT NULL,
  `desc_gallery` text DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `updated_by` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_galleries`
--

INSERT INTO `tbl_galleries` (`id_gallery`, `id_category`, `id_service`, `type_gallery`, `desc_gallery`, `created_on`, `updated_on`, `created_by`, `updated_by`) VALUES
('G557', 'C02', 'J02', 'Interior', 'asdfasdf asfsdfasdf asdfsadf', '2020-01-26 23:28:03', '2020-04-17 04:15:30', 'U36', 'U36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE `tbl_images` (
  `id` int(10) NOT NULL,
  `id_gallery` varchar(11) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `upload_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_images`
--

INSERT INTO `tbl_images` (`id`, `id_gallery`, `img_url`, `upload_on`) VALUES
(16, 'G557', 'assets/img/gallery/Screenshot_(1).png', '2019-01-27 06:28:03'),
(17, 'G557', 'assets/img/gallery/Screenshot_(2).png', '2020-01-27 06:28:03'),
(19, 'G557', 'assets/img/gallery/Screenshot_(7).png', '2020-01-29 05:29:40'),
(21, 'G557', 'assets/img/gallery/Screenshot_(6).png', '2020-04-17 11:15:30'),
(22, 'G557', 'assets/img/gallery/Screenshot_(7)1.png', '2020-04-17 11:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notes`
--

CREATE TABLE `tbl_notes` (
  `id` int(14) NOT NULL,
  `id_user` varchar(11) DEFAULT NULL,
  `comment_id` varchar(11) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `note_image` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `datetime` varchar(128) DEFAULT NULL,
  `notification_status` enum('seen','unseen') NOT NULL DEFAULT 'unseen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_notes`
--

INSERT INTO `tbl_notes` (`id`, `id_user`, `comment_id`, `title`, `description`, `note_image`, `datetime`, `notification_status`) VALUES
(44, 'U617', 'U36', NULL, 'tolong selesaikan', 'assets/img/note/Screenshot_(2).png', '2020-01-17 09:16:09am', 'seen'),
(45, 'U617', 'U36', NULL, 'selesaikan sebelum tanggal 20', NULL, '2020-01-17 09:17:04am', 'seen'),
(46, 'U617', 'U617', NULL, 'Oke mass, siap laksanakan....', NULL, '2020-01-17 09:31:02am', 'seen'),
(49, 'U617', 'U36', NULL, 'okeeeesssss', NULL, '2020-01-17 09:51:39am', 'seen'),
(50, 'U617', 'U36', NULL, 'yesss kamu sekarang jadi admin', 'assets/img/note/pet14.jpg', '2020-01-17 12:26:13pm', 'seen'),
(51, 'U617', 'U617', NULL, 'horeee makasih ommm', NULL, '2020-01-17 12:27:10pm', 'seen'),
(52, 'U617', 'U36', NULL, 'broo ?? apa kabar', 'assets/img/note/dog3.jpg', '2020-01-20 03:11:16pm', 'seen'),
(53, 'U617', 'U617', NULL, 'baik bro, tapi kok saya tak lagi jadi admin ?', NULL, '2020-01-20 03:34:36pm', 'unseen');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `notifID` int(11) NOT NULL,
  `notifTitle` varchar(255) DEFAULT NULL,
  `notification` text DEFAULT NULL,
  `notifUrl` text DEFAULT NULL,
  `notifStatus` varchar(11) NOT NULL DEFAULT 'unseen',
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_partners_and_clients`
--

CREATE TABLE `tbl_partners_and_clients` (
  `id_pc` varchar(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `partner_or_client` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `id_position` varchar(11) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`id_position`, `position`, `created_on`, `updated_on`) VALUES
('D01', 'Bidang Perencanaan Struktur', '2020-03-08 07:00:09', NULL),
('D02', 'Bidang perencanaan Arsitektur', '2020-03-08 07:00:22', NULL),
('D03', 'Bidang Perencanaan Mekanikal Elektrikal Plumbing (MEP)', '2020-03-08 07:00:36', NULL),
('D04', 'Engineering Procutment', '2020-03-08 07:00:46', '2020-03-08 07:01:24'),
('D05', 'Drafter', '2020-03-08 07:01:02', NULL),
('D06', 'Administration Accounting', '2020-03-08 07:01:13', NULL),
('D07', 'Founder', '2020-03-08 07:53:32', '2020-03-08 08:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `id_service` varchar(11) NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id_service`, `service_name`, `description`, `created_on`, `updated_on`) VALUES
('J01', 'Jasa Desain Online', 'Jasa Desain Online Jasa Desain Online Jasa Desain Online', '2020-01-20 04:40:31', '2020-01-20 04:42:05'),
('J02', 'Jasa Desain Arsitektur', 'Jasa Desain Arsitektur Jasa Desain Arsitektur Jasa Desain Arsitektur', '2020-01-20 04:41:24', '2020-01-19 20:15:02'),
('J03', 'Jasa Desain Struktur', 'Jasa Desain Struktur Jasa Desain Struktur Jasa Desain Struktur', '2020-01-20 04:41:48', NULL),
('J04', 'Jasa Desain Interior', 'Jasa Desain Interior Jasa Desain Interior Jasa Desain Interior Jasa Desain Interior', '2020-01-19 20:23:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `sitelogo` varchar(128) DEFAULT NULL,
  `sitetitle` varchar(256) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `copyright` varchar(128) DEFAULT NULL,
  `contact` varchar(128) DEFAULT NULL,
  `system_email` varchar(128) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `sitelogo`, `sitetitle`, `description`, `copyright`, `contact`, `system_email`, `address`) VALUES
(2, 'logo-design1.png', 'MR. Design', 'Website bla.. bla.. bla..', 'APurnama', '082118115288', 'masantonpurnama@gmail.com', 'Kuningan, Jakarta Selatan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social_link`
--

CREATE TABLE `tbl_social_link` (
  `id` int(14) NOT NULL,
  `social_media` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_social_link`
--

INSERT INTO `tbl_social_link` (`id`, `social_media`, `link`, `icon`, `created_on`, `updated_on`) VALUES
(1, 'Facebook', 'http://facebook.com', 'fa-facebook', '2020-02-14 22:31:18', NULL),
(3, 'Instagram', 'http://instagram.com', 'fa-instagram', '2020-02-14 22:36:44', NULL),
(4, 'Twitter', 'http://twitter.com', 'fa-twitter', '2020-02-14 22:38:43', NULL),
(5, 'Pinterest', 'http://pinterest.com', 'fa-pinterest', '2020-03-08 03:59:58', '2020-03-08 04:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_user` varchar(64) NOT NULL,
  `full_name` varchar(128) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(512) DEFAULT NULL,
  `seen_password` varchar(255) DEFAULT NULL,
  `ip_address` varchar(512) DEFAULT NULL,
  `forgotten_code` varchar(512) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `contact` varchar(256) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
  `role` enum('Admin','User') NOT NULL,
  `confirm_code` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `full_name`, `email`, `password`, `seen_password`, `ip_address`, `forgotten_code`, `image`, `contact`, `created_on`, `updated_on`, `status`, `role`, `confirm_code`) VALUES
('U36', 'Anton Purnama', 'masantonpurnama@gmail.com', '3acd0be86de7dcccdbf91b20f94a68cea535922d', '112233', '::1', 'ad8c207947874ce1e7cfa21a455ddcfb', 'assets/img/user/U36.jpg', '082118115288', '0000-00-00 00:00:00', '2020-01-20 03:05:50', 'ACTIVE', 'Admin', '1660'),
('U617', 'master', 'user3@mail.com', '3acd0be86de7dcccdbf91b20f94a68cea535922d', '112233', NULL, NULL, 'assets/img/user/U617.jpg', '1241234124', '2020-01-17 08:38:34', '2020-01-17 09:53:13', 'ACTIVE', 'Admin', NULL),
('U702', 'Sarah connor', 'user1@mail.com', '3acd0be86de7dcccdbf91b20f94a68cea535922d', '112233', NULL, NULL, 'assets/img/user/U7021.jpg', '198239109', '2020-01-17 00:00:00', '2020-01-20 02:36:15', 'ACTIVE', 'User', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE `tbl_video` (
  `id_video` int(11) NOT NULL,
  `link_video` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`id_video`, `link_video`, `created_on`, `updated_on`) VALUES
(1, '3ymwOvzhwHs', '2020-03-08 09:48:38', NULL),
(2, '44VBVj7n91s', '2020-02-09 07:38:44', '2020-03-08 09:45:57'),
(3, 'fE2h3lGlOsk', '2020-02-09 07:26:40', '2020-04-17 11:52:31'),
(4, 'uR8Mrt1IpXg', '2020-02-09 07:24:38', '2020-03-08 09:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `to_do_list`
--

CREATE TABLE `to_do_list` (
  `id` int(14) NOT NULL,
  `id_user` varchar(64) DEFAULT NULL,
  `to_dodata` varchar(256) DEFAULT NULL,
  `date` varchar(128) DEFAULT NULL,
  `value` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `to_do_list`
--

INSERT INTO `to_do_list` (`id`, `id_user`, `to_dodata`, `date`, `value`) VALUES
(36, 'U36', 'tesss', '2020-01-17 11:42:03am', '1'),
(37, 'U36', 'tess 2', '2020-01-17 11:42:48am', '0'),
(38, 'U617', 'oke', '2020-01-17 11:44:37am', '1'),
(39, 'U617', 'oke 2', '2020-01-17 11:44:43am', '1'),
(40, 'U36', 'gsdgsd', '2020-01-30 05:00:37pm', '1'),
(41, 'U36', 'asdfasdfsdf', '2020-01-30 05:01:45pm', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `tbl_company_profiles`
--
ALTER TABLE `tbl_company_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_experts`
--
ALTER TABLE `tbl_experts`
  ADD PRIMARY KEY (`id_expert`);

--
-- Indexes for table `tbl_galleries`
--
ALTER TABLE `tbl_galleries`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indexes for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`notifID`);

--
-- Indexes for table `tbl_partners_and_clients`
--
ALTER TABLE `tbl_partners_and_clients`
  ADD PRIMARY KEY (`id_pc`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`id_position`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_social_link`
--
ALTER TABLE `tbl_social_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`id_video`);

--
-- Indexes for table `to_do_list`
--
ALTER TABLE `to_do_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_company_profiles`
--
ALTER TABLE `tbl_company_profiles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notifID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_social_link`
--
ALTER TABLE `tbl_social_link`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `to_do_list`
--
ALTER TABLE `to_do_list`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
