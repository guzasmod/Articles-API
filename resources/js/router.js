import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './components/Home.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Articles from './components/Straipsniai.vue';
import NotFound from './components/NotFound.vue';
import Profile from './components/Profile.vue';
import User from './components/User.vue';
import Userr from './components/Userr.vue';
import Post from './components/Post.vue';

export default{
  //  hashbang: false, // Add this line
   // base: '/',
    mode: 'history',
   // history: true,
   // fallback: true,
   linkActiveClass: 'font-semibold',
  routes: [
    { path: '*', component: NotFound},
    { path: '/', component: Home},
    { path: '/articles', component: Articles},
    { path: '/login', component: Login},
    { path: '/register', component: Register},
    { path: '/profile', component: Profile},
    { path: '/users', component: Userr},
    // { path: '/userss', component: Userr},
    { path: '/articles/:id', name: 'articles', component: Post }
  ]
}