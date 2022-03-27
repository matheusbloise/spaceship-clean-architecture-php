FROM matheusbloise/php:8.0-fpm-alpine-dev AS develop

ENV KERNEL_CLASS 'App\Infrastructure\Http\Kernel'

RUN install-php-extensions uuid pgsql pdo_pgsql

FROM matheusbloise/php:8.0-fpm-alpine-jit-prod AS production

ENV KERNEL_CLASS 'App\Infrastructure\Http\Kernel'

RUN echo "pm.status_path = /status" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "pm = dynamic" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "pm.max_children = 120" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "pm.start_servers = 36" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "pm.min_spare_servers = 15" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "pm.max_spare_servers = 50" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "pm.max_requests = 200" >> /usr/local/etc/php-fpm.d/www.conf && \
    install-php-extensions uuid pgsql pdo_pgsql