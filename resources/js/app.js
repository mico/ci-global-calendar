
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
//var draggable = require('vuedraggable');
//Vue.use(draggable);

/**
* In between we import the custom javascript plugins.
**/
require('./plugins/accordion');   // accordion.js
require('./plugins/gallery');     // gallery.js
require('./plugins/imagepopup');  // imagepopup.js
require('./plugins/statistics');  // statistics.js
require('./plugins/community_goals');  // community_goals.js
require('./plugins/cards_carousel');  // community_goals.js

//require('./utility/selectpicker_mobile');

// File manager for intro_image button in edit.post view
require('./plugins/laravel-filemanager/lfm');  // lfm.js
require('./plugins/laravel-filemanager/editPostImageFilemanager');  // editPostImageFilemanager.js

// Load Bootstrap tooltip everywhere in the website
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('continents-countries-selects', require('./components/ContinentsCountriesSelects.vue').default);

window.myApp = new Vue({  // In this way the object myApp is accessible in the browser console for debugging purposes
    el: '#app'
});


// Import Javascript Plugins
	import 'bootstrap';
	import 'bootstrap-datepicker';
	import 'jquery-ui';
	import 'jquery-ui/ui/widgets/accordion';
	import 'smartmenus';
	import 'smartmenus/dist/addons/bootstrap-4/jquery.smartmenus.bootstrap-4.js';
	import 'tooltip.js';
	import 'slick-carousel'; 
	import 'gridalicious';
	import '@fancyapps/fancybox';
	import 'bootstrap-select';
	import 'bootstrap-timepicker';
	import 'fontawesome-pro/js/fontawesome.js';
	import 'cookieconsent';
	import 'waypoints/lib/jquery.waypoints.js';
	import 'jquery.counterup';
    import 'sortablejs';
    import 'jquery.cookie';
    import 'prismjs';
    import 'chart.js';
    
    
