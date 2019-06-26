<?php $__env->startSection('title', __('Autopilot')); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1 class="page-title">
            <?php echo app('translator')->getFromJson('Autopilot'); ?>
        </h1>
        <div class="page-options">
            <form method="get" action="<?php echo e(route('autopilot.index')); ?>" autocomplete="off" class="d-flex">
                <select name="account" class="form-control w-auto">
                    <option value=""><?php echo app('translator')->getFromJson('All accounts'); ?></option>
                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($account->id); ?>" <?php echo e((Request::get('account') == $account->id ? 'selected' : '')); ?>><?php echo e($account->username); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <select name="action" class="form-control w-auto ml-2">
                    <option value=""><?php echo app('translator')->getFromJson('Activity'); ?></option>
                    <option value="1" <?php echo e((Request::get('action') == '1' ? 'selected' : '')); ?>><?php echo app('translator')->getFromJson('New Followers'); ?></option>
                    <option value="2" <?php echo e((Request::get('action') == '2' ? 'selected' : '')); ?>><?php echo app('translator')->getFromJson('Unfollowers'); ?></option>
                    <option value="3" <?php echo e((Request::get('action') == '3' ? 'selected' : '')); ?>><?php echo app('translator')->getFromJson('New Following'); ?></option>
                    <option value="4" <?php echo e((Request::get('action') == '4' ? 'selected' : '')); ?>><?php echo app('translator')->getFromJson('Unfollowing'); ?></option>
                </select>
                <div class="input-icon ml-2">
                    <span class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </span>

                    <div class="input-group">
                        <div class="input-icon ml-2">
                            <span class="input-icon-addon">
                                <i class="fe fe-search"></i>
                            </span>
                            <input type="text" name="search" value="<?php echo e(Request::get('search')); ?>" class="form-control" placeholder="<?php echo app('translator')->getFromJson('Search'); ?>">
                        </div>

                        <span class="input-group-btn ml-2">
                            <button class="btn btn-primary" type="submit">
                                <i class="fe fe-filter"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo app('translator')->getFromJson('Autopilot'); ?></h3>
            <div class="card-options">
                <a href="<?php echo e(route('autopilot.create')); ?>" class="btn btn-success">
                    <i class="fe fe-plus"></i> <?php echo app('translator')->getFromJson('Add autopilot'); ?>
                </a>
            </div>
        </div>

        <?php if($data->count() > 0): ?>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->getFromJson('Name'); ?></th>
                        <th><?php echo app('translator')->getFromJson('Account'); ?></th>
                        <th><?php echo app('translator')->getFromJson('Period'); ?></th>
                        <th><?php echo app('translator')->getFromJson('Activity'); ?></th>
                        <th class="text-right"><?php echo app('translator')->getFromJson('Action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autopilot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <a href="<?php echo e(route('autopilot.edit', $autopilot)); ?>"><?php echo e($autopilot->name); ?></a>
                            <div class="small text-muted">
                                <?php echo app('translator')->getFromJson('Added: :time', ['time' => $autopilot->created_at->format('M j, Y')]); ?>
                            </div>
                        </td>
                        <td>
                            <span class="tag tag-blue"><?php echo e($autopilot->account->username); ?></span>
                        </td>
                        <td>
                            <?php if($autopilot->starts_at || $autopilot->ends_at): ?>
                                <span class="tag"><?php echo e(optional($autopilot->starts_at)->format('H:i, d M Y') ?? __('Now')); ?></span>
                                &ndash;
                                <span class="tag"><?php echo e(optional($autopilot->ends_at)->format('H:i, d M Y') ?? __('Forever')); ?></span>
                            <?php else: ?>
                                <span class="tag"><?php echo app('translator')->getFromJson('Forever'); ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e(__('pilot.autopilot_action_' . $autopilot->action)); ?></td>
                        <td class="text-right">
                            <form method="post" action="<?php echo e(route('autopilot.destroy', $autopilot)); ?>" onsubmit="return confirm('<?php echo app('translator')->getFromJson('Confirm delete?'); ?>');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-secondary btn-clean">
                                    <i class="fe fe-trash"></i> <?php echo app('translator')->getFromJson('Delete'); ?>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

    <?php echo e($data->appends( Request::all() )->links()); ?>


    <?php if($data->count() == 0): ?>
        <div class="alert alert-primary text-center">
            <i class="fe fe-alert-triangle mr-2"></i> <?php echo app('translator')->getFromJson('No autopilot found'); ?>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/autodimes/resources/views/autopilot/index.blade.php ENDPATH**/ ?>