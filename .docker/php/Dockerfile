FROM matheusbloise/php:8.0-fpm-alpine-dev AS develop

ENV KERNEL_CLASS 'App\Infrastructure\Http\Kernel'

RUN install-php-extensions uuid pgsql pdo_pgsql

FROM matheusbloise/php:8.0-fpm-alpine-jit-prod AS production

ENV KERNEL_CLASS 'App\Infrastructure\Http\Kernel'

RUN echo pm.status_path = /status >> /usr/local/etc/php-fpm.d/www.conf \
    && install-php-extensions uuid pgsql pdo_pgsql