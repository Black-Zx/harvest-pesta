@extends('cs.layouts.app')

@section('page-title', 'Edit Member')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.edit_member') }}</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">InsurBet</a>

                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.edit_member') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <section id="edit">
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
                                                <select class="form-control" name="package_id" required>
                                                    @foreach ($packages as $package)
                                                    <option value="{{ $package->id }}">{{ $package->name }}'s
                                                        {{ __('messages.package') }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="policy_number">Policy Number</label>
                                                <input type="text" class="form-control" name="policy_number" readonly aria-describedby="policy_number"/>
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

                            <div class="card-header">
                                <h4 class="card-title">{{ __('messages.personal_detail') }}</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="username">{{ __('messages.username') }}</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                            placeholder="{{ __('messages.username') }}*" value="{{ $user->username }}" maxlength="191"
                                            required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="username">{{ __('messages.apps_username') }}</label>
                                            <input type="text" class="form-control" id="apps_username" name="apps_username"
                                            placeholder="{{ __('messages.apps_username') }}*" value="{{ $user->apps_username }}" maxlength="191"
                                            required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">{{ __('messages.fullname') }}</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                            placeholder="{{ __('messages.fullname') }}*" value="{{ $user->name }}" maxlength="191"
                                            required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="line_account">{{ __('messages.line_account') }}</label>
                                            <input type="text" class="form-control" id="line_account" name="line_account"
                                            placeholder="{{ __('messages.line_account') }}*" value="{{ $user->line_account }}" maxlength="191"
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
                                                <input type="number" class="form-control" placeholder="{{ __('messages.tel') }}*"
                                                    id="contact_number" name="contact_number"
                                                    value="{{ $user->contact_number }}" maxlength="10" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">{{ __('messages.email') }}</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="{{ __('messages.email') }}*" maxlength="191" value="{{ $user->email }}"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="gender">{{ __('messages.gender') }}</label>
                                            <select class="form-control" id="gender" name="gender" required>
                                                <option value="1" @if ($user->gender == 1) selected @endif>{{ __('messages.male') }}
                                                </option>
                                                <option value="0" @if ($user->gender == 0) selected @endif>
                                                    {{ __('messages.female') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="dob">{{ __('messages.dob') }}</label>
                                            <input type="text" id="dob" name="dob"
                                                class="form-control flatpickr-basic flatpickr-input active"
                                                placeholder="Ex: YYYY-MM-DD" value="{{ $user->dob }}"
                                                readonly="readonly" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                name="bank_account" placeholder="{{ __('messages.bank_account_number') }}*"
                                                value="{{ $user->bank_account }}" maxlength="191" required>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label
                                                for="bank_account_name">{{ __('messages.bank_account_name') }}</label>
                                            <input type="text" class="form-control" id="bank_account_name"
                                                name="bank_account_name" placeholder="{{ __('messages.bank_account_name') }}*"
                                                value="{{ $user->bank_account_name }}" maxlength="191" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="bank_id">{{ __('messages.bank_name') }}</label>
                                            <select class="select2 form-control" id="bank_id" name="bank_id" required>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}" @if ($user->bank_id == $bank->id) selected @endif>{{ $bank->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->
                                </div>


                                <input type="submit" class="btn btn-primary waves-effect waves-float waves-light"
                                value="{{ __('messages.submit') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form action="{{ route('cs.changePassword') }}" method="POST">
                @csrf
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('messages.login_password_detail') }}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password">{{ __('messages.new_login_password') }}
                                            </label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                maxlength="191" required>
                                            <input type="hidden" class="form-control" name="id"
                                                value="{{ $user->id }}" required>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary waves-effect waves-float waves-light"
                                    value="{{ __('messages.submit') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.direct_bonus') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <form action="{{ route('cs.createBonus') }}" method="POST">
                                            @csrf
                                            <label for="deposit">{{ __('messages.direct_bonus_amount') }}</label>
                                            <input type="number" step=".01" class="form-control" name="deposit"
                                                required>
                                            <input type="hidden" name="user_id" value="{{ $user->id }}" required>
                                            <input type="hidden" name="type" value="5" required>

                                            <input type="submit"
                                                class="btn btn-primary waves-effect waves-float waves-light mt-2"
                                                value="{{ __('messages.submit') }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.other_bonus1') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <form action="{{ route('cs.createBonus') }}" method="POST">
                                            @csrf
                                            <label for="deposit">{{ __('messages.other_bonus_amount') }}</label>
                                            <input type="number" class="form-control" name="deposit"
                                                required>
                                            <input type="hidden" name="user_id" value="{{ $user->id }}" required>
                                            <input type="hidden" name="type" value="6" required>
                                            <input type="submit"
                                                class="btn btn-primary waves-effect waves-float waves-light mt-2"
                                                value="{{ __('messages.submit') }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Insurance Point</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <form action="{{ route('cs.addInsurancePoint') }}" method="POST">
                                            @csrf
                                            <input type="hidden" class="form-control" name="id"
                                                value="{{ $user->id }}" required>

                                            <label for="deposit">{{ __('messages.purchase_amount') }}
                                            </label>
                                            <input type="number" class="form-control" name="deposit" required>    
                                            
                                            <input type="submit" class="btn btn-primary waves-effect waves-float waves-light mt-2"
                                            value="{{ __('messages.submit') }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.block_user') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <form action="{{ route('cs.updateBlockStatus') }}" method="POST">
                                            @csrf
                                            <label for="deposit">{{ __('messages.status') }}</label>
                                            <input type="text" class="form-control" id="block" name="block" value="{{$user->block?'Block':'Unblock'}}" readonly>
                                            <input type="hidden" name="id" value="{{ $user->id }}" required>
                                            @if($user->block)
                                            <input type="hidden" name="block" value="0" required>

                                            <input type="submit"
                                                class="btn btn-primary waves-effect waves-float waves-light mt-2"
                                                value="{{ __('messages.unblock') }}">
                                            @elseif($user->block == 0)
                                            <input type="hidden" name="block" value="1" required>

                                            <input type="submit"
                                                class="btn waves-effect waves-float waves-light mt-2 btn-danger"
                                                value="{{ __('messages.block') }}">
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            var package_users = {!! json_encode($package_users) !!};

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
            }
            });
            $repeater.setList(package_users);
        })(window, document, jQuery);
        </script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: '{{ __('.messages.thank_you.') }}',
                text: 'You request was submitted!',
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        </script>
    @endif
@endpush
