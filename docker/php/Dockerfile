FROM php:7.4.33-fpm

# Ganti repository Debian ke archive mirror agar paket EOL/lama tetap terdeteksi
RUN sed -i 's/deb.debian.org/archive.debian.org/g' /etc/apt/sources.list && \
    sed -i 's/security.debian.org/archive.debian.org/g' /etc/apt/sources.list && \
    sed -i '/debian-security/d' /etc/apt/sources.list

# Install dependency dan ekstensi PHP
RUN apt-get update --allow-insecure-repositories || true && \
    apt-get install -y --no-install-recommends \
    libicu-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) intl pdo_mysql gd mysqli \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html