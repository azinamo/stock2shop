require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

// import Product from './components/Product.vue';

Vue.component('product', require('./components/Product/Product').default);
Vue.component('create-product', require('./components/Product/Create').default);

// const router = new VueRouter({
//    mode: 'history',
//    routes: [
//        {
//            path: '/',
//            name: 'product',
//            component: Product
//        }
//    ]
// });

const app = new Vue({
    el: "#app"
});
