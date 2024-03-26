1/ SELECT immat, code, type
   FROM VOITURE v, MODELE m
   WHERE m.code = v.code
   AND date BETWEEN '01/01/2004' AND '31/12/2004';

2/ SELECT v.nom, v.prenom
   FROM VOITURE v, GARAGE g, MODELE m
   WHERE v.ville = g.ville
   AND g.marque = m.marque;

3/ SELECT type, marque, puissance
   FROM MODELE m, VOITURE v
   WHERE m.puissance >= (SELECT AVG(puissance) FROM MODELE) ;

4/ SELECT code, type
   FROM MODELE
   WHERE type ~ '^[a-zA-z]';
   
5/ SELECT nom, prenom
   FROM VOITURE
   WHERE ADRESSE LIKE '%rue%';

6/ SELECT m.marque, COUNT(*) AS quantite
   FROM VOITURE v, MODELE m
   WHERE m.code = v.code
   GROUP BY marque;

7/ SELECT type, marque, puissance
   FROM MODELE
   ORDER BY puissance DESC, marque;

8/ SELECT DISTINCT m.code, type
   FROM MODELE m, VOITURE v
   WHERE v.code = m.code
   GROUP BY m.code, type
   HAVING min(date) BETWEEN '01/07/2008' AND '31/12/2008';

9/ SELECT marque, count(*) AS quantite
   FROM MODELE m, VOITURE v
   GROUP BY marque
   ORDER BY quantite;

10/ SELECT v2.immat, v2.nom, v2.prenom
    FROM VOITURE v1, VOITURE v2
    WHERE v1.ville = v2.ville
    AND v1.immat = '1980 AV 02'

11/ SELECT marque, AVG(puissance)
    FROM MODELE
    GROUP BY marque;

12/ SELECT nom, adresse, marque
    FROM GARAGE
    WHERE (ville, marque) NOT IN (SELECT DISTINCT (ville, marque)
     	  	  	      	  FROM VOITURE v, MODELE m
				  WHERE v.code = m.code);

13/ SELECT DISTINCT nom, prenom
    FROM VOITURE v, MODELE m
    WHERE v.code = m.code
    AND marque = 'Renault';

14/ SELECT code, type, marque
    FROM MODELE m
    WHERE code NOT IN (SELECT *
    	       	       FROM VOITURE V
		       WHERE m.code = v.code)

15/ SELECT g.code, g.nom
    FROM GARAGE g, VOITURE v, MODELE m
    WHERE g.ville = v.ville
    AND g.marque = m.marque
    AND V.code = m.code
    AND v.date < '08/10/2000'

16/ SELECT ville
    FROM GARAGE
    GROUP BY ville
    HAVING count(*)>10

17/ SELECT marque, count(*)
    FROM GARAGE
    WHERE cPostal LIKE '93%'
    GROUP BY marque

18/ SELECT nom, adresse
    FROM GARAGE g, MODELE m
    WHERE m.marque = g.marque
    AND ville = 'Paris'
    AND type = 'Espace';

19/ SELECT g2.nom, g2.adresse
    FROM GARAGE g1, GARAGE g2
    WHERE g1.marque = g2.marque
    AND g1.nom = 'Dupont'

20/ SELECT nom, prenom
    FROM VOITURE v, MODELE m
    WHERE v.code = m.code
    AND v.puissance > (SELECT max(puissance)
    		       FROM MODELE
		       WHERE marque = 'Renault');
