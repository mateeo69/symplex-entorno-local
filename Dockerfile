FROM php:8.3-apache

RUN apt-get update && apt-get install -y git unzip zip libzip-dev msmtp msmtp-mta \
    && docker-php-ext-install zip mysqli pdo pdo_mysql \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN ln -sf /usr/bin/msmtp /usr/sbin/sendmail

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf && \
    sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY ./src/composer.json ./composer.json
COPY ./src/composer.lock ./composer.lock

# Copia el resto de la app antes de correr composer en entrypoint
COPY ./src/ /var/www/html/

COPY mailhog.ini /usr/local/etc/php/conf.d/mailhog.ini
COPY msmtp.conf /etc/msmtprc
RUN chmod 600 /etc/msmtprc

# Copiar y dar permisos al entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]
