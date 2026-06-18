USE Breezedemo;

DROP PROCEDURE IF EXISTS `Sp_DeleteUser`;
DELIMITER $$
CREATE PROCEDURE `Sp_DeleteUser`(
    IN userId INT
)
BEGIN
    DELETE FROM users
    WHERE id = userId;
END$$
DELIMITER ;
