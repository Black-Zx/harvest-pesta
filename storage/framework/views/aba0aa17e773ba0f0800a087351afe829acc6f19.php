  
<?php $__env->startSection('page-title','Login'); ?>

<?php $__env->startSection('content'); ?>
<!-- BEGIN: Content-->




        <div class="content-body">
            <div class="auth-wrapper auth-v2">
                <div class="auth-inner row m-0">
                    
                    <!-- /Brand logo-->
                    <!-- Left Text-->
                    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5 login-bg">
                       <!-- <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid login-background" src="<?php echo e(asset('/app-assets/images/pages/login-background.svg')); ?>" alt="Login V2" /></div>-->
                    </div>
                    <!-- /Left Text-->
                    <!-- Login-->
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto text-center">
                            <h2 class="card-title font-weight-bold mb-1"></h2>
                            <img class="img-fluid matic-logo" src="<?php echo e(asset('/img/carsberg-logo.png')); ?>" alt="Logo" />
                            <p class="card-text mb-2"></p>
                            <?php if(count($errors) > 0): ?>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p><?php echo e($message); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <form class="auth-login-form mt-3" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <input class="form-control text-center" id="username" type="text" name="username" aria-describedby="username" autofocus="" tabindex="1" placeholder="<?php echo e(__('messages.username')); ?>" required/>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input class="form-control form-control-merge text-center" id="password" type="password" name="password" aria-describedby="password" tabindex="2" placeholder="<?php echo e(__('messages.password')); ?>" required/>
                                        <!--<div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>-->
                                        
                                    </div>
                                </div>
                                <input type="hidden" name="remember_me" value="1" />
                                <input type="submit" class="btn btn-primary btn-block mt-2 mb-1" tabindex="4" value="<?php echo e(__('messages.sign_in')); ?>" />
                            </form>
                        </div>
                    </div>
                    <!-- /Login-->
                </div>
            </div>
        </div>


<!-- END: Content-->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php if(session('success')): ?>
    <script>
        Swal.fire({
            title: '<?php echo e(__('messages.thank_you')); ?>',
            text: 'The password has been resetted.',
            icon: 'success',
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('member.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/comma-zx/Documents/php/harvest-pesta/resources/views/member/auth/login.blade.php ENDPATH**/ ?>