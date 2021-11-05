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

mix.js('resources/js/app.js', 'public/js/bundle.js')
    .sass('resources/sass/app.scss', 'public/css/bundle.css');

mix.js('resources/js/dependencies.js', 'public/js')
    .styles([
        'public/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css',
        'public/css/bootstrap.min.css',
        'public/css/icons.min.css',
        'public/css/all.min.css',
        'public/css/app.min.css',
    ], 'public/css/template.css');

mix.sass('resources/sass/optional.scss', 'public/css');

mix.sass('resources/sass/datatable.scss', 'public/css');

const tailwindcss = require('tailwindcss');

mix.sass('resources/sass/test.scss', 'public/css')
  .options({
    processCssUrls: false,
    postCss: [ tailwindcss('tailwind.config.js') ],
  })