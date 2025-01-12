<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <?php echo $__env->make('member.layouts.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('member.layouts.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static <?php if(Route::currentRouteName() == 'admin.showLoginForm'): ?>blank-page <?php endif; ?>" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    
    <?php if(Route::currentRouteName() != 'admin.showLoginForm'): ?>
        <?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin.layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        <?php echo $__env->make('member.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->yieldContent('content'); ?>
    <?php endif; ?>

    <?php echo $__env->make('member.layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH /Users/comma-zx/Documents/php/harvest-pesta/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>