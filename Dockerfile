# Base image with PHP and Apache
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd
RUN a2enmod rewrite


# Install Composer
COPY . /var/www/html
# Copy the composer.json and composer.lock files to the container

# Install project dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-plugins --no-scripts 

# Generate optimized autoloader
RUN composer dump-autoload --optimize
# Copy the rest of the project files to the container

# Generate the application key
RUN php artisan key:generate
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

RUN echo "    <Directory /var/www/html/public>\n        AllowOverride All\n    </Directory>" >> /etc/apache2/sites-available/000-default.conf

#RUN php artisan migrate
#RUN php artisan serve

# Set the required permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Expose the container port
EXPOSE 80

# Start the Apache web server
CMD ["apache2-foreground"]

