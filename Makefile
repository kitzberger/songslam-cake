prod:
	composer install --no-dev

dev:
	cp -n config/.env.example config/.env
	composer install

clear-cache:
	bin/cake cache clear_all
