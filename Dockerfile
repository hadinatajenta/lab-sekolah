FROM php:8.3.6 

RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libonig-dev \      
    libpq-dev   \
    libmysqlclient-dev    

RUN docker-php-ext-install pdo mbstring

WORKDIR /app
COPY . /app
CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000
