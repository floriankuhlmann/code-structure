# Dockerfile
FROM php:7.2-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

RUN apt-get install apt-transport-https ca-certificates curl software-properties-common
RUN curl -fsSL https://download.docker.com/linux/ubuntu/gpg | apt-key add –

RUN add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu  $(lsb_release -cs)  stable"

RUN apt-get install docker-ce

RUN systemctl start docker

WORKDIR /app
COPY . /app

RUN composer install
