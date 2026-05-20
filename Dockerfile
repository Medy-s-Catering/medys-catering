FROM php:8.2-apache

RUN apt-get update \
 && apt-get install -y --no-install-recommends libpq-dev postgresql-client \
 && docker-php-ext-install pdo pdo_pgsql pgsql \
 && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite headers

COPY docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html

ENV PORT=80
EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]
