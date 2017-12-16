// asset/js/app.js

// import css
require('../css/app.scss');

// import tether before because needed by bootstrap
require('./libs/tether.min');

require('bootstrap/dist/js/bootstrap');

// import external libs
require('./libs/jquery.mCustomScrollbar.concat.min');
require('./libs/howler.core.min');
require('./libs/howler.min');
require('./libs/howler.spatial.min');

// import personal script
require('./partials/sidebar');
require('./partials/player');
