# Stap 1: Gebruik PHP 8.2 als basis
FROM php:8.2-fpm

# Stap 2: Installeer systeemafhankelijkheden en configureer PHP
RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    nano \
    procps \
    net-tools \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd mysqli \
    && apt-get clean

# Stap 3: Installeer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Stap 4: Stel de werkdirectory in
WORKDIR /var/www/html

# Stap 5: Kopieer de bestanden naar de container
COPY . .

# Stap 6: Installeer Laravel-afhankelijkheden
RUN composer install --no-dev --optimize-autoloader

# Stap 7: Stel bestandsrechten in
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# Stap 8: Configureer Nginx
RUN rm /etc/nginx/sites-enabled/default
COPY ./nginx/default /etc/nginx/sites-available/default
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Stap 9: Exposeer de nodige poorten
EXPOSE 80

# Stap 10: Start zowel Nginx als PHP-FPM met supervisord
RUN apt-get install -y supervisor && mkdir -p /var/log/supervisor
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

CMD ["supervisord", "-n"]
