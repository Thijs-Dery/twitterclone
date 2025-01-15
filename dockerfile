# Stap 1: Gebruik PHP 8.2 als basis
FROM php:8.2-fpm

# Stap 2: Installeer systeemafhankelijkheden
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Stap 3: Installeer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Stap 4: Stel de werkdirectory in
WORKDIR /var/www/html

# Stap 5: Kopieer alle bestanden naar de container
COPY . .

# Stap 6: Installeer Laravel-dependencies
RUN composer install --no-dev --optimize-autoloader

# Stap 7: Zorg dat de opslag toegankelijk is
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# Stap 8: Exposeer de containerpoort
EXPOSE 9000

# Stap 9: Start de PHP-FPM server
CMD ["php-fpm"]
