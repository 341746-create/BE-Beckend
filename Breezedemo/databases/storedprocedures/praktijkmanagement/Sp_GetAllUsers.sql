USE Breezedemo;

DROP PROCEDURE IF EXISTS `Sp_GetAllUsers`;
DELIMITER $$
CREATE PROCEDURE `Sp_GetAllUsers`()
BEGIN
    SELECT id, name, email, role FROM users;
END$$
DELIMITER ;