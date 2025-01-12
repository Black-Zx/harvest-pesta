@extends('cs.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.protection_report') }}
                    </h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('messages.report') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.protection_report') }}
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

            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.protection_report') }}</h4>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle">{{ __('messages.date_from') }} {{$date_from}} {{__('messages.to')}} {{$date_to}}</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-nowrap">{{ __('messages.username') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.fullname') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.email') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.phone_number') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.apps_username') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.protection_status') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.current_plan') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($report))
                                        @foreach ($report as $param)
                                            <tr>
                                                <td>{{ $param->username }}</td>
                                                <td>{{ $param->name }}</td>
                                                <td>{{ $param->email }}</td>
                                                <td>{{ $param->contact_number }}</td>
                                                <td>{{ $param->apps_username }}</td>
                                                <td>{{ $param->protection_state == 1 ? __('messages.protected') : __('messages.unprotected') }}</td>
                                                <td>{{ $param->package->name }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td> {{ __('messages.no_record') }}</td>
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
