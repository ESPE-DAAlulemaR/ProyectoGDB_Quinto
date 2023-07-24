CREATE ROLE Aplication;
GRANT SELECT, INSERT, DELETE, UPDATE ON gdb_proyecto.* TO Aplication;
CREATE ROLE Reportes;
GRANT SELECT ON gdb_proyecto.* TO Reportes;

CREATE USER 'app_g6'@'localhost' IDENTIFIED BY 'quinto_gdb';
GRANT Aplication TO 'app_g6'@'localhost';

CREATE USER 'reportes_g6'@'localhost' IDENTIFIED BY 'quinto_gdb';
GRANT Reportes TO 'reportes_g6'@'localhost';

CREATE USER 'seleccion_gdb'@'localhost' IDENTIFIED BY 'quinto_gdb';
GRANT SELECT ON gdb_proyecto.* TO 'seleccion_gdb'@'localhost';

CREATE USER 'grupo6'@'localhost' IDENTIFIED BY 'quinto_gdb';
GRANT ALL PRIVILEGES ON gdb_proyecto.* TO 'grupo6'@'localhost';

FLUSH PRIVILEGES;

-- Activacion de eventos
SHOW VARIABLES LIKE 'event_scheduler';
SET GLOBAL event_scheduler = ON;

-- Respaldo diferencial diario a las 2:00AM
DELIMITER //
CREATE EVENT respaldo_diferencial_diario
ON SCHEDULE EVERY 1 DAY
STARTS CONCAT(CURDATE(), ' 02:00:00')
DO
BEGIN
    DECLARE fecha VARCHAR(20);
    SET fecha = DATE_FORMAT(NOW(), '%Y-%m-%d_%H-%i-%s');
    SET @sqlstmt = CONCAT('mysqldump -u grupo6 -pquinto_gdb gdb_proyecto --single-transaction --skip-lock-tables > /home/dannyel/Documentos/GDB/Proyecto/backup_', fecha, '.sql');
    PREPARE stmt FROM @sqlstmt;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END;
//
DELIMITER ;

--  Respaldo completo mensual a las 0:00AM
DELIMITER //
CREATE EVENT respaldo_completo_fin_de_mes
ON SCHEDULE
    EVERY 1 MONTH
    STARTS CONCAT(LAST_DAY(CURDATE()), ' 00:00:00')
ON COMPLETION PRESERVE
DO
BEGIN
    DECLARE fecha VARCHAR(20);
    SET fecha = DATE_FORMAT(NOW(), '%Y-%m-%d_%H-%i-%s');
    SET @sqlstmt = CONCAT('mysqldump -u grupo6 -pquinto_gdb gdb_proyecto > /home/dannyel/Documentos/GDB/Proyecto/backup_completo_', fecha, '.sql');
    PREPARE stmt FROM @sqlstmt;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END;
//
DELIMITER ;

SHOW EVENTS;
