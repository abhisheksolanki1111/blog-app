FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80
