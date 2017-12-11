// asset/js/app.js

require('../css/app.scss');

const $ = require('jquery');

global.$ = global.jQuery = $;

require('bootstrap-sass');

// import external libs
require('./libs/jquery.mCustomScrollbar.concat.min');

// import personal script
require('./partials/sidebar');
