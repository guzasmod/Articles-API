require('./bootstrap');

window.Vue = require('vue');

//Import Vue Filter
require('./filter'); 

//Import progressbar
require('./progressbar'); 

//Setup custom events 
require('./customEvents'); 



//Import v-from
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
import moment from 'moment';

import routes from "./router.js";
import VueRouter from "vue-router";
import { store } from './store.js';

Vue.use(VueRouter);

//Import Sweetalert2
import Swal from 'sweetalert2'
window.Swal = Swal
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast = Toast
window.Fire =  new Vue();

Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate',function(created){
    return moment(created).format('MMMM Do YYYY');
});


Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('articles', require('./components/Straipsniai.vue').default);
Vue.component('footerr', require('./components/Footer.vue').default);
Vue.component('product', require('./components/Product.vue').default);
Vue.component('category', require('./components/Kategorija.vue').default);
Vue.component('the-pagination', require('./components/ThePagination.vue').default);
Vue.component('user', require('./components/User.vue').default);
Vue.component('not-found', require('./components/NotFound.vue').default);

/*
const routess = [
    { path: '/home', component: require('./components/Home.vue').default },
    { path: '/articles', component: require('./components/Straipsniai.vue').default},
    { path: '/login', component: require('./components/Login.vue').default},
    { path: '/register', component: require('./components/Register.vue').default}
]

const router = new VueRouter({
    routes: routess,
    mode: "history"
})
*/


const app = new Vue({
    //router,
    el: '#app',
    store: store,
    router: new VueRouter(routes),
    data:{
        search: '',
        image: "http://1.bp.blogspot.com/-8PfnHfgrH4I/TylX2v8pTMI/AAAAAAAAJJ4/TICBoSEI57o/s1600/search_by_image_image.png",
    },
    methods:{
        searchit: _.debounce(() => {
            Fire.$emit('searching');
        },1000),

        printme() {
            window.print();
        }
    }
});