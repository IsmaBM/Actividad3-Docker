FROM ubuntu:18.04
RUN apt-get update && apt-get install -y apache2
COPY miWeb /var/www/html
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
