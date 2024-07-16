# Commission Calculator

This is an application that calculate commission based on current gross profit. This application uses technologies as follows:

1. PHP 8.2
2. Laravel 11
3. PostgreSQL  

## Installation

In order to run this application, there are couple things that need to be done.

1. Clone Project to XAMPP/LAMP htdocs directories
```bash
git clone https://github.com/azaria-fairuz/commission-calculator.git
```
2. Open terminal in a newly cloned application, and update application's dependancies using composer
```bash
composer update
```
3. Migrate all base laravel required database
```bash
php artisan migrate:fresh --seed
```
4. Then create new database in a Postgresql database and add database configuration to the .env file
```bash
// example
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=commission-calculator
DB_USERNAME=postgres
DB_PASSWORD=postgres
```
5. After that run all sql files in database/scripts directories
```bash
database/scripts/database.sql
database/scripts/seeder.sql
```
6. If everything is done, we can now start the application using artisan command
```bash
php artisan serve
```
