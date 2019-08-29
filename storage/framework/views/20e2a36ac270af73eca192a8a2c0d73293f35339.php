<div class="row align-items-center">
    <div class="col-lg-3 ml-auto my-3 text-right">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
        <a href="<?php echo e(route('settings.index')); ?>" class="btn btn-outline-primary btn-sm <?php echo e(active('settings.*')); ?>">
            <i class="fe fe-settings"></i> <?php echo app('translator')->getFromJson('Settings'); ?>
        </a>
        <?php endif; ?>
    </div>
    <div class="col-lg order-lg-first">
        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
            <li class="nav-item">
                <a href="<?php echo e(route('dashboard')); ?>" class="nav-link">
                    <i class="fe fe-home"></i> <?php echo app('translator')->getFromJson('Dashboard'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('account.index')); ?>" class="nav-link <?php echo e(active('account.*')); ?>">
                    <i class="fe fe-instagram"></i> <?php echo app('translator')->getFromJson('Accounts'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link <?php echo e(active('list.*')); ?>" data-toggle="dropdown">
                    <i class="fe fe-list"></i> <?php echo app('translator')->getFromJson('Lists'); ?>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow">
                    <a href="<?php echo e(route('list.index', 'messages')); ?>" class="dropdown-item <?php echo e(active( route('list.index', 'messages') )); ?>">
                        <i class="fe fe-message-square"></i> <?php echo app('translator')->getFromJson('Messages'); ?>
                    </a>
                    <a href="<?php echo e(route('list.index', 'users')); ?>" class="dropdown-item <?php echo e(active( route('list.index', 'users') )); ?>">
                        <i class="fe fe-users"></i> <?php echo app('translator')->getFromJson('Users'); ?>
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('dm.message')); ?>" class="nav-link <?php echo e(active('dm.message')); ?>">
                    <i class="fe fe-send"></i> <?php echo app('translator')->getFromJson('Send message'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('autopilot.index')); ?>" class="nav-link <?php echo e(active('autopilot.*')); ?>">
                    <i class="fe fe-play"></i> <?php echo app('translator')->getFromJson('Autopilot'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('direct.index')); ?>" class="nav-link <?php echo e(active('direct.*')); ?>">
                    <i class="fe fe-message-circle"></i> <?php echo app('translator')->getFromJson('Direct Messenger'); ?>
                </a>
            </li>
        </ul>
    </div>
</div>

<?php /**PATH /var/www/html/autodimes/resources/views/partials/top-menu.blade.php ENDPATH**/ ?>