FROM debian:jessie

MAINTAINER Miljana Mihaldzic <miljana.mihaldzic@elfak.rs>

RUN apt-get update && apt-get install -y \
    apache2

ADD apache-app.conf /etc/apache2/conf-available/
ADD app.conf /etc/apache2/sites-available/

RUN a2enconf apache-app
RUN a2enmod proxy proxy_fcgi
RUN a2enmod rewrite
RUN a2ensite app.conf
RUN a2dissite 000-default.conf
RUN a2dissite default-ssl.conf

RUN usermod -u 1000 www-data

EXPOSE 80
EXPOSE 443

CMD ["apachectl", "-D", "FOREGROUND"]
