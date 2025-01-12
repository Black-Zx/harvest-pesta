@extends('layouts.app')

@section('page-title', 'Thank you')

@section('content')
<style>
    body, .responsive-bg{ background:none; }

 footer.pad-bot60{
    padding-bottom: 0;
}
       
</style>

<div class="bg-blue">
    <div class="col-md-12 col-12 text-center">
        <div class="pad-top40 pad-bot40">
            <img src="{{ asset('img/celebrate-1664.png') }}" class="logo-img ml-20" width="350">
        </div>
    </div>
</div>    

<div class="d-flex position-relative">
    <div class="align-items-center mx-auto content-width">
          <div class="container">
            <div class="row px-xl-2"> 
                <div class="col-md-12 col-12 text-center">
                    <div class="text-center mt-20 mb-30">
                        <h1 class="font-garamond text-uppercase"><span class="thank-you">TERMS & CONDITIONS</span></h1>
                    </div> 
                    <div class="tnc text-left">
                        <ul class="text-left" style="padding-left: 17px;">
                            <li>
                                <p class="mb-0">Organiser</p>
                                <p>The organizer of the Event is Carlsberg Marketing Sdn Bhd (“Carlsberg Malaysia”).</p>
                            </li>
                            <li>
                                <p class="mb-0">Eligibility </p>
                                <p class="mb-0">This Indemnity Form applies to all guests of Celebrate Moment with a Twist (Hereafter to be known as “Guest" or “Guests”). Individuals who are “Fully Vaccinated” means individuals who have met the following criteria:</p>
                                <ol style="list-style: lower-roman;">
                                    <li>For types of vaccine that require two doses of injection such as Comirnaty (Pfizer- BioNTech), COVID-19 AstraZeneca (Oxford-AstraZeneca), CoronaVac (Sinovac), Spikevax (Moderna) and Covilo (Sinopharm), the individual must have passed the 14th day from the date of the second dose of injection.</li>
                                    <li>For types of vaccine that require only one dose of injection such as COVID-19 Janssen (Johnson & Johnson) and Convidecia (CanSino), the individual must have passed the 28th day from the date of injection.</li>
                                    <li>The vaccination status on the Guest’s MySejahtera application is displayed as “Fully Vaccinated”.</li>
                                </ol>
                            </li>
                            <li>
                                <p class="mb-0">Additional Terms</p>
                                <ol style="list-style:lower-roman;">
                                    <li>Carlsberg Malaysia reserves the right to change, alter and/or cancel any terms and conditions and / or to limit and / or refuse and / or disqualify any Guests from participating in the Event without any notices / reasons thereof.</li>
                                    <li>Carlsberg Malaysia reserves the right to delay and/or cancel the Event at its sole discretion.</li>
                                </ol>
                            </li>
                        </ul>
                        <p>This event is for non-Muslims aged 21 and above only. By participating in this event, you agree and consent to the processing of your data in the manner stated in our privacy policy. For more details of our privacy policy, please visit <a href="https://carlsbergmalaysia.com.my/privacy-policy" target="_blank">https://carlsbergmalaysia.com.my/privacy-policy/</a>.</p>
                        <p class="mb-0">Please take note that by choosing to participate in this Event organised by Carlsberg Marketing Sdn. Bhd. (“Carlsberg”), you hereby acknowledge and agree to the following terms and conditions:</p>

                        <ul>
                            <li>RISK FACTORS: You understand and acknowledge that participation in the Event may involve risks such as, but not limited to, death, bodily injury and loss or damage to person and property. </li>

                            <li>ASSUMPTION OF RISK: You recognise that there are risks associated with your participation in the Event and agree to assume all such risks including, but not limited to, those that arises out of the use the venue and/or in relation to the Event itself, and the acts of others. </li>

                            <li>RELEASE OF LIABILITY: You hereby release Carlsberg and its affiliates and subsidiaries and the officers, directors, employees and agents of each of these entities and agree not to pursue any legal and/or civil action against them on account of or in connection with any claims, causes of action, injuries, losses, damages, or cost of expenses (whether direct or indirect) arising out of your participation in the Event whether or not caused by the acts, omissions or other faults of the parties being released.</li>

                            <li>INDEMNIFY AND DEFEND: You agree to  indemnify and defend Carlsberg and its affiliates and subsidiaries and the officers, directors, employees and agents of each of these entities (collectively, the “Indemnified Parties”) against, and hold them harmless from any or all claims, causes of action, damage judgments, costs or expenses, including legal fees, which in any way arises from your participation in the Event including, but not limited to, damages to or destruction of any property of the Indemnified Parties or any third party, injury or death of the undersigned or anyone else, or any liability arising from the negligent act or omission of the Indemnified Parties, the undersigned or any third party. </li>

                            <li> DAMAGES: You agree to pay for any or all damages to the venue and/or any property of the Indemnified Parties which are caused by your negligence or default. </li>

                            <li>EMERGENCY TREATMENT CONSENT: As a participant of the Event, you hereby consent to medical treatment in a medical emergency where you are unable to consent to such treatment. You are responsible for informing Carlsberg of any existing medical conditions or allergies prior to participation in the Event.</li>

                            <li>MODEL RELEASE: You hereby grant and assign to Carlsberg, its affiliates and subsidiaries, agencies and their representatives, an irrevocable and unrestricted right to use and publish videos, images, photographs or pictorial likenesses of you on Carlsberg’s website, social media or any other publications/press releases and to identify you by name and/or title and/or company for editorial, trade, advertising and/or any other purposes and in any manner and medium; to alter the same without restrictions; and to copyright the same. You hereby release Carlsberg, its affiliates and subsidiaries, agencies and their representatives and resign from all claims and liability to said videos and photographs. You acknowledge that you are not entitled to any compensation or consideration for the rights granted in this release.</li> 

                            <li>RULES AND REGULATIONS: You further agree to observe, obey and be bound by all the rules and regulations of the Event including any rules and standard operating procedures of the venue. </li>

                            <li>ACKNOWLEDGMENT: You acknowledge that you have carefully read the foregoing terms and conditions and understand the contents thereof and am participating in the Event voluntarily at your own free act and deed. You further acknowledge and confirm that you are at least twenty (21) years of age and non-Muslim as at the date of signing this letter of acknowledgement.   
                            </li>
                        </ul>
                        <p>By choosing to participate in this Event, you agree and acknowledge that you voluntarily assume any risk associated with the Event. Under no circumstances shall Carlsberg Malaysia be liable for any acts, omission, or default of those providing services in connection with the Event or any liability for any injury, damage, loss, delay or additional expenses (whether direct or indirect) which are incurred by you at or in relation with this Event.</p>
                        <div class="text-center pad-top40">
                            <a href="{{route('rsvp.home')}}" class="btn">Back to Home</a> 
                        </div>  
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>                        
@endsection
