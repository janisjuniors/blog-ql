#!/bin/bash

cd ./src
docker-compose up -d server
docker-compose run -p 5173:5173 npm run dev 
