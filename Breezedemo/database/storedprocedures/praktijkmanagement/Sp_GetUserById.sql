USE Breezedemo;

DROP PROCEDURE IF EXISTS `Sp_GetUserById`;
DELIMITER $$
CREATE PROCEDURE `Sp_GetUserById`(
    IN userId INT
)
BEGIN
    SELECT id, name, email, role
    FROM users
    WHERE id = userId;
END$$
DELIMITER ;
