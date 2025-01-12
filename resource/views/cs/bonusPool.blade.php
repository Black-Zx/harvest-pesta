@extends('cs.layouts.app')
  
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.update_list') }}</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('messages.winning_pool') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.update_list') }}
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
                            <h4 class="card-title">{{ __('messages.update_list') }}</h4>
                        </div>
                        <div class="card-body">

                            <!-- Tab panes -->
                            <div class="tab-content pt-1">
                                <div class="tab-pane active" id="user-tab" role="tabpanel" aria-labelledby="user-tab-justified">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">No</th>
                                                    <th scope="col" class="text-nowrap">{{ __('messages.name') }}</th>
                                                    <th scope="col" class="text-nowrap">{{ __('messages.amount') }}</th>
                                                    <!-- <th scope="col" class="text-nowrap">{{ __('messages.type') }}</th> -->
                                                    <th scope="col" class="text-nowrap">{{ __('messages.action') }}</th>
                                                </tr>
                                            </thead>
            
                                            <tbody>
                                                @if(count($bonus_pools))
                                                    @foreach($bonus_pools as $bonus_pool)
                                                    <tr>
                                                        <td>{{ $bonus_pool->sort_title }}</td>
                                                        <td>{{ $bonus_pool->name }}</td>
                                                        <td>{{ $bonus_pool->amount }}</td>
                                                        <!-- <td>{{ $bonus_pool->type==1?"Master Agent":"Shareholder" }}</td> -->
                                                        <td>
                                                            <form action="{{ route('cs.updateBonusPool') }}" method="POST" class="mb-1">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="name">{{ __('messages.name') }}</label>
                                                                        <input type="text" id="name" name="name" class="form-control" required>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="amount">{{ __('messages.amount') }}</label>
                                                                        <input type="number" id="amount" name="amount" class="form-control mb-1" maxlength="191">
                                                                    </div>
                                                                    <div class="col-2" style="align-self: center;">
                                                                        <input type="hidden" name="id" value="{{ $bonus_pool->id }}">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="{{ __('messages.update') }}">
                                                                    </div>
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