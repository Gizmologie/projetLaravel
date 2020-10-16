const mix = require('laravel-mix');

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

mix
.js('resources/js/cart_update.js', 'public/js')
.js('resources/js/app.js', 'public/js')
    .copyDirectory('storage/app/public', 'public/images')
.sass('resources/sass/app.scss', 'public/css')
.sass('resources/sass/product-list.scss', 'public/css')
