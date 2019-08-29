<?php $__env->startSection('title', __('Add account')); ?>

<?php $__env->startSection('content'); ?>

    <?php if($needUpgrade): ?>
        <div class="alert alert-danger text-center">
            <strong><i class="fe fe-alert-triangle mr-2"></i> <?php echo app('translator')->getFromJson('You reached your accounts limit on current package. Please <a href=":link">upgrade</a> to add more accounts.', ['link' => route('billing.index')]); ?></strong>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="dimmer">
                        <div class="loader"></div>
                        <div class="dimmer-content">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo app('translator')->getFromJson('Add account'); ?></h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label class="form-label"><?php echo app('translator')->getFromJson('Username'); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fe fe-instagram"></i>
                                            </span>
                                        </span>
                                        <input type="text" name="username" class="form-control" placeholder="<?php echo app('translator')->getFromJson('Username'); ?>" autocomplete="off">
                                    </div>
                                    <small class="help-block"><?php echo app('translator')->getFromJson('Instagram username'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label class="form-label"><?php echo app('translator')->getFromJson('Password'); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fe fe-eye-off"></i>
                                            </span>
                                        </span>
                                        <input type="password" name="password" class="form-control" placeholder="<?php echo app('translator')->getFromJson('Password'); ?>" autocomplete="off">
                                    </div>
                                    <small class="help-block"><?php echo app('translator')->getFromJson('Instagram password'); ?></small>
                                </div>

                                <?php if(config('pilot.CUSTOM_PROXY')): ?>
                                <div class="form-group">
                                    <label class="form-label"><?php echo app('translator')->getFromJson('Proxy'); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fe fe-lock"></i>
                                            </span>
                                        </span>
                                        <input type="text" name="proxy" class="form-control" placeholder="<?php echo app('translator')->getFromJson('https://login:password@host:port'); ?>" autocomplete="off">
                                    </div>
                                    <small class="help-block"><?php echo app('translator')->getFromJson('Set your proxy (optional)'); ?></small>
                                </div>
                                <?php endif; ?>

                            </div>
                            <div class="card-footer">
                                <div class="d-flex">
                                    <a href="<?php echo e(route('account.index')); ?>" class="btn btn-secondary"><?php echo app('translator')->getFromJson('Cancel'); ?></a>
                                    <button class="btn btn-success btn-account-submit ml-auto"><?php echo app('translator')->getFromJson('Add account'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-status card-status-left bg-red"></div>
                    <div class="card-header">
                        <h3 class="card-title"><?php echo app('translator')->getFromJson('Attention!'); ?></h3>
                    </div>
                    <div class="card-body">
                        <ol>
                            <li><?php echo app('translator')->getFromJson('My account is at least 14 days old'); ?></li>
                            <li><?php echo app('translator')->getFromJson('I have access to the email address and phone number associated with the account'); ?></li>
                            <li><?php echo app('translator')->getFromJson('I don\'t use third-party tools for this account'); ?></li>
                            <li><?php echo app('translator')->getFromJson('My account is linked to my Facebook account'); ?></li>
                            <li><?php echo app('translator')->getFromJson('Make sure that the content of your account does not violate the rules of work in Instagram'); ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/autodimes/resources/views/account/create.blade.php ENDPATH**/ ?>