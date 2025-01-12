@extends('cs.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.bonus_report') }}
                    </h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('messages.report') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.bonus_report') }}
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.bonus_report_details') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <section id="team">
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
                                            <input type="text" id="date" name="from" class="form-control flatpickr-basic flatpickr-input active" placeholder="Ex: YYYY-MM-DD" value="{{ app('request')->input('from') }}" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="to">{{ __('messages.date_to') }}
                                            </label>
                                            <input type="text" id="date" name="to" class="form-control flatpickr-basic flatpickr-input active" placeholder="Ex: YYYY-MM-DD" value="{{ app('request')->input('to') }}" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="type">{{ __('messages.bonus_type') }}
                                            </label>
                                            <select class="form-control" id="type" name="type" required>
                                                <option value="-">{{ __('messages.select_bonus_type') }}</option>
                                                <option value="1">{{ __('messages.withdraw') }}</option>
                                                <option value="2">{{ __('messages.insurance_to_bonus') }}</option>
                                                <option value="3">{{ __('messages.bonus_to_insurance') }}</option>
                                                <option value="4">{{ __('messages.earn') }}</option>
                                                <option value="5">{{ __('messages.direct_sponsor') }}</option>
                                                <option value="6">{{ __('messages.other') }}</option>
                                            </select>
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

            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.bonus_report_details') }}</h4>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle">{{ __('messages.date_from') }} {{$date_from}} {{__('messages.to')}} {{$date_to}} | {{__('messages.total_point_in')}} : {{$total_point_in}} | {{__('messages.total_point_out')}} : {{$total_point_out}}</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-nowrap">{{ __('messages.username') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.total_point_in') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.total_point_out') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.point_in') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.point_out') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.type') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.transactiondate_caps') }}
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($report))
                                        @foreach ($report as $param)
                                            <tr>
                                                <td>{{ $param->user ? $param->user->username : '-' }}</td>
                                                <td>{{ $param->deposit }}</td>
                                                <td>{{ $param->withdraw }}</td>
                                                <td>{{ $param->payor_user ? $param->payor_user->username : '-' }}
                                                </td>
                                                <td>{{ $param->payee_user ? $param->payee_user->username : '-' }}
                                                </td>
                                                <td>{{ $param->transaction_type }}</td>
                                                <td>{{ $param->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>{{ __('messages.no_record') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{ $report->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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
