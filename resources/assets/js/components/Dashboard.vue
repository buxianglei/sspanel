<template>
    <div id="dashboard">
        <div id="user-info">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-cube"></i>
                    <h2 class="box-title">
                        我的信息
                    </h2>
                </div>
                <div class="box-body">
                    <p>账户余额: <b>¥ {{amount}}</b></p>
                    <p>套餐名称: <b>{{plan}}</b></p>
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
                            <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" :aria-valuenow="used_percentage"
                                aria-valuemin="0" v-bind:style="{width: used_percentage+'%', 'min-width': '10%', 'max-width': '90%'}"
                                aria-valuemax="100">
                                已用{{used_percentage}}%
                            </div>
                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" :aria-valuenow="remaining_percentage"
                                aria-valuemin="0" v-bind:style="{width: remaining_percentage+'%', 'min-width': '10%', 'max-width': '90%'}"
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
        <div id="ss-info" v-if="host">
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
                    <p>二维码: <span class="label label-default pull-right"><a v-on:click="showQrcode" data-toggle="modal" data-target=".modal">点击查看</a></span></p>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{modal_title}}</h4>
                    </div>
                    <div class="modal-body" v-html="modal_body"></div>
                    <div class="modal-footer" v-if="modal_footer" v-html="modal_footer"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
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
                    that.expire_time = rsp.data.data.order[0].expire_time
                    that.used_transfer = rsp.data.data.used_transfer
                    that.transfer = rsp.data.data.transfer
                    that.remaining_transfer = rsp.data.data.remaining_transfer
                } else {
                    toastr.error(rsp.data.data);
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
                                <img class="img-responsive img-rounded" src="https://api.qrserver.com/v1/create-qr-code/?data='+this.url+'" >\
                                 '
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
                plan: '',
                expire_time: '',
                used_transfer: 0,
                transfer: 0,
                remaining_transfer: 0,
                modal_title: '',
                modal_body: '',
                modal_footer: ''
            }
        }
    }

</script>