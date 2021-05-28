FROM php:7-alpine

WORKDIR /var/www

COPY . .

ENV docker="true"

EXPOSE 8080

ENTRYPOINT ["sh", "docker-entrypoint.sh"]
