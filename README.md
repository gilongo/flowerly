# Flowerly

Order management app built in PHP Laravel + PostgreSQL + Angular

## Requirements

in order to start using the application, you need to have the following software installed:

- Docker Engine v26.1.4

## Get started

After cloning the repository, follow these steps:

1. build the docker environment running: `docker-compose up --build -d` in the project root folder
2. install composer packages: `docker-compose exec backend composer install`
3. start using the app!

<strong>NB:</strong> the front-end application needs just a few more seconds to start compared to the database and the backend, if you wanna make sure everything is up and running when starting using the app, just omit the `-d` param to follow the docker environment logs.
