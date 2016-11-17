.PHONY: help tests update bootstrap
.DEFAULT_GOAL := help

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-12s\033[0m %s\n", $$1, $$2}'

tests: ## Execute test suite and create code coverage report
	./scripts/phpunit

update: ## Update composer packages
	./scripts/composer update

bootstrap: ## Install composer
	./scripts/install-composer.sh && ./scripts/composer install
