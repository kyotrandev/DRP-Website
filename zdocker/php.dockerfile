FROM php:8.2-apache 


# Set the timezone
ENV TZ=Asia/Ho_Chi_Minh
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Enable mod_rewrite
RUN a2enmod rewrite
# Install necessary system dependencies
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        vim \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli zip \
    && pecl install redis \
    && docker-php-ext-enable redis pdo pdo_mysql mysqli

# Grant permission to apache user to write to the uploads directory
RUN mkdir -p /var/www/html/Public/uploads 
RUN chown -R www-data:www-data /var/www/html/Public/uploads && chmod -R +666 /var/www/html/Public/uploads


# Using composer for autoloading 
# Allow composer as superuser 
ENV COMPOSER_ALLOW_SUPERUSER = 1

# Obtain composer using multi-stage build 
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
RUN composer self-update

WORKDIR /var/www/html

# Copy composer files
COPY ./Web/composer.* ./

RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction
RUN composer dump-autoload --optimize

RUN if command -v a2enmod >/dev/null 2>&1; then \
        a2enmod rewrite headers \
    ;fi

EXPOSE 80 

