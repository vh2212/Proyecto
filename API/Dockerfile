FROM php:7.0-apache
LABEL Name="API"
COPY . /var/www/html
WORKDIR /
RUN apt-get update
RUN apt-get install nano
EXPOSE 80
