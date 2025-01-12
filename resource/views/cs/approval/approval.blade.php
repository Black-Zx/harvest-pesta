@extends('cs.layouts.app')
  
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.approval_list') }}</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('messages.update_member_rank') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.approval_list') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="approvalList">
            @if(count($errors) > 0)
                @foreach( $errors->all() as $message )
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
                                            <input type="text" id="from" name="from" class="form-control flatpickr-basic flatpickr-input active" placeholder="Ex: YYYY-MM-DD" value="{{ app('request')->input('from') }}" readonly="readonly">
                                        </div>
                                    </div>
    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="to">{{ __('messages.date_to') }}
                                            </label>
                                            <input type="text" id="to" name="to" class="form-control flatpickr-basic flatpickr-input active" placeholder="Ex: YYYY-MM-DD" value="{{ app('request')->input('to') }}" readonly="readonly">
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
                                </div>
    
                                <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="{{ __('messages.submit') }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.approval_list') }}</h4>
                        </div>
                        <div class="card-body">
                            <!-- <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="user-tab-justified" data-toggle="tab" href="#user-tab" role="tab" aria-controls="user-tab" aria-selected="true">Update Member Rank</a>
                                </li>
                            </ul> -->

                            <!-- Tab panes -->
                            <div class="tab-content pt-1">
                                <div class="tab-pane active" id="user-tab" role="tabpanel" aria-labelledby="user-tab-justified">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">{{ __('messages.username') }}</th>
                                                    <th scope="col" class="text-nowrap">{{ __('messages.fullname') }}</th>
                                                    <th scope="col" class="text-nowrap">{{ __('messages.tel') }}</th>
                                                    <th scope="col" class="text-nowrap">{{ __('messages.email') }}</th>
                                                    <th scope="col" class="text-nowrap">{{ __('messages.rank') }}</th>
                                                    <th scope="col" class="text-nowrap">{{ __('messages.apps_username') }}</th>
                                                    <th scope="col" class="text-nowrap">{{ __('messages.created_at') }}</th>
                                                    <th scope="col" class="text-nowrap">{{ __('messages.action') }}</th>
                                                </tr>
                                            </thead>
            
                                            <tbody>
                                                @if(count($users))
                                                    @foreach($users as $user)
                                                    <tr>
                                                        <td>{{ $user->username }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>+886 {{ $user->contact_number }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->rank?$user->rank->name:"-" }}</td>
                                                        <td>{{ $user->apps_username }}</td>
                                                        <td>{{ $user->created_at }}</td>
                                                        <td>
                                                            <form action="{{ route('cs.updateMemberRank') }}" method="POST" class="mb-1">
                                                                @csrf
                                                                <label for="final_verify_amount">{{ __('messages.rank') }}</label>
                                                                <select class="form-control" id="rank_id" name="rank_id" required>
                                                                @foreach($ranks as $rank)
                                                                    <option value="{{ $rank->id }}">{{ $rank->name }}</option>
                                                                @endforeach
                                                                </select>
                                                                <hr>
                                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                                <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="{{ __('messages.approve') }}">
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
                                        {{ $users->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
    @if(session('success'))
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