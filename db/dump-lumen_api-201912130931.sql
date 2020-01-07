-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2020 at 01:01 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `otograde`
--

-- --------------------------------------------------------

--
-- Table structure for table `executive_details`
--

CREATE TABLE `executive_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `executive_details`
--

INSERT INTO `executive_details` (`id`, `name`, `mobile`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'executive', '9962897972', 'yes', '2020-01-07 11:01:34', '2020-01-07 11:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(10) UNSIGNED NOT NULL,
  `report_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `inspection_type` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vehicle_category_id` int(10) UNSIGNED NOT NULL,
  `registration_status` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_type` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_number` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loan_agreement_number` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model_number` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `engine_number` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chassis_number` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_of_owners` int(10) UNSIGNED NOT NULL,
  `mfg_date` datetime DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL,
  `lead_status_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `executive_details_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `report_id`, `client_id`, `inspection_type`, `vehicle_category_id`, `registration_status`, `registration_type`, `registration_number`, `loan_agreement_number`, `model_number`, `engine_number`, `chassis_number`, `number_of_owners`, `mfg_date`, `reg_date`, `lead_status_id`, `customer_id`, `executive_details_id`, `created_at`, `updated_at`) VALUES
(1, 'HDFC4WHR1', 1, 'retail', 1, 'register', 'register', '312434234234', 'asdfawer423423423', 'dadfa', 'dasds', 'dasdasdasdasd', 2, '2017-10-03 00:00:00', '2018-10-03 00:00:00', 1, 1, 1, '2020-01-07 11:01:34', '2020-01-07 11:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `lead_clients`
--

CREATE TABLE `lead_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `short_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` int(6) UNSIGNED DEFAULT NULL,
  `status` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lead_clients`
--

INSERT INTO `lead_clients` (`id`, `short_name`, `name`, `city`, `state`, `zipcode`, `status`, `created_at`, `updated_at`) VALUES
(1, 'HDFC', 'HDFC finance limited', 'chennai', 'tamil nadu', 636303, 'yes', '2020-01-07 11:01:34', '2020-01-07 11:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `lead_customer_details`
--

CREATE TABLE `lead_customer_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` int(6) UNSIGNED DEFAULT NULL,
  `status` int(1) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lead_customer_details`
--

