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
CONNECTION 'host=containers-us-west-210.railway.app port=7982 user=postgres password=bxqHUWVDmGkKOwQyzfzP dbname=railway'
PUBLICATION uio_publication;

--ALTER SUBSCRIPTION gdb_subscription RENAME TO gye_subscription;
--ALTER SUBSCRIPTION gdb_subscription SET PUBLICATION uio_publication;

-- CUEN
CREATE SUBSCRIPTION cuen_subscription
CONNECTION 'host=containers-us-west-210.railway.app port=7982 user=postgres password=bxqHUWVDmGkKOwQyzfzP dbname=railway'
PUBLICATION uio_publication;

--ALTER SUBSCRIPTION cuen_subscription SET PUBLICATION uio_publication;

