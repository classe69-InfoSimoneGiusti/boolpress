window.axios = require('axios');
//window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('./bootstrap');

import Vue from 'vue';
import App from './views/App';

const app = new Vue({
    el: '#root',
    render: h => h(App)
});


