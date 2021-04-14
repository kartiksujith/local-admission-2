-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2019 at 02:20 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `admin_login` (
  `admin_id` int(6) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `admin_pwd` varchar(100) NOT NULL,
  `admin_staff_name` varchar(100) NOT NULL,
  `role` varchar(30) NOT NULL,
  `privilege` varchar(30) NOT NULL,
  `event` varchar(100) DEFAULT NULL,
  `account_status` tinyint(1) NOT NULL DEFAULT '0',
  `course` varchar(3) NOT NULL,
  `login` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `email_id`, `admin_pwd`, `admin_staff_name`, `role`, `privilege`, `event`, `account_status`, `course`, `login`, `created_at`, `updated_at`) VALUES
(1, 'priya.rl@ves.ac.in', 'priya.rl', 'Priya Rl', 'Super Admin', 'All', 'ACAP', 1, 'ME', 0, '2018-06-08 11:35:45', '2019-07-09 04:49:51'),
(2, 'asma.parveen@ves.ac.in', 'asma.parveen', 'Asma Parveen', 'Staff', 'Document Verifier', 'DTE', 1, 'FEG', 0, '2018-07-04 05:03:01', '2019-07-26 05:45:46'),
(3, 'admin@gmail.com', 'adm_vesit@admin', 'Admin', 'Admin', 'All', 'DTE', 1, 'DSE', 0, '2018-07-03 17:12:38', '2019-08-11 07:21:36'),
(4, 'hema.answal@ves.ac.in', 'hema123', 'Hema Answal', 'Admin', 'All', 'DTE', 1, 'FEG', 1, '2018-07-25 16:09:26', '2019-07-26 05:45:46'),
(5, 'gauri.kamble@ves.ac.in', 'gauri123', 'Gauri Kamble', 'Admin', 'All', 'DTE', 1, 'FEG', 0, '2018-07-25 16:28:22', '2019-07-26 05:45:46'),
(10, 'prem@gmail.com', 'prem', 'Prem', 'Staff', 'Document Collector', 'DTE', 1, 'FEG', 0, '2019-04-26 18:00:43', '2019-07-26 05:45:46'),
(11, 'rinku@gmail.com', 'rinku', 'Rinku', 'Staff', 'Document Collector', 'DTE', 1, 'FEG', 0, '2019-04-27 23:27:17', '2019-07-26 05:45:46'),
(12, '2018shivam.kumari@ves.ac.in', '123456', 'shivam', 'Staff', 'Document Collector', 'DTE', 1, 'FEG', 0, '2019-06-15 15:26:09', '2019-07-26 05:45:46'),
(13, 'akash@ves.ac.in', 'akash123', 'akash', 'Staff', 'Admission Seizer', 'DTE', 1, 'FEG', 0, '2019-07-08 12:01:49', '2019-07-26 05:45:46'),
(14, 'komal@ves.ac.in', 'komal123', 'komal', 'Staff', 'Admission Seizer', 'ACAP', 1, 'FEG', 0, '2019-07-08 12:02:32', '2019-08-05 07:46:00'),
(15, 'suved@ves.ac.in', 'suved123', 'suved', 'Staff', 'Admission Seizer', 'DTE', 1, 'FEG', 0, '2019-07-08 12:03:07', '2019-07-26 05:45:46'),
(16, 'chandrashekar@ves.ac.in', 'chandrashekar123', 'chandrashekar', 'Staff', 'Document Verifier', 'DTE', 1, 'FEG', 0, '2019-07-08 12:04:37', '2019-07-26 05:45:46'),
(17, 'gauri@ves.ac.in', 'gauri123', 'gauri', 'Staff', 'Admit', 'DTE', 1, 'FEG', 0, '2019-07-08 12:05:01', '2019-07-26 05:45:07'),
(18, 'megha@ves.ac.in', 'megha123', 'megha', 'Staff', 'Admission Seizer', 'ACAP', 1, 'FEG', 0, '2019-07-08 12:05:35', '2019-07-29 06:31:23'),
(19, 'priyanka@ves.ac.in', 'priyanka123', 'priyanka', 'Staff', 'Admission Seizer', 'DTE', 1, 'FEG', 0, '2019-07-08 12:06:24', '2019-07-26 05:45:46'),
(20, 'parameshwari@ves.ac.in', 'parameshwari123', 'parameshwari', 'Staff', 'Admission Seizer', 'DTE', 1, 'FEG', 0, '2019-07-08 12:06:54', '2019-07-26 05:45:46'),
(21, 'hema@ves.ac.in', 'hema123', 'Hema Answal', 'Staff', 'Admission Seizer', 'ACAP', 1, 'MCA', 0, '2019-07-09 14:48:09', '2019-08-08 10:20:35'),
(22, 'priti@ves.ac.in', 'priti123', 'Priti', 'Staff', 'Document Verifier', 'ACAP', 1, 'MCA', 0, '2019-07-09 14:48:51', '2019-08-10 07:29:05'),
(23, 'keya@ves.ac.in', 'keya123', 'keya', 'Staff', 'Admit', 'DTE', 1, 'FEG', 0, '2019-07-12 11:47:15', '2019-07-26 05:45:19'),
(24, 'amrita@ves.ac.in', 'amrita123', 'amrita', 'Staff', 'Admit', 'DTE', 1, 'FEG', 0, '2019-07-12 11:47:58', '2019-07-26 05:45:46'),
(25, 'ajinkya@ves.ac.in', 'ajinkya123', 'Ajinkya', 'Staff', 'Document Collector', 'DTE', 1, 'FEG', 0, '2019-07-13 13:47:03', '2019-07-26 05:44:38'),
(26, 'shweta@ves.ac.in', 'shweta123', 'shweta', 'Staff', 'Admission Seizer', 'ACAP', 1, 'DSE', 0, '2019-07-17 14:44:39', '2019-08-16 09:50:37'),
(27, 'prem@ves.ac.in', 'prem123', 'prem', 'Staff', 'Document Collector', 'ACAP', 1, 'MCA', 0, '2019-07-08 12:04:37', '2019-08-10 07:29:14'),
(28, 'jinang@ves.ac.in', 'jinang123', 'Jinang', 'Staff', 'Admit', 'ACAP', 1, 'MCA', 0, '2019-07-09 14:48:51', '2019-08-10 07:29:23'),
(29, 'rishabh@ves.ac.in', 'rishabh123', 'rishabh', 'Staff', 'Admission Seizer', 'ACAP', 1, 'DSE', 0, '2019-07-27 12:06:24', '2019-08-10 06:40:21'),
(30, 'namrata@ves.ac.in', 'namrata123', 'Namrata', 'Staff', 'Admission Seizer', 'ACAP', 1, 'DSE', 0, '2019-08-06 16:15:13', '2019-08-06 10:45:13'),
(31, 'mahesh.singh@ves.ac.in', 'mahesh123', 'Mahesh Singh', 'Staff', 'Admission Seizer', 'ACAP', 1, 'FEG', 0, '2019-08-07 14:30:28', '2019-08-07 09:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `admission_id` int(6) NOT NULL,
  `dte_id` varchar(12) NOT NULL,
  `course` varchar(3) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `shift_allotted` varchar(10) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `admission_type` varchar(15) DEFAULT NULL,
  `count` int(2) NOT NULL DEFAULT '0',
  `total_amt` bigint(11) DEFAULT NULL,
  `granted_amt` bigint(11) DEFAULT NULL,
  `paid_amt` bigint(11) DEFAULT NULL,
  `fees_category` varchar(50) DEFAULT NULL,
  `balance_amt` bigint(11) DEFAULT '10',
  `acap_round_name` varchar(50) DEFAULT NULL,
  `admission_category` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dd_details`
--

CREATE TABLE `dd_details` (
  `dd_id` int(10) NOT NULL,
  `amount` bigint(7) NOT NULL,
  `email` varchar(70) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `drawer_name` varchar(50) NOT NULL,
  `drawee` varchar(100) NOT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `dd_date` date NOT NULL,
  `dd_no` bigint(7) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dse_students`
--

CREATE TABLE `dse_students` (
  `dse_master_id` int(6) NOT NULL,
  `dte_id` varchar(12) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `candidate_type` varchar(3) DEFAULT NULL,
  `acap_category` varchar(50) DEFAULT NULL,
  `name_on_marksheet` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth_state` varchar(50) DEFAULT NULL,
  `place_of_birth_city` varchar(50) DEFAULT NULL,
  `mother_tongue` varchar(15) DEFAULT NULL,
  `nationality` varchar(10) DEFAULT NULL,
  `caste_tribe` varchar(15) DEFAULT NULL,
  `religion` varchar(12) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `uid` bigint(12) DEFAULT NULL,
  `student_domicile_no` varchar(30) DEFAULT NULL,
  `student_domicile_date` date DEFAULT NULL,
  `student_domicile_appl_no` varchar(30) DEFAULT NULL,
  `student_domicile_appl_date` date DEFAULT NULL,
  `is_personal_completed` tinyint(1) DEFAULT '0',
  `g_relation` char(1) DEFAULT NULL,
  `g_first_name` varchar(15) DEFAULT NULL,
  `g_middle_name` varchar(15) DEFAULT NULL,
  `g_last_name` varchar(15) DEFAULT NULL,
  `g_mobile` bigint(12) DEFAULT NULL,
  `g_occupation` varchar(30) DEFAULT NULL,
  `g_qualification` varchar(50) DEFAULT NULL,
  `g_office_address` varchar(250) DEFAULT NULL,
  `g_office_tel_no` bigint(12) DEFAULT NULL,
  `g_annual_income` bigint(9) DEFAULT NULL,
  `mother_name` varchar(15) DEFAULT NULL,
  `parent_domicile_no` varchar(30) DEFAULT NULL,
  `parent_domicile_date` date DEFAULT NULL,
  `parent_domicile_appl_no` varchar(30) DEFAULT NULL,
  `parent_domicile_appl_date` date DEFAULT NULL,
  `is_guardian_completed` tinyint(1) DEFAULT '0',
  `permanent_address_line1` varchar(255) DEFAULT NULL,
  `permanent_address_line2` varchar(255) DEFAULT NULL,
  `permanent_city` varchar(30) DEFAULT NULL,
  `permanent_district` varchar(30) DEFAULT NULL,
  `permanent_state` varchar(30) DEFAULT NULL,
  `permanent_pincode` bigint(10) DEFAULT NULL,
  `permanent_nearest_rail_station` varchar(30) DEFAULT NULL,
  `correspondance_address_line1` varchar(255) DEFAULT NULL,
  `correspondance_address_line2` varchar(255) DEFAULT NULL,
  `correspondance_city` varchar(30) DEFAULT NULL,
  `correspondance_district` varchar(30) DEFAULT NULL,
  `correspondance_state` varchar(30) DEFAULT NULL,
  `correspondance_pincode` bigint(10) DEFAULT NULL,
  `correspondance_nearest_rail_station` varchar(30) DEFAULT NULL,
  `resident_of` varchar(12) DEFAULT NULL,
  `local_guardian_name` varchar(50) DEFAULT NULL,
  `local_guardian_address_line1` varchar(255) DEFAULT NULL,
  `local_guardian_address_line2` varchar(255) DEFAULT NULL,
  `local_guardian_city` varchar(30) DEFAULT NULL,
  `local_guardian_district` varchar(30) DEFAULT NULL,
  `local_guardian_state` varchar(30) DEFAULT NULL,
  `local_guardian_pincode` bigint(10) DEFAULT NULL,
  `local_guardian_nearest_rail_station` varchar(30) DEFAULT NULL,
  `is_contact_completed` tinyint(1) DEFAULT '0',
  `x_passing_month` varchar(10) DEFAULT NULL,
  `x_passing_year` varchar(10) DEFAULT NULL,
  `x_board` varchar(100) DEFAULT NULL,
  `x_board_seat_no` varchar(10) DEFAULT NULL,
  `x_max_marks` bigint(3) DEFAULT NULL,
  `x_obtained_marks` bigint(3) DEFAULT NULL,
  `x_percentage` float DEFAULT NULL,
  `x_school_name` varchar(100) DEFAULT NULL,
  `x_school_city` varchar(50) DEFAULT NULL,
  `x_school_state` varchar(50) DEFAULT NULL,
  `is_hsc` char(4) DEFAULT NULL,
  `xii_passing_month` varchar(10) DEFAULT NULL,
  `xii_passing_year` varchar(10) DEFAULT NULL,
  `xii_board` varchar(100) DEFAULT NULL,
  `xii_board_seat_no` varchar(50) DEFAULT NULL,
  `xii_college_name` varchar(100) DEFAULT NULL,
  `xii_college_city` varchar(50) DEFAULT NULL,
  `xii_college_state` varchar(50) DEFAULT NULL,
  `xii_max_marks` bigint(3) DEFAULT NULL,
  `xii_obtained_marks` bigint(3) DEFAULT NULL,
  `xii_maths_max_marks` bigint(3) DEFAULT NULL,
  `xii_maths_obtained_marks` bigint(3) DEFAULT NULL,
  `xii_physics_max_marks` bigint(3) DEFAULT NULL,
  `xii_physics_obtained_marks` bigint(3) DEFAULT NULL,
  `xii_chemistry_max_marks` bigint(3) DEFAULT NULL,
  `xii_chemistry_obtained_marks` bigint(3) DEFAULT NULL,
  `xii_percentage` float DEFAULT NULL,
  `diploma_university` varchar(100) DEFAULT NULL,
  `diploma_passing_month` varchar(15) DEFAULT NULL,
  `diploma_passing_year` varchar(10) DEFAULT NULL,
  `diploma_branch` varchar(80) DEFAULT NULL,
  `diploma_college_name` varchar(100) DEFAULT NULL,
  `diploma_college_city` varchar(50) DEFAULT NULL,
  `diploma_college_state` varchar(50) DEFAULT NULL,
  `diploma_seat_no` varchar(15) DEFAULT NULL,
  `diploma_max_marks_sem1` bigint(3) DEFAULT NULL,
  `diploma_obt_marks_sem1` bigint(3) DEFAULT NULL,
  `diploma_max_marks_sem2` bigint(5) DEFAULT NULL,
  `diploma_obt_marks_sem2` varchar(5) DEFAULT NULL,
  `diploma_max_marks_sem3` bigint(3) DEFAULT NULL,
  `diploma_obt_marks_sem3` bigint(3) DEFAULT NULL,
  `diploma_max_marks_sem4` bigint(3) DEFAULT NULL,
  `diploma_obt_marks_sem4` bigint(3) DEFAULT NULL,
  `diploma_max_marks_sem5` bigint(3) DEFAULT NULL,
  `diploma_obt_marks_sem5` bigint(3) DEFAULT NULL,
  `diploma_max_marks_sem6` bigint(3) DEFAULT NULL,
  `diploma_obt_marks_sem6` bigint(3) DEFAULT NULL,
  `is_four_year` char(4) NOT NULL,
  `diploma_max_marks_sem7` bigint(3) DEFAULT NULL,
  `diploma_obt_marks_sem7` bigint(3) DEFAULT NULL,
  `diploma_max_marks_sem8` bigint(3) DEFAULT NULL,
  `diploma_obt_marks_sem8` bigint(3) DEFAULT NULL,
  `diploma_aggr_obt_sem6` bigint(3) DEFAULT NULL,
  `diploma_aggr_max_sem6` bigint(3) NOT NULL,
  `diploma_aggr_percent_sem6` float DEFAULT NULL,
  `diploma_aggr_obt_sem8` bigint(3) DEFAULT NULL,
  `diploma_aggr_max_sem8` bigint(3) NOT NULL,
  `diploma_aggr_percent_sem8` float DEFAULT NULL,
  `is_academic_completed` tinyint(1) DEFAULT '0',
  `all_india_merit_no` int(11) DEFAULT NULL,
  `mh_state_general_merit_no` int(11) DEFAULT NULL,
  `minority_dte_merit_no` int(11) DEFAULT NULL,
  `seat_type` varchar(30) DEFAULT NULL,
  `choice_code_allotted` bigint(10) DEFAULT NULL,
  `dte_branch` varchar(50) DEFAULT NULL,
  `shift_allotted` varchar(10) DEFAULT NULL,
  `allotted_cap_round` varchar(10) DEFAULT NULL,
  `course_allotted` varchar(80) DEFAULT NULL,
  `course_allotted_code` varchar(10) DEFAULT NULL,
  `is_dte_details_completed` tinyint(1) DEFAULT '0',
  `fc_confirmation_receipt` varchar(255) DEFAULT NULL,
  `fc_confirmation_receipt_path` varchar(100) DEFAULT NULL,
  `dte_allotment_letter` varchar(255) DEFAULT NULL,
  `dte_allotment_letter_path` varchar(100) DEFAULT NULL,
  `arc_ackw_receipt` varchar(255) DEFAULT NULL,
  `arc_ackw_receipt_path` varchar(100) DEFAULT NULL,
  `ssc_marksheet` varchar(100) DEFAULT NULL,
  `ssc_marksheet_path` varchar(255) DEFAULT NULL,
  `hsc_diploma_marksheet` varchar(100) DEFAULT NULL,
  `hsc_diploma_marksheet_path` varchar(255) DEFAULT NULL,
  `first_year_marksheet` varchar(100) DEFAULT NULL,
  `first_year_marksheet_path` varchar(255) DEFAULT NULL,
  `second_year_marksheet` varchar(100) DEFAULT NULL,
  `second_year_marksheet_path` varchar(255) DEFAULT NULL,
  `third_year_marksheet` varchar(100) DEFAULT NULL,
  `third_year_marksheet_path` varchar(255) DEFAULT NULL,
  `fourth_year_marksheet` varchar(100) DEFAULT NULL,
  `fourth_year_marksheet_path` varchar(255) DEFAULT NULL,
  `convocation_passing_certi` varchar(255) DEFAULT NULL,
  `convocation_passing_certi_path` varchar(100) DEFAULT NULL,
  `equivalent_certi` varchar(100) DEFAULT NULL,
  `equivalent_certi_path` varchar(100) DEFAULT NULL,
  `gap_certi` varchar(100) DEFAULT NULL,
  `gap_certi_path` varchar(255) DEFAULT NULL,
  `migration_certi` varchar(255) DEFAULT NULL,
  `migration_certi_path` varchar(100) DEFAULT NULL,
  `nationality_certi` varchar(100) DEFAULT NULL,
  `nationality_certi_path` varchar(255) DEFAULT NULL,
  `domicile` varchar(255) DEFAULT NULL,
  `domicile_path` varchar(100) DEFAULT NULL,
  `birth_certi` varchar(255) DEFAULT NULL,
  `birth_certi_path` varchar(100) DEFAULT NULL,
  `proforma_o` varchar(255) DEFAULT NULL,
  `proforma_o_path` varchar(100) DEFAULT NULL,
  `retention` varchar(255) DEFAULT NULL,
  `retention_path` varchar(100) DEFAULT NULL,
  `aadhar` varchar(255) DEFAULT NULL,
  `aadhar_path` varchar(100) DEFAULT NULL,
  `community_certi` varchar(255) DEFAULT NULL,
  `community_certi_path` varchar(100) DEFAULT NULL,
  `caste_certi` varchar(255) DEFAULT NULL,
  `caste_certi_path` varchar(100) DEFAULT NULL,
  `caste_validity_certi` varchar(255) DEFAULT NULL,
  `caste_validity_certi_path` varchar(100) DEFAULT NULL,
  `non_creamy_layer_certi` varchar(255) DEFAULT NULL,
  `non_creamy_layer_certi_path` varchar(100) DEFAULT NULL,
  `minority_affidavit` varchar(255) DEFAULT NULL,
  `minority_affidavit_path` varchar(100) DEFAULT NULL,
  `minority_affidavit_parent` varchar(255) DEFAULT NULL,
  `minority_affidavit_parent_path` varchar(100) DEFAULT NULL,
  `proforma_h` varchar(255) NOT NULL,
  `proforma_h_path` varchar(100) NOT NULL,
  `proforma_a_b1_b2` varchar(255) NOT NULL,
  `proforma_a_b1_b2_path` varchar(100) NOT NULL,
  `proforma_u` varchar(255) NOT NULL,
  `proforma_u_path` varchar(100) NOT NULL,
  `proforma_c_d_e` varchar(255) NOT NULL,
  `proforma_c_d_e_path` varchar(100) NOT NULL,
  `proforma_v` varchar(255) NOT NULL,
  `proforma_v_path` varchar(100) NOT NULL,
  `medical_certi` varchar(255) DEFAULT NULL,
  `medical_certi_path` varchar(100) DEFAULT NULL,
  `income_certi` varchar(255) DEFAULT NULL,
  `income_certi_path` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `signature_path` varchar(100) DEFAULT NULL,
  `anti_ragging_affidavit` varchar(100) DEFAULT NULL,
  `anti_ragging_affidavit_path` varchar(255) DEFAULT NULL,
  `is_document_completed` tinyint(1) NOT NULL DEFAULT '0',
  `degree_leaving_tc` varchar(100) DEFAULT NULL,
  `degree_leaving_tc_path` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dte_allotments`
--

CREATE TABLE `dte_allotments` (
  `da_master_id` int(6) NOT NULL,
  `dte_id` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `branch` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `shift_allotted` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `course_allotted` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `allotted_cap_round` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `dte_seat_type_allotted` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `choice_code_allotted` varchar(50) NOT NULL,
  `course_allotted_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dte_allotments`
--

INSERT INTO `dte_allotments` (`da_master_id`, `dte_id`, `branch`, `shift_allotted`, `course_allotted`, `allotted_cap_round`, `dte_seat_type_allotted`, `choice_code_allotted`, `course_allotted_code`, `created_at`, `updated_at`) VALUES
(2682, 'EN19291099', 'CMPN', '1', 'FEG', '1', 'OPEN', '123', '123', '0000-00-00 00:00:00', '2019-12-19 13:15:42'),
(2683, 'EN19001122', 'EXTC', '1', 'FEG', '1', 'OPEN MU', '123', '123', '0000-00-00 00:00:00', '2019-12-19 13:19:08'),
(2684, 'EN19112233', 'INST', '1', 'FEG', '1', 'OPEN SINDHI', '123', '123', '0000-00-00 00:00:00', '2019-12-19 13:20:19'),
(2685, 'EN19223344', 'CMPN', '2', 'FEG', '1', 'OPEN SINDHI', '123', '123', '0000-00-00 00:00:00', '2019-12-19 13:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(6) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_type` varchar(15) NOT NULL,
  `event_from_date` date NOT NULL,
  `event_to_date` date NOT NULL,
  `course` varchar(3) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `event_type`, `event_from_date`, `event_to_date`, `course`, `created_at`, `updated_at`) VALUES
(1, 'DTE', 'DTE', '2019-07-17', '2019-07-20', 'MCA', '2018-07-04 11:27:46', '2019-07-18 05:19:57'),
(2, 'ACAP', 'ACAP', '2019-02-23', '2019-08-09', 'MCA', '2018-06-19 11:49:42', '2019-08-09 05:11:24'),
(8, 'ACAP', 'ACAP', '2019-08-08', '2019-08-21', 'MEG', '2018-08-23 07:17:12', '2019-08-20 07:34:29'),
(9, 'DTE', 'DTE', '2019-07-25', '2019-07-27', 'MEG', '2018-08-09 10:00:00', '2019-07-25 06:18:32'),
(11, 'ACAP', 'ACAP', '2018-12-11', '2019-08-31', 'FEG', '2018-12-28 14:48:18', '2019-08-29 05:56:48'),
(12, 'DTE', 'DTE', '2019-08-10', '2019-08-14', 'DSE', '2018-12-28 14:48:18', '2019-08-13 06:30:06'),
(13, 'ACAP', 'ACAP', '2019-08-02', '2019-08-30', 'DSE', '2018-12-28 14:48:18', '2019-08-30 05:28:15'),
(15, 'DTE ROUND 1', 'DTE', '2019-07-12', '2019-12-31', 'FEG', '2018-12-28 14:48:18', '2019-12-19 13:14:58'),
(18, 'DTE ROUND 2', 'DTE', '2019-07-25', '2019-07-31', 'FEG', '2018-12-28 14:48:18', '2019-07-29 06:32:36'),
(19, 'DTE ROUND 2', 'DTE', '2019-07-26', '2019-07-28', 'MCA', '2019-07-26 21:15:08', '2019-07-29 08:03:24'),
(20, 'DTE ROUND 3', 'DTE', '2019-08-03', '2019-08-12', 'FEG', '2018-12-28 14:48:18', '2019-08-11 09:09:34'),
(21, 'DTE ROUND 3', 'DTE', '2019-08-04', '2019-08-08', 'MCA', '2019-07-26 21:15:08', '2019-08-09 05:11:09'),
(22, 'DTE ROUND 3', 'DTE', '2019-08-30', '2019-09-01', 'DSE', '2019-08-22 14:48:18', '2019-08-30 08:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `fees_structure`
--

CREATE TABLE `fees_structure` (
  `id` bigint(20) NOT NULL,
  `fee_category` varchar(50) NOT NULL,
  `course` varchar(3) NOT NULL,
  `amt` bigint(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees_structure`
--

INSERT INTO `fees_structure` (`id`, `fee_category`, `course`, `amt`, `created_at`, `updated_at`) VALUES
(1, 'OPEN MU', 'MCA', 90501, '2018-07-01 08:12:40', '2018-07-01 02:42:40'),
(2, 'OPEN OMU', 'MCA', 90901, '2018-07-23 11:38:00', '2018-07-23 06:08:00'),
(3, 'OPEN SINDHI MINORITY', 'MCA', 85339, '2018-07-23 11:38:34', '2018-07-23 06:08:34'),
(4, 'OBC/EBC MU', 'MCA', 52282, '2018-07-23 11:39:51', '2018-07-23 06:09:51'),
(5, 'OBC/EBC OMU', 'MCA', 52682, '2018-07-23 11:39:51', '2018-07-23 06:09:51'),
(6, 'SC/ST/VJ/DT/NT/SBC MU', 'MCA', 14062, '2018-07-23 11:40:27', '2018-07-23 06:10:27'),
(7, 'SC/ST/VJ/DT/NT/SBC OMU', 'MCA', 14462, '2018-07-23 11:40:27', '2018-07-23 06:10:27'),
(8, 'JK', 'MCA', 29001, '2018-07-23 11:41:05', '2018-07-23 06:11:05'),
(9, 'OMS', 'MCA', 91001, '2018-07-23 11:41:05', '2018-07-23 06:11:05'),
(10, 'OPEN', 'MCA', 90501, '2018-07-24 07:00:00', '2018-07-24 11:22:10'),
(11, 'SINDHI', 'MCA', 90501, '2018-07-24 18:01:22', '2018-07-24 12:31:22'),
(12, 'GOI', 'MCA', 28839, '2018-07-26 11:06:53', '2018-07-26 05:36:53'),
(13, 'NEUT', 'MCA', 28839, '2018-07-26 11:06:53', '2018-07-26 05:36:53'),
(14, 'OPEN', 'MEG', 98501, '2018-08-09 05:55:51', '2018-08-09 05:55:51'),
(15, 'OPEN SINDHI MINORITY', 'MEG', 98501, '2018-08-09 05:55:51', '2018-08-09 05:55:51'),
(16, 'OPEN OMU', 'MEG', 98901, '2018-08-09 05:55:51', '2018-08-09 05:55:51'),
(17, 'SC MU', 'MEG', 14868, '2018-08-09 05:55:51', '2018-08-09 05:55:51'),
(18, 'SC OMU', 'MEG', 15268, '2018-08-09 05:55:51', '2018-08-09 05:55:51'),
(19, 'OPEN MU', 'MEG', 98501, '2018-08-09 20:29:25', '2018-08-09 20:29:25'),
(20, 'SINDHI', 'MEG', 85331, '2018-07-01 08:12:40', '2018-07-01 02:42:40'),
(29, 'JK', 'FEG', 27706, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(30, 'SBC', 'FEG', 14129, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(31, 'OPEN', 'FEG', 107906, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(32, 'SINDHI', 'FEG', 107906, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(33, 'GOI', 'FEG', 105000, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(34, 'NEUT', 'FEG', 27706, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(43, 'OPEN', 'DSE', 108206, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(44, 'SINDHI', 'DSE', 108206, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(47, 'OBC/EBC MU', 'MEG', 48976, '2018-07-23 11:39:51', '2018-07-23 06:09:51'),
(48, 'JK', 'MEG', 28839, '2018-07-23 11:41:05', '2018-07-23 06:11:05'),
(50, 'GOI', 'MEG', 28839, '2018-07-26 11:06:53', '2018-07-26 05:36:53'),
(51, 'NEUT', 'MEG', 28839, '2018-07-26 11:06:53', '2018-07-26 05:36:53'),
(52, 'NT', 'FEG', 14129, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(53, 'SC', 'FEG', 14129, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(54, 'OBC', 'FEG', 61018, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(55, 'ST', 'FEG', 14129, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(56, 'PMSSS', 'FEG', 4206, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(57, 'TFWS', 'FEG', 14129, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(58, 'OMS', 'MEG', 99001, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(59, 'SBC', 'DSE', 13661, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(60, 'NT', 'DSE', 13661, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(61, 'SC', 'DSE', 13661, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(63, 'ST', 'DSE', 13661, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(66, 'OPEN_OMS', 'FEG', 108206, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(67, 'OBC_CI', 'FEG', 61318, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(68, 'TFWS_CI', 'FEG', 14429, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(69, 'SC_CI', 'FEG', 14429, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(70, 'ST_CI', 'FEG', 14429, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(71, 'NT_CI', 'FEG', 14429, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(72, 'SBC_CI', 'FEG', 14429, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(73, 'VJ', 'FEG', 14129, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(74, 'VJ_CI', 'FEG', 14429, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(75, 'DT', 'FEG', 14129, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(76, 'DT_CI', 'FEG', 14429, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(77, 'OPEN_CI', 'FEG', 108206, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(78, 'SINDHI_CI', 'FEG', 108206, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(79, 'EWS_CI', 'FEG', 61318, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(80, 'EWS', 'FEG', 61018, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(81, 'OPEN_EBC', 'FEG', 61018, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(82, 'SINDHI_EBC', 'FEG', 61018, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(83, 'OBC', 'DSE', 60934, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(84, 'OPEN_EBC', 'DSE', 60934, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(85, 'SINDHI_EBC', 'DSE', 60934, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(86, 'VJ', 'DSE', 13661, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(87, 'DT', 'DSE', 13661, '2019-06-14 12:04:19', '2019-06-14 06:34:19'),
(88, 'SEBC', 'DSE', 60934, '2019-06-14 12:04:19', '2019-06-14 06:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `fees_transaction`
--

CREATE TABLE `fees_transaction` (
  `master_trans_id` bigint(20) NOT NULL,
  `dte_id` varchar(12) NOT NULL,
  `sub_merchant_id` int(11) NOT NULL,
  `course` varchar(255) NOT NULL,
  `ref_no` varchar(50) DEFAULT NULL,
  `trans_id` varchar(100) DEFAULT NULL,
  `init_amt` varchar(10) DEFAULT NULL,
  `s_tax_amt` varchar(10) DEFAULT NULL,
  `p_fee_amt` varchar(10) DEFAULT NULL,
  `total_amt` varchar(10) DEFAULT NULL,
  `trans_amt` varchar(10) DEFAULT NULL,
  `trans_timestamp` varchar(100) DEFAULT NULL,
  `payment_timestamp` varchar(100) DEFAULT NULL,
  `payment_mode` varchar(20) DEFAULT NULL,
  `trans_status` varchar(200) DEFAULT NULL,
  `response_code` varchar(20) DEFAULT NULL,
  `admission_id` int(6) DEFAULT NULL,
  `admission_type` varchar(15) DEFAULT NULL,
  `fail_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fe_students`
--

CREATE TABLE `fe_students` (
  `fe_master_id` int(6) NOT NULL,
  `dte_id` varchar(12) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `candidate_type` varchar(3) DEFAULT NULL,
  `acap_category` varchar(50) DEFAULT NULL,
  `name_on_marksheet` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth_state` varchar(50) DEFAULT NULL,
  `place_of_birth_city` varchar(50) DEFAULT NULL,
  `mother_tongue` varchar(15) DEFAULT NULL,
  `nationality` varchar(10) DEFAULT NULL,
  `caste_tribe` varchar(15) DEFAULT NULL,
  `religion` varchar(12) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `uid` bigint(12) DEFAULT NULL,
  `student_domicile_no` varchar(30) DEFAULT NULL,
  `student_domicile_date` date DEFAULT NULL,
  `student_domicile_appl_no` varchar(30) DEFAULT NULL,
  `student_domicile_appl_date` date DEFAULT NULL,
  `is_personal_completed` tinyint(1) NOT NULL DEFAULT '0',
  `g_relation` char(1) DEFAULT NULL,
  `g_first_name` varchar(40) DEFAULT NULL,
  `g_middle_name` varchar(15) DEFAULT NULL,
  `g_last_name` varchar(15) DEFAULT NULL,
  `g_mobile` bigint(12) DEFAULT NULL,
  `g_occupation` varchar(30) DEFAULT NULL,
  `g_qualification` varchar(50) DEFAULT NULL,
  `g_office_address` varchar(250) DEFAULT NULL,
  `g_office_tel_no` bigint(12) DEFAULT NULL,
  `g_annual_income` bigint(9) DEFAULT NULL,
  `mother_name` varchar(15) DEFAULT NULL,
  `parent_domicile_no` varchar(30) DEFAULT NULL,
  `parent_domicile_date` date DEFAULT NULL,
  `parent_domicile_appl_no` varchar(30) DEFAULT NULL,
  `parent_domicile_appl_date` date DEFAULT NULL,
  `is_guardian_completed` tinyint(1) NOT NULL DEFAULT '0',
  `permanent_address_line1` varchar(255) DEFAULT NULL,
  `permanent_address_line2` varchar(255) DEFAULT NULL,
  `permanent_city` varchar(30) DEFAULT NULL,
  `permanent_district` varchar(30) DEFAULT NULL,
  `permanent_state` varchar(30) DEFAULT NULL,
  `permanent_pincode` bigint(10) DEFAULT NULL,
  `permanent_nearest_rail_station` varchar(30) DEFAULT NULL,
  `correspondance_address_line1` varchar(255) DEFAULT NULL,
  `correspondance_address_line2` varchar(255) DEFAULT NULL,
  `correspondance_city` varchar(30) DEFAULT NULL,
  `correspondance_district` varchar(30) DEFAULT NULL,
  `correspondance_state` varchar(30) DEFAULT NULL,
  `correspondance_pincode` bigint(10) DEFAULT NULL,
  `correspondance_nearest_rail_station` varchar(30) DEFAULT NULL,
  `resident_of` varchar(12) DEFAULT NULL,
  `local_guardian_name` varchar(50) DEFAULT NULL,
  `local_guardian_address_line1` varchar(255) DEFAULT NULL,
  `local_guardian_address_line2` varchar(255) DEFAULT NULL,
  `local_guardian_city` varchar(30) DEFAULT NULL,
  `local_guardian_district` varchar(30) DEFAULT NULL,
  `local_guardian_state` varchar(30) DEFAULT NULL,
  `local_guardian_pincode` bigint(10) DEFAULT NULL,
  `local_guardian_nearest_rail_station` varchar(30) DEFAULT NULL,
  `is_contact_completed` tinyint(1) NOT NULL DEFAULT '0',
  `x_passing_month` varchar(10) DEFAULT NULL,
  `x_passing_year` varchar(10) DEFAULT NULL,
  `x_board` varchar(100) DEFAULT NULL,
  `x_board_seat_no` varchar(20) DEFAULT NULL,
  `x_max_marks` bigint(3) DEFAULT NULL,
  `x_obtained_marks` bigint(3) DEFAULT NULL,
  `x_percentage` float DEFAULT NULL,
  `x_school_name` varchar(100) DEFAULT NULL,
  `x_school_city` varchar(50) DEFAULT NULL,
  `x_school_state` varchar(50) DEFAULT NULL,
  `is_diploma` char(1) DEFAULT NULL,
  `xii_passing_month` varchar(10) DEFAULT NULL,
  `xii_passing_year` varchar(10) DEFAULT NULL,
  `xii_board` varchar(100) DEFAULT NULL,
  `xii_board_seat_no` varchar(50) DEFAULT NULL,
  `xii_college_name` varchar(100) DEFAULT NULL,
  `xii_college_city` varchar(50) DEFAULT NULL,
  `xii_college_state` varchar(50) DEFAULT NULL,
  `xii_max_marks` bigint(3) DEFAULT NULL,
  `xii_obtained_marks` bigint(3) DEFAULT NULL,
  `xii_maths_max_marks` bigint(3) DEFAULT NULL,
  `xii_maths_obtained_marks` bigint(3) DEFAULT NULL,
  `xii_physics_max_marks` bigint(3) DEFAULT NULL,
  `xii_physics_obtained_marks` bigint(3) DEFAULT NULL,
  `xii_chemistry_max_marks` bigint(3) DEFAULT NULL,
  `xii_chemistry_obtained_marks` bigint(3) DEFAULT NULL,
  `xii_vocational_subject1` varchar(20) DEFAULT NULL,
  `xii_vocational_subject1_code` varchar(20) DEFAULT NULL,
  `xii_vocational_subject1_max_marks` bigint(3) DEFAULT NULL,
  `xii_vocational_subject1_obtained_marks` bigint(3) DEFAULT NULL,
  `xii_vocational_subject2` varchar(20) DEFAULT NULL,
  `xii_vocational_subject2_code` varchar(20) DEFAULT NULL,
  `xii_vocational_subject2_max_marks` bigint(5) DEFAULT NULL,
  `xii_vocational_subject2_obtained_marks` bigint(5) DEFAULT NULL,
  `xii_aggregate_marks` bigint(3) DEFAULT NULL,
  `xii_percentage` float DEFAULT NULL,
  `is_cet` tinyint(1) NOT NULL DEFAULT '0',
  `cet_seat_no` varchar(20) DEFAULT NULL,
  `cet_score` varchar(20) DEFAULT NULL,
  `cet_month` varchar(10) DEFAULT NULL,
  `cet_year` varchar(10) DEFAULT NULL,
  `cet_percentile` float DEFAULT NULL,
  `cet_maths` varchar(10) DEFAULT NULL,
  `cet_physics` varchar(10) DEFAULT NULL,
  `cet_chemistry` varchar(10) DEFAULT NULL,
  `is_jee` tinyint(1) NOT NULL DEFAULT '0',
  `jee_seat_no` varchar(20) DEFAULT NULL,
  `jee_total_score` varchar(10) DEFAULT NULL,
  `jee_score` varchar(20) DEFAULT NULL,
  `jee_month` varchar(10) DEFAULT '0',
  `jee_year` varchar(10) DEFAULT '0',
  `jee_maths_score` varchar(20) DEFAULT NULL,
  `jee_physics_score` varchar(20) DEFAULT NULL,
  `jee_chemistry_score` varchar(20) DEFAULT NULL,
  `all_india_merit_no` bigint(5) DEFAULT NULL,
  `mh_state_general_merit_no` bigint(5) DEFAULT NULL,
  `minority_dte_merit_no` bigint(5) DEFAULT NULL,
  `diploma_university` varchar(100) DEFAULT NULL,
  `diploma_passing_month` varchar(10) DEFAULT NULL,
  `diploma_passing_year` varchar(10) DEFAULT NULL,
  `diploma_max_marks` bigint(5) DEFAULT NULL,
  `diploma_obtained_marks` bigint(5) DEFAULT NULL,
  `diploma_percentage` float DEFAULT NULL,
  `diploma_branch` varchar(25) DEFAULT NULL,
  `diploma_college_name` varchar(100) DEFAULT NULL,
  `diploma_college_city` varchar(50) DEFAULT NULL,
  `diploma_college_state` varchar(50) DEFAULT NULL,
  `diploma_seat_no` varchar(25) DEFAULT NULL,
  `is_academic_completed` tinyint(1) NOT NULL DEFAULT '0',
  `seat_type` varchar(30) DEFAULT NULL,
  `choice_code_allotted` bigint(10) DEFAULT NULL,
  `shift_allotted` varchar(10) DEFAULT NULL,
  `allotted_cap_round` varchar(10) DEFAULT NULL,
  `course_allotted` varchar(80) DEFAULT NULL,
  `course_allotted_code` varchar(10) DEFAULT NULL,
  `dte_branch` varchar(50) DEFAULT NULL,
  `is_dte_details_completed` tinyint(1) NOT NULL DEFAULT '0',
  `fc_confirmation_receipt` varchar(255) DEFAULT NULL,
  `fc_confirmation_receipt_path` varchar(100) DEFAULT NULL,
  `dte_allotment_letter` varchar(255) DEFAULT NULL,
  `dte_allotment_letter_path` varchar(100) DEFAULT NULL,
  `arc_ackw_receipt` varchar(255) DEFAULT NULL,
  `arc_ackw_receipt_path` varchar(100) DEFAULT NULL,
  `cet_result` varchar(255) DEFAULT NULL,
  `cet_result_path` varchar(100) DEFAULT NULL,
  `jee_result` varchar(255) DEFAULT NULL,
  `jee_result_path` varchar(100) DEFAULT NULL,
  `ssc_marksheet` varchar(255) DEFAULT NULL,
  `ssc_marksheet_path` varchar(100) DEFAULT NULL,
  `hsc_marksheet` varchar(255) DEFAULT NULL,
  `hsc_marksheet_path` varchar(100) DEFAULT NULL,
  `diploma_marksheet` varchar(255) DEFAULT NULL,
  `diploma_marksheet_path` varchar(100) DEFAULT NULL,
  `hsc_passing_certi` varchar(255) DEFAULT NULL,
  `hsc_passing_certi_path` varchar(100) DEFAULT NULL,
  `hsc_leaving_certi` varchar(255) DEFAULT NULL,
  `hsc_leaving_certi_path` varchar(100) DEFAULT NULL,
  `diploma_passing_certi` varchar(255) DEFAULT NULL,
  `diploma_passing_certi_path` varchar(100) DEFAULT NULL,
  `migration_certi` varchar(255) DEFAULT NULL,
  `migration_certi_path` varchar(100) DEFAULT NULL,
  `birth_certi` varchar(255) DEFAULT NULL,
  `birth_certi_path` varchar(100) DEFAULT NULL,
  `domicile` varchar(255) DEFAULT NULL,
  `domicile_path` varchar(100) DEFAULT NULL,
  `gap_certi` varchar(255) DEFAULT NULL,
  `gap_certi_path` varchar(100) DEFAULT NULL,
  `proforma_o` varchar(255) DEFAULT NULL,
  `proforma_o_path` varchar(100) DEFAULT NULL,
  `retention` varchar(255) DEFAULT NULL,
  `retention_path` varchar(100) DEFAULT NULL,
  `aadhar` varchar(255) DEFAULT NULL,
  `aadhar_path` varchar(100) DEFAULT NULL,
  `community_certi` varchar(255) DEFAULT NULL,
  `community_certi_path` varchar(100) DEFAULT NULL,
  `caste_certi` varchar(255) DEFAULT NULL,
  `caste_certi_path` varchar(100) DEFAULT NULL,
  `caste_validity_certi` varchar(255) DEFAULT NULL,
  `caste_validity_certi_path` varchar(100) DEFAULT NULL,
  `non_creamy_layer_certi` varchar(255) DEFAULT NULL,
  `non_creamy_layer_certi_path` varchar(100) DEFAULT NULL,
  `minority_affidavit` varchar(255) DEFAULT NULL,
  `minority_affidavit_path` varchar(100) DEFAULT NULL,
  `minority_affidavit_parent` varchar(255) DEFAULT NULL,
  `minority_affidavit_parent_path` varchar(100) DEFAULT NULL,
  `proforma_h` varchar(255) DEFAULT NULL,
  `proforma_h_path` varchar(100) DEFAULT NULL,
  `proforma_a_b1_b2` varchar(255) DEFAULT NULL,
  `proforma_a_b1_b2_path` varchar(100) DEFAULT NULL,
  `proforma_g1_g2` varchar(255) DEFAULT NULL,
  `proforma_g1_g2_path` varchar(100) DEFAULT NULL,
  `proforma_c_d_e` varchar(255) DEFAULT NULL,
  `proforma_c_d_e_path` varchar(100) DEFAULT NULL,
  `proforma_j_k_l` varchar(255) DEFAULT NULL,
  `proforma_j_k_l_path` varchar(100) DEFAULT NULL,
  `proforma_u` varchar(250) DEFAULT NULL,
  `proforma_u_path` varchar(100) DEFAULT NULL,
  `proforma_v` varchar(250) DEFAULT NULL,
  `proforma_v_path` varchar(100) DEFAULT NULL,
  `medical_certi` varchar(255) DEFAULT NULL,
  `medical_certi_path` varchar(100) DEFAULT NULL,
  `income_certi` varchar(255) DEFAULT NULL,
  `income_certi_path` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo_path` varchar(100) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `signature_path` varchar(100) DEFAULT NULL,
  `anti_ragging_affidavit` varchar(255) DEFAULT NULL,
  `anti_ragging_affidavit_path` varchar(100) DEFAULT NULL,
  `is_document_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fe_students`
--

INSERT INTO `fe_students` (`fe_master_id`, `dte_id`, `category`, `candidate_type`, `acap_category`, `name_on_marksheet`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `place_of_birth_state`, `place_of_birth_city`, `mother_tongue`, `nationality`, `caste_tribe`, `religion`, `blood_group`, `uid`, `student_domicile_no`, `student_domicile_date`, `student_domicile_appl_no`, `student_domicile_appl_date`, `is_personal_completed`, `g_relation`, `g_first_name`, `g_middle_name`, `g_last_name`, `g_mobile`, `g_occupation`, `g_qualification`, `g_office_address`, `g_office_tel_no`, `g_annual_income`, `mother_name`, `parent_domicile_no`, `parent_domicile_date`, `parent_domicile_appl_no`, `parent_domicile_appl_date`, `is_guardian_completed`, `permanent_address_line1`, `permanent_address_line2`, `permanent_city`, `permanent_district`, `permanent_state`, `permanent_pincode`, `permanent_nearest_rail_station`, `correspondance_address_line1`, `correspondance_address_line2`, `correspondance_city`, `correspondance_district`, `correspondance_state`, `correspondance_pincode`, `correspondance_nearest_rail_station`, `resident_of`, `local_guardian_name`, `local_guardian_address_line1`, `local_guardian_address_line2`, `local_guardian_city`, `local_guardian_district`, `local_guardian_state`, `local_guardian_pincode`, `local_guardian_nearest_rail_station`, `is_contact_completed`, `x_passing_month`, `x_passing_year`, `x_board`, `x_board_seat_no`, `x_max_marks`, `x_obtained_marks`, `x_percentage`, `x_school_name`, `x_school_city`, `x_school_state`, `is_diploma`, `xii_passing_month`, `xii_passing_year`, `xii_board`, `xii_board_seat_no`, `xii_college_name`, `xii_college_city`, `xii_college_state`, `xii_max_marks`, `xii_obtained_marks`, `xii_maths_max_marks`, `xii_maths_obtained_marks`, `xii_physics_max_marks`, `xii_physics_obtained_marks`, `xii_chemistry_max_marks`, `xii_chemistry_obtained_marks`, `xii_vocational_subject1`, `xii_vocational_subject1_code`, `xii_vocational_subject1_max_marks`, `xii_vocational_subject1_obtained_marks`, `xii_vocational_subject2`, `xii_vocational_subject2_code`, `xii_vocational_subject2_max_marks`, `xii_vocational_subject2_obtained_marks`, `xii_aggregate_marks`, `xii_percentage`, `is_cet`, `cet_seat_no`, `cet_score`, `cet_month`, `cet_year`, `cet_percentile`, `cet_maths`, `cet_physics`, `cet_chemistry`, `is_jee`, `jee_seat_no`, `jee_total_score`, `jee_score`, `jee_month`, `jee_year`, `jee_maths_score`, `jee_physics_score`, `jee_chemistry_score`, `all_india_merit_no`, `mh_state_general_merit_no`, `minority_dte_merit_no`, `diploma_university`, `diploma_passing_month`, `diploma_passing_year`, `diploma_max_marks`, `diploma_obtained_marks`, `diploma_percentage`, `diploma_branch`, `diploma_college_name`, `diploma_college_city`, `diploma_college_state`, `diploma_seat_no`, `is_academic_completed`, `seat_type`, `choice_code_allotted`, `shift_allotted`, `allotted_cap_round`, `course_allotted`, `course_allotted_code`, `dte_branch`, `is_dte_details_completed`, `fc_confirmation_receipt`, `fc_confirmation_receipt_path`, `dte_allotment_letter`, `dte_allotment_letter_path`, `arc_ackw_receipt`, `arc_ackw_receipt_path`, `cet_result`, `cet_result_path`, `jee_result`, `jee_result_path`, `ssc_marksheet`, `ssc_marksheet_path`, `hsc_marksheet`, `hsc_marksheet_path`, `diploma_marksheet`, `diploma_marksheet_path`, `hsc_passing_certi`, `hsc_passing_certi_path`, `hsc_leaving_certi`, `hsc_leaving_certi_path`, `diploma_passing_certi`, `diploma_passing_certi_path`, `migration_certi`, `migration_certi_path`, `birth_certi`, `birth_certi_path`, `domicile`, `domicile_path`, `gap_certi`, `gap_certi_path`, `proforma_o`, `proforma_o_path`, `retention`, `retention_path`, `aadhar`, `aadhar_path`, `community_certi`, `community_certi_path`, `caste_certi`, `caste_certi_path`, `caste_validity_certi`, `caste_validity_certi_path`, `non_creamy_layer_certi`, `non_creamy_layer_certi_path`, `minority_affidavit`, `minority_affidavit_path`, `minority_affidavit_parent`, `minority_affidavit_parent_path`, `proforma_h`, `proforma_h_path`, `proforma_a_b1_b2`, `proforma_a_b1_b2_path`, `proforma_g1_g2`, `proforma_g1_g2_path`, `proforma_c_d_e`, `proforma_c_d_e_path`, `proforma_j_k_l`, `proforma_j_k_l_path`, `proforma_u`, `proforma_u_path`, `proforma_v`, `proforma_v_path`, `medical_certi`, `medical_certi_path`, `income_certi`, `income_certi_path`, `photo`, `photo_path`, `signature`, `signature_path`, `anti_ragging_affidavit`, `anti_ragging_affidavit_path`, `is_document_completed`, `created_at`, `updated_at`) VALUES
(1016, 'EN19291099', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'OPEN', 123, '1', '1', 'FEG', '123', 'CMPN', 0, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, 'No', NULL, 'No', NULL, NULL, NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, 'No', NULL, 'No', NULL, 'Not Applicable', NULL, 'Not Applicable', NULL, 'Not Applicable', NULL, 'No', NULL, 'Not Applicable', NULL, 'Not Applicable', NULL, 'Not Applicable', NULL, 'Not Applicable', NULL, 'Not Applicable', NULL, NULL, NULL, NULL, NULL, 'Not Applicable', NULL, 'Not Applicable', NULL, 'Not Applicable', NULL, 'Not Applicable', NULL, 'Not Applicable', NULL, 'Not Applicable', NULL, 'No', NULL, 'Not Applicable', NULL, 'Yes', 'photoEN19291099.jpg', 'No', NULL, 'No', NULL, 0, '2019-12-19 18:46:07', '2019-12-19 13:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `important_notice`
--

CREATE TABLE `important_notice` (
  `id` int(10) NOT NULL,
  `course` varchar(255) NOT NULL,
  `pdf_location` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `important_notice`
--

INSERT INTO `important_notice` (`id`, `course`, `pdf_location`, `message`, `updated_at`, `created_at`) VALUES
(23, 'UG', 'Procedure for Cancellation.pdf', 'Procedure for Cancellation', '2019-07-10 02:17:27', '2019-07-10 07:47:27'),
(25, 'PG', 'Procedure for Cancellation.pdf', 'Procedure for Cancellation', '2019-07-10 02:19:55', '2019-07-10 07:49:55'),
(26, 'UG', 'Instructions for Candidates those who freezed their admission in VESIT.pdf', 'Instructions for Candidates those who freezed their admission in VESIT', '2019-07-11 02:03:54', '2019-07-11 07:33:54'),
(27, 'UG', 'Click Here for ACAP Applications.pdf', 'Click Here for ACAP Applications', '2019-07-29 02:23:34', '2019-07-29 07:53:34'),
(28, 'PG', 'Click Here for ACAP Applications.pdf', 'Click Here for ACAP Applications', '2019-07-29 02:23:45', '2019-07-29 07:53:45'),
(34, 'UG', 'Advertisement 2 ( 2nd August 2019).pdf', 'Advertisement 2 ( 2nd August 2019)', '2019-08-02 06:11:30', '2019-08-02 11:41:30'),
(35, 'PG', 'Advertisement 2 (2nd August 2019).pdf', 'Advertisement 2 (2nd August 2019)', '2019-08-02 06:12:02', '2019-08-02 11:42:02'),
(36, 'UG', 'Advertisement 1 (8th July 2019).pdf', 'Advertisement 1 (8th July 2019)', '2019-08-02 06:13:10', '2019-08-02 11:43:10'),
(37, 'PG', 'Advertisement 1 (8th July 2019).pdf', 'Advertisement 1 (8th July 2019)', '2019-08-02 06:13:22', '2019-08-02 11:43:22'),
(39, 'PG', 'Provisional Merit List for MCA 2019-2020.pdf', 'Provisional Merit List for MCA 2019-2020', '2019-08-08 23:23:13', '2019-08-09 04:53:13'),
(40, 'UG', 'Procedure for ACAP Counseling Rounds.pdf', 'Procedure for ACAP Counseling Rounds', '2019-08-09 07:01:52', '2019-08-09 12:31:52'),
(41, 'PG', 'Procedure for ACAP Counseling Rounds.pdf', 'Procedure for ACAP Counseling Rounds', '2019-08-09 07:02:04', '2019-08-09 12:32:04'),
(43, 'UG', 'Special round of counseling for FE on 29-8-19, 30-8-19 & 31-8-19..pdf', 'Special round of counseling for FE on 29-8-19, 30-8-19 & 31-8-19.', '2019-08-29 00:27:52', '2019-08-29 05:57:52'),
(44, 'UG', 'Schedule for DSE ACAP.pdf', 'Schedule for DSE ACAP', '2019-08-29 01:47:50', '2019-08-29 07:17:50'),
(45, 'UG', 'DSE Provisional Merit List(Group A Open).pdf', 'DSE Provisional Merit List(Group A Open)', '2019-08-30 06:44:00', '2019-08-30 12:14:00'),
(46, 'UG', 'DSE Provisional Merit List(Group A Sindhi).pdf', 'DSE Provisional Merit List(Group A Sindhi)', '2019-08-30 06:44:43', '2019-08-30 12:14:43'),
(47, 'UG', 'DSE Provisional Merit List(Group B OPEN).pdf', 'DSE Provisional Merit List(Group B OPEN)', '2019-08-30 06:45:09', '2019-08-30 12:15:09'),
(48, 'UG', 'DSE Provisional Merit List(Group C OPEN).pdf', 'DSE Provisional Merit List(Group C OPEN)', '2019-08-30 06:45:39', '2019-08-30 12:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `latest_news`
--

CREATE TABLE `latest_news` (
  `id` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `latest_news`
--

INSERT INTO `latest_news` (`id`, `message`, `created_at`, `updated_at`) VALUES
(16, 'For Technical Queries, Contact : 9136132532', '2019-07-06 11:19:21', '2019-07-06 05:49:21'),
(18, 'Increase in intake of Information Technology from 60 to 120', '2019-07-06 11:20:04', '2019-07-06 05:50:04'),
(21, 'For Technical Queries call or whatsapp between 11:00 a.m. - 5:00 p.m.', '2019-07-08 11:48:53', '2019-07-12 07:18:12'),
(23, 'Sale of forms for ACAP vacancy from 2nd august to 9th august for FE/ME/MCA.', '2019-08-02 07:24:14', '2019-08-08 11:52:13'),
(24, 'Sale of forms for ACAP vacancy from 2nd august to 24th august for DSE.', '2019-08-02 07:24:45', '2019-08-21 09:03:04'),
(25, 'Sale of forms for ACAP has been extended upto 31st August 2019(upto 2:00pm) for FE', '2019-08-14 05:45:23', '2019-08-29 05:48:26'),
(27, 'Special round of counseling for FE on 29/8/19, 30/8/19 & 31/8/19.For details read notice', '2019-08-26 13:55:53', '2019-08-29 05:47:03'),
(29, 'There is no vacancy in DSE in any Branch as on 4th Sept 2019 at 12:30 pm. Counseling will be conducted as per schedule in case, vacancy arries. Vacancy position  on 5th Sept 2019 will be displayed   at 10.30am (college website).', '2019-09-04 07:28:20', '2019-09-04 01:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `mca_intake`
--

CREATE TABLE `mca_intake` (
  `intake_dept` varchar(255) NOT NULL,
  `intake_f_shift_open` int(11) NOT NULL,
  `alloted_f_shift_open` int(11) NOT NULL,
  `intake_s_shift_open` int(11) NOT NULL,
  `alloted_s_shift_open` int(11) NOT NULL,
  `intake_f_shift_sindhi` int(11) NOT NULL,
  `alloted_f_shift_sindhi` int(11) NOT NULL,
  `intake_s_shift_sindhi` int(11) NOT NULL,
  `alloted_s_shift_sindhi` int(11) NOT NULL,
  `intake_f_shift_jkm` int(11) NOT NULL,
  `alloted_f_shift_jkm` int(11) NOT NULL,
  `intake_s_shift_jkm` int(11) NOT NULL,
  `alloted_s_shift_jkm` int(11) NOT NULL,
  `intake_f_shift_goi` int(11) NOT NULL,
  `alloted_f_shift_goi` int(11) NOT NULL,
  `intake_s_shift_goi` int(11) NOT NULL,
  `alloted_s_shift_goi` int(11) NOT NULL,
  `intake_f_shift_pmsssjk` int(11) NOT NULL,
  `alloted_f_shift_pmsssjk` int(11) NOT NULL,
  `intake_s_shift_pmsssjk` int(11) NOT NULL,
  `alloted_s_shift_pmsssjk` int(11) NOT NULL,
  `intake_f_shift_neut` int(11) NOT NULL,
  `alloted_f_shift_neut` int(11) NOT NULL,
  `intake_s_shift_neut` int(11) NOT NULL,
  `alloted_s_shift_neut` int(11) NOT NULL,
  `intake_f_shift_tfws` int(11) NOT NULL,
  `alloted_f_shift_tfws` int(11) NOT NULL,
  `intake_s_shift_tfws` int(11) NOT NULL,
  `alloted_s_shift_tfws` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mca_students`
--

CREATE TABLE `mca_students` (
  `mca_master_id` int(6) NOT NULL,
  `dte_id` varchar(12) NOT NULL,
  `name_on_marksheet` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth_state` varchar(50) DEFAULT NULL,
  `place_of_birth_city` varchar(50) DEFAULT NULL,
  `mother_tongue` varchar(15) DEFAULT NULL,
  `nationality` varchar(10) DEFAULT NULL,
  `caste_tribe` varchar(15) DEFAULT NULL,
  `religion` varchar(12) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `uid` bigint(12) DEFAULT NULL,
  `student_domicile_no` varchar(30) DEFAULT NULL,
  `student_domicile_date` date DEFAULT NULL,
  `student_domicile_appl_no` varchar(30) DEFAULT NULL,
  `student_domicile_appl_date` date DEFAULT NULL,
  `is_personal_completed` tinyint(1) NOT NULL DEFAULT '0',
  `g_relation` char(1) DEFAULT NULL,
  `g_first_name` varchar(30) DEFAULT NULL,
  `g_middle_name` varchar(30) DEFAULT NULL,
  `g_last_name` varchar(30) DEFAULT NULL,
  `g_mobile` bigint(12) DEFAULT NULL,
  `g_occupation` varchar(30) DEFAULT NULL,
  `g_qualification` varchar(50) DEFAULT NULL,
  `g_office_address` varchar(250) DEFAULT NULL,
  `g_office_tel_no` bigint(12) DEFAULT NULL,
  `g_annual_income` bigint(9) DEFAULT NULL,
  `parent_domicile_no` varchar(30) DEFAULT NULL,
  `parent_domicile_date` date DEFAULT NULL,
  `parent_domicile_appl_no` varchar(30) DEFAULT NULL,
  `parent_domicile_appl_date` date DEFAULT NULL,
  `mother_name` varchar(15) DEFAULT NULL,
  `is_guardian_completed` tinyint(1) NOT NULL DEFAULT '0',
  `permanent_address_line1` varchar(255) DEFAULT NULL,
  `permanent_address_line2` varchar(255) DEFAULT NULL,
  `permanent_city` varchar(30) DEFAULT NULL,
  `permanent_district` varchar(30) DEFAULT NULL,
  `permanent_state` varchar(30) DEFAULT NULL,
  `permanent_pincode` bigint(10) DEFAULT NULL,
  `permanent_nearest_rail_station` varchar(30) DEFAULT NULL,
  `correspondance_address_line1` varchar(255) DEFAULT NULL,
  `correspondance_address_line2` varchar(255) DEFAULT NULL,
  `correspondance_city` varchar(30) DEFAULT NULL,
  `correspondance_district` varchar(30) DEFAULT NULL,
  `correspondance_state` varchar(30) DEFAULT NULL,
  `correspondance_pincode` bigint(10) DEFAULT NULL,
  `correspondance_nearest_rail_station` varchar(30) DEFAULT NULL,
  `resident_of` varchar(12) DEFAULT NULL,
  `local_guardian_name` varchar(50) DEFAULT NULL,
  `local_guardian_address_line1` varchar(255) DEFAULT NULL,
  `local_guardian_address_line2` varchar(255) DEFAULT NULL,
  `local_guardian_city` varchar(30) DEFAULT NULL,
  `local_guardian_district` varchar(30) DEFAULT NULL,
  `local_guardian_state` varchar(30) DEFAULT NULL,
  `local_guardian_pincode` bigint(10) DEFAULT NULL,
  `is_contact_completed` tinyint(1) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `acap_category` varchar(50) DEFAULT NULL,
  `candidate_type` varchar(3) DEFAULT NULL,
  `cet_score` varchar(5) DEFAULT NULL,
  `cet_month` varchar(10) DEFAULT NULL,
  `cet_year` varchar(10) DEFAULT NULL,
  `cet_percentile` float DEFAULT NULL,
  `all_india_merit_no` bigint(5) DEFAULT NULL,
  `mh_state_general_merit_no` bigint(5) DEFAULT NULL,
  `minority_dte_merit_no` bigint(5) DEFAULT NULL,
  `seat_type` varchar(30) DEFAULT NULL,
  `choice_code_allotted` bigint(10) DEFAULT NULL,
  `shift_allotted` varchar(10) NOT NULL,
  `allotted_cap_round` varchar(10) DEFAULT NULL,
  `course_allotted` varchar(80) DEFAULT NULL,
  `course_allotted_code` varchar(10) DEFAULT NULL,
  `is_dte_details_completed` tinyint(1) NOT NULL DEFAULT '0',
  `x_passing_month` varchar(10) DEFAULT NULL,
  `x_passing_year` varchar(10) DEFAULT NULL,
  `x_board` varchar(100) DEFAULT NULL,
  `x_max_marks` bigint(3) DEFAULT NULL,
  `x_obtained_marks` bigint(3) DEFAULT NULL,
  `x_percentage` float DEFAULT NULL,
  `x_school_name` varchar(100) DEFAULT NULL,
  `x_school_city` varchar(50) DEFAULT NULL,
  `x_school_state` varchar(50) DEFAULT NULL,
  `is_diploma` char(1) DEFAULT NULL,
  `xii_passing_month` varchar(10) DEFAULT NULL,
  `xii_passing_year` varchar(10) DEFAULT NULL,
  `xii_board` varchar(100) DEFAULT NULL,
  `xii_max_marks` bigint(3) DEFAULT NULL,
  `xii_obtained_marks` bigint(3) DEFAULT NULL,
  `xii_maths_max_marks` bigint(3) DEFAULT NULL,
  `xii_maths_obtained_marks` bigint(3) DEFAULT NULL,
  `xii_percentage` float DEFAULT NULL,
  `xii_college_name` varchar(100) DEFAULT NULL,
  `xii_college_city` varchar(50) DEFAULT NULL,
  `xii_college_state` varchar(50) DEFAULT NULL,
  `diploma_university` varchar(100) DEFAULT NULL,
  `diploma_passing_month` varchar(10) DEFAULT NULL,
  `diploma_passing_year` varchar(10) DEFAULT NULL,
  `diploma_max_marks` bigint(5) DEFAULT NULL,
  `diploma_obtained_marks` bigint(5) DEFAULT NULL,
  `diploma_percentage` float DEFAULT NULL,
  `diploma_branch` varchar(25) DEFAULT NULL,
  `diploma_college_name` varchar(100) DEFAULT NULL,
  `diploma_college_city` varchar(50) DEFAULT NULL,
  `diploma_college_state` varchar(50) DEFAULT NULL,
  `degree_name` varchar(150) DEFAULT NULL,
  `degree_branch` varchar(50) DEFAULT NULL,
  `university_type` varchar(50) NOT NULL,
  `degree_university` varchar(100) DEFAULT NULL,
  `degree_passing_month` varchar(10) DEFAULT NULL,
  `degree_passing_year` varchar(10) DEFAULT NULL,
  `degree_college_name` varchar(100) DEFAULT NULL,
  `degree_college_city` varchar(50) DEFAULT NULL,
  `degree_college_state` varchar(50) DEFAULT NULL,
  `degree_sem_1_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_1_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem_2_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_2_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem_3_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_3_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem_4_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_4_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem_5_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_5_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem_6_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_6_obt_marks` varchar(5) DEFAULT NULL,
  `degree_maths_max_marks` varchar(5) DEFAULT NULL,
  `degree_maths_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem1_sgpa` varchar(20) DEFAULT NULL,
  `degree_sem2_sgpa` varchar(20) DEFAULT NULL,
  `degree_sem3_sgpa` varchar(20) DEFAULT NULL,
  `degree_sem4_sgpa` varchar(20) DEFAULT NULL,
  `degree_sem5_sgpa` varchar(20) DEFAULT NULL,
  `degree_sem6_sgpa` varchar(20) DEFAULT NULL,
  `degree_aggr_max_marks` bigint(5) DEFAULT NULL,
  `degree_aggr_obt_marks` bigint(5) DEFAULT NULL,
  `is_new_or_old` char(1) DEFAULT NULL,
  `degree_percentage` float DEFAULT NULL,
  `degree_final_cgpa` float DEFAULT NULL,
  `is_academic_completed` tinyint(1) NOT NULL DEFAULT '0',
  `fc_confirmation_receipt` varchar(255) DEFAULT NULL,
  `fc_confirmation_receipt_path` varchar(100) DEFAULT NULL,
  `dte_allotment_letter` varchar(255) DEFAULT NULL,
  `dte_allotment_letter_path` varchar(100) DEFAULT NULL,
  `arc_ackw_receipt` varchar(255) DEFAULT NULL,
  `arc_ackw_receipt_path` varchar(100) DEFAULT NULL,
  `cet_result` varchar(255) DEFAULT NULL,
  `cet_result_path` varchar(100) DEFAULT NULL,
  `ssc_marksheet` varchar(255) DEFAULT NULL,
  `ssc_marksheet_path` varchar(100) DEFAULT NULL,
  `hsc_diploma_marksheet` varchar(255) DEFAULT NULL,
  `hsc_diploma_marksheet_path` varchar(100) DEFAULT NULL,
  `degree_leaving_tc` varchar(255) DEFAULT NULL,
  `degree_leaving_tc_path` varchar(100) DEFAULT NULL,
  `first_year_marksheet` varchar(255) DEFAULT NULL,
  `first_year_marksheet_path` varchar(100) DEFAULT NULL,
  `second_year_marksheet` varchar(255) DEFAULT NULL,
  `second_year_marksheet_path` varchar(100) DEFAULT NULL,
  `third_year_marksheet` varchar(255) DEFAULT NULL,
  `third_year_marksheet_path` varchar(100) DEFAULT NULL,
  `convocation_passing_certi` varchar(255) DEFAULT NULL,
  `convocation_passing_certi_path` varchar(100) DEFAULT NULL,
  `migration_certi` varchar(255) DEFAULT NULL,
  `migration_certi_path` varchar(100) DEFAULT NULL,
  `birth_certi` varchar(255) DEFAULT NULL,
  `birth_certi_path` varchar(100) DEFAULT NULL,
  `domicile` varchar(255) DEFAULT NULL,
  `domicile_path` varchar(100) DEFAULT NULL,
  `proforma_o` varchar(255) DEFAULT NULL,
  `proforma_o_path` varchar(100) DEFAULT NULL,
  `retention` varchar(255) DEFAULT NULL,
  `retention_path` varchar(100) DEFAULT NULL,
  `minority_affidavit` varchar(255) DEFAULT NULL,
  `minority_affidavit_path` varchar(100) DEFAULT NULL,
  `minority_affidavit_parent` varchar(50) DEFAULT NULL,
  `minority_affidavit_parent_path` varchar(50) DEFAULT NULL,
  `gap_certi` varchar(255) DEFAULT NULL,
  `gap_certi_path` varchar(100) DEFAULT NULL,
  `community_certi` varchar(255) DEFAULT NULL,
  `community_certi_path` varchar(100) DEFAULT NULL,
  `caste_certi` varchar(255) DEFAULT NULL,
  `caste_certi_path` varchar(100) DEFAULT NULL,
  `caste_validity_certi` varchar(255) DEFAULT NULL,
  `caste_validity_certi_path` varchar(100) DEFAULT NULL,
  `non_creamy_layer_certi` varchar(255) DEFAULT NULL,
  `non_creamy_layer_certi_path` varchar(100) DEFAULT NULL,
  `proforma_a_b1_b2` varchar(255) DEFAULT NULL,
  `proforma_a_b1_b2_path` varchar(100) DEFAULT NULL,
  `proforma_u` varchar(255) DEFAULT NULL,
  `proforma_u_path` varchar(100) DEFAULT NULL,
  `income_certi` varchar(255) DEFAULT NULL,
  `income_certi_path` varchar(100) DEFAULT NULL,
  `proforma_c_d_e` varchar(255) DEFAULT NULL,
  `proforma_c_d_e_path` varchar(100) DEFAULT NULL,
  `proforma_v` varchar(250) DEFAULT NULL,
  `proforma_v_path` varchar(100) DEFAULT NULL,
  `anti_ragging_affidavit` varchar(255) DEFAULT NULL,
  `anti_ragging_affidavit_path` varchar(100) DEFAULT NULL,
  `medical_certi` varchar(255) DEFAULT NULL,
  `medical_certi_path` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo_path` varchar(100) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `signature_path` varchar(100) DEFAULT NULL,
  `is_document_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_intake`
--

CREATE TABLE `me_intake` (
  `intake_dept` varchar(255) NOT NULL,
  `intake_f_shift_open` int(11) NOT NULL,
  `alloted_f_shift_open` int(11) NOT NULL,
  `intake_s_shift_open` int(11) NOT NULL,
  `alloted_s_shift_open` int(11) NOT NULL,
  `intake_f_shift_sindhi` int(11) NOT NULL,
  `alloted_f_shift_sindhi` int(11) NOT NULL,
  `intake_s_shift_sindhi` int(11) NOT NULL,
  `alloted_s_shift_sindhi` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_students`
--

CREATE TABLE `me_students` (
  `me_master_id` int(6) NOT NULL,
  `dte_id` varchar(12) DEFAULT NULL,
  `name_on_marksheet` varchar(50) DEFAULT NULL,
  `gender` varchar(15) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth_state` varchar(50) DEFAULT NULL,
  `place_of_birth_city` varchar(50) DEFAULT NULL,
  `mother_tongue` varchar(15) DEFAULT NULL,
  `nationality` varchar(10) DEFAULT NULL,
  `caste_tribe` varchar(15) DEFAULT NULL,
  `religion` varchar(12) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `uid` bigint(12) DEFAULT NULL,
  `student_domicile_no` varchar(15) DEFAULT NULL,
  `g_relation` char(1) DEFAULT NULL,
  `g_first_name` varchar(15) DEFAULT NULL,
  `g_middle_name` varchar(15) DEFAULT NULL,
  `g_last_name` varchar(15) DEFAULT NULL,
  `g_mobile` bigint(12) DEFAULT NULL,
  `g_occupation` varchar(15) DEFAULT NULL,
  `g_qualification` varchar(15) DEFAULT NULL,
  `g_office_address` varchar(250) DEFAULT NULL,
  `g_office_tel_no` bigint(12) DEFAULT NULL,
  `g_annual_income` bigint(9) DEFAULT NULL,
  `parent_domicile_no` varchar(15) DEFAULT NULL,
  `is_guardian_completed` tinyint(1) NOT NULL DEFAULT '0',
  `permanent_address_line1` varchar(255) DEFAULT NULL,
  `permanent_address_line2` varchar(255) DEFAULT NULL,
  `permanent_city` varchar(30) DEFAULT NULL,
  `permanent_district` varchar(30) DEFAULT NULL,
  `permanent_state` varchar(30) DEFAULT NULL,
  `permanent_pincode` bigint(10) DEFAULT NULL,
  `permanent_nearest_rail_station` varchar(30) DEFAULT NULL,
  `correspondance_address_line1` varchar(255) DEFAULT NULL,
  `correspondance_address_line2` varchar(255) DEFAULT NULL,
  `correspondance_city` varchar(30) DEFAULT NULL,
  `correspondance_district` varchar(30) DEFAULT NULL,
  `correspondance_state` varchar(30) DEFAULT NULL,
  `correspondance_pincode` bigint(10) DEFAULT NULL,
  `correspondance_nearest_rail_station` varchar(30) DEFAULT NULL,
  `resident_of` varchar(10) DEFAULT NULL,
  `local_guardian_name` varchar(50) DEFAULT NULL,
  `local_guardian_address_line1` varchar(255) DEFAULT NULL,
  `local_guardian_address_line2` varchar(255) DEFAULT NULL,
  `local_guardian_city` varchar(30) DEFAULT NULL,
  `local_guardian_district` varchar(30) DEFAULT NULL,
  `local_guardian_state` varchar(30) DEFAULT NULL,
  `local_guardian_pincode` bigint(10) DEFAULT NULL,
  `is_contact_completed` tinyint(1) NOT NULL DEFAULT '0',
  `category` varchar(50) DEFAULT NULL,
  `candidate_type` varchar(10) DEFAULT NULL,
  `is_sponsored` char(1) DEFAULT NULL,
  `gate_score` varchar(10) DEFAULT NULL,
  `gate_branch` varchar(50) DEFAULT NULL,
  `gate_month` varchar(10) DEFAULT NULL,
  `gate_year` varchar(10) DEFAULT NULL,
  `gate_max_marks` bigint(5) DEFAULT NULL,
  `gate_reg_no` varchar(100) DEFAULT NULL,
  `gate_exam_paper` varchar(100) DEFAULT NULL,
  `sponsoring_company` varchar(255) DEFAULT NULL,
  `mh_state_general_merit_no` bigint(10) DEFAULT NULL,
  `minority_dte_merit_no` bigint(10) DEFAULT NULL,
  `seat_type` varchar(30) DEFAULT NULL,
  `choice_code_allotted` bigint(10) DEFAULT NULL,
  `allotted_cap_round` varchar(10) DEFAULT NULL,
  `course_allotted` varchar(80) DEFAULT NULL,
  `course_allotted_code` varchar(10) DEFAULT NULL,
  `dte_branch` varchar(50) DEFAULT NULL,
  `acap_category` varchar(50) DEFAULT NULL,
  `is_dte_completed` tinyint(1) NOT NULL DEFAULT '0',
  `student_domicile_date` date DEFAULT NULL,
  `student_domicile_appl_no` varchar(15) DEFAULT NULL,
  `student_domicile_appl_date` date DEFAULT NULL,
  `is_personal_completed` tinyint(1) NOT NULL DEFAULT '0',
  `parent_domicile_date` date DEFAULT NULL,
  `parent_domicile_appl_no` varchar(15) DEFAULT NULL,
  `parent_domicile_appl_date` date DEFAULT NULL,
  `mother_name` varchar(15) DEFAULT NULL,
  `x_passing_month` varchar(10) DEFAULT NULL,
  `x_passing_year` varchar(10) DEFAULT NULL,
  `x_board` varchar(100) DEFAULT NULL,
  `x_max_marks` bigint(3) DEFAULT NULL,
  `x_obtained_marks` bigint(3) DEFAULT NULL,
  `x_percentage` float DEFAULT NULL,
  `x_school_name` varchar(100) DEFAULT NULL,
  `x_school_city` varchar(50) DEFAULT NULL,
  `x_school_state` varchar(50) DEFAULT NULL,
  `is_diploma` char(1) DEFAULT NULL,
  `xii_passing_month` varchar(10) DEFAULT NULL,
  `xii_passing_year` varchar(10) DEFAULT NULL,
  `xii_board` varchar(100) DEFAULT NULL,
  `xii_max_marks` bigint(3) DEFAULT NULL,
  `xii_obtained_marks` bigint(3) DEFAULT NULL,
  `xii_percentage` float DEFAULT NULL,
  `xii_college_name` varchar(100) DEFAULT NULL,
  `xii_college_city` varchar(50) DEFAULT NULL,
  `xii_college_state` varchar(50) DEFAULT NULL,
  `diploma_university` varchar(100) DEFAULT NULL,
  `diploma_passing_month` varchar(10) DEFAULT NULL,
  `diploma_passing_year` varchar(10) DEFAULT NULL,
  `diploma_max_marks` bigint(5) DEFAULT NULL,
  `diploma_obtained_marks` bigint(5) DEFAULT NULL,
  `diploma_percentage` float DEFAULT NULL,
  `diploma_branch` varchar(100) DEFAULT NULL,
  `diploma_college_name` varchar(100) DEFAULT NULL,
  `diploma_college_city` varchar(50) DEFAULT NULL,
  `diploma_college_state` varchar(50) DEFAULT NULL,
  `degree_name` varchar(100) DEFAULT NULL,
  `degree_branch` varchar(100) DEFAULT NULL,
  `university_type` varchar(100) NOT NULL,
  `degree_university` varchar(100) DEFAULT NULL,
  `degree_passing_month` varchar(10) DEFAULT NULL,
  `degree_passing_year` varchar(10) DEFAULT NULL,
  `degree_college_name` varchar(100) DEFAULT NULL,
  `degree_college_city` varchar(50) DEFAULT NULL,
  `degree_college_state` varchar(50) DEFAULT NULL,
  `degree_sem_1_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_1_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem_2_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_2_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem_3_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_3_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem_4_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_4_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem_5_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_5_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem_6_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_6_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem_7_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_7_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem_8_max_marks` varchar(5) DEFAULT NULL,
  `degree_sem_8_obt_marks` varchar(5) DEFAULT NULL,
  `degree_sem8_sgpa` float DEFAULT NULL,
  `degree_aggr_max_marks` bigint(5) DEFAULT NULL,
  `degree_aggr_obt_marks` bigint(5) DEFAULT NULL,
  `is_new_or_old` char(1) DEFAULT NULL,
  `degree_percentage` float DEFAULT NULL,
  `degree_final_cgpa` float DEFAULT NULL,
  `is_academic_completed` tinyint(1) NOT NULL DEFAULT '0',
  `fc_confirmation_receipt` varchar(30) DEFAULT NULL,
  `fc_confirmation_receipt_path` varchar(255) DEFAULT NULL,
  `dte_allotment_letter` varchar(30) DEFAULT NULL,
  `dte_allotment_letter_path` varchar(255) DEFAULT NULL,
  `arc_ackw_receipt` varchar(30) DEFAULT NULL,
  `arc_ackw_receipt_path` varchar(255) DEFAULT NULL,
  `gate_result` varchar(30) DEFAULT NULL,
  `gate_result_path` varchar(255) DEFAULT NULL,
  `ssc_marksheet` varchar(30) DEFAULT NULL,
  `ssc_marksheet_path` varchar(255) DEFAULT NULL,
  `hsc_marksheet` varchar(30) DEFAULT NULL,
  `hsc_marksheet_path` varchar(255) DEFAULT NULL,
  `degree_leaving_tc` varchar(30) DEFAULT NULL,
  `degree_leaving_tc_path` varchar(255) DEFAULT NULL,
  `first_year_marksheet` varchar(30) DEFAULT NULL,
  `first_year_marksheet_path` varchar(255) DEFAULT NULL,
  `second_year_marksheet` varchar(30) DEFAULT NULL,
  `second_year_marksheet_path` varchar(255) DEFAULT NULL,
  `third_year_marksheet` varchar(30) DEFAULT NULL,
  `third_year_marksheet_path` varchar(255) DEFAULT NULL,
  `fourth_year_marksheet` varchar(30) DEFAULT NULL,
  `fourth_year_marksheet_path` varchar(255) DEFAULT NULL,
  `convocation_passing_certi` varchar(30) DEFAULT NULL,
  `convocation_passing_certi_path` varchar(255) DEFAULT NULL,
  `migration_certi` varchar(30) DEFAULT NULL,
  `migration_certi_path` varchar(255) DEFAULT NULL,
  `birth_certi` varchar(30) DEFAULT NULL,
  `birth_certi_path` varchar(255) DEFAULT NULL,
  `domicile` varchar(30) DEFAULT NULL,
  `domicile_path` varchar(255) DEFAULT NULL,
  `proforma_o` varchar(30) DEFAULT NULL,
  `proforma_o_path` varchar(255) DEFAULT NULL,
  `retention` varchar(30) DEFAULT NULL,
  `retention_path` varchar(255) DEFAULT NULL,
  `minority_affidavit` varchar(30) DEFAULT NULL,
  `minority_affidavit_path` varchar(255) DEFAULT NULL,
  `gap_certi` varchar(30) DEFAULT NULL,
  `gap_certi_path` varchar(255) DEFAULT NULL,
  `community_certi` varchar(30) DEFAULT NULL,
  `community_certi_path` varchar(255) DEFAULT NULL,
  `caste_certi` varchar(30) DEFAULT NULL,
  `caste_certi_path` varchar(255) DEFAULT NULL,
  `caste_validity_certi` varchar(30) DEFAULT NULL,
  `caste_validity_certi_path` varchar(255) DEFAULT NULL,
  `non_creamy_layer_certi` varchar(30) DEFAULT NULL,
  `non_creamy_layer_certi_path` varchar(255) DEFAULT NULL,
  `proforma_h` varchar(30) DEFAULT NULL,
  `proforma_h_path` varchar(255) DEFAULT NULL,
  `proforma_a_b1_b2` varchar(30) DEFAULT NULL,
  `proforma_a_b1_b2_path` varchar(255) DEFAULT NULL,
  `proforma_f_f1` varchar(30) DEFAULT NULL,
  `proforma_f_f1_path` varchar(255) DEFAULT NULL,
  `income_certi` varchar(30) DEFAULT NULL,
  `income_certi_path` varchar(255) DEFAULT NULL,
  `proforma_c_d_e` varchar(30) DEFAULT NULL,
  `proforma_c_d_e_path` varchar(255) DEFAULT NULL,
  `anti_ragging_affidavit` varchar(30) DEFAULT NULL,
  `anti_ragging_affidavit_path` varchar(255) DEFAULT NULL,
  `proforma_j_k_l` varchar(30) DEFAULT NULL,
  `proforma_j_k_l_path` varchar(255) DEFAULT NULL,
  `medical_certi` varchar(30) DEFAULT NULL,
  `medical_certi_path` varchar(255) DEFAULT NULL,
  `photo` varchar(30) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `signature` varchar(30) DEFAULT NULL,
  `signature_path` varchar(255) DEFAULT NULL,
  `is_document_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `part_payment`
--

CREATE TABLE `part_payment` (
  `part_payment_id` int(6) NOT NULL,
  `dte_id` varchar(12) NOT NULL,
  `amt` bigint(11) DEFAULT NULL,
  `partPayment_path` varchar(100) DEFAULT NULL,
  `verified` varchar(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_role_history`
--

CREATE TABLE `staff_role_history` (
  `staff_role_id` int(6) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `role` varchar(30) NOT NULL,
  `privilege` varchar(30) NOT NULL,
  `course` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_role_history`
--

INSERT INTO `staff_role_history` (`staff_role_id`, `email_id`, `role`, `privilege`, `course`, `created_at`, `updated_at`) VALUES
(1, 'asma.parveen@ves.ac.in', 'Admission Seizer', '', 'MCA', '2018-07-17 01:50:57', '2018-07-17 08:20:57'),
(2, 'asma.parveen@ves.ac.in', 'Document Verifier', '', 'MCA', '2018-07-20 09:39:02', '2018-07-20 04:09:02'),
(3, 'asma.parveen@ves.ac.in', 'Document Collector', '', 'MCA', '2018-07-20 09:47:58', '2018-07-20 04:17:58'),
(4, 'asma.parveen@ves.ac.in', 'Admission Seizer', '', 'MCA', '2018-07-20 10:39:31', '2018-07-20 05:09:31'),
(5, 'asma.parveen@ves.ac.in', 'Admission Seizer', '', 'MCA', '2018-07-20 10:55:00', '2018-07-20 05:25:00'),
(6, 'asma.parveen@ves.ac.in', 'Document Collector', '', 'MCA', '2018-07-20 12:26:53', '2018-07-20 06:56:53'),
(8, 'asma.parveen@ves.ac.in', 'Document Verifier', '', 'MCA', '2019-02-11 11:56:27', '2019-02-11 18:26:27'),
(9, 'asma.parveen@ves.ac.in', 'Document Verifier', '', 'MCA', '2019-02-28 05:38:51', '2019-02-28 12:08:51'),
(10, 'asma.parveen@ves.ac.in', 'Admission Seizer', '', 'ME', '2019-02-28 05:39:04', '2019-02-28 12:09:04'),
(11, 'asma.parveen@ves.ac.in', 'Admission Seizer', '', 'MCA', '2019-04-26 04:53:39', '2019-04-26 11:23:39'),
(12, 'asma.parveen@ves.ac.in', 'Admit', '', 'MCA', '2019-04-26 04:53:52', '2019-04-26 11:23:52'),
(13, 'priya.rl@ves.ac.in', 'Document Verifier', '', 'MCA', '2019-04-26 05:01:10', '2019-04-26 11:31:10'),
(14, 'priya.rl@ves.ac.in', 'Admission Cancellation', '', 'ME', '2019-04-26 05:03:53', '2019-04-26 11:33:53'),
(15, 'asma.parveen@ves.ac.in', 'Document Collector', '', 'FEG', '2019-04-26 06:01:40', '2019-04-26 12:31:40'),
(16, 'prem@gmail.com', 'Admission Cancellation', '', 'MCA', '2019-04-26 06:05:33', '2019-04-26 12:35:33'),
(17, 'prem@gmail.com', 'Admission Cancellation', '', 'ME', '2019-04-26 06:07:28', '2019-04-26 12:37:28'),
(18, 'prem@gmail.com', 'Admission Seizer', '', 'DSE', '2019-04-26 06:07:44', '2019-04-26 12:37:44'),
(19, 'asma.parveen@ves.ac.in', 'Accounts', '', 'FEG', '2019-04-26 06:08:17', '2019-04-26 12:38:17'),
(20, 'prem@gmail.com', 'Document Verifier', '', 'MCA', '2019-04-26 07:40:56', '2019-04-26 14:10:56'),
(21, 'prem@gmail.com', 'Staff', 'Admit', 'DSE', '2019-04-27 11:23:02', '2019-04-27 17:53:02'),
(22, 'asma.parveen@ves.ac.in', 'Staff', 'Admission Seizer', 'MCA', '2019-04-27 11:23:38', '2019-04-27 17:53:38'),
(23, 'rinku@gmail.com', 'Staff', 'Accounts', 'MCA', '2019-04-27 11:27:58', '2019-04-27 17:57:58'),
(24, 'prem@gmail.com', 'Staff', 'Document Verifier', 'ME', '2019-04-28 12:55:00', '2019-04-27 19:25:00'),
(25, 'asma.parveen@ves.ac.in', 'Staff', 'Accounts', 'FEG', '2019-06-15 03:24:53', '2019-06-15 09:54:53'),
(26, 'rinku@gmail.com', 'Staff', 'Admission Seizer', 'MCA', '2019-06-15 03:25:17', '2019-06-15 09:55:17'),
(27, 'rinku@gmail.com', 'Staff', 'Document Verifier', 'FEG', '2019-06-19 10:16:43', '2019-06-19 04:46:43'),
(28, 'asma.parveen@ves.ac.in', 'Staff', 'Document Collector', 'FEG', '2019-06-19 10:17:19', '2019-06-19 04:47:19'),
(29, 'asma.parveen@ves.ac.in', 'Staff', 'Document Collector', 'FEG', '2019-06-19 10:18:19', '2019-06-19 04:48:19'),
(30, 'asma.parveen@ves.ac.in', 'Staff', 'Document Collector', 'FEG', '2019-06-19 10:22:37', '2019-06-19 04:52:37'),
(31, 'rinku@gmail.com', 'Staff', 'Document Collector', 'FEG', '2019-06-19 10:22:55', '2019-06-19 04:52:55'),
(32, 'rinku@gmail.com', 'Staff', 'Document Verifier', 'FEG', '2019-06-21 11:02:16', '2019-06-21 05:32:16'),
(33, 'rinku@gmail.com', 'Staff', 'Document Collector', 'FEG', '2019-06-21 12:16:18', '2019-06-21 06:46:18'),
(34, 'rinku@gmail.com', 'Staff', 'Document Collector', 'FEG', '2019-06-21 12:18:08', '2019-06-21 06:48:08'),
(35, 'asma.parveen@ves.ac.in', 'Staff', 'Document Verifier', 'FEG', '2019-06-21 12:18:24', '2019-06-21 06:48:24'),
(36, 'rinku@gmail.com', 'Staff', 'Document Verifier', 'FEG', '2019-06-21 12:18:59', '2019-06-21 06:48:59'),
(37, 'asma.parveen@ves.ac.in', 'Staff', 'Document Collector', 'FEG', '2019-06-21 12:20:10', '2019-06-21 06:50:10'),
(38, 'rinku@gmail.com', 'Staff', 'Document Collector', 'FEG', '2019-06-21 12:20:44', '2019-06-21 06:50:44'),
(39, 'rinku@gmail.com', 'Staff', 'Admit', 'FEG', '2019-06-21 01:01:03', '2019-06-21 07:31:03'),
(40, 'rinku@gmail.com', 'Staff', 'Document Collector', 'FEG', '2019-06-21 01:11:30', '2019-06-21 07:41:30'),
(41, 'rinku@gmail.com', 'Staff', 'Admit', 'FEG', '2019-06-21 01:13:03', '2019-06-21 07:43:03'),
(42, 'rinku@gmail.com', 'Staff', 'Admission Seizer', 'FEG', '2019-06-21 01:44:57', '2019-06-21 08:14:57'),
(43, 'rinku@gmail.com', 'Staff', 'Document Verifier', 'FEG', '2019-06-21 03:48:11', '2019-06-21 10:18:11'),
(44, 'asma.parveen@ves.ac.in', 'Staff', 'Admit', 'FEG', '2019-06-21 04:57:58', '2019-06-21 11:27:58'),
(45, 'rinku@gmail.com', 'Staff', 'Admission Seizer', 'FEG', '2019-06-21 05:05:00', '2019-06-21 11:35:00'),
(46, 'rinku@gmail.com', 'Staff', 'Admit', 'FEG', '2019-06-22 09:15:48', '2019-06-22 03:45:48'),
(47, 'rinku@gmail.com', 'Staff', 'Document Verifier', 'FEG', '2019-06-22 11:53:32', '2019-06-22 06:23:32'),
(48, 'asma.parveen@ves.ac.in', 'Staff', 'Document Verifier', 'DSE', '2019-06-22 11:53:41', '2019-06-22 06:23:41'),
(49, 'rinku@gmail.com', 'Staff', 'Document Verifier', 'DSE', '2019-06-22 11:55:54', '2019-06-22 06:25:54'),
(50, 'rinku@gmail.com', 'Staff', 'Document Collector', 'DSE', '2019-06-22 12:03:37', '2019-06-22 06:33:37'),
(51, 'rinku@gmail.com', 'Staff', 'Admit', 'DSE', '2019-06-22 12:21:49', '2019-06-22 06:51:49'),
(52, 'rinku@gmail.com', 'Staff', 'Admission Cancellation', 'DSE', '2019-06-22 12:26:14', '2019-06-22 06:56:14'),
(53, 'rinku@gmail.com', 'Staff', 'Admit', 'DSE', '2019-06-22 12:40:35', '2019-06-22 07:10:35'),
(54, 'rinku@gmail.com', 'Staff', 'Document Verifier', 'MCA', '2019-06-22 03:34:20', '2019-06-22 10:04:20'),
(55, 'rinku@gmail.com', 'Staff', 'Document Collector', 'MCA', '2019-06-22 04:04:20', '2019-06-22 10:34:20'),
(56, 'rinku@gmail.com', 'Staff', 'Admit', 'MCA', '2019-06-22 04:24:54', '2019-06-22 10:54:54'),
(57, 'rinku@gmail.com', 'Staff', 'Admission Cancellation', 'MCA', '2019-06-22 05:31:46', '2019-06-22 12:01:46'),
(58, 'rinku@gmail.com', 'Staff', 'Admission Seizer', 'MCA', '2019-06-22 05:32:22', '2019-06-22 12:02:22'),
(59, 'rinku@gmail.com', 'Staff', 'Document Verifier', 'ME', '2019-06-22 05:33:16', '2019-06-22 12:03:16'),
(60, 'rinku@gmail.com', 'Staff', 'Document Verifier', 'MEG', '2019-06-22 05:40:33', '2019-06-22 12:10:33'),
(61, 'rinku@gmail.com', 'Staff', 'Document Verifier', 'MEG', '2019-06-24 10:35:00', '2019-06-24 05:05:00'),
(62, 'rinku@gmail.com', 'Staff', 'Document Collector', 'MEG', '2019-06-24 11:07:15', '2019-06-24 05:37:15'),
(63, 'hema@ves.ac.in', 'Staff', 'Admission Seizer', 'MCA', '2019-07-09 03:56:52', '2019-07-09 10:26:52'),
(64, 'priti@ves.ac.in', 'Staff', 'Admission Seizer', 'MCA', '2019-07-09 03:57:06', '2019-07-09 10:27:06'),
(65, 'amrita@ves.ac.in', 'Staff', 'Admit', 'FEG', '2019-07-12 11:49:25', '2019-07-12 06:19:25'),
(66, 'keya@ves.ac.in', 'Staff', 'Admit', 'FEG', '2019-07-12 12:08:08', '2019-07-12 06:38:08'),
(67, 'hema@ves.ac.in', 'Staff', 'Admit', 'FEG', '2019-07-13 01:46:09', '2019-07-13 08:16:09'),
(68, 'chandrashekar@ves.ac.in', 'Staff', 'Document Collector', 'FEG', '2019-07-13 01:46:26', '2019-07-13 08:16:26'),
(69, 'chandrashekar@ves.ac.in', 'Staff', 'Admission Seizer', 'FEG', '2019-07-13 01:49:18', '2019-07-13 08:19:18'),
(70, 'chandrashekar@ves.ac.in', 'Staff', 'Document Verifier', 'FEG', '2019-07-13 01:50:30', '2019-07-13 08:20:30'),
(71, 'gauri@ves.ac.in', 'Staff', 'Document Collector', 'FEG', '2019-07-13 02:06:33', '2019-07-13 08:36:33'),
(72, 'hema@ves.ac.in', 'Staff', 'Document Verifier', 'FEG', '2019-07-13 02:06:56', '2019-07-13 08:36:56'),
(73, 'priti@ves.ac.in', 'Staff', 'Admit', 'FEG', '2019-07-13 02:35:46', '2019-07-13 09:05:46'),
(74, 'gauri@ves.ac.in', 'Staff', 'Admit', 'FEG', '2019-07-13 03:47:35', '2019-07-13 10:17:35'),
(75, 'priti@ves.ac.in', 'Staff', 'Document Verifier', 'FEG', '2019-07-14 11:23:00', '2019-07-14 05:53:00'),
(76, 'asma.parveen@ves.ac.in', 'Staff', 'Document Verifier', 'MCA', '2019-07-17 02:43:17', '2019-07-17 09:13:17'),
(77, 'shweta@ves.ac.in', 'Staff', 'Admission Seizer', 'MCA', '2019-07-17 02:44:52', '2019-07-17 09:14:52'),
(78, 'gauri@ves.ac.in', 'Staff', 'Admit', 'MCA', '2019-07-19 12:28:58', '2019-07-19 06:58:58'),
(79, 'megha@ves.ac.in', 'Staff', 'Admission Seizer', 'FEG', '2019-07-24 05:07:25', '2019-07-24 11:37:25'),
(80, 'chandrashekar@ves.ac.in', 'Staff', 'Document Verifier', 'FEG', '2019-07-26 11:16:11', '2019-07-26 05:46:11'),
(81, 'shweta@ves.ac.in', 'Staff', 'Document Verifier', 'FEG', '2019-07-26 11:16:18', '2019-07-26 05:46:18'),
(82, 'ajinkya@ves.ac.in', 'Staff', 'Document Collector', 'FEG', '2019-07-26 11:16:38', '2019-07-26 05:46:38'),
(83, 'gauri@ves.ac.in', 'Staff', 'Admit', 'FEG', '2019-07-26 11:16:54', '2019-07-26 05:46:54'),
(84, 'hema@ves.ac.in', 'Staff', 'Admission Seizer', 'MCA', '2019-08-08 03:50:35', '2019-08-08 10:20:35'),
(85, 'shweta@ves.ac.in', 'Staff', 'Admission Seizer', 'DSE', '2019-08-16 03:20:37', '2019-08-16 09:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `status_details`
--

CREATE TABLE `status_details` (
  `status_id` int(6) NOT NULL COMMENT 'Table Master Id',
  `dte_id` varchar(12) NOT NULL COMMENT 'Dte id of student',
  `event_from` varchar(15) DEFAULT NULL COMMENT 'Possible values: ACAP/DTE/Unknown',
  `status_from` varchar(30) DEFAULT NULL COMMENT 'Possible Values : Registered / Initiated / Submitted / Admitted / Cancelled / Seized / Start',
  `event_to` varchar(15) DEFAULT NULL COMMENT 'Possible Values : ACAP / DTE / Unknown',
  `status_to` varchar(30) DEFAULT NULL COMMENT 'Possible Values : Registered / Initiated / Submitted / Admitted / Cancelled / Seized',
  `course` varchar(3) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT 'timestamp',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_details`
--

INSERT INTO `status_details` (`status_id`, `dte_id`, `event_from`, `status_from`, `event_to`, `status_to`, `course`, `created_at`, `updated_at`) VALUES
(9771, 'EN19291099', NULL, NULL, 'DTE', 'INITIATED', 'FEG', '2019-12-19 18:46:07', '2019-12-19 13:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `student_login`
--

CREATE TABLE `student_login` (
  `st_master_id` int(6) NOT NULL,
  `dte_id` varchar(12) NOT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `stud_pwd` varchar(100) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `mobile` bigint(12) DEFAULT NULL,
  `mobile_verified` tinyint(1) DEFAULT '0',
  `mobile_otp` int(6) DEFAULT NULL,
  `mobile_otp_timestamp` datetime NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT '0',
  `email_otp` int(6) DEFAULT NULL,
  `email_otp_timestamp` datetime NOT NULL,
  `course` varchar(3) NOT NULL,
  `dte_login` tinyint(1) NOT NULL DEFAULT '0',
  `acap_login` tinyint(1) NOT NULL DEFAULT '0',
  `account_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_login`
--

INSERT INTO `student_login` (`st_master_id`, `dte_id`, `hash`, `stud_pwd`, `first_name`, `middle_name`, `last_name`, `mobile`, `mobile_verified`, `mobile_otp`, `mobile_otp_timestamp`, `email`, `email_verified`, `email_otp`, `email_otp_timestamp`, `course`, `dte_login`, `acap_login`, `account_status`, `created_at`, `updated_at`) VALUES
(1891, 'EN19291099', 'hYSR5zoge6gLvoV4GuCG2YnUKoavj6', '$2y$10$T0BzbN/VyZbgYfQAj7ucf.oZ53mm7ttEZKkAIjNkHFe0CsdRfvqBO', 'Kunal', 'Sunil', 'Bathija', 9503541236, 1, 1234, '0000-00-00 00:00:00', NULL, 1, NULL, '0000-00-00 00:00:00', 'FEG', 0, 0, 0, '2019-12-19 18:42:55', '2019-12-19 13:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `id` int(11) NOT NULL,
  `category` varchar(20) DEFAULT NULL,
  `cmpn1_vac` int(11) NOT NULL,
  `cmpn2_vac` int(11) NOT NULL,
  `it_vac` int(11) NOT NULL,
  `extc_vac` int(11) NOT NULL,
  `etrx_vac` int(11) NOT NULL,
  `inst_vac` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`id`, `category`, `cmpn1_vac`, `cmpn2_vac`, `it_vac`, `extc_vac`, `etrx_vac`, `inst_vac`) VALUES
(1, 'Open', 0, 0, 0, 2, 42, 19),
(2, 'Sindhi', 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`admission_id`),
  ADD KEY `fk_dte_id_admission` (`dte_id`);

--
-- Indexes for table `dd_details`
--
ALTER TABLE `dd_details`
  ADD PRIMARY KEY (`dd_id`);

--
-- Indexes for table `dse_students`
--
ALTER TABLE `dse_students`
  ADD PRIMARY KEY (`dse_master_id`),
  ADD UNIQUE KEY `dte_id` (`dte_id`);

--
-- Indexes for table `dte_allotments`
--
ALTER TABLE `dte_allotments`
  ADD PRIMARY KEY (`da_master_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `fees_structure`
--
ALTER TABLE `fees_structure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_transaction`
--
ALTER TABLE `fees_transaction`
  ADD PRIMARY KEY (`master_trans_id`),
  ADD KEY `fk_dte_id_fees_transaction` (`dte_id`),
  ADD KEY `fk_admission_id_fees_transaction` (`admission_id`);

--
-- Indexes for table `fe_students`
--
ALTER TABLE `fe_students`
  ADD PRIMARY KEY (`fe_master_id`),
  ADD UNIQUE KEY `dte_id` (`dte_id`);

--
-- Indexes for table `important_notice`
--
ALTER TABLE `important_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latest_news`
--
ALTER TABLE `latest_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mca_students`
--
ALTER TABLE `mca_students`
  ADD PRIMARY KEY (`mca_master_id`),
  ADD KEY `fk_dte_id_mca_students` (`dte_id`);

--
-- Indexes for table `me_students`
--
ALTER TABLE `me_students`
  ADD PRIMARY KEY (`me_master_id`),
  ADD KEY `fk_dte_id_me_students` (`dte_id`);

--
-- Indexes for table `part_payment`
--
ALTER TABLE `part_payment`
  ADD PRIMARY KEY (`part_payment_id`);

--
-- Indexes for table `staff_role_history`
--
ALTER TABLE `staff_role_history`
  ADD PRIMARY KEY (`staff_role_id`);

--
-- Indexes for table `status_details`
--
ALTER TABLE `status_details`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `fk_dte_id_status_details` (`dte_id`);

--
-- Indexes for table `student_login`
--
ALTER TABLE `student_login`
  ADD PRIMARY KEY (`dte_id`),
  ADD KEY `st_master_id` (`st_master_id`);

--
-- Indexes for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `admission`
--
ALTER TABLE `admission`
  MODIFY `admission_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2189;

--
-- AUTO_INCREMENT for table `dd_details`
--
ALTER TABLE `dd_details`
  MODIFY `dd_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=701;

--
-- AUTO_INCREMENT for table `dse_students`
--
ALTER TABLE `dse_students`
  MODIFY `dse_master_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `dte_allotments`
--
ALTER TABLE `dte_allotments`
  MODIFY `da_master_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2686;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `fees_structure`
--
ALTER TABLE `fees_structure`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `fees_transaction`
--
ALTER TABLE `fees_transaction`
  MODIFY `master_trans_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5396;

--
-- AUTO_INCREMENT for table `fe_students`
--
ALTER TABLE `fe_students`
  MODIFY `fe_master_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1017;

--
-- AUTO_INCREMENT for table `important_notice`
--
ALTER TABLE `important_notice`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `latest_news`
--
ALTER TABLE `latest_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `mca_students`
--
ALTER TABLE `mca_students`
  MODIFY `mca_master_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `me_students`
--
ALTER TABLE `me_students`
  MODIFY `me_master_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `part_payment`
--
ALTER TABLE `part_payment`
  MODIFY `part_payment_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_role_history`
--
ALTER TABLE `staff_role_history`
  MODIFY `staff_role_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `status_details`
--
ALTER TABLE `status_details`
  MODIFY `status_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'Table Master Id', AUTO_INCREMENT=9772;

--
-- AUTO_INCREMENT for table `student_login`
--
ALTER TABLE `student_login`
  MODIFY `st_master_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1892;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admission`
--
ALTER TABLE `admission`
  ADD CONSTRAINT `fk_dte_id_admission` FOREIGN KEY (`dte_id`) REFERENCES `student_login` (`dte_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
