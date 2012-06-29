--
-- MySQL 5.5.24
-- Sun, 17 Jun 2012 14:02:54 +0000
--

CREATE TABLE `category` (
   `id` int(11) not null auto_increment,
   `name` varchar(50),
   `parent_id` int(11),
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `category` is empty]

CREATE TABLE `contact` (
   `id` int(11) not null auto_increment,
   `name` varchar(50),
   `surname` varchar(50),
   `email` varchar(255),
   `birthday` date,
   `phone` varchar(18),
   `note` text,
   `user_id` int(11) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

INSERT INTO `contact` (`id`, `name`, `surname`, `email`, `birthday`, `phone`, `note`, `user_id`) VALUES 
('1', 'Aaa', 'Aaa', 'dasa@dsa.dsa', '2012-06-07', '32131', '231312', '1'),
('2', 'Aaaaaddsa', 'Dasdas', 'dasda@das.da', '2011-07-13', 'asdasdas', 'adadasd', '1'),
('3', 'Aadasdasda', 'Asdasdad', 'asdas@dsa.da', '2012-06-29', '', 'asdadasd', '1');

CREATE TABLE `contact_meeting` (
   `id` int(11) not null auto_increment,
   `meeting_id` int(11) not null,
   `contact_id` int(11) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

INSERT INTO `contact_meeting` (`id`, `meeting_id`, `contact_id`) VALUES 
('1', '6', '1'),
('2', '6', '2');

CREATE TABLE `meeting` (
   `id` int(11) not null auto_increment,
   `date` datetime,
   `place` varchar(200),
   `category_id` int(11),
   `note` text,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;

INSERT INTO `meeting` (`id`, `date`, `place`, `category_id`, `note`) VALUES 
('2', '2012-06-07 00:00:00', 'adasd', '', ''),
('3', '2012-06-14 00:00:00', '', '', 'sadasd'),
('4', '2012-06-14 00:00:00', '', '', 'sadasd'),
('5', '2012-06-14 00:00:00', '', '', 'sadasd'),
('6', '2012-06-14 00:00:00', '', '', 'sadasd');

CREATE TABLE `profiles` (
   `user_id` int(11) not null auto_increment,
   `lastname` varchar(50) not null,
   `firstname` varchar(50) not null,
   PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

INSERT INTO `profiles` (`user_id`, `lastname`, `firstname`) VALUES 
('1', 'Admin', 'Administrator'),
('2', 'Demo', 'Demo');

CREATE TABLE `profiles_fields` (
   `id` int(10) not null auto_increment,
   `varname` varchar(50) not null,
   `title` varchar(255) not null,
   `field_type` varchar(50) not null,
   `field_size` varchar(15) not null default '0',
   `field_size_min` varchar(15) not null default '0',
   `required` int(1) not null default '0',
   `match` varchar(255) not null,
   `range` varchar(255) not null,
   `error_message` varchar(255) not null,
   `other_validator` varchar(5000) not null,
   `default` varchar(255) not null,
   `widget` varchar(255) not null,
   `widgetparams` varchar(5000) not null,
   `position` int(3) not null default '0',
   `visible` int(1) not null default '0',
   PRIMARY KEY (`id`),
   KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

INSERT INTO `profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES 
('1', 'lastname', 'Last Name', 'VARCHAR', '50', '3', '1', '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', '1', '3'),
('2', 'firstname', 'First Name', 'VARCHAR', '50', '3', '1', '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', '0', '3');

CREATE TABLE `users` (
   `id` int(11) not null auto_increment,
   `username` varchar(20) not null,
   `password` varchar(128) not null,
   `email` varchar(128) not null,
   `activkey` varchar(128) not null,
   `create_at` timestamp not null default CURRENT_TIMESTAMP,
   `lastvisit_at` timestamp not null default '0000-00-00 00:00:00',
   `superuser` int(1) not null default '0',
   `status` int(1) not null default '0',
   PRIMARY KEY (`id`),
   UNIQUE KEY (`username`),
   UNIQUE KEY (`email`),
   KEY `status` (`status`),
   KEY `superuser` (`superuser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`) VALUES 
('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '9a24eff8c15a6a141ece27eb6947da0f', '2012-06-17 14:48:11', '2012-06-17 15:00:14', '1', '1'),
('2', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '099f825543f7850cc038b90aaff39fac', '2012-06-17 14:48:11', '0000-00-00 00:00:00', '0', '1');
