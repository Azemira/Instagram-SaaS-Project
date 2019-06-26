<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
                <div class="dropup">
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
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                &copy; <?php echo e(date('Y')); ?> <a href="<?php echo e(config('app.url')); ?>" target="_blank"><?php echo e(__(config('app.name'))); ?></a> &mdash; <?php echo e(__(config('pilot.SITE_DESCRIPTION'))); ?>

            </div>
        </div>
    </div>
</footer><?php /**PATH /var/www/html/autodimes/resources/views/partials/footer.blade.php ENDPATH**/ ?>