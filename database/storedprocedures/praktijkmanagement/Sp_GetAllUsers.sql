CREATE PROCEDURE Sp_GetAllUsers()
BEGIN
    SELECT id, name, email, role FROM users;
END;