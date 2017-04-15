<template>
    <div id="profile">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info"></i>
                <h2 class="box-title">设置</h2>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="user_id">用户ID</label>
                    <p>${{user_id}}</p>
                </div>
                <div class="form-group">
                    <label for="user_id">用户名</label>
                    <input class="form-control" v-model="user_name" />
                </div>
                <div class="form-group">
                    <label for="user_id">邮箱</label>
                    <input class="form-control" v-model="user_email" />
                </div>
                <div class="form-group">
                    <label for="user_id">SS密码</label>
                    <input class="form-control" v-model="ss_passwd" />
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-sm btn-success" @click="update">修改</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted: function (){
            var that = this
            this.$store.state.list = this.$store.state.loginedList

            var rsp = axios.get('/api/v1/user/profile').then(function(rsp){
                if (rsp.data.status_code == 200) {
                    that.user_id = rsp.data.data.user_id
                    that.user_name = rsp.data.data.user_name
                    that.user_email = rsp.data.data.user_email
                    that.ss_passwd = rsp.data.data.ss_passwd
                }
            })
        },

        methods: {
            update: function(){
                var that = this

                var rsp = axios.post('/api/v1/user/profile', {
                    name: that.user_name,
                    email: that.user_email,
                    passwd: that.ss_passwd
                }).then(function(rsp){
                    if (rsp.data.status_code == 200) {
                        toastr.success(rsp.data.data)
                    } else if (rsp.data.status_code == 500){
                        toastr.error(rsp.data.data)
                    } else {
                        for (var msg in rsp.data) {
                            if (rsp.data.hasOwnProperty(msg)) {
                                toastr.error(rsp.data[msg][0])
                            }
                        }
                    }
                })
            }
        },

        data() {
            return {
                user_id: null,
                user_name: null,
                user_email: null,
                ss_passwd: null
            }
        }
    }
</script>
