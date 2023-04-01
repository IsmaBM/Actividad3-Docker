**Autor:** IsmaBM

# Ejercicio 2 - Redes y Almacenamiento

## Creación de contenedores

1. Creamos una red bridge **`bdnet`** y comprobamos.

```bash
docker network create bdnet
docker network ls
```

![imagen1](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/1.png)

![imagen2](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/2.png)

2. Creamos un contenedor con la imagen de **`mariaDB`** conectado a la red **`bdnet`**, que se ejecute en segundo plano y sea accesible por el puerto 3306. (Definimos contraseña del usuario root y volumen de datos persistentes).

```bash
docker run -d --rm --name base_datos \
--network bdnet -p 3306:3306 \
-e MYSQL_ROOT_PASSWORD=root \
-v /home/ismael/documentos/persistencia_BD:/var/lib/mysql \
mariadb:10.10
```

![imagen3](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/3.png)

3. Creamos un contenedor con el programa **`Adminer`** que se conecte al contenedor de la BD.

```bash
docker run --name adminer_01 --network bdnet -p 8080:8080 \
-e ADMINER_DEFAULT_SERVER=base_datos adminer:4
```

 ![imagen4](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/4.png)

4. Comprobamos que los contenedores estén en ejecución.

```bash
docker ps -a
```

![imagen 9](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/9.png)

## Acceso a la interfaz Web Adminer

5. Accedemos a **`Adminer`** desde el navegador a través del puerto 8080 para conectarnos a la base de datos del contenedor **`mariaDB`** e iniciamos sesión con el usuario **`root`**.

![imagen5](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/5.png)

5. Creamos la BD **`Despliegue`** por medio de la interfaz web Adminer.

![imagen6](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/6.png)



![imagen7](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/7.png)



![imagen8](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/8.png)

6. Nos dirigimos a la ruta empleada para datos persistentes en el que se almacenan los datos generados por el contenedor del servidor de base de datos.

![imagen10](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/10.png)

## Borrado de contenedores, red y volúmenes

7. Procedemos a borrar los contenedores, la red y los volúmenes utilizados

Empezamos borrando los contenedores y luego comprobamos.

```bash
docker rm -f base_datos adminer_01
docker ps -a
```

![imagen11](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/11.png)

Borramos la red y comprobamos.

```bash
docker network rm bdnet
docker network ls
```

![imagen12](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/12.png)

Por ultimo comprobamos los volúmenes pendientes, es decir, los que no están enlazados con ningún contenedor y los borramos con **`prune`**. 

```bash
docker volume ls -f dangling=true
docker volume prune
docker volume ls
```

![imagen13](https://github.com/IsmaBM/Actividad3-Docker/blob/main/Ejercicio_2/imagenes_Ej2/13.png)
