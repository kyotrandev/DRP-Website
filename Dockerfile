FROM php:8.2-apache

# Set timezone
ENV TZ=Asia/Ho_Chi_Minh
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Enable Apache modules
RUN a2enmod rewrite headers

# Install system dependencies
RUN apt-get update \
    && apt-get install -y unzip libzip-dev vim \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip \
    && pecl install redis \
    && docker-php-ext-enable redis pdo pdo_mysql

# Composer setup
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Working dir
WORKDIR /var/www/html

# Copy composer files and install deps
COPY ./Web/composer.* ./
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction \
    && composer dump-autoload --optimize

# Copy full project
COPY ./Web /var/www/html

# Fix Apache DocumentRoot to /var/www/html/Public
RUN sed -ri -e 's!/var/www/html!/var/www/html/Public!g' \
    /etc/apache2/sites-available/000-default.conf \
    /etc/apache2/sites-available/default-ssl.conf

# Create uploads & log folders with correct permissions
RUN mkdir -p /var/www/html/Public/uploads /var/www/html/Journal \
    && touch /var/www/html/Journal/{database-related.log,exceptions.log,errors.log} \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/Public/uploads /var/www/html/Journal

EXPOSE 80
CMD ["apache2-foreground"]
