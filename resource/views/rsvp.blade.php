@extends('layouts.app')

@section('page-title', 'RSVP')

@section('content')
<div class="bg-form">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="age-wrapper">
                    <a href="/" class="logo mt-30"><img src="{{ asset('img/carsberg-logo.png') }}" class="logo-img" width="120"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex position-relative" id="app">
        <div class="align-items-center mx-auto content-width">
              <div class="container">
                <div class="hornbill">
                     <img src="{{ asset('img/hornbill.png') }}" width="280">
                </div> 
                <div class="row px-xl-2 pad-top40 logo-pad"> 
                    <div class="col-md-12 col-12 text-center mb-30">
                        <div class="age-wrapper">
                            <div class="form-border">
                                <p class="register-text text-uppercase">Register Now!</p>
                                <form id="rsvp" action="{{route('rsvp.post')}}" method="POST" onSubmit="">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required> 
                                    </div>
                                     <div class="mb-3">
                                        <label for="nric" class="form-label">IC/passport</label>
                                        <input type="text" class="form-control" id="nric" name="nric" required>
                                    </div>
                                     <div class="mb-3">
                                       <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                         <label for="mobile" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" required>
                                            <!-- placeholder="01212345678" -->
                                    </div>

                                     <!--<div class="mb-3">
                                        <label for="event" class="form-label">Select Your Entry Pass*</label>
                                        <select v-model="selected" @change="selectedOnChanged()" class="form-select"
                                            aria-label="Select Your Entry Pass" name="event" required>
                                            <option selected value="">Select Your Entry Pass</option>
                                            <option v-for="event in events" :value="event.id" :key="event.id">@{{ event.name }}</option>
                                        </select>
                                    </div>-->
                                    @if ($fd != null)
                                        <div class="mb-3">
                                            <label for="event" class="form-label">Preferred Date</label>
                                            <input type="text" class="form-control" name="date" value="23th May 2024" readonly>
                                        </div>
                                        <input type="hidden" name="fixed_date" value="2">
                                    @else
                                        <div class="mb-3">
                                            <label for="event" class="form-label">Preferred Date</label>
                                            <select class="form-select" aria-label="Select Preferred" name="date">
                                                <option selected value="">Select Preferred</option>
                                                <option value="22th May 2024">22th May 2024</option>
                                                <option value="23th May 2024">23th May 2024</option>
                                                <option value="24th May 2024">24th May 2024</option>
                                                <option value="25th May 2024">25th May 2024</option>
                                                <!-- <template v-for="time in time_slots">
                                                    <option :value="time.date">@{{ time.date }} @{{ time.text }}</option>
                                                </template> -->
                                            </select>
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <label for="event" class="form-label">what is your preferred BEER brand</label>
                                        <select class="form-select"
                                            aria-label="What Is Your Preferred Beer Brands" name="beer" required>
                                            <option selected value="" class="text-uppercase">What Is Your Preferred Beer Brand</option>
                                            @foreach($beers as $beer)
                                                <option value="{{$beer->name}}">{{$beer->name}}</option>
                                            @endforeach
                                        </select>
                                     </div>   

                                    <!--<div v-if="time_slots.length != 0" class="mb-3">
                                        <label for="event" class="form-label">Select Your Preferred Time Slot*</label>
                                        <select class="form-select" aria-label="Select Your Preferred Time Slot" name="time_slot_id[]" required>
                                            <option selected value="">Select your preferred time slot</option>
                                            <template v-for="time in time_slots">
                                                <option v-if="time.date == selectedDate" :value="time.id">@{{ time.time_slot }}</option>
                                            </template>
                                        </select>
                                    </div>-->
                                   
                                    <div class="form-check text-left pad-top10">
                                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                      <label class="form-check-label" for="flexCheckDefault">
                                        <span class="termsncondition text-uppercase">I confirm that i am a non-muslim, aged 21 years old and above</span>
                                      </label>
                                    </div>

                                    <div class="form-check text-left pad-top10 pad-bot30">
                                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2" required>
                                      <label class="form-check-label" for="flexCheckDefault2">
                                        <span class="termsncondition text-uppercase">I agree and consent to the <a href="https://www.carlsbergmalaysia.com.my/standard-terms-conditions/">Terms & Conditions</a> and Carlsberg Malaysia’s <a href="https://www.carlsbergmalaysia.com.my/privacy-policy/">Privacy Policy</a>, and agree to receive promotional offers and other communications</span>
                                      </label>
                                    </div>

                                    <div id="submit_buttom">
                                        <button type="submit" class="btn btn-primary btn-secondary">Submit</button>
                                    </div>
                                </form> 
                            </div>
                        </div>
            </div>
        </div>
      </div>
    </div>
    </div>
</div>
<div class="home-bottom mt-neg200">
    <img src="{{ asset('img/bg-form-bottom.png') }}" class="img-fluid image-big">
    <img src="{{ asset('img/bg-form-bottom-reponsive.png') }}" class="img-fluid image-responsive">
</div> 
<div class="rafflesia-group">
    <div class="rafflesia">
        <img src="{{ asset('img/bg-form-bottom_element.png') }}" class="img-fluid image-big">
        <img src="{{ asset('img/bg-form-bottom_element-mobile.png') }}" class="img-fluid image-responsive">
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
                    confirmButton: 'btn'
                },
                buttonsStyling: false
            });
        </script>
    @elseif( session('errors') )

        <script>
            var result = '{{ session('errors') }}';
            var convert = result.replace(/(&quot\;)/g,"\"");
            var tmp = JSON.parse(convert)
            console.log( tmp );
            Swal.fire({
                title: 'Opps',
                text: tmp[0][0],
                icon: 'error',
                customClass: {
                    confirmButton: 'btn'
                },
                buttonsStyling: false
            });
        </script>
    @elseif( session('slots') )

    <script>
        Swal.fire({
            title: 'Opps',
            text: 'Opps, it no available for this moment.',
            icon: 'error',
            customClass: {
                confirmButton: 'btn btn-orange'
            },
            buttonsStyling: false
        });
    </script>
    @elseif( session('aldy') )

    <script>
        Swal.fire({
            title: 'Opps',
            text: 'You already register.',
            icon: 'error',
            customClass: {
                confirmButton: 'btn btn-orange'
            },
            buttonsStyling: false
        });
    </script>
    @endif

<script>

    const { createApp } = Vue

    createApp({
    data() {
        return {
            // selected: event_id,
            selectedDate: '',
            // events: events,
            min: "",
            max: "",
            time_slots: [],
            event: [],
            submitStatus: false
        }
    },
    methods: {
        selectedOnChanged() {
            _this = this;
            _this.selectedDate = '';
            _this.time_slots = [];
            // if (_this.selected) {
            //     var selected_event = _this.events.filter(function (event) {
            //         return event.id == _this.selected;
            //     });
            //     _this.time_slots = JSON.parse(JSON.stringify(selected_event))[0].date_slots;
            //     _this.min = JSON.parse(JSON.stringify(selected_event))[0].min_date.toString();
            //     _this.max = JSON.parse(JSON.stringify(selected_event))[0].max_date.toString();
            // }
        },
        submitRSVP() {
            console.log("submit");
            this.submitStatus = true;
        }
    },
    beforeMount(){
        // this.selectedOnChanged()
    }
    }).mount('#app')

</script>
@endpush