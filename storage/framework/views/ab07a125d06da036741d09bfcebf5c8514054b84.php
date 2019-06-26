<div class="d-flex">
    <a class="header-brand" href="<?php echo e(route('dashboard')); ?>">
        <?php echo e(__(config('app.name'))); ?>

        
    </a>
    <div class="d-flex order-lg-2 ml-auto">

        <?php if($notifications->count()): ?>
        <div class="dropdown d-none d-md-flex">
            <a class="nav-link icon" data-toggle="dropdown">
                <i class="fe fe-bell"></i>
                <span class="nav-unread"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('notifications')); ?>" class="dropdown-item">
                    <?php echo __('pilot.notification_' . $notification->data['action'], $notification->data); ?>

                    <div class="small text-muted"><?php echo e($notification->created_at->diffForHumans()); ?></div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="dropdown-divider"></div>
                <a href="<?php echo e(route('notifications')); ?>" class="dropdown-item text-center"><?php echo app('translator')->getFromJson('View all notifications'); ?></a>
            </div>
        </div>
        <?php endif; ?>

        <div class="dropdown">
            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                <span class="d-none d-lg-block">
                    <span class="text-default"><?php echo e(Auth::user()->name); ?></span>
                    <small class="text-muted d-block mt-1"><?php echo e(Auth::user()->email); ?></small>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <a class="dropdown-item <?php echo e(active('profile.index')); ?>" href="<?php echo e(route('profile.index')); ?>">
                    <i class="dropdown-icon fe fe-user"></i> <?php echo app('translator')->getFromJson('Profile'); ?>
                </a>
                <a class="dropdown-item <?php echo e(active('billing.index')); ?>" href="<?php echo e(route('billing.index')); ?>">
                    <i class="dropdown-icon fe fe-credit-card"></i> <?php echo app('translator')->getFromJson('Billing'); ?>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">
                    <i class="dropdown-icon fe fe-log-out"></i> <?php echo app('translator')->getFromJson('Sign out'); ?>
                </a>
            </div>
        </div>
    </div>
    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
        <span class="header-toggler-icon"></span>
    </a>
</div><?php /**PATH /var/www/html/autodimes/resources/views/partials/header.blade.php ENDPATH**/ ?>