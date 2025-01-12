<table>
    <thead>
        <tr>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Name</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Email</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Phone Number</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">NRIC</th>
            
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Check In Time</th>
            
            
                
            
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="border: 1px solid black"><?php echo e($param->name); ?></td>
                <td style="border: 1px solid black"><?php echo e($param->email); ?></td>
                <td style="border: 1px solid black"><?php echo e($param->mobile); ?></td>
                <td style="border: 1px solid black"><?php echo e($param->nric); ?></td>
                
                <td style="border: 1px solid black"><?php echo e($param->check_in); ?></td>
                
                
                    
                
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /Users/comma-zx/Documents/php/harvest-pesta/resources/views/exports/customers/checkin.blade.php ENDPATH**/ ?>