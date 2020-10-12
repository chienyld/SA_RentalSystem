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
                item:this.dataitem
            }
        },

        methods: {  
            checkstatus() {
                var _token = '<?php echo csrf_token() ?>';
                var _this=this;
                console.log(this.id);
                this.$http.post('/send/' + this.dataid ,{
                    id:_this.datastatus,
                    item:_this.dataid,
                    status:_this.dataitem
                }).then(function(success) {
                            _this.loadItems();
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
        },

        computed: {
            statusText() {
                return (this.datastatus) ? '同意申請' : '取消同意';
            }
        }
    }
</script>
