<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="<?php echo e(app()->getLocale()); ?>" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>" />
    <title><?php echo $__env->yieldContent('title', config('app.name')); ?></title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <link rel="stylesheet" href="<?php echo e(mix('assets/css/dm.bundle.css')); ?>">
    <?php echo $__env->yieldPushContent('head'); ?>
    <script type="text/javascript">
        var BASE_URL = '<?php echo e(url('/')); ?>';
    </script>
</head>

<body>
    <div class="page">
        <div class="page-main">
            <div class="header py-4">
                <div class="container">
                    <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
                <div class="container">
                    <?php echo $__env->make('partials.top-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <div class="my-3 my-md-5">
                <div class="container">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="list-unstyled mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <i class="fe fe-check mr-2"></i> <?php echo session('success'); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="alert alert-danger">
                            <i class="fe fe-alert-triangle mr-2"></i> <?php echo session('error'); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(!\Auth::user()->hasVerifiedEmail()): ?>
                     
                    <?php echo $__env->make('auth.verify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                    <?php echo $__env->yieldContent('content'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php echo $__env->make('partials.bottom-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>

    <script src="<?php echo e(mix('assets/js/dm.bundle.js')); ?>" type="text/javascript"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH /var/www/html/autodimes/resources/views/layouts/app.blade.php ENDPATH**/ ?>