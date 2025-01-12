@extends('cs.layouts.app')

@section('page-title', 'Withdrawal')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.withdrawal') }}</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('messages.customer_service') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.withdrawal') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="withdrawal">
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
                            <h4 class="card-title">{{ __('messages.search') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <form method="GET">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="from">{{ __('messages.date_from') }}
                                            </label>
                                            <input type="text" id="from" name="from"
                                                class="form-control flatpickr-basic flatpickr-input active"
                                                placeholder="Ex: YYYY-MM-DD"
                                                value="{{ app('request')->input('from') }}" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="to">{{ __('messages.date_to') }}
                                            </label>
                                            <input type="text" id="to" name="to"
                                                class="form-control flatpickr-basic flatpickr-input active"
                                                placeholder="Ex: YYYY-MM-DD" value="{{ app('request')->input('to') }}"
                                                readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="username">{{ __('messages.username') }}
                                            </label>
                                            <input type="text" id="username" name="username" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="fullname">{{ __('messages.fullname') }}
                                            </label>
                                            <input type="text" id="name" name="name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">{{ __('messages.email') }}
                                            </label>
                                            <input type="text" id="email" name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="tel">{{ __('messages.phone_number') }}
                                            </label>
                                            <input type="text" id="contact_number" name="contact_number"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary waves-effect waves-float waves-light"
                                    value="{{ __('messages.submit') }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.withdrawal') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">{{ __('messages.username') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.fullname') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.tel') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.bank_name') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.bank_account_number') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.withdraw_amount') }}
                                            </th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.created_at') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.action') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (count($withdrawals))
                                            @foreach ($withdrawals as $withdrawal)
                                                <tr>
                                                    <td>{{ $withdrawal->user->username }}</td>
                                                    <td>{{ $withdrawal->user->name }}</td>
                                                    <td>+886 {{ $withdrawal->user->contact_number }}</td>
                                                    <td>{{ $withdrawal->user->bank->name }}</td>
                                                    <td>{{ $withdrawal->user->bank_account }}</td>
                                                    <td>{{ $withdrawal->withdraw }}</td>
                                                    <td>{{ $withdrawal->created_at }}</td>
                                                    <td>
                                                        <form action="{{ route('cs.approveBonusWithdraw') }}"
                                                            method="POST" class="mb-1">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $withdrawal->id }}">
                                                            <input type="hidden" name="state" value="1">
                                                            <label
                                                                for="remark-accept">{{ __('messages.remark') }}</label>
                                                            <div class="form-inline" style="width: 360px">
                                                                <input type="text" id="remark-accept" name="remark"
                                                                    class="form-control" maxlength="191" required>
                                                                <input type="submit"
                                                                    class="btn btn-primary waves-effect waves-float waves-light ml-1"
                                                                    value="{{ __('messages.approve') }}">
                                                            </div>
                                                        </form>
                                                        <hr>
                                                        <form action="{{ route('cs.approveBonusWithdraw') }}"
                                                            method="POST" class="mb-1">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $withdrawal->id }}">
                                                            <input type="hidden" name="state" value="-1">
                                                            <label
                                                                for="remark-reject">{{ __('messages.remark') }}</label>
                                                            <div class="form-inline" style="width: 360px">
                                                                <input type="text" id="remark-reject" name="remark"
                                                                    class="form-control" maxlength="191" required>
                                                                <input type="submit"
                                                                    class="btn btn-danger waves-effect waves-float waves-light ml-1"
                                                                    value="{{ __('messages.reject') }}">
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>{{ __('messages.no_record') }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
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
