# Stream line Test

#### Docker build

    docker-compose up -d --build

### Install it via composer

    cd src 
    composer install

Create a copy of `.env` file from `.env.example`


#### Generate your key

    docker exec -it php  /var/www/html/artisan key:generate

#### Execute the migration with seed
    docker exec -it php  /var/www/html/artisan migrate:fresh --seed


Then visit your site:

    http://localhost:8080/


Your Login Information:

    Email: admin@admin.com
    Password: password
