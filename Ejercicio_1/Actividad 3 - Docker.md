**Autor:** Ismael Fernando Brito Monar

# Actividad 3 - Docker

## Índice

[TOC]

## Ejercicio 1 - Trabajo con imágenes

### Servidor web

1. Vamos a arrancar un contenedor usando la instancia de la imagen **`php:7.4-apache`** y que sea accesible desde el puerto 1234, para ello podemos descargar la imagen con el comando *docker pull* o ejecutar directamente el comando *docker run* como se muestra a continuación y en el caso de no tener la imagen se descargará antes.

```bash
docker run -d -p 1234:80 --name servidor php:7.4-apache
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\1.png)

Podemos visualizar el estado y el tamaño del contenedor con el siguiente comando.

```bash
docker ps -a -s
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\1-1.png)

2. A continuación, colocaremos un sitio web ubicado en la ruta relativa **`Escritorio/miWeb`** de mi pc en la ruta **`/var/www/html`** del servidor para poder visualizarlo desde el navegador utilizando los siguientes comandos.

```bash
docker cp Escritorio/miWeb/index.html servidor:/var/www/html
docker cp Escritorio/miWeb/assets servidor:/var/www/html
docker cp Escritorio/miWeb/images servidor:/var/www/html
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\3.png)

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\4.png)

3. Por último colocaremos el archivo **`cabeceras.php`** en la ruta del servidor mencionada anteriormente.

```bash
docker cp Escritorio/miWeb/cabeceras.php servidor:/var/www/html
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\5.png)

El contenido del archivo *.php* es el siguiente:

```php
<?php
print "<h1>Script Cabeceras - Tarea de Ismael</h1><br/>";

foreach (getallheaders() as $nombre => $valor){
	print "$nombre: $valor<br/>";
}
?>
```

Y así lo vemos en el navegador:

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\7.png)

Volvemos a visualizar el estado y tamaño del contenedor:

```bash
docker ps -a -s
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\9.png)

4. Para finalizar está práctica borraremos el contenedor, podemos hacerlo parando el contenedor para luego borrarlo o forzar su borrado como vemos a continuación.

```bash
dokcer rm -f servidor
docker ps -a
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\8.png)

### Servidor de Base de Datos

1. Descargamos la imagen de **`mariadb 10.10`**.

```bash
docker pull mariadb:10.10
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\10.png)

2. Creamos un contenedor que se llame **`bbdd`** a partir de esa imagen, en cuya creación contenga las variables de contraseña de root igual a **`root`**, base de datos creada automáticamente al iniciar con el nombre **`base1`** y usuario **`daw`** con contraseña **`laboral1`**. 

```bash
docker run -d --name bbdd \
-e MARIADB_ROOT_PASSWORD=root \
-e MARIADB_DATABASE=base1 \
-e MARIADB_USER=daw \
-e MARIADB_PASSWORD=laboral1 \
mariadb:10.10
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\11.png)

3. A continuación entramos en el bash del contenedor para conectarnos como root y proceder a crear la **`tabla1`** dentro de la base de datos **`base1`**.

```bash
docker exec -it bbdd bash
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\17.png)

```mysql
mariadb -u root -p
show databases;
use base1;
CREATE TABLE tabla1(id INT, nombre CHAR(3));
show tables;
exit
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\13.png)

4. Nos conectamos como **`daw`** y comprobamos que existen **`base1`** y **`tabla1`**.

```mysql
mariadb -u daw -p
show databases;
use base1;
show tables;
exit
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\14.png)

5. Comprobamos que la imagen de **`mariadb`** no se puede borrar mientras haya un contenedor creado a partir de esa imagen ejecutándose.

```bash
docker ps -a
docker images
docker rmi mariadb:10.10
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\15.png)

6. Por último procedemos a borrar el contenedor.

```bash
docker rm -f bbdd
docker ps -a
```

![](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\imagenes_EJ1\16.png)