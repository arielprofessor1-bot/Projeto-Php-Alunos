
FROM php:8.2-apache

RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf \
    && sed -i 's/<VirtualHost \*:80>/<VirtualHost *:10000>/' /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/

RUN printf '<Directory "/var/www/html/includes">\nRequire all denied\n</Directory>\n<Directory "/var/www/html/Dados dos Usuarios">\nRequire all denied\n</Directory>\n' \
    > /etc/apache2/conf-available/protect-private.conf \
    && a2enconf protect-private

EXPOSE 10000

CMD ["apache2-foreground"]
