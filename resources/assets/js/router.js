window.Vue = require('vue');
import VueRouter from 'vue-router'
import Vuex from 'vuex'

Vue.use(VueRouter)

const App = require('./components/App.vue')
const Login = require('./components/Login.vue')
const Dashboard = require('./components/Dashboard.vue')
const Home = require('./components/Home.vue')
const Logout = require('./components/Logout.vue')
const Register = require('./components/Register.vue')
const Recharge = require('./components/Recharge.vue')
const Plan = require('./components/Plan.vue')

const routes = [
    {
        path: '/',
        component: App,
        children: [
            {
                path: '/',
                component: Home
            },
            {
                path: 'dashboard',
                component: Dashboard
            },
            {
                path: 'recharge',
                component: Recharge
            },
            {
                path: 'plan',
                component: Plan
            },
            {
                path: 'login',
                component: Login
            },
            {
                path: 'register',
                component: Register
            },
            {
                path: 'logout',
                component: Logout
            }
        ]
    }
]

const router = new VueRouter({
  routes
})

/**
 * 创建Store
 */
const store = new Vuex.Store({
  state: {
    showModal: false
  }
})

/**
 * 调用Vue
 */
const app = new Vue({
    el: '#app',
    router,
    store
});
