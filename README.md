# Laravel Agenda
This is a simple project that simulates a schedule application with some basic rules.

## Pre Requisites
``` laravel ```
``` php 7+ ```
``` mysql 5.7```

### 1º -> Clone the Repo
``` git clone https://github.com/tair0ne1/laravel-agenda.git ```

### 2º -> Install packages
``` composer install ```

### 3º -> Copy .env
``` cp .env.example .env ```

### 4º -> Configure .env
``` bash .env ```

### 5º -> Migrate
``` php artisan migrate ```

### 6º -> Seed the database
``` php artisan db:seed --class=StatusTableSeeder ```

``` php artisan db:seed --class=UsersTableSeeder ```

### 7º -> Run the application
``` php artisan serve ```

### 8º -> Test the application
