CREATE TABLE `movienames` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) NOT NULL,
	`add_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`counting` INT(10) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2;

INSERT INTO `movienames` (`id`, `title`, `add_date`, `counting`) VALUES (1, 'Counter row', NOW(), 1);
