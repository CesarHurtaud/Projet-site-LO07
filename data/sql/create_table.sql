CREATE TABLE etudiant (
  nom Varchar(25) NOT NULL,
  prenom Varchar(20) NOT NULL,
  numero INTEGER(5)  NOT NULL,
  filiere Varchar(3) NOT NULL,
  admission Varchar(2) NOT NULL,
  PRIMARY KEY(numero)
);


CREATE TABLE regle (
  id Varchar(20) NOT NULL,
  label Varchar(3) NOT NULL,
  agregat Varchar(5) NOT NULL,
  cible Varchar(10)  NOT NULL,
  affectation FLOAT NOT NULL,
  seuil Integer NOT NULL,
  idReglement INTEGER NOT NULL,
  FOREIGN KEY(idReglement)
  REFERENCES REGLEMENT (id)
    ON DELETE CASCADE
    ON UPDATE RESTRICT,
  PRIMARY KEY(id)
);

-- a voir si on met ID et du coup id sera la clé primaire

CREATE TABLE reglement (
  id INTEGER NOT NULL,
  label Varchar(20) NOT NULL,
  PRIMARY KEY(id)
);


CREATE TABLE elementCursus (
  id INTEGER NOT NULL,
  num_semestre Varchar(2) NOT NULL,
  label_semestre Varchar(4) NOT NULL,
  sigle Varchar(4) NOT NULL,
  categorie Varchar(2) NOT NULL,
  affectation Varchar(4) NOT NULL,
  utt Varchar(1) NOT NULL, -- boolean ?
  profil Varchar(1) NOT NULL, -- IDEM
  credit INTEGER(2) NOT NULL,
  resultat Varchar(3) NOT NULL,
  idCursus INTEGER NOT NULL,
  FOREIGN KEY(idCursus)
  REFERENCES CURSUS (id)
    ON DELETE CASCADE
    ON UPDATE RESTRICT,
  PRIMARY KEY(id)
);

CREATE TABLE cursus (
  id INTEGER NOT NULL,
  label Varchar(20) NOT NULL,
  numeroEtu INTEGER(5),
  FOREIGN KEY(numeroEtu)
  REFERENCES ETUDIANT (numero)
    ON DELETE CASCADE
    ON UPDATE RESTRICT,
  PRIMARY KEY(id)
);
