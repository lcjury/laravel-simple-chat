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
9. 

## Testing

Test can be run with: `vendor/bin/phpunit`

## Requirements:
[ ] A comment can have text, photos or video.
[x] Comments can't be deleted.
[x] Comments should be stored on MySQL.
[x] Comments should be read from a Redis Cache.
[x] There should exist 3 endpoints: comments index, comments storage, file storage.
[x] There must have a Readme file.
[x] The project should be runnable from a Docker environment.
