@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Borrow</div>

                <div class="panel-body">
                    <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    <h3>Your Borrows</h3>
                    @if($borrows)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($borrows as $borrow)
                                <tr>
                                    <td>{{$borrow->created_at}}</td>
                                    
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
