PHP_SERVICE := app
NGINX_SERVICE := nginx
DB_SERVICE := db
COMPOSE := docker compose

.PHONY: up down restart logs app logs-app logs-nginx logs-db shell db-shell composer-install composer-update install build ps

up:
	$(COMPOSE) up -d --build

down:
	$(COMPOSE) down

restart:
	$(COMPOSE) restart

build:
	$(COMPOSE) build

ps:
	$(COMPOSE) ps

logs:
	$(COMPOSE) logs -f

logs-app:
	$(COMPOSE) logs -f $(PHP_SERVICE)

logs-nginx:
	$(COMPOSE) logs -f $(NGINX_SERVICE)

logs-db:
	$(COMPOSE) logs -f $(DB_SERVICE)

shell:
	$(COMPOSE) exec $(PHP_SERVICE) sh

db-shell:
	$(COMPOSE) exec $(DB_SERVICE) mysql -u appuser -p appuser

composer-install:
	$(COMPOSE) exec $(PHP_SERVICE) composer install

composer-update:
	$(COMPOSE) exec $(PHP_SERVICE) composer update

install: up

