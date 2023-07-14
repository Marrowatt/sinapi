require('./bootstrap');

window.Vue = require('vue').default;
window.axios = require('axios');

import Vue from 'vue';
import VueRouter from 'vue-router';

// import axios from 'axios';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// import brands from '@fortawesome/fontawesome-free/js/brands.js';
// import solid from '@fortawesome/fontawesome-free/js/solid.js';
// import fontawesome from '@fortawesome/fontawesome-free/js/fontawesome.js';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)

Vue.use(VueRouter);

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.component('regular-home', require('./components/regular/Home.vue').default);
Vue.component('create-meal', require('./components/meal/CreateMeal.vue').default);
Vue.component('food-search', require('./components/FoodSearch.vue').default);
Vue.component('sifu', require('./components/Sifu.vue').default);
Vue.component('see-meal', require('./components/meal/SeeMeal.vue').default);
Vue.component('edit-meal', require('./components/meal/EditMeal.vue').default);

Vue.component('nutritionist-home', require('./components/nutritionist/HomeN.vue').default);
Vue.component('patients', require('./components/nutritionist/Patients.vue').default);

import JwPagination from 'jw-vue-pagination';
Vue.component('jw-pagination', JwPagination);

import Donut from 'vue-css-donut-chart';
import 'vue-css-donut-chart/dist/vcdonut.css';

Vue.use(Donut);

const app = new Vue({
    el: '#wrapper',
    components: {
    }
});
