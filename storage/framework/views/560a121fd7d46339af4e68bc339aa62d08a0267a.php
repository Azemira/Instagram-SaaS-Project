<?php $__env->startSection('title', __('Send message')); ?>

<?php $__env->startSection('content'); ?>

	<?php echo $__env->renderWhen($accounts->count() == 0, 'partials.no-accounts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

	<?php if($accounts->count()): ?>
	    <div class="card">
		    <div class="card-header">
		        <h3 class="card-title"><?php echo app('translator')->getFromJson('Send message'); ?></h3>
		    </div>
		    <div class="card-body">
		    	<form role="form" method="post" action="<?php echo e(route('dm.message_send')); ?>" enctype="multipart/form-data" autocomplete="off" onsubmit="return confirm('<?php echo app('translator')->getFromJson('Are you sure want to send this message?'); ?>');">
		        	<?php echo csrf_field(); ?>

		        	<div class="row">
	                    <div class="col-md-4">
				            <div class="form-group">
				                <label class="form-label"><?php echo app('translator')->getFromJson('Account'); ?></label>
				                <select name="account_id" class="form-control">
				                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                        <option value="<?php echo e($account->id); ?>" <?php echo e(old('account') == $account->id ? 'selected' : ''); ?>><?php echo e($account->username); ?></option>
				                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				                </select>
				                <small class="help-block"><?php echo app('translator')->getFromJson('Select your account'); ?></small>
				            </div>
	                    </div>
	                    <div class="col-md-8">
				        	<div class="form-group">
				                <label class="form-label"><?php echo app('translator')->getFromJson('Target audience'); ?></label>

				                <div class="selectgroup w-100">
				                    <label class="selectgroup-item">
				                        <input type="radio" name="audience" value="1" class="selectgroup-input" <?php echo e(old('audience', 1) == '1' ? 'checked' : ''); ?>>
				                        <span class="selectgroup-button"><?php echo app('translator')->getFromJson('Followers'); ?></span>
				                    </label>

				                    <label class="selectgroup-item">
				                        <input type="radio" name="audience" value="2" class="selectgroup-input" <?php echo e(old('audience') == '2' ? 'checked' : ''); ?>>
				                        <span class="selectgroup-button"><?php echo app('translator')->getFromJson('Following'); ?></span>
				                    </label>

				                    <label class="selectgroup-item">
				                        <input type="radio" name="audience" value="3" class="selectgroup-input" <?php echo e(old('audience') == '3' ? 'checked' : ''); ?>>
				                        <span class="selectgroup-button"><?php echo app('translator')->getFromJson('Users list'); ?></span>
				                    </label>

				                    <label class="selectgroup-item">
				                        <input type="radio" name="audience" value="4" class="selectgroup-input" <?php echo e(old('audience') == '4' ? 'checked' : ''); ?>>
				                        <span class="selectgroup-button"><?php echo app('translator')->getFromJson('Direct contacted'); ?></span>
				                    </label>
				                </div>
				            </div>
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-md-4">
				            <div class="form-group">
				                <div class="form-label"><?php echo app('translator')->getFromJson('Message type'); ?></div>
				                <div class="custom-controls-stacked">

				                    <label class="custom-control custom-radio">
				                    <input type="radio" class="custom-control-input" name="message_type" value="list" <?php echo e(old('message_type', 'list') == 'list' ? 'checked' : ''); ?>>
				                        <div class="custom-control-label"><?php echo app('translator')->getFromJson('List of messages'); ?></div>
				                    </label>

				                    <label class="custom-control custom-radio">
				                    <input type="radio" class="custom-control-input" name="message_type" value="text" <?php echo e(old('message_type') == 'text' ? 'checked' : ''); ?>>
				                        <div class="custom-control-label"><?php echo app('translator')->getFromJson('Custom text'); ?></div>
				                    </label>

				                    <label class="custom-control custom-radio">
				                    <input type="radio" class="custom-control-input" name="message_type" value="like" <?php echo e(old('message_type') == 'like' ? 'checked' : ''); ?>>
				                        <div class="custom-control-label"><?php echo app('translator')->getFromJson('Like'); ?></div>
				                    </label>

				                    <label class="custom-control custom-radio">
				                    <input type="radio" class="custom-control-input" name="message_type" value="hashtag" <?php echo e(old('message_type') == 'hashtag' ? 'checked' : ''); ?>>
				                        <div class="custom-control-label"><?php echo app('translator')->getFromJson('Hashtag'); ?></div>
				                    </label>

				                    <label class="custom-control custom-radio">
				                    <input type="radio" class="custom-control-input" name="message_type" value="photo" <?php echo e(old('message_type') == 'photo' ? 'checked' : ''); ?>>
				                        <div class="custom-control-label"><?php echo app('translator')->getFromJson('Photo'); ?></div>
				                    </label>

				                    <label class="custom-control custom-radio">
				                    <input type="radio" class="custom-control-input" name="message_type" value="video" <?php echo e(old('message_type') == 'video' ? 'checked' : ''); ?>>
				                        <div class="custom-control-label"><?php echo app('translator')->getFromJson('Video'); ?></div>
				                    </label>

				                    <label class="custom-control custom-radio">
				                    <input type="radio" class="custom-control-input" name="message_type" value="post" <?php echo e(old('message_type') == 'post' ? 'checked' : ''); ?>>
				                        <div class="custom-control-label"><?php echo app('translator')->getFromJson('Post'); ?></div>
				                    </label>
				                </div>
				            </div>
	                    </div>
	                    <div class="col-md-8">
	                    	<div class="form-group users_list" style="display: none;">
				                <label class="form-label"><?php echo app('translator')->getFromJson('Users list'); ?></label>
				                <select name="users_list_id" class="form-control <?php echo e($errors->has('users_list_id') ? 'is-invalid' : ''); ?>">
				                    <option value=""></option>
				                    <?php $__currentLoopData = $users_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                        <option value="<?php echo e($ul->id); ?>" <?php echo e(old('users_list_id') == $ul->id ? 'selected' : ''); ?>><?php echo e($ul->name); ?></option>
				                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				                </select>
				            </div>

				            <div class="form-group options option_list">
				                <label class="form-label"><?php echo app('translator')->getFromJson('Messages list'); ?></label>
				                <select name="messages_list_id" class="form-control <?php echo e($errors->has('messages_list_id') ? 'is-invalid' : ''); ?>">
				                    <option value=""></option>
				                    <?php $__currentLoopData = $messages_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ml): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                        <option value="<?php echo e($ml->id); ?>" <?php echo e(old('messages_list_id') == $ml->id ? 'selected' : ''); ?>><?php echo e($ml->name); ?></option>
				                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				                </select>
				            </div>

				            <div class="form-group options option_text" style="display: none;">
				                <label class="form-label"><?php echo app('translator')->getFromJson('Text'); ?></label>
				                <div class="emoji-picker-container">
					                <textarea rows="3" name="text" class="form-control <?php echo e($errors->has('text') ? 'is-invalid' : ''); ?>" placeholder="<?php echo app('translator')->getFromJson('Compose a message to be sent'); ?>" data-emojiable="true"><?php echo e(old('text')); ?></textarea>
					            </div>
				                <small class="help-block"><?php echo app('translator')->getFromJson('We also support Spintax. Feel free to use it like: {Hi|Hello|Hey} dear friend! {Thank you|We appreciate you} for your interest.'); ?></small>
				            </div>

				            <div class="form-group options option_like" style="display: none;">
				                <div class="alert alert-info">
		                            <i class="fe fe-heart mr-2"></i> <?php echo app('translator')->getFromJson('Like action will be sent'); ?>
		                        </div>
				            </div>

				            <div class="options option_hashtag" style="display: none;">
				            	<div class="row">
			                    	<div class="col-md-12 col-lg-4">
							            <div class="form-group">
							                <label class="form-label"><?php echo app('translator')->getFromJson('Hashtag'); ?></label>
											<div class="input-group">
												<span class="input-group-prepend">
													<span class="input-group-text">#</span>
												</span>
												<input type="text" name="hashtag" value="<?php echo e(old('hashtag')); ?>" class="form-control <?php echo e($errors->has('hashtag') ? 'is-invalid' : ''); ?>">
											</div>
							                <small class="help-block"><?php echo app('translator')->getFromJson('Hashtag without # symbol.'); ?></small>
							            </div>
			                    	</div>
			                    	<div class="col-md-12 col-lg-8">
							            <div class="form-group">
							                <label class="form-label"><?php echo app('translator')->getFromJson('Text'); ?></label>
							                <div class="emoji-picker-container">
								                <textarea rows="3" name="hashtag_text" class="form-control <?php echo e($errors->has('hashtag_text') ? 'is-invalid' : ''); ?>" placeholder="<?php echo app('translator')->getFromJson('Compose a message to be sent'); ?>" data-emojiable="true"><?php echo e(old('hashtag_text')); ?></textarea>
								            </div>
							                <small class="help-block"><?php echo app('translator')->getFromJson('We also support Spintax. Feel free to use it like: {Hi|Hello|Hey} dear friend! {Thank you|We appreciate you} for your interest.'); ?></small>
							            </div>
			                    	</div>
			                    </div>
				            </div>

				            <div class="form-group options option_photo" style="display: none;">
				                <label class="form-label"><?php echo app('translator')->getFromJson('Photo'); ?></label>
				                <input type="file" name="photo" class="form-control <?php echo e($errors->has('photo') ? 'is-invalid' : ''); ?>">
				                <small class="help-block"><?php echo app('translator')->getFromJson('Only PNG, JPEG, JPG, GIF files supported.'); ?></small>
				            </div>

				            <div class="form-group options option_video" style="display: none;">
				                <label class="form-label"><?php echo app('translator')->getFromJson('Video'); ?></label>
				                <input type="file" name="video" class="form-control <?php echo e($errors->has('video') ? 'is-invalid' : ''); ?>">
				                <small class="help-block"><?php echo app('translator')->getFromJson('Only MP4 (H.264) file supported.'); ?></small>
				            </div>

				            <div class="options option_disappearing" style="display: none;">
								<label class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" name="disappearing">
									<span class="custom-control-label"><?php echo app('translator')->getFromJson('Disappearing'); ?></span>
								</label>
							</div>

							<div class="options option_post" style="display: none;">
								<input type="hidden" name="media_id" value="<?php echo e(old('media_id')); ?>">

								<div class="form-group">
									<label class="form-label"><?php echo app('translator')->getFromJson('Post URL'); ?></label>
									<div class="input-group">
										<input type="text" name="post_url" class="form-control <?php echo e($errors->has('media_id') ? 'is-invalid' : ''); ?>" value="<?php echo e(old('post_url')); ?>">
										<span class="input-group-append">
											<button class="btn btn-success check_post" type="button"><?php echo app('translator')->getFromJson('Check post'); ?></button>
										</span>
									</div>
									<small class="help-block"><?php echo app('translator')->getFromJson('Format: https://www.instagram.com/p/XXXXXXX/'); ?></small>
								</div>

								<div class="form-group">
					                <label class="form-label"><?php echo app('translator')->getFromJson('Text'); ?></label>
					                <div class="emoji-picker-container">
					                	<textarea rows="3" name="post_text" class="form-control <?php echo e($errors->has('post_text') ? 'is-invalid' : ''); ?>" placeholder="<?php echo app('translator')->getFromJson('Compose a message to be sent'); ?>" data-emojiable="true"><?php echo e(old('post_text')); ?></textarea>
					                </div>
					                <small class="help-block"><?php echo app('translator')->getFromJson('We also support Spintax. Feel free to use it like: {Hi|Hello|Hey} dear friend! {Thank you|We appreciate you} for your interest.'); ?></small>
					            </div>

								<div class="row" id="post_preview" style="display: none;">
									<div class="col-md-6">
										<div class="card ">
											<img src="" alt="" class="post_thumbnail">
											<div class="p-3">
												<div class="post_author_name"></div>
												<small class="post_title text-muted"></small>
											</div>
										</div>
									</div>
								</div>

							</div>

	                    </div>
	                </div>


		            <div class="form-footer">
		            	<div class="row">
		            		<div class="col-md-12 col-lg-7">
		            			<div class="alert alert-warning">
		                            <i class="fe fe-alert-triangle mr-2"></i> <?php echo app('translator')->getFromJson('It\'s highly recommended to follow Instagram DM sending limits.'); ?>
		                        </div>
		            		</div>
		            		<div class="col-md-12 col-lg-5">
								<div class="form-group">
									<div class="input-group">
										<select name="speed" class="form-control">
											<option value="25" <?php echo e(old('speed') == '25' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('Slow (25 messages per day, every 56 minute)'); ?></option>
											<option value="50" <?php echo e(old('speed') == '50' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('Medium (50 messages per day, every 28 minute)'); ?></option>
											<option value="100" <?php echo e(old('speed') == '100' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('Fast (100 messages per day, every 14 minute)'); ?></option>
											<option value="200" <?php echo e(old('speed') == '200' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('Very fast (200 messages per day, every 7 minute)'); ?></option>
											<option value="86400" <?php echo e(old('speed') == '86400' ? 'selected' : ''); ?> style="display: none;"><?php echo app('translator')->getFromJson('Instantly (every 7-10 seconds)'); ?></option>
										</select>
										<span class="input-group-append">
											<button class="btn btn-primary" type="submit"><?php echo app('translator')->getFromJson('Send message'); ?></button>
										</span>
									</div>
								</div>
		            		</div>
		            	</div>
		            </div>

		        </form>
		    </div>
		</div>
	<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
    $(function() {

        <?php if(old('message_type')): ?>
            $('input[name="message_type"][value="<?php echo e(old('message_type')); ?>"]').trigger('change');
        <?php endif; ?>

        <?php if(old('audience')): ?>
            $('input[name="audience"][value="<?php echo e(old('audience')); ?>"]').trigger('change');
        <?php endif; ?>

    });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/autodimes/resources/views/message.blade.php ENDPATH**/ ?>