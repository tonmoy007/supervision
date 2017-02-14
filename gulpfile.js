const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.styles([
        'normalize.css',
        'bootstrap.min.css',
        './node_modules/mdbootstrap/css/mdb.css',
        'font-awesome.min.css',
        'ticker.min.css',
        'angular.ticker.css',
        'new.css',
        'grid_loading_post.css'
    ],'public/css/supervision.css');

    mix.webpack(['classie.js','ticker.min.js',
        'angular.ticker.js','home.components.js','supervision.factory.js','angular.authentication.js',
        './node_modules/angular-ui-router/release/angular-ui-router.js',
        './node_modules/angular-cookies/angular-cookies.js','supervision.controllers.js'
        ,'home.js'],'public/js/supervision.js')
    .version(['css/supervision.css', 'js/supervision.js']);
});
