init:
	docker-compose up -d
	$(MAKE) install-dependencies
	$(MAKE) migrate-db

up: ## Up all services
	docker-compose up -d
	$(MAKE) migrate-db

down: ## Down all services
	docker-compose down

terminal: ## Enter the shell of php container
	docker exec -it blog.api bash

test: ## Run test suites
	docker exec blog.api ./vendor/bin/phpunit --configuration /app/phpunit.xml.dist

install-dependencies:
	docker exec blog.api composer install

migrate-db: wait-mysql-connection
	docker exec blog.api ./vendor/bin/doctrine-migrations migrate

wait-mysql-connection: ## Wait for MySql to be ready
	docker-compose run blog-api ./bin/wait-mysql-connection


