@extends('cs.layouts.app')
  
@section('page-title','Approval List')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.approval_list') }}</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('messages.customer_service') }}</a>
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
                            <h4 class="card-title">{{ __('messages.approval_list') }}</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="membership-tab-justified" data-toggle="tab" href="#membership-tab" role="tab" aria-controls="membership-tab" aria-selected="false">Membership Approval</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="insurance-tab-justified" data-toggle="tab" href="#insurance-tab" role="tab" aria-controls="insurance-tab" aria-selected="false">Insurance Point Purchase Approval</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="withdrawal-tab-justified" data-toggle="tab" href="#withdrawal-tab" role="tab" aria-controls="withdrawal-tab" aria-selected="true">Withdrawal Approval</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="guarantee-tab-justified" data-toggle="tab" href="#guarantee-tab" role="tab" aria-controls="guarantee-tab" aria-selected="true">Guarantee Claim Approval</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content pt-1">
                                <div class="tab-pane" id="guarantee-tab" role="tabpanel" aria-labelledby="guarantee-tab-justified">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Username</th>
                                                    <th scope="col" class="text-nowrap">Full Name</th>
                                                    <th scope="col" class="text-nowrap">Tel</th>
                                                    <th scope="col" class="text-nowrap">Request Amount</th>
                                                    <th scope="col" class="text-nowrap">Images</th>
                                                    <th scope="col" class="text-nowrap">InsurBet Apps Username</th>
                                                    <th scope="col" class="text-nowrap">Remark</th>
                                                    <th scope="col" class="text-nowrap">Created At</th>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                </tr>
                                            </thead>
            
                                            <tbody>
                                                @if(count($guarantees))
                                                    @foreach($guarantees as $guarantee)
                                                    <tr>
                                                        <td>{{ $guarantee->user->username }}</td>
                                                        <td>{{ $guarantee->user->name }}</td>
                                                        <td>+886 {{ $guarantee->user->contact_number }}</td>
                                                        <td>{{ $guarantee->withdraw }}</td>
                                                        <td>
                                                            @if($guarantee->photo_array)
                                                            @foreach(json_decode($guarantee->photo_array) as $img)
                                                            <a href="/storage{{ $img }}" target="_blank">
                                                                <img src="/storage{{ $img }}" class="img-fluid mb-1" alt="">
                                                            </a>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                        <td>{{ $guarantee->apps_username }}</td>
                                                        <td>{{ $guarantee->remark }}</td>
                                                        <td>{{ $guarantee->created_at }}</td>
                                                        <td>
                                                            <form action="{{ route('cs.approveClaim') }}" method="POST" class="mb-1">
                                                                @csrf
                                                                <label for="final_verify_amount">Final Verify Amount</label>
                                                                <input type="number" id="final_verify_amount" name="final_verify_amount" class="form-control mb-1" style="min-width: 240px" required>
                                                                <label for="remark">Remark</label>
                                                                <input type="text" id="remark" name="remark" class="form-control mb-1" maxlength="191" style="min-width: 240px">
                                                                <input type="hidden" name="id" value="{{ $guarantee->id }}">
                                                                <input type="hidden" name="state" value="1">
                                                                <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Approve">
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('cs.approveClaim') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="0" id="final_verify_amount" name="final_verify_amount" class="form-control mb-1" style="min-width: 240px" required>
                                                                <label for="remark">Remark</label>
                                                                <input type="text" id="remark" name="remark" class="form-control mb-1" maxlength="191" style="min-width: 240px">
                                                                <input type="hidden" name="id" value="{{ $guarantee->id }}">
                                                                <input type="hidden" name="state" value="-1">
                                                                <input type="submit" class="btn btn-danger waves-effect waves-float waves-light" value="Reject">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>no record</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="withdrawal-tab" role="tabpanel" aria-labelledby="withdrawal-tab-justified">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Username</th>
                                                    <th scope="col" class="text-nowrap">Full Name</th>
                                                    <th scope="col" class="text-nowrap">Tel</th>
                                                    <th scope="col" class="text-nowrap">Withdrawal Amount</th>
                                                    <th scope="col" class="text-nowrap">Created At</th>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                </tr>
                                            </thead>
            
                                            <tbody>
                                                @if(count($withdrawals))
                                                    @foreach($withdrawals as $withdrawal)
                                                    <tr>
                                                        <td>{{ $withdrawal->user->username }}</td>
                                                        <td>{{ $withdrawal->user->name }}</td>
                                                        <td>+886 {{ $withdrawal->user->contact_number }}</td>
                                                        <td>{{ $withdrawal->withdraw }}</td>
                                                        <td>{{ $withdrawal->created_at }}</td>
                                                        <td>
                                                            <form action="{{ route('cs.approveBonusWithdraw') }}" method="POST" class="mb-1">
                                                                @csrf
                                                                <label for="remark">Remark</label>
                                                                <input type="text" id="remark" name="remark" class="form-control mb-1" maxlength="191" style="min-width: 240px" required>
                                                                <input type="hidden" name="id" value="{{ $withdrawal->id }}">
                                                                <input type="hidden" name="state" value="1">
                                                                <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Approve">
                                                            </form>
                                                            <hr>
                                                            <form action="{{ route('cs.approveBonusWithdraw') }}" method="POST" class="mb-1">
                                                                @csrf
                                                                <label for="remark">Remark</label>
                                                                <input type="text" id="remark" name="remark" class="form-control mb-1" maxlength="191" style="min-width: 240px" required>
                                                                <input type="hidden" name="id" value="{{ $withdrawal->id }}">
                                                                <input type="hidden" name="state" value="-1">
                                                                <input type="submit" class="btn btn-danger waves-effect waves-float waves-light" value="Reject">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>no record</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="membership-tab" role="tabpanel" aria-labelledby="membership-tab-justified">                          
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Username</th>
                                                    <th scope="col" class="text-nowrap">Full Name</th>
                                                    <th scope="col" class="text-nowrap">Email</th>
                                                    <th scope="col" class="text-nowrap">Tel</th>
                                                    <th scope="col" class="text-nowrap">Gender</th>
                                                    <th scope="col" class="text-nowrap">DOB</th>
                                                    <th scope="col" class="text-nowrap">Upper Line</th>
                                                    <th scope="col" class="text-nowrap">Bank Name</th>
                                                    <th scope="col" class="text-nowrap">Bank Account</th>
                                                    <th scope="col" class="text-nowrap">Bank Account Name</th>
                                                    <th scope="col" class="text-nowrap">Created At</th>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                </tr>
                                            </thead>
            
                                            <tbody>
                                                @if(count($memberships))
                                                    @foreach($memberships as $membership)
                                                    <tr>
                                                        <td>{{ $membership->username }}</td>
                                                        <td>{{ $membership->name }}</td>
                                                        <td>{{ $membership->email }}</td>
                                                        <td>+886 {{ $membership->contact_number }}</td>
                                                        <td>{{ $membership->gender }}</td>
                                                        <td>{{ $membership->dob }}</td>
                                                        <td>{{ $membership->upper_line_id }}</td>
                                                        <td>{{ $membership->bank_id }}</td>
                                                        <td>{{ $membership->bank_account }}</td>
                                                        <td>{{ $membership->bank_account_name }}</td>
                                                        <td>{{ $membership->created_at }}</td>
                                                        <td>
                                                            <form action="{{ route('cs.approveUser') }}" method="POST">
                                                                @csrf
                                                                <label for="apps_username">InsurBet Apps Username</label>
                                                                <input type="text" id="apps_username" name="apps_username" class="form-control mb-1" maxlength="191" style="min-width: 240px" required>
                                                                <input type="hidden" name="id" value="{{ $membership->id }}">
                                                                <input type="hidden" name="state" value="1">
                                                                <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Approve">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>no record</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="insurance-tab" role="tabpanel" aria-labelledby="insurance-tab-justified">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Username</th>
                                                    <th scope="col" class="text-nowrap">Full Name</th>
                                                    <th scope="col" class="text-nowrap">Tel</th>
                                                    <th scope="col" class="text-nowrap">Purchase Amount</th>
                                                    <th scope="col" class="text-nowrap">Created At</th>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                </tr>
                                            </thead>
            
                                            <tbody>
                                                @if(count($insurances))
                                                    @foreach($insurances as $insurance)
                                                    <tr>
                                                        <td>{{ $insurance->user->username }}</td>
                                                        <td>{{ $insurance->user->name }}</td>
                                                        <td>+886 {{ $insurance->user->contact_number }}</td>
                                                        <td>{{ $insurance->deposit }}</td>
                                                        <td>{{ $insurance->created_at }}</td>
                                                        <td>
                                                            <form action="{{ route('cs.approveInsurancePoint') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $insurance->id }}">
                                                                <input type="hidden" name="state" value="1">
                                                                <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Approve">
                                                            </form>
                                                            <hr>
                                                            <form action="{{ route('cs.approveInsurancePoint') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $insurance->id }}">
                                                                <input type="hidden" name="state" value="-1">
                                                                <input type="submit" class="btn btn-danger waves-effect waves-float waves-light" value="Reject">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>no record</td>
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