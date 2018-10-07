FROM wordpress:4.9.8-php7.1-apache
MAINTAINER "Timofey Drozhzhin <timofey@timofey.com>"

# php.ini
COPY php.ini /usr/local/etc/php/php.ini

# .htaccess
COPY .htaccess /var/www/html/

# WP Config
COPY wp-config.php /var/www/html/
# RUN chown nobody.nobody /var/www/html/wp-config.php && chmod 640 /var/www/html/wp-config.php
RUN chmod 400 /var/www/html/wp-config.php

# Build Environment specific, i.e. Production, Development, etc...
ARG BUILD_ENV=false
COPY init.sh /tmp/init.sh
RUN chmod +x /tmp/init.sh
RUN /tmp/init.sh