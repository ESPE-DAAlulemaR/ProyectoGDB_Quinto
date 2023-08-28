DROP SEQUENCE IF EXISTS caregivers_id_seq
;

DROP SEQUENCE IF EXISTS guides_id_seq
;

DROP SEQUENCE IF EXISTS habitats_id_seq
;

DROP SEQUENCE IF EXISTS itineraries_id_seq
;

DROP SEQUENCE IF EXISTS species_id_seq
;

DROP SEQUENCE IF EXISTS species_zone_id_seq
;

DROP SEQUENCE IF EXISTS zones_id_seq
;

DROP SEQUENCE IF EXISTS zoos_id_seq
;

DROP TABLE IF EXISTS caregivers CASCADE
;

DROP TABLE IF EXISTS guides CASCADE
;

DROP TABLE IF EXISTS habitats CASCADE
;

DROP TABLE IF EXISTS itineraries CASCADE
;

DROP TABLE IF EXISTS species CASCADE
;

DROP TABLE IF EXISTS zones CASCADE
;

DROP TABLE IF EXISTS zoos CASCADE
;

CREATE TABLE caregivers
(
	id integer NOT NULL   DEFAULT NEXTVAL(('"caregivers_id_seq"'::text)::regclass),
	zoo_id integer NOT NULL,
	name varchar(50) NOT NULL,
	address varchar(50) NOT NULL,
	phone varchar(50) NOT NULL,
	start_date date NOT NULL
)
;

CREATE TABLE guides
(
	id integer NOT NULL   DEFAULT NEXTVAL(('"guides_id_seq"'::text)::regclass),
	zoo_id integer NOT NULL,
	name varchar(50) NOT NULL,
	address varchar(50) NOT NULL,
	phone varchar(50) NOT NULL,
	email varchar(50) NOT NULL,
	start_date date NOT NULL
)
;

CREATE TABLE habitats
(
	id integer NOT NULL   DEFAULT NEXTVAL(('"habitats_id_seq"'::text)::regclass),
	zoo_id integer NOT NULL,
	name varchar(50) NOT NULL,
	climate varchar(50) NOT NULL,
	vegetation varchar(50) NOT NULL,
	continent varchar(50) NOT NULL
)
;

CREATE TABLE itineraries
(
	id integer NOT NULL   DEFAULT NEXTVAL(('"itineraries_id_seq"'::text)::regclass),
	guide_id integer NOT NULL,
	zone_id integer NOT NULL,
	zoo_id integer NOT NULL,
	duration varchar(50) NOT NULL,
	max_visitors integer NOT NULL,
	start_time time without time zone NOT NULL
)
;

CREATE TABLE species
(
	id integer NOT NULL   DEFAULT NEXTVAL(('"species_id_seq"'::text)::regclass),
	caregiver_id integer NOT NULL,
	habitat_id integer NOT NULL,
	zone_id integer NOT NULL   DEFAULT NEXTVAL(('"species_zone_id_seq"'::text)::regclass),
	zoo_id integer NOT NULL,
	name varchar(50) NOT NULL,
	scientific_name varchar(50) NOT NULL,
	gender varchar(50) NOT NULL
)
;

CREATE TABLE zones
(
	id integer NOT NULL   DEFAULT NEXTVAL(('"zones_id_seq"'::text)::regclass),
	zoo_id integer NULL,
	name varchar(50) NOT NULL,
	extension varchar(50) NOT NULL
)
;

CREATE TABLE zoos
(
	id integer NOT NULL   DEFAULT NEXTVAL(('"zoos_id_seq"'::text)::regclass),
	name varchar(30) NULL,
	code varchar(5) NULL,
	numeric_code integer NULL,
	master boolean NULL
)
;

CREATE SEQUENCE caregivers_id_seq INCREMENT 1 START 1
;

CREATE SEQUENCE guides_id_seq INCREMENT 1 START 1
;

CREATE SEQUENCE habitats_id_seq INCREMENT 1 START 1
;

CREATE SEQUENCE itineraries_id_seq INCREMENT 1 START 1
;

