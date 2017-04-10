<template>
    <div class="app">

        <nav id="menu" class="menu">
            <section class="menu-section">
                <h3 class="menu-section-title">Routers</h3>
                <ul class="menu-section-list">
                    <li v-for="item in navbar_li">
                        <router-link :to="item.href" onclick="$('.btn-bar').click()"><i class="fa" v-bind:class="item.icon"></i> {{item.title}}</router-link>
                    </li>
                </ul>
            </section>
        </nav>

        <main id="panel">
            <div class="btn btn-bar" v-on:click="openSlideout()">
                <i class="fa fa-bars"></i> SS panel
                <img src="https://www.gravatar.com/avatar/" alt="" class="header-img pull-right img-circle">
                <strong class="pull-right" v-if="name">{{name}} </strong>
            </div>

            <div class="panel content">
                <div class="panel-body">
                    <router-view></router-view>
                </div>
            </div>

            <footer id="footer">
                <div class="footer">
                    <strong>Copyright © 2014-2017 sspanel.org</strong> All rights reserved.
                </div>
            </footer>
        </main>
    </div>
    </div>
</template>

<script>
    export default {
        mounted() {

            this.slideout = new Slideout({
                'panel': document.getElementById('panel'),
                'menu': document.getElementById('menu'),
                'padding': 256,
                'tolerance': 70
            });

            var that = this;
            axios.get("/isLogin").then(function (rsp) {
                if (rsp.data.status_code == 500) {
                    that.navbar_li.push(
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
                    )
                } else {
                    that.name = rsp.data.data.name
                    that.navbar_li.push(
                        {
                            href: 'dashboard',
                            title: '控制台',
                            icon: {
                                'fa-cube': true
                            }
                        },
                        {
                            href: "logout",
                            title: "退出",
                            icon: {
                                'fa-sign-out': true
                            }
                        }
                    )
                }
            });
        },

        methods: {
            openSlideout: function () {
                this.slideout.toggle()
            }
        },

        data() {
            return {
                navbar_li: [
                    {
                        href: '/',
                        title: '主页',
                        icon: {
                            'fa-home': true
                        }
                    }
                ],
                slideout: '',
                name: ''
            }
        }
    }

</script>