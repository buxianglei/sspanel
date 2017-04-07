window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

const App = require('./components/App.vue')
const Login = require('./components/Login.vue')
const Dashboard = require('./components/Dashboard.vue')
const Home = require('./components/Home.vue')
const Logout = require('./components/Logout.vue')

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
                path: 'login',
                component: Login
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

const app = new Vue({
    el: '#app',
    router
});
