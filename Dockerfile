# Instalar las dependeicas de composer
FROM php:8.2-cli-alpine as builder
WORKDIR /var/www/html
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions
RUN install-php-extensions gd pdo pdo_pgsql pgsql mbstring readline redis xml imap pcntl sodium zip exif && \
    docker-php-ext-enable gd imap pdo_pgsql pgsql redis sodium
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
COPY . .
RUN composer install --no-scripts --no-dev -o

# Instalar las dependencias de nodejs
FROM node:lts-alpine as front
WORKDIR /var/www/html
COPY . .
RUN yarn install && yarn build

# Use the official PHP 8.2 FPM image from the dockerhub
FROM php:8.2-fpm-alpine as runner
LABEL maintainer="Oscar Reyes"
WORKDIR /var/www/html
# COPY docker/php.ini /usr/local/etc/php/conf.d/99-sail.ini
ENV TZ=America/Bogota
ENV NODE_ENV=production
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Download script to install PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Make script executable
RUN chmod +x /usr/local/bin/install-php-extensions

# Install PHP extensions and enable them
RUN install-php-extensions gd pdo pdo_pgsql pgsql mbstring readline redis xml imap pcntl sodium zip exif && \
    docker-php-ext-enable gd imap pdo_pgsql pgsql redis sodium
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY --from=builder /var/www/html ./
COPY --from=front /var/www/html/node_modules ./node_modules
COPY --from=front /var/www/html/public ./public
# We want to cache the event, routes, and views so we don't try to write them when we are in Kubernetes.
# Docker builds should be as immutable as possible, and this removes a lot of the writing of the live application.
#RUN php artisan event:cache && \
    # php artisan route:cache && \
#    php artisan view:cache

EXPOSE 9000

# ENTRYPOINT ["start-container"]