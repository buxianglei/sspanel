<template>
    <div id="help">

    </div>
</template>

<script>
    export default {
        mounted () {
            this.$store.state.list = this.$store.state.loginedList
        }
    }
</script>
