FROM matheusbloise/php:8.0-fpm-alpine-dev

ARG DB_TEST
ENV DB_TEST $DB_TEST
ENV KERNEL_CLASS 'App\Infrastructure\Http\Kernel'

RUN install-php-extensions uuid pgsql pdo_pgsql