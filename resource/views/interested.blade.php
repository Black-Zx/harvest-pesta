@extends('layouts.app')

@section('page-title', 'Home')

@section('content')
<div class="d-flex position-relative">
    <div class="align-items-center mx-auto content-width">
          <div class="container">
            <div class="row px-xl-2 pad-top40"> 
                <div class="col-md-12 col-12 text-center">
                    <div class="age-wrapper">
                        <div class="logo">
                            <img src="{{ asset('img/carsberg-logo.jpg') }}" class="logo-img ml-20" width="201">
                        </div>
                        <h1 class="font-garamond text-uppercase pad-bot10"><span class="first-letter">REDEEM YOUR COMPLIMENTARY</h1> 
                        <img src="{{ asset('img/1664-rose.png') }}" class="logo-img mb-80" width="180">
                        <br>
                        <a href="{{route('rsvp.check')}}" class="btn">ENTER</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>    

<!--<div class="welcome-bg">
     <div class="d-flex position-relative">
        <div class="align-items-center mx-auto content-width">
                <img src="{{ asset('img/flower-left.png') }}" class="flower-left interested-left">
                <img src="{{ asset('img/flower-right.png') }}" class="flower-right">
                  <div class="container">
                    <div class="row px-xl-2 pad-top60 pad-bot60"> 
                        <div class="col-md-12 col-12 text-center">
                    <img src="{{ asset('img/logo.png') }}" class="logo-img pad-bot30" width="229">
                    <hr class="darkblue-line pad-top30">
                    <div class="age-wrapper pad-bot40">
                        <p class="welcome-message entertain">Welcome to <i>Rue 1664</i>. A charming street brimming with <i>joie de vivre</i>. Come join us for an elegant evening inspired by Parisian celebration of Good Taste With A Twist. A place to get a taste of France while you enjoy a refreshing glass of 1664.</p>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>   
</div>

 <div class="d-flex position-relative blue-bg pad-top60 pad-bot60">
    <div class="align-items-center mx-auto content-width">
        <div class="container">
            <div class="row px-xl-2">
                <div class="col-md-12 col-12 text-center">
                     <div class="age-wrapper">
                        <div class="mb-30">
                            <h1 class="mb-0">JOIN US</h1>
                            <p class="enjoy-complimentary mb-20 entertain">Enjoy a complimentary 1664 BLANC or 1664 ROSÉ</p>
                            <a href="{{route('rsvp')}}" class="redeem-button">Redeem Now</a>
                            <p class="tnc">Terms & Conditions apply.</p>
                        </div>
                        <div class="date-venue">
                            <p class="mb-0 entertain">Date: 5th December 2022 to 2nd January 2023</p>
                            <p class="entertain">Venue: L’Atelier 1664 @ Pavilion Kuala Lumpur, Level 3 Connection<br>(Next to illy Caffé)</p>       
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   

<div class="position-relative">
    <img src="{{ asset('img/store.jpg') }}" class="img-fluid">
</div>

