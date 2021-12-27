all: up exec

up:
	docker-compose up -d

exec:
	docker-compose exec php sh