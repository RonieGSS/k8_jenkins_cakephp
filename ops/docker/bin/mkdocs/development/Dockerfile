FROM alpine:3.7
LABEL maintainer="Ronie Vincent Horca <ronievincent.gss@gmail.com>"
RUN apk add --update \
    python \
    python-dev \
    py-pip \
    build-base \
  && pip install --upgrade pip \
  	virtualenv \
  	mkdocs \
  	mkdocs-cinder \
  	--upgrade mkdocs-cinder \
  	mkdocs-material \
    mkdocs-psinder \
  && rm -rf /var/cache/apk/*

WORKDIR mkdocs

ENTRYPOINT ["mkdocs"]
CMD ["serve","--dev-addr=0.0.0.0:8000"]
EXPOSE 8000