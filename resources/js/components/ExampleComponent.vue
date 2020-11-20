<template>
<div class="container-fluid">
<div class="row" style="display:inline-block;float:left">
<div style="width:15%;float:left;margin:1px"><div class="value-button" @click="decreaseValue()">-</div></div>
<div style="width:40%;float:left;margin:1px">
  <input class="form-control" type="number" v-model="amt" value="qty" />
</div>
<div style="width:15%;float:left;margin:1px"><div class="value-button" v-on:click="increaseValue()">+</div></div>
</div>
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
                amt:0,
            }
        },
        methods:{
            increaseValue: function() {
                var value = this.amt;
                value++;
                this.amt = value;
                },
            decreaseValue: function() {
                var value = this.amt;
                value--;
                this.amt = value;
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

