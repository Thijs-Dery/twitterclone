FROM php:8.2-fpm

# Install dependencies
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

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Ensure storage and cache directories exist
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache

# Set permissions safely
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# Remove default Nginx configuration
RUN rm -f /etc/nginx/sites-enabled/default

# Copy custom Nginx configuration
COPY ./nginx/default /etc/nginx/sites-available/default
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Expose port
EXPOSE 80

# Start application
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=80
