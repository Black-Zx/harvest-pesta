<?php $__env->startSection('content'); ?>
<div class="content-body">
    <div class="card">
        <div class="card-header">
            <a href="<?php echo e(route("admin.dashboard")); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                  </svg>
            </a>
        </div>
        <div class="card-body">
            <div class="text-center form-border">
                
                <img src="<?php echo e($img); ?>" width="30%" alt="qr-code" class="mb-30 qr-code">
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/comma-zx/Documents/php/harvest-pesta/resources/views/admin/qr_code.blade.php ENDPATH**/ ?>