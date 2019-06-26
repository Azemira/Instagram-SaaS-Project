<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
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
						
						<a class="navbar-brand logo_h" style="    text-transform: uppercase;color: #fff;" href="<?php echo e(url('/')); ?>"><?php echo e(__(config('app.name'))); ?></a>

						
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
        <section class="home_banner_area" id="home" style="height:870px">
            <div class="banner_inner">
				<div class="container">
					<div class="row banner_content">
						<div class="col-lg-8" >
							<h2><?php echo app('translator')->getFromJson('Oops! Nothing was found'); ?></h2>
							<p> "The page you are looking for might have been removed had its name changed or is temporarily unavailable."
                                    <a href="/">Return to homepage</a></p>
							
						
							
								
							
						</div>
					</div>
				</div>
            </div>
        </section>

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
                                
                            </button>
                            <div class="dropdown-menu">
                                
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
</html><?php /**PATH /var/www/html/autodimes/resources/views/errors/404.blade.php ENDPATH**/ ?>