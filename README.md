# Stream line Test

#### Docker build

    docker-compose up -d --build


Create a copy of `.env` file from `.env.example`



#### Execute the migration with seed
    docker exec -it php  /var/www/html/artisan migrate:fresh --seed
