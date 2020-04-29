prod:
	composer install --no-dev

dev:
	composer install

clear-cache:
	bin/cake cache clear_all
