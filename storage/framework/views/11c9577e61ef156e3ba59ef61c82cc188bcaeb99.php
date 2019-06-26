<?php $__env->startSection('content'); ?>

    <?php echo $__env->renderWhen($accounts->count() == 0, 'partials.no-accounts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <div class="card">
        <img src="<?php echo e(asset('assets/img/card-header.png')); ?>" class="card-img-top">
        <?php if(session('status')): ?>
        <div class="card-body">
            <div class="alert alert-success" role="alert">
                <?php echo e(session('status')); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                        <i class="fe fe-play"></i>
                    </span>
                    <div>
                        <h4 class="m-0"><a href="<?php echo e(route('autopilot.index')); ?>"><?php echo e($autopilots_count); ?> <small><?php echo app('translator')->getFromJson('Autopilot'); ?></small></a></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                      <i class="fe fe-shopping-cart"></i>
                    </span>
                    <div>
                        <h4 class="m-0"><a href="<?php echo e(route('account.index')); ?>"><?php echo e($accounts_count); ?> <small><?php echo app('translator')->getFromJson('Accounts'); ?></small></a></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                        <i class="fe fe-message-square"></i>
                    </span>
                    <div>
                        <h4 class="m-0"><a href="<?php echo e(route('list.index', 'messages')); ?>"><?php echo e($messages_list_count); ?> <small><?php echo app('translator')->getFromJson('Messages lists'); ?></small></a></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-yellow mr-3">
                      <i class="fe fe-users"></i>
                    </span>
                    <div>
                        <h4 class="m-0"><a href="<?php echo e(route('list.index', 'users')); ?>"><?php echo e($users_list_count); ?> <small><?php echo app('translator')->getFromJson('Users lists'); ?></small></a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="<?php echo e(route('log.clear')); ?>" onsubmit="return confirm('<?php echo app('translator')->getFromJson('Are you sure?'); ?>');">
        <?php echo csrf_field(); ?>
        <div class="row">
           <div class="col-sm-4">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right">
                            <button name="status" value="<?php echo e(config('pilot.JOB_STATUS_ON_QUEUE')); ?>" class="btn btn-sm btn-secondary">
                                <i class="fe fe-x"></i> <?php echo app('translator')->getFromJson('Clear queue'); ?>
                            </button>
                        </div>
                        <div class="h1 m-0"><?php echo e($messages['on_queue']['total']); ?></div>
                        <div class="text-muted mb-4"><?php echo app('translator')->getFromJson('Messages on queue'); ?></div>
                        <div class="progress progress-sm">
                           <div class="progress-bar bg-green" style="width: <?php echo e($messages['on_queue']['percentage']); ?>%"></div>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-sm-4">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right">
                            <button name="status" value="<?php echo e(config('pilot.JOB_STATUS_SUCCESS')); ?>" class="btn btn-sm btn-secondary">
                                <i class="fe fe-x"></i> <?php echo app('translator')->getFromJson('Clear log'); ?>
                            </button>
                        </div>
                        <div class="h1 m-0"><?php echo e($messages['sent']['total']); ?></div>
                        <div class="text-muted mb-4"><?php echo app('translator')->getFromJson('Sent messages'); ?></div>
                        <div class="progress progress-sm">
                           <div class="progress-bar bg-blue" style="width: <?php echo e($messages['sent']['percentage']); ?>%"></div>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-sm-4">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right">
                            <button name="status" value="<?php echo e(config('pilot.JOB_STATUS_FAILED')); ?>" class="btn btn-sm btn-secondary">
                                <i class="fe fe-x"></i> <?php echo app('translator')->getFromJson('Clear log'); ?>
                            </button>
                        </div>
                        <div class="h1 m-0"><?php echo e($messages['failed']['total']); ?></div>
                        <div class="text-muted mb-4"><?php echo app('translator')->getFromJson('Failed to sent messages'); ?></div>
                        <div class="progress progress-sm">
                           <div class="progress-bar bg-red" style="width: <?php echo e($messages['failed']['percentage']); ?>%"></div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </form>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php echo app('translator')->getFromJson('Notifications'); ?></h3>
                    <div class="card-options">
                        <a href="<?php echo e(route('notifications')); ?>" class="btn btn-sm btn-primary"><?php echo app('translator')->getFromJson('View all'); ?></a>
                    </div>
                </div>

                <?php if($notifications->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="accounts">
                        <tbody>
                            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo __('pilot.notification_' . $notification->data['action'], $notification->data); ?>

                                    <div class="small text-muted"><?php echo e($notification->created_at->diffForHumans()); ?></div>
                                </td>
                                <td class="text-right">
                                    <?php if($notification->read_at == null): ?>
                                    <span class="badge badge-success"><?php echo app('translator')->getFromJson('NEW'); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php echo app('translator')->getFromJson('Accounts'); ?></h3>
                    <div class="card-options">
                        <a href="<?php echo e(route('account.index')); ?>" class="btn btn-sm btn-primary"><?php echo app('translator')->getFromJson('View all'); ?></a>
                    </div>
                </div>

                <?php if($accounts->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="accounts">
                        <tbody>
                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-username="<?php echo e($account->username); ?>">
                                <td class="text-center" width="68">
                                    <div class="avatar d-block"></div>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('account.edit', $account)); ?>"><?php echo e($account->username); ?></a>
                                    <div class="small text-muted">
                                        <?php echo app('translator')->getFromJson('Added: :time', ['time' => $account->created_at->format('M j, Y')]); ?>
                                    </div>
                                </td>
                                <td align="right">
                                    <div class="tag" title="<?php echo app('translator')->getFromJson('Last sync:'); ?> <?php echo e(optional($account->followers_sync_at)->diffForHumans() ?? __('Not synchronized')); ?>">
                                        <span class="followers"><?php echo e($account->followers_count); ?></span> <span class="tag-addon tag-green"><i class="fe fe-users"></i></span>
                                    </div>
                                    <div class="tag ml-1" title="<?php echo app('translator')->getFromJson('Last sync:'); ?> <?php echo e(optional($account->following_sync_at)->diffForHumans() ?? __('Not synchronized')); ?>">
                                        <span class="following"><?php echo e($account->following_count); ?></span> <span class="tag-addon tag-blue"><i class="fe fe-user-plus"></i></span>
                                    </div>
                                    <div class="tag ml-1">
                                        <span class="posts"><?php echo e($account->posts_count); ?></span> <span class="tag-addon tag-red"><i class="fe fe-image"></i></span>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/autodimes/resources/views/dashboard.blade.php ENDPATH**/ ?>