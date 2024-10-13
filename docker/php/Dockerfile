# Use the official PHP image with necessary extensions
FROM php:8.2-fpm

# Install dependencies, including PostgreSQL driver
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql pgsql pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . /var/www

# Install Laravel dependencies
RUN composer install --prefer-dist --no-scripts --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www

CMD ["php-fpm"]
