@extends('cs.layouts.app')

@section('page-title', 'Create Member')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.create_member') }}</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">InsurBet</a>

                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.create_member') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="create">
            <form method="POST">
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
                                <h4 class="card-title">{{ __('messages.package') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="invoice-repeater">
                                    <div data-repeater-list="packages">
                                        <div data-repeater-item class="row">
                                            <div class="col form-group">
                                                <label for="package_id">{{ __('messages.register_package') }}</label>
                                                <select class="form-control" id="package_id" name="package_id" required>
                                                    @foreach ($packages as $package)
                                                    <option value="{{ $package->id }}">{{ $package->name }}'s
                                                        {{ __('messages.package') }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col" style="align-self: center;">
                                                <button type="button" class="btn btn-outline-danger" data-repeater-delete>
                                                    <i data-feather="x" class="me-25"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-icon btn-primary" data-repeater-create>
                                        <i data-feather="plus" class="me-25"></i>
                                        <span>Add New</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('messages.referral_detail') }}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="referral_username">{{ __('messages.username') }}</label>
                                            <input type="text" class="form-control" id="referral_username"
                                                name="referral_username" placeholder="{{ __('messages.username') }}*"
                                                maxlength="191" required>
                                            <input type="hidden" name="referral_id" id="referral_id" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="referral_fullname">{{ __('messages.fullname') }}</label>
                                            <input type="text" class="form-control" id="referral_fullname"
                                                name="referral_fullname" placeholder="{{ __('messages.fullname') }}*"
                                                maxlength="191" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                                            <label for="username">{{ __('messages.username') }}</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="{{ __('messages.username') }}*" maxlength="191"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">{{ __('messages.fullname') }}</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="{{ __('messages.fullname') }}*" maxlength="191"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="line_account">{{ __('messages.line_account') }}</label>
                                            <input type="text" class="form-control" id="line_account" name="line_account"
                                                placeholder="{{ __('messages.line_account') }}*" maxlength="191"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="contact_number">{{ __('messages.tel') }}</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="tel-prefix">+886</span>
                                                </div>
                                                <input type="number" class="form-control"
                                                    placeholder="{{ __('messages.tel') }}*" id="contact_number"
                                                    name="contact_number" maxlength="10" required>
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
                                            <label for="gender">{{ __('messages.gender') }}</label>
                                            <select class="form-control" id="gender" name="gender" required>
                                                <option value="1">{{ __('messages.male') }}</option>
                                                <option value="0">{{ __('messages.female') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="dob">{{ __('messages.dob') }}</label>
                                            <input type="text" id="dob" name="dob"
                                                class="form-control flatpickr-basic flatpickr-input active"
                                                placeholder="Ex: YYYY-MM-DD" readonly="readonly" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password">{{ __('messages.password') }}</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="{{ __('messages.password') }}*" maxlength="191"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password_confirmation">{{ __('messages.password') }}</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation"
                                                placeholder="{{ __('messages.password_confirm') }}*" maxlength="191"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('messages.bank_details') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label
                                                for="bank_account">{{ __('messages.bank_account_number') }}</label>
                                            <input type="text" class="form-control" id="bank_account"
                                                name="bank_account"
                                                placeholder="{{ __('messages.bank_account_number') }}*"
                                                maxlength="191" required>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label
                                                for="bank_account_name">{{ __('messages.bank_account_name') }}</label>
                                            <input type="text" class="form-control" id="bank_account_name"
                                                name="bank_account_name"
                                                placeholder="{{ __('messages.bank_account_number') }}*"
                                                maxlength="191" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="bank_id">{{ __('messages.bank_name') }}</label>
                                            <select class="select2 form-control" id="bank_id" name="bank_id" required>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->
                                </div>

                                <div class="row mt-5">
                                    <div class="col-12">
                                        <ul>
                                            <li>{{ __('messages.create_info') }}</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-6 col-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="agreeTnc" required>
                                            <label class="custom-control-label"
                                                for="agreeTnc">{{ __('messages.terms_conditions') }}</label>
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
