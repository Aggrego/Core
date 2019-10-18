#!/usr/bin/env make

-include .env
export

default: bash

phpcs-psr1:
	docker run --init -it --rm -v $(PWD):/project -v $(PWD)/tmp:/tmp -w /project jakzal/phpqa phpcs --standard=PSR1 ./packages --ignore=*/spec/*

phpcs-psr2:
	docker run --init -it --rm -v $(PWD):/project -v $(PWD)/tmp:/tmp -w /project jakzal/phpqa phpcs --standard=PSR2 ./packages --ignore=*/spec/*

phpcbf-psr1:
	docker run --init -it --rm -v $(PWD):/project -v $(PWD)/tmp:/tmp -w /project jakzal/phpqa phpcbf --standard=PSR1 ./packages

phpcbf-psr2:
	docker run --init -it --rm -v $(PWD):/project -v $(PWD)/tmp:/tmp -w /project jakzal/phpqa phpcbf --standard=PSR2 ./packages

phpstan:
	docker run --init -it --rm -v $(PWD):/project -v $(PWD)/tmp:/tmp -w /project jakzal/phpqa phpstan analyse ./packages --level max

phpmd:
	docker run --init -it --rm -v $(PWD):/project -v $(PWD)/tmp:/tmp -w /project jakzal/phpqa phpmd . text codesize,unusedcode --exclude vendor/,tmp/

ecs:
	docker run --init -it --rm -v $(PWD):/project -v $(PWD)/tmp:/tmp -w /project jakzal/phpqa ecs check packages --config ecs.yaml

ecs-fix:
	docker run --init -it --rm -v $(PWD):/project -v $(PWD)/tmp:/tmp -w /project jakzal/phpqa ecs check packages --config ecs.yaml --fix

code-analysis:
	@make phpcs-psr1
	@make phpcs-psr2
	@make phpstan
	@make ecs

code-fix:
	@make phpcbf-psr1
	@make phpcbf-psr2
	@make ecs-fix