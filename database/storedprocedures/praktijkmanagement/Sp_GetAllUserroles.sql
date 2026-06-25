USE Breezedemo;

DROP PROCEDURE IF EXISTS `SP_GetAllUserroles`;
DELIMITER $$
CREATE PROCEDURE `SP_GetAllUserroles`()
BEGIN
    SELECT id, name, email, role
    FROM users
    ORDER BY name;
END$$
DELIMITER ;
