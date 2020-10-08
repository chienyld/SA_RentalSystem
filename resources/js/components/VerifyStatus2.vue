<template>
    <button v-if="statusButton()" class="btn-primary">{{statusText()}}</button>
    <button v-else class="btn-danger">{{statusText()}}</button>
</template>

<script>
    export default {
        props: ['status'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function () {
            return {
                status: borrow.status,
            }
        },
        computed: {
            statusText() {
                return (this.status) ? '外借中' : '審核中';
            },
            statusButton(){
                return this.status;
            }
        }
    }
</script>
