@extends('admin.layouts.app')
  
    
    <style>
        #modal-close {
            box-sizing: content-box;
            width: 1em;
            height: 1em;
            padding: 0.25em 0.25em;
            color: #000;
            background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
            border: 0;
            border-radius: 0.375rem;
            opacity: 0.5;
        }
    </style>

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Check In List</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('messages.admin') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Check In List
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
                                            <label for="fullname">Date
                                            </label>
                                            <input type="date" id="date" name="date" class="form-control">
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
                                            <label for="nric">Nric
                                            </label>
                                            <input type="text" id="nric" name="nric" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="mobile">Phone Number
                                            </label>
                                            <input type="text" id="mobile" name="mobile" class="form-control">
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

            
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="event1-tab" data-toggle="tab" data-target="#event1"
                            type="button" role="tab" aria-controls="event1" aria-selected="true">All</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="event2-tab" data-toggle="tab" data-target="#event2"
                            type="button" role="tab" aria-controls="event2" aria-selected="false">22th May 2024</button>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="event3-tab" data-toggle="tab" data-target="#event3"
                            type="button" role="tab" aria-controls="event3" aria-selected="false">23th May 2024</button>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="event4-tab" data-toggle="tab" data-target="#event4"
                            type="button" role="tab" aria-controls="event4" aria-selected="false">24th May 2024</button>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="event5-tab" data-toggle="tab" data-target="#event5"
                            type="button" role="tab" aria-controls="event5" aria-selected="false">25th May 2024</button>
                    </li>

                    {{-- <li class="nav-item" role="presentation" style="margin-left: 10px;">
                        <a href="{{ route('rsvp') }}">
                            <button class="nav-link active">Register User</button>
                        </a>
                    </li> --}}
                </ul>
                {{-- {{$test}} --}}
                
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="event1" role="tabpanel" aria-labelledby="event1-tab">
                        <div class="row" id="table-responsive">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Check In List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <h6>
                                                    Date : {{$date}}
                                                    <br>
                                                    Check In : {{$report1_total}} / {{$report1->total()}}
                                                </h6>
                                            </div>
                                            <div class="col-2">
                                                <form action="{{route('export.checkin')}}" method="POST">
                                                @csrf
                                                    <input type="submit" class="btn btn-primary float-right" value="Export">
                                                    <input name="type" type="hidden" value="Checkin">
                                                    <input name="event" type="hidden" value="1">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                    <th scope="col" class="text-nowrap">qr code</th>
                                                    <th scope="col" class="text-nowrap">Name</th>
                                                    <th scope="col" class="text-nowrap">Email</th>
                                                    <th scope="col" class="text-nowrap">Phone Number</th>
                                                    <th scope="col" class="text-nowrap">NRIC</th>
                                                    <th scope="col" class="text-nowrap">Register Time</th>
                                                    <th scope="col" class="text-nowrap">Event Date</th>
                                                    <th scope="col" class="text-nowrap">Check In Time</th>
                                                    <th scope="col" class="text-nowrap">Redemption Time</th>
                                                    <th scope="col" class="text-nowrap">Invited</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if (count($report1))
                                                @foreach ($report1 as $param)
                                                <tr>
                                                    <td>
                                                        @if ($param->check_in == null)
                                                        {{-- <input type="disable" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)"> --}}
                                                        
                                                            @if($param->guest == 1)
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 1)">
                                                                </form>
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="2">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 2)">
                                                                </form>
                                                            @else
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)">
                                                                </form>
                                                            @endif
                                                        
                                                        @endif

                                                        @if ($param->redemption_time->pluck('created_at')->first() == null)
                                                            <form action="{{ route('admin.redemption.checkin') }}" method="POST" class="mb-1">
                                                                @csrf
                                                                    <input type="hidden" name="id" value="{{ $param->id }}">
                                                                    {{-- <input type="hidden" name="type" value="2"> --}}
                                                                    <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Redemption">
                                                            </form>
                                                        @endif
                                                    </td> 
                                                    <td>
                                                        {{-- <a href="{{ route("admin.qrcode", ["id" =>$param->id ]) }}">View</a> --}}
                                                        <a data-target-id="{{$param->id}}" data-toggle="modal" data-target="#qrcodeModal" class="btn btn-sm btn-link qrcode_view" data-qr="{{$param->qr_code}}" id="qrcode_view">View</a>
                                                    </td>
                                                    <td>{{ $param->name }}</td>
                                                    <td>{{ $param->email }}</td>
                                                    <td>{{ $param->mobile }}</td>
                                                    <td>{{ $param->nric }}</td>
                                                    <td>{{ $param->created_at }}</td>
                                                    <td>{{ $param->date }}</td>
                                                    <td>{{ $param->check_in }}</td>
                                                    <td>{{  $param->redemption_time->pluck('created_at')->first() }}</td>
                                                    @if ($param->fixed_date == 0)
                                                        <td>N</td>
                                                    @else
                                                        <td>Y</td>
                                                    @endif
                                                    {{-- <td>{{  $param->fixed_date }}</td> --}}
                                                    {{-- <td>{{  $param->redemption->pluck('created_at') }}</td> --}}
                                                </tr>
                                                
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td> {{ __('messages.no_record') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        {{ $report1->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="event2" role="tabpanel" aria-labelledby="event2-tab">
                        <div class="row" id="table-responsive">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Check In List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <h6>
                                                    Date : {{$date}}
                                                    <br>
                                                    Check In : {{$report2_total}} / {{$report2->total()}}
                                                </h6>
                                            </div>
                                            <div class="col-2">
                                                <form action="{{route('export.checkin')}}" method="POST">
                                                @csrf
                                                    <input type="submit" class="btn btn-primary float-right" value="Export">
                                                    <input name="type" type="hidden" value="Checkin">
                                                    <input name="report_date" type="hidden" value="{{$report_date1->date ?? '-'}}">
                                                    <input name="event" type="hidden" value="5">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                    <th scope="col" class="text-nowrap">qr code</th>
                                                    <th scope="col" class="text-nowrap">Name</th>
                                                    <th scope="col" class="text-nowrap">Email</th>
                                                    <th scope="col" class="text-nowrap">Phone Number</th>
                                                    <th scope="col" class="text-nowrap">NRIC</th>
                                                    <th scope="col" class="text-nowrap">Register Time</th>
                                                    <th scope="col" class="text-nowrap">Event Date</th>
                                                    <th scope="col" class="text-nowrap">Check In Time</th>
                                                    <th scope="col" class="text-nowrap">Redemption Time</th>
                                                    <th scope="col" class="text-nowrap">Invited</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if (count($report2))
                                                @foreach ($report2 as $param)
                                                <tr>
                                                    <td>
                                                        @if ($param->check_in == null)
                                                        {{-- <input type="disable" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)"> --}}
                                                        
                                                            @if($param->guest == 1)
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 1)">
                                                                </form>
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="2">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 2)">
                                                                </form>
                                                            @else
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)">
                                                                </form>
                                                            @endif
                                                        
                                                        @endif

                                                        @if ($param->redemption_time->pluck('created_at')->first() == null)
                                                            <form action="{{ route('admin.redemption.checkin') }}" method="POST" class="mb-1">
                                                                @csrf
                                                                    <input type="hidden" name="id" value="{{ $param->id }}">
                                                                    {{-- <input type="hidden" name="type" value="2"> --}}
                                                                    <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Redemption">
                                                            </form>
                                                        @endif
                                                    </td> 
                                                    <td>
                                                        {{-- <a href="{{ route("admin.qrcode", ["id" =>$param->id ]) }}">View</a> --}}
                                                        <a data-target-id="{{$param->id}}" data-toggle="modal" data-target="#qrcodeModal" class="btn btn-sm btn-link qrcode_view" data-qr="{{$param->qr_code}}" id="qrcode_view">View</a>
                                                    </td>
                                                    <td>{{ $param->name }}</td>
                                                    <td>{{ $param->email }}</td>
                                                    <td>{{ $param->mobile }}</td>
                                                    <td>{{ $param->nric }}</td>
                                                    <td>{{ $param->created_at }}</td>
                                                    <td>{{ $param->date }}</td>
                                                    <td>{{ $param->check_in }}</td>
                                                    <td>{{  $param->redemption_time->pluck('created_at')->first() }}</td>
                                                    @if ($param->fixed_date == 0)
                                                        <td>N</td>
                                                    @else
                                                        <td>Y</td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td> {{ __('messages.no_record') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        {{ $report2->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="event3" role="tabpanel" aria-labelledby="event3-tab">
                        <div class="row" id="table-responsive">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Check In List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <h6>
                                                    Date : {{$date}}
                                                    <br>
                                                    Check In : {{$report3_total}} / {{$report3->total()}}
                                                </h6>
                                            </div>
                                            <div class="col-2">
                                                <form action="{{route('export.checkin')}}" method="POST">
                                                @csrf
                                                    <input type="submit" class="btn btn-primary float-right" value="Export">
                                                    <input name="type" type="hidden" value="Checkin">
                                                    <input name="report_date" type="hidden" value="{{$report_date2->date ?? '-'}}">
                                                    <input name="event" type="hidden" value="5">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                    <th scope="col" class="text-nowrap">qr code</th>
                                                    <th scope="col" class="text-nowrap">Name</th>
                                                    <th scope="col" class="text-nowrap">Email</th>
                                                    <th scope="col" class="text-nowrap">Phone Number</th>
                                                    <th scope="col" class="text-nowrap">NRIC</th>
                                                    <th scope="col" class="text-nowrap">Register Time</th>
                                                    <th scope="col" class="text-nowrap">Event Date</th>
                                                    <th scope="col" class="text-nowrap">Check In Time</th>
                                                    <th scope="col" class="text-nowrap">Redemption Time</th>
                                                    <th scope="col" class="text-nowrap">Invited</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if (count($report3))
                                                @foreach ($report3 as $param)
                                                <tr>
                                                    <td>
                                                        @if ($param->check_in == null)
                                                        {{-- <input type="disable" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)"> --}}
                                                        
                                                            @if($param->guest == 1)
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 1)">
                                                                </form>
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="2">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 2)">
                                                                </form>
                                                            @else
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)">
                                                                </form>
                                                            @endif
                                                        
                                                        @endif

                                                        @if ($param->redemption_time->pluck('created_at')->first() == null)
                                                            <form action="{{ route('admin.redemption.checkin') }}" method="POST" class="mb-1">
                                                                @csrf
                                                                    <input type="hidden" name="id" value="{{ $param->id }}">
                                                                    {{-- <input type="hidden" name="type" value="2"> --}}
                                                                    <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Redemption">
                                                            </form>
                                                        @endif
                                                    </td> 
                                                    <td>
                                                        {{-- <a href="{{ route("admin.qrcode", ["id" =>$param->id ]) }}">View</a> --}}
                                                        <a data-target-id="{{$param->id}}" data-toggle="modal" data-target="#qrcodeModal" class="btn btn-sm btn-link qrcode_view" data-qr="{{$param->qr_code}}" id="qrcode_view">View</a>
                                                    </td>
                                                    <td>{{ $param->name }}</td>
                                                    <td>{{ $param->email }}</td>
                                                    <td>{{ $param->mobile }}</td>
                                                    <td>{{ $param->nric }}</td>
                                                    <td>{{ $param->created_at }}</td>
                                                    <td>{{ $param->date }}</td>
                                                    <td>{{ $param->check_in }}</td>
                                                    <td>{{ $param->redemption_time->pluck('created_at')->first() }}</td>
                                                    @if ($param->fixed_date == 0)
                                                        <td>N</td>
                                                    @else
                                                        <td>Y</td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td> {{ __('messages.no_record') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        {{ $report2->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="event4" role="tabpanel" aria-labelledby="event4-tab">
                        <div class="row" id="table-responsive">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Check In List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <h6>
                                                    Date : {{$date}}
                                                    <br>
                                                    Check In : {{$report4_total}} / {{$report4->total()}}
                                                </h6>
                                            </div>
                                            <div class="col-2">
                                                <form action="{{route('export.checkin')}}" method="POST">
                                                @csrf
                                                    <input type="submit" class="btn btn-primary float-right" value="Export">
                                                    <input name="type" type="hidden" value="Checkin">
                                                    <input name="report_date" type="hidden" value="{{$report_date3->date ?? '-'}}">
                                                    <input name="event" type="hidden" value="5">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                    <th scope="col" class="text-nowrap">qr code</th>
                                                    <th scope="col" class="text-nowrap">Name</th>
                                                    <th scope="col" class="text-nowrap">Email</th>
                                                    <th scope="col" class="text-nowrap">Phone Number</th>
                                                    <th scope="col" class="text-nowrap">NRIC</th>
                                                    <th scope="col" class="text-nowrap">Register Time</th>
                                                    <th scope="col" class="text-nowrap">Event Date</th>
                                                    <th scope="col" class="text-nowrap">Check In Time</th>
                                                    <th scope="col" class="text-nowrap">Redemption Time</th>
                                                    <th scope="col" class="text-nowrap">Invited</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if (count($report4))
                                                @foreach ($report4 as $param)
                                                <tr>
                                                    <td>
                                                        @if ($param->check_in == null)
                                                        
                                                            @if($param->guest == 1)
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 1)">
                                                                </form>
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="2">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 2)">
                                                                </form>
                                                            @else
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)">
                                                                </form>
                                                            @endif
                                                        
                                                        @endif

                                                        @if ($param->redemption_time->pluck('created_at')->first() == null)
                                                            <form action="{{ route('admin.redemption.checkin') }}" method="POST" class="mb-1">
                                                                @csrf
                                                                    <input type="hidden" name="id" value="{{ $param->id }}">
                                                                    {{-- <input type="hidden" name="type" value="2"> --}}
                                                                    <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Redemption">
                                                            </form>
                                                        @endif
                                                    </td> 
                                                    <td>
                                                        {{-- <a href="{{ route("admin.qrcode", ["id" =>$param->id ]) }}">View</a> --}}
                                                        <a data-target-id="{{$param->id}}" data-toggle="modal" data-target="#qrcodeModal" class="btn btn-sm btn-link qrcode_view" data-qr="{{$param->qr_code}}" id="qrcode_view">View</a>
                                                    </td>
                                                    <td>{{ $param->name }}</td>
                                                    <td>{{ $param->email }}</td>
                                                    <td>{{ $param->mobile }}</td>
                                                    <td>{{ $param->nric }}</td>
                                                    <td>{{ $param->created_at }}</td>
                                                    <td>{{ $param->date }}</td>
                                                    <td>{{ $param->check_in }}</td>
                                                    <td>{{  $param->redemption_time->pluck('created_at')->first() }}</td>
                                                    @if ($param->fixed_date == 0)
                                                        <td>N</td>
                                                    @else
                                                        <td>Y</td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td> {{ __('messages.no_record') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        {{ $report2->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="event5" role="tabpanel" aria-labelledby="event5-tab">
                        <div class="row" id="table-responsive">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Check In List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <h6>
                                                    Date : {{$date}}
                                                    <br>
                                                    Check In : {{$report5_total}} / {{$report5->total()}}
                                                </h6>
                                            </div>
                                            <div class="col-2">
                                                <form action="{{route('export.checkin')}}" method="POST">
                                                @csrf
                                                    <input type="submit" class="btn btn-primary float-right" value="Export">
                                                    <input name="type" type="hidden" value="Checkin">
                                                    <input name="report_date" type="hidden" value="{{$report_date4->date ?? '-'}}">
                                                    <input name="event" type="hidden" value="5">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                    <th scope="col" class="text-nowrap">qr code</th>
                                                    <th scope="col" class="text-nowrap">Name</th>
                                                    <th scope="col" class="text-nowrap">Email</th>
                                                    <th scope="col" class="text-nowrap">Phone Number</th>
                                                    <th scope="col" class="text-nowrap">NRIC</th>
                                                    <th scope="col" class="text-nowrap">Register Time</th>
                                                    <th scope="col" class="text-nowrap">Event Date</th>
                                                    <th scope="col" class="text-nowrap">Check In Time</th>
                                                    <th scope="col" class="text-nowrap">Redemption Time</th>
                                                    <th scope="col" class="text-nowrap">Invited</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if (count($report5))
                                                @foreach ($report5 as $param)
                                                <tr>
                                                    <td>
                                                        @if ($param->check_in == null)
                                                            @if($param->guest == 1)
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 1)">
                                                                </form>
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="2">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 2)">
                                                                </form>
                                                            @else
                                                                <form action="{{ route('admin.checkin') }}" method="POST" class="mb-1">
                                                                    @csrf
                                                                        <input type="hidden" name="id" value="{{ $param->id }}">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)">
                                                                </form>
                                                            @endif
                                                        
                                                        @endif

                                                        @if ($param->redemption_time->pluck('created_at')->first() == null)
                                                            <form action="{{ route('admin.redemption.checkin') }}" method="POST" class="mb-1">
                                                                @csrf
                                                                    <input type="hidden" name="id" value="{{ $param->id }}">
                                                                    {{-- <input type="hidden" name="type" value="2"> --}}
                                                                    <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Redemption">
                                                            </form>
                                                        @endif
                                                    </td> 
                                                    <td>
                                                        {{-- <a href="{{ route("admin.qrcode", ["id" =>$param->id ]) }}">View</a> --}}
                                                        <a data-target-id="{{$param->id}}" data-toggle="modal" data-target="#qrcodeModal" class="btn btn-sm btn-link qrcode_view" data-qr="{{$param->qr_code}}" id="qrcode_view">View</a>
                                                    </td>
                                                    <td>{{ $param->name }}</td>
                                                    <td>{{ $param->email }}</td>
                                                    <td>{{ $param->mobile }}</td>
                                                    <td>{{ $param->nric }}</td>
                                                    <td>{{ $param->created_at }}</td>
                                                    <td>{{ $param->date }}</td>
                                                    <td>{{ $param->check_in }}</td>
                                                    <td>{{  $param->redemption_time->pluck('created_at')->first() }}</td>
                                                    @if ($param->fixed_date == 0)
                                                        <td>N</td>
                                                    @else
                                                        <td>Y</td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td> {{ __('messages.no_record') }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        {{ $report2->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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

@if (count($report1))
@foreach ($report1 as $param)
<div class="modal fade wv-modal" id="qrcodeModal" role="dialog" tabindex="-1" aria-labelledby="qrcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">QR CODE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="modal-close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="card-body">
                    <img src="" id="user-data" width="60%" alt="qr-code" class="mb-30 qr-code">
                    {{-- <input id="user-id" class="form-control" type="text" readonly/> --}}
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="submit" class="btn btn-orange" data-bs-dismiss="modal">Confirm</button> --}}
                <button type="button" class="btn btn-close" data-bs-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif

@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                title: '{{ session('success') }}',
                text: '',
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-orange'
                },
                buttonsStyling: false
            });
        </script>
    @elseif( session('errors') )
        <script>
            Swal.fire({
                title: 'Opps',
                text: 'Please try again.',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-orange'
                },
                buttonsStyling: false
            });
        </script>
    @endif

    <script>
        $(document).ready(function(){
            $("#qrcodeModal").on("show.bs.modal", function(e) {
                var qr = $(e.relatedTarget).data('qr');
                // var ids = $(e.relatedTarget).data('target-id');

                $("#user-data").attr("src", qr);
                // $("#user-id").val(ids);
            });
            
            $(".btn-close").click(function(){
                $("#qrcodeModal").modal('hide');
            });
        });
    </script>
    @endpush