# BibliotecaApp

Biblioteca app es un sistema que permitirá gestionar  los libros y prestamos de su biblioteca particular.

# Roles

BibliotecaApp maneja 2 tipos de roles:

 - Administrador (Admin): quien administra los libro (crea, edita, elimina) y los prestamos otorgados.
 - Usuario (User): quien visualiza los libros disponibles y puede solicitarlos en calidad de prestamos.

## Iniciación
Para la ejecucion del programa se provee de un archivo Docker y docker-compose con las especificaciones necesarias para ejecutar la aplicacion.
Para esto necesitará tener instalado Docker y Docker compose en su equipo.

## Pasos

 1. Descargar este proyecto en su equipo, e ingrese a la misma.
 2. A continuación, utilice [la imagen  `de composer`](https://hub.docker.com/r/library/composer/) de Docker a fin de montar los directorios que necesitará para su proyecto de Laravel y evitar la sobrecarga que implica instalar Composer a nivel global:
	`docker run --rm -v $(pwd):/app composer install`
 3. Establezca permisos en el directorio del proyecto para que sea propiedad de su usuario no  **root**:
`sudo chown -R $USER:$USER ~/bibliotecaApp`
 4. El archivo docker-compose contiene las especificaciones necesarias para el servidor, la base de datos y el servicio de la aplicación.
El archivo contiene las especificaciones como contraseñas y nombre de la base de datos, pero si lo desea puede cambiarlos (deberá recordar los cambios ya que serán necesarios más adelante):
    `environment:
      MYSQL_DATABASE: laravel
      MYSQL_ROOT_PASSWORD: your_mysql_root_password
`
 5. En nuestra aplicación, usaremos [_volúmenes_](https://docs.docker.com/storage/volumes/) y [_montajes bind_](https://docs.docker.com/storage/bind-mounts/) para persistir la base de datos y los archivos de aplicación y configuración.
 6. Configurar PHP:
	 - Crear una carpeta php dentro del directorio y luego un archivo local.ini dentro del mismo
		 - `bibliotecaApp/php/local.ini`
y escribimos la siguiente configuración:
		

			> 	upload_max_filesize=40M
				post_max_size=40M

	- Guarde el archivo
 7. Configurar Nginx
	- Crear las siguientes carpetas dentro del directorio
		`bibliotecaApp/nginx/conf.d`
	- Y dentro de conf.d cree el archivo **app.conf** y escriba lo siguiente:
server {
listen 80;
    index index.php index.html;
    error_log  /var/log/nginx/error.log;
    access_log /var/log/nginx/access.log;
    root /var/www/public;
    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
    location / {
        try_files $uri $uri/ /index.php?$query_string;
        gzip_static on;
    }
}

 8. Configurar MySQL:
	-	Cree dentro del directorio del proyecto una carpeta mysql y dentro un archivo **my.cnf** 
`biliotecaApp/mysql/my.cnf`
Y dentro coloque lo siguiente
		> [mysqld]
general_log = 1
general_log_file = /var/lib/mysql/general.log
	

 9. Ahora dentro del directorio del proyecto debe copiar el archivo `.env.example` y llamarlo `.env` y colocar lo siguiente

	> DB_CONNECTION=mysql
	DB_HOST=db
	DB_PORT=3306
	DB_DATABASE=biblioteca
	DB_USERNAME=bibliotecauser
	DB_PASSWORD=kary2020

Ud puede cambiar estos valores pero debe recordarlos para más adelante.

 10. Iniciar los contenedores
una vez configurado el entorno podrá ejecutar los contenedores:
`docker-compose up -d`
El siguiente comando generará una clave y la copiará a su archivo  `.env`; esto garantizará que las sesiones y los datos cifrados de su usuario permanezcan seguros:
```docker-compose exec app php artisan key:generate```
Con esto, dispondrá de los ajustes de entorno necesarios para ejecutar su aplicación. Para almacenar en caché estos ajustes en un archivo, lo cual aumentará la velocidad de carga de su aplicación, ejecute lo siguiente:
`
docker-compose exec app php artisan config:cache
`
 2. Crear un usuario para mySQL
Para crear un nuevo usuario, ejecute un shell bash interactivo en el contenedor  `db`  con
`
docker-compose exec db bash
`
Dentro del contenedor, inicie sesión en la cuenta administrativa  **root**  de MySQL:
`
mysql -u root -p
`
Se le solicitará la contraseña que estableció para la cuenta **root** de MySQL durante la instalación en su archivo `docker-compose`.
Ejecute el comando `show databases` para verificar las bases de datos existentes `biblioteca`.
`GRANT ALL ON laravel.* TO 'bibliotecauser'@'%' IDENTIFIED BY 'kary2020';`
Elimine los privilegios para notificar los cambios al servidor MySQL:
`FLUSH PRIVILEGES`
Cierre MySQL:
`
exit
`
Por último, cierre el contenedor:
`
exit
`
 3. Migración y Creación de Roles
- Primero, pruebe la conexión con MySQL ejecutando el comando Laravel  `artisan migrate`, que crea una tabla  `migrations`  en la base de datos dentro del contenedor:
`docker-compose exec app php artisan migrate`
- Cargaremos los datos iniciales:
	- Cargaremos los roles con el siguiente comando:
	`docker-compose exec app php artisan db:seed --class=RolSeeder`
	- Cargaremos el usuario administrador (usuario: karysol_92@hotmail.com password: hola1234) ejecutando el siguiente comando : 
	 `docker-compose exec app php artisan db:seed --class=UserSeeder`
13. Ahora instalaremos las dependencias necesaarias del proyecto:
	- bien si cuentas con npm en tu equipo ejecutando el comando:
		`npm install`
14. Ahora si listos para ver la aplicacion:
	- pudes dirigirte en el navegador a `http://localhost:8080/`
	- o bien con npm iniciar browserSync (que desplegara la aplicacion en el navegador):
		`npm run watch`


## P/D
	- cualquier consulta con los pasos de docker aqui esta una guia mas detallada:
		[# Cómo configurar Laravel, Nginx y MySQL con Docker Compose](https://www.digitalocean.com/community/tutorials/como-configurar-laravel-nginx-y-mysql-con-docker-compose-es)


Saludos