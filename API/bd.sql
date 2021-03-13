CREATE TABLE presencia (presencia_id INT NOT NULL AUTO_INCREMENT, direccion VARCHAR(45) NOT NULL, tiempoArea INT NOT NULL, last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, PRIMARY KEY  (presencia_id));
INSERT INTO presencia values (default, "entrada", 20, current_timestamp);

CREATE TABLE temperatura (temperatura_id INT NOT NULL AUTO_INCREMENT, temperatura FLOAT NOT NULL, humedad INT NOT NULL, last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, PRIMARY KEY  (temperatura_id));
INSERT INTO temperatura values (default, 28.0, 68.0, current_timestamp);

CREATE TABLE usuarios (usuarios_id INT NOT NULL AUTO_INCREMENT, nombre VARCHAR(20) NOT NULL, apPaterno VARCHAR(20) NOT NULL, apMaterno VARCHAR(20) NOT NULL, huella INT NOT NULL, last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, PRIMARY KEY  (usuarios_id));
INSERT INTO usuarios values (default, 'victor', 'hernandez', 'garcia', 1, current_timestamp);