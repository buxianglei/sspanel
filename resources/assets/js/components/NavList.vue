<template>
    <nav id="menu" class="menu">
        <section class="menu-section">
            <h3 class="menu-section-title">Routers</h3>
            <ul class="menu-section-list">
                <li v-for="item in this.$store.state.list">
                    <router-link :to="item.href" onclick="$('.btn-bar').click()"><i class="fa" v-bind:class="item.icon"></i> {{item.title}}</router-link>
                </li>
            </ul>
        </section>
    </nav>
</template>
<script>
    export default {
    }
</script>