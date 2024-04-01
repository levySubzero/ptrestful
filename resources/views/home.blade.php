@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div style="display: flex; justify-content: center;">
                        <h3 class="py-3">Hello {{ auth()->user()->name }}</h3>
                    </div>
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        
                            <div class="my-1">
                                <a href="{{ route('info.new') }}" class="btn btn-outline-dark">New User</a>
                            </div>
                        
                        <div class="my-1">
                            <a href="{{ route('info.all') }}" class="btn btn-dark">View Users' info</a>
                        </div>
                        <div></div>
                    </div>

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
