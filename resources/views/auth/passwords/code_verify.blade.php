@extends('layouts.app')
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                <div class="card-body">
                        <div style="display: flex; justify-content: center;">
                            <h5 class="py-3">{{ __('Recover Account') }}</h5>
                        </div>

                    <form action="{{ route('password.verify.code') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="code" class="col-md-4 col-form-label text-md-end">{{ __('Verification Code') }}</label>
                        
                            <div class="col-md-6">
                                <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center align-items-center">
                            <div class="col-md-6 d-flex justify-content-end">
                                <button type="submit" class="btn btn-dark mx-4">
                                    {{ __('Verify Code') }}
                                </button>
                            </div>
                            <div class="col-md-6"><a href="{{ route('password.request') }}" class="text-muted text--small">@lang('Try to send again')</a></div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

        </div>
@endsection
