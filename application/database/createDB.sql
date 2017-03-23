-- Creation Script - SQLite3 

-- Table tasks    
CREATE TABLE tasks (
  id		   INTEGER PRIMARY KEY AUTOINCREMENT,
  name		   CHARACTER VARYING(80),
  description  CHARACTER VARYING(200),
  goal         CHARACTER VARYING(200),
  duration     CHARACTER VARYING(50),
  level        INTEGER,
  mandatory    BOOLEAN,
  onlyOnce     BOOLEAN
);

-- Table prerequistes
CREATE TABLE prerequistes (
  taskId				INTEGER,
  prerequiredTaskId		INTEGER,
  CONSTRAINT PK_prerequistes PRIMARY KEY (taskId, prerequiredTaskId)
  CONSTRAINT FK_tasks_taskId FOREIGN KEY (taskId) REFERENCES tasks(id)
  CONSTRAINT FK_tasks_prerequiredTaskId FOREIGN KEY (prerequiredTaskId) REFERENCES tasks(id)
);

-- Table tasks 
CREATE TABLE domains (
	id	    INTEGER PRIMARY KEY AUTOINCREMENT,
	name	CHARACTER VARYING(50)
);

-- Table pratices
CREATE TABLE practices (
	taskId	    INTEGER,
	domainId	INTEGER,
	CONSTRAINT PK_practices PRIMARY KEY(taskId,domainId)
	CONSTRAINT FK_tasks_taskId FOREIGN KEY (taskId) REFERENCES tasks(id)
    CONSTRAINT FK_domains_domainsId FOREIGN KEY (domainId) REFERENCES domains(id)
);
-- Table materials
CREATE TABLE materials (
	id	    INTEGER PRIMARY KEY AUTOINCREMENT,
	name	CHARACTER VARYING(100)
);

-- Table needs
CREATE TABLE needs (
  taskId				INTEGER,
  materialId    		INTEGER,
  CONSTRAINT PK_needs PRIMARY KEY (taskId, materialId)
  CONSTRAINT FK_tasks_taskId FOREIGN KEY (taskId) REFERENCES tasks(id)
  CONSTRAINT FK_materials_materialId FOREIGN KEY (materialId) REFERENCES materials(id)
);

-- Table ressources
CREATE TABLE ressources (
  id		   INTEGER PRIMARY KEY AUTOINCREMENT,
  taskId	   INTEGER,
  uri		   CHARACTER VARYING(255),
  description  CHARACTER VARYING(200),
  onlyForTeachers BOOLEAN,
  CONSTRAINT FK_tasks_taskId FOREIGN KEY (taskId) REFERENCES tasks(id)
);

-- Table modules
CREATE TABLE modules (
	id	    INTEGER PRIMARY KEY AUTOINCREMENT,
	ictCode	CHARACTER VARYING(10),
	title	CHARACTER VARYING(50)
);

-- Table needs
CREATE TABLE trains (
  taskId				INTEGER,
  moduleId    		INTEGER,
  CONSTRAINT PK_needs PRIMARY KEY (taskId, moduleId)
  CONSTRAINT FK_tasks_taskId FOREIGN KEY (taskId) REFERENCES tasks(id)
  CONSTRAINT FK_modules_moduleId FOREIGN KEY (moduleId) REFERENCES modules(id)
);

-- Table users
CREATE TABLE users (
	id	    INTEGER PRIMARY KEY AUTOINCREMENT,
	roleId	INTEGER,
	email	  CHARACTER VARYING(50),
	name	  CHARACTER VARYING(50),
	firstname CHARACTER VARYING(50),
	token   CHARACTER VARYING(30),
	tokenValidity  TIMESTAMP,
    CONSTRAINT FK_roles_roleId FOREIGN KEY (roleId) REFERENCES roles(id)   	
);

-- Table users
CREATE TABLE roles (
	id	    INTEGER PRIMARY KEY AUTOINCREMENT,
	name	CHARACTER VARYING(50),
    privileges INTEGER DEFAULT 0
);


-- Table executes
CREATE TABLE executes (
  id	            INTEGER PRIMARY KEY AUTOINCREMENT,
  userId			INTEGER,
  taskId			INTEGER,
  validatorId	    INTEGER,
  start    			DATE,
  end               DATE,
  grade             INTEGER,
  comment           CHARACTER VARYING(255),
  CONSTRAINT FK_users_userId FOREIGN KEY (userId) REFERENCES users(id)
  CONSTRAINT FK_tasks_taskId FOREIGN KEY (taskId) REFERENCES tasks(id)
  CONSTRAINT FK_users_validatorId FOREIGN KEY (validatorId) REFERENCES users(id)
  CONSTRAINT CH_executes_grade CHECK (grade BETWEEN 0 AND 6)
);

