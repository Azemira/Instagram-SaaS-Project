<?php if(config('recaptcha.api_site_key') && config('recaptcha.api_secret_key')): ?>
    <?php $__env->startPush('head'); ?>
        <?php echo htmlScriptTagJsApi(); ?>

    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-6">
                <img src="<?php echo e(asset('assets/img/logo.svg')); ?>" class="h-6" alt="">
            </div>

            <form class="card" action="<?php echo e(route('register')); ?>" method="post">
                <?php echo csrf_field(); ?>

                <div class="card-body p-6">
                    <div class="card-title"><?php echo app('translator')->getFromJson('Create new account'); ?></div>
                    <div class="form-group">
                        <label for="name" class="form-label"><?php echo app('translator')->getFromJson('Name'); ?></label>
                        <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" placeholder="<?php echo app('translator')->getFromJson('Enter name'); ?>" required autofocus>
                        <?php if($errors->has('name')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('name')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label"><?php echo app('translator')->getFromJson('Email address'); ?></label>
                        <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo app('translator')->getFromJson('Enter email'); ?>" required>
                        <?php if($errors->has('email')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label"><?php echo app('translator')->getFromJson('Password'); ?></label>
                        <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" placeholder="<?php echo app('translator')->getFromJson('Password'); ?>" required>
                        <?php if($errors->has('password')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label"><?php echo app('translator')->getFromJson('Confirm password'); ?></label>
                        <input id="password_confirmation" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password_confirmation" placeholder="<?php echo app('translator')->getFromJson('Confirm password'); ?>" required>
                    </div>
                    <?php if(config('recaptcha.api_site_key') && config('recaptcha.api_secret_key')): ?>
                    <div class="form-group">
                        <?php echo htmlFormSnippet(); ?>

                        <?php if($errors->has('g-recaptcha-response')): ?>
                            <div class="text-red mt-1">
                                <small><strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong></small>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block"><?php echo app('translator')->getFromJson('Create new account'); ?></button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted">
                <?php echo app('translator')->getFromJson('Already have account?'); ?> <a href="<?php echo e(route('login')); ?>"><?php echo app('translator')->getFromJson('Sign in'); ?></a>

                <div class="mt-5">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e($active_language['native']); ?>

                        </button>
                        <div class="dropdown-menu">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('localize', $code)); ?>" rel="alternate" hreflang="<?php echo e($code); ?>" class="dropdown-item"><?php echo e($language['native']); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/autodimes/resources/views/skins/default/auth/register.blade.php ENDPATH**/ ?>