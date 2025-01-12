@extends('layouts.app')

@section('page-title', 'Thank you')

@section('content')
<div class="bg-thankyou">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="age-wrapper">
                    <a href="/" class="logo mt-30"><img src="{{ asset('img/carsberg-logo.png') }}" class="logo-img" width="120"></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="d-flex position-relative">
        <div class="align-items-center mx-auto content-width">
              <div class="container position-relative">
                <div class="greenwave-left">
                     <img src="{{ asset('img/thankyou-left-1.png') }}" class="image-desktop">
                     <img src="{{ asset('img/thankyou-left-1-mobile.png') }}" class="image-mobile">
                </div>
                 <div class="greenwave-right">
                     <img src="{{ asset('img/thankyou-right-1.png') }}" class="image-desktop">
                      <img src="{{ asset('img/thankyou-right-mobile.png') }}" class="image-mobile">
                </div>
                <div class="row px-xl-2 pad-top40 logo-pad"> 
                    <div class="col-md-12 col-12 text-center">
                        <div class="age-wrapper">
                            <div class="text-center form-border">
                                <p class="registration mb-10">YOUR REGISTRATION IS CONFIRMED.</p>
                                <p class="register-text text-uppercase">Excited to Celebrate with you!</p>
                                <img src="{{$customer->qr_code}}" width="70%" alt="qr-code" class="mb-30 qr-code"><br>
                                <a href="{{$customer->qr_code}}" download> <p class="screenshot text-uppercase">Download QR Code</p></a>
                                <div class="mb-10">
                                    <p class="name mb-0">{{Str::of($customer->name)->upper()}}</p> 
                                    <p class="email mb-0">{{Str::of($customer->email)->upper()}}</p> 
                                    <p class="number mb-0">{{$customer->mobile}}</p>
                                </div>
                                <div class="location mb-50">
                                    <p class="place mb-0">FARLEY MALL, SARAWAK</p> 
                                    <p class="date mb-0">{{$customer->date}}</p> 
                                </div>
                                <div class="location mb-30">
                                    <p class="screenshot text-uppercase">*SCREENSHOT THE qr code</p> 
                                </div>
                                <!--<div class="pad-bot20">
                                    <a href="{{$customer->qr_code}}" class="btn" download="RUE1664.png">Download QR Code</a> 
                                </div> --> 
                                
                                <!--<div>
                                    <a href="{{route('rsvp.home')}}" class="button-dark">Back to Home</a>
                                </div>  -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <a href="{{$customer->qr_code}}" download="RUE1664.png">Download QR Code</a> -->
            </div>
        </div>
    </div>
    <div class="thankyou-element">
        <div class="home-bottom">
            <img src="{{ asset('img/bg-thankyou-bottom.png') }}" class="img-fluid image-big">
            <img src="{{ asset('img/bg-thankyou-bottom-responsive.png') }}" class="img-fluid image-responsive">
        </div> 
    </div>
</div>
@endsection
