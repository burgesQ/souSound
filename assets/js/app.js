// asset/js/app.js

// import css
require('../css/app.scss');

// create global jQuery
const $ = require('jquery');
global.$ = global.jQuery = $;

// import tether before because needed by bootstrap
require('./libs/tether.min');
global.Tether = require('tether');

require('bootstrap/dist/js/bootstrap');

// import external libs
require('./libs/jquery.mCustomScrollbar.concat.min');
require('./libs/howler.core.min');
require('./libs/howler.min');
require('./libs/howler.spatial.min');

// import personal script
require('./partials/player');
require('./partials/sidebar');
