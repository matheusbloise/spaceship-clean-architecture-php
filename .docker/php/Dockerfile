FROM matheusbloise/php:8.0-fpm-alpine-dev AS develop

ENV KERNEL_CLASS 'App\Infrastructure\Http\Kernel'

FROM matheusbloise/php:8.0-fpm-alpine-jit-prod AS production

ADD prod/php-fpm/php-fpm.conf /usr/local/etc/php-fpm.d/

RUN install-php-extensions uuid pgsql pdo_pgsql