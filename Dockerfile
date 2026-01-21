FROM mediawiki:1.45.1

# Copy extensions into the image
COPY extensions/ /var/www/html/extensions/

# Copy skins into the image
COPY skins/ /var/www/html/skins/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/extensions /var/www/html/skins

RUN apt-get update

RUN apt-get install -y default-mysql-client

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# PHP Zip & .7z support support
RUN apt-get install -y \
    libzip-dev \
    unzip \
    p7zip-full \
    && docker-php-ext-install zip

#Keep cache small
RUN rm -rf /var/lib/apt/lists/*

# Update composer stuff
WORKDIR /var/www/html

RUN composer update --no-interaction

COPY ./scripts/patches.sh /var/www/html/patches.sh
RUN chmod +x /var/www/html/patches.sh
RUN /var/www/html/patches.sh

# Default command (inherited from base image)
CMD ["apache2-foreground"]
