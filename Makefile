#!/usr/bin/env make

ifndef PHP
	PHP_VERSION=8.0
endif

-include .env
export

default: bash

### Define PHP

qa_image=jakzal/phpqa:1.60.1
composer_args=--prefer-dist --no-progress --no-interaction --no-suggest

dockerized=docker run --init -it --rm \
	-u $(shell id -u):$(shell id -g) \
	-v $(shell pwd):/app \
	-w /app
qa=${dockerized} \
	-e COMPOSER_CACHE_DIR=/app/tmp/composer \
	${qa_image}

php_image=php:${PHP_VERSION}-alpine

php=${dockerized} \
	-e COMPOSER_CACHE_DIR=/app/tmp/var/composer \
	${php_image}

phpcs-psr1:
	${qa} phpcs --standard=PSR1 ./packages --ignore=*/spec/*

phpcs-psr2:
	${qa} phpcs --standard=PSR2 ./packages --ignore=*/spec/*

phpcbf-psr1:
	${qa} phpcbf --standard=PSR1 ./packages

phpcbf-psr2:
	${qa} phpcbf --standard=PSR2 ./packages

phpstan:
	${qa} phpstan analyse ./packages --level max

phpmd:
	${qa} phpmd . text codesize,unusedcode --exclude vendor/,tmp/

ecs:
	${qa} ecs check packages --config ecs.yaml

ecs-fix:
	${qa} ecs check packages --config ecs.yaml --fix

code-analysis:
	@make phpcs-psr1
	@make phpcs-psr2
	@make phpstan

code-fix:
	@make phpcbf-psr1
	@make phpcbf-psr2

php-mono-validate:
	${php} vendor/bin/monorepo-builder validate

php-mono-merge:
	${php} vendor/bin/monorepo-builder merge

php-phpspec:
	${qa} phpspec run

composer-install:
	${qa} composer install ${composer_args}

composer-update:
	${qa} composer update ${composer_args}

composer-update-lowest:
	${qa} composer update ${composer_args} --prefer-stable --prefer-lowest --ignore-platform-reqs