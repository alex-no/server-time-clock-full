FROM php:8.3-cli

# Установим зависимости
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    mc\
    && rm -rf /var/lib/apt/lists/*

# Установим Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установим PHPUnit (опционально, можно и через composer require --dev)
RUN composer global require phpunit/phpunit

WORKDIR /app
