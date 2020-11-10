<template>
<div>
    <button class="statusbtn btn" v-bind:class="actionButton" v-text="statusText" style="padding-right:19px;padding-left:19px"></button>
</div>
</template>

<script>
    export default {
        props: ['datastatus'],
        mounted() {
            /*console.log(this.datastatus);
            console.log(this.dataid);
            console.log(this.dataitem);*/
            console.log('Component mounted.');
        },

        data: function () {
            return {      
                status: this.datastatus,
            }
        },
        computed: {
            statusText:function() {
                if (this.status ==false){
                return '外借中'}
                else{
                return '已歸還'
                }
            },
            actionButton:function (){
                if (this.status ==false){
                return 'btn-danger'}
                else{
                return 'btn-success'
                }
            }
        }
    }
</script>
