// asset/js/app.js

require('../css/app.scss');

const $ = require('jquery');

global.$ = global.jQuery = $;

require('bootstrap/dist/js/bootstrap');

// import external libs
require('./libs/jquery.mCustomScrollbar.concat.min');

require('./libs/howler.core.min');
require('./libs/howler.min');
require('./libs/howler.spatial.min');

// import personal script
require('./partials/sidebar');
require('./partials/player');
