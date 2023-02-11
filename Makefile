# Makes sure that targets are not treated as physical files
.PHONY: help build

#VERSION = $(shell grep -m 1 version package.json | awk '{print $$2}' | sed s/[\",]//g)
#DIRNAME=$(shell dirname ${PWD}/Makefile)
DIRNAME=$(shell basename ${PWD})

CONTAINER_NGINX=${DIRNAME}-nginx-1
CONTAINER_PHP=${DIRNAME}-laravel-1
CONTAINER_NODE=${DIRNAME}-vite-1
CONTAINER_DATABASE=${DIRNAME}-mariadb-1
CONTAINER_ARTISAN=${DIRNAME}-artisan-1
CONTAINER_COMPOSER=${DIRNAME}-composer-1

VOLUME_DATABASE=${DIRNAME}_db_data

print-help: help

build: ## Build all container images
	@docker compose build --no-cache;

destroy: stop ## Stops containers and removes named volumes
	@docker rm -vf ${CONTAINER_PHP} && \
	@docker rm -vf ${CONTAINER_NODE} && \
	@docker rm -vf ${CONTAINER_DATABASE};

down: stop ## Tears down all the service containers
	@docker compose down;

fresh: destroy build start ## Destroys, rebuilds and restarts all services

help: ## Print this menu
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST);

logs: ## Print logs for all running services
	@docker compose logs -f

mariadb: ## Access the mariadb console
	@docker exec -it ${CONTAINER_DATABASE} sh -c "mariadb -u laravel -plaravel laravel"

migrate: ## Runs all database migrations
	@docker compose run --rm artisan migrate

migrate-fresh: ## Flushes database and re-runs all migrations
	@docker compose run --rm artisan migrate:fresh

npm-build: ## Build frontend assets
	@docker compose run --rm ${CONTAINER_NODE} run build

npm-install: ## Install frontend assets
	@docker compose run --rm ${CONTAINER_NODE} install

ps: ## Show status for all running containers
	@docker compose ps

restart: stop start ## Restart services

start: ## Start the Laravel application server, database and Vite for HMR
	@docker compose up -d nginx

stop: ## Stop all services
	@docker compose stop

tinker: ## Runs Laravel tinker
	@docker compose run --rm artisan tinker

