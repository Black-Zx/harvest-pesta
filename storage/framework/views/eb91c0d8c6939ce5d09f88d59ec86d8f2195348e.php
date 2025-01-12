<!-- BEGIN: Vendor JS-->
<script src="<?php echo e(asset('/app-assets/vendors/js/vendors.min.js')); ?>"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="<?php echo e(asset('app-assets/vendors/js/pickers/pickadate/picker.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/pickers/pickadate/picker.date.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/pickers/pickadate/picker.time.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/pickers/pickadate/legacy.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')); ?>"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="<?php echo e(asset('/app-assets/vendors/js/forms/validation/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('/app-assets/vendors/js/extensions/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('/app-assets/vendors/js/extensions/polyfill.min.js')); ?>"></script>
<script src="<?php echo e(asset('/app-assets/vendors/js/extensions/jstree.min.js')); ?>"></script>
<script src="<?php echo e(asset('/app-assets/vendors/js/forms/select/select2.full.min.js')); ?>"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="<?php echo e(asset('/app-assets/js/core/app-menu.js')); ?>"></script>
<script src="<?php echo e(asset('/app-assets/js/core/app.js')); ?>"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="<?php echo e(asset('/app-assets/js/scripts/forms/pickers/form-pickers.js')); ?>"></script>
<script src="<?php echo e(asset('/app-assets/js/scripts/forms/form-select2.js')); ?>"></script>
<!-- END: Page JS-->

<!-- BEGIN: Repeater-->
<script src="<?php echo e(asset('/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')); ?>"></script>
<!-- END: Repeater-->

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>

<?php echo $__env->yieldPushContent('scripts'); ?><?php /**PATH /Users/comma-zx/Documents/php/harvest-pesta/resources/views/member/layouts/scripts.blade.php ENDPATH**/ ?>