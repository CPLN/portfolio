-- Projet    : Portfolio
-- Auteur    : Caillet C. 
-- SGBD      : PostgreSQL
-- Remarques : Création des tables du modèle PORTFOLIO

-- Table Modules
CREATE TABLE Modules (
  id		INTEGER,
  ict_code	CHARACTER VARYING(10) NOT NULL,
  title	    CHARACTER VARYING(50),
  CONSTRAINT	PK_Modules
  	PRIMARY KEY (id)
);

-- Table Skills
CREATE TABLE Skills (
  tasksId		INTEGER,
  modulesId		INTEGER,
  CONSTRAINT	PK_Skills
  	PRIMARY KEY (tasksId, modulesId)
);
  

-- Table Files
CREATE TABLE Files (
  id		INTEGER,
  tasksId	INTEGER NOT NULL,
  uri	    CHARACTER VARYING(100),
  data      CHARACTER VARYING(250),
  onlyForTeacher BOOLEAN,
  CONSTRAINT	PK_Files
  	PRIMARY KEY (id)
);

-- Table Materials
CREATE TABLE Materials (
  id		INTEGER,
  name		CHARACTER VARYING(50),
  CONSTRAINT	PK_Materials
  	PRIMARY KEY (id)
);

-- Table Workshops
CREATE TABLE Workshops (
  id		INTEGER,
  name		CHARACTER VARYING(50),
  CONSTRAINT	PK_Workshops
  	PRIMARY KEY (id)
);

-- Table Domains
CREATE TABLE Domains (
  id		   INTEGER,
  workshopsId  INTEGER,
  name		   CHARACTER VARYING(50),
  CONSTRAINT	PK_Domains
  	PRIMARY KEY (id)
);

-- Table Tasks
CREATE TABLE Tasks (
  id		   INTEGER,
  domainsId    INTEGER,
  name		   CHARACTER VARYING(80),
  description  CHARACTER VARYING(200),
  corrected    BOOLEAN,    
  goal         CHARACTER VARYING(200),
  duration     CHARACTER VARYING(50),
  level        INTEGER,
  mandatory    BOOLEAN,
  onlyOnce     BOOLEAN,
  CONSTRAINT	PK_Tasks
  	PRIMARY KEY (id)
);

-- Table Prerequistes
CREATE TABLE Prerequistes (
  tasksId				INTEGER,
  prerequiredTaskId		INTEGER,
  CONSTRAINT	PK_Prerequistes
  	PRIMARY KEY (tasksId, prerequiredTaskId)
);


-- Table Needs
CREATE TABLE Needs (
  tasksId		INTEGER,
  materialsId		INTEGER,
  CONSTRAINT	PK_Needs
  	PRIMARY KEY (tasksId, materialsId)
);

-- Table Users
CREATE TABLE Users ( 
	id 		INTEGER,
	email  	CHARACTER VARYING(50),
	pseudo  CHARACTER VARYING(20),
	role  	CHARACTER VARYING(50),
	token  	CHARACTER VARYING(100),
	tokenValidUntil  DATETIME,
	CONSTRAINT	PK_Users
		PRIMARY KEY (id)
);
  
-- Table Validates
CREATE TABLE Validates ( 
	id 		INTEGER,
	taskId  INTEGER,
	usersId INTEGER,
	start  DATE,
	end    DATE,
	grade  INTEGER,
	CONSTRAINT	PK_Validates
		PRIMARY KEY (id)
);


-- Ajout des contraintes de clés étrangères
ALTER TABLE Files ADD CONSTRAINT FK_Files_TasksId FOREIGN KEY (tasksId) REFERENCES Tasks(id);

ALTER TABLE Domains ADD CONSTRAINT FK_Domains_WorkshopsId FOREIGN KEY (workshopsId) REFERENCES Workshops(id);

ALTER TABLE Prerequistes 
 ADD CONSTRAINT FK_Prerequistes_TasksId FOREIGN KEY (tasksId) REFERENCES Tasks(id),
 ADD CONSTRAINT FK_Prerequistes_PrerequiredTaskId_TasksId FOREIGN KEY (prerequiredTaskId) REFERENCES Tasks(id);


ALTER TABLE Skills 
 ADD CONSTRAINT	FK_Tasks_id FOREIGN KEY (tasksId) REFERENCES Tasks(id),
 ADD CONSTRAINT	FK_Modules_id FOREIGN KEY (modulesId) REFERENCES Modules(id);	

ALTER TABLE Needs 
 ADD CONSTRAINT	FK_Tasks_id FOREIGN KEY (tasksId) REFERENCES Tasks(id),
 ADD CONSTRAINT	FK_Materials_id FOREIGN KEY (materialsId) REFERENCES Materials(id);		 
  
ALTER TABLE Tasks
  ADD CONSTRAINT FK_Domains_id         FOREIGN KEY (domainsId) REFERENCES Domains(id),
  ADD CONSTRAINT CH_Tasks_level_min    CHECK (level > 0),
  ADD CONSTRAINT CH_Tasks_level_max    CHECK (level <= 6),
  ADD CONSTRAINT NN_Tasks_level        CHECK (level IS NOT NULL);