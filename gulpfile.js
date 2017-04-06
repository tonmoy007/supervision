const elixir = require('laravel-elixir');

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
    mix.sass('app.scss');
    mix.styles([
        'normalize.css',
        'bootstrap.min.css',
        './node_modules/mdbootstrap/css/mdb.css',
        'font-awesome.min.css','ngGallery.css',
        'ticker.min.css','./node_modules/videogular-themes-default/videogular.min.css',
        'angular.ticker.css',
        'new.css',
        'grid_loading_post.css',
        './public/css/app.css'
    ],'public/css/supervision.css');

    mix.webpack(['classie.js','ticker.min.js','./node_modules/ng-file-upload/dist/ng-file-upload.js',
        './node_modules/videogular/videogular.min.js','./node_modules/videogular-controls/vg-controls.min.js',
        './node_modules/ng-file-upload/dist/ng-file-upload-shim.js','./node_modules/angular-trix/dist/angular-trix.min.js',
        'angular.ticker.js','home.components.js','supervision.factory.js','angular.authentication.js',
        './node_modules/angular-ui-router/release/angular-ui-router.js','./node_modules/angular-sanitize/angular-sanitize.js',
        './node_modules/angular-cookies/angular-cookies.js','supervision.controllers.js'
        ,'home.js'],'public/js/supervision.js')
    .version(['css/supervision.css', 'js/supervision.js']);
    mix.browserSync({
        'proxy':'localhost:8000',
        'files':['resources/**/*','app/**/*','config/*.php','routes/**/*','public/**/*']
        });
});
