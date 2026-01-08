FROM mediawiki:1.45.1

# Copy extensions into the image
COPY extensions/ /var/www/html/extensions/

# Copy skins into the image
COPY skins/ /var/www/html/skins/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/extensions /var/www/html/skins

# Install any additional PHP extensions if needed
# RUN apt-get update && apt-get install -y \
#     php8.1-mbstring \
#     && rm -rf /var/lib/apt/lists/*

# Default command (inherited from base image)
CMD ["apache2-foreground"]
