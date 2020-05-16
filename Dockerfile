FROM library/php:7.2-alpine
LABEL maintainer="Joan Font <joanfont@gmail.com>"

WORKDIR /code/

RUN apk --update --no-cache add curl git zip unzip \
    && apk --update --no-cache --virtual .build-deps add ${PHPIZE_DEPS} \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps

ADD . /code/

ENTRYPOINT ["php"]
CMD ["-h"]
