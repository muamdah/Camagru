FROM php:7.2.8-apache 
RUN apt-get update
RUN docker-php-ext-install pdo_mysql
RUN apt-get install -y ssmtp
RUN echo "mailhub=mail" >> /etc/ssmtp/ssmtp.conf
RUN echo "FromLineOverride=YES" >> /etc/ssmtp/ssmtp.conf
RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini
RUN apt-get update && apt-get install --no-install-recommends --assume-yes --quiet\
    ca-certificates\
	curl\
	git\
	libpng-dev\
	libfreetype6-dev\
	libjpeg62-turbo-dev
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj "/C=FR/ST=IDF/O=42/OU=Project-Camagru/CN=192.168.99.100" -keyout /etc/ssl/private/apache-selfsigned.key -out /etc/ssl/certs/apache-selfsigned.crt
COPY ./conf/ssl/ssl-params.conf /etc/apache2/conf-available/ssl-params.conf
COPY ./conf/ssl/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
COPY ./conf/ssl/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod ssl
RUN a2enmod headers
RUN a2ensite default-ssl
RUN a2enconf ssl-params
