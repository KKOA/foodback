# Foodback
Constructed a clone of Yelp using following technology
- Laravel
- Bootstrap 4 & Fontawesome 5
- JavaScript, jquery & jquery Raty
- MySQL
- CSS & SCSS
- ~~SQLite (Testing only)~~
- PHPUnit (Testing Only)
- Laravel dusk (Testing Only)


## Screen shots
![Home screen](https://github.com/KKOA/foodback/blob/master/restaurants.jpg)

## Live version
<a href="http://foodback-laravel.herokuapp.com/">Foodback</a><br>
( Image upload not function for live version)

Dummy user Login details for live version:

|Email          | Password          |
|---------------|-------------------|
| mary@test.com | secret            |


## Set up Application
This installation assumes have 
- MySQL
- PHP 7.3 or greater
- Composer

installed.

In the terminal\command prompt enter the following:
```
git clone https://github.com/KKOA/foodback.git
cd foodback
composer update
copy '.env.example' '.env'
php artisan key:generate
npm install
npm run dev
```

Change the following lines in .env to match your database configurations:
```
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
Next step  create database. In mysql run the following commands
```
CREATE DATABASE foodback
CREATE DATABASE foodback_dusk
```
**Make sure the database name matches the value of DB_DATABASE in your .env file (case sensitive).**

A copy of these commands can be found inside the Database directory as a .sql file. 

In the terminal/command prompt, enter the following:

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

If you have followed the **Setup Application** process, the mysql database has already setup. 

If you have chosen another database other than mysql or chosen different name for the database, 
you will need to update the respective values in the .env.dusk.local.

<!--
The following instructions assume that sqlite is installed. 
```
cd foodback
cd database
touch foodback_dusk.sqlite
```

If you intend to use another database, you will need to update the database configuration in .env.dusk.local and ignore the previous step.
-->

Generate key for .env.dusk.local
```
php artisan key:generate --env=dusk.local
```
Start server and specify dusk.env. 

```
php artisan serve --host=dusk.local
```

**Running a server in terminal/command prompt will prevent you from execute other commands in same terminal until server is stopped.** 

**If you want execute a command but keep the server running. You will need to open a new terminal/command prompt.**

To run the dusk test enter the following command into the terminal/command prompt:
```
php artisan dusk
```

**Warning**

All the test(s) will fail if
- you have not start a server in right environment before running the test
- you have two or more servers running that are using the same port and ip address
- Wrong version of chromedriver installed. If Laravel Dusk throws an error message like this

**"Facebook\WebDriver\Exception\SessionNotCreatedException: session not created: Chrome version must be between 70 and 73"**

when you run it, then use the following command to resolve the issue, **replacing x with the relevant version required.**
```
php artisan dusk:chrome-driver x
```

This may take a while to run all the tests.
