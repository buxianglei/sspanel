<template>
</template>

<script>
    export default {
        mounted () {
            var that = this;
            this.$store.state.list = this.$store.state.unloginList

            axios.post("/logout").then(function(rsp){
                if (rsp.data.status_code == 200) {
                    that.$router.push('/');
                    toastr.success("退出成功");
                }
            });
        }
    }
</script>
