<?php $__env->startSection('title', __('Accounts')); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1 class="page-title">
            <?php echo app('translator')->getFromJson('Accounts'); ?>
        </h1>
        <div class="page-options">
            <form method="get" action="<?php echo e(route('account.index')); ?>" autocomplete="off" class="d-flex">
                <select name="sort" class="form-control w-auto">
                    <option value="desc" <?php echo e((Request::get('sort') == 'desc' ? 'selected' : '')); ?>><?php echo app('translator')->getFromJson('Newest first'); ?></option>
                    <option value="asc" <?php echo e((Request::get('sort') == 'asc' ? 'selected' : '')); ?>><?php echo app('translator')->getFromJson('Oldest first'); ?></option>
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
            <h3 class="card-title"><?php echo app('translator')->getFromJson('Accounts'); ?></h3>
            <div class="card-options">
                <a href="<?php echo e(route('account.create')); ?>" class="btn btn-success">
                    <i class="fe fe-plus"></i> <?php echo app('translator')->getFromJson('Add account'); ?>
                </a>
            </div>
        </div>

        <?php if($data->count() > 0): ?>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap" id="accounts">
                <thead>
                    <tr>
                        <th class="w-1"></th>
                        <th><?php echo app('translator')->getFromJson('Account'); ?></th>
                        <th><?php echo app('translator')->getFromJson('Statistic'); ?></th>
                        <th><?php echo app('translator')->getFromJson('Messages'); ?></th>
                        <th class="text-right"><?php echo app('translator')->getFromJson('Action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <td>
                            <div class="tag">
                                <span class="followers" title="<?php echo app('translator')->getFromJson('Last sync:'); ?> <?php echo e(optional($account->followers_sync_at)->diffForHumans() ?? __('Not synchronized')); ?>"><?php echo e($account->followers_count); ?></span>
                                <span class="tag-addon tag-green"><?php echo app('translator')->getFromJson('Followers'); ?></span>
                                <a href="<?php echo e(route('account.export', [$account, 'followers'])); ?>" class="tag-addon tag-green" title="<?php echo app('translator')->getFromJson('Export list'); ?>"><i class="fe fe-download"></i></a>
                            </div>
                            <div class="tag ml-1">
                                <span class="following" title="<?php echo app('translator')->getFromJson('Last sync:'); ?> <?php echo e(optional($account->following_sync_at)->diffForHumans() ?? __('Not synchronized')); ?>"><?php echo e($account->following_count); ?></span>
                                <span class="tag-addon tag-blue"><?php echo app('translator')->getFromJson('Following'); ?></span>
                                <a href="<?php echo e(route('account.export', [$account, 'following'])); ?>" class="tag-addon tag-blue" title="<?php echo app('translator')->getFromJson('Export list'); ?>"><i class="fe fe-download"></i></a>
                            </div>
                            <div class="tag ml-1">
                                <span class="posts"><?php echo e($account->posts_count); ?></span> <span class="tag-addon tag-red"><?php echo app('translator')->getFromJson('Posts'); ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="tag">
                                <span><?php echo e($account->messages_on_queue_count); ?></span> <span class="tag-addon tag-blue"><?php echo app('translator')->getFromJson('On queue'); ?></span>
                            </div>
                            <div class="tag ml-1">
                                <span><?php echo e($account->messages_sent_count); ?></span> <span class="tag-addon tag-green"><?php echo app('translator')->getFromJson('Sent'); ?></span>
                            </div>
                            <div class="tag ml-1">
                                <span><?php echo e($account->messages_failed_count); ?></span> <span class="tag-addon tag-red"><?php echo app('translator')->getFromJson('Failed'); ?></span>
                            </div>
                        </td>
                        <td class="text-right">
                            <form method="post" action="<?php echo e(route('account.destroy', $account)); ?>" onsubmit="return confirm('<?php echo app('translator')->getFromJson('Confirm delete?'); ?>');">
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
            <i class="fe fe-alert-triangle mr-2"></i> <?php echo app('translator')->getFromJson('No accounts found'); ?>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/autodimes/resources/views/account/index.blade.php ENDPATH**/ ?>