all: down up install exec

up:
	@docker-compose up -d --build

down:
	@docker-compose down

exec:
	@docker-compose exec php sh

install:
	@docker-compose exec php composer install

prepare-for-production:
	@docker-compose -f docker-compose-cloud.yaml up -d --build
	@docker-compose -f docker-compose-cloud.yaml exec php composer install --no-dev --optimize-autoloader
	@docker-compose -f docker-compose-cloud.yaml exec php php bin/console cache:warmup