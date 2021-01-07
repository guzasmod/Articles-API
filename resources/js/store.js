import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        //token: localStorage.getItem('token') || '',
        token: localStorage.getItem('auth') || '',
        user: localStorage.getItem('user') || { },
        user_id : localStorage.getItem('user_id') || '',
        user_role : localStorage.getItem('user_role') || '',
        isUserLoggedIn: null,
        user_name : localStorage.getItem('user_name') || '',
        user_email : localStorage.getItem('user_email') || '',
    },
    mutations: {
        setToken(state, token) {
            localStorage.setItem('auth', token);
            state.token = token;
        },
        clearToken(state) {
            localStorage.removeItem('auth');
            localStorage.removeItem('isUserLoggedIn');
            localStorage.removeItem('user');
            localStorage.removeItem('user_role');
            localStorage.removeItem('user_id');
            localStorage.removeItem('user_name');
            localStorage.removeItem('user_email');
            user_role = '';
            user = null;
            state.isUserLoggedIn = false;
            state.token = '';
        },
        setAuthUser(state, user) {
            localStorage.setItem('user', user);
            localStorage.setItem('isUserLoggedIn', true);
            localStorage.setItem('user_name', user.name);
            localStorage.setItem('user_email', user.email);
            state.isUserLoggedIn = true;
            state.user = user;
            state.user_name = user.name;
            state.user_email = user.email;
        },
        setUserRole(state, role) {
            localStorage.setItem('user_role', role);
            state.user_role = role;
        },
        setUserId(state, id) {
            localStorage.setItem('user_id', id);
            state.user_id = id;
        }
    },
    getters : {
        isLoggedIn(state) {
            return state.user !== null;
        },
        UserRole(state) {
            return state.user_role;
        },
        isManager(state) {
            if(state.user_role == "manager"){
                return true;
            }
        },
        isAdmin(state) {
            if(state.user_role == "admin"){
                return true;
            }
        },
        GetUser(state) {
            return state.user;
        },
    }
});