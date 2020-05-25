## TIS ティーズ

This project can provide portal of Nursing Home and Hospitals in JAPAN. Their related news and related job offers can be searched.

## USING LANGUAGE

- Laravel 5.8
- VueJS

## PREREQUISITES

- PHP 7.3
- MySQL
- Composer
- Git
- Node

## INSTALLATION
```bash
git clone https://github.com/Thuzar-TS/Portal_Update.git
```
Go to project folder.
```bash
composer install
npm install
php artisan key:generate
php artisan jwt:secret
```

Since migration files are not update, please import ```extra_files/portal.sql``` file to your mysql database.
For Database import (if you installed xampp)
1. Open ```C:/xampp/php/php.ini``` file and make these changes
```bash
max_execution_time = -1
max_input_time = -1
memory_limit = 1000M
post_max_size = 100M
upload_max_filesize = 100M
```
2. stop and start php server again (xampp control panel)

- In Browser, go to localhost/phpmyadmin
- Create database ```portal``` with collation ```utf8mb4_unicode_ci```
