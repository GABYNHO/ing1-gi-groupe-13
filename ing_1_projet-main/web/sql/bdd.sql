DROP DATABASE IF EXISTS Base;
CREATE DATABASE Base;
USE Base;


CREATE TABLE Gestionnaire(
	email VARCHAR(255) PRIMARY KEY ,
	nom VARCHAR(255),
	prenom VARCHAR(255),
	tel VARCHAR(255),
	mdp VARCHAR(255),
	entreprise VARCHAR(255),
	debActi DATE,
	finActi DATE);



CREATE TABLE DataChallenge(
	idDC INT PRIMARY KEY AUTO_INCREMENT,
	nom VARCHAR(255),
	emailGest VARCHAR(255),
	descDC VARCHAR(255),
	dateD DATE,
	dateF DATE);

CREATE TABLE DataBattle(
	idDB INT PRIMARY KEY AUTO_INCREMENT,
	descDB VARCHAR(255),
	dateD DATE,
	dateF DATE,
	emailGest VARCHAR(255));
	

CREATE TABLE Equipe(
	idEquipe INT PRIMARY KEY,
	emailChef VARCHAR(255),
	idDC INT,
	idDB INT,
	idProjet INT,
	classementDC INT,
	classementDB INT,
	
	FOREIGN KEY fk_idDC(idDC) REFERENCES DataChallenge(idDC),
	FOREIGN KEY fk_idDB(idDB) REFERENCES DataBattle(idDB));

	
CREATE TABLE Etudiant(
	email VARCHAR(255) PRIMARY KEY,
	idEquipe INT,
	nom VARCHAR(255),
	prenom VARCHAR(255),
	tel VARCHAR(255),
	mdp VARCHAR(255),
	etablissement VARCHAR(255),
	niveauE VARCHAR(255),
	ville VARCHAR(255),
	lien VARCHAR(255),

	FOREIGN KEY fk_idE(idEquipe) REFERENCES Equipe(idEquipe));


CREATE TABLE Administrateur(
	email VARCHAR(255) PRIMARY KEY,
	nom VARCHAR(255),
	prenom VARCHAR(255),
	mdp VARCHAR(255));

CREATE TABLE NoteFinale(
	idNote INT PRIMARY KEY NOT NULL,
	idEquipe INT,
	idQuestionnaire INT,
	note INT);

CREATE TABLE Questionnaire(
	idQuest INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	descQuestionnaire VARCHAR(255),
	idDB INT,
	idEquipe INT,
	dateD DATE,
	dateF DATE,
	idNote INT,
	
	FOREIGN KEY fk_idDB(idDB) REFERENCES DataBattle(idDB),
	FOREIGN KEY fk_idDC(idEquipe) REFERENCES Equipe(idEquipe),
	FOREIGN KEY fk_idNote(idNote) REFERENCES NoteFinale(idNote));
	
	
CREATE TABLE Question(
	idQuestion INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	idQuestionnaire INT,
	nomQuest VARCHAR(255),
		
	FOREIGN KEY fk_idQ(idQuestionnaire) REFERENCES Questionnaire(idQuest));

CREATE TABLE Reponse(
	idQuestion INT,
	idEquipe INT,
	rep VARCHAR(255),
	note INT,
	
	PRIMARY KEY(idQuestion,idEquipe),
	FOREIGN KEY (idEquipe) REFERENCES Equipe(idEquipe),
	FOREIGN KEY fk_idQst(idQuestion) REFERENCES Question(idQuestion));

CREATE TABLE ProjetData(
	idProjet INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	idDC INT,
	idEquipe INT,
	descriptionPD VARCHAR(255),
	imagePD VARCHAR(255),
	-- coordonnées contact
	cooCont VARCHAR(255),
	-- url fichier
	urlF VARCHAR(255),
	-- url video
	urlV VARCHAR(255),
	note INT,
	
	FOREIGN KEY fk_idDC(idDC) REFERENCES DataChallenge(idDC));
	
	
CREATE TABLE Messagerie(
	idMessage INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	emailG VARCHAR(255),
	emailA VARCHAR(255),
	dateMessage TIMESTAMP,
	messages VARCHAR(300),
	
	FOREIGN KEY fk_emailG(emailG) REFERENCES Gestionnaire(email),
	FOREIGN KEY fk_emailA(emailA) REFERENCES Administrateur(email));
	
	
CREATE TABLE ConsulterMessage(
	emailEtudiant VARCHAR(30),
	idMessage INT,
	PRIMARY KEY(emailEtudiant,idMessage),
	
	FOREIGN KEY fk_idEtudiant(emailEtudiant) REFERENCES Etudiant(email),
	FOREIGN KEY fk_idMessage(idMessage) REFERENCES Messagerie(idMessage));
	

CREATE TABLE AdministrerE(
	emailEtudiant VARCHAR(30),
	emailAdmin VARCHAR(30),
	PRIMARY KEY(emailEtudiant,emailAdmin),
	
	FOREIGN KEY fk_idEtudiant(emailEtudiant) REFERENCES Etudiant(email),
	FOREIGN KEY fk_idAdmin(emailAdmin) REFERENCES Administrateur(email));
	
	
CREATE TABLE AdministrerDC(
	emailAdmin VARCHAR(30),
	idDC INT,
	PRIMARY KEY(emailAdmin,idDC),
	
	FOREIGN KEY fk_idAdmin(emailAdmin) REFERENCES Administrateur(email),
	FOREIGN KEY fk_idDC(idDC) REFERENCES DataChallenge(idDC));
	
	
CREATE TABLE OrganiserDB(
	emailG VARCHAR(30),
	idDB INT,
	PRIMARY KEY(emailG,idDB),
	
	FOREIGN KEY fk_idG(emailG) REFERENCES Gestionnaire(email),
	FOREIGN KEY fk_idDB(idDB) REFERENCES DataBattle(idDB));
	
	
CREATE TABLE OrganiserDC(
	emailG VARCHAR(30),
	idDC INT,
	PRIMARY KEY(emailG,idDC),
	
	FOREIGN KEY fk_idG(emailG) REFERENCES Gestionnaire(email),
	FOREIGN KEY fk_idDB(idDC) REFERENCES DataChallenge(idDC));
	


	
		
	
	
	
	
	
	
	
	
	
	
	
	
