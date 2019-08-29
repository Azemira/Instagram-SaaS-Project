<div class="list-group list-group-transparent mb-0">
    <a href="<?php echo e(route('settings.index')); ?>" class="list-group-item list-group-item-action d-flex align-items-center <?php echo e(active('settings.index')); ?>">
        <i class="fe fe-settings mr-2"></i> <?php echo app('translator')->getFromJson('Settings'); ?>
    </a>
    <a href="<?php echo e(route('settings.users.index')); ?>" class="list-group-item list-group-item-action d-flex align-items-center <?php echo e(active('settings.users.*')); ?>">
        <i class="fe fe-users mr-2"></i> <?php echo app('translator')->getFromJson('Users'); ?>
    </a>
    <a href="<?php echo e(route('settings.packages.index')); ?>" class="list-group-item list-group-item-action d-flex align-items-center <?php echo e(active('settings.packages.*')); ?>">
        <i class="fe fe-package mr-2"></i> <?php echo app('translator')->getFromJson('Packages'); ?>
    </a>
    <a href="<?php echo e(route('settings.proxy.index')); ?>" class="list-group-item list-group-item-action d-flex align-items-center <?php echo e(active('settings.proxy.*')); ?>">
        <i class="fe fe-shield mr-2"></i> <?php echo app('translator')->getFromJson('Proxies'); ?>
    </a>
</div><?php /**PATH /var/www/html/autodimes/resources/views/partials/settings-sidebar.blade.php ENDPATH**/ ?>