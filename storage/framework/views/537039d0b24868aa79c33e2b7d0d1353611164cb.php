  
<?php $__env->startSection('content'); ?>
<!-- BEGIN: Content-->
<div class="content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-v2">
                <div class="auth-inner row m-0">
                    <!-- /Brand logo-->
                    <!-- Left Text-->
                    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="<?php echo e(asset('/app-assets/images/pages/register-v2.svg')); ?>" alt="Login V2" /></div>
                    </div>
                    <!-- /Left Text-->
                    <!-- Login-->
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto text-center">
                            <img class="img-fluid" src="<?php echo e(asset('/img/carsberg-logo.png')); ?>" alt="Carlsberg Logo" />
                            <h2 class="card-title font-weight-bold mb-1"><?php echo e(__('messages.admin')); ?></h2>
                            <?php if(count($errors) > 0): ?>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p><?php echo e($message); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <form class="auth-login-form mt-2" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <input class="form-control" id="username" type="text" name="username" aria-describedby="username" autofocus="" tabindex="1" placeholder="<?php echo e(__('messages.username')); ?>" required/>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input class="form-control form-control-merge" id="password" type="password" name="password" aria-describedby="password" placeholder="<?php echo e(__('messages.password')); ?>" tabindex="2" required/>
                                    </div>
                                </div>
                                <input type="hidden" name="remember_me" value="1" />
                                <input type="submit" class="btn btn-primary btn-block" tabindex="4" value="<?php echo e(__('messages.sign_in')); ?>" />

                            
                            </form>
                        </div>
                    </div>
                    <!-- /Login-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/comma-zx/Documents/php/harvest-pesta/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>