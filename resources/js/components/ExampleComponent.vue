<template>
<div class="row">
    <input v-model="amt" type="number" name="qty" value="qty" class="form-control col-lg-6" placeholder= "quantity" style="margin:8px;">
    <input v-if="this.amt>0" class="btn-primary col-12" type="submit" value="加入清單" style="margin:8px;">
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
        },

        data: function () {
            return {
                amt:'',
            }
        },
        computed: {
            actionButton:function (){
                if (this.amt){
                return ''}
                else{
                return ''
                }
            }
        }
    }
</script>
