  
    
    <style>
        #modal-close {
            box-sizing: content-box;
            width: 1em;
            height: 1em;
            padding: 0.25em 0.25em;
            color: #000;
            background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
            border: 0;
            border-radius: 0.375rem;
            opacity: 0.5;
        }
    </style>

<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Check In List</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><?php echo e(__('messages.admin')); ?></a>
                            </li>
                            <li class="breadcrumb-item active">Check In List
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <section id="team">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo e(__('messages.search')); ?>

                            </h4>
                        </div>
                        <div class="card-body">
                            <form method="GET">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="fullname">Date
                                            </label>
                                            <input type="date" id="date" name="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="fullname"><?php echo e(__('messages.fullname')); ?>

                                            </label>
                                            <input type="text" id="name" name="name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email"><?php echo e(__('messages.email')); ?>

                                            </label>
                                            <input type="text" id="email" name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nric">Nric
                                            </label>
                                            <input type="text" id="nric" name="nric" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="mobile">Phone Number
                                            </label>
                                            <input type="text" id="mobile" name="mobile" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary waves-effect waves-float waves-light"
                                    value="<?php echo e(__('messages.submit')); ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="event1-tab" data-toggle="tab" data-target="#event1"
                            type="button" role="tab" aria-controls="event1" aria-selected="true">All</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="event2-tab" data-toggle="tab" data-target="#event2"
                            type="button" role="tab" aria-controls="event2" aria-selected="false">22th May 2024</button>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="event3-tab" data-toggle="tab" data-target="#event3"
                            type="button" role="tab" aria-controls="event3" aria-selected="false">23th May 2024</button>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="event4-tab" data-toggle="tab" data-target="#event4"
                            type="button" role="tab" aria-controls="event4" aria-selected="false">24th May 2024</button>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="event5-tab" data-toggle="tab" data-target="#event5"
                            type="button" role="tab" aria-controls="event5" aria-selected="false">25th May 2024</button>
                    </li>

                    
                </ul>
                
                
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="event1" role="tabpanel" aria-labelledby="event1-tab">
                        <div class="row" id="table-responsive">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Check In List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <h6>
                                                    Date : <?php echo e($date); ?>

                                                    <br>
                                                    Check In : <?php echo e($report1_total); ?> / <?php echo e($report1->total()); ?>

                                                </h6>
                                            </div>
                                            <div class="col-2">
                                                <form action="<?php echo e(route('export.checkin')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                    <input type="submit" class="btn btn-primary float-right" value="Export">
                                                    <input name="type" type="hidden" value="Checkin">
                                                    <input name="event" type="hidden" value="1">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                    <th scope="col" class="text-nowrap">qr code</th>
                                                    <th scope="col" class="text-nowrap">Name</th>
                                                    <th scope="col" class="text-nowrap">Email</th>
                                                    <th scope="col" class="text-nowrap">Phone Number</th>
                                                    <th scope="col" class="text-nowrap">NRIC</th>
                                                    <th scope="col" class="text-nowrap">Register Time</th>
                                                    <th scope="col" class="text-nowrap">Event Date</th>
                                                    <th scope="col" class="text-nowrap">Check In Time</th>
                                                    <th scope="col" class="text-nowrap">Redemption Time</th>
                                                    <th scope="col" class="text-nowrap">Invited</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(count($report1)): ?>
                                                <?php $__currentLoopData = $report1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php if($param->check_in == null): ?>
                                                        
                                                        
                                                            <?php if($param->guest == 1): ?>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 1)">
                                                                </form>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="2">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 2)">
                                                                </form>
                                                            <?php else: ?>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)">
                                                                </form>
                                                            <?php endif; ?>
                                                        
                                                        <?php endif; ?>

                                                        <?php if($param->redemption_time->pluck('created_at')->first() == null): ?>
                                                            <form action="<?php echo e(route('admin.redemption.checkin')); ?>" method="POST" class="mb-1">
                                                                <?php echo csrf_field(); ?>
                                                                    <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                    
                                                                    <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Redemption">
                                                            </form>
                                                        <?php endif; ?>
                                                    </td> 
                                                    <td>
                                                        
                                                        <a data-target-id="<?php echo e($param->id); ?>" data-toggle="modal" data-target="#qrcodeModal" class="btn btn-sm btn-link qrcode_view" data-qr="<?php echo e($param->qr_code); ?>" id="qrcode_view">View</a>
                                                    </td>
                                                    <td><?php echo e($param->name); ?></td>
                                                    <td><?php echo e($param->email); ?></td>
                                                    <td><?php echo e($param->mobile); ?></td>
                                                    <td><?php echo e($param->nric); ?></td>
                                                    <td><?php echo e($param->created_at); ?></td>
                                                    <td><?php echo e($param->date); ?></td>
                                                    <td><?php echo e($param->check_in); ?></td>
                                                    <td><?php echo e($param->redemption_time->pluck('created_at')->first()); ?></td>
                                                    <?php if($param->fixed_date == 0): ?>
                                                        <td>N</td>
                                                    <?php else: ?>
                                                        <td>Y</td>
                                                    <?php endif; ?>
                                                    
                                                    
                                                </tr>
                                                
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td> <?php echo e(__('messages.no_record')); ?></td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <?php echo e($report1->appends(request()->query())->links('vendor.pagination.bootstrap-4')); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="event2" role="tabpanel" aria-labelledby="event2-tab">
                        <div class="row" id="table-responsive">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Check In List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <h6>
                                                    Date : <?php echo e($date); ?>

                                                    <br>
                                                    Check In : <?php echo e($report2_total); ?> / <?php echo e($report2->total()); ?>

                                                </h6>
                                            </div>
                                            <div class="col-2">
                                                <form action="<?php echo e(route('export.checkin')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                    <input type="submit" class="btn btn-primary float-right" value="Export">
                                                    <input name="type" type="hidden" value="Checkin">
                                                    <input name="report_date" type="hidden" value="<?php echo e($report_date1->date ?? '-'); ?>">
                                                    <input name="event" type="hidden" value="5">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                    <th scope="col" class="text-nowrap">qr code</th>
                                                    <th scope="col" class="text-nowrap">Name</th>
                                                    <th scope="col" class="text-nowrap">Email</th>
                                                    <th scope="col" class="text-nowrap">Phone Number</th>
                                                    <th scope="col" class="text-nowrap">NRIC</th>
                                                    <th scope="col" class="text-nowrap">Register Time</th>
                                                    <th scope="col" class="text-nowrap">Event Date</th>
                                                    <th scope="col" class="text-nowrap">Check In Time</th>
                                                    <th scope="col" class="text-nowrap">Redemption Time</th>
                                                    <th scope="col" class="text-nowrap">Invited</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(count($report2)): ?>
                                                <?php $__currentLoopData = $report2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php if($param->check_in == null): ?>
                                                        
                                                        
                                                            <?php if($param->guest == 1): ?>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 1)">
                                                                </form>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="2">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 2)">
                                                                </form>
                                                            <?php else: ?>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)">
                                                                </form>
                                                            <?php endif; ?>
                                                        
                                                        <?php endif; ?>

                                                        <?php if($param->redemption_time->pluck('created_at')->first() == null): ?>
                                                            <form action="<?php echo e(route('admin.redemption.checkin')); ?>" method="POST" class="mb-1">
                                                                <?php echo csrf_field(); ?>
                                                                    <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                    
                                                                    <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Redemption">
                                                            </form>
                                                        <?php endif; ?>
                                                    </td> 
                                                    <td>
                                                        
                                                        <a data-target-id="<?php echo e($param->id); ?>" data-toggle="modal" data-target="#qrcodeModal" class="btn btn-sm btn-link qrcode_view" data-qr="<?php echo e($param->qr_code); ?>" id="qrcode_view">View</a>
                                                    </td>
                                                    <td><?php echo e($param->name); ?></td>
                                                    <td><?php echo e($param->email); ?></td>
                                                    <td><?php echo e($param->mobile); ?></td>
                                                    <td><?php echo e($param->nric); ?></td>
                                                    <td><?php echo e($param->created_at); ?></td>
                                                    <td><?php echo e($param->date); ?></td>
                                                    <td><?php echo e($param->check_in); ?></td>
                                                    <td><?php echo e($param->redemption_time->pluck('created_at')->first()); ?></td>
                                                    <?php if($param->fixed_date == 0): ?>
                                                        <td>N</td>
                                                    <?php else: ?>
                                                        <td>Y</td>
                                                    <?php endif; ?>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td> <?php echo e(__('messages.no_record')); ?></td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <?php echo e($report2->appends(request()->query())->links('vendor.pagination.bootstrap-4')); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="event3" role="tabpanel" aria-labelledby="event3-tab">
                        <div class="row" id="table-responsive">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Check In List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <h6>
                                                    Date : <?php echo e($date); ?>

                                                    <br>
                                                    Check In : <?php echo e($report3_total); ?> / <?php echo e($report3->total()); ?>

                                                </h6>
                                            </div>
                                            <div class="col-2">
                                                <form action="<?php echo e(route('export.checkin')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                    <input type="submit" class="btn btn-primary float-right" value="Export">
                                                    <input name="type" type="hidden" value="Checkin">
                                                    <input name="report_date" type="hidden" value="<?php echo e($report_date2->date ?? '-'); ?>">
                                                    <input name="event" type="hidden" value="5">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                    <th scope="col" class="text-nowrap">qr code</th>
                                                    <th scope="col" class="text-nowrap">Name</th>
                                                    <th scope="col" class="text-nowrap">Email</th>
                                                    <th scope="col" class="text-nowrap">Phone Number</th>
                                                    <th scope="col" class="text-nowrap">NRIC</th>
                                                    <th scope="col" class="text-nowrap">Register Time</th>
                                                    <th scope="col" class="text-nowrap">Event Date</th>
                                                    <th scope="col" class="text-nowrap">Check In Time</th>
                                                    <th scope="col" class="text-nowrap">Redemption Time</th>
                                                    <th scope="col" class="text-nowrap">Invited</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(count($report3)): ?>
                                                <?php $__currentLoopData = $report3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php if($param->check_in == null): ?>
                                                        
                                                        
                                                            <?php if($param->guest == 1): ?>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 1)">
                                                                </form>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="2">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 2)">
                                                                </form>
                                                            <?php else: ?>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)">
                                                                </form>
                                                            <?php endif; ?>
                                                        
                                                        <?php endif; ?>

                                                        <?php if($param->redemption_time->pluck('created_at')->first() == null): ?>
                                                            <form action="<?php echo e(route('admin.redemption.checkin')); ?>" method="POST" class="mb-1">
                                                                <?php echo csrf_field(); ?>
                                                                    <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                    
                                                                    <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Redemption">
                                                            </form>
                                                        <?php endif; ?>
                                                    </td> 
                                                    <td>
                                                        
                                                        <a data-target-id="<?php echo e($param->id); ?>" data-toggle="modal" data-target="#qrcodeModal" class="btn btn-sm btn-link qrcode_view" data-qr="<?php echo e($param->qr_code); ?>" id="qrcode_view">View</a>
                                                    </td>
                                                    <td><?php echo e($param->name); ?></td>
                                                    <td><?php echo e($param->email); ?></td>
                                                    <td><?php echo e($param->mobile); ?></td>
                                                    <td><?php echo e($param->nric); ?></td>
                                                    <td><?php echo e($param->created_at); ?></td>
                                                    <td><?php echo e($param->date); ?></td>
                                                    <td><?php echo e($param->check_in); ?></td>
                                                    <td><?php echo e($param->redemption_time->pluck('created_at')->first()); ?></td>
                                                    <?php if($param->fixed_date == 0): ?>
                                                        <td>N</td>
                                                    <?php else: ?>
                                                        <td>Y</td>
                                                    <?php endif; ?>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td> <?php echo e(__('messages.no_record')); ?></td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <?php echo e($report2->appends(request()->query())->links('vendor.pagination.bootstrap-4')); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="event4" role="tabpanel" aria-labelledby="event4-tab">
                        <div class="row" id="table-responsive">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Check In List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <h6>
                                                    Date : <?php echo e($date); ?>

                                                    <br>
                                                    Check In : <?php echo e($report4_total); ?> / <?php echo e($report4->total()); ?>

                                                </h6>
                                            </div>
                                            <div class="col-2">
                                                <form action="<?php echo e(route('export.checkin')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                    <input type="submit" class="btn btn-primary float-right" value="Export">
                                                    <input name="type" type="hidden" value="Checkin">
                                                    <input name="report_date" type="hidden" value="<?php echo e($report_date3->date ?? '-'); ?>">
                                                    <input name="event" type="hidden" value="5">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                    <th scope="col" class="text-nowrap">qr code</th>
                                                    <th scope="col" class="text-nowrap">Name</th>
                                                    <th scope="col" class="text-nowrap">Email</th>
                                                    <th scope="col" class="text-nowrap">Phone Number</th>
                                                    <th scope="col" class="text-nowrap">NRIC</th>
                                                    <th scope="col" class="text-nowrap">Register Time</th>
                                                    <th scope="col" class="text-nowrap">Event Date</th>
                                                    <th scope="col" class="text-nowrap">Check In Time</th>
                                                    <th scope="col" class="text-nowrap">Redemption Time</th>
                                                    <th scope="col" class="text-nowrap">Invited</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(count($report4)): ?>
                                                <?php $__currentLoopData = $report4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php if($param->check_in == null): ?>
                                                        
                                                            <?php if($param->guest == 1): ?>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 1)">
                                                                </form>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="2">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 2)">
                                                                </form>
                                                            <?php else: ?>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)">
                                                                </form>
                                                            <?php endif; ?>
                                                        
                                                        <?php endif; ?>

                                                        <?php if($param->redemption_time->pluck('created_at')->first() == null): ?>
                                                            <form action="<?php echo e(route('admin.redemption.checkin')); ?>" method="POST" class="mb-1">
                                                                <?php echo csrf_field(); ?>
                                                                    <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                    
                                                                    <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Redemption">
                                                            </form>
                                                        <?php endif; ?>
                                                    </td> 
                                                    <td>
                                                        
                                                        <a data-target-id="<?php echo e($param->id); ?>" data-toggle="modal" data-target="#qrcodeModal" class="btn btn-sm btn-link qrcode_view" data-qr="<?php echo e($param->qr_code); ?>" id="qrcode_view">View</a>
                                                    </td>
                                                    <td><?php echo e($param->name); ?></td>
                                                    <td><?php echo e($param->email); ?></td>
                                                    <td><?php echo e($param->mobile); ?></td>
                                                    <td><?php echo e($param->nric); ?></td>
                                                    <td><?php echo e($param->created_at); ?></td>
                                                    <td><?php echo e($param->date); ?></td>
                                                    <td><?php echo e($param->check_in); ?></td>
                                                    <td><?php echo e($param->redemption_time->pluck('created_at')->first()); ?></td>
                                                    <?php if($param->fixed_date == 0): ?>
                                                        <td>N</td>
                                                    <?php else: ?>
                                                        <td>Y</td>
                                                    <?php endif; ?>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td> <?php echo e(__('messages.no_record')); ?></td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <?php echo e($report2->appends(request()->query())->links('vendor.pagination.bootstrap-4')); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="event5" role="tabpanel" aria-labelledby="event5-tab">
                        <div class="row" id="table-responsive">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Check In List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <h6>
                                                    Date : <?php echo e($date); ?>

                                                    <br>
                                                    Check In : <?php echo e($report5_total); ?> / <?php echo e($report5->total()); ?>

                                                </h6>
                                            </div>
                                            <div class="col-2">
                                                <form action="<?php echo e(route('export.checkin')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                    <input type="submit" class="btn btn-primary float-right" value="Export">
                                                    <input name="type" type="hidden" value="Checkin">
                                                    <input name="report_date" type="hidden" value="<?php echo e($report_date4->date ?? '-'); ?>">
                                                    <input name="event" type="hidden" value="5">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-nowrap">Action</th>
                                                    <th scope="col" class="text-nowrap">qr code</th>
                                                    <th scope="col" class="text-nowrap">Name</th>
                                                    <th scope="col" class="text-nowrap">Email</th>
                                                    <th scope="col" class="text-nowrap">Phone Number</th>
                                                    <th scope="col" class="text-nowrap">NRIC</th>
                                                    <th scope="col" class="text-nowrap">Register Time</th>
                                                    <th scope="col" class="text-nowrap">Event Date</th>
                                                    <th scope="col" class="text-nowrap">Check In Time</th>
                                                    <th scope="col" class="text-nowrap">Redemption Time</th>
                                                    <th scope="col" class="text-nowrap">Invited</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(count($report5)): ?>
                                                <?php $__currentLoopData = $report5; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php if($param->check_in == null): ?>
                                                            <?php if($param->guest == 1): ?>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 1)">
                                                                </form>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="2">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (Guest 2)">
                                                                </form>
                                                            <?php else: ?>
                                                                <form action="<?php echo e(route('admin.checkin')); ?>" method="POST" class="mb-1">
                                                                    <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                        <input type="hidden" name="type" value="1">
                                                                        <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Check In (VIP)">
                                                                </form>
                                                            <?php endif; ?>
                                                        
                                                        <?php endif; ?>

                                                        <?php if($param->redemption_time->pluck('created_at')->first() == null): ?>
                                                            <form action="<?php echo e(route('admin.redemption.checkin')); ?>" method="POST" class="mb-1">
                                                                <?php echo csrf_field(); ?>
                                                                    <input type="hidden" name="id" value="<?php echo e($param->id); ?>">
                                                                    
                                                                    <input type="submit" class="btn btn-primary waves-effect waves-float waves-light" value="Redemption">
                                                            </form>
                                                        <?php endif; ?>
                                                    </td> 
                                                    <td>
                                                        
                                                        <a data-target-id="<?php echo e($param->id); ?>" data-toggle="modal" data-target="#qrcodeModal" class="btn btn-sm btn-link qrcode_view" data-qr="<?php echo e($param->qr_code); ?>" id="qrcode_view">View</a>
                                                    </td>
                                                    <td><?php echo e($param->name); ?></td>
                                                    <td><?php echo e($param->email); ?></td>
                                                    <td><?php echo e($param->mobile); ?></td>
                                                    <td><?php echo e($param->nric); ?></td>
                                                    <td><?php echo e($param->created_at); ?></td>
                                                    <td><?php echo e($param->date); ?></td>
                                                    <td><?php echo e($param->check_in); ?></td>
                                                    <td><?php echo e($param->redemption_time->pluck('created_at')->first()); ?></td>
                                                    <?php if($param->fixed_date == 0): ?>
                                                        <td>N</td>
                                                    <?php else: ?>
                                                        <td>Y</td>
                                                    <?php endif; ?>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td> <?php echo e(__('messages.no_record')); ?></td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <?php echo e($report2->appends(request()->query())->links('vendor.pagination.bootstrap-4')); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <div aria-live="polite" aria-atomic="true" style="position: relative">
            <div id="notification-body" style="position: fixed; top: 1rem; right: 1rem; margin-left: 1rem; z-index: 1030">
            </div>
        </div>
    </div>
</div>

<?php if(count($report1)): ?>
<?php $__currentLoopData = $report1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade wv-modal" id="qrcodeModal" role="dialog" tabindex="-1" aria-labelledby="qrcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">QR CODE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="modal-close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="card-body">
                    <img src="" id="user-data" width="60%" alt="qr-code" class="mb-30 qr-code">
                    
                </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-close" data-bs-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

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
                title: 'Opps',
                text: 'Please try again.',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-orange'
                },
                buttonsStyling: false
            });
        </script>
    <?php endif; ?>

    <script>
        $(document).ready(function(){
            $("#qrcodeModal").on("show.bs.modal", function(e) {
                var qr = $(e.relatedTarget).data('qr');
                // var ids = $(e.relatedTarget).data('target-id');

                $("#user-data").attr("src", qr);
                // $("#user-id").val(ids);
            });
            
            $(".btn-close").click(function(){
                $("#qrcodeModal").modal('hide');
            });
        });
    </script>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/comma-zx/Documents/php/harvest-pesta/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>