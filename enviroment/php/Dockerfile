FROM php:7.3.14-fpm-alpine

RUN adduser -D uchatbot  \
&& chown -R uchatbot:uchatbot .


RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

COPY . /var/www/html/
WORKDIR /var/www/html/

# install dependencies
RUN composer install \
  && cp .env.example .env \
  && php artisan key:generate
  ## && php artisan migrate \
  ## && php artisan db:seed 

ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"
