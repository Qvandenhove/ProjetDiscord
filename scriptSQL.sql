DROP TABLE IF EXISTS Utilisateur ;
CREATE TABLE Utilisateur (id_utilisateur INT AUTO_INCREMENT NOT NULL,
nom_Utilisateur VARCHAR(50),
prenom_Utilisateur VARCHAR(50),
mail_Utilisateur VARCHAR(500),
mdp_Utilisateur VARCHAR(1000),
PRIMARY KEY (id_utilisateur)) ENGINE=InnoDB;

DROP TABLE IF EXISTS salle_chat ;
CREATE TABLE salle_chat (id_salle INT AUTO_INCREMENT NOT NULL,
message_salle VARCHAR(500),
PRIMARY KEY (id_salle)) ENGINE=InnoDB;

DROP TABLE IF EXISTS classe ;
CREATE TABLE classe (id_classe INT AUTO_INCREMENT NOT NULL,
niveau_classe VARCHAR(50),
PRIMARY KEY (id_Classe)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Communique ;
CREATE TABLE Communique (id_utilisateur INT AUTO_INCREMENT NOT NULL,
id_salle INT NOT NULL,
PRIMARY KEY (id_utilisateur,
 id_salle)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Appartient ;
CREATE TABLE Appartient (id_utilisateur INT AUTO_INCREMENT NOT NULL,
id_classe INT NOT NULL,
PRIMARY KEY (id_utilisateur,
 id_classe)) ENGINE=InnoDB;

ALTER TABLE Communique ADD CONSTRAINT FK_Communique_id_utilisateur_Utilisateur FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur (id_utilisateur);

ALTER TABLE Communique ADD CONSTRAINT FK_Communique_id_salle_salle_chat FOREIGN KEY (id_salle) REFERENCES salle_chat (id_salle);
ALTER TABLE Appartient ADD CONSTRAINT FK_Appartient_id_utilisateur_Utilisateur FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur (id_utilisateur);
ALTER TABLE Appartient ADD CONSTRAINT FK_Appartient_id_Classe FOREIGN KEY (id_classe) REFERENCES Classe (id_classe);
