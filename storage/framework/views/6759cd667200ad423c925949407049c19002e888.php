<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-6">
                <img src="<?php echo e(asset('assets/img/logo.svg')); ?>" class="h-6" alt="">
            </div>
            <form class="card" action="<?php echo e(route('login')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="card-body p-6">
                    <div class="card-title"><?php echo app('translator')->getFromJson('Login to your account'); ?></div>
                    <div class="form-group">
                        <label for="email" class="form-label"><?php echo app('translator')->getFromJson('E-Mail Address'); ?></label>
                        <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo app('translator')->getFromJson('Enter email'); ?>" required autofocus>
                        <?php if($errors->has('email')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <?php echo app('translator')->getFromJson('Password'); ?>
                            <a href="<?php echo e(route('password.request')); ?>" class="float-right small"><?php echo app('translator')->getFromJson('I forgot password'); ?></a>
                        </label>
                        <input type="password" name="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" id="password" placeholder="Password">
                        <?php if($errors->has('password')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" <?php echo e(old( 'remember') ? 'checked' : ''); ?>>
                            <span class="custom-control-label"><?php echo app('translator')->getFromJson('Remember me'); ?></span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block"><?php echo app('translator')->getFromJson('Sign in'); ?></button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted">
                <?php echo app('translator')->getFromJson('Don\'t have account yet?'); ?> <a href="<?php echo e(route('register')); ?>"><?php echo app('translator')->getFromJson('Sign up'); ?></a>

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

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/autodimes/resources/views/skins/default/auth/login.blade.php ENDPATH**/ ?>