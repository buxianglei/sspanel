<template>
    <div id="login">
        <div class="form-group">
            <label for="email">邮箱</label>
            <input type="email" class="form-control" id="email" v-model:value="email" placeholder="请输入邮箱地址">
        </div>
        <div class="form-group">
            <label for="password">密码</label>
            <input type="password" class="form-control" id="password" v-model:value="password" placeholder="请输入密码">
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-block" v-on:click="login">登录</button>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                email: '',
                password: ''
            }
        },

        mounted() {
            axios.get("/isLogin").then(function(rsp){
                if (rsp.data.status_code == 200) {
                    location.href='/#/'
                }
            });
        },

        methods: {
            login: function(){
                var rsp = axios.post("login", {
                    email: this.email,
                    password: this.password
                }).then(function(rsp){
                    if (rsp.data.status_code == 200) {
                        alert("登录成功");
                        location.href='/'
                    } else {
                        alert("密码错误")
                    }
                })
            }
        }
    }
</script>
