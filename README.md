# Proyecto
# Dockerfile-PHP-Apache-conectado-a-contenedor-MySQL
Creación de Contenedor Docker de Apache con PHP creado desde Dockerfile y conectado a una Base de Datos en MySQL.
# PASO 1.
*Descargar la imagen de docker de Mysql.*
* docker pull mysql:5
# PASO 2.
* Crear una carpeta con el nombre DataBase.
* Crear una carpeta y guardar los archivos Conexion.php, PresenciaBL.php, PresenciaService.php, Index.php y el archivo Dockerfile que se encuentran en este repositorio.

# PASO 3.
*Ejecutar el contenedor para la Base de Datos.*
# Base de Datos.
* docker run -p 3306:3306 --name BaseDatos -v /Proyecto/DataBase:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=123 -d mysql:5

# PASO 4.
Crear una Base de datos
* docker exec -it BaseDatos /bin/bash
* mysql -u root -p
* CREATE DATABASE proyecto;
* USE proyecto;
* *Ejecutar las lineas del archivo db.sql*
* exit
* exit

# PASO 5.
Crear la imagen para el contenedor Apache.
* Abrir la carpeta con los archivos php y el Dockerfile desde Visual Studio Code.
* Hacer clic derecho en el archivo Dockerfile y seleccionar la opción "Build image..."
* ![Alt text](https://github.com/vh2212/Dockerfile-PHP-Apache-conectado-a-contenedor-MySQL/blob/main/Captura%20de%20pantalla%20de%202020-11-02%2015-01-40.png) 
* Ponerle un nombre a la imagen, ejemplo web:latest, donde latest es el número de versiones que tiene la imagen. (Se puede quedar así ese campo.)
# PASO 6.
Crear el contenedor Apache.
* docker run -p 80:80 --name Web -d --link BaseDatos web:latest
# PASO 7.
Configurar el contenedor de la página.
* docker exec -it Web /bin/bash
* docker-php-ext-install pdo pdo_mysql pdo_pgsql
* cd /usr/local/etc/php
* nano php.ini-development
* Buscar el apartado Dynamic Extensions, en la parte de "or with a path", agregar las lineas.
* extension=/usr/local/lib/php/extensions/no-debug-non-zts-20151012/pdo.so
* extension=/usr/local/lib/php/extensions/no-debug-non-zts-20151012/pdo_mysql.so
* nano php.ini-production y hacer lo mismo que el archivo anterior.
* exit
* docker restart Web
# PASO 8.
Comprobar el funcionamiento del Contenedor.
* Abrir el navegador y escribir localhost o localhost:[puerto]. Debería mostrarle algo como esto.
* ![Alt text](https://github.com/vh2212/Dockerfile-PHP-Apache-conectado-a-contenedor-MySQL/blob/main/Captura%20de%20pantalla%20de%202020-11-02%2015-37-12.png)
* Escribir en el navegador localhost/PresenciaService.php o localhost:[puerto]/PresenciaService.php. Debería mostrarle algo como esto.

* ![Alt text](https://github.com/vh2212/Dockerfile-PHP-Apache-conectado-a-contenedor-MySQL/blob/main/Captura%20de%20pantalla%20de%202020-11-02%2015-38-51.png)

*Nota: En Visual Studio Code debe tener instalada la extensión Docker.*
![Alt text](https://github.com/vh2212/Dockerfile-PHP-Apache-conectado-a-contenedor-MySQL/blob/main/Captura%20de%20pantalla%20de%202020-11-02%2015-42-52.png)
