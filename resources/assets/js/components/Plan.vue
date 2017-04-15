<template>
    <div id="plan">
        <modal>
            <h3 slot="header"> {{modal_title}} </h3>
            <p slot="body"
               v-html="modal_body"></p>
            <p slot="footer">
                <button type="button" class="btn btn-default btn-sm" @click="goBack">取消</button>
                <button type="button" class="btn btn-danger  btn-sm" @click="close">确定</button>
            </p>
        </modal>

        <div class="box">
            <div class="box-header">
                <i class="fa fa-cube"></i>
                <h2 class="box-title">套餐列表</h2>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="available">可用节点</label>
                    <select name="available" id="available" class="form-control" v-model="node_id">
                        <option value="0">请选择</option>
                        <option :value="item.id" v-for="item in available_list">{{item.name}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="plan">可用套餐</label>
                    <select name="plan" id="plan" class="form-control" v-model="plan_id">
                        <option value="0">请选择</option>
                        <option :value="item.id" v-for="item in plan_list">{{item.name}} - ¥{{item.price}} - {{item.vaild_time}}天</option>
                    </select>
                </div>
                <div class="form-group">

                    <button type="button" class="btn btn-success btn-sm" @click="buyPlan">购买</button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted () {
            this.$store.state.list = this.$store.state.loginedList

            var that = this;
            var rsp = axios.get("/api/v1/node/available").then(function(rsp){
                if (rsp.data.status_code == 200) {
                    that.available_list = rsp.data.data;
                }
            })

            var that = this;
            axios.get("/api/v1/user/order").then(function (rsp) {
                if (rsp.data.status_code == 200) {
                    that.showWarning();
                }
            })
        },

        methods: {
            selectNode: function(){
                var that = this;
                var rsp = axios.get("/api/v1/plan/getListByNodeId/"+this.node_id).then(function (rsp) {
                    that.plan_list = rsp.data.data;
                })
            },
            showWarning: function () {
                this.modal_title = '警告'
                this.modal_body = '\
                                  <b class="text-danger">您已经开通过套餐且在有效期中，是否重复开通？</b>\
                                     '
                this.$store.state.showModal = true;
            },

            close: function () {
                this.$store.state.showModal = false
            },

            goBack: function () {
                this.$store.state.showModal = false
                this.$router.go(-1)
            },

            buyPlan: function(){
                if (this.node_id == 0) {
                    toastr.error("请选择节点");
                    return false;
                }
                if (this.plan_id == 0) {
                    toastr.error("请选择套餐");
                    return false;
                }

                var that = this;
                var rsp = axios.post('/api/v1/user/buyPlan', {
                    plan_id: that.plan_id
                }).then(function(rsp){
                    if (rsp.data.status_code == 500) {
                        toastr.error(rsp.data.data)
                    } else {
                        toastr.success("已提交申请，请稍后查看控制台");
                    }
                })
            }
        },

        watch: {
              node_id: "selectNode"
        },

        data () {
            return {
                modal_title: null,
                modal_body: null,
                available_list: null,
                node_id: 0,
                plan_list: null,
                plan_id: 0
            }
        }
    }
</script>
