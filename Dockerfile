FROM alpine
COPY qemu-*-static /usr/bin/
LABEL maintainer="Jay MOULIN <jaymoulin@gmail.com> <https://twitter.com/MoulinJay>"

ENV PATH="/root:$PATH"

COPY bomreplacer.php /usr/bin/bomreplacer
WORKDIR /src
RUN apk add php7 php7-iconv php7-tokenizer php7-dom php7-mbstring --update --no-cache
VOLUME ['/src']

CMD [ "bomreplacer" ]
