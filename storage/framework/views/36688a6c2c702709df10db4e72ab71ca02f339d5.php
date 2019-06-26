<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <?php echo $__env->renderWhen(config('pilot.GOOGLE_ANALYTICS'), 'partials.google-analytics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="<?php echo e(asset('skins/default/img/favicon.png')); ?>" type="image/png">
        <title><?php echo e(__(config('app.name'))); ?> &mdash; <?php echo e(__(config('pilot.SITE_DESCRIPTION'))); ?></title>
        <meta name="description" content="<?php echo e(config('pilot.SITE_DESCRIPTION')); ?>">
        <meta name="keywords" content="<?php echo e(config('pilot.SITE_KEYWORDS')); ?>">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('skins/default/css/bootstrap.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('skins/default/css/font-awesome.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('skins/default/vendors/owl-carousel/owl.carousel.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('skins/default/vendors/animate-css/animate.css')); ?>">
        <!-- main css -->
        <link rel="stylesheet" href="<?php echo e(asset('skins/default/css/style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('skins/default/css/responsive.css')); ?>">
    </head>
    <body data-spy="scroll" data-target="#mainNav" data-offset="70">

        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="main_menu" id="mainNav">
            	<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('skins/default/img/logo.png')); ?>" alt=""></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<ul class="nav navbar-nav menu_nav ml-auto">
								<li class="nav-item active"><a class="nav-link" href="#home"><?php echo app('translator')->getFromJson('Home'); ?></a></li>
								<li class="nav-item"><a class="nav-link" href="#feature"><?php echo app('translator')->getFromJson('Features'); ?></a></li>
								<li class="nav-item"><a class="nav-link" href="#price"><?php echo app('translator')->getFromJson('Pricing'); ?></a></li>
								<?php if(auth()->guard()->check()): ?>
								    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('dashboard')); ?>"><strong><?php echo e($user->name); ?></strong></a></li>
                                <?php else: ?>
                                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo app('translator')->getFromJson('Login'); ?></a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo app('translator')->getFromJson('Register'); ?></a></li>
                                <?php endif; ?>
							</ul>
						</div>
					</div>
            	</nav>
            </div>
        </header>
        <!--================Header Menu Area =================-->

        <!--================Home Banner Area =================-->
        <section class="home_banner_area" id="home">
            <div class="banner_inner">
				<div class="container">
					<div class="row banner_content">
						<div class="col-lg-8">
							<h2><?php echo app('translator')->getFromJson('Most wanted automation tool for Instagram Direct Message.'); ?></h2>
							<p><?php echo app('translator')->getFromJson('Greet with warm welcome message your new followers by sending customized text message. Create your own list of users and send them text message with emoji, post, hashtag, video or photo.'); ?></p>
							<a class="banner_btn" href="<?php echo e(route('billing.index')); ?>"><?php echo app('translator')->getFromJson('Try now'); ?></a>
						</div>
						<div class="col-lg-4">
							<div class="banner_map_img">
								<img class="img-fluid" src="<?php echo e(asset('skins/default/img/dm-landing.png')); ?>" alt="">
							</div>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->

        <!--================Feature Area =================-->
        <section class="feature_area p_120" id="feature">
        	<div class="container">

                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <i class="fe fe-check mr-2"></i> <?php echo session('success'); ?>

                    </div>
                <?php endif; ?>

        		<div class="main_title">
        			<h2><?php echo app('translator')->getFromJson('Unique Features'); ?></h2>
        			<p><?php echo app('translator')->getFromJson('Features you will definently love.'); ?></p>
        		</div>
        		<div class="feature_inner row">
        			<div class="col-lg-3 col-md-6">
        				<div class="feature_item text-center">
        					<img src="<?php echo e(asset('skins/default/img/icon/f-icon-1.png')); ?>" alt="">
        					<h4><?php echo app('translator')->getFromJson('Welcome new followers'); ?></h4>
        					<p><?php echo app('translator')->getFromJson('Greet with warm welcome message your new followers by sending customized text message.'); ?></p>
        				</div>
        			</div>
        			<div class="col-lg-3 col-md-6">
        				<div class="feature_item text-center">
        					<img src="<?php echo e(asset('skins/default/img/icon/f-icon-1.png')); ?>" alt="">
        					<h4><?php echo app('translator')->getFromJson('Keep unfollowers'); ?></h4>
        					<p><?php echo app('translator')->getFromJson('Automatically send promocode or any other catchy message to keep your followers and don\'t let them to unfollow you.'); ?></p>
        				</div>
        			</div>
        			<div class="col-lg-3 col-md-6">
        				<div class="feature_item text-center">
        					<img src="<?php echo e(asset('skins/default/img/icon/f-icon-1.png')); ?>" alt="">
        					<h4><?php echo app('translator')->getFromJson('Message any content to any size of users list'); ?></h4>
        					<p><?php echo app('translator')->getFromJson('Create your own list of users and send them text message with emoji, post, hashtag, video or photo even disappearing.'); ?></p>
        				</div>
        			</div>
        			<div class="col-lg-3 col-md-6">
        				<div class="feature_item text-center">
        					<img src="<?php echo e(asset('skins/default/img/icon/f-icon-1.png')); ?>" alt="">
        					<h4><?php echo app('translator')->getFromJson('Web-Based Direct Messenger'); ?></h4>
        					<p><?php echo app('translator')->getFromJson('Chat without touching your device and chat with your customers directly from the browser.'); ?></p>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Feature Area =================-->

        <!--================Price Area =================-->
        <section class="price_area p_120" id="price">
        	<div class="container">
        		<div class="main_title">
        			<h2><?php echo app('translator')->getFromJson('Pricing table'); ?></h2>
        			<p><?php echo app('translator')->getFromJson('Affordable prices will surprise you!'); ?></p>
        		</div>
        		<div class="price_item_inner row">
                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        			<div class="col-md-6 col-lg-<?php echo e(12 / count($packages)); ?>">
        				<div class="price_item">
        					<div class="price_head">
        						<div class="text-center">
        							<h3><?php echo e($package->title); ?></h3>
        						</div>
        						<div class="text-center">
        							<h2 class="mt-4 mb-4"><?php echo e($currency_symbol); ?><?php echo e($package->wholeprice); ?>.<sup><?php echo e($package->fraction_price); ?></sup></h2>
                                    <h3><span class="badge badge-pill badge-primary"><?php echo e(__(':num days FREE trial', ['num' => config('pilot.TRIAL_DAYS')])); ?></span></h3>
        						</div>
        					</div>
        					<div class="price_body">
        						<p><strong><?php echo e(trans_choice('pilot.package_accounts', $package->accounts_count, ['num' => $package->accounts_count])); ?></strong></p>
        						<ul class="list">
                                    <li><i class="fa fa-check text-success mr-1"></i> <?php echo app('translator')->getFromJson('Web Based Direct Messenger'); ?></li>
                                    <li><i class="fa fa-check text-success mr-1"></i> <?php echo app('translator')->getFromJson('Send Bulk Messages'); ?></li>
                                    <li><i class="fa fa-check text-success mr-1"></i> <?php echo app('translator')->getFromJson('Custom users lists'); ?></li>
                                    <li><i class="fa fa-check text-success mr-1"></i> <?php echo app('translator')->getFromJson('Scheduled Autopilot'); ?></li>
                                    <li><i class="fa fa-check text-success mr-1"></i> <?php echo app('translator')->getFromJson('Pre-defined messages lists'); ?></li>
                                    <li><i class="fa fa-check text-success mr-1"></i> <?php echo app('translator')->getFromJson('Detect Unfollowers'); ?></li>
                                    <li><i class="fa fa-check text-success mr-1"></i> <?php echo app('translator')->getFromJson('Spintax Support'); ?></li>
        						</ul>
                                <br>
                                <small class="text-muted">
                                    <?php echo app('translator')->getFromJson('Prices shown in:'); ?> <?php echo e($currency_code); ?><br>
                                    <?php echo app('translator')->getFromJson('pilot.interval_' . $package->interval); ?>
                                </small>
        					</div>
        					<div class="price_footer">
                                <a class="main_btn2" href="<?php echo e(route('billing.index')); ?>"><?php echo app('translator')->getFromJson('Try now'); ?></a>
        					</div>
        				</div>
        			</div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        		</div>
        	</div>
        </section>
        <!--================End Price Area =================-->

        <!--================ start footer Area  =================-->
        <footer class="footer-area p_30">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="footer-text">
                            Copyright &copy;<?php echo e(date('Y')); ?> &bull; <?php echo e(__(config('app.name'))); ?> &mdash; <?php echo e(__(config('pilot.SITE_DESCRIPTION'))); ?>

                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        </footer>
		<!--================ End footer Area  =================-->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="<?php echo e(asset('skins/default/js/jquery-3.2.1.min.js')); ?>"></script>
        <script src="<?php echo e(asset('skins/default/js/popper.js')); ?>"></script>
        <script src="<?php echo e(asset('skins/default/js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('skins/default/js/stellar.js')); ?>"></script>
        <script src="<?php echo e(asset('skins/default/js/theme.js')); ?>"></script>
    </body>
</html><?php /**PATH /var/www/html/autodimes/resources/views/skins/default/index.blade.php ENDPATH**/ ?>