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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    // .sass('resources/scss/app.scss', 'public/css/custom', [
    //     //
    // ])
    .sass('public/scss/sb-admin-2.scss', 'public/css', [
        //
    ])
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

