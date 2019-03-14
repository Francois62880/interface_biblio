CREATE DATABASE bibliotheque;

USE bibliotheque;

CREATE TABLE adherent(
    id_adherent int NOT NULL AUTO_INCREMENT,
    nom VARCHAR(40) NOT NULL,
    prenom VARCHAR(40) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    ville VARCHAR(40) NOT NULL,
    email VARCHAR(40) NOT NULL,
    telephone VARCHAR(12) NOT NULL,
    portable VARCHAR(12) NOT NULL,
    pseudo VARCHAR(40) NOT NULL,
    login VARCHAR(40) NOT NULL,
    PRIMARY KEY(id_adherent)
)
ENGINE=INNODB; 

CREATE TABLE auteur(
    id_auteur int UNSIGNED NOT NULL AUTO_INCREMENT,
    nom VARCHAR(40) NOT NULL,
    prenom VARCHAR(40) NOT NULL,
    age int NOT NULL,
    nationalite VARCHAR(40) NOT NULL,
    PRIMARY KEY(id_auteur)
)
ENGINE=INNODB; 


CREATE TABLE clef(
    id_clef int UNSIGNED NOT NULL AUTO_INCREMENT,
    mot VARCHAR(40) NOT NULL,
    PRIMARY KEY(id_clef)
)
ENGINE=INNODB; 

CREATE TABLE cat(
    id_cat int UNSIGNED NOT NULL AUTO_INCREMENT,
    categorie VARCHAR(40) NOT NULL,
    PRIMARY KEY(id_cat)
)
ENGINE=INNODB;

CREATE TABLE livre(
    id_livre int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(40) NOT NULL,
    annee VARCHAR(255) NOT NULL,
    edition VARCHAR(40) NOT NULL,
    langue VARCHAR(40) NOT NULL,
    numcat INT UNSIGNED,
    archivage tinyint(1) NOT NULL,
    CONSTRAINT fk_num_cat FOREIGN KEY (numcat) REFERENCES cat(id_cat)
)
ENGINE=INNODB; 

CREATE TABLE reference(
    numlivre int NOT NULL,
    numclef1 INT NOT NULL,
    numclef2 INT NOT NULL,
    numclef3 INT NOT NULL
);
ENGINE=INNODB;

CREATE TABLE rayon(
    numlivre int NOT NULL, 
    numcategorie int NOT NULL
);

CREATE TABLE ecrit(
    numlivre int NOT NULL, 
    numauteur int NOT NULL
);

CREATE TABLE emprunt(
    numlivre int NOT NULL,
    numadherent INT NOT NULL,
    numprenom INT NOT NULL,
    datedebut date NOT NULL,
    datefin date NOT NULL
);

-- Requete pour cherche un livre par auteur, par titre ou par mot clef

SELECT titre, auteur.auteur, cat.categorie 



FROM livre 


JOIN ecrit ON livre.id_livre = ecrit.numlivre 



JOIN reference  ON livre.id_livre = reference.numlivre;


where titre="'.$search.'" or auteur="'.$search.'" or mot="'.$search.'"



SELECT titre 



FROM livre 


JOIN ecrit ON livre.id_livre = ecrit.numlivre 



JOIN reference  ON livre.id_livre = reference.numlivre

where titre="histoire" or edition="'gallimard'" or mot="'avion'"
