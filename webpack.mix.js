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
    .js('resources/js/pages/homepage.js', 'public/js/pages')
    .js('resources/js/pages/header.js', 'public/js/pages')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/pages/home.scss', 'public/css/pages')
    .sass('resources/sass/layouts/components/header.scss','public/css/pages')
    .sass('resources/sass/layouts/components/footer.scss','public/css/pages')
    .sass('resources/sass/layouts/components/utility.scss','public/css/pages')
    .sass('resources/sass/layouts/partials/buttons.scss','public/css/pages')
    .sass('resources/sass/layouts/partials/slogan.scss','public/css/pages')
    .sass('resources/sass/layouts/partials/main-header.scss','public/css/pages')
    .copy('resources/plugins', 'public/plugins')
    .sourceMaps();
