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

mix.styles([
	'node_modules/tabler-ui/dist/assets/css/tabler.css',
	'node_modules/flatpickr/dist/flatpickr.css',
	'node_modules/onesignal-emoji-picker/lib/css/nanoscroller.css',
	'node_modules/onesignal-emoji-picker/lib/css/emoji.css',
	'resources/assets/css/installer.css',
	'resources/assets/css/dm.css',
	// 'resources/assets/css/main.css',
	// 'resources/assets/css/reset.css'
], 'public/assets/css/dm.bundle.css').version();

mix.scripts([
	'node_modules/tabler-ui/src/assets/js/vendors/jquery-3.2.1.min.js',
	'node_modules/tabler-ui/src/assets/js/vendors/bootstrap.bundle.min.js',
	'node_modules/jquery.repeater/jquery.repeater.min.js',
	'node_modules/flatpickr/dist/flatpickr.js',
	'node_modules/flatpickr/dist/l10n/ru.js',
	'node_modules/onesignal-emoji-picker/lib/js/nanoscroller.min.js',
	'node_modules/onesignal-emoji-picker/lib/js/tether.min.js',
	'node_modules/onesignal-emoji-picker/lib/js/config.js',
	'node_modules/onesignal-emoji-picker/lib/js/util.js',
	'node_modules/onesignal-emoji-picker/lib/js/jquery.emojiarea.js',
	'node_modules/onesignal-emoji-picker/lib/js/emoji-picker.js',
	'node_modules/bootbox/dist/bootbox.all.min.js',
	'node_modules/timeago.js/dist/timeago.min.js',
	'node_modules/timeago.js/dist/timeago.locales.min.js',
	'resources/assets/js/account.js',
	'resources/assets/js/message.js',
	'resources/assets/js/autopilot.js',
	'resources/assets/js/list.js',
	'resources/assets/js/emoji.js',
	// 'resources/assets/js/main.js',
	'resources/assets/js/direct.js'
], 'public/assets/js/dm.bundle.js').version();


mix.copyDirectory('node_modules/tabler-ui/dist/assets/fonts', 'public/assets/fonts')
   .copyDirectory('node_modules/onesignal-emoji-picker/lib/img', 'public/assets/img')
   .copyDirectory('resources/assets/img', 'public/assets/img');
