<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-4 col-lg-2">
                <ul class="list-unstyled mb-2">
                    <li><i class="fe fe-home"></i> <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->getFromJson('Dashboard'); ?></a></li>
                    <li><i class="fe fe-instagram"></i> <a href="<?php echo e(route('account.index')); ?>"><?php echo app('translator')->getFromJson('Accounts'); ?></a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <ul class="list-unstyled mb-2">
                    <li><i class="fe fe-message-square"></i> <a href="<?php echo e(route('list.index', 'messages')); ?>"><?php echo app('translator')->getFromJson('Messages lists'); ?></a></li>
                    <li><i class="fe fe-users"></i> <a href="<?php echo e(route('list.index', 'users')); ?>"><?php echo app('translator')->getFromJson('Users lists'); ?></a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <ul class="list-unstyled mb-2">
                    <li><i class="fe fe-send"></i> <a href="<?php echo e(route('dm.message')); ?>"><?php echo app('translator')->getFromJson('Send message'); ?></a></li>
                    <li><i class="fe fe-play"></i> <a href="<?php echo e(route('autopilot.index')); ?>"><?php echo app('translator')->getFromJson('Autopilot'); ?></a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <ul class="list-unstyled mb-2">
                    <li><i class="fe fe-message-circle"></i> <a href="<?php echo e(route('direct.index')); ?>"><?php echo app('translator')->getFromJson('Direct Messenger'); ?></a></li>
                    <li><i class="fe fe-user"></i> <a href="<?php echo e(route('profile.index')); ?>"><?php echo app('translator')->getFromJson('Profile'); ?></a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <ul class="list-unstyled mb-2">
                    <li><i class="fe fe-credit-card"></i> <a href="<?php echo e(route('billing.index')); ?>"><?php echo app('translator')->getFromJson('Billing'); ?></a></li>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
                    <li><i class="fe fe-settings"></i> <a href="<?php echo e(route('settings.index')); ?>"><?php echo app('translator')->getFromJson('Settings'); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div><?php /**PATH /var/www/html/autodimes/resources/views/partials/bottom-menu.blade.php ENDPATH**/ ?>