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


## Live version
<a href="http://foodback-laravel.herokuapp.com/">Foodback</a>

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
php artisan key:generate --env=dusk.local
php artisan dusk
```

**Warning this may take a while to run all the tests**
