<template>
<div>
    <button class="btn btn-primary ml-4" @click="checkstatus" v-text="statusText"></button>
</div>
</template>

<script>
    export default {
        props: ['status1', 'id' , 'item'],
        mounted() {
            console.log('Component mounted.')
        },

        data: function () {
            return {
                status: this.status1,
            }
        },

        methods: {
            checkstatus() {
                axios.post('/send/' + this.id ,{
                    id:id,
                    item:item,
                    status:status
                })
                    .then(response => {
                        this.status = ! this.status;

                        console.log(response.data);
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = '/send';
                        }
                    });
            }
        },

        computed: {
            statusText() {
                return (this.status) ? '同意申請' : '取消同意';
            }
        }
    }
</script>
