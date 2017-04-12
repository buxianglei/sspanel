<template>
    <div id="recharge">
        <modal>
            <h3 slot="header"> {{modal_title}} </h3>
            <p slot="body"
               v-html="modal_body"></p>
        </modal>
    
        <div class="box">
            <div class="box-header">
                <i class="fa fa-cube"></i>
                <h2 class="box-title">充值</h2>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="amount">充值金额</label>
                    <input class="form-control"
                           id="amount"
                           placeholder="请输入充值金额"
                           type="number"
                           v-model="amount" />
                </div>
                <div class="form-group">
                    <button class="btn btn-sm btn-success"
                            @click="recharge">充值</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted () {
        this.$store.state.list = this.$store.state.loginedList  
    },
    methods: {
        recharge: function () {
            var that = this

            if (this.amount == '') {
                toastr.error('充值金额不可为空')
                return false;
            }
            var rsp = axios.post('/api/v1/recharge', {
                amount: this.amount
            }).then(function (rsp) {
                if (rsp.data.status_code == 200) {
                    that.modal_title = '支付宝二维码'
                    that.modal_body = '\
                                <img class="img-responsive img-rounded" src="https://api.qrserver.com/v1/create-qr-code/?data='+ rsp.data.data + '" >\
                                 '
                    that.$store.state.showModal = true;
                } else {
                    toastr.error(rsp.data.data);
                }
            });
        }
    },
    data() {
        return {
            amount: '',
            modal_title: '',
            modal_body: ''
        }
    }
}
</script>
