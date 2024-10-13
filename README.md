# COVID vaccine registration system
COVID vaccine registration system is a laravel, vue application with registration & search functionality.

## Prerequisite
- docker
- node (^18.16.1)
need to install on machine
## Installation

clone the repository from your desired folder.

```bash
take git@github.com:alfaysal/tracker.git
```
create a .env file & copy the .env.example. Make sure you change it correctly according to the docker-compose file.
```bash
take git@github.com:alfaysal/tracker.git
```
now we need to up the container by
```
docker-compose up -d --build
```
it will run 4 containers.

We need to go inside the container to execute some commands.

```
docker exec -it laravel_app bash
```

then run the following commands

```
composer install
php artisan migrate
php artisan db:seed
```
then run the following commands for installing node modules & running the vue application.

```
npm install
npm run dev
```
this will run the application on http://127.0.0.1:8989/ (if we do not change the nginx port in the docker-compose file & .env file)

for running the scheduler we need to run the following command inside the **docker container**. which will continuously run the schedule every minute by default.

```
php artisan schedule:work
```

## Others
will create a **macro** (customWeekdays) to customize the weekdays for our SMS & email send scheduler. Which actual function holds the trait name ManagesFrequencies of Illuminate\Console\Scheduling\Event class.
