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
    .sass('resources/sass/print.scss', 'public/css/print.css');

mix.sourceMaps().js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps();


mix.browserSync({
    proxy: 'http://127.0.0.1', // アプリの起動アドレス
    open: false, // ブラウザを自動で開かない
    files: [ // チェックするファイルは下記で十分ではないかな。
        './resources/**/*',
        './app/**/*',
        './config/**/*',
        './routes/**/*',
    ],
    reloadOnRestart: true //BrowserSync起動時にブラウザにリロード命令おくる
}).version()