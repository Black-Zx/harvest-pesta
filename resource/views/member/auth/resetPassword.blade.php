@extends('member.layouts.app')
  
@section('page-title','Login')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-v1 px-2">
                <div class="auth-inner py-2">
                    <!-- Reset Password v1 -->
                    <div class="card mb-0">
                        <div class="card-body">
                            <p class="text-center"><img class="img-fluid matic-logo" src="{{ asset('/app-assets/images/logo/logo.png') }}" alt="InsurBet Logo" /></p>

                            <h4 class="card-title mb-1">Reset Password 🔒</h4>
                            <p class="card-text mb-2">Your new password must be different from previously used passwords</p>

                            @if(count($errors) > 0)
                                @foreach( $errors->all() as $message )
                                    <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            @endif

                            <form class="auth-reset-password-form mt-2" action="{{ route('password.update') }}" method="POST">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" aria-describedby="email" tabindex="1" autofocus required />
                                </div>

                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="reset-password-new">New Password</label>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge" id="reset-password-new" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-new" tabindex="1" autofocus />
                                        <div class="input-group-append">
                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="reset-password-confirm">Confirm Password</label>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge" id="reset-password-confirm" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-confirm" tabindex="2" />
                                        <div class="input-group-append">
                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary btn-block" tabindex="3" value="Set New Password">
                            </form>

                            <p class="text-center mt-2">
                                <a href="{{ route('member.showLoginForm') }}"> <i data-feather="chevron-left"></i> Back to login </a>
                            </p>
                        </div>
                    </div>
                    <!-- /Reset Password v1 -->
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
