<?php $__env->startSection('title', __('Settings')); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1 class="page-title"><?php echo app('translator')->getFromJson('Settings'); ?></h1>
</div>

<div class="row">
    <div class="col-md-9">

        <form role="form" method="post" action="<?php echo e(route('settings.update')); ?>" autocomplete="off">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fe fe-sliders mr-2"></i> <?php echo app('translator')->getFromJson('General settings'); ?></h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Site URL'); ?></label>
                                <input type="text" name="settings[APP_URL]" value="<?php echo e(config('app.url')); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Site name'); ?></label>
                                <input type="text" name="settings[APP_NAME]" value="<?php echo e(config('app.name')); ?>" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php echo app('translator')->getFromJson('Description'); ?></label>
                        <textarea name="settings[SITE_DESCRIPTION]" rows="2" class="form-control"><?php echo e(config('pilot.SITE_DESCRIPTION')); ?></textarea>
                        <small class="help-block"><?php echo app('translator')->getFromJson('Recommended length of the description is 150-160 characters'); ?></small>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php echo app('translator')->getFromJson('Keywords'); ?></label>
                        <textarea name="settings[SITE_KEYWORDS]" rows="3" class="form-control"><?php echo e(config('pilot.SITE_KEYWORDS')); ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Landing page skin'); ?></label>
                                <select name="settings[SITE_SKIN]" class="form-control">
                                    <?php $__currentLoopData = $skins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($skin); ?>" <?php echo e($skin == config('pilot.SITE_SKIN') ? 'selected' : ''); ?>><?php echo e($skin); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Trial days'); ?></label>
                                <input type="text" name="settings[TRIAL_DAYS]" value="<?php echo e(config('pilot.TRIAL_DAYS')); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Schedule type'); ?></label>
                                <select name="settings[SCHEDULE_TYPE]" class="form-control">
                                    <option value="cron" <?php echo e('cron' == config('pilot.SCHEDULE_TYPE') ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('Cron job'); ?></option>
                                    <option value="supervisor" <?php echo e('supervisor' == config('pilot.SCHEDULE_TYPE') ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('Supervisor'); ?></option>
                                </select>
                                <small class="help-block"><?php echo app('translator')->getFromJson('If your hosting does not allow you to install Supervisor, tasks can be performed by regular cron job.'); ?></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="custom-switch">
                                    <input type="checkbox" name="settings[SYSTEM_PROXY]" value="1" class="custom-switch-input" <?php echo e(config('pilot.SYSTEM_PROXY') ? 'checked' : ''); ?>>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description"><?php echo app('translator')->getFromJson('Enable system proxy'); ?></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <small class="help-block"><?php echo app('translator')->getFromJson('If you enable this option, system will try use most appropriate proxy from your proxy list while new account is being added.'); ?></small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="custom-switch">
                                    <input type="checkbox" name="settings[CUSTOM_PROXY]" value="1" class="custom-switch-input" <?php echo e(config('pilot.CUSTOM_PROXY') ? 'checked' : ''); ?>>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description"><?php echo app('translator')->getFromJson('Users can add their own proxy address'); ?></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <small class="help-block"><?php echo app('translator')->getFromJson('Allow users to use their own proxy address.'); ?></small>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fe fe-save mr-2"></i> <?php echo app('translator')->getFromJson('Save settings'); ?>
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fe fe-volume-2 mr-2"></i> <?php echo app('translator')->getFromJson('Localization'); ?></h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Default language'); ?></label>
                                <select name="settings[APP_LOCALE]" class="form-control">
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($code); ?>" <?php echo e($code == config('app.locale') ? 'selected' : ''); ?>><?php echo e($language['native']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Currency symbol'); ?></label>
                                <input type="text" name="settings[CURRENCY_SYMBOL]" value="<?php echo e(config('pilot.CURRENCY_SYMBOL')); ?>" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Timezone'); ?></label>
                                <select name="settings[APP_TIMEZONE]" class="form-control">
                                    <?php $__currentLoopData = $time_zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($zone); ?>" <?php echo e($zone == config('app.timezone') ? 'selected' : ''); ?>><?php echo e($zone); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Currency'); ?></label>
                                <select name="settings[CURRENCY_CODE]" class="form-control">
                                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($code); ?>" <?php echo e($code == config('pilot.CURRENCY_CODE') ? 'selected' : ''); ?>><?php echo e($title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Tax percentage'); ?></label>
                                <input type="number" min="0" max="100" step="0.01" name="settings[TAX_PERCENTAGE]" value="<?php echo e(config('pilot.TAX_PERCENTAGE')); ?>" class="form-control">
                                <small class="help-block"><?php echo app('translator')->getFromJson('Numeric value between 0 and 100, with no more than 2 decimal places.'); ?></small>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fe fe-save mr-2"></i> <?php echo app('translator')->getFromJson('Save settings'); ?>
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fe fe-mail mr-2"></i> <?php echo app('translator')->getFromJson('E-mail Settings'); ?></h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('SMTP Host'); ?></label>
                                <input type="text" name="settings[MAIL_HOST]" value="<?php echo e(config('mail.host')); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('SMTP Port'); ?></label>
                                <input type="text" name="settings[MAIL_PORT]" value="<?php echo e(config('mail.port')); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('SMTP Username'); ?></label>
                                <input type="text" name="settings[MAIL_USERNAME]" value="<?php echo e(config('mail.username')); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('SMTP Password'); ?></label>
                                <input type="text" name="settings[MAIL_PASSWORD]" value="<?php echo e(config('mail.password')); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('SMTP Encryption'); ?></label>
                                <select name="settings[MAIL_ENCRYPTION]" class="form-control">
                                    <option value="" <?php echo e(null == config('mail.encryption') ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('No encryption'); ?></option>
                                    <option value="tls" <?php echo e('tls' == config('mail.encryption') ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('TLS'); ?></option>
                                    <option value="ssl" <?php echo e('ssl' == config('mail.encryption') ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('SSL'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('From address'); ?></label>
                                <input type="text" name="settings[MAIL_FROM_ADDRESS]" value="<?php echo e(config('mail.from.address')); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('From name'); ?></label>
                                <input type="text" name="settings[MAIL_FROM_NAME]" value="<?php echo e(config('mail.from.name')); ?>" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fe fe-save mr-2"></i> <?php echo app('translator')->getFromJson('Save settings'); ?>
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fe fe-code mr-2"></i> <?php echo app('translator')->getFromJson('Integrations'); ?></h3>
                </div>
                <div class="card-body">

                    <h5><?php echo app('translator')->getFromJson('Google Analytics'); ?></h5>

                    <div class="form-group">
                        <label class="form-label"><?php echo app('translator')->getFromJson('Property ID'); ?></label>
                        <input type="text" name="settings[GOOGLE_ANALYTICS]" value="<?php echo e(config('pilot.GOOGLE_ANALYTICS')); ?>" class="form-control" placeholder="UA-XXXXX-Y">
                        <small class="help-block"><?php echo app('translator')->getFromJson('Leave this field empty if you don\'t want to enable Google Analytics'); ?></small>
                    </div>

                    <hr>

                    <h5><?php echo app('translator')->getFromJson('Google reCaptcha'); ?></h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Site key'); ?></label>
                                <input type="text" name="settings[RECAPTCHA_SITE_KEY]" value="<?php echo e(config('recaptcha.api_site_key')); ?>" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Secret key'); ?></label>
                                <input type="text" name="settings[RECAPTCHA_SECRET_KEY]" value="<?php echo e(config('recaptcha.api_secret_key')); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo app('translator')->getFromJson('To protect your registration form, you can use Google reCaptcha service.'); ?></p>
                            <ul>
                                <li><?php echo app('translator')->getFromJson('Get your free credentials from <a href=":link" target="_blank">:link</a>', ['link' => 'https://www.google.com/recaptcha/admin']); ?></li>
                                <li><?php echo app('translator')->getFromJson('Select "reCAPTCHA v2" as a site key type.'); ?></li>
                                <li><?php echo app('translator')->getFromJson('Copy & paste the site and secret keys'); ?></li>
                            </ul>
                        </div>
                    </div>

                    <hr>

                    <h5><?php echo app('translator')->getFromJson('Stripe'); ?></h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Publishable key'); ?></label>
                                <input type="text" name="settings[STRIPE_KEY]" value="<?php echo e(config('services.stripe.key')); ?>" class="form-control" placeholder="pk_XXX">
                            </div>

                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Secret key'); ?></label>
                                <input type="text" name="settings[STRIPE_SECRET]" value="<?php echo e(config('services.stripe.secret')); ?>" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->getFromJson('Webhook signing secret'); ?></label>
                                <input type="text" name="settings[STRIPE_WEBHOOK_SECRET]" value="<?php echo e(config('services.stripe.webhook.secret')); ?>" class="form-control" placeholder="whsec_XXX">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo app('translator')->getFromJson('To get your recurring payments works, system have to receive hooks from the Stripe.'); ?></p>
                            <ul>
                                <li><?php echo app('translator')->getFromJson('Go to webhook settings at Stripe <a href=":link" target="_blank">account dashboard</a>', ['link' => 'https://dashboard.stripe.com/account/webhooks']); ?></li>
                                <li><?php echo app('translator')->getFromJson('Click the "+ Add endpoint" button at "Developers" &rarr; "Endpoints" section.'); ?></li>
                                <li><?php echo app('translator')->getFromJson('Include the following address to the "URL to be called" section: <a href=":link" target="_blank">:link</a>', ['link' => route('stripe.webhook')]); ?></li>
                                <li><?php echo app('translator')->getFromJson('Select all events as a value of "Filter event"'); ?></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fe fe-save mr-2"></i> <?php echo app('translator')->getFromJson('Save settings'); ?>
                    </button>
                </div>
            </div>

        </form>

    </div>
    <div class="col-md-3">
        <?php echo $__env->make('partials.settings-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/autodimes/resources/views/settings/index.blade.php ENDPATH**/ ?>