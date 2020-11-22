<template>
<div>
<div class="col-12" style="display:flex;align-items:center;justify-content:center">
<div style="float:left;margin:3px"><div class="value-button" @click="decreaseValue()">-</div></div>
<div style="width:63%;float:left;margin:3px">
  <input class="form-control" name="qty" type="number" v-model="amt" value="qty" style="border-radius:45px"/>
</div>
<div style="float:left;margin:3px"><div class="value-button" v-on:click="increaseValue()">+</div></div>
</div>
<div class="col-12" style="display:flex;align-items:center;justify-content:center">
<div style="width:100vh;padding:30px 95px 0px 95px">
<input v-if="this.amt>0" class="btn-primary col-10 offset-1" type="submit" value="加入清單" style="border-radius:50px">
</div>
</div>
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

