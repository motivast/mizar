FROM php:7.1.2-fpm

# Install Mcrypt extension
RUN apt-get update \
	&& apt-get install -y libmcrypt-dev \
    && docker-php-ext-install mcrypt

# Install MySQL extension
RUN apt-get update \
	&& apt-get install -y mysql-client \
    && docker-php-ext-install mysqli

# Install ImageMagick extension
RUN apt-get update \
	&& apt-get install -y libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash - \
	&& apt-get install nodejs