<div class="position-relative pad-top60 pad-bot60 event-bg">
     <div class="align-items-center mx-auto content-width">
        <img src="{{ asset('img/event-highlight-left-flower.png') }}" class="event-flower-left">
        <img src="{{ asset('img/event-highlight-right-flower.png') }}" class="event-flower-right">
        <div class="row px-xl-2">
            <div class="col-md-12 col-12 text-center">
                 <div class="mx-auto">
                    <div class="mb-0">
                        <h1 class="dark-blue mb-0">Event Highlights</h1>
                        <p class="art-twist mb-20 dark-blue">Art with a Twist workshops</p>
                        <p class="welcome-message entertain">Register to participate in our exciting experiences to express your creativity with a twist</p>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="mx-auto">  
        <div class="container">
         <div class="row px-xl-2 justify-content-md-center">
            <div class="col-md-3 d-none d-sm-none d-md-block d-lg-block text-center workshop-section">
                 <img src="{{ asset('img/liquid-pouring-art.png') }}" class="img-fluid" alt="Liquid Pouring Art" width="300">
                <h3 class="workshop-title">Liquid Pouring Art</h3>
                 <p class="workshop-caption">Try your hand at a step by step Liquid Pouring Art experience and bring home your very own masterpiece.</p>
                 <a href="{{route('rsvp',['e'=> 4])}}" class="register-now">Register Now</a>
            </div> 
            <div class="col-md-3 d-none d-sm-none d-md-block d-lg-block text-center workshop-section">
                 <img src="{{ asset('img/mixology.png') }}" class="img-fluid" alt="Mixology Class " width="300">
                 <h3 class="workshop-title">Mixology Class</h3>
                 <p class="workshop-caption">Be a bartender for a day and learn how to shake up a cocktail with 1664 Blanc or 1664 Rosé, together with a local industry expert.</p>
                 <a href="{{route('rsvp',['e'=> 5])}}" class="register-now">Register Now</a>
            </div>  
            <div class="col-md-3 d-none d-sm-none d-md-block d-lg-block text-center workshop-section">
                <img src="{{ asset('img/tote-bag.png') }}" class="img-fluid" alt="Tote Bag Customisation" width="300">
                 <h3 class="workshop-title">Tote Bag Customisation</h3>
                 <p class="workshop-caption">Iron on designs that speak to you. Customise an exclusive 1664 Tote Bag and carry it with Parisian pride.</p>
                 <a href="{{route('rsvp',['e'=> 6])}}" class="register-now">Register Now</a>
            </div> 
        </div>

            <div class="col-md-12 col-12 text-center d-block d-sm-block d-md-none d-lg-none">
                <div class="age-wrapper mx-auto">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                          <img src="{{ asset('img/liquid-pouring-art.png') }}" class="img-fluid" alt="Liquid Pouring Art" width="300">
                          <div class="carousel-caption d-md-block">
                             <h3 class="workshop-title">Liquid Pouring Art</h3>
                             <p class="workshop-caption">Try your hand at a step by step Liquid Pouring Art experience and bring home your very own masterpiece.</p>
                             <a href="{{route('rsvp')}}" class="register-now">Register Now</a>
                          </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="10000">
                          <img src="{{ asset('img/mixology.png') }}" class="img-fluid" alt="Mixology Class " width="300">
                          <div class="carousel-caption d-md-block">
                             <h3 class="workshop-title">Mixology Class</h3>
                             <p class="workshop-caption">Be a bartender for a day and learn how to shake up a cocktail with 1664 Blanc or 1664 Rosé, together with a local industry expert.</p>
                             <a href="{{route('rsvp')}}" class="register-now">Register Now</a>
                          </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="10000">
                          <img src="{{ asset('img/tote-bag.png') }}" class="img-fluid" alt="Tote Bag Customisation" width="300">
                          <div class="carousel-caption d-md-block">
                             <h3 class="workshop-title">Tote Bag Customisation</h3>
                             <p class="workshop-caption">Iron on designs that speak to you. Customise an exclusive 1664 Tote Bag and carry it with Parisian pride.</p>
                             <a href="{{route('rsvp')}}" class="register-now">Register Now</a>
                          </div>
                        </div>
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    </div>
                </div>
            </div>
         </div>       
        </div>
</div>

<div class="position-relative">
    <img src="{{ asset('img/blue-hour.jpg') }}" class="img-fluid">
</div>

<div class="position-relative blue-bg pad-top60 pad-bot60">
     <div class="mx-auto content-width">
        <img src="{{ asset('img/blue-hour-left-flower.png') }}" class="blue-hour-flower-left">
        <img src="{{ asset('img/blue-hour-right-flower.png') }}" class="blue-hour-flower-right">
        <div class="row px-xl-2 mb-30">
            <div class="col-md-12 col-12 text-center">
                 <div class="age-wrapper mx-auto">
                    <div class="mb-0">
                        <h1 class="mb-10">Blue Hour</h1>
                        <p class="blue-caption">As the sun sets, the Blue Hour transforms the evening into beautifully elevated moments that embody Good Taste with a Twist.<br><br>Sit back, enjoy a pint, and enjoy live performances 
