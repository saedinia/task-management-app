# Use the official PHP 8.2 image with necessary extensions
FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    vim \
    curl \
    libonig-dev \
    libxml2-dev \
    openssl \
    bash \
    libpq-dev

# Install the pdo_pgsql extension
RUN docker-php-ext-install pdo pdo_pgsql

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create and change to the app directory
WORKDIR /var/www

# Copy the app files
COPY . .

# Set COMPOSER_ALLOW_SUPERUSER to 1
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install Composer dependencies
RUN composer install

# Expose the port the app runs on
EXPOSE 8000

# Run database migrations and start the Symfony server
CMD php bin/console doctrine:migrations:migrate --no-interaction && symfony server:start --no-tls --port=8000 --dir=public
