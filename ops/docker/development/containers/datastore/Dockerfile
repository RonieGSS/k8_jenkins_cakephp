FROM busybox:latest

VOLUME /var/lib/mysql
VOLUME /data
VOLUME /usr/src/app/public
VOLUME /usr/src/app/log
# 画像ファイル保存用。www-dataユーザーが書き込み可能に設定
RUN mkdir -p /image && chmod 0777 /image
VOLUME /image

CMD /bin/sh
