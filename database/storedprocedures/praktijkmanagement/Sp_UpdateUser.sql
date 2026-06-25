USE Breezedemo;

DROP PROCEDURE IF EXISTS `SP_UpdateUser`;
DELIMITER $$
CREATE PROCEDURE `SP_UpdateUser`(
    IN userId INT,
    IN newRole VARCHAR(50)
)
BEGIN
    UPDATE users
    SET role = newRole
    WHERE id = userId;
END$$
DELIMITER ;
