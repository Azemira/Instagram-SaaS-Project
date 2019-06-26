<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Verify Your Email Address')); ?></div>
               
                <div class="card-body">
                   <?php if(!\Auth::user()->hasVerifiedEmail()): ?>
                    <?php if(session('resent')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(__('A fresh verification link has been sent to your email address.')); ?>

                        </div>
                    <?php endif; ?>

                    <?php echo e(__('Before proceeding, please check your email for a verification link.')); ?>

                    <?php echo e(__('If you did not receive the email')); ?>, <a href="<?php echo e(route('verification.resend')); ?>"><?php echo e(__('click here to request another')); ?></a>.
                   <?php else: ?>
                   <?php echo e(__('Your email has been verified.')); ?>

                   <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /var/www/html/autodimes/resources/views/auth/verify.blade.php ENDPATH**/ ?>