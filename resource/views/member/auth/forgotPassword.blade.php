@extends('member.layouts.app')

@section('page-title', 'Login')

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
                    <!-- Forgot Password v1 -->
                    <div class="card mb-0">
                        <div class="card-header logo-wrapper mb-2">
                            <img class="img-fluid matic-logo mx-auto"
                                    src="{{ asset('/app-assets/images/logo/logo.png') }}" alt="InsurBet Logo" width="300"/>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-1">{{ __('messages.forgot_password') }}🔒</h4>
                            <p class="card-text mb-2">{{ __('messages.email_instruct') }}</p>

                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $message)
                                    <p class="text-danger">{{ $message }}</p>
                                @endforeach
                            @endif

                            <form class="auth-forgot-password-form mt-2" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email" class="form-label">{{ __('messages.email') }}</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="john@example.com" aria-describedby="email" tabindex="1" autofocus
                                        required />
                                </div>

                                <input type="submit" class="btn btn-primary btn-block" tabindex="2"
                                    value="{{ __('messages.reset_link') }}">
                            </form>

                            <p class="text-center mt-2">
                                <a href="{{ route('member.showLoginForm') }}"> <i data-feather="chevron-left"></i>
                                    {{ __('messages.back_to_login') }} </a>
                            </p>
                        </div>
                    </div>
                    <!-- /Forgot Password v1 -->
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                title: '{{ __('messages.thank_you') }}',
                text: 'The link has been sent to your email.',
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        </script>
    @endif
@endpush
