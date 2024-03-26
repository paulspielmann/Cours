
DROP TABLE IF EXISTS VOL, AVION, PILOTE, COMPAGNIE, AEROPORT;
-- Création des Tables
CREATE TABLE AEROPORT (
  codeAer char(6) NOT NULL PRIMARY KEY,
  nomAeroport varchar(30) NOT NULL,
  villeAeroport varchar(20) NOT NULL
);

CREATE TABLE COMPAGNIE (
  numComp serial PRIMARY KEY,  -- compagnie_pkey
  nomComp varchar(20) NOT NULL,
  nationaliteComp varchar(20)
);

CREATE TABLE PILOTE (
  numPilote serial PRIMARY KEY, -- pilote_pkey
  nomPilote varchar(20) NOT NULL,
  adrPil varchar(20) NOT NULL,
  SalPil numeric(20,2) NOT NULL,
  dateEmbPil date,
  numComp integer REFERENCES COMPAGNIE(numComp) ON DELETE SET NULL
);

CREATE TABLE AVION (
  numAvion serial PRIMARY KEY,
  typeAvion varchar(6) NOT NULL,
  dateMiseServiceAvion date NOT NULL,
  nbPlacesAvion integer,
  numComp integer REFERENCES COMPAGNIE(numComp) ON DELETE SET NULL
);

CREATE TABLE VOL (
  numVol serial PRIMARY KEY,
  dateVol date NOT NULL,
  hrDep time NOT NULL,
  hrArr time NOT NULL,
  codeAerDep char(6) NOT NULL REFERENCES AEROPORT(codeAer) ON DELETE CASCADE,
  codeAerArr char(6) NOT NULL REFERENCES AEROPORT(codeAer) ON DELETE CASCADE,
  numPilote integer NOT NULL REFERENCES PILOTE(numPilote),
  numAvion integer NOT NULL REFERENCES AVION(numAvion) ON DELETE CASCADE
);

-- insertion dans aeroport
INSERT INTO AEROPORT VALUES
('PA-CDG','CHARLES DE GAULLE', 'ROISSY'),
('MA-MRG','MARIGNANNE', 'VITROLLES'),
('PA-ORY', 'ORLY', 'ORLY'),
('NY-JFK','John F. Kenedy','NEW YORK');

-- insertion relatif à la compagnie Air France (en utilisant les sequences)
INSERT INTO COMPAGNIE VALUES (DEFAULT,'AIR FRANCE','FRANCAISE');
INSERT INTO PILOTE VALUES (DEFAULT,'ROMAIN','VITROLLES',12000.53,'2009/12/22',currval('compagnie_numcomp_seq'));
INSERT INTO AVION VALUES (DEFAULT,'A380','2007/12/25',380,currval('compagnie_numcomp_seq'));
INSERT INTO VOL VALUES 
	(DEFAULT,'2011/12/25','23:32:00','23:50:00','PA-CDG','PA-ORY',
	 currval('pilote_numpilote_seq'),
	 currval('avion_numavion_seq'));

INSERT INTO PILOTE VALUES(DEFAULT,'PATRICK','ROISSY',15012.05,'2008/03/02',NULL); -- pilote independant
INSERT INTO VOL VALUES 
	(DEFAULT,'2007/12/10','20:18:00','23:22:00','PA-CDG','MA-MRG',currval('pilote_numpilote_seq'), currval('avion_numavion_seq')),
	(DEFAULT,'2007/10/01','20:20:00','23:19:00','MA-MRG','PA-CDG',currval('pilote_numpilote_seq'), currval('avion_numavion_seq'));

-- insertion dans compagnie
INSERT INTO COMPAGNIE VALUES (DEFAULT,'AIR INTER','FRANCAISE'); 
INSERT INTO COMPAGNIE VALUES (DEFAULT,'TUNIS AIR','TUNISIENNE'); 
INSERT INTO COMPAGNIE VALUES (DEFAULT,'AIR FORCE 1','AMERICAINE'); 

-- insertion dans pilote
INSERT INTO PILOTE VALUES(DEFAULT,'DIMITRI','ORLY',10018,'2008/1/03',2);
INSERT INTO PILOTE VALUES(DEFAULT,'YAMCHA','ROISSY',1512.98,'2003/2/8',2);

-- insertion dans AVION
INSERT INTO AVION (typeAvion, dateMiseServiceAvion, nbPlacesAvion, numComp) 
		VALUES ('BOEING','1999/01/31',NULL,NULL);

INSERT INTO VOL VALUES
	(DEFAULT,'2007/01/10','08:23:00','23:58:00','PA-ORY','NY-JFK',3,2),
	(DEFAULT,'2007/01/15','08:23:00','23:58:00','NY-JFK','PA-ORY',3,2),
	(DEFAULT,'2007/01/16','08:32:00','00:03:00','PA-ORY','NY-JFK',2,2);


-- EXEMPLES :
SELECT numPilote, nomPilote 
FROM PILOTE 
WHERE dateEmbPil < '2010/01/01';

select * 
from PILOTE NATURAL LEFT OUTER JOIN COMPAGNIE;

