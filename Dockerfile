FROM php:7.2-apache

ARG CAKEPHP_VERSION=2.10.24
ENV APACHE_DOCUMENT_ROOT=/var/www/html/app/webroot

RUN printf '%s\n' \
      'deb http://archive.debian.org/debian buster main contrib non-free' \
      'deb http://archive.debian.org/debian-security buster/updates main contrib non-free' \
      > /etc/apt/sources.list \
    && printf '%s\n' \
      'Acquire::Check-Valid-Until "false";' \
      > /etc/apt/apt.conf.d/99archive \
    && apt-get update \
    && apt-get install -y --no-install-recommends curl unzip \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && a2enmod rewrite \
    && sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" \
        /etc/apache2/sites-available/*.conf \
        /etc/apache2/apache2.conf \
        /etc/apache2/conf-available/*.conf \
    && sed -ri '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /tmp
RUN curl -fsSL "https://github.com/cakephp/cakephp/archive/refs/tags/${CAKEPHP_VERSION}.tar.gz" -o cakephp.tar.gz \
    && mkdir -p /var/www/html \
    && tar -xzf cakephp.tar.gz --strip-components=1 -C /var/www/html \
    && rm -f cakephp.tar.gz

WORKDIR /var/www/html
COPY app/ /var/www/html/app/
COPY docker/entrypoint.sh /usr/local/bin/app-entrypoint.sh

RUN chmod +x /usr/local/bin/app-entrypoint.sh \
    && mkdir -p app/tmp/cache/models app/tmp/cache/persistent app/tmp/cache/views app/tmp/logs app/tmp/sessions app/tmp/tests \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 777 app/tmp

ENTRYPOINT ["/usr/local/bin/app-entrypoint.sh"]
CMD ["apache2-foreground"]