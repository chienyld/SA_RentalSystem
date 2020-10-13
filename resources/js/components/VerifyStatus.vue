<template>
<div>
    <button style="margin-top:5px" v-bind:class="actionButton" @click="checkstatus" v-text="statusText"></button>
</div>
</template>

<script>
    export default {
        props: ['datastatus', 'dataid' , 'dataitem','dataqty'],
        mounted() {
            /*console.log(this.datastatus);
            console.log(this.dataid);
            console.log(this.dataitem);*/
            console.log('Component mounted.');
        },

        data: function () {
            return {      
                status: this.datastatus,
                id: this.dataid,
                item:this.dataitem,
                qty:this.dataqty
            }
        },
        computed: {
            statusText:function() {
                //return (this.status) ? '確認歸還' : '取消歸還';
                if (this.status ==false){
                return '確認歸還'}
                else{
                return '取消歸還'
                }
            },
            actionButton:function (){
                if (this.status ==false){
                return 'btn btn-info'}
                else{
                return 'btn btn-danger'
                }
            }
        },
        methods: {  
            checkstatus() {
                //var _token = '<?php echo csrf_token() ?>';
                var _this=this;
                console.log(this.id);
                console.log(_this.datastatus);
                console.log(_this.dataitem);
                console.log(_this.dataqty);
                this.$http.post('/send/' + this.dataid ,{
                    id:_this.dataid,
                    item:_this.dataitem,
                    status:_this.datastatus,
                    qty:_this.dataqty
                }).then(function(success) {
                    window.location = "/send";
                    console.log(_this.dataqty);
                    //this.status = JSON.parse(status);
                    console.log(_this.status);
                    //console.log(response.data);
                        }, function(error) {
                            console.log(error);
                        });/*
                    .then(response => {
                        this.status = ! this.status;
                        console.log(response.data);
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = '/send';
                        }
                    });*/
            }
        }
    }
</script>
