import Vue from 'vue'
import Wap from './Wap.vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'


Vue.use(VueRouter)
Vue.use(VueResource)

/* eslint-disable no-new */

const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    root: 'index',
    routes: [
        { path: '/', component: require('./components/wap/Home.vue') },
        { path: '/companies/:id', component: require('./components/wap/Companyshow.vue') }
    ]
})

new Vue(Vue.util.extend({ router }, Wap)).$mount('#app')

