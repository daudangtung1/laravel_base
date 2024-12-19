const mix = require("laravel-mix");

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

// jquery lib
mix.copy(["resources/lib/jquery/jquery-3.2.1.min.js"], "public/lib/jquery/jquery.js").version();
mix.copy(["resources/lib/toastr/toastr.js"], "public/lib/toastr/toastr.js").version();
mix.copy(["resources/lib/toastr/toastr.css"], "public/lib/toastr/toastr.css").version();

mix.copy(["resources/lib/bs4/css/bootstrap.css", "resources/lib/bs4/css/bootstrap-grid.css"], 'public/css/bootstrap.css');
mix.sass("resources/css/app.scss", "public/css/app.css");
mix.sass("resources/css/login.scss", "public/css/login.css");
