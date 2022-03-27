-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2022 at 01:38 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ialert`
--

-- --------------------------------------------------------

--
-- Table structure for table `ialert_account`
--

CREATE TABLE `ialert_account` (
  `id` int(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `esection` varchar(255) DEFAULT NULL,
  `car_maker` varchar(255) DEFAULT NULL,
  `sections` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ialert_account`
--

INSERT INTO `ialert_account` (`id`, `username`, `password`, `role`, `esection`, `car_maker`, `sections`) VALUES
(1, 'jj', 'admin', 'viewer', 'viewer', NULL, NULL),
(2, 'jj_admin', 'admin', 'admin', 'admin', NULL, NULL),
(3, 'jj_hr', 'admin', 'hr', 'hr', NULL, NULL),
(5, 'jj_pkimt', 'admin', 'provider', 'PKIMT', NULL, NULL),
(6, 'jj_fas', 'admin', 'fas', 'FAS', 'Suzuki', 'section1');

-- --------------------------------------------------------

--
-- Table structure for table `ialert_audit`
--

CREATE TABLE `ialert_audit` (
  `id` int(20) NOT NULL,
  `batch` varchar(200) DEFAULT NULL,
  `date_audited` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `employee_num` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `shift` varchar(255) DEFAULT NULL,
  `groups` varchar(255) DEFAULT NULL,
  `car_maker` varchar(255) DEFAULT NULL,
  `car_model` varchar(255) DEFAULT NULL,
  `line_no` varchar(255) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `audit_findings` varchar(255) DEFAULT NULL,
  `audited_by` varchar(255) DEFAULT NULL,
  `audited_categ` varchar(255) DEFAULT NULL,
  `audit_type` varchar(200) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `pd` varchar(255) DEFAULT NULL,
  `hr` varchar(255) DEFAULT NULL,
  `agency` varchar(255) DEFAULT NULL,
  `penalty` varchar(255) DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `date_updated` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `date_sent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ialert_audit`
--

INSERT INTO `ialert_audit` (`id`, `batch`, `date_audited`, `full_name`, `employee_num`, `provider`, `position`, `shift`, `groups`, `car_maker`, `car_model`, `line_no`, `process`, `audit_findings`, `audited_by`, `audited_categ`, `audit_type`, `remarks`, `pd`, `hr`, `agency`, `penalty`, `date_created`, `date_updated`, `section`, `date_sent`) VALUES
(17, 'AC:22032620451', '2022-03-26', 'Buendia, John Jose', '21-07087', 'FAS', 'Associate', 'ds', 'a', 'Suzuki', 'YV7', '1005', 'Assy', 'Un Authorized Repair/Hidden Repair', 'jj', 'minor', 'initial', 'N/A', NULL, NULL, NULL, NULL, '2022-03-26 16:36:23', NULL, 'section7', NULL),
(18, 'AC:22032620451', '2022-03-26', 'Cantos, Tristan Jay A.', '21-07088', 'FAS', 'Staff', 'ds', 'a', 'Suzuki', 'YV7', 'First process (Honda Old)', 'Assy', 'Un Authorized Repair/Hidden Repair', 'jj', 'minor', 'initial', 'N/A', NULL, NULL, NULL, NULL, '2022-03-26 16:37:21', NULL, 'section8', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ialert_audit_findings_categ`
--

CREATE TABLE `ialert_audit_findings_categ` (
  `id` int(20) NOT NULL,
  `audit_findings` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ialert_audit_findings_categ`
--

INSERT INTO `ialert_audit_findings_categ` (`id`, `audit_findings`) VALUES
(1, 'Un Authorized Repair/Hidden Repair'),
(2, 'Un Authorized person doing the process'),
(3, 'Bringing of prohibited tool'),
(4, 'Pulling of inserted wire on connector to dis-insert'),
(5, 'Using of prohibited tool on prohibited act'),
(6, 'Not following claim countermeasure'),
(7, 'Not following changing point rule'),
(8, 'Not following normal repair procedure'),
(9, 'Intentional Act of making defect'),
(10, 'Advance putting of marking on connector'),
(11, 'Pulling of branch or wire'),
(12, 'Any non-compliance or prohibited act than can result to customer claim'),
(13, 'Not using COT jig'),
(14, 'No good condition of Probe Pin checker jig or jigs'),
(15, 'Mixed Wires'),
(16, 'Not using wire catcher'),
(17, 'Overstocking of parts'),
(18, 'Mixed Parts'),
(19, 'Not using reference jig'),
(20, 'Not using tanmatsu jig'),
(21, 'Not using acrylic jig'),
(22, 'Not using clip tag'),
(23, 'No verification of Staff on repaired Harness'),
(24, 'Not putting of marking on passtape'),
(25, 'No Good Filling up of Daily Check sheet'),
(26, 'No good location of parts'),
(27, 'Not following Andon Rule'),
(28, 'Not following OI'),
(29, 'Not following SOT'),
(30, 'Working During Breaktime'),
(31, 'Not following QFWS'),
(32, 'Unusual Condition of Parts'),
(33, 'Not following Kanban Rule'),
(34, 'Wrong Label vs. Actual'),
(35, 'Not following fallen parts rule'),
(36, 'Multiple picking of parts'),
(37, 'Multiple picking of wires'),
(38, 'No good hanging od wires'),
(39, 'Using other name on Sub PC'),
(40, 'Using other name on IRCS'),
(41, 'Not using locking jig for connector'),
(42, 'Too much setting of wire on downspout'),
(43, 'No good treatment of sub wires'),
(44, 'No good treatment of wires'),
(45, 'Not following one set supply rule and flipping of parts supply box'),
(46, 'Non compliance during lay out'),
(47, 'Not following maximum sets on hanger'),
(48, 'Early saving using CTRL+F1'),
(49, 'Not using paper coiler'),
(50, 'Not following standard layer of terminal reels'),
(51, 'Improper storing of terminal reels'),
(52, 'Not referring on joint drawing'),
(53, 'Not using arrow tag'),
(54, 'Not using of spacer during setting of wire tray onTRD machine'),
(55, 'Not using of spacer during removal of wire tray onTRD machine'),
(56, 'No good setting  of applicator on applicator rack or zai hai cart '),
(57, 'No good treatment of defect'),
(58, 'Non-Compliance on Insert Pull Method'),
(59, 'Not following Bending Frequency rule'),
(60, 'Advance insertion of wire'),
(61, 'Not following STOP CALL WAIT'),
(62, 'Twisting of wire on assembly jig'),
(63, 'Non-Compliance on Insert Pull Method'),
(64, 'Not following Bending Frequency rule'),
(65, 'Not following visual inspection rule'),
(66, 'Not following special repair rule'),
(67, 'Not following packing procedure'),
(68, 'Not following proper inspection method on dimension process'),
(69, 'Tapping of ECT checker jig'),
(70, 'Non-Compliance during ECT process'),
(71, 'Not measuring 1st output at initial masspro at Initial process'),
(72, 'Not following barcoding rule at Initial Process'),
(73, 'Non compliance on recutting/recrimping flow'),
(74, 'Non-compliance on welding process'),
(75, 'Using Technician Mode to change machine setting'),
(76, 'Multiple Heating of Sumitube'),
(77, 'Using of cutter/scissor to cut wire band/wire seal'),
(78, 'Early input of data on CCIS'),
(79, 'Not using Y-metal catcher'),
(80, 'Early saving of data using control +F1'),
(81, 'Not using shieldwire cutting jig'),
(82, 'No good treatment/improper hanging of welded shikakari on hanger'),
(83, 'Too much setting of wire on wire comb blade.'),
(84, 'Doing manual injection of silicon during silicon process without proper authorization'),
(85, 'Changing of machine setting on any process '),
(86, 'Not comparing on kanban VS Actual at Initial Process'),
(87, 'Not following proper inspection method at Initial Process'),
(88, 'Setting of 3 applicator on TRD machine '),
(89, 'Inputting of data on CCIS/machine without performing actual test '),
(90, 'Using of other safety stick during removing of stuck terminal chips on machine');

-- --------------------------------------------------------

--
-- Table structure for table `ialert_lines`
--

CREATE TABLE `ialert_lines` (
  `id` int(20) NOT NULL,
  `line_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ialert_lines`
--

INSERT INTO `ialert_lines` (`id`, `line_no`) VALUES
(1, '4009'),
(2, '4110'),
(3, '4111'),
(4, '4112'),
(5, '4113'),
(6, '4114'),
(7, '4115'),
(8, '4116'),
(9, '4117'),
(10, '4018'),
(11, '4019'),
(12, '5101'),
(13, '5102'),
(14, '5103'),
(15, '5104'),
(16, '5105'),
(17, '5111'),
(18, '5112'),
(19, '5113'),
(20, '5114'),
(21, '5015'),
(22, '5116'),
(23, '5117'),
(24, '5119'),
(25, '5120'),
(26, '5121'),
(27, '5022'),
(28, '5124'),
(29, '5125'),
(30, '5126'),
(31, '5127'),
(32, '5128'),
(33, '5031'),
(34, '5133'),
(35, '5136'),
(36, '5138'),
(37, '5139'),
(38, '5140'),
(39, '1135'),
(40, '1136'),
(41, '1137'),
(42, '1138'),
(43, '1139'),
(44, '1040'),
(45, '6102'),
(46, '2102'),
(47, '2104'),
(48, '2105'),
(49, '2106'),
(50, '2107'),
(51, '1101'),
(52, '1102'),
(53, '1103'),
(54, '1004'),
(55, '1005'),
(56, '1006'),
(57, '1007'),
(58, '1008'),
(59, '1110'),
(60, '1112'),
(61, '1114'),
(62, '1115'),
(63, '1117'),
(64, '1118'),
(65, '1119'),
(66, '1121'),
(67, '1123'),
(68, '1124'),
(69, '1125'),
(70, '1126'),
(71, '1128'),
(72, '1130'),
(73, '1032'),
(74, '1033'),
(75, '1034'),
(76, '5123'),
(77, '5130'),
(78, '5132'),
(79, '5134'),
(80, '5135'),
(81, '5137'),
(82, '5009'),
(83, '5041'),
(84, '3114'),
(85, '3115'),
(86, '3116'),
(87, '3018'),
(88, '3020'),
(89, '3021'),
(90, '3122'),
(91, '3123'),
(92, '3124'),
(93, '3125'),
(94, '3126'),
(95, '3127'),
(96, '3128'),
(97, '3129'),
(98, '3130'),
(99, '3133'),
(100, '3134'),
(101, '3135'),
(102, '3136'),
(103, '3037'),
(104, '3138'),
(105, '3139'),
(106, '3140'),
(107, '3141'),
(108, '3142'),
(109, '3043'),
(110, '3144'),
(111, '3145'),
(112, '3046'),
(113, '3147'),
(114, '3148'),
(115, '3149'),
(116, '3150'),
(117, '3151'),
(118, '3152'),
(119, '3053'),
(120, '3154'),
(121, '3155'),
(122, '3156'),
(123, '3157'),
(124, '2001'),
(125, '2109'),
(126, '2111'),
(127, '2112'),
(128, '2113'),
(129, '2114'),
(130, '2115'),
(131, '2116'),
(132, '2117'),
(133, '2119'),
(134, '2120'),
(135, '2121'),
(136, '2122'),
(137, '2123'),
(138, '2124'),
(139, '2125'),
(140, '2026'),
(141, '2127'),
(142, '2128'),
(143, '7101'),
(144, '7102'),
(145, '7103'),
(146, '7104'),
(147, '7105'),
(148, '7106'),
(149, '7107'),
(150, '7108'),
(151, '7109'),
(152, '7110'),
(153, '7111'),
(154, '7112'),
(155, '7113'),
(156, '7114'),
(157, '7015'),
(158, '7116'),
(159, '7118'),
(160, '7119'),
(161, '7120'),
(162, '7121'),
(163, '7122'),
(164, '7023'),
(165, '5006'),
(166, '5029'),
(167, '5018'),
(168, '3006'),
(169, '3119'),
(170, '3031'),
(171, '3032'),
(172, '8001'),
(173, '8102'),
(174, '4120'),
(175, '4121'),
(176, '4122'),
(177, '4123'),
(178, '4124'),
(179, '4125');

-- --------------------------------------------------------

--
-- Table structure for table `ialert_line_audit`
--

CREATE TABLE `ialert_line_audit` (
  `id` int(20) NOT NULL,
  `shift` varchar(255) DEFAULT NULL,
  `groups` varchar(255) DEFAULT NULL,
  `date_audited` date DEFAULT NULL,
  `car_maker` varchar(255) DEFAULT NULL,
  `car_model` varchar(255) DEFAULT NULL,
  `line_no` varchar(255) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `audit_findings` varchar(255) DEFAULT NULL,
  `audited_by` varchar(255) DEFAULT NULL,
  `audited_categ` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `audit_type` varchar(255) DEFAULT NULL,
  `date_updated` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ialert_line_audit`
--

INSERT INTO `ialert_line_audit` (`id`, `shift`, `groups`, `date_audited`, `car_maker`, `car_model`, `line_no`, `process`, `audit_findings`, `audited_by`, `audited_categ`, `remarks`, `date_created`, `batch`, `audit_type`, `date_updated`) VALUES
(1, 'ds', 'a', '2022-03-21', 'Honda', 'T20', '1004', 'Assy', 'Un Authorized Repair/Hidden Repair', 'jj', 'minor', '-', '2022-03-21 14:18:11', 'LAC:22032135795', 'Line Audit', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ialert_section`
--

CREATE TABLE `ialert_section` (
  `id` int(20) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `line_no` varchar(255) DEFAULT NULL,
  `car_maker` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ialert_section`
--

INSERT INTO `ialert_section` (`id`, `section`, `line_no`, `car_maker`) VALUES
(1, 'Section1', '5101', 'Suzuki'),
(2, 'Section1', '5102', 'Suzuki'),
(3, 'Section1', '5103', 'Suzuki'),
(4, 'Section1', '5104', 'Suzuki'),
(5, 'Section1', '5105', 'Suzuki'),
(6, 'Section2', '5006', 'Suzuki'),
(7, 'Section2', '3119', 'Honda'),
(8, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ialert_account`
--
ALTER TABLE `ialert_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ialert_audit`
--
ALTER TABLE `ialert_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ialert_audit_findings_categ`
--
ALTER TABLE `ialert_audit_findings_categ`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ialert_lines`
--
ALTER TABLE `ialert_lines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ialert_line_audit`
--
ALTER TABLE `ialert_line_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ialert_section`
--
ALTER TABLE `ialert_section`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ialert_account`
--
ALTER TABLE `ialert_account`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ialert_audit`
--
ALTER TABLE `ialert_audit`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ialert_audit_findings_categ`
--
ALTER TABLE `ialert_audit_findings_categ`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `ialert_lines`
--
ALTER TABLE `ialert_lines`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `ialert_line_audit`
--
ALTER TABLE `ialert_line_audit`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ialert_section`
--
ALTER TABLE `ialert_section`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
