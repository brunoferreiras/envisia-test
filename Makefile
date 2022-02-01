up:
	docker-compose up -d

restart:
	docker-compose restart

build:
	docker-compose up -d --build

down:
	docker-compose down

bash:
	docker-compose exec app bash

nginx:
	docker-compose exec nginx sh

cache:
	docker-compose exec cache redis-cli -a chords

logs:
	docker-compose logs -f app

logs-nginx:
	docker-compose logs -f nginx

logs-mysql:
	docker-compose logs -f mysql