<template>
    <div id="dashboard">
        <modal>
            <h3 slot="header"> {{modal_title}} </h3>
            <p slot="body"
               v-html="modal_body"></p>
        </modal>

        <div id="user-info">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-cube"></i>
                    <h2 class="box-title">
                                                            我的信息
                                                        </h2>
                </div>
                <div class="box-body">
                    <p>账户余额: <b>¥ {{amount}}</b>
                        <router-link to="recharge"
                                     class="btn btn-xs btn-success">充值</router-link>
                    </p>
                    <p>节点名称: <b> {{node_name}}</b></p>
                    <p>套餐名称: <b v-show="!plan">
                                        无
                                  <router-link to="plan"
                                    class="btn btn-xs btn-success">购买套餐</router-link>
                                    </b>
                                <b v-show="plan">
                                    {{plan}}
                                </b>
                                </p>
                    <p>过期时间: <b>{{expire_time}}</b></p>
                </div>
            </div>
        </div>
        <div id="transfer">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-exchange"></i>
                    <h2 class="box-title">
                                                            我的流量
                                                        </h2>
                </div>
                <div class="box-body">
                    <div class="progress-group">
                        <div class="progress sm">
                            <div class="progress-bar progress-bar-danger progress-bar-striped active"
                                 role="progressbar"
                                 :aria-valuenow="used_percentage"
                                 aria-valuemin="0"
                                 v-bind:style="{width: used_percentage+'%', 'min-width': '10%', 'max-width': '90%'}"
                                 aria-valuemax="100">
                                已用{{used_percentage}}%
                            </div>
                            <div class="progress-bar progress-bar-success progress-bar-striped active"
                                 role="progressbar"
                                 :aria-valuenow="remaining_percentage"
                                 aria-valuemin="0"
                                 v-bind:style="{width: remaining_percentage+'%', 'min-width': '10%', 'max-width': '90%'}"
                                 aria-valuemax="100">
                                剩余{{remaining_percentage}}%
                            </div>
                        </div>
                        <span class="progress-number">已用流量: <b>{{used_transfer}} GB/{{transfer}} GB</b></span>
                    </div>
                    <p>剩余流量: <b>{{remaining_transfer}} GB</b></p>
                </div>
            </div>
        </div>
        <div id="ss-info"
             v-if="host">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-info"></i>
                    <h2 class="box-title">
                                                            SS信息
                                                        </h2>
                </div>
                <div class="box-body">
                    <p>服务器地址： <span class="label label-default pull-right">{{host}}</span></p>
                    <p>端口： <span class="label label-default pull-right">{{port}}</span></p>
                    <p>密码： <span class="label label-default pull-right">{{passwd}}</span></p>
                    <p>加密方式： <span class="label label-default pull-right">{{crypt_type}}</span></p>
                    <p>Url链接: <span class="label label-default pull-right"><a :href="url">链接地址</a></span></p>
                    <p>二维码: <span class="label label-default pull-right"><a @click="showQrcode" href="javascript:void(0)">点击查看</a></span></p>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    mounted() {
        var that = this

        axios.get("/isLogin").then(function (rsp) {
            if (rsp.data.status_code == 500) {
                that.$router.push('login');
            }
        });
        this.$store.state.list = this.$store.state.loginedList

        var that = this;
        axios.get("/api/v1/user/order").then(function (rsp) {
            if (rsp.data.status_code == 200) {
                that.host = rsp.data.data.order[0].plan.node.host
                that.port = rsp.data.data.port
                that.passwd = rsp.data.data.passwd
                that.crypt_type = rsp.data.data.order[0].plan.node.crypt_type
                that.url = rsp.data.data.url
                that.amount = rsp.data.data.user_account.amount
                that.plan = rsp.data.data.order[0].plan.name
                that.node_name = rsp.data.data.order[0].plan.node.name
                that.expire_time = rsp.data.data.order[0].expire_time
                that.used_transfer = rsp.data.data.used_transfer
                that.transfer = rsp.data.data.transfer
                that.remaining_transfer = rsp.data.data.remaining_transfer
            } else if (rsp.data.status_code == 404) {
                that.port = rsp.data.data.port
                that.passwd = rsp.data.data.passwd
                that.amount = rsp.data.data.user_account.amount
                that.used_transfer = rsp.data.data.used_transfer
                that.transfer = rsp.data.data.transfer
                that.remaining_transfer = rsp.data.data.remaining_transfer
            }
        });
    },

    computed: {
        used_percentage: function () {
            var used_percentage = this.used_transfer / this.transfer * 100;
            return used_percentage
        },
        remaining_percentage: function () {
            return this.remaining_transfer / this.transfer * 100
        }
    },

    methods: {
        showQrcode: function () {
            this.modal_title = '二维码图片'
            this.modal_body = '\
                                <img class="img-responsive img-rounded" src="https://api.qrserver.com/v1/create-qr-code/?data='+ this.url + '" >\
                                 '
            this.$store.state.showModal = true;
        }
    },

    data() {
        return {
            host: null,
            port: '...',
            passwd: '...',
            crypt_type: '...',
            url: '',
            amount: 0,
            plan: null,
            node_name: '无',
            html_no_plan: '',
            expire_time: '1970-01-01 00:00:00',
            used_transfer: 0,
            transfer: 0,
            remaining_transfer: 0,
            modal_title: '',
            modal_body: ''
        }
    }
}

</script>
