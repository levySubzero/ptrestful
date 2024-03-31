@extends('layouts.app')
@section('content')
        <div class="row" style="margin:0px;">
            <div class="col-lg-6 form-area side-area" data-background="{{asset('assets/dashboard/images/vuka-logo.png')}}">
               
            </div>
            <div class="col-lg-6 form-area" style="background-color: inherit">
                    <h4 class="logo-text mb-15"><strong>@lang('Recover Account')</strong></h4>
                    <form action="{{ route('password.verify.code') }}" method="POST" class="cmn-form mt-30">
                        @csrf
                        <div class="form-group">
                            <label>@lang('Verification Code')</label>
                            <input type="text" name="code" id="code" class="form-control">
                        </div>
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <a href="{{ route('password.request') }}" class="text-muted text--small">@lang('Try to send again')</a>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="submit-btn mt-25 ">@lang('Verify Code') <i class="las la-sign-in-alt"></i></button>
                        </div>
                    </form>
            </div>

        </div>
@endsection
