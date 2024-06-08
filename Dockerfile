# Use the official PHP image from the Docker Hub
FROM php:8.1-apache

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Enable the Apache mod_rewrite module
RUN a2enmod rewrite

# Expose port 80 to the outside world
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
