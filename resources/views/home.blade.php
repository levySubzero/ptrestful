@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div style="display: flex; justify-content: center;">
                        <h5 class="">Hello {{ auth()->user()->name }}</h5>
                    </div>
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        
                            <div class="my-1">
                                <a href="{{ route('info.new') }}" class="btn btn-sm btn-success">Add</a>
                            </div>
                        
                        <div class="my-1">
                            <a href="{{ route('info.all') }}" class="btn btn-sm btn-primary">View Users' info</a>
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
