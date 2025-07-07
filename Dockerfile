# Gunakan image PHP 8.2 dengan FPM
FROM php:8.2-fpm

# Install ekstensi dan dependensi
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libxml2-dev libzip-dev \
    libcurl4-openssl-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libpq-dev libsqlite3-dev libonig-dev libssl-dev

# Install PHP extension Laravel butuhkan
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Atur working directory
WORKDIR /var/www

# Copy semua file proyek
COPY . .

# Install dependensi Laravel
RUN composer install --no-dev --optimize-autoloader

# Jalankan Laravel di port yang disediakan Railway
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=${PORT}"]