@extends('member.layouts.app')

@section('page-title', 'Dashboard')

@section('content')

<div class="content-body">
    <div class="auth-wrapper auth-v2">
        <div class="auth-inner row m-0">
            <div class="align-items-center auth-bg px-2 p-lg-5" style="top:15%;text-align-last: center;">
                <img width="100%" src="img/carsberg-logo.png" alt="">                                                                                                                                                                       
                <div class="list-group">
                    <a href="{{route('member.scan')}}" class="list-group-item list-group-item-action" aria-current="true">
                    QR Scanner
                    </a>
                    <!-- <a href="{{route('member.scan2')}}" class="list-group-item list-group-item-action">Fluid Paint Workshop QR Scanner</a>
                    <a href="{{route('member.scan3')}}" class="list-group-item list-group-item-action">DIY Cocktail Workshop QR Scanner</a>
                    <a href="{{route('member.scan4')}}" class="list-group-item list-group-item-action">Tote Bag Workshop QR Scanner</a> -->
                    <a href="{{route('member.redemption_scan')}}" class="list-group-item list-group-item-action">Redemption QR Scanner</a>
                    <a href="{{route('member.engagement_scan')}}" class="list-group-item list-group-item-action">Engagement 1</a>
                    <a href="{{route('member.engagement_scan2')}}" class="list-group-item list-group-item-action">Engagement 2</a>
                </div>
                <!-- <div class="row">
                    <div class="col-12 m-1">
                        <a href="{{route('member.scan')}}">
                            <button class="btn btn-primary">Rue1664 QR Scanner</button>
                        </a>
                    </div>
                    <div class="col-12 m-1">
                        <a href="{{route('member.scan2')}}">
                            <button class="btn btn-primary">Fluid Paint Workshop QR Scanner</button>
                        </a>
                    </div>
                    <div class="col-12 m-1">
                        <a href="{{route('member.scan3')}}">
                            <button class="btn btn-primary">DIY Cocktail Workshop QR Scanner</button>
                        </a>
                    </div>
                    <div class="col-12 m-1">
                        <a href="{{route('member.scan4')}}">
                            <button class="btn btn-primary">Tote Bag Workshop QR Scanner</button>
                        </a>
                    </div>
                    <div class="col-12 m-1">
                        <a href="{{route('member.redemption_scan')}}">
                            <button class="btn btn-primary">Redemption QR Scanner</button>
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection