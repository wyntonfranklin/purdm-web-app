CREATE TABLE `wfexpenses`.`settings` (
                                         `id` INT NOT NULL AUTO_INCREMENT,
                                         `setting_name` VARCHAR(45) NULL,
                                         `user_id` INT NULL DEFAULT NULL,
                                         `setting_value` VARCHAR(45) NULL,
                                         PRIMARY KEY (`id`));
