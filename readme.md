# Stock2Shop    

Project uses the Laravel framework and VueJs.


## Developer Installation

The repository may be cloned from the [Github repository](https://github.com/azinamo/stock2shop.git)
```bash
git clone https://github.com/azinamo/stock2shop.git
```

Install the latest versions of docker-ce.
```bash
sudo curl -sS https://get.docker.com | sh
```

Start the development environment from the project root folder
```bash
sudo docker-compose up -d
```

Login to php docker container to use the artisan cli tool

```bash
sudo docker exec -t -i stock2shop_php /bin/sh
```

Install the required dependencies as listed in the composer.json file.

```bash
composer install
```

Copy the `.env` file and create an application key
```bash
cp .env.example .env && php artisan key:generate
```

Ensure the storage file is writtable
```bash
sudo chmod -R 777 storage
```


### Database Configuration and Migrations

Configure database connection in the `.env` file
```
DB_HOST=stock2shop_mysql
DB_DATABASE=stock2shop
DB_USERNAME=root
DB_PASSWORD=stock2shop123
```

Populate the database tables.
This command should be run whenever new migration files are added to the repository.
```bash
php artisan migrate
```


Once the above steps have been completed, you should have three containers configured and running via http://localhost:81

To stop the containers, use the below command.
```bash
sudo docker-compose down
```
**To do:**

- Add authentication using passport, to secure the API
- Implement the policies, to validate permissions to create or accessing the products
- To implement frontend as SPA.