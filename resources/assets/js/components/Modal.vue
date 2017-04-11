<template>
    <div id="modal">
        <div class="modal-mask"
             v-show="this.$store.state.showModal"
             transition="modal">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header">
                        <div class="pull-right">
                            <i class="fa fa-close"
                               @click="close"></i>
                        </div>
                        <slot name="header"> Default Header </slot>
    
                    </div>
                    <div class="modal-body">
                        <slot name="body"> Default Body </slot>
                    </div>
                    <div class="modal-footer">
                        <slot name="footer">
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        close: function () {
            this.$store.state.showModal = false
        }
    }
}
</script>