every Wednesday - Sunday 8PM - 10:30PM.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="mx-auto content-width d-none d-sm-none d-md-block d-lg-block">
        <div class="container">
             <div class="row px-xl-2 justify-content-md-center mb-30">
                <div class="col-md-3 text-center workshop-section entertain">
                    <img src="{{ asset('img/dj-vann.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="DJ Vann">
                     <h3 class="bluehour-title">DJ Vann</h3>
                     <p class="bluehour-caption">Date: 9 & 16 Dec 2022<br>Time: 9PM - 10:30PM</p>
                </div>
                 <div class="col-md-3 text-center workshop-section entertain blue-hour-section">
                    <img src="{{ asset('img/roshan-melon.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="Roshan Melon">
                     <h3 class="bluehour-title">DJ Roshan</h3>
                     <p class="bluehour-caption">Date: 10 & 17 Dec 2022<br>Time: 9PM - 10:30PM</p>
                </div>
                 <div class="col-md-3 text-center workshop-section entertain blue-hour-section">
                    <img src="{{ asset('img/dj-johnny.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="Johnny Vicious">
                     <h3 class="bluehour-title">DJ Johnny Vicious</h3>
                     <p class="bluehour-caption">Date: 12 & 26 Dec 2022<br>Time: 9PM - 10:30PM</p>
                </div>
             </div>
             <div class="row px-xl-2 justify-content-md-center mb-30">
                <div class="col-md-3 text-center workshop-section entertain">
                    <img src="{{ asset('img/melissa-jo.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="DJ Melissa Jo">
                     <h3 class="bluehour-title">DJ MJ</h3>
                     <p class="bluehour-caption">Date: 23 & 30 Dec 2022<br>Time: 9PM - 10:30PM</p>
                </div>
                 <div class="col-md-3 text-center workshop-section entertain blue-hour-section">
                     <img src="{{ asset('img/gaston.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="Gaston Pong">
                     <h3 class="bluehour-title">Gaston Pong</h3>
                     <p class="bluehour-caption">Date: 24 Dec 2022<br>Time: 8PM - 8:30PM</p>
                </div>
                <div class="col-md-3 text-center workshop-section entertain">
                    <img src="{{ asset('img/beautiful-mistakes.jpg') }}" class="img-fluid blue-hour-img mb-20"  alt="Beautiful Mistakes">
                     <h3 class="bluehour-title">DJ Beautiful Mistakes</h3>
                     <p class="bluehour-caption">Date: 24 Dec 2022<br>Time: 9PM - 10:30PM</p>
                </div>
                
             </div>
             <div class="row px-xl-2 justify-content-md-center mb-30">
                 <div class="col-md-3 text-center workshop-section entertain blue-hour-section">
                    <img src="{{ asset('img/nicole.jpg') }}" class="img-fluid blue-hour-img mb-20"  alt="Nicole Lai">
                     <h3 class="bluehour-title">Nicole Lai</h3>
                     <p class="bluehour-caption">Date: 31 Dec 2022<br>Time: 8PM - 8:30PM</p>
                </div>
                 <div class="col-md-3 text-center workshop-section entertain blue-hour-section">
                    <img src="{{ asset('img/dj-jovynn.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="DJ Jovynn">
                     <h3 class="bluehour-title">DJ Jovynn</h3>
                     <p class="bluehour-caption">Date: 31 Dec 2022<br>Time: 9PM - 10:30PM</p>
                </div>
             </div>
         </div>
     </div>
     <div class="d-block d-sm-block d-md-none d-lg-none">
        <div class="age-wrapper mx-auto container">
            <div class="row px-xl-2 justify-content-md-center mb-20">
                <div class="col-6 text-center workshop-section entertain">
                    <img src="{{ asset('img/dj-vann.jpg') }}" class="img-fluid blue-hour-img mb-20"  alt="DJ Vann">
                     <h3 class="bluehour-title">DJ Vann</h3>
                     <p class="bluehour-caption">Date: 9 & 16 Dec 2022<br>Time: 9PM - 10:30PM</p>
                </div>
                 <div class="col-6 text-center workshop-section entertain blue-hour-section">
                    <img src="{{ asset('img/roshan-melon.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="DJ Roshan Melon">
                     <h3 class="bluehour-title">DJ Roshan</h3>
                     <p class="bluehour-caption">Date: 10 & 17 Dec 2022<br>Time: 9PM - 10:30PM</p>
                </div>
            </div>
            <div class="row px-xl-2 justify-content-md-center mb-30">
                 <div class="col-6 text-center workshop-section entertain blue-hour-section">
                    <img src="{{ asset('img/dj-johnny.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="DJ Johnny Vicious">
                     <h3 class="bluehour-title">DJ Johnny Vicious</h3>
                     <p class="bluehour-caption">Date: 12 & 26 Dec 2022<br>Time: 9PM - 10:30PM</p>
                </div>
                <div class="col-6 text-center workshop-section entertain blue-hour-section">
                    <img src="{{ asset('img/melissa-jo.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="DJ Melissa Jo">
                     <h3 class="bluehour-title">DJ MJ</h3>
                     <p class="bluehour-caption">Date: 23 & 30 Dec 2022<br>Time: 9PM - 10:30PM</p>
                </div>
            </div>        
            <div class="row px-xl-2 justify-content-md-center mb-30">
                 <div class="col-6 text-center workshop-section entertain blue-hour-section">
                    <img src="{{ asset('img/gaston.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="Gaston Pong">
                     <h3 class="bluehour-title">Gaston Pong</h3>
                     <p class="bluehour-caption">Date: 24 Dec 2022<br>Time: 8PM - 8:30PM</p>
                </div>
                <div class="col-6 text-center workshop-section entertain blue-hour-section">
                    <img src="{{ asset('img/beautiful-mistakes.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="Beautiful Mistakes">
                     <h3 class="bluehour-title">DJ Beautiful Mistakes</h3>
                     <p class="bluehour-caption">Date: 24 Dec 2022<br>Time: 9PM - 10:30PM</p>
                </div>
             </div>
             <div class="row px-xl-2 justify-content-md-center mb-30">
                 <div class="col-6 text-center workshop-section entertain blue-hour-section">
                     <img src="{{ asset('img/nicole.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="Nicole Lai">
                     <h3 class="bluehour-title">Nicole Lai</h3>
                     <p class="bluehour-caption">Date: 31 Dec 2022<br>Time: 8PM - 8:30PM</p>
                </div>
                <div class="col-6 text-center workshop-section entertain blue-hour-section">
                     <img src="{{ asset('img/dj-jovynn.jpg') }}" class="img-fluid blue-hour-img mb-20" alt="DJ Jovynn">
                     <h3 class="bluehour-title">DJ Jovynn</h3>
                     <p class="bluehour-caption">Date: 31 Dec 2022<br>Time: 9PM - 10:30PM</p>
                </div>
             </div>

             </div>
        </div>
    </div>      
</div>

<div class="d-flex position-relative pad-top30">
     <div class="align-items-center mx-auto content-width">
        <div class="row px-xl-2">
            <div class="col-md-12 col-12 text-center">
                 <div class="mx-auto">
                    <h1 class="dark-blue">An evening of playful elegance</h1>
                 </div>
            </div>
            <div class="col-6 mx-auto">
                <hr class="darkblue-line pad-top30">
            </div>    
        </div>
    </div>    
</div>   -->


    <!--<iframe width="100%" height="auto" style="aspect-ratio: 16 / 9;width: 100%;" src="https://www.youtube.com/embed/ckJ6thGRWh8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->

                
@endsection
