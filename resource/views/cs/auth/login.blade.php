@extends('cs.layouts.app')

@section('page-title', 'Customer Service Login')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-v2">
                <div class="auth-inner row m-0">
                    <!-- /Brand logo-->
                    <!-- Left Text-->
                    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img
                                class="img-fluid" src="{{ asset('/app-assets/images/pages/login-v2.svg') }}"
                                alt="Login V2" /></div>
                    </div>
                    <!-- /Left Text-->
                    <!-- Login-->
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto text-center">
                            <img class="img-fluid matic-logo mb-1" src="{{ asset('/app-assets/images/logo/logo.png') }}"
                                alt="Logo" />
                            <h2 class="h3 card-title font-weight-bold mb-1"><span
                                    class="color-white">{{ __('messages.customer_service') }}</span></h2>
                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            @endif
                            <form class="auth-login-form mt-3" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" id="username" type="text" name="username"
                                        aria-describedby="username" autofocus="" tabindex="1"
                                        placeholder="{{ __('messages.username') }}" required />
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input class="form-control form-control-merge" id="password" type="password"
                                            name="password" aria-describedby="password" tabindex="2"
                                            placeholder="{{ __('messages.password') }}" required />
                                    </div>
                                </div>
                                <input type="hidden" name="remember_me" value="1" />
                                <input type="submit" class="btn btn-primary btn-block mt-2" tabindex="4"
                                    value="{{ __('messages.sign_in') }}" />
                            </form>
                        </div>
                    </div>
                    <!-- /Login-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
