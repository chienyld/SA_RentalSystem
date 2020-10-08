@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div>
            <div class="panel panel-default">
                <div class="panel-heading">Borrow</div>

                <div class="panel-body">
                    <h3>Your Borrows</h3>
                    @if($borrows)
                        <table class="table table-striped">
                            <tr>
                                <th>申請單位</th>
                                <th>品項</th>
                                <th>數量</th>
                                <th>申請日期</th>
                                <th>狀態</th>
                                <th></th>
                            </tr>
                            @foreach($borrows as $borrow)
                                <tr>
                                    
                                    <td>{{$borrow->user_id}}</td>
                                    <td>{{$borrow->name}}</td>
                                    <td>{{$borrow->qty}}</td>
                                    <td>{{$borrow->created_at}}</td> 
                                    
                                    <td>
                                    <div v-if="{{$borrow->status}}"><button class="statusbtn btn btn-success">已通過</button></div>
                                    <div v-else><button class="statusbtn btn btn-danger">審核中</button></div>
                                    </td> 
                                    <td>
                                    @if(Auth::user()->privilege=='sa_admin')
                                    <!--<div v-if="{{$borrow->status}}"><button onclick="location.href='/send/verify'" class="btn btn-success">同意申請</button></div>
                                    <div v-else><button onclick="location.href='/send/verify'" class="btn btn-danger">取消同意</button></div>-->
                                    <verify-status status="{{ $borrow->status }}" id="{{ $borrow->user_id }}" items="{{ $borrow->name }}"></verify-status>
                                    @else
                                    <div v-if="{{$borrow->status}}">請於中午至學務處領取器材</div>
                                    <div v-else>審核進行中，請稍後</div>
                                    @endif
                                    </td>                          
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no borrows</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
