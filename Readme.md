# Simple Laravel Chat

## Installation
1. Clone the repo
2. `composer install`
3. `docker-compose up -d`
4. `docker-compose run app /bin/bash`
5. `php artisan storage:link`
6. `exit` (to log-out from docker bash)
7. `cp .env.example .env`
8. `php artisan key:generate`

## Testing

Test can be run with: `vendor/bin/phpunit`

