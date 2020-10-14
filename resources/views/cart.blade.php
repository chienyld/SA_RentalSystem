<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>List</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@include('inc.navbar')
<div class="row" id="app">
    <div class="row" style="margin: 2rem">
            <div class="col-lg-6 col-lg-offset-3" style="">
                <h2>我的清單</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>品項</th>
                        <th>數量</th>
                        <th>押金</th>
                        <th>編輯</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in items">
                        <td>@{{ item.id }}</td>
                        <td>@{{ item.name }}</td>
                        <td>@{{ item.quantity }}</td>
                        <td>@{{ item.price }}</td>
                        <td>
                        <button v-on:click="removeItem(item.id)" class="btn btn-sm btn-danger">移除</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table">
                    <tr>
                        <td>品項數:</td>
                        <td>@{{itemCount}}</td>
                    </tr>
                    <tr>
                        <td>總數量:</td>
                        <td>@{{ details.total_quantity }}</td>
                    </tr>
                    <!--
                    <tr>
                        <td>Sub Total:</td>
                        <td>@{{ '$' + details.sub_total.toFixed(2) }}</td>
                    </tr>-->
                    <tr>
                        <td>總押金:</td>
                        <td>@{{ '$' + details.total.toFixed(2) }} </td>
                    </tr>
                </table>
                <button v-on:click="sendItem()" class="btn-primary">送出申請</button>
        
        </div>
    </div>
</div>
</div>
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/vue"></script>
<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

<script>
    (function($) {
        var _token = '<?php echo csrf_token() ?>';
        $(document).ready(function() {
            var app = new Vue({
                el: '#app',
                data: {
                    details: {
                        sub_total: 0,
                        total: 0,
                        total_quantity: 0
                    },
                    itemCount: 0,
                    items: [],
                    item: {
                        id: '',
                        name: '',
                        price: 0.00,
                        qty: 1
                    },
                    cartCondition: {
                        name: '',
                        type: '',
                        target: '',
                        value: '',
                        attributes: {
                            description: 'Value Added Tax'
                        }
                    },
                    options: {
                        target: [
                            {label: 'Apply to SubTotal', key: 'subtotal'},
                            {label: 'Apply to Total', key: 'total'}
                        ]
                    }
                },
                mounted:function(){
                    this.loadItems();
                },
                methods: {
                    addItem: function() {
                        var _this = this;
                        this.$http.post('/cart',{
                            _token:_token,
                            id:_this.item.id,
                            name:_this.item.name,
                            price:_this.item.price,
                            qty:_this.item.qty
                        }).then(function(success) {
                            _this.loadItems();
                        }, function(error) {
                            console.log(error);
                        });
                    },
                    sendItem: function() {
                        var _this = this;
                        this.items.forEach(function(item){
                            console.log(item.id);
                            console.log(item.name);
                            console.log(item.price);
                            console.log(item.quantity);
                            console.log(_token);
                            _this.$http.post('/borrows',{
                            _token:_token,
                            id:item.id,
                            name:item.name,
                            deposit:item.price,
                            qty:item.quantity
                        }).then(function(success) {
                            _this.removeItem(item.id);
                            console.log(item);
                            alert(item.name+'申請成功，請於隔日中午至學務處領取！');

                        }, function(error) {
                            console.log(error)
                        });
                        this.items=[];
                        console.log(items);               
                        });                        
                        /*var _this = this;
                        this.$http.post('/borrows',{
                            _token:_token,
                            id:_this.item.id,
                            name:_this.item.name,
                            deposit:_this.item.price,
                            qty:_this.item.qty
                        }).then(function(success) {
                            window.location.href = "/";
                        }, function(error) {
                            console.log(error);
                        });*/
                    },
                    addCartCondition: function() {
                        var _this = this;
                        this.$http.post('/cart/conditions',{
                            _token:_token,
                            name:_this.cartCondition.name,
                            type:_this.cartCondition.type,
                            target:_this.cartCondition.target,
                            value:_this.cartCondition.value,
                        }).then(function(success) {
                            _this.loadItems();
                        }, function(error) {
                            console.log(error);
                        });
                    },
                    clearCartCondition: function() {
                        var _this = this;
                        this.$http.delete('/cart/conditions?_token=' + _token).then(function(success) {
                            _this.loadItems();
                        }, function(error) {
                            console.log(error);
                        });
                    },
                    removeItem: function(id) {
                        var _this = this;
                        this.$http.delete('/cart/'+id,{
                            params: {
                                _token:_token
                            }
                        }).then(function(success) {
                            _this.loadItems();
                        }, function(error) {
                            console.log(error);
                        });
                    },
                    loadItems: function() {
                        var _this = this;
                        this.$http.get('/cart',{
                            params: {
                                limit:10
                            }
                        }).then(function(success) {
                            _this.items = success.body.data;
                            _this.itemCount = success.body.data.length;
                            _this.loadCartDetails();
                        }, function(error) {
                            console.log(error);
                        });
                    },
                    loadCartDetails: function() {
                        var _this = this;
                        this.$http.get('/cart/details').then(function(success) {
                            _this.details = success.body.data;
                        }, function(error) {
                            console.log(error);
                        });
                    }
                }
            });
        });
    })(jQuery);
</script>

</body>
</html>