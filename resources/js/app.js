import 'es6-promise/auto'
import axios from 'axios'
import './bootstrap'
// import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index'
import auth from './auth'
import VueSidebarMenu from 'vue-sidebar-menu'
import router from './router'
import Vuex from 'vuex';
import * as VueGoogleMaps from "vue2-google-maps";
Vue.use(Vuex);
Vue.use(VueSidebarMenu);
//start editor
//start onepage
import 'animate.css'
let globalData = new Vue({
    data: {
        nusFav: 0,
        hosFav: 0,
        nusHis: 0,
        hosHis: 0,
        visit: 'true',
        test:[]
    }
});
Vue.mixin({
    computed: {
        nusFav: {
            get: function() { return globalData.$data.nusFav },
            set: function(newVal) { globalData.$data.nusFav = newVal; }
        },
        hosFav: {
            get: function() { return globalData.$data.hosFav },
            set: function(newVal) { globalData.$data.hosFav = newVal; }
        },
        nusHis: {
            get: function() { return globalData.$data.nusHis },
            set: function(newVal) { globalData.$data.nusHis = newVal; }
        },
        hosHis: {
            get: function() { return globalData.$data.hosHis },
            set: function(newVal) { globalData.$data.hosHis = newVal; }
        },
        visit: {
            get: function() { return globalData.$data.visit },
            set: function(newVal) { globalData.$data.visit = newVal; }
        },
        test: {
            get: function() { return globalData.$data.test },
            set: function(newVal) { globalData.$data.test = newVal; }
        }
    }
})

import VueCarousel from '@chenfengyuan/vue-carousel';
Vue.component(VueCarousel.name, VueCarousel);

//vue slick
import Slick from 'vue-slick';
Vue.use(Slick);

var VueScrollactive = require('vue-scrollactive');
Vue.use(VueScrollactive);


//vue-pannellum
import VuePannellum from '../js/components/vue-pannellum.vue'
Vue.use(VuePannellum);
Vue.component('VPannellumn', VuePannellum)

//vue Panorama
// import Panorama from 'vuejs-panorama';
// Vue.use(Panorama);

//vue sweetaler
import VueSweetAlert from 'vue-sweetalert';
Vue.use(VueSweetAlert)

import ReadMore from 'vue-read-more';
Vue.use(ReadMore);


//start Light Gallery
import Lightbox from 'vue-my-photos'
Vue.use(Lightbox)
    //end Light Gallery

Vue.use(require('vue-moment'));

//autocomplete

//end autocomplete
//vuejs loading
import VueLoading from 'vuejs-loading-plugin'
import { Button } from 'iview'
Vue.use(VueLoading, {
    text: '送信中'
})

window.events = new Vue();
Vue.use(VueClazyLoad)
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyC-2U_IRuSrajQavHadFp8FlXNi61MA3nw",
    }
});
// Set Vue globally
window.Vue = Vue
    // Set Vue router
Vue.router = router
Vue.use(VueRouter)
    // Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}`
Vue.use(VueAuth, auth)

Vue.component('index', Index)

router.beforeEach((to, from, next) => {
    NProgress.start()
    NProgress.set(0.1)
    next()
})
router.afterEach(() => {
    setTimeout(() => NProgress.done(), 500)
})

const app = new Vue({
    el: '#app',
    router,
    component: {
        Index,
        meta: {
            auth: undefined
        }
    },

});