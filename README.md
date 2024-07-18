# Flowerly

Order management app built in PHP Laravel + PostgreSQL + Angular

## Requirements

in order to start using the application, you need to have the following software installed:

- Docker Engine v26.1.4
- Node v20.15.1

## Get started

After cloning the repository, follow these steps:

1. copy the `.env.example` file into a new `.env` file;
2. generate the app key: `docker-compose exec backend php artisan key:generate`
3. build the docker environment running: `docker-compose up --build -d` in the project root folder
4. install composer packages: `docker-compose exec backend composer install`
5. start using the app!

<strong>NB:</strong> the front-end application needs just a few more seconds to start compared to the database and the backend, if you wanna make sure everything is up and running when starting using the app, just omit the `-d` param to follow the docker environment logs.
