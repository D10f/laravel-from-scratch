# Makes sure that targets are not treated as physical files
.PHONY: help build

#VERSION = $(shell grep -m 1 version package.json | awk '{print $$2}' | sed s/[\",]//g)
#DIRNAME=$(shell dirname ${PWD}/Makefile)
DIRNAME=$(shell basename ${PWD})

CONTAINER_NGINX=${DIRNAME}_nginx-1
CONTAINER_PHP=${DIRNAME}_laravel-1
CONTAINER_NODE=${DIRNAME}_vite-1
CONTAINER_DATABASE=${DIRNAME}_mariadb-1
CONTAINER_ARTISAN=${DIRNAME}_artisan-1
CONTAINER_COMPOSER=${DIRNAME}_composer-1

VOLUME_DATABASE=${DIRNAME}_db_data

print-help: help


build: ## Build all container images
	@docker compose build --no-cache;

destroy: stop ## Stops containers and removes named volumes
	docker rm -vf ${CONTAINER_PHP} && \
	docker rm -vf ${CONTAINER_NODE} && \
	docker rm -vf ${CONTAINER_DATABASE};

fresh: destroy build start ## Destroys, rebuilds and restarts all services

help: ## Print this menu
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST);

logs: ## Print logs for all running services
	@docker compose logs -f

npm-build: ## Build frontend assets
	@docker compose run --rm ${CONTAINER_NODE} run build

npm-install: ## Install frontend assets
	@docker compose run --rm ${CONTAINER_NODE} install

ps: ## Show status for all running containers
	@docker compose ps;

restart: ## Restart services
	@stop start;

start: ## Start the Laravel application server, database and Vite for HMR
	@docker compose up -d nginx;

stop: ## Stop all services
	@docker compose stop;

