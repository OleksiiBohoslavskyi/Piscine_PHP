CREATE TABLE ft_table (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`login` varchar(8) DEFAULT 'toto' NOT NULL,
	`group` ENUM('staff','student','other') NOT NULL,
	`creation_date` DATE NOT NULL
);
