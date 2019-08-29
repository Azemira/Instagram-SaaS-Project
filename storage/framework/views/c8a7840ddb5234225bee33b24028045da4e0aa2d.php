<?php $__env->startSection('title', __('Direct Messenger')); ?>

<?php $__env->startSection('content'); ?>

	<?php echo $__env->renderWhen($accounts->count() == 0, 'partials.no-accounts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

	<?php if($accounts->count()): ?>

		<div class="page-header">
	        <h1 class="page-title">
	            <?php echo app('translator')->getFromJson('Direct Messenger'); ?>
	        </h1>
	        <div class="page-options">
	            <select id="account_id" class="form-control">
	                <option value="">&mdash; <?php echo app('translator')->getFromJson('Select account'); ?> &mdash;</option>
	                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                    <option value="<?php echo e($account->id); ?>"><?php echo e($account->username); ?></option>
	                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	            </select>
	        </div>
	    </div>

	    <div class="alert alert-primary text-center alert-no-account" role="alert">
	        <?php echo app('translator')->getFromJson('Select account to start using Direct Messenger'); ?>
	    </div>

		<div class="row dm-container" style="display: none;">
			<div class="col-sm-12 col-md-4">

				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><?php echo app('translator')->getFromJson('Inbox'); ?> <sup class="unseen_count"><span class="badge badge-danger">2</span></sup></h3>
						<div class="card-options">
							<button class="btn btn-secondary btn-sm btn-reload">
								<i class="fe fe-refresh-ccw"></i>
							</button>
	                    </div>
					</div>
					<div class="dimmer" id="threads_list">
						<div class="loader"></div>
						<div class="dimmer-content">
							<div class="o-auto" style="height: 30rem;">
								<table class="table table-hover table-outline table-vcenter card-table">
									<tbody></tbody>
					            </table>
					            <div class="m-2 load-more-container">
						            <button class="btn btn-block btn-secondary btn-sm btn-load-more" style="display: none;">
									    <i class="fe fe-chevron-down"></i> <?php echo app('translator')->getFromJson('Load more'); ?>
									</button>
					            </div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-sm-12 col-md-8">

				<div class="card">
					<div class="dimmer" id="messages_list">
						<div class="loader"></div>
						<div class="dimmer-content">

							<div class="o-auto" style="height: 30rem;">
								<ul class="list-group card-list-group"></ul>
							</div>
							<div class="card-header" style="padding: 0.5rem;">
								<div class="input-group emoji-picker-container">
									<input type="text" class="form-control message-text" placeholder="<?php echo app('translator')->getFromJson('Message'); ?>" data-emojiable="true">
									<div class="input-group-append">
										<button type="button" class="btn btn-primary btn-send-message">
											<i class="fe fe-arrow-right"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>

	<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/autodimes/resources/views/direct.blade.php ENDPATH**/ ?>