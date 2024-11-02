const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 const mix = require('laravel-mix');

 mix.js('resources/js/scripts.js', 'public/js')
    .postCss('resources/css/styles.css', 'public/css', [
        require('tailwindcss'), // si estás usando Tailwind
    ]);
 