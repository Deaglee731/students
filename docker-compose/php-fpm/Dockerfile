FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
            git \
            curl \
            libpng-dev \
            libonig-dev \
            libxml2-dev \
            zip \
            unzip

RUN apt-get update && apt-get install -y default-mysql-client && rm -rf /var/lib/apt

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

# ADD php.ini /usr/local/etc/php/conf.d/php.ini

WORKDIR /var/www

CMD ["php-fpm"]
