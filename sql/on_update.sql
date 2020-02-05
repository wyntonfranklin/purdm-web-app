# Updates to database will be placed here.
ALTER TABLE `users`
ADD COLUMN `userType` INT NULL DEFAULT NULL AFTER `createdAt`;
