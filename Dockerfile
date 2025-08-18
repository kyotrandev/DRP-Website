FROM php:8.2-apache

# Set timezone
ENV TZ=Asia/Ho_Chi_Minh
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Enable Apache mods
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

# Set working directory
WORKDIR /var/www/html

# Copy composer files first (for caching)
COPY ./Web/composer.* ./

RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction \
    && composer dump-autoload --optimize

# Copy the rest of the application
COPY ./Web /var/www/html

# Create uploads & log folders with proper permissions
RUN mkdir -p /var/www/html/Public/uploads /var/www/html/Journal \
    && touch /var/www/html/Journal/{database-related.log,exceptions.log,errors.log} \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/Public/uploads /var/www/html/Journal

EXPOSE 80
CMD ["apache2-foreground"]
