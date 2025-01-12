@extends('layouts.app')

@section('page-title', 'Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="age-wrapper">
                <a href="/" class="logo mt-30"><img src="{{ asset('img/carsberg-logo.png') }}" class="logo-img" width="120"></a>
            </div>
        </div>
    </div>
</div>
<div class="mt-20">
     <img src="{{ asset('img/bg-rsvp-top.png') }}" class="img-fluid image-big">
     <img src="{{ asset('img/bg-rsvp-top-mobile.png') }}" class="img-fluid image-responsive">
</div>
<div class="d-flex position-relative">
    <div class="align-items-center mx-auto content-width">
          <div class="container">
            <div class="row px-xl-2 pad-top40"> 
                <div class="col-md-12 col-12 text-center">
                    <div class="age-wrapper">
                        <h1 class="text-uppercase pad-bot10 carls-harvest">CARLS HARVEST PESTA WILL BE AT</h1>
                        <div class="green-border mb-30">
                            <p class="text-uppercase datenvenue mb-0">22<sup>nd</sup> May 2024 - 25<sup>th</sup> May 2024</p>
                            <p class="time mb-20">5:00PM - 11:30PM</p>
                            <img src="{{ asset('img/hopleaf.png') }}" class="img-fluid mb-20 hopleaf" width="50">
                            <p class="text-uppercase datenvenue mb-0">Kuching, sarawak</p>
                            <p class="text-uppercase venue mb-0">Farley Mall</p>
                        </div> 
                    </div>
                </div>
            </div>
            <p class="activity text-center">*FIRST 1000 ATTENDEES OF THE DAY GET FREE BEER</p>

            <div class="row mb-0"> 
                <div class="col-md-3 col-3 text-center">
                    <img src="{{ asset('img/carlsberg.png') }}" class="img-fluid mb-10" width="120">
                    <p class="activity">Free Carlsberg</p>
                </div>
                <div class="col-md-3 col-3 text-center">
                    <img src="{{ asset('img/live-band.png') }}" class="img-fluid mb-10" width="120">
                    <p class="activity">Live Band</p>
                </div>
                <div class="col-md-3 col-3 text-center">
                    <img src="{{ asset('img/handicraft.png') }}" class="img-fluid mb-10" width="120">
                    <p class="activity">Free Workshop</p>
                </div>
                <div class="col-md-3 col-3 text-center">
                    <img src="{{ asset('img/local-foods.png') }}" class="img-fluid mb-10" width="120">
                    <p class="activity">Local Foods</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-12 text-center mb-30">
                    <p class="text-uppercase exciting-activities mb-40">& many more exciting activities await you!</p>
                     <a href="{{route('rsvp', ['fd' => $fd])}}" class="btn">COME JOIN US NOW !</a>
                 </div>
            </div>
        </div>
    </div>
</div>  
<div class="home-bottom mt-neg40">
    <img src="{{ asset('img/bg-activity.png') }}" class="img-fluid image-big">
    <img src="{{ asset('img/bg-activity-mobile.png') }}" class="img-fluid image-responsive">
</div>    
@endsection
