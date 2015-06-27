/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50534
 Source Host           : localhost
 Source Database       : cocoshealth

 Target Server Type    : MySQL
 Target Server Version : 50534
 File Encoding         : utf-8

 Date: 06/14/2015 20:25:32 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `admins`
-- ----------------------------
BEGIN;
INSERT INTO `admins` VALUES ('1', 'admin', 'nimda', '2015-03-03 03:33:14');
COMMIT;

