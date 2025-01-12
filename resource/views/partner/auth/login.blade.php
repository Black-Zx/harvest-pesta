@extends('partner.layouts.app')
  
@section('page-title','Login')

@section('content')
<!-- BEGIN: Content-->
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
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid login-background" src="{{ asset('/app-assets/images/pages/login-background.svg') }}" alt="Login V2" /></div>
                    </div>
                    <!-- /Left Text-->
                    <!-- Login-->
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto text-center">
                            <h2 class="card-title font-weight-bold mb-1"></h2>
                            <img class="img-fluid matic-logo" src="{{ asset('/app-assets/images/logo/logo.png') }}" alt="InsurBet Logo" />
                            <p class="card-text mb-2"></p>
                            @if(count($errors) > 0)
                                @foreach( $errors->all() as $message )
                                    <p>{{ $message }}</p>
                                @endforeach
                            @endif
                            <form class="auth-login-form mt-2" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control text-center" id="username" type="text" name="username" aria-describedby="username" autofocus="" tabindex="1" placeholder="{{ __('messages.username') }}" required/>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input class="form-control form-control-merge text-center" id="password" type="password" name="password" aria-describedby="password" tabindex="2" placeholder="{{ __('messages.password') }}" required/>
                                        <!--<div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>-->
                                        
                                    </div>
                                </div>
                                <input type="hidden" name="remember_me" value="1" />
                                <input type="submit" class="btn btn-primary btn-block" tabindex="4" value="{{ __('messages.sign_in') }}" />
                            </form>
                        </div>
                    </div>
                    <!-- /Login-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
    @if(session('success'))
    <script>
        Swal.fire({
            title: '{{ __('messages.thank_you') }}',
            text: 'The password has been resetted.',
            icon: 'success',
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    </script>
    @endif
@endpush