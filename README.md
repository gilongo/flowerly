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

## Application

### Frontend

The frontend was creafted with Angular 17 (v17.3.1) and Material UI. <br>
The application is available at `http://localhost:4200`.

### Backend

The backend was creafted with PHP Laravel 11 (PHP 8.3) with a PostgreSQL 15 as relational database.<br>
The application is available at `http://localhost:9000` (web routes are not available, api only).

## Features (WIP)

#### Backend

1. Customers
   - [x] Get All
   - [x] Get by ID
   - [x] Create
   - [ ] Update
   - [ ] Delete
2. Orders
   - [x] Get all
   - [x] Get by ID
   - [x] Create
   - [x] Update
   - [x] Delete
3. Products
   - [x] Get All
   - [x] Get by ID
   - [x] Create
   - [x] Update
   - [x] Delete

#### Frontend

- [x] Order list
  - [x] Filter by Date
  - [x] Filter by Description
- [x] Create Order
- [x] Delete Order
- [-] Edit Order
