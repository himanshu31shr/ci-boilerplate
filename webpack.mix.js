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

mix.setPublicPath(path.resolve(''))
// sass('resources/assets/sass/frontend/app.scss', 'public/css/frontend.css')
    .sass('public/backend/css/app.scss', 'assets/backend/backend.css')
    .js(['public/backend/js/before.js',
    	'public/backend/js/app.js',
    	'public/backend/js/after.js'
    	], 'assets/backend/backend.js')
    .js([
    	'public/frontend/js/before.js',
    	'public/frontend/js/app.js',
    	'public/frontend/js/after.js'
    	],'assets/frontend/frontend.js');

if (mix.inProduction() || process.env.npm_lifecycle_event !== 'hot') {
    mix.version();
}