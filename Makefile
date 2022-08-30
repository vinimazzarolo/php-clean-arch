.PHONY: up clean

up:
	sudo chown -R ${USER} _data
	composer install -noa
	docker-compose up -d --build

clean:
	docker-compose stop
	docker-compose rm -f
	sudo rm -rf _data/ vendor/