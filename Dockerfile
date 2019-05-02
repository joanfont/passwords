FROM library/php:7.2-alpine
LABEL maintainer="Joan Font <joanfont@gmail.com>"

WORKDIR /code/

RUN apk --update --no-cache add curl git zip unzip

ADD . /code/

ENTRYPOINT ["php"]
CMD ["-h"]
