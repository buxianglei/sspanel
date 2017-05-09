<template>
    <div class="app">

        <router-view name="nav"></router-view>

        <main id="panel">
            <div class="btn btn-bar" v-on:click="openSlideout()">
                <i class="fa fa-bars"></i> 阿祁加速器
                <a href="https://cn.gravatar.com/" target="_blank" v-if="avatar"><img :src="avatar" :alt="name" class="header-img pull-right img-circle"></a>
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
                if (rsp.data.status_code == 200) {
                    that.name = rsp.data.data.name
                    that.avatar = rsp.data.data.avatar
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
                slideout: '',
                name: null,
                avatar: null
            }
        }
    }

</script>