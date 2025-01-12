@extends('admin.layouts.app')
  
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Engagement List</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('messages.admin') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Redemption List
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

                <div class="row" id="table-responsive">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Redemption List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <h6>
                                                    Date : {{$date}}
                                                    <br>
                                                    Total redemption : {{$report->count()}}
                                                </h6>
                                            </div>
                                            {{-- <div class="col-2">
                                                <form action="{{route('export.redemption')}}" method="POST">
                                                @csrf
                                                    <input type="submit" class="btn btn-primary float-right" value="Export">
                                                    <input name="type" type="hidden" value="Redemption">
                                                </form>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Name</th>
                                                    <th scope="col" class="text-nowrap">Email</th>
                                                    <th scope="col" class="text-nowrap">Phone Number</th>
                                                    <th scope="col" class="text-nowrap">NRIC</th>
                                                    <th scope="col" class="text-nowrap">Redemption</th>
                                                    <!-- <th scope="col" class="text-nowrap">Action</th> -->
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if (count($report))
                                                @foreach ($report as $param)
                                                <tr>
                                                    <td>{{ $param->customer->name }}</td>
                                                    <td>{{ $param->customer->email }}</td>
                                                    <td>{{ $param->customer->mobile }}</td>
                                                    <td>{{ $param->customer->nric }}</td>
                                                    <td>{{ $param->created_at }}</td>
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
    @endpush