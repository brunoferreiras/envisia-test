# Envisia Test
## Gettings Started
It's need to install in your computer:
`Docker: 18.06.0+`
`Docker-compose: 1.27.0+`

Execute this commands to start the application:
```bash
// Create the .env file
cp .env.example .env
// Start all containers docker
docker-compose up -d // or make up
// Enter in container
make bash
// Generate the key
php artisan key:generate
// Build front
npm install && npm run build
// It's everything!
// You can access the api in: http://localhost:8040/

## Tools
- [Laravel 8](https://laravel.com/)
- [MySQL 8.0](https://www.mysql.com/)
- [Redis 5.0](https://redis.io/)

### Migrations
```bash
php artisan migrate:fresh // Drop all data and recreate all tables
```

## Features
### Create User
You can create a user in: http://localhost:8040/register
### Login
You can log in with a user in: http://localhost:8040/login
### Customers
You can see all customers: http://localhost:8040/customers
### Products
You can see all products: http://localhost:8040/products

### Hydrate Faker API
You can hydrate the database with this command:
```bash
// Enter in container
make bash
// Execute the command
php artisan dispatch:hydrate-database 5000 // The param is a quantity to insert data
```

## Database Design

[](./docs/database.png)
