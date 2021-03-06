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
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/print.scss', 'public/css/print.css')
    .sass('resources/sass/add-style.scss', 'public/css/add-style.css')
    .js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps();

mix.browserSync({
    proxy: {
        // 最後に/は不要
        target: "https://localhost"
    },
    https: true, // httpsのサイトをproxyするならtrueをセット
    open: false, // ブラウザを自動で開かない
    files: [
        './resources/**/*',
        './app/**/*',
        './config/**/*',
        './routes/**/*',
        //'./public/**/*',
    ],
    reloadOnRestart: true //BrowserSync起動時にブラウザにリロード命令おくる
}).version()