INSERT INTO `lead_customer_details` (`id`, `name`, `mobile`, `address1`, `address2`, `city`, `state`, `zipcode`, `status`, `created_at`, `updated_at`) VALUES
(1, 'testing name', '9494949494', 'vdfsfasdfsdfsddCZDcd', 'ssssssssssssssssss', 'chennai', 'tamil nadu', 636303, 1, '2020-01-07 11:01:34', '2020-01-07 11:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `lead_status`
--

CREATE TABLE `lead_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lead_status`
--

INSERT INTO `lead_status` (`id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'open', 1, '2020-01-07 11:01:34', '2020-01-07 11:01:34'),
(2, 'assigned', 1, '2020-01-07 11:01:34', '2020-01-07 11:01:34'),
(3, 'comfirmed', 1, '2020-01-07 11:01:34', '2020-01-07 11:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `report_images`
--

CREATE TABLE `report_images` (
  `id` int(20) UNSIGNED NOT NULL,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `report_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report_images`
--

INSERT INTO `report_images` (`id`, `lead_id`, `report_id`, `slug`, `label`, `file_name`, `file_path`, `created_at`, `updated_at`) VALUES
(7, 1, 'HDFC4WHR1', 'front_img', 'Front Image', 'screenshot.png', NULL, '2020-01-07 06:28:18', '2020-01-07 06:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_category`
--

CREATE TABLE `vehicle_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vehicle_category`
--

INSERT INTO `vehicle_category` (`id`, `category`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '2wheeler', '2 Wheeler', 'yes', '2020-01-07 11:01:34', '2020-01-07 11:01:34'),
(2, 'fe', 'Farm Equipment', 'yes', '2020-01-07 11:01:34', '2020-01-07 11:01:34'),
(3, '3wheeler', '3 Wheeler', 'yes', '2020-01-07 11:01:34', '2020-01-07 11:01:34'),
(4, 'cv', 'Commercial Vehicle', 'yes', '2020-01-07 11:01:34', '2020-01-07 11:01:34'),
(5, '4wheeler', '4 Wheeler', 'yes', '2020-01-07 11:01:34', '2020-01-07 11:01:34'),
(6, 'ce', 'Construction Equipment', 'yes', '2020-01-07 11:01:34', '2020-01-07 11:01:34');


--
-- Table structure for table `report_general_inputs`
--

CREATE TABLE `report_general_inputs` (
  `id` int(20) UNSIGNED NOT NULL,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `report_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `report_type` enum('retail','repo') COLLATE utf8_unicode_ci DEFAULT 'retail',
  `vehicle_type` enum('taxi','private') COLLATE utf8_unicode_ci DEFAULT 'private',
  `vehicle_make_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vehicle_variant_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transmission` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mfg_date` datetime DEFAULT NULL,
  `engine_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chassis_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `odometer_reading` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rc_book_status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_of_owners` int(10) UNSIGNED NOT NULL,
  `roof` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vehicle_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `engine_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `structural_damages` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fuel_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key_status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_condition` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `battery_status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `colours` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valuation_price` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ex_show_room_price` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `period` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_status`  enum('registered','not registered', 'yes', 'no') COLLATE utf8_unicode_ci DEFAULT 'yes',
  `reg_date` datetime DEFAULT NULL,
  `insurance_status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insurance_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hpa_status` enum('yes', 'no') COLLATE utf8_unicode_ci DEFAULT 'yes',
  `hpa_bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inspection_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `report_reviews_inputs`
--

CREATE TABLE `report_reviews_inputs` (
  `id` int(20) UNSIGNED NOT NULL,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `report_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `gril` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `headLight` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hood` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `front_bumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rear_bumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `left_fender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `right_fender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `right_quarter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `left_quarter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `right_front_door` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `left_front_door` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `right_rear_door` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `left_rear_door` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roof` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rear_windshield` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `front_windshield` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rear_tail_light` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body_paints` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deck_lid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_of_tires` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `front_left_wheel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `back_right_wheel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `back_left_wheel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spare_wheel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `front_left_tyres` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `front_left_tyre_units` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `front_right_tyres` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `front_right_tyre_units` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `back_right_tyres` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `back_right_tyre_units` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `back_left_tyres` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `back_left_tyre_units` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spare_tyres` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spare_tyre_units` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dashboard_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dashboard_warning_lights_and_gauges` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `front_left_seat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `front_right_seat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rear_left_seat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rear_right_seat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `3rd_row_seat_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trunk_cargo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sunroof_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `air_bag` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `carpets_and_floor_mats` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `power_windows` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ac_heater_blower_fan_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cooling_system_radiator_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `electric_cooling_fan_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `engine_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `engine_running` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `engine_oil_level` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `engine_oil_functions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transmission_gear_box_conditions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transmission_working_conditions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gear_shift_conditions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `front_suspension_conditions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rear_suspension_conditions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `steering_play` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `power_steering` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `steering` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `steering_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `electrical_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `battery_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ac_cooling_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchased_year` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `report_test_drive_inputs`
--

CREATE TABLE `report_test_drive_inputs` (
  `id` int(20) UNSIGNED NOT NULL,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `report_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `engine_start_condition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gear_shift_ratios` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clutch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stearing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accelator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `braking` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `report_parivahan_detail_inputs`
--

CREATE TABLE `report_parivahan_detail_inputs` (
  `id` int(20) UNSIGNED NOT NULL,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `report_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchase_deivery_date`  datetime DEFAULT NULL,
  `maker` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `laden_weight` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sleeper_capacity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_date`  datetime DEFAULT NULL,
  `engine_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unladen_weight` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mfg_year` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chassis_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vehicle_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fitness_valid_upto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insurance_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insurance_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insurance_to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `policy_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insurance_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_paid_date` datetime DEFAULT NULL,
  `receipt_date` datetime DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fc_issue_date` datetime DEFAULT NULL,
  `tax_clear_upto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fc_valid_upto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permit_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `route_length` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permit_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_of_trips` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permit_domain` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insurer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_claim_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `claim_intimation_date` datetime DEFAULT NULL,
  `accident_loss_date` datetime DEFAULT NULL,
  `expense_paid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `executive_details`
--
ALTER TABLE `executive_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `report_id` (`report_id`),
  ADD KEY `client_id_foreign` (`client_id`),
  ADD KEY `vehicle_category_id_foreign` (`vehicle_category_id`),
  ADD KEY `lead_status_id_foreign` (`lead_status_id`),
  ADD KEY `customer_id_foreign` (`customer_id`),
  ADD KEY `executive_details_id_foreign` (`executive_details_id`);

--
-- Indexes for table `lead_clients`
--
ALTER TABLE `lead_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_customer_details`
--
ALTER TABLE `lead_customer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_status`
--
ALTER TABLE `lead_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_images`
--
ALTER TABLE `report_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_images_lead_id_foreign` (`lead_id`);

--
-- Indexes for table `vehicle_category`
--
ALTER TABLE `vehicle_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_general_inputs`
--
ALTER TABLE `report_general_inputs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_general_inputs_lead_id_foreign` (`lead_id`);
  
--
-- Indexes for table `report_reviews_inputs`
--
ALTER TABLE `report_reviews_inputs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_reviews_inputs_lead_id_foreign` (`lead_id`);
   
--
-- Indexes for table `report_test_drive_inputs`
--
ALTER TABLE `report_test_drive_inputs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_test_drive_inputs_lead_id_foreign` (`lead_id`);
    
--
-- Indexes for table `report_parivahan_detail_inputs`
--
ALTER TABLE `report_parivahan_detail_inputs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_parivahan_detail_inputs_lead_id_foreign` (`lead_id`);
  
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `executive_details`
--
ALTER TABLE `executive_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lead_clients`
--
ALTER TABLE `lead_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lead_customer_details`
--
ALTER TABLE `lead_customer_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lead_status`
--
ALTER TABLE `lead_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `report_images`
--
ALTER TABLE `report_images`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vehicle_category`
--
ALTER TABLE `vehicle_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report_general_inputs`
--
ALTER TABLE `report_general_inputs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report_reviews_inputs`
--
ALTER TABLE `report_reviews_inputs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report_test_drive_inputs`
--
ALTER TABLE `report_test_drive_inputs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report_parivahan_detail_inputs`
--
ALTER TABLE `report_parivahan_detail_inputs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `lead_clients` (`id`),
  ADD CONSTRAINT `customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `lead_customer_details` (`id`),
  ADD CONSTRAINT `executive_details_id_foreign` FOREIGN KEY (`executive_details_id`) REFERENCES `executive_details` (`id`),
  ADD CONSTRAINT `lead_status_id_foreign` FOREIGN KEY (`lead_status_id`) REFERENCES `lead_status` (`id`),
  ADD CONSTRAINT `vehicle_category_id_foreign` FOREIGN KEY (`vehicle_category_id`) REFERENCES `vehicle_category` (`id`);

--
-- Constraints for table `report_images`
--
ALTER TABLE `report_images`
  ADD CONSTRAINT `report_images_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`);
ALTER TABLE `report_images`
  ADD CONSTRAINT `report_images_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `leads` (`report_id`);

--
-- Constraints for table `report_general_inputs`
--
ALTER TABLE `report_general_inputs`
  ADD CONSTRAINT `report_general_inputs_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`);
ALTER TABLE `report_general_inputs`
  ADD CONSTRAINT `report_general_inputs_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `leads` (`report_id`);

--
-- Constraints for table `report_reviews_inputs`
--
ALTER TABLE `report_reviews_inputs`
  ADD CONSTRAINT `report_reviews_inputs_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`);
ALTER TABLE `report_reviews_inputs`
  ADD CONSTRAINT `report_reviews_inputs_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `leads` (`report_id`);

--
-- Constraints for table `report_test_drive_inputs`
--
ALTER TABLE `report_test_drive_inputs`
  ADD CONSTRAINT `report_test_drive_inputs_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`);
ALTER TABLE `report_test_drive_inputs`
  ADD CONSTRAINT `report_test_drive_inputs_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `leads` (`report_id`);

--
-- Constraints for table `report_parivahan_detail_inputs`
--
ALTER TABLE `report_parivahan_detail_inputs`
  ADD CONSTRAINT `report_parivahan_detail_inputs_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`);
ALTER TABLE `report_parivahan_detail_inputs`
  ADD CONSTRAINT `report_parivahan_detail_inputs_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `leads` (`report_id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
