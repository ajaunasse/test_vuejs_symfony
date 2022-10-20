.PHONY: help
.DEFAULT_GOAL = help
include .env
export

dc = docker-compose
de = $(dc) exec
php = php
SF = $(EXEC_PHP) bin/console
npm = npm
composer = $(de) php memory_limit=1 /usr/local/bin/composer

## —— Docker 🐳  ———————————————————————————————————————————————————————————————


## —— Php and Node internal server ———————————————————————————————————————————————————————————————
.PHONY: install
install:
	composer install --no-interaction
	$(SF) doctrine:database:create --if-not-exists --no-interaction
	$(SF) doctrine:migration:migrate --no-interaction
	$(SF) doctrine:fixture:load --no-interaction
	cd front && $(npm) install

.PHONY: start-backend
start-backend:
	php -S 127.0.0.1:$(VITE_API_BACKEND_PORT) public/index.php

.PHONY: start-front
start-front:
	cd front && $(npm) run dev

php_cs-fix:
	vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php

test:
	vendor/bin/phpunit