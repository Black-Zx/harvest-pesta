@extends('admin.layouts.app')

@section('page-title', 'RSVP')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">RSVP</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Rue1664</a></li>
                            <li class="breadcrumb-item active">RSVP</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="create">
            <form action="{{route('admin.rsvpUser')}}" method="POST">
                @csrf
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $message)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    <div class="alert-body">
                                        <i data-feather="info" class="mr-50 align-middle"></i>
                                        {{ $message }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('messages.personal_detail') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">{{ __('messages.fullname') }}</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="{{ __('messages.fullname') }}" maxlength="191">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="contact_number">{{ __('messages.tel') }}</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="tel-prefix">+60</span>
                                                </div>
                                                <input type="number" class="form-control"
                                                    placeholder="{{ __('messages.tel') }}" id="contact_number"
                                                    name="contact_number" maxlength="10">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">{{ __('messages.email') }}</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="{{ __('messages.email') }}*" maxlength="191" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">NRIC</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="NRIC" maxlength="191">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="submit" id="submit" class="btn btn-primary waves-effect waves-float waves-light"
                    value="{{ __('messages.submit') }}">
            </form>
        </section>

        <div aria-live="polite" aria-atomic="true" style="position: relative">
            <div id="notification-body" style="position: fixed; top: 1rem; right: 1rem; margin-left: 1rem; z-index: 1030">
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    <script>
        (function(window, document, $) {
            $("#referral_username").focusout(function() {
                $.ajax({
                    url: "{{ route('helpers.findUserByUsername') }}",
                    type: "POST",
                    data: {
                        username: $(this).val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {

                            if (response.data.length) {
                                $('#referral_fullname').val(response.data[0].name);
                                $('#referral_id').val(response.data[0].id);
                                $('#submit').removeAttr('disabled');
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'No this user!',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                });

                                $('#submit').attr('disabled', 'disabled');
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'No this user!',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });

                        $('#submit').attr('disabled', 'disabled');
                    },
                });
            });
            $("#name").focusout(function() {

            $('#bank_account_name').val($(this).val());
            });

            $repeater = $('.invoice-repeater, .repeater-default').repeater({
            show: function () {
                $(this).slideDown();
                // Feather Icons
                if (feather) {
                feather.replace({ width: 14, height: 14 });
                }
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
                }
            },
            isFirstItemUndeletable: true
            });
        })(window, document, jQuery);
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: '{{ __('messages.thank_you') }}',
                text: '{{ __('messages.success_msg') }}',
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        </script>
    @endif
@endpush
