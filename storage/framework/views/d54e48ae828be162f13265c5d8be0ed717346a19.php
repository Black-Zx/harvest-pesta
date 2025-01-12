<?php $__env->startSection('page-title', 'Age Verification'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="age-wrapper">
                <a href="/" class="logo mt-30"><img src="<?php echo e(asset('img/carsberg-logo.png')); ?>" class="logo-img" width="120"></a>
            </div>
        </div>
    </div>
</div>
<div id="home" class="mt-neg40">
     <img src="<?php echo e(asset('img/bg-age-top.png')); ?>" class="img-fluid image-big">
     <img src="<?php echo e(asset('img/bg-age-top-mobile.png')); ?>" class="img-fluid image-responsive">
</div>
<div class="d-flex position-relative">
    <div class="align-items-center mx-auto content-width">
          <div class="container">
            <div class="row px-xl-2 mt-neg40 logo-pad"> 
                <div class="col-md-12 col-12 text-center">
                    <div class="mb-20">
                        <form action="<?php echo e(route('rsvp.check', ['fd' =>$fd ])); ?>" method="POST" class="age-wrapper">
                            <?php echo csrf_field(); ?>
                            <h1 class="font-nycarlsberg-b text-uppercase pad-bot10"><span class="first-letter">Enter year of your birth</h1> 
                            <div class="year-row">
                                <input name="first" id="first" class="year-input" onkeypress='validate(event)' type="text" maxlength="1" pattern="^[0-9]*$" required>
                                <input name="second" id="second" class="year-input" onkeypress='validate(event)' type="text" maxlength="1" pattern="^[0-9]*$" required>
                                <input name="third" id="third" class="year-input" onkeypress='validate(event)' type="text" maxlength="1" pattern="^[0-9]*$" required>
                                <input name="fourth" id="fourth" class="year-input" onkeypress='validate(event)' type="text" maxlength="1" pattern="^[0-9]*$" required>
                            </div>
                            <input type="hidden" name="check" value="1">

                            <div class="pad-top10">
                              <!--
                                 <div class="form-check>
                              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                              <input type="hidden" name="check" value="1">
                              <label class="form-check-label" for="flexCheckDefault">
                                <span class="age-verify text-uppercase">I confirm that I am non-Muslim aged 21 years old and above.</span>
                              </label>-->
                              <span class="age-verify text-uppercase">I confirm that I am non-Muslim aged 21 years old and above.</span>
                            </div>

                            <div class="pad-top30">
                                <button id="submit_buttom" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row age-wrapper">
                <div class="col-md-12 col-12 text-center pad-bot30 pad-top30 follow-small">
                    <div class="follow-width">
                        <div class="social-media mb-10">
                            <a href="https://www.facebook.com/CarlsbergMY"><img src="<?php echo e(asset('img/icon-fb.png')); ?>" class="img-fluid mr-10" width="20"></a>
                            <a href="https://www.instagram.com/CarlsbergMY/"><img src="<?php echo e(asset('img/icon-ig.png')); ?>" class="img-fluid mr-10" width="20"></a>
                            <span class="carlsberg text-uppercase">@CarlsbergMY</span>
                        </div>
                        <p class="disclaimer-home text-uppercase mb-20">For 21+ Non-Muslims only. Please only share this site to those aged 21+ and Non-Muslims. If you drink, don't drive. <a href="https://www.carlsbergmalaysia.com.my/sustainability/social/zero-irresponsible-drinking/" class="celebrate-button"></a></p>
                        <div class="celebrate-section">
                            <img src="<?php echo e(asset('img/twenty-one.png')); ?>" class="img-fluid mr-5" width="40">
                            <img src="<?php echo e(asset('img/dont-drive.png')); ?>" class="img-fluid mr-5" width="40">
                            <span class="celebrate-responsibly celebrate-font"><strong>#CELEBRATE</strong><span class="light-font">RESPONSIBLY</span></span>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="home-bottom mt-neg40">
    <img src="<?php echo e(asset('img/bg-age-bottom.png')); ?>" class="img-fluid image-big">
     <img src="<?php echo e(asset('img/bg-age-bottom-responsive.png')); ?>" class="img-fluid image-responsive">
</div>  

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<?php if(session('success')): ?>
        <script>
            Swal.fire({
                title: '<?php echo e(session('success')); ?>',
                text: '',
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-orange'
                },
                buttonsStyling: false
            });
        </script>
    <?php elseif( session('errors') ): ?>
        <script>
            Swal.fire({
                title: 'Opps!',
                text: '21 years old & above only',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn'
                },
                buttonsStyling: false

            });
        </script>
    <?php elseif( session('warning') ): ?>
        <script>
            Swal.fire({
                title: 'Opps',
                text: '<?php echo e(session('warning')); ?>',
                icon: 'warning',
                customClass: {
                    confirmButton: 'btn btn-orange'
                },
                buttonsStyling: false
            });
        </script>
    <?php endif; ?>
<script>
    $(function () {
        // $("#submit_buttom").prop("disabled",true);

        $(".year-input").keyup(function () {
            if (this.value.length == this.maxLength) {
                $(this).next('.year-input').focus();
            }
            var tmp1 = $("#first").val()==""?0:parseInt($("#first").val())*1000 ;
            var tmp2 = $("#second").val()==""?0:parseInt($("#second").val())*100;
            var tmp3 = $("#third").val()==""?0:parseInt($("#third").val())*10;
            var tmp4 = $("#fourth").val()==""?0:parseInt($("#fourth").val());

            // if ((new Date().getFullYear() - (tmp1+tmp2+tmp3+tmp4) >= 21) &&
            // $("#first").val() != "" &&
            // $("#second").val() != "" &&
            // $("#third").val() != "" &&
            // $("#fourth").val() != ""
            // ) {
            //     $("#submit_buttom").prop("disabled",false);
            // }else{
            //     $("#submit_buttom").prop("disabled",true);
            // }
        });
    });

    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/comma-zx/Documents/php/harvest-pesta/resources/views/home.blade.php ENDPATH**/ ?>