CREATE SEQUENCE species_id_seq INCREMENT 1 START 1
;

CREATE SEQUENCE species_zone_id_seq INCREMENT 1 START 1
;

CREATE SEQUENCE zones_id_seq INCREMENT 1 START 1
;

CREATE SEQUENCE zoos_id_seq INCREMENT 1 START 1
;

ALTER TABLE caregivers ADD CONSTRAINT PK_caregivers
	PRIMARY KEY (id)
;

ALTER TABLE guides ADD CONSTRAINT PK_guides
	PRIMARY KEY (id)
;

ALTER TABLE habitats ADD CONSTRAINT PK_habitats
	PRIMARY KEY (id)
;

ALTER TABLE itineraries ADD CONSTRAINT PK_itineraries
	PRIMARY KEY (id)
;

ALTER TABLE species ADD CONSTRAINT PK_species
	PRIMARY KEY (id)
;

ALTER TABLE zones ADD CONSTRAINT PK_zones
	PRIMARY KEY (id)
;

ALTER TABLE zoos ADD CONSTRAINT PK_zoos
	PRIMARY KEY (id)
;

CREATE INDEX IXFK_caregivers_zoos ON caregivers (zoo_id ASC)
;

CREATE INDEX IXFK_guides_zoos ON guides (zoo_id ASC)
;

CREATE INDEX IXFK_habitats_zoos ON habitats (zoo_id ASC)
;

CREATE INDEX IXFK_itineraries_guides ON itineraries (guide_id ASC)
;

CREATE INDEX IXFK_itineraries_zones ON itineraries (zone_id ASC)
;

CREATE INDEX IXFK_itineraries_zoos ON itineraries (zoo_id ASC)
;

CREATE INDEX IXFK_species_caregivers ON species (caregiver_id ASC)
;

CREATE INDEX IXFK_species_habitats ON species (habitat_id ASC)
;

CREATE INDEX IXFK_species_zones ON species (zone_id ASC)
;

CREATE INDEX IXFK_species_zoos ON species (zoo_id ASC)
;

CREATE INDEX IXFK_zones_zoos ON zones (zoo_id ASC)
;

CREATE INDEX IX_zoo_code ON zoos (code ASC)
;

ALTER TABLE caregivers ADD CONSTRAINT FK_caregivers_zoos
	FOREIGN KEY (zoo_id) REFERENCES zoos (id) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE guides ADD CONSTRAINT FK_guides_zoos
	FOREIGN KEY (zoo_id) REFERENCES zoos (id) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE habitats ADD CONSTRAINT FK_habitats_zoos
	FOREIGN KEY (zoo_id) REFERENCES zoos (id) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE itineraries ADD CONSTRAINT FK_itineraries_guides
	FOREIGN KEY (guide_id) REFERENCES guides (id) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE itineraries ADD CONSTRAINT FK_itineraries_zones
	FOREIGN KEY (zone_id) REFERENCES zones (id) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE itineraries ADD CONSTRAINT FK_itineraries_zoos
	FOREIGN KEY (zoo_id) REFERENCES zoos (id) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE species ADD CONSTRAINT FK_species_caregivers
	FOREIGN KEY (caregiver_id) REFERENCES caregivers (id) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE species ADD CONSTRAINT FK_species_habitats
	FOREIGN KEY (habitat_id) REFERENCES habitats (id) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE species ADD CONSTRAINT FK_species_zones
	FOREIGN KEY (zone_id) REFERENCES zones (id) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE species ADD CONSTRAINT FK_species_zoos
	FOREIGN KEY (zoo_id) REFERENCES zoos (id) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE zones ADD CONSTRAINT FK_zones_zoos
	FOREIGN KEY (zoo_id) REFERENCES zoos (id) ON DELETE No Action ON UPDATE No Action
;

-- Partición Horizontal (Tabla itineraries por zoo_id):
DROP TABLE IF EXISTS itineraries_partitions_1;
DROP TABLE IF EXISTS itineraries_partitions_2;
DROP TABLE IF EXISTS itineraries_partitions_3;

