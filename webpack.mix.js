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

mix.styles([
    'resources/assets/css/external.css',
    'resources/assets/css/sb-admin-2.css',
    'resources/assets/css/all.min.css',
], 'public/css/app.css');

mix.scripts([
    'resources/assets/vendor/jquery/jquery.min.js',
    'resources/assets/vendor/jquery/bootstrap.bundle.min.js',
    'resources/assets/vendor/jquery-easing/jquery.easing.min.js',
    'resources/assets/vendor/jquery/all.min.js',
    'resources/assets/js/sb-admin-2.min.js',
    'resources/assets/vendor/chart.js/Chart.min.js'
], 'public/js/compiled.js');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');
