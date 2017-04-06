<template>
    <div id="dashboard">
        <p>服务器地址： <span class="label label-default pull-right">{{host}}</span></p>
        <p>端口： <span class="label label-default pull-right">{{port}}</span></p>
        <p>密码： <span class="label label-default pull-right">{{passwd}}</span></p>
        <p>加密方式： <span class="label label-default pull-right">{{crypt_type}}</span></p>
        <p>Url链接: <span class="label label-default pull-right"><a :href="url">url</a></span></p>
    </div>
</template>

<script>
    export default {
        mounted () {
            var that = this;
            axios.get("/api/v1/user/order").then(function(rsp){
                that.host = rsp.data.data.order[0].plan.node.host
                that.port = rsp.data.data.port
                that.passwd = rsp.data.data.passwd
                that.crypt_type = rsp.data.data.order[0].plan.node.crypt_type
                that.url = rsp.data.data.url
                console.log(rsp)
            });
        },

        data () {
            return {
                host: '...',
                port: '...',
                passwd: '...',
                crypt_type: '...',
                url: ''
            }
        }
    }
</script>
