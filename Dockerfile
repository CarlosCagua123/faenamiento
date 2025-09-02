# Imagen con Nginx + PHP-FPM lista para Laravel
FROM richarvey/nginx-php-fpm:1.7.2

# Carpeta de trabajo
WORKDIR /var/www/html

# Copiamos el código
COPY . .

# Variables base para la imagen
ENV SKIP_COMPOSER=1 \
    WEBROOT=/var/www/html/public \
    PHP_ERRORS_STDERR=1 \
    RUN_SCRIPTS=1 \
    REAL_IP_HEADER=1 \
    APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    COMPOSER_ALLOW_SUPERUSER=1

# Nginx site
COPY conf/nginx/nginx-site.conf /etc/nginx/sites-enabled/default

# Script de despliegue
COPY scripts/00-laravel-deploy.sh /opt/docker/provision/entrypoint.d/00-laravel-deploy.sh
RUN chmod +x /opt/docker/provision/entrypoint.d/00-laravel-deploy.sh

# Entrypoint del contenedor
CMD ["/start.sh"]
