-- Fill Script - Tasks and links

-- Tasks
INSERT INTO tasks (id, name, description, goal, duration, level, mandatory, onlyOnce) VALUES (1,"DomoPi","Réalisation d'une installation de domotique avec commande de matériel Z-Wave avec un Raspberry Pi ","Tous les périphériques sont pilotables",15,5,0,0);
INSERT INTO tasks (id, name, description, goal, duration, level, mandatory, onlyOnce) VALUES (2,"Découverte du RasperryPi","Mise en route d'un RaspberryPi", "Installation de Noobs",2,2,1,0);
INSERT INTO tasks (id, name, description, goal, duration, level, mandatory, onlyOnce) VALUES (3,"BlinkLed sur RasperryPi","Commande d'une Led connecté sur un RaspberryPi (en utilisant, 1 la ligne de commande, puis script Python, et évent. autre langage)","commander un GPIO",3,2,0,1);
INSERT INTO tasks (id, name, description, goal, duration, level, mandatory, onlyOnce) VALUES (4,"Mise en service d'un NAS","Installation et configuration d'un NAS sur un réseau local","Accès à des dossiers partagés",3,1,0,1);
INSERT INTO tasks (id, name, description, goal, duration, level, mandatory, onlyOnce) VALUES (5,"Hébergement d'un site web sur un NAS","Activé les Webservices d'un Synology pour permettre l'hébergement d'un site répondant à www.monsiteperso.com","Dans le réseau interne, le site doit être accessible",2,1,0,1);

-- links tasks-domains
INSERT INTO practices (taskId, domainId) VALUES (1,2);
INSERT INTO practices (taskId, domainId) VALUES (1,10);
INSERT INTO practices (taskId, domainId) VALUES (2,2);
INSERT INTO practices (taskId, domainId) VALUES (3,2);
INSERT INTO practices (taskId, domainId) VALUES (4,3);
INSERT INTO practices (taskId, domainId) VALUES (4,9);
INSERT INTO practices (taskId, domainId) VALUES (5,7);
INSERT INTO practices (taskId, domainId) VALUES (5,1);
INSERT INTO practices (taskId, domainId) VALUES (5,3);

-- links tasks-modules
INSERT INTO trains (taskId, moduleId) VALUES (4,3);
INSERT INTO trains (taskId, moduleId) VALUES (3,6);
INSERT INTO trains (taskId, moduleId) VALUES (5,1);
INSERT INTO trains (taskId, moduleId) VALUES (5,2);


-- links tasks-materials
INSERT INTO needs (taskId, materialId) VALUES (1,2);
INSERT INTO needs (taskId, materialId) VALUES (1,7);
INSERT INTO needs (taskId, materialId) VALUES (1,8);
INSERT INTO needs (taskId, materialId) VALUES (2,1);
INSERT INTO needs (taskId, materialId) VALUES (3,1);
INSERT INTO needs (taskId, materialId) VALUES (3,9);
INSERT INTO needs (taskId, materialId) VALUES (3,2);
INSERT INTO needs (taskId, materialId) VALUES (4,5);
INSERT INTO needs (taskId, materialId) VALUES (5,5);

-- links for prerequisted tasks
INSERT INTO prerequistes (tasksId, prerequiredTaskId) VALUES (1,2);
INSERT INTO prerequistes (tasksId, prerequiredTaskId) VALUES (3,2);
INSERT INTO prerequistes (tasksId, prerequiredTaskId) VALUES (5,4);


-- Ressources for tasks
INSERT INTO ressources (id, taskId, uri, description, onlyForTeachers) VALUES (1,2, "http://www.raspberry.org", "Site officiel de Raspberry", 0 );
INSERT INTO ressources (id, taskId, uri, description, onlyForTeachers) VALUES (2,3, "http://www.instructables.com/id/Blinking-LED-with-Raspberry-Pi-1/", "Tuto Python pour la mise en place du hardware et l'implémentation du code", 0 );
INSERT INTO ressources (id, taskId, uri, description, onlyForTeachers) VALUES (3,3, "file:///P:\Projets\et\info1annee\1A26_RaspberryPi\Guide RaspberryPi\Biendemarrer.pdf", "Copie d'article sur le RaspberryPi", 0 );
INSERT INTO ressources (id, taskId, uri, description, onlyForTeachers) VALUES (4,3, "file:///P:\Projets\et\info1annee\1A26_RaspberryPi\GuideDesInstalls_v0.45.docx", "Document d'installation de C. Caillet pour une config de base", 1 );

-- Users
INSERT INTO users (id, roleId, email, firstname, name,	token, tokenValidity) VALUES (1, 5, "cedric.caillet@rpn.ch", "Cédric","Caillet",  "", 0);
INSERT INTO users (id, roleId, email, firstname, name,	token, tokenValidity) VALUES (2, 5, "steeve.droz@rpn.ch", "Steeve","Droz", "", 0);
INSERT INTO users (id, roleId, email, firstname, name,	token, tokenValidity) VALUES (3, 5, "pierre.ferrari@rpn.ch", "Pierre","Ferrari", "", 0);
INSERT INTO users (id, roleId, email, firstname, name,	token, tokenValidity) VALUES (4, 2, "pazkal.marchand@rpn.ch", "Pazkal","Marchand", "", 0);
INSERT INTO users (id, roleId, email, firstname, name,	token, tokenValidity) VALUES (5, 2, "alex.terieur@rpn.ch", "Alex","Terrieur", "", 0);
INSERT INTO users (id, roleId, email, firstname, name,	token, tokenValidity) VALUES (6, 4, "directeur@rpn.ch", "Monsieur","LeDirecteur", "", 0);
INSERT INTO users (id, roleId, email, firstname, name,	token, tokenValidity) VALUES (7, 3, "un.pion@rpn.ch", "Korinne", "Egger", "", 0);
