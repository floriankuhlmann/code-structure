# Dockerfile
FROM php:7.4-cli

RUN apt-get update -y && \
    # apt-get -qy full-upgrade && \
    apt-get install -y libmcrypt-dev && \
    apt-get install git -y && \
    apt-get install zip -y

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app

RUN composer -V

RUN composer install --prefer-dist

RUN ls -lsa -R vendor/bin

RUN ./vendor/bin/phpunit --version
RUN ./vendor/bin/phpunit ./tests
ENTRYPOINT ["phpunit","--version"]