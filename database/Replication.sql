-- Configuracion para todos los servidor
ALTER SYSTEM SET wal_level = 'logical';
ALTER SYSTEM SET max_wal_senders = 3;
ALTER SYSTEM SET max_replication_slots = 3;
ALTER SYSTEM SET hot_standby = on;

-- Configuracion servidor principal
CREATE PUBLICATION uio_publication FOR ALL TABLES;

--ALTER PUBLICATION gdb_publication RENAME TO uio_publication;

-- Crear suscripciones en servidores esclavos

-- GYE
CREATE SUBSCRIPTION gye_subscription
CONNECTION 'host=containers-us-west-131.railway.app port=6755 user=postgres password=xV1GLoIWcb5FPMAvOD7u dbname=railway'
PUBLICATION uio_publication;

--ALTER SUBSCRIPTION gdb_subscription RENAME TO gye_subscription;
--ALTER SUBSCRIPTION gdb_subscription SET PUBLICATION uio_publication;

-- CUEN
CREATE SUBSCRIPTION cuen_subscription
CONNECTION 'host=containers-us-west-131.railway.app port=6755 user=postgres password=xV1GLoIWcb5FPMAvOD7u dbname=railway'
PUBLICATION uio_publication;

--ALTER SUBSCRIPTION cuen_subscription SET PUBLICATION uio_publication;

-- Prueba
INSERT INTO users(zoo_id, name, email, email_verified_at, password)
	VALUES (1, 'Prueba', 'prueba@zoo.com', '2023-08-27 03:07:44', '$2y$10$xwp62Xc2ivY6GGi1qWE9fuBsRTIjH0id6bNYi8Yo7jS1XDrQe6Eo.');
