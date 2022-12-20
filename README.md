To get started:

## Regular
```bash
composer install

cp .env.example .env
```
- Create database and fill in details
```bash
php artisan key:generate

php artisan migrate --seed

php artisan serve
```

## Sail
- Run docker
- Put docker-compose.yml file in root
```bash
composer install

cp .env.example .env
```
- Create database and fill in details
- change DB_HOST to mysql
```bash
sail up -d

sail artisan key:generate

sail artisan migrate --seed
```
