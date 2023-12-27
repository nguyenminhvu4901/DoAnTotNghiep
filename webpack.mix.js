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

mix.setPublicPath('public')
    .setResourceRoot('../')
    .react() // Turns assets paths in css relative to css file
    .vue()
    .sass('resources/sass/frontend/app.scss', 'css/frontend.css')
    .sass('resources/sass/backend/app.scss', 'css/backend.css')
    .js('resources/js/frontend/app.js', 'js/frontend.js')
    .js('resources/js/backend/app.js', 'js/backend.js')
    .js('resources/js/app.js', 'js/app.js')
    .copyDirectory('resources/js/frontend/pages', 'public/js/pages')
    .copyDirectory('resources/js/frontend/assets', 'public/js/assets')
    .copyDirectory('resources/js/frontend/layouts', 'public/js/layouts')
    .copyDirectory('resources/assets/fonts', 'public/fonts')
    .extract(['alpinejs', 'jquery', 'bootstrap', 'popper.js', 'axios', 'sweetalert2', 'lodash'])
    .sourceMaps();

if (mix.inProduction()) {
    mix.version();
} else {
    // Uses inline source-maps on development
    mix.webpackConfig({
        devtool: 'inline-source-map',
    });
}
