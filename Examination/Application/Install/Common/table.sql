/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-05-10 10:35:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for exa_catalogue
-- ----------------------------
DROP TABLE IF EXISTS `exa_catalogue`;
CREATE TABLE `exa_catalogue` (
  `ca_id` int(11) NOT NULL,
  `ca_title` varchar(64) NOT NULL,
  `ca_description` varchar(255) NOT NULL,
  `ca_count` int(11) NOT NULL,
  PRIMARY KEY (`ca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for exa_options
-- ----------------------------
DROP TABLE IF EXISTS `exa_options`;
CREATE TABLE `exa_options` (
  `op_id` int(11) NOT NULL,
  `option_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `option_value` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`op_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for exa_posts
-- ----------------------------
DROP TABLE IF EXISTS `exa_posts`;
CREATE TABLE `exa_posts` (
  `post_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `post_catalogue` int(11) NOT NULL,
  `post_date` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `post_modified` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `post_content` text CHARACTER SET latin1 NOT NULL,
  `post_title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `post_type` varchar(10) CHARACTER SET latin1 NOT NULL COMMENT '只能为post,page,img,media\r\n',
  `post_src` varchar(255) CHARACTER SET latin1 NOT NULL,
  `post_tags_count` int(11) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_author` (`user_id`),
  KEY `cata_id` (`post_catalogue`),
  CONSTRAINT `cata_id` FOREIGN KEY (`post_catalogue`) REFERENCES `exa_catalogue` (`ca_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `user_author` FOREIGN KEY (`user_id`) REFERENCES `exa_user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for exa_tags
-- ----------------------------
DROP TABLE IF EXISTS `exa_tags`;
CREATE TABLE `exa_tags` (
  `tag_id` int(11) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `tag_content` varchar(64) NOT NULL,
  PRIMARY KEY (`tag_id`),
  KEY `post_author` (`post_id`),
  CONSTRAINT `post_author` FOREIGN KEY (`post_id`) REFERENCES `exa_posts` (`post_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for exa_user
-- ----------------------------
DROP TABLE IF EXISTS `exa_user`;
CREATE TABLE `exa_user` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_nickname` varchar(64) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_password` varchar(64) NOT NULL,
  `user_description` varchar(255) NOT NULL,
  `user_photo` varchar(255) NOT NULL,
  `user_sex` tinyint(1) unsigned zerofill NOT NULL,
  `user_activate_key` varchar(64) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for exa_user_group
-- ----------------------------
DROP TABLE IF EXISTS `exa_user_group`;
CREATE TABLE `exa_user_group` (
  `ug_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ug_type` varchar(10) CHARACTER SET latin1 NOT NULL COMMENT '只能为root,admin,user,visitor',
  KEY `user_id` (`user_id`),
  KEY `ug_id` (`ug_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `exa_user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for exa_user_group_privileges
-- ----------------------------
DROP TABLE IF EXISTS `exa_user_group_privileges`;
CREATE TABLE `exa_user_group_privileges` (
  `ugp_id` bigint(20) NOT NULL,
  `ug_id` bigint(20) NOT NULL,
  `ugp_name` varchar(255) NOT NULL,
  PRIMARY KEY (`ugp_id`),
  KEY `ug_id` (`ug_id`),
  CONSTRAINT `ug_id` FOREIGN KEY (`ug_id`) REFERENCES `exa_user_group` (`ug_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