CREATE TABLE itineraries_partitions_1 (LIKE itineraries);
CREATE TABLE itineraries_partitions_2 (LIKE itineraries);
CREATE TABLE itineraries_partitions_3 (LIKE itineraries);

ALTER TABLE itineraries_partitions_1 ADD CONSTRAINT itineraries_partitions_1_check CHECK (zoo_id = 1);
ALTER TABLE itineraries_partitions_2 ADD CONSTRAINT itineraries_partitions_2_check CHECK (zoo_id = 2);
ALTER TABLE itineraries_partitions_3 ADD CONSTRAINT itineraries_partitions_3_check CHECK (zoo_id = 3);

DROP RULE IF EXISTS itineraries_insert_1 ON itineraries;
DROP RULE IF EXISTS itineraries_insert_2 ON itineraries;
DROP RULE IF EXISTS itineraries_insert_3 ON itineraries;

CREATE RULE itineraries_insert_1 AS
    ON INSERT TO itineraries WHERE (zoo_id = 1)
    DO INSTEAD INSERT INTO itineraries_partitions_1 VALUES (NEW.*);

CREATE RULE itineraries_insert_2 AS
    ON INSERT TO itineraries WHERE (zoo_id = 2)
    DO INSTEAD INSERT INTO itineraries_partitions_2 VALUES (NEW.*);

CREATE RULE itineraries_insert_3 AS
    ON INSERT TO itineraries WHERE (zoo_id = 3)
    DO INSTEAD INSERT INTO itineraries_partitions_3 VALUES (NEW.*);

-- Crear función del trigger
DROP FUNCTION IF EXISTS itineraries_insert_trigger;
CREATE OR REPLACE FUNCTION itineraries_insert_trigger()
RETURNS TRIGGER AS $$
BEGIN
    IF (NEW.zoo_id = 1) THEN
        INSERT INTO itineraries_partitions_1 VALUES (NEW.*);
    ELSIF (NEW.zoo_id = 2) THEN
        INSERT INTO itineraries_partitions_2 VALUES (NEW.*);
    ELSIF (NEW.zoo_id = 3) THEN
        INSERT INTO itineraries_partitions_3 VALUES (NEW.*);
    ELSE
        RAISE EXCEPTION 'Zoo_id no válido';
    END IF;
    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS itineraries_insert ON itineraries;
CREATE TRIGGER itineraries_insert
    BEFORE INSERT ON itineraries
    FOR EACH ROW
    EXECUTE FUNCTION itineraries_insert_trigger();


-- Partición Vertical (Tabla species):
DROP TABLE IF EXISTS species_additional_info CASCADE
;

CREATE TABLE species_additional_info
(
    id integer,
    caregiver_id integer,
    habitat_id integer
);

ALTER TABLE species
DROP COLUMN caregiver_id,
DROP COLUMN habitat_id
;

-- Vistas
DROP VIEW IF EXISTS vw_species;
CREATE VIEW vw_species AS
    SELECT  s.id, c.name AS caregiver, h.name AS habitat, z.name AS zone, s.name, s.scientific_name, s.gender, s.zoo_id
	FROM species s
	JOIN species_additional_info sai ON s.id = sai.id
	JOIN caregivers c ON sai.caregiver_id = c.id
	JOIN habitats h ON sai.habitat_id = h.id
    JOIN zones z ON s.zone_id = z.id;
;

DROP VIEW IF EXISTS vw_itineraries;
CREATE VIEW vw_itineraries AS
    SELECT i.id, g.name AS guide, z.name AS zone, i.duration, i.max_visitors, i.start_time, i.zoo_id
    FROM itineraries i
    JOIN guides g ON i.guide_id = g.id
    JOIN zones z ON i.zone_id = z.id
;

-- Transaccionalidad (cuidador y especie)
DROP FUNCTION IF EXISTS insert_caregiver_and_species;

