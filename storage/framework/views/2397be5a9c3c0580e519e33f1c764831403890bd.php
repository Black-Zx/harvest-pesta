<?php $__env->startSection('page-title', 'Home'); ?>

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
<div id="home" class="mt-20">
     <img src="<?php echo e(asset('img/bg-entry.png')); ?>" class="img-fluid image-big">
     <img src="<?php echo e(asset('img/bg-entry-mobile.png')); ?>" class="img-fluid image-responsive">
</div>
<div class="d-flex position-relative">
    <div class="align-items-center mx-auto content-width">
          <div class="container">
            <div class="row px-xl-2 pad-top40 joinus-section"> 
                <div class="col-md-12 col-12 text-center">
                    <div class="age-wrapper">
                        <p class="join-us mb-0">JOIN US AT</p>
                        <h1 class="main-title mb-0">Carls Harvest Pesta</h1>
                        <h2 class="subtitle mb-30">FARley mall, Kuching</h2>
                        <a href="<?php echo e(route('rsvp.detail', ['fd' => $fd])); ?>" class="btn mb-30">NEXT</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="home-bottom">
    <img src="<?php echo e(asset('img/bg-bottom.png')); ?>" class="img-fluid image-big">
    <img src="<?php echo e(asset('img/bg-bottom-mobile.jpg')); ?>" class="img-fluid image-responsive">
</div>    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/comma-zx/Documents/php/harvest-pesta/resources/views/landing.blade.php ENDPATH**/ ?>