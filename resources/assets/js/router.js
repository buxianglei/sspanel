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
const Help = require('./components/Help.vue')
const NavList = require('./components/NavList.vue')
const Profile = require('./components/Profile.vue')

const routes = [
    {
        path: '/',
        component: App,
        children: [
            {
                path: '/',
                components: {
                    default: Home,
                    nav: NavList
                }
            },
            {
                path: 'dashboard',
                components: {
                    default: Dashboard,
                    nav: NavList
                }
            },
            {
                path: 'recharge',
                components: {
                    default: Recharge,
                    nav: NavList
                }
            },
            {
                path: 'profile',
                components: {
                    default: Profile,
                    nav: NavList
                }
            },
            {
                path: 'plan',
                components: {
                    default: Plan,
                    nav: NavList
                }
            },
            {
                path: 'help',
                components: {
                    default: Help,
                    nav: NavList
                }
            },
            {
                path: 'login',
                components: {
                    default: Login,
                    nav: NavList
                }
            },
            {
                path: 'register',
                components: {
                    default: Register,
                    nav: NavList
                }
            },
            {
                path: 'logout',
                components: {
                    default: Logout,
                    nav: NavList
                }
            }
        ]
    }
]

const router = new VueRouter({
    mode: 'hash',
    routes
})

/**
 * 创建Store
 */
const store = new Vuex.Store({
  state: {
    showModal: false,
    list: null,
    loginedList: [
        {
            href: '/',
            title: '主页',
            icon: {
                'fa-home': true
            }
        },
        {
            href: 'dashboard',
            title: '控制台',
            icon: {
                'fa-cube': true
            }
        },
        {
            href: 'recharge',
            title: '余额充值',
            icon: {
                'fa-rmb': true
            }
        },
        {
            href: 'plan',
            title: '套餐列表',
            icon: {
                'fa-rmb': true
            }
        },
        {
            href: 'help',
            title: '帮助',
            icon: {
                'fa-exclamation-circle': true
            }
        },
        {
            href: 'profile',
            title: '设置',
            icon: {
                'fa-gear': true
            }
        },
        {
            href: "logout",
            title: "退出",
            icon: {
                'fa-sign-out': true
            }
        }
    ],
    unloginList: [
        {
            href: '/',
            title: '主页',
            icon: {
                'fa-home': true
            }
        },
        {
            href: "login",
            title: "登录",
            icon: {
                'fa-send': true
            }
        },
        {
            href: "register",
            title: "注册",
            icon: {
                'fa-sign-in': true
            }
        }
    ]
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
