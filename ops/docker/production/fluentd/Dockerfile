FROM fluent/fluentd:v0.12.43-debian

LABEL maintainer = "Ronie Vincent Horca <ronievincent.gss@gmail.com>"

RUN buildDeps="make gcc g++ libc-dev ruby-dev" \
	&& apt-get update -y \
	&& apt-get install --no-install-recommends $buildDeps \
    curl make libcurl4-gnutls-dev --yes --allow-unauthenticated build-essential ruby-dev

RUN curl -L https://toolbelt.treasuredata.com/sh/install-ubuntu-trusty-td-agent2.sh | sh && \
    gem install fluent-plugin-elasticsearch --no-rdoc --no-ri