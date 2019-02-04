let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/jquery.raty.js', 'public/js')
    .js('resources/assets/js/master.js', 'public/js')
    .sass('resources/assets/sass/master.scss', 'public/css')
    .sass('resources/assets/sass/filter.scss', 'public/css')
    .sass('resources/assets/sass/vendor/jquery.raty.scss', 'public/css/vendor')
    .sass('resources/assets/sass/jquery.simpler-sidebar.scss','public/css/vendor')

   ;

if (mix.inProduction()) {
    mix.version();
}