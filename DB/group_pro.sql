/*
Navicat MySQL Data Transfer

Source Server         : LOCALHOST
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : group_pro

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-04-15 22:25:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for main_access
-- ----------------------------
DROP TABLE IF EXISTS `main_access`;
CREATE TABLE `main_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `std_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `satatus` int(11) NOT NULL DEFAULT '0',
  `dateTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of main_access
-- ----------------------------
INSERT INTO `main_access` VALUES ('1', '1', 'dulanjan', '123', '1', '2020-03-04 12:46:54');
INSERT INTO `main_access` VALUES ('2', '2', 'madu', '123', '1', '2020-03-04 12:47:36');
INSERT INTO `main_access` VALUES ('3', '3', 'sil', '312', '0', '2020-03-04 12:47:49');

-- ----------------------------
-- Table structure for sms_batch_registration
-- ----------------------------
DROP TABLE IF EXISTS `sms_batch_registration`;
CREATE TABLE `sms_batch_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` int(11) DEFAULT NULL,
  `batch_name` varchar(255) DEFAULT NULL,
  `batch_start_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `batch_remarks` varchar(255) DEFAULT NULL,
  `batch_enter_by` int(11) DEFAULT NULL,
  `batch_enter_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `batch_update_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `batch_status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sms_batch_registration
-- ----------------------------

-- ----------------------------
-- Table structure for sms_student_registration
-- ----------------------------
DROP TABLE IF EXISTS `sms_student_registration`;
CREATE TABLE `sms_student_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `s_name_with_initial` varchar(255) NOT NULL,
  `s_full_name` varchar(255) DEFAULT NULL,
  `s_call_name` varchar(255) DEFAULT NULL,
  `s_nic` varchar(15) DEFAULT NULL,
  `s_dob` date DEFAULT NULL,
  `s_nationality` int(11) DEFAULT NULL,
  `s_profile_image` varchar(255) DEFAULT NULL,
  `s_marital_status` int(11) DEFAULT NULL,
  `s_gender` int(11) DEFAULT NULL,
  `s_addres_line_1` varchar(255) DEFAULT NULL,
  `s_addres_line_2` varchar(255) DEFAULT NULL,
  `s_addres_city` varchar(255) DEFAULT NULL,
  `s_addres_electorate` varchar(255) DEFAULT NULL,
  `s_addres_district` varchar(255) DEFAULT NULL,
  `s_addres_province` varchar(255) DEFAULT NULL,
  `s_addres_country` varchar(255) DEFAULT NULL,
  `s_land_pnone_number` int(11) DEFAULT NULL,
  `s_personal_pnone_number` int(11) DEFAULT NULL,
  `s_office_pnone_number` int(11) DEFAULT NULL,
  `s_office_email` varchar(255) DEFAULT NULL,
  `s_personal_mail` varchar(255) DEFAULT NULL,
  `s_active_status` varchar(255) DEFAULT NULL,
  `s_suspend_status` varchar(255) DEFAULT NULL,
  `s_enter_by` int(11) DEFAULT NULL,
  `s_enter_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `s_update_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sms_student_registration
-- ----------------------------

-- ----------------------------
-- Table structure for sms_tutor_registration
-- ----------------------------
DROP TABLE IF EXISTS `sms_tutor_registration`;
CREATE TABLE `sms_tutor_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tutor_id` int(11) NOT NULL,
  `t_name_with_initial` varchar(255) DEFAULT NULL,
  `t_full_name` varchar(255) DEFAULT NULL,
  `t_call_name` varchar(255) DEFAULT NULL,
  `t_nic` varchar(15) DEFAULT NULL,
  `t_dob` date DEFAULT NULL,
  `t_nationality` int(11) DEFAULT NULL,
  `t_profile_image` varchar(255) DEFAULT NULL,
  `t_marital_status` int(11) DEFAULT '0',
  `t_gender` int(11) DEFAULT NULL,
  `t_active_status` int(11) NOT NULL DEFAULT '0',
  `t_suspend_status` int(11) DEFAULT '0',
  `enter_by` int(11) DEFAULT NULL,
  `enter_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sms_tutor_registration
-- ----------------------------

-- ----------------------------
-- Table structure for student_assign_to_batch
-- ----------------------------
DROP TABLE IF EXISTS `student_assign_to_batch`;
CREATE TABLE `student_assign_to_batch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `b_student_reg_id` int(11) DEFAULT NULL,
  `b_batch_id` int(11) DEFAULT NULL,
  `b_available_from_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `b_ends_to_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `b_remarks` varchar(255) DEFAULT NULL,
  `b_status` int(11) DEFAULT '0',
  `b_assigned_by` int(11) DEFAULT NULL,
  `b_enter_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `b_updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of student_assign_to_batch
-- ----------------------------
