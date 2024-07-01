FROM php:8.2-cli

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

RUN docker-php-ext-install pdo pdo_pgsql

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Set COMPOSER_ALLOW_SUPERUSER to 1
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install Composer dependencies
RUN composer install

EXPOSE 8000

# Stop any running Symfony server and start a new one
CMD ["bash", "-c", "symfony server:stop && symfony server:start --no-tls --port=8000 --dir=public"]
