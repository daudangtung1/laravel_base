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

// mix.js("resources/js/app.js", "public/js")
//     .vue()
//     .postCss("resources/css/app.css", "public/css");
mix.js(["resources/js/index.js"], "js/app.js");
mix.copy(["resources/lib/bs4/css/bootstrap.css", "resources/lib/bs4/css/bootstrap-grid.css"], 'public/css/bootstrap.css');
mix.sass("resources/css/app.scss", "public/css/app.css");
