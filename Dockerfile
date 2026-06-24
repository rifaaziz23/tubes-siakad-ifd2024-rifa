FROM dunglas/frankenphp:php8.4

RUN install-php-extensions
pdo_mysql
mbstring
exif
bcmath
gd
intl
zip

WORKDIR /app

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN apt-get update && apt-get install -y npm

RUN npm install
RUN npm run build

RUN mkdir -p storage/framework/cache
RUN mkdir -p storage/framework/sessions
RUN mkdir -p storage/framework/views

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
