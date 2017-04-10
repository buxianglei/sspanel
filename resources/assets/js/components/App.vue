<template>
    <div class="app">
        <nav class="navbar appbar navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
                        <i class="fa fa-bars"
                           aria-hidden="true"></i>
                    </button>
                    <a class="navbar-brand" href="#">SS panel</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li v-for="(li, index) in navbar_li">
                            <router-link onclick="$('button.navbar-toggle').click()" :to="li.href">{{li.title}}</router-link>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

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
    </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            $(".router-link-active").click(function () {
                $("button.navbar-toggle").click()
            });

            var that = this;
            axios.get("/isLogin").then(function (rsp) {
                if (rsp.data.status_code == 500) {
                    that.navbar_li.push(
                        {
                            href: "login",
                            title: "登录"
                        },
                        {
                            href: "register",
                            title: "注册"
                        }
                    )
                } else {
                    that.navbar_li.push(
                        {
                            href: 'dashboard',
                            title: '控制台'
                        },
                        {
                            href: "logout",
                            title: "退出"
                        }
                    )
                }
            });
        },

        data() {
            return {
                navbar_li: [
                    {
                        href: '/',
                        title: '主页'
                    }
                ]
            }
        }
    }

</script>