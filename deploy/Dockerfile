FROM php:8.2-apache
WORKDIR /var/www/html
EXPOSE 80

RUN apt-get update && apt-get install -y \
  git \
  unzip \
  zip \
  libpng-dev \
  libjpeg62-turbo-dev \
  libfreetype6-dev \
  libexif-dev \
  ffmpeg \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd exif pdo_mysql bcmath

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# PHP initial configuration
RUN echo "upload_max_filesize=1024M\npost_max_size=1024M\nmax_execution_time=300\nmax_input_time=300\nmemory_limit=2048M" > /usr/local/etc/php/conf.d/uploads.ini
RUN echo "LimitRequestBody 1073741824" >> /etc/apache2/apache2.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .
RUN chown -R www-data:www-data storage bootstrap/cache
RUN composer install --no-dev --optimize-autoloader  -vvv

# Create temp folder and set permissions AFTER copying files
RUN mkdir -p /var/www/html/public/temp
RUN chown -R www-data:www-data /var/www/html/public/temp
RUN chmod -R 755 /var/www/html/public/temp

# FIX: CSRF token mismatch 
# https://laracasts.com/discuss/channels/laravel/laravel-session-cookie-is-not-set?page=1&replyId=612409
RUN echo "output_buffering=16384" > /usr/local/etc/php/conf.d/buffer.ini
