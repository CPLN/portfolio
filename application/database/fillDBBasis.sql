-- Fill Script - Basis elements

-- Domains
INSERT INTO domains (id, name) VALUES (1,'Web');
INSERT INTO domains (id, name) VALUES (2,'Embedded');
INSERT INTO domains (id, name) VALUES (3,'Network');
INSERT INTO domains (id, name) VALUES (4,'Development');
INSERT INTO domains (id, name) VALUES (5,'Security');
INSERT INTO domains (id, name) VALUES (6,'Testing');
INSERT INTO domains (id, name) VALUES (7,'Support');
INSERT INTO domains (id, name) VALUES (8,'Multimedia');
INSERT INTO domains (id, name) VALUES (9,'Infrastructure');
INSERT INTO domains (id, name) VALUES (10,'Office');
INSERT INTO domains (id, name) VALUES (11,'IoT');

-- Materials
INSERT INTO materials (id, name) VALUES (1,'Raspberry Pi');
INSERT INTO materials (id, name) VALUES (2,'Beaglebone');
INSERT INTO materials (id, name) VALUES (3,'Switch 8x');
INSERT INTO materials (id, name) VALUES (4,'Router wifi');
INSERT INTO materials (id, name) VALUES (5,'NAS Synology');
INSERT INTO materials (id, name) VALUES (6,'Dongle bluetooth');
INSERT INTO materials (id, name) VALUES (7,'Plug Razberry');
INSERT INTO materials (id, name) VALUES (8,'RGBW Bulb');
INSERT INTO materials (id, name) VALUES (9,'Led rouge & résistance 270 Ohm');

-- Modules
INSERT INTO modules (id, ictCode, title ) VALUES (1,"101", "Réaliser et publier un site web");
INSERT INTO modules (id, ictCode, title ) VALUES (2,"239", "Mettre en service un serveur web");
INSERT INTO modules (id, ictCode, title ) VALUES (3,"129", "Mettre en service des composants réseaux");
INSERT INTO modules (id, ictCode, title ) VALUES (4,"226A", "Implémenter (sans hérédité) sur la base des classes");
INSERT INTO modules (id, ictCode, title ) VALUES (5,"226B", "226B Implémenter orienté objets (avec hérédité)");
INSERT INTO modules (id, ictCode, title ) VALUES (6,"403", "Implémenter de manière procédurale des déroulements de programme");
INSERT INTO modules (id, ictCode, title ) VALUES (7,"133", "Réaliser des applications Web en Session-Handling");

-- Rôles
-- privieges: matrice de bits
INSERT INTO roles (id, name, privileges) VALUES (1, "Anonyme", 0);
INSERT INTO roles (id, name, privileges) VALUES (2, "Elève", 661264);
INSERT INTO roles (id, name, privileges) VALUES (3, "Enseignant", 1048575);
INSERT INTO roles (id, name, privileges) VALUES (4, "Direction", 69905);
INSERT INTO roles (id, name, privileges) VALUES (5, "Administrateur", 4294967296);
