<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Tugas Besar Pemrograman Website

## Quick Start

### Clone Repository
open your terminal, go to the directory that you will install this project, then run the following command:

```bash
https://github.com/marsel945/zemilan-po-app

cd tubes-pemrogramanwebsite
```
### Install packages

Install vendor using composer

```bash
composer install
```

Install node module using npm

```bash
npm install
```

### Configure .env
Copy .env.example file

```bash
cp .env.example .env
```

Then run the following command :

```php
php artisan key:generate
```

### Migrate Data
create an empty database with mysql 8.x version, then setup that fresh db at your .env file, then run the following command to generate all tables and seeding dummy data:

```php
php artisan migrate:fresh --seed
```
### Public Disk
To make these files accessible from the web, you should create a symbolic link from public/storage to storage/app/public.
To create the symbolic link, you may use the storage:link Artisan command:

```php
php artisan storage:link
```

### Running Application
To serve the laravel app, you need to run the following command in the project director (This will serve your app, and give you an adress with port number 8000 or etc)
- **Note: You need run the following command into new terminal tab**

```php
php artisan serve
```
Open [http://localhost:8000](http://localhost:8000) from your browser.


### Setup Email Testing
Please create your mailtrap account at [mailtrap.io](https://mailtrap.io/email-sandbox/) to capture SMTP traffic from staging and dev environments. Then configure your mailing configuration by setting these values in the .env file
```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username_here
MAIL_PASSWORD=your_password
```
## Rules Repository ❗

- Whatever the smallest change, don't forget to give a clear commit message
- Always push to your own branch not to the ``main`` or ``development`` branch.
- When you feel your code task is complete, please make a pull request to the ``development`` branch.
- The project leader will review your code and merge it to the ``development`` branch.
- To avoid conflicts, don't forget to pull first from the ``development`` branch.
- Every time you pull from the development branch, run ``php artisan migrate:fresh --seed`` command to ensure the database structure changes are also applied to your local environment.
