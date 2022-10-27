#!/bin/bash

cd ./src
cp .env.example .env
docker-compose up -d server
chmod -R 777 ./
docker-compose run --rm npm install
docker-compose run --rm composer install
docker-compose run --rm artisan key:generate
docker-compose run --rm artisan migrate:fresh --seed
docker-compose run --rm artisan storage:link
docker-compose run -p 5173:5173 npm run dev 
