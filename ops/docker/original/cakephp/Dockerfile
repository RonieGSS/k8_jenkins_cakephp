FROM php:7.1.5-apache
LABEL maintainer="Ronie Vincent Horca <ronievincent.gss@gmail.com>"
# Set composer and smtp ENV variables
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_NO_INTERACTION=1 \
    ENV_SMTP_SERVER_HOST=mailcatcher
# Install dependencies including smtp
RUN apt-get update \
    && apt-get install -y zlib1g-dev \
    git \
    python \
    libmcrypt-dev \
    vim \
    expect \
    libpng-dev \
    libjpeg-dev \
    libicu-dev \
    libapache2-mod-xsendfile \
    ssh-client \
    ssmtp \
    zip \
    && docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr \
    && docker-php-ext-install pdo_mysql \
    mysqli \
    mbstring \
    zip \
    mcrypt \
    intl \
    exif \
    gd \
    && echo "sendmail_path = /usr/sbin/ssmtp -t" > /usr/local/etc/php/conf.d/sendmail.ini \
    && echo "mailhub=mailcatcher:25\nUseTLS=NO\nFromLineOverride=YES" > /etc/ssmtp/ssmtp.conf
# Copy bash.bashrc file inside /etc/ dir
COPY bash.bashrc /etc/bash.bashrc
# Modify route and permission
RUN a2enmod rewrite \
    && usermod -u 1000 www-data
# Copy apache and php configuration files inside container
COPY apache2.conf /etc/apache2/apache2.conf
COPY 000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY php.ini /usr/local/etc/php/php.ini
RUN /bin/cp -f /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

WORKDIR /bin
# Install composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer global require hirak/prestissimo
# Change directory to /var/www/html
WORKDIR /var/www/html
EXPOSE 80

