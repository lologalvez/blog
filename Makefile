up: ## Up all services
	docker-compose up -d

down: ## Down all services
	docker-compose down

terminal: ## Enter the shell of php container
	docker exec -it blog.api bash

test: ## Run test suites
	docker exec blog.api ./bin/phpunit --configuration /app/phpunit.xml.dist

install-dependencies:
	docker exec blog.api composer install
