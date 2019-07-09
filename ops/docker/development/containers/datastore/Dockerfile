FROM busybox:latest

VOLUME /var/lib/mysql
VOLUME /data
VOLUME /usr/src/app/public
VOLUME /usr/src/app/log
RUN mkdir -p /image && chmod 0777 /image
VOLUME /image

CMD /bin/sh
