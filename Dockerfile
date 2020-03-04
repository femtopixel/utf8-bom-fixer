FROM alpine
COPY qemu-*-static /usr/bin/
LABEL maintainer="Jay MOULIN <https://jaymoulin.me/femtopixel/utf-bom-fixer> <https://twitter.com/MoulinJay>"

ENV PATH="/root:$PATH"

COPY bomreplacer.php /usr/bin/bomreplacer
WORKDIR /src
RUN apk add php7 --update --no-cache
VOLUME ['/src']

CMD [ "bomreplacer" ]
