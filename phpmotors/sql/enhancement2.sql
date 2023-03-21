/* Enhancement 2 Queries */

/* Inserting new client */

INSERT INTO clients(clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment)
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'IamIronM@n', 1, 'I am the real Ironman');

/* Changing clientLevel to 3 */

UPDATE clients
SET clientLevel = 3
WHERE client_id = 1;

/* Modifying the GM Hummer to read spacious interior */

UPDATE inventory
SET invDescription = replace(invDescription, 'small interior', 'spacious interior');

/* Using INNER JOIN to find the SUV category from two tables */

SELECT invModel, classificationName
FROM inventory i
INNER JOIN carclassification c
WHERE c.classificationName = "SUV"
AND i.classificationId = 1;

/* Delete Jeep Wrangler row */

DELETE FROM inventory
WHERE invId = 1;

/* Updating invImage and InvThumbnail to begin with /phpmotors */

UPDATE inventory
SET invImage = concat('/phpmotors', invImage),  invThumbnail = concat('/phpmotors', invThumbnail);