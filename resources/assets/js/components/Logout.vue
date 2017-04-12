<template>
</template>

<script>
    export default {
        mounted () {
            this.$store.state.list = this.$store.state.unloginList

            axios.post("/logout").then(function(rsp){
                if (rsp.data.status_code == 200) {
                    location.href='/#/';
                    toastr.success("退出成功");
                }
            });
        }
    }
</script>