CREATE OR REPLACE FUNCTION insert_caregiver_and_species(
    p_habitat_id integer,
    p_zone_id integer,
    p_zoo_id integer,
    p_name varchar(50),
    p_scientific_name varchar(50),
    p_gender varchar(50),
    p_caregiver_name varchar(50), -- Nombre del cuidador
    p_address varchar(50), -- Dirección del cuidador
    p_phone varchar(50), -- Número de teléfono del cuidador
    p_start_date date -- Fecha de inicio del cuidador
)
RETURNS TABLE (caregiver_id integer, species_id integer) AS
$$
BEGIN
    -- Declarar variables para almacenar los IDs
    DECLARE
        caregiver_id integer;
        species_id integer;
    BEGIN
        -- Insertar datos en la tabla caregivers para registrar al cuidador
        INSERT INTO caregivers (zoo_id, name, address, phone, start_date)
        VALUES (p_zoo_id, p_caregiver_name, p_address, p_phone, p_start_date)
        RETURNING id INTO caregiver_id;

        -- Insertar datos en la tabla species
        INSERT INTO species (zone_id, zoo_id, name, scientific_name, gender)
        VALUES (p_zone_id, p_zoo_id, p_name, p_scientific_name, p_gender)
        RETURNING id INTO species_id;

        -- Retornar los IDs generados
        RETURN QUERY SELECT caregiver_id, species_id;

    END;
END;
$$
LANGUAGE plpgsql;

DROP FUNCTION IF EXISTS insert_species_additional_info;
CREATE OR REPLACE FUNCTION insert_species_additional_info(
    p_species_id integer,
    p_caregiver_id integer,
    p_habitat_id integer
)
RETURNS void AS
$$
BEGIN
    -- Insertar datos en la tabla species_additional_info
    INSERT INTO species_additional_info (id, caregiver_id, habitat_id)
    VALUES (p_species_id, p_caregiver_id, p_habitat_id);
END;
$$
LANGUAGE plpgsql;

-- Transaccionalidad sobre especies
DROP FUNCTION IF EXISTS insert_species_and_info;

CREATE OR REPLACE FUNCTION insert_species_and_info(
    p_zone_id integer,
    p_zoo_id integer,
    p_name varchar(50),
    p_scientific_name varchar(50),
    p_gender varchar(50),
    p_caregiver_id integer,
    p_habitat_id integer
)
RETURNS void AS
$$
BEGIN
    DECLARE
        species_id integer;
    BEGIN
        -- Insertar datos en species
        INSERT INTO species(zone_id, zoo_id, name, scientific_name, gender)
        VALUES (p_zone_id, p_zoo_id, p_name, p_scientific_name, p_gender)
        RETURNING id INTO species_id;

        -- Insertar datos en species_additional_info
        INSERT INTO species_additional_info(id, caregiver_id, habitat_id)
        VALUES (species_id, p_caregiver_id, p_habitat_id);
    END;
END;
$$ LANGUAGE plpgsql;

DROP FUNCTION IF EXISTS update_species_and_info;

CREATE OR REPLACE FUNCTION update_species_and_info(
    p_id integer,
    p_zone_id integer,
    p_zoo_id integer,
    p_name varchar(50),
    p_scientific_name varchar(50),
    p_gender varchar(50),
    p_caregiver_id integer,
    p_habitat_id integer
)
RETURNS void AS
$$
BEGIN
    -- Actualizar datos en species
    UPDATE species
    SET zone_id = p_zone_id,
        zoo_id = p_zoo_id,
        name = p_name,
        scientific_name = p_scientific_name,
        gender = p_gender
    WHERE id = p_id;

    -- Actualizar datos en species_additional_info
    UPDATE species_additional_info
    SET caregiver_id = p_caregiver_id,
        habitat_id = p_habitat_id
    WHERE id = p_id;
END;
$$ LANGUAGE plpgsql;

DROP FUNCTION IF EXISTS delete_species_and_info;
CREATE OR REPLACE FUNCTION delete_species_and_info(p_id integer)RETURNS void AS $$
BEGIN
    -- Eliminar datos en species
    DELETE FROM species WHERE id = p_id;

    -- Eliminar datos en species_additional_info
    DELETE FROM species_additional_info WHERE id = p_id;
END;
$$ LANGUAGE plpgsql;
