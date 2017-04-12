<template>
    <div id="register" class="col-md-4 col-md-offset-4">
        <div class="form-group">
            <label for="name">用户名</label>
            <input type="text" class="form-control" id="name" v-model="name" placeholder="请输入用户名">
        </div>
        <div class="form-group">
            <label for="email">邮箱</label>
            <input type="email" class="form-control" id="email" v-model:value="email" placeholder="请输入邮箱地址">
        </div>
        <div class="form-group">
            <label for="password">密码</label>
            <input type="password" class="form-control" id="password" v-model:value="password" placeholder="请输入密码">
        </div>
        <div class="form-group">
            <label for="password_confirmation">确认密码</label>
            <input type="password" class="form-control" id="password_confirmation" v-model:value="password_confirmation" placeholder="请确认密码">
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-block" v-on:click="register">注册</button>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        },

        mounted() {
            axios.get("/isLogin").then(function(rsp){
                if (rsp.data.status_code == 200) {
                    location.href='/#/dashboard'
                }
            });

            this.$store.state.list = this.$store.state.unloginList
        },

        methods: {
            register: function(){
                if (this.name == '') {
                    toastr.error("用户名不能为空");
                    return false;
                }
                if (this.name == '') {
                    toastr.error("邮箱不能为空");
                    return false;
                }
                if (this.name == '') {
                    toastr.error("密码不能为空");
                    return false;
                }
                if (this.name == '') {
                    toastr.error("确认密码不能为空");
                    return false;
                }
                var rsp = axios.post("/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }).then(function(rsp){
                    if (rsp.data.status_code == 200) {
                        toastr.success("注册成功");
                        location.href='/#/dashboard'
                    } else {
                        for (var value in rsp.data) {
                            var msg = rsp.data[value][0];
                            toastr.error(msg);
                        }
                    }
                })
            }
        }
    }
</script>
