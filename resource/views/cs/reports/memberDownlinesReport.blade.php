@extends('cs.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.member_downline') }}
                    </h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('messages.report') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.member_downline') }}
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
                                {{-- <div class="col-md-6 col-12">
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
                                    </div> --}}
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
                            <h4 class="card-title">{{ __('messages.member_downline') }} 
                                    @foreach ($ancestors as $ancestor)
                                        >
                                        <a href="{{ route('cs.reports.memberDownlinesReport', $ancestor->id) }}">{{$ancestor->username}}</a> 
                                    @endforeach
                            </h4>   
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle">{{__('messages.total_protection_point_ucwords')}} : {{$total_insurance_point}} | {{__('messages.team_total_sale_ucwords')}} : {{$total_bonus}} | {{__('messages.total_direct_bonus_ucwords')}} : {{$total_direct_bonus}} | {{__('messages.total_other_bonus_ucwords')}} : {{$total_other_bonus}} | {{__('messages.total_downline_ucwords')}} : {{$total_downline}}</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-nowrap">{{ __('messages.action') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.username') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.fullname') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.current_plan') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.protection_status') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.rank_title') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.superior_member') }}</th>
                                        <th scope="col" class="text-nowrap">
                                        {{ __('messages.total_protection_point') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.team_total_sale') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.direct_bonus') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.other_bonus1') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.total_downline') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.email') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('messages.phone_number') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($report))
                                        @foreach ($report as $param)
                                            <tr>
                                                <td>
                                                    <a class="d-flex align-items-center"
                                                        href="{{ route('cs.reports.memberDownlinesReport', $param->id) }}">
                                                        <button type="button" class="btn btn-outline-primary"
                                                            id="modal{{ $param->id }}">
                                                            {{ __('messages.more_details') }}
                                                        </button>
                                                    </a>
                                                </td>
                                                <td>{{ $param->username }}</td>
                                                <td>{{ $param->name }}</td>
                                                <td>{{ $param->package }}</td>
                                                <td>{{ $param->protection_state == 1 ? __('messages.protected') : __('messages.unprotected') }}</td>
                                                <td>{{ $param->rank }}</td>
                                                <td>{{ $param->upper_line_user }}</td>
                                                <td>{{ $param->totalInsurancePoint }}</td>
                                                <td>{{ $param->totalBonus }}</td>
                                                <td>{{ $param->direct_bonus }}</td>
                                                <td>{{ $param->other_bonus }}</td>
                                                <td>{{ $param->downline }}</td>
                                                <td>{{ $param->email }}</td>
                                                <td>{{ $param->contact_number }}</td>
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
                            {{ $report->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
