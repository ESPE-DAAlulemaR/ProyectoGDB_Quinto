SET FOREIGN_KEY_CHECKS=0
;

DROP TABLE IF EXISTS `caregivers` CASCADE
;

DROP TABLE IF EXISTS `guides` CASCADE
;

DROP TABLE IF EXISTS `habitats` CASCADE
;

DROP TABLE IF EXISTS `itineraries` CASCADE
;

DROP TABLE IF EXISTS `species` CASCADE
;

DROP TABLE IF EXISTS `zones` CASCADE
;

CREATE TABLE `caregivers`
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	`address` VARCHAR(50) NOT NULL,
	`phone` VARCHAR(50) NOT NULL,
	`start_date` DATE NOT NULL,
	CONSTRAINT `PK_caregivers` PRIMARY KEY (`id` ASC)
)
;

CREATE TABLE `guides`
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	`address` VARCHAR(50) NOT NULL,
	`phone` VARCHAR(50) NOT NULL,
	`email` VARCHAR(50) NOT NULL,
	`start_date` DATE NOT NULL,
	CONSTRAINT `PK_guides` PRIMARY KEY (`id` ASC)
)
;

CREATE TABLE `habitats`
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	`climate` VARCHAR(50) NOT NULL,
	`vegetation` VARCHAR(50) NOT NULL,
	`contient` VARCHAR(50) NOT NULL,
	CONSTRAINT `PK_habitats` PRIMARY KEY (`id` ASC)
)
;

CREATE TABLE `itineraries`
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`guide_id` INT NOT NULL,
	`zone_id` INT NOT NULL,
	`duration` VARCHAR(50) NOT NULL,
	`max_visitors` INT NOT NULL,
	`start_time` TIME NOT NULL,
	CONSTRAINT `PK_itineraries` PRIMARY KEY (`id` ASC)
)
;

CREATE TABLE `species`
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`caregiver_id` INT NOT NULL,
	`habitat_id` INT NOT NULL,
	`zone_id` INT NOT NULL,
	`name` VARCHAR(50) NOT NULL,
	`scientific_name` VARCHAR(50) NOT NULL,
	`gender` VARCHAR(50) NOT NULL,
	CONSTRAINT `PK_species` PRIMARY KEY (`id` ASC)
)
;

CREATE TABLE `zones`
(
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	`extension` VARCHAR(50) NOT NULL,
	CONSTRAINT `PK_zones` PRIMARY KEY (`id` ASC)
)
;

ALTER TABLE `itineraries`
 ADD INDEX `IXFK_itineraries_guides` (`guide_id` ASC)
;

ALTER TABLE `itineraries`
 ADD INDEX `IXFK_itineraries_zones` (`zone_id` ASC)
;

ALTER TABLE `species`
 ADD INDEX `IXFK_species_caregivers` (`caregiver_id` ASC)
;

ALTER TABLE `species`
 ADD INDEX `IXFK_species_habitats` (`habitat_id` ASC)
;

ALTER TABLE `species`
 ADD INDEX `IXFK_species_zones` (`zone_id` ASC)
;

ALTER TABLE `itineraries`
 ADD CONSTRAINT `FK_itineraries_guides`
	FOREIGN KEY (`guide_id`) REFERENCES `guides` (`id`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `itineraries`
 ADD CONSTRAINT `FK_itineraries_zones`
	FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `species`
 ADD CONSTRAINT `FK_species_caregivers`
	FOREIGN KEY (`caregiver_id`) REFERENCES `caregivers` (`id`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `species`
 ADD CONSTRAINT `FK_species_habitats`
	FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `species`
 ADD CONSTRAINT `FK_species_zones`
	FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`) ON DELETE Restrict ON UPDATE Restrict
;

SET FOREIGN_KEY_CHECKS=1
;

DROP VIEW IF EXISTS vw_species;
CREATE VIEW vw_species AS
    SELECT s.id, c.name AS caregiver, h.name AS habitat, z.name AS zone, s.name, s.scientific_name, s.gender
        FROM species s
            JOIN caregivers c ON s.caregiver_id = c.id
            JOIN habitats h ON s.habitat_id = h.id
            JOIN zones z ON s.zone_id = z.id;

DROP VIEW IF EXISTS vw_itineraries;
CREATE VIEW vw_itineraries AS
    SELECT i.id, g.name AS guide, z.name AS zone, i.duration, i.max_visitors, i.start_time
        FROM itineraries i
            JOIN guides g ON i.guide_id = g.id
            JOIN zones z ON i.zone_id = z.id;
