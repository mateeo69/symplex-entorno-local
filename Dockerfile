FROM php:8.3-apache

# Install necessary packages and PHP extensions
RUN apt-get update && apt-get install -y git unzip zip libzip-dev msmtp msmtp-mta \
    && docker-php-ext-install zip mysqli pdo pdo_mysql \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Link msmtp to sendmail for mail sending
RUN ln -sf /usr/bin/msmtp /usr/sbin/sendmail

# Change Apache DocumentRoot to /var/www/html/public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf && \
    sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first (for caching)
COPY composer.json composer.lock* /var/www/html/

# Install Stripe PHP SDK
RUN composer require stripe/stripe-php #

# Run composer install, which creates vendor/
RUN composer install --no-dev --optimize-autoloader

# Then copy the rest of the app files
COPY ./src/ /var/www/html/

# Copy mailhog.ini and msmtp config, set permissions
COPY mailhog.ini /usr/local/etc/php/conf.d/mailhog.ini
COPY msmtp.conf /etc/msmtprc
RUN chmod 600 /etc/msmtprc

EXPOSE 80
