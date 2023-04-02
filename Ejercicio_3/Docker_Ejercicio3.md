**Autor:** Ismael Fernando Brito Monar

# Actividad 3 - DOCKER

## Índice

[TOC]

## Ejercicio 3 - Imagen con Dockerfile

### Creando imagen con servidor web

1. Nos ubicamos en una carpeta donde añadiremos nuestro sitio web y crearemos el archivo Dockerfile con el siguiente código.

```dockerfile
FROM ubuntu:18.04
RUN apt-get update && apt-get install -y apache2
COPY miWeb /var/www/html
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
```

![imagen8](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\Ejercicio3\imagenes_EJ3\8.png)

![imagen9](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\Ejercicio3\imagenes_EJ3\9.png)

![imagen10](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\Ejercicio3\imagenes_EJ3\10.png)

2. Procedemos a crear la imagen de docker y comprobamos.

```bash
docker build -t ismabm/myapache2:v1 .
docker images
```

![imagen1](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\Ejercicio3\imagenes_EJ3\1.png)

![imagen2](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\Ejercicio3\imagenes_EJ3\2.png)

### Arrancando contendor

3. A continuación, iniciamos un contenedor con la imagen creada.

```bash
docker run -d -p 8080:80 --name servidor_web ismabm/myapache2:v1
```

![imagen3](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\Ejercicio3\imagenes_EJ3\3.png)

4. Nos vamos al navegador y accedemos a `localhost:8080` para ver el sitio web que servimos.

![imagen4](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\Ejercicio3\imagenes_EJ3\4.png)

### Subiendo imagen a Docker Hub

5. Ahora subiremos la imagen a `Docker Hub`, para ello haremos lo siguiente:

+ Hacemos login en `docker` desde la terminal.

```bash
docker login
```

![imagen5](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\Ejercicio3\imagenes_EJ3\5.png)

+ Una vez autenticados procedemos hacer un `push` para subir la imagen.

```bash
docker push ismabm/myapache2:v1
```

![imagen6](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\Ejercicio3\imagenes_EJ3\6.png)

+ Nos vamos la pagina de `Docker Hub` para ver nuestra imagen subida.

![imagen7](C:\Users\Ismael\Desktop\Distancia DAW\[DAW] Despliegue de aplicaciones Web\Tareas Entregables\2doParcial\Tarea3\Ejercicio3\imagenes_EJ3\7.png)