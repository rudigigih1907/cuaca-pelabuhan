FROM php:8.2-fpm-alpine

# Install system dependencies and required PHP extension tools
RUN apk add --no-cache \
    icu-dev \
    libzip-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    oniguruma-dev \
    curl-dev \
    bash \
    git \
    unzip

# Configure and install PHP extensions required by CodeIgniter 4
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    intl \
    zip \
    pdo_mysql \
    mysqli \
    mbstring \
    curl \
    gd \
    opcache

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 9000
CMD ["php-fpm"]