SET NAMES utf8;
SET SQL_MODE='';

CREATE DATABASE IF NOT EXISTS `sdi` DEFAULT CHARACTER SET  utf8;

USE `sdi`;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `egn` varchar(10) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
