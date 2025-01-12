@extends('cs.layouts.app')

@section('page-title', 'Bank Detail')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.bank_details') }}</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('messages.customer_service') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.bank_details') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="bankDetail">
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('messages.bank_details') }}</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="bankAccount">{{ __('messages.bank_account_number') }}
                                            </label>
                                            <input type="text" id="bankAccount" name="bank_account" class="form-control"
                                                value="{{ $bankDetail->bank_account }}" required>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="bankAccountName">{{ __('messages.bank_account_name') }}
                                            </label>
                                            <input type="text" id="bankAccountName" name="bank_account_name"
                                                class="form-control" value="{{ $bankDetail->bank_account_name }}"
                                                required>
                                        </div>
                                    </div> -->

                                    <!-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="bank_id">{{ __('messages.bank_name') }}</label>
                                            <select class="select2 form-control" id="bank_id" name="bank_id" required>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}" @if ($bankDetail->bank_id == $bank->id) selected @endif>{{ $bank->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->
                                </div>
                                
                                <input type="submit" id="submit"
                                    class="btn btn-primary waves-effect waves-float waves-light"
                                    value="{{ __('messages.submit') }}">
                            </div>
                        </div>
                    </div>
                </div>
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
