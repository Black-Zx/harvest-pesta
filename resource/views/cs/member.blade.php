@extends('cs.layouts.app')

@section('page-title', 'Member List')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.member_list') }}
                    </h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">InsurBet</a>

                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.member_list') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                        placeholder="Ex: YYYY-MM-DD" value="{{ app('request')->input('from') }}"
                                        readonly="readonly">
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
                                    <label for="fullname">{{ __('messages.full_name') }}
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
                                    <input type="text" id="contact_number" name="contact_number" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username">{{ __('messages.protection_status') }}
                                    </label>
                                    <select class="form-control" id="protection_status" name="protection_status">
                                        <option value="">{{ __('messages.select_protection_status') }}</option>
                                        <option value="1">{{ __('messages.protected') }}</option>
                                        <option value="0">{{ __('messages.unprotected') }}</option>
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

    <div class="content-body">
        <section id="list">
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.member_list') }}</h4>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-toggle="modal" data-target="#inlineForm2">{{ __('messages.import_direct_bonus') }}</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-toggle="modal" data-target="#inlineForm">{{ __('messages.import') }}</button>
                                </div>
                                <div class="col">
                                    <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('cs.showMemberDetail') }}">{{ __('messages.create') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">{{ __('messages.action') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.created_at') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.protection_status') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.username') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.fullname') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.bonus_point') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.insurance_point') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.package') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.email') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.tel') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.upper_line') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.bank_name') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.bank_account_number') }}</th>
                                            <th scope="col" class="text-nowrap">
                                                {{ __('messages.bank_account_name') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.gender') }}</th>
                                            <th scope="col" class="text-nowrap">{{ __('messages.dob') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (count($users))
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-primary waves-effect waves-float waves-light"
                                                            href="{{ route('cs.showMemberDetail', $user->id) }}">{{ __('messages.edit') }}</a>
                                                    </td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>
                                                        @if($user->protection_state == 1)
                                                        {{ __('messages.protected') }}
                                                        @else
                                                        {{ __('messages.unprotected') }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ number_format($user->totalBonus(), 2) }}</td>
                                                    <td>{{ number_format($user->totalInsurancePoint(), 2) }}</td>
                                                    <td>
                                                    @foreach ($user->packages as $package)    
                                                    {{ $package->package->name }}
                                                    @endforeach
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>+886 {{ $user->contact_number }}</td>
                                                    <td>{{ $user->upper_line_user ? $user->upper_line_user->name : '-' }}
                                                    </td>
                                                    <td>{{ $user->bank ? $user->bank->name : '-' }}</td>
                                                    <td>{{ $user->bank_account }}</td>
                                                    <td>{{ $user->bank_account_name }}</td>
                                                    <td>{{ $user->gender==1?__('messages.male'):__('messages.female') }}</td>
                                                    <td>{{ $user->dob }}</td>
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
                            {{ $users->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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
<div class="form-modal-ex">
    <!-- Modal -->
    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">{{ __('messages.import') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="downloadForm" method="POST" action="{{ route('cs.exportUsers') }}">
                    @csrf
                    <input type="hidden" name="type" id="type" value="casino">        
                </form>
                <form id="submitForm" method="POST" enctype="multipart/form-data" action="{{ route('cs.importReport') }}">
                <div class="modal-body">
                    @csrf

                        <div class="custom-file ">
                            <input type="file" class="custom-file-input" id="import_file" name="import_file" required>
                            <label class="custom-file-label" for="import_file">{{ __('messages.choose_file') }}</label>
                        </div>
                </div>
                </form>
                <div class="modal-footer">
                    <input form="downloadForm" type="submit" class="btn btn-primary" value="{{ __('messages.download') }}">
                    <input form="submitForm" type="submit" class="btn btn-primary" value="{{ __('messages.submit') }}">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>                
            </div>
        </div>
    </div>
</div>

<div class="form-modal-ex">
    <!-- Modal -->
    <div class="modal fade text-left" id="inlineForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">{{ __('messages.import_direct_bonus') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="downloadForm2" method="POST" action="{{ route('cs.exportUsers') }}">
                    @csrf
                    <input type="hidden" name="type" id="type" value="direct bonus">        
                </form>
                <form id="submitForm2" method="POST" enctype="multipart/form-data" action="{{ route('cs.importDirectBonusesReport') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row mb-1">
                        <div class="custom-file col">
                            <select class="form-control" name="month" id="month">
                                <option value="1">January</option>
                                <option value="2">Febuary</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>

                        <div class="custom-file col">
                            <select class="form-control" name="year" id="year">
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                    </div>

                    <div class="custom-file ">
                        <input type="file" class="custom-file-input" id="import_file2" name="import_file" required>
                        <label class="custom-file-label" for="import_file2">{{ __('messages.choose_file') }}</label>
                    </div>
                </div>
                </form>
                <div class="modal-footer">
                    <input form="downloadForm2" type="submit" class="btn btn-primary" value="{{ __('messages.download') }}">
                    <input form="submitForm2" type="submit" class="btn btn-primary" value="{{ __('messages.submit') }}">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('messages.close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @if (session('message'))
        <script>
            Swal.fire({
                title: '{{ session()->get("message") }}',
                text: '{{ session()->get("message") }}',
                icon: '{{ session()->get("message")=="Error"?"warning":"success" }}',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        </script>
    @endif
@endpush