install:
	docker-compose run --rm composer

test:
	docker-compose run --rm --entrypoint=php php vendor/bin/phpunit tests
