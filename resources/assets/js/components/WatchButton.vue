<template>
    <button class="icon-button mr-2" @click="watch" type="submit">
        <i class="fas fa-eye" v-bind:class="wclasses"></i>
    </button>
</template>

<script>
    export default {
        props: ['active'],

        methods: {
            watch() {
                axios[(this.active ? 'delete' : 'post')](location.pathname + '/watch');
                this.active = !this.active;
            }
        },

        computed: {
            wclasses: function () {
                return {
                    'active-button': this.active
                }
            }
        }
    }
</script>

<style scoped>

</style>