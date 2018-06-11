# Foodback
Constructed a clone of Yelp using following technology
- Laravel
- Bootstrap 3
- JavaScript & Jquery
- MySQL
- CSS & SCSS
- Sqlite (Testing only)
- phpunit (Testing Only)
- Laravel dusk (Testing Only)


## Screen shots
![Home screen](https://github.com/KKOA/foodback/blob/master/restaurants.jpg)

## Live version
<a href="http://foodback-laravel.herokuapp.com/">Foodback</a><br>
( Image upload not function )

## Set up Application
This installation assumes have 
- MySQL
- PHP7
- Composer

installed.

```
git clone https://github.com/KKOA/foodback.git
cd foodback
composer update
php artisan key:generate
npm install
```

Next, copy the '.env.example' as '.env'

Change the following lines in .env to match your database configurations:
```
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Open a MySQL connection and create a database with the same name as the value of DB_DATABASE in your .env file.

In the terminal, enter the following:

```
php artisan migrate
```
This will setup the migrations and the database.

For restaurant image upload you will need create
<br>directory(**/storage/app/public/upload/restaurants**)<br> 
using the following commands
```
cd storage/app/public
mkdir upload
cd upload
mkdir restaurants
```

Afterwards link storage directory to public directory
```
php artisan storage:link
```


## Run Application
```
cd foodback
php artisan serve
```
Click the link in command prompt/terminal to open application in the browser.

## Test

### Laravel Dusk

The following instructions assume that sqlite is installed. 
```
cd foodback
cd database
touch foodback_dusk.sqlite
```

If you intend to use another database, you will need to update database configuration in .env.dusk.local and ignore the previous step.

Generate key for .env.dusk.local
```
php artisan key:generate --env=dusk.local
```

To run the dusk test enter the following:
```
php artisan dusk
```

**Warning this may take a while to run all the tests**
