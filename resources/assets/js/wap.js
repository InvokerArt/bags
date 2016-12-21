import Vue from 'vue/dist/vue.js';
import Wap from './Wap.vue';
import MintUI from 'mint-ui';
import 'mint-ui/lib/style.css';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';

document.addEventListener('DOMContentLoaded', function() {
  if (window.FastClick) window.FastClick.attach(document.body);
}, false);

Vue.use(MintUI)
Vue.use(VueRouter)
Vue.use(VueResource)

const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    root: '/',
    routes: [
        { path: '/', component: require('./components/wap/Home.vue') },
        { path: '/companies/:id', name: '公司详情', component: require('./components/wap/Companyshow.vue') },
        { path: '/exhibitions/:id', name: '展会详情', component: require('./components/wap/Exhibitionshow.vue') },
        { path: '/news/:id', name: '资讯详情', component: require('./components/wap/Newsshow.vue') },
        { path: '/products/:id', name: '产品详情', component: require('./components/wap/Productshow.vue') },
        { path: '/demands/:id', name: '需求详情', component: require('./components/wap/Demandshow.vue') },
        { path: '/supplies/:id', name: '供应详情', component: require('./components/wap/Supplyshow.vue') },
        { path: '/topics/:id', name: '帖子详情', component: require('./components/wap/Topicshow.vue') }
    ]
})

new Vue({
    router,
    render: h => h(Wap)
}).$mount('#app')

let indexScrollTop = 0;
router.beforeEach((route, redirect, next) => {
  if (route.path !== '/') {
    indexScrollTop = document.body.scrollTop;
  }
  document.title = route.meta.title || document.title;
  next();
});

router.afterEach(route => {
  if (route.path !== '/') {
    document.body.scrollTop = 0;
  } else {
    Vue.nextTick(() => {
      document.body.scrollTop = indexScrollTop;
    });
  }
});

