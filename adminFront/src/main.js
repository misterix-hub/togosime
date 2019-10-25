// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import App from './App';
import router from './router';
//  For socket
// import io from 'socket.io-client'
import Echo from 'laravel-echo'

import moment from 'moment'

import 'vuetify/dist/vuetify.min.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css';

import 'font-awesome/css/font-awesome.css';

import store from './store';

import Vuetify from 'vuetify';

import './styles/global.css';

import axios from 'axios'
import VueAxios from 'vue-axios'

axios.defaults.baseURL = 'http://127.0.0.1/togosime/';
// axios.defaults.baseURL = 'http://192.168.33.127:8000/';

Vue.use(VueAxios, axios);

//Import socket client
/* window.io = require('socket.io-client')
// laravel echo configuration
window.Echo = new Echo({
  broadcaster: 'socket.io',
  host: window.location.hostname + ':6001'
});  */

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY')
    }
});

import VueChartkick from 'vue-chartkick';
import Chart from 'chart.js';
import fullCalendar from 'vue-fullcalendar';
import { setupComponents } from './config/setup-components';

import swatches from 'vue-swatches';
import "vue-swatches/dist/vue-swatches.min.css"

Vue.use(VueChartkick, { adapter: Chart });
Vue.component('full-calendar', fullCalendar);
Vue.component('swatches', swatches);

setupComponents(Vue);

Vue.use(Vuetify);

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    store,
    components: { App },
    template: '<App/>',
    data: {
        themeColor: '#0ba119',
        footer: {
          color: '#05840f'
        },
        btn: {
          defaultColor: '#44fa49',
        },
        app: {
          name: 'TOGOSIME',
          developper: 'fredericalas',

        },
        userEmail: '',
        userPassword: ''
    }
})

