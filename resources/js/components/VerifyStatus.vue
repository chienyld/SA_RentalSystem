<template>
<div>
    <button class="btn btn-primary ml-4" @click="checkstatus" v-text="statusText"></button>
</div>
</template>

<script>
    export default {
        props: ['datastatus', 'dataid' , 'dataitem'],
        mounted() {
            console.log(this.datastatus);
            console.log(this.dataid);
            console.log(this.dataitem);
            console.log('Component mounted.');
        },

        data: function () {
            return {      
                status: this.datastatus,
                id: this.dataid,
                item:this.dataitem,
                buttoncheck:true
            }
        },
        computed: {
            cache: false,
            statusText() {
                return (this.status) ? '確認歸還' : '取消歸還';
            }
        },
        methods: {  
            checkstatus() {
                //var _token = '<?php echo csrf_token() ?>';
                var _this=this;
                console.log(this.id);
                console.log(_this.datastatus);
                console.log(_this.dataitem);
                this.$http.post('/send/' + this.dataid ,{
                    id:_this.dataid,
                    item:_this.dataitem,
                    status:_this.datastatus
                }).then(function(success) {
                    window.location = "/send";
                    console.log(_this.status);
                    console.log(response.data);
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
