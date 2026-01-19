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

#Keep cache small
RUN rm -rf /var/lib/apt/lists/*


# Install any additional PHP extensions if needed
# RUN apt-get update && apt-get install -y \
#     php8.1-mbstring \

# Default command (inherited from base image)
CMD ["apache2-foreground"]
