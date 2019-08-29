<?php $__env->startSection('title', __('Users lists')); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1 class="page-title">
            <?php echo app('translator')->getFromJson('Users lists'); ?>
        </h1>
        <div class="page-options">
            <form method="get" action="<?php echo e(route('list.index', $type)); ?>" autocomplete="off" class="d-flex">
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
            <h3 class="card-title"><?php echo app('translator')->getFromJson('Users lists'); ?></h3>
            <div class="card-options">
                <a href="<?php echo e(route('list.create', $type)); ?>" class="btn btn-success">
                    <i class="fe fe-plus"></i> <?php echo app('translator')->getFromJson('Create new list'); ?>
                </a>
            </div>
        </div>

        <?php if($data->count() > 0): ?>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap" id="accounts">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->getFromJson('List name'); ?></th>
                        <th><?php echo app('translator')->getFromJson('Users count'); ?></th>
                        <th class="text-right"><?php echo app('translator')->getFromJson('Action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <a href="<?php echo e(route('list.edit', [$type, $item])); ?>"><?php echo e($item->name); ?></a>
                            <div class="small text-muted">
                                <?php echo app('translator')->getFromJson('Added: :time', ['time' => $item->created_at->format('M j, Y')]); ?>
                            </div>
                        </td>
                        <td>
                            <span class="tag"><?php echo e($item->items_count); ?></span>
                        </td>
                        <td class="text-right">
                            <form method="post" action="<?php echo e(route('list.destroy', [$type, $item])); ?>" onsubmit="return confirm('<?php echo app('translator')->getFromJson('Confirm delete?'); ?>');">
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
            <i class="fe fe-alert-triangle mr-2"></i> <?php echo app('translator')->getFromJson('No users found'); ?>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/autodimes/resources/views/lists/users/index.blade.php ENDPATH**/ ?>