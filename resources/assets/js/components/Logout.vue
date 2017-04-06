<template>
    <p>dashboard</p>
</template>

<script>
    export default {
        mounted () {
            axios.post("/logout").then(function(rsp){
                if (rsp.data.status_code == 200) {
                    location.href='/'
                }
            });
        }
    }
</script>
