@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <b>comment :</b> 
                    @if(!empty($user->comment))
                        {{$user->comment}}
                    @else 
                        <b class="text-danger">No Comment</b>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
