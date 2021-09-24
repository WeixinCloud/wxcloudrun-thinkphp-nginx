FROM php:7.3-apache

RUN mkdir /app
WORKDIR /app

COPY . /app/

CMD ["php", "think", "run"]
