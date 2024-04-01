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
                        <h5 class="">Hello, Welcome to MyApi</h5>
                    </div>

                    {{ __('Login to interact!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
