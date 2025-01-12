@extends('cs.layouts.app')

@section('page-title', 'Notifications')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Notifications
                    </h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">InsurBet</a>

                            </li>
                            <li class="breadcrumb-item active">Notifications
                            </li>
                        </ol>
                    </div>
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
                            <h4 class="card-title">Notifications</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">Message</th>
                                            <th scope="col" class="text-nowrap">Type</th>
                                            <th scope="col" class="text-nowrap">Status</th>
                                            <th scope="col" class="text-nowrap">Created At</th>
                                            <th scope="col" class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (count($notifications))
                                            @foreach ($notifications as $notification)
                                                <tr>
                                                    <td>{{ $notification->notification->message }}</td>
                                                    <td>{{ $notification->notification->type }}</td>
                                                    <td>
                                                        @if($notification->is_used == 1)
                                                            Noticed
                                                        @else
                                                            Pending
                                                        @endif
                                                    </td>
                                                    <td>{{ $notification->notification->created_at }}</td>
                                                    <td>
                                                        @if($notification->is_used == 0)
                                                        <a href="{{ $notification->notification->url }}" target="_blank" class="btn btn-primary waves-effect waves-float waves-light">Go to URL</a>
                                                        @endif
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

                            {{ $notifications->links('vendor.pagination.bootstrap-4') }}
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
