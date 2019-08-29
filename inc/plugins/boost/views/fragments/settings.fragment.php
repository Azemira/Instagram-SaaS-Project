<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class='skeleton' id="account">
    <form class="js-ajax-form" 
          action="<?= APPURL . "/e/" . $idname . "/settings" ?>"
          method="POST">
        <input type="hidden" name="action" value="save">

        <div class="container-1200">
            <div class="row clearfix">
                <div class="form-result"></div>
              <div class="col s12 m12 l12 clearfix">
                <section class="section mb-20">
                  <div class="section-header clearfix">
                    <h2 class="section-title">
                      <a href="<?= APPURL . "/e/" . $idname . "/settings/?log=1" ?>"><?= __("Go to ") . " " . __("Activity") ?></a>
                    </h2>
                  </div>
                </section>
              </div>
              
                <!-- start follow -->
                <div class="col s12 m12 l12 clearfix">
                    <section class="section mb-20">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Follow") ?></h2>
                        </div>
                        <div class="section-content">
                          <div class="mb-10 clearfix">
                            <div class="col s4 m4 l4">
                              <label style="display: inline-block; padding: 25px 0 0 20px">
                                  <input type="checkbox" class="checkbox" name="action_follow" value="1"<?= $Settings->get("data.action_follow") ? "checked" : "" ?>>
                                  <span>
                                    <span class="icon unchecked"><span class="mdi mdi-check"></span></span>
                                    <?= __("Enable") . " " . __("Auto Follow"); ?>?
                                  </span>
                                </label>
                            </div>
                            <div class="col s4 m4 l4">
                              <label class="form-label"><?= __("Default Values") ?></label>
                              <select class="input" name="default-action-follow">
                                <option value="1" <?= $Settings->get("data.default.action_follow") == 1 ? "selected" : "" ?>><?= __("Enabled") ?></option>
                                <option value="0" <?= $Settings->get("data.default.action_follow") == 0 ? "selected" : "" ?>><?= __("Disabled") ?></option>
                              </select>
                            </div>
                            <div class="col s4 m4 l4 s-last m-last l-last">
                              <label class="form-label"><?= __("Max speed in trial") ?></label>
                              <select name="max-follow-trial" class="input">
                                <?php $s = $Settings->get("data.max_speed_trial.follow") ?>
                                <?php for ($i=1; $i<=60; $i++): ?>
                                  <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>><?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    </option>
                                <?php endfor; ?>
                              </select>
                            </div>
                          </div>
                            <div class="mb-10 clearfix">
                                <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Very Slow") ?></label>

                                    <select name="speed-follow-very-slow" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.follow_very_slow")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Slow") ?></label>

                                    <select name="speed-follow-slow" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.follow_slow")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col s4 m4 l4 s-last m-last l-last">
                                    <label class="form-label"><?= __("Medium") ?></label>

                                    <select name="speed-follow-medium" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.follow_medium")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-10 clearfix">
                              <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Fast") ?></label>

                                    <select name="speed-follow-fast" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.follow_fast")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                              <div class="col s4 m4 l4 ">
                                    <label class="form-label"><?= __("Very Fast") ?></label>

                                    <select name="speed-follow-very-fast" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.follow_very_fast")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                              <div class="col s4 m4 l4 s-last m-last l-last">
                                      <label class="form-label"><?= __("Default (Recommended)") ?></label>

                                      <select name="speed-follow-auto" class="input">
                                          <?php 
                                              $s = $Settings->get("data.speeds.follow_auto")
                                          ?>
                                          <?php for ($i=1; $i<=60; $i++): ?>
                                              <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                  <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                              </option>
                                          <?php endfor; ?>
                                      </select>
                                  </div>
                            </div>
                            <div class="mb-10 clearfix">
                              <div class="col s4 m4 l4">
                                <label class="form-label"><?= __("Enable Follow + Like") ?></label>
                                  <select name="follow-plus-like" class="input">
                                      <option value="0" <?= $Settings->get("data.follow_plus_like") == 0 ? "selected" : "" ?>><?= __("No") ?></option>
                                      <option value="1" <?= $Settings->get("data.follow_plus_like") == 1 ? "selected" : "" ?>><?= __("Yes") ?></option>
                                  </select>
                              </div>
                              <div class="col s4 m4 l4">
                                <label class="form-label"><?= __("Follow + Like Limit") ?></label>
							    <select name="follow-plus-like-limit" class="input">
                                      <option value="1" <?= $Settings->get("data.follow_plus_like_limit") == 1 ? "selected" : "" ?>>1</option>
                                      <option value="2" <?= $Settings->get("data.follow_plus_like_limit") == 2 ? "selected" : "" ?>>2</option>
                                      <option value="3" <?= $Settings->get("data.follow_plus_like_limit") == 3 ? "selected" : "" ?>>3</option>
								</select>
							</div>
                             <div class="col s4 m4 l4 s-last m-last l-last">
                                <label class="form-label"><?= __("Enable Follow + Mute") ?></label>
                                  <select name="follow-plus-mute" class="input">
                                      <option value="0" <?= $Settings->get("data.follow_plus_mute") == 0 ? "selected" : "" ?>><?= __("No") ?></option>
                                      <option value="1" <?= $Settings->get("data.follow_plus_mute") == 1 ? "selected" : "" ?>><?= __("Yes") ?></option>
                                  </select>
                              </div>
                            </div>

                              </div>
                            </div>

                        </div>
                    </section>
                </div>
                <!-- end follow -->
              
              
                <!-- start unfollow -->
                <div class="col s12 m12 l12 clearfix">
                    <section class="section mb-20">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Unfollow"); ?></h2>
                        </div>
                        <div class="section-content">
                          <div class="mb-10 clearfix">
                            <div class="col s4 m4 l4">
                              <label style="display: inline-block; padding: 25px 0 0 20px">
                                  <input type="checkbox" class="checkbox" name="action_unfollow" value="1"<?= $Settings->get("data.action_unfollow") ? "checked" : "" ?>>
                                  <span>
                                    <span class="icon unchecked"><span class="mdi mdi-check"></span></span>
                                    <?= __("Enable") . " " . __("Auto Unfollow"); ?>?
                                  </span>
                                </label>
                            </div>
                            <div class="col s4 m4 l4">
                              <label class="form-label"><?= __("Default Values") ?></label>
                              <select class="input" name="default-action-unfollow">
                                <option value="1" <?= $Settings->get("data.default.action_unfollow") == 1 ? "selected" : "" ?>><?= __("Enabled") ?></option>
                                <option value="0" <?= $Settings->get("data.default.action_unfollow") == 0 ? "selected" : "" ?>><?= __("Disabled") ?></option>
                              </select>
                            </div>
                            <div class="col s4 m4 l4 s-last m-last l-last">
                              <label class="form-label"><?= __("Max speed in trial") ?></label>
                              <select name="max-unfollow-trial" class="input">
                                <?php $s = $Settings->get("data.max_speed_trial.unfollow") ?>
                                <?php for ($i=1; $i<=60; $i++): ?>
                                  <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>><?= n__("%s request/hour", "%s requests/hour", $i, $i) ?></option>
                                <?php endfor; ?>
                              </select>
                            </div>
                          </div>
                          
                          <div class="mb-10 clearfix">
                                <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Very Slow") ?></label>

                                    <select name="speed-unfollow-very-slow" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.unfollow_very_slow")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Slow") ?></label>

                                    <select name="speed-unfollow-slow" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.unfollow_slow")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col s4 m4 l4 s-last m-last l-last">
                                    <label class="form-label"><?= __("Medium") ?></label>

                                    <select name="speed-unfollow-medium" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.unfollow_medium")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-10 clearfix">
                              <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Fast") ?></label>

                                    <select name="speed-unfollow-fast" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.unfollow_fast")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                              <div class="col s4 m4 l4 ">
                                    <label class="form-label"><?= __("Very Fast") ?></label>

                                    <select name="speed-unfollow-very-fast" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.unfollow_very_fast")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                          
                        </div>
                    </section>
                </div>
                <!-- end unfollow -->
              
                <!-- start like -->
                <div class="col s12 m12 l12 clearfix">
                    <section class="section mb-20">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Like") ?></h2>
                        </div>
                        <div class="section-content">
                          <div class="mb-10 clearfix">
                            <div class="col s4 m4 l4">
                              <label style="display: inline-block; padding: 25px 0 0 20px">
                                  <input type="checkbox" class="checkbox" name="action_like" value="1"<?= $Settings->get("data.action_like") ? "checked" : "" ?>>
                                  <span>
                                    <span class="icon unchecked"><span class="mdi mdi-check"></span></span>
                                    <?= __("Enable") . " " . __("Auto Like"); ?>?
                                  </span>
                                </label>
                            </div>
                            <div class="col s4 m4 l4">
                              <label class="form-label"><?= __("Default Values") ?></label>
                              <select class="input" name="default-action-like">
                                <option value="1" <?= $Settings->get("data.default.like") == 1 ? "selected" : "" ?>><?= __("Enabled") ?></option>
                                <option value="0" <?= $Settings->get("data.default.like") == 0 ? "selected" : "" ?>><?= __("Disabled") ?></option>
                              </select>
                            </div>
                            <div class="col s4 m4 l4 s-last m-last l-last">
                              <label class="form-label"><?= __("Max speed in trial") ?></label>
                              <select name="max-like-trial" class="input">
                                <?php $s = $Settings->get("data.max_speed_trial.like") ?>
                                <?php for ($i=1; $i<=60; $i++): ?>
                                  <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>><?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    </option>
                                <?php endfor; ?>
                              </select>
                            </div>
                          </div>
                            <div class="mb-10 clearfix">
                                <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Very Slow") ?></label>

                                    <select name="speed-like-very-slow" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.like_very_slow")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Slow") ?></label>

                                    <select name="speed-like-slow" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.like_slow")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col s4 m4 l4 s-last m-last l-last">
                                    <label class="form-label"><?= __("Medium") ?></label>

                                    <select name="speed-like-medium" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.like_medium")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-10 clearfix">
                              <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Fast") ?></label>

                                    <select name="speed-like-fast" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.like_fast")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                              <div class="col s4 m4 l4 ">
                                    <label class="form-label"><?= __("Very Fast") ?></label>

                                    <select name="speed-like-very-fast" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.like_very_fast")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                              <div class="col s4 m4 l4 s-last m-last l-last">
                                      <label class="form-label"><?= __("Default (Recommended)") ?></label>

                                      <select name="speed-like-auto" class="input">
                                          <?php 
                                              $s = $Settings->get("data.speeds.like_auto")
                                          ?>
                                          <?php for ($i=1; $i<=60; $i++): ?>
                                              <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                  <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                              </option>
                                          <?php endfor; ?>
                                      </select>
                                  </div>
                            </div>

                        </div>
                    </section>
                </div>
                <!-- end like -->
              
                <!-- start comment -->
                  <div class="col s12 m12 l12 clearfix">
                    <section class="section mb-20">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Auto Comment") ?></h2>
                        </div>
                        <div class="section-content">
                          <div class="mb-10 clearfix">
                            <div class="col s4 m4 l4">
                              <label style="display: inline-block; padding: 25px 0 0 20px">
                                  <input type="checkbox" class="checkbox" name="action_comment" value="1"<?= $Settings->get("data.action_comment") ? "checked" : "" ?>>
                                  <span>
                                    <span class="icon unchecked"><span class="mdi mdi-check"></span></span>
                                    <?= __("Enable") . " " . __("Auto Comment"); ?>?
                                  </span>
                                </label>
                            </div>
                            <div class="col s4 m4 l4">
                              <label class="form-label"><?= __("Default Values") ?></label>
                              <select class="input" name="default-action-comment">
                                <option value="1" <?= $Settings->get("data.default.comment") == 1 ? "selected" : "" ?>><?= __("Enabled") ?></option>
                                <option value="0" <?= $Settings->get("data.default.comment") == 0 ? "selected" : "" ?>><?= __("Disabled") ?></option>
                              </select>
                            </div>
                            <div class="col s4 m4 l4 s-last m-last l-last">
                              <label class="form-label"><?= __("Max speed in trial") ?></label>
                              <select name="max-comment-trial" class="input">
                                <?php $s = $Settings->get("data.max_speed_trial.comment") ?>
                                <?php for ($i=1; $i<=60; $i++): ?>
                                  <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>><?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    </option>
                                <?php endfor; ?>
                              </select>
                            </div>
                          </div>
                            <div class="mb-10 clearfix">
                                <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Very Slow") ?></label>

                                    <select name="speed-comment-very-slow" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.comment_very_slow")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Slow") ?></label>

                                    <select name="speed-comment-slow" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.comment_slow")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col s4 m4 l4 s-last m-last l-last">
                                    <label class="form-label"><?= __("Medium") ?></label>

                                    <select name="speed-comment-medium" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.comment_medium")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-10 clearfix">
                              <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Fast") ?></label>

                                    <select name="speed-comment-fast" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.comment_fast")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                              <div class="col s4 m4 l4 ">
                                    <label class="form-label"><?= __("Very Fast") ?></label>

                                    <select name="speed-comment-very-fast" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.comment_very_fast")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                              <div class="col s4 m4 l4 s-last m-last l-last">
                                      <label class="form-label"><?= __("Default (Recommended)") ?></label>

                                      <select name="speed-comment-auto" class="input">
                                          <?php 
                                              $s = $Settings->get("data.speeds.comment_auto")
                                          ?>
                                          <?php for ($i=1; $i<=60; $i++): ?>
                                              <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                  <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                              </option>
                                          <?php endfor; ?>
                                      </select>
                                  </div>
                            </div>
                          
                          <div class="mb-10 clearfix">
                            <div class="col s4 m4 l4">
                              <label style="display: inline-block; padding: 25px 0 0 20px">
                                  <input type="checkbox" class="checkbox" name="avoid_duplicated_comment" value="1"<?= $Settings->get("data.avoid_duplicated_comment") ? "checked" : "" ?>>
                                  <span>
                                    <span class="icon unchecked"><span class="mdi mdi-check"></span></span>
                                    <?= __("Avoid commenting same user more than once"); ?>?
                                  </span>
                                </label>
                            </div>
                          </div>

                        </div>
                    </section>
                </div>
                <!-- end comment -->
              
              
                <!-- start Story -->
                  <div class="col s12 m12 l12 clearfix">
                    <section class="section mb-20">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Auto View Story") ?></h2>
                        </div>
                        <div class="section-content">
                          <div class="mb-10 clearfix">
                            <div class="col s4 m4 l4">
                              <label style="display: inline-block; padding: 25px 0 0 20px">
                                  <input type="checkbox" class="checkbox" name="action_viewstory" value="1"<?= $Settings->get("data.action_viewstory") ? "checked" : "" ?>>
                                  <span>
                                    <span class="icon unchecked"><span class="mdi mdi-check"></span></span>
                                    <?= __("Enable") . " " . __("Auto View Story"); ?>?
                                  </span>
                                </label>
                            </div>
                            <div class="col s4 m4 l4">
                              <label class="form-label"><?= __("Default Values") ?></label>
                              <select class="input" name="default-action-viewstory">
                                <option value="1" <?= $Settings->get("data.default.viewstory") == 1 ? "selected" : "" ?>><?= __("Enabled") ?></option>
                                <option value="0" <?= $Settings->get("data.default.viewstory") == 0 ? "selected" : "" ?>><?= __("Disabled") ?></option>
                              </select>
                            </div>
                            <div class="col s4 m4 l4 s-last m-last l-last">
                              <label class="form-label"><?= __("Max speed in trial") ?></label>
                              <select name="max-viewstory-trial" class="input">
                                <?php $s = $Settings->get("data.max_speed_trial.viewstory") ?>
                                <?php for ($i=1; $i<=60; $i++): ?>
                                  <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>><?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    </option>
                                <?php endfor; ?>
                              </select>
                            </div>
                          </div>
                            <div class="mb-10 clearfix">
                                <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Very Slow") ?></label>

                                    <select name="speed-viewstory-very-slow" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.viewstory_very_slow")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Slow") ?></label>

                                    <select name="speed-viewstory-slow" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.viewstory_slow")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col s4 m4 l4 s-last m-last l-last">
                                    <label class="form-label"><?= __("Medium") ?></label>

                                    <select name="speed-viewstory-medium" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.viewstory_medium")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-10 clearfix">
                              <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Fast") ?></label>

                                    <select name="speed-viewstory-fast" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.viewstory_fast")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                              <div class="col s4 m4 l4 ">
                                    <label class="form-label"><?= __("Very Fast") ?></label>

                                    <select name="speed-viewstory-very-fast" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.viewstory_very_fast")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                              <div class="col s4 m4 l4 s-last m-last l-last">
                                      <label class="form-label"><?= __("Default (Recommended)") ?></label>

                                      <select name="speed-viewstory-auto" class="input">
                                          <?php 
                                              $s = $Settings->get("data.speeds.viewstory_auto")
                                          ?>
                                          <?php for ($i=1; $i<=60; $i++): ?>
                                              <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                  <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                              </option>
                                          <?php endfor; ?>
                                      </select>
                                  </div>
                            </div>

                        </div>
                    </section>
                </div>
                <!-- end Story -->
              
              
                <!-- start _welcomedm -->
                  <div class="col s12 m12 l12 clearfix">
                    <section class="section mb-20">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Auto Welcome DM") ?></h2>
                        </div>
                        <div class="section-content">
                          <div class="mb-10 clearfix">
                            <div class="col s4 m4 l4">
                              <label style="display: inline-block; padding: 25px 0 0 20px">
                                  <input type="checkbox" class="checkbox" name="action_welcomedm" value="1"<?= $Settings->get("data.action_welcomedm") ? "checked" : "" ?>>
                                  <span>
                                    <span class="icon unchecked"><span class="mdi mdi-check"></span></span>
                                    <?= __("Enable") . " " . __("Auto Welcome DM"); ?>?
                                  </span>
                                </label>
                            </div>
                            <div class="col s4 m4 l4">
                              <label class="form-label"><?= __("Default Values") ?></label>
                              <select class="input" name="default-action-welcomedm">
                                <option value="1" <?= $Settings->get("data.default.welcomedm") == 1 ? "selected" : "" ?>><?= __("Enabled") ?></option>
                                <option value="0" <?= $Settings->get("data.default.welcomedm") == 0 ? "selected" : "" ?>><?= __("Disabled") ?></option>
                              </select>
                            </div>
                            <div class="col s4 m4 l4 s-last m-last l-last">
                              <label class="form-label"><?= __("Max speed in trial") ?></label>
                              <select name="max-welcomedm-trial" class="input">
                                <?php $s = $Settings->get("data.max_speed_trial.welcomedm") ?>
                                <?php for ($i=1; $i<=60; $i++): ?>
                                  <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>><?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    </option>
                                <?php endfor; ?>
                              </select>
                            </div>
                          </div>
                            <div class="mb-10 clearfix">
                                <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Very Slow") ?></label>

                                    <select name="speed-welcomedm-very-slow" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.welcomedm_very_slow")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Slow") ?></label>

                                    <select name="speed-welcomedm-slow" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.welcomedm_slow")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col s4 m4 l4 s-last m-last l-last">
                                    <label class="form-label"><?= __("Medium") ?></label>

                                    <select name="speed-welcomedm-medium" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.welcomedm_medium")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-10 clearfix">
                              <div class="col s4 m4 l4">
                                    <label class="form-label"><?= __("Fast") ?></label>

                                    <select name="speed-welcomedm-fast" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.welcomedm_fast")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                              <div class="col s4 m4 l4 ">
                                    <label class="form-label"><?= __("Very Fast") ?></label>

                                    <select name="speed-welcomedm-very-fast" class="input">
                                        <?php 
                                            $s = $Settings->get("data.speeds.welcomedm_very_fast")
                                        ?>
                                        <?php for ($i=1; $i<=60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                              <div class="col s4 m4 l4 s-last m-last l-last">
                                      <label class="form-label"><?= __("Default (Recommended)") ?></label>

                                      <select name="speed-welcomedm-auto" class="input">
                                          <?php 
                                              $s = $Settings->get("data.speeds.welcomedm_auto")
                                          ?>
                                          <?php for ($i=1; $i<=60; $i++): ?>
                                              <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                                  <?= n__("%s request/hour", "%s requests/hour", $i, $i) ?>                                                    
                                              </option>
                                          <?php endfor; ?>
                                      </select>
                                  </div>
                            </div>

                        </div>
                    </section>
                </div>
                <!-- end DM -->
              
              

                <!-- start sleep -->
                <div class="col s12 m12 l12 clearfix">
                  <section class="section mb-10">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Pause Actions") ?></h2>
                        </div>

                        <div class="section-content">
                            <div class="mb-10 clearfix">
                                <div class="col s3 m3 l3 mb-10">
                                    <select name="pause_status" class="input">
                                      <option value="0" <?= $Settings->get("data.pause_status") == 0 ? "selected" : "" ?>><?= __("Disabled") ?></option>
                                      <option value="1" <?= $Settings->get("data.pause_status") == 1 ? "selected" : "" ?>><?= __("Let user set") ?></option>
                                      <option value="2" <?= $Settings->get("data.pause_status") == 2 ? "selected" : "" ?>><?= __("Use defined here") ?></option>
                                    </select>
                                </div>
                              
                                <div class="col s3 m3 l3 mb-10">
                                  <label class="form-label"><?= __("Default Values") ?></label>
                                  <div class="mb-10">
                                        <label>
                                            <input type="checkbox" 
                                                   class="checkbox" 
                                                   name="daily_pause" 
                                                   value="1"
                                                   <?= $Settings->get("data.daily_pause") ? "checked" : "" ?>>
                                            <span>
                                                <span class="icon unchecked">
                                                    <span class="mdi mdi-check"></span>
                                                </span>
                                                <?= __('Pause actions everyday') ?> ...
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col s6 s-last m6 m-last l6 l-last mb-10">


                                    <div class="js-daily-pause-range">
                                            <?php $timeformat = $AuthUser->get("preferences.timeformat") == "12" ? 12 : 24; ?>

                                            <div class="col s6 m6 l6">
                                                <label class="form-label"><?= __("From") ?></label>

                                                <?php 
                                                    $from = new \DateTime(date("Y-m-d")." ".$Settings->get("data.daily_pause_from"));
                                                    $from->setTimezone(new \DateTimeZone($AuthUser->get("preferences.timezone")));
                                                    $from = $from->format("H:i");
                                                ?>

                                                <select class="input" name="daily_pause_from">
                                                    <?php for ($i=0; $i<=23; $i++): ?>
                                                        <?php $time = str_pad($i, 2, "0", STR_PAD_LEFT).":00"; ?>
                                                        <option value="<?= $time ?>" <?= $from == $time ? "selected" : "" ?>>
                                                            <?= $timeformat == 24 ? $time : date("h:iA", strtotime(date("Y-m-d")." ".$time)) ?>    
                                                        </option>

                                                        <?php $time = str_pad($i, 2, "0", STR_PAD_LEFT).":30"; ?>
                                                        <option value="<?= $time ?>" <?= $from == $time ? "selected" : "" ?>>
                                                            <?= $timeformat == 24 ? $time : date("h:iA", strtotime(date("Y-m-d")." ".$time)) ?>    
                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>

                                            <div class="col s6 s-last m6 m-last l6 l-last">
                                                <label class="form-label"><?= __("To") ?></label>

                                                <?php 
                                                    $to = new \DateTime(date("Y-m-d")." ".$Settings->get("data.daily_pause_to"));
                                                    $to->setTimezone(new \DateTimeZone($AuthUser->get("preferences.timezone")));
                                                    $to = $to->format("H:i");
                                                ?>

                                                <select class="input" name="daily_pause_to">
                                                    <?php for ($i=0; $i<=23; $i++): ?>
                                                        <?php $time = str_pad($i, 2, "0", STR_PAD_LEFT).":00"; ?>
                                                        <option value="<?= $time ?>" <?= $to == $time ? "selected" : "" ?>>
                                                            <?= $timeformat == 24 ? $time : date("h:iA", strtotime(date("Y-m-d")." ".$time)) ?>    
                                                        </option>

                                                        <?php $time = str_pad($i, 2, "0", STR_PAD_LEFT).":30"; ?>
                                                        <option value="<?= $time ?>" <?= $to == $time ? "selected" : "" ?>>
                                                            <?= $timeformat == 24 ? $time : date("h:iA", strtotime(date("Y-m-d")." ".$time)) ?>    
                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    
                        
                    </section>
                </div>
                <!-- end sleep -->
              
                <!-- start default -->
                <div class="col s12 m12 l12 clearfix">
                  <section class="section mb-10">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Default Values") ?></h2>
                        </div>
                        <div class="section-content">
                            <div class="mb-10 clearfix">
                                <div class="col s3 m3 l3 mb-10">
                                  <div class="col-inner p-10">
                                    <label class="form-label"><?= __("Follow cicle") ?></label>
                                    <select name="default-follow-cicle-status" class="input">
                                      <option value="1" <?= $Settings->get("data.default.follow_cicle_status") == 1 ? "selected" : "" ?>><?= __("Let user set") ?></option>
                                      <option value="2" <?= $Settings->get("data.default.follow_cicle_status") == 2 ? "selected" : "" ?>><?= __("Use defined here") ?></option>
                                    </select>

                                    <label class="form-label mt-20"><?= __("Default Values") ?></label>
                                    <select name="default-follow-cicle" class="input">
                                      <?php foreach($followCicle as $f) : ?>
                                        <option value="<?=$f?>" <?= $f == $Settings->get("data.default.follow_cicle") ? "selected" : "" ?>><?=$f?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                                </div>
                              
                                <div class="col s3 m3 l3 mb-10">
                                  <div class="col-inner p-10">
                                    <label class="form-label"><?= __("Ignore Private Accounts?") ?></label>
                                    <select name="default-ignore-private-status" class="input">
                                      <option value="1" <?= $Settings->get("data.default.ignore_private_status") == 1 ? "selected" : "" ?>><?= __("Let user set") ?></option>
                                      <option value="2" <?= $Settings->get("data.default.ignore_private_status") == 2 ? "selected" : "" ?>><?= __("Use defined here") ?></option>
                                    </select>

                                    <label class="form-label mt-20"><?= __("Default Values") ?></label>
                                    <select class="input" name="default-ignore-private">
                                      <option value="0" <?= $Settings->get("data.default.ignore_private") == 0 ? "selected" : "" ?>><?= __("No") ?></option>
                                      <option value="1" <?= $Settings->get("data.default.ignore_private") == 1 ? "selected" : "" ?>><?= __("Yes") ?></option>
                                    </select>
                                  </div>
                                </div>
                              
                                <div class="col s3 m3 l3 mb-10">
                                  <div class="col-inner p-10">
                                    <label class="form-label"><?= __("Has Profile Picture?") ?></label>
                                    <select name="default-has-picture-status" class="input">
                                      <option value="1" <?= $Settings->get("data.default.has_picture_status") == 1 ? "selected" : "" ?>><?= __("Let user set") ?></option>
                                      <option value="2" <?= $Settings->get("data.default.has_picture_status") == 2 ? "selected" : "" ?>><?= __("Use defined here") ?></option>
                                    </select>

                                    <label class="form-label mt-20"><?= __("Default Values") ?></label>
                                    <select class="input" name="default-has-picture">
                                      <option value="0" <?= $Settings->get("data.default.has_picture") == 0 ? "selected" : "" ?>><?= __("No") ?></option>
                                      <option value="1" <?= $Settings->get("data.default.has_picture") == 1 ? "selected" : "" ?>><?= __("Yes") ?></option>
                                    </select>
                                  </div>
                                </div>
                                                                  
                                <div class="col s3 m3 l3 mb-10  s-last m-last l-last">
                                  <div class="col-inner p-10">
                                    <label class="form-label"><?= __("Unfollow") . ' - ' . __("Source") . ' (' . __("detault") . ')'; ?></label>
                                    <select name="default-unfollow-source" class="input">
                                      <option value="0" <?= $Settings->get("data.default.unfollow_source") == 0 ? "selected" : "" ?>><?= __("People followed by us") ?></option>
                                      <option value="1" <?= $Settings->get("data.default.unfollow_source") == 1 ? "selected" : "" ?>><?= __("Anyone") ?></option>
                                    </select>
                                    <hr />
                                    
                                    <label class="form-label"><?= __("Keep followers?") ?></label>
                                    <select name="default-keep-followers-status" class="input">
                                      <option value="1" <?= $Settings->get("data.default.keep_followers_status") == 1 ? "selected" : "" ?>><?= __("Let user set") ?></option>
                                      <option value="2" <?= $Settings->get("data.default.keep_followers_status") == 2 ? "selected" : "" ?>><?= __("Use defined here") ?></option>
                                    </select>
                                    
                                    <label class="form-label mt-20"><?= __("Default Values") ?></label>
                                    <select class="input" name="default-keep-followers">
                                      <option value="0" <?= $Settings->get("data.default.keep_followers") == 0 ? "selected" : "" ?>><?= __("No") ?></option>
                                      <option value="1" <?= $Settings->get("data.default.keep_followers") == 1 ? "selected" : "" ?>><?= __("Yes") ?></option>
                                    </select>
                                  </div>
                                </div>

                            </div>
                          <div class="mb-10 clearfix">
                            <div class="col s3 m3 l3 mb-10">
                              <div class="col-inner p-10">
                                <label class="form-label"><?= __("Bad Words") ?></label>
                                <select name="default-badwords-status" class="input">
                                  <option value="1" <?= $Settings->get("data.default.badwords_status") == 1 ? "selected" : "" ?>><?= __("Let user set") ?></option>
                                  <option value="2" <?= $Settings->get("data.default.badwords_status") == 2 ? "selected" : "" ?>><?= __("Disabled") ?></option>
                                </select>

                                <ul class="field-tips">
                                  <li><?= __("Enabling bad words may slow down the actions") ?></li>
                                </ul>
                              </div>
                            </div>
                            <div class="col s3 m3 l3 mb-10">
                              <div class="col-inner p-10">
                                  <label class="form-label"><?= __("Default Speed") ?></label>
                                  <select name="detault-speed" class="input">
                                      <?php $s = $Settings->get("data.default.speed") ?>
                                      <option value="auto" <?= $s == "auto" ? "selected" : "" ?>><?= __("Auto"). " (".__("Recommended").")" ?></option>
                                      <option value="very_slow" <?= $s == "very_slow" ? "selected" : "" ?>><?= __("Very Slow") ?></option>
                                      <option value="slow" <?= $s == "slow" ? "selected" : "" ?>><?= __("Slow") ?></option>
                                      <option value="medium" <?= $s == "medium" ? "selected" : "" ?>><?= __("Medium") ?></option>
                                      <option value="fast" <?=$s == "fast" ? "selected" : "" ?>><?= __("Fast") ?></option>
                                      <option value="very_fast" <?= $s == "very_fast" ? "selected" : "" ?>><?= __("Very Fast") ?></option>
                                  </select>

                              </div>
                            </div>
                          <div class="col s3 m3 l3 mb-10">
                              <div class="col-inner p-10">
                                  <label class="form-label"><?= __("Visible Speeds") ?></label>
                                    <label class="mb-10 block">
                                        <input type="checkbox" class="checkbox" name="visible-speed-auto" value="1" <?= $Settings->get("data.visible_speed.auto") ? "checked" : "" ?>>
                                        <span> <span class="icon unchecked"> <span class="mdi mdi-check"></span> </span> <?= __("Auto"). " (".__("Recommended").")" ?> </span>
                                    </label>
                                
                                    <label class="mb-10 block">
                                        <input type="checkbox" class="checkbox" name="visible-speed-very-slow" value="1" <?= $Settings->get("data.visible_speed.very_slow") ? "checked" : "" ?>>
                                        <span> <span class="icon unchecked"> <span class="mdi mdi-check"></span> </span> <?= __('Very Slow') ?> </span>
                                    </label>
                                
                                    <label class="mb-10 block">
                                        <input type="checkbox" class="checkbox" name="visible-speed-slow" value="1" <?= $Settings->get("data.visible_speed.slow") ? "checked" : "" ?>>
                                        <span> <span class="icon unchecked"> <span class="mdi mdi-check"></span> </span> <?= __('Slow') ?> </span>
                                    </label>
                                
                                    <label class="mb-10 block">
                                        <input type="checkbox" class="checkbox" name="visible-speed-medium" value="1" <?= $Settings->get("data.visible_speed.medium") ? "checked" : "" ?>>
                                        <span> <span class="icon unchecked"> <span class="mdi mdi-check"></span> </span> <?= __('Medium') ?> </span>
                                    </label>
                                
                                    <label class="mb-10 block">
                                        <input type="checkbox" class="checkbox" name="visible-speed-fast" value="1" <?= $Settings->get("data.visible_speed.fast") ? "checked" : "" ?>>
                                        <span> <span class="icon unchecked"> <span class="mdi mdi-check"></span> </span> <?= __('Fast') ?> </span>
                                    </label>
                                
                                    <label class="mb-10 block">
                                        <input type="checkbox" class="checkbox" name="visible-speed-very-fast" value="1" <?= $Settings->get("data.visible_speed.very_fast") ? "checked" : "" ?>>
                                        <span> <span class="icon unchecked"> <span class="mdi mdi-check"></span> </span> <?= __('Very Fast') ?> </span>
                                    </label>
                              </div>
                            </div>
                          </div>
                        </div>
                    
                        
                    </section>
                </div>
                <!-- end default -->
              
                <!-- start others  -->
                <div class="col s12 m12 l12  clearfix">
                  <section class="section mb-10">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Other Settings") ?></h2>
                        </div>

                        <div class="section-content clearfix">
                          <div class="mb-10 clearfix">
                            <div class="col s3 m3 l3">
                              <label class="form-label"><?= __("Minimum of targets") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="min_target" 
                                       value="<?= (int) $Settings->get("data.min_target");?>">
                                  <span>
                                    <ul class="field-tips">
                                        <li><?= __("Minimum of People, Hashtags or Places that user should select.") ?></li>
                                        <li><?= __("Use 0 to no limit.") ?></li>
                                    </ul>
                                </span>
                              </label>
                            </div>
                            <div class="col s3 m3 l3">
                              <label class="form-label"><?= __("Minimum of comments") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="min_comments" 
                                       value="<?= (int) $Settings->get("data.min_comments");?>">
                                  <span>
                                    <ul class="field-tips">
                                        <li><?= __("Minimum of comments user should set.") ?></li>
                                        <li><?= __("Use 0 to no limit.") ?></li>
                                    </ul>
                                </span>
                              </label>
                              
                            </div>
                            <div class="col s3 m3 l3">
                              <label class="form-label"><?= __("Random Delay MIN") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="rand_min" 
                                       value="<?= (int) $Settings->get("data.rand_min");?>">
                                </label>
                                  <span>
                                    <ul class="field-tips">
                                      <li><?= __("In seconds") ?></li>
                                      <li><?= __("Use 0 to no limit.") ?></li>
                                    </ul>
                                </span>
                                
                              
                            </div>
                            <div class="col s3 m3 l3 s-last m-last l-last">
                              <label class="form-label"><?= __("Random Delay MAX") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="rand_max" 
                                       value="<?= (int) $Settings->get("data.rand_max");?>">
                                  <span>
                                    <ul class="field-tips">
                                      <li><?= __("In seconds") ?></li>
                                      <li><?= __("Use 0 to no limit.") ?></li>
                                    </ul>
                                </span>
                              </label>
                            </div>
                          </div>
                          <div class="mb-10 clearfix">
                            <div class="col s3 m3 l3">
                              <label class="form-label"><?= __("Minimum of Welcome DM Messages") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="min_welcomedm" 
                                       value="<?= (int) $Settings->get("data.min_welcomedm");?>">
                                  <span>
                                    <ul class="field-tips">
                                        <li><?= __("Minimum of Welcome DM user should set.") ?></li>
                                        <li><?= __("Use 0 to no limit.") ?></li>
                                    </ul>
                                </span>
                              </label>
                          </div>
                        </div>
                    </section>
                  
                </div>
                <!-- end others -->
              
              
                <!-- start advanced  -->
                <div class="col s12 m12 l12  clearfix">
                  <input type="hidden" name="follow_cicle" value="<?= (int) $Settings->get("data.follow_cicle");?>">
                  <input type="hidden" name="follow_cicle" value="<?= (int) $Settings->get("data.like_cicle");?>">
                  <input type="hidden" name="follow_cicle" value="<?= (int) $Settings->get("data.comment_cicle");?>">
                  
                  <section class="section mb-10">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Advanced Settings") ?></h2>
                        </div>

                        <div class="section-content clearfix">
                          <div class="mb-10 clearfix">
                            <!--div class="col s3 m3 l3">
                              <label class="form-label"><?= __("Follow Cicle") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="follow_cicle" 
                                       value="<?= (int) $Settings->get("data.follow_cicle");?>">
                                  <span>
                                    <ul class="field-tips">
                                        <li><?= __("Number of Follow/unfollow request performed before switch to other action.") ?></li>
                                        <li><?= __("Recomended: 1 to 10") ?></li>
                                    </ul>
                                </span>
                              </label>
                            </div-->
                            <!--div class="col s3 m3 l3">
                              <label class="form-label"><?= __("Like Cicle") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="like_cicle" 
                                       value="<?= (int) $Settings->get("data.like_cicle");?>">
                                  <span>
                                    <ul class="field-tips">
                                        <li><?= __("Number of likes request performed before switch to other action.") ?></li>
                                        <li><?= __("Recomended: 1 to 10") ?></li>
                                    </ul>
                                </span>
                              </label>
                              
                            </div-->
                            
                            <!--div class="col s3 m3 l3">
                              <label class="form-label"><?= __("Comment Cicle") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="comment_cicle" 
                                       value="<?= (int) $Settings->get("data.comment_cicle");?>">
                                  <span>
                                    <ul class="field-tips">
                                        <li><?= __("Number of comments request performed before switch to other action.") ?></li>
                                        <li><?= __("Recomended: 1 to 5") ?></li>
                                    </ul>
                                </span>
                              </label>
                            </div-->
                            <div class="col s3 m3 l3">
                              <label class="form-label"><?= __("Checkpoint Required") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="checkpoint" 
                                       value="<?= (int) $Settings->get("data.checkpoint");?>">
                                </label>
                                  <span>
                                    <ul class="field-tips">
                                      <li><?= __("If the account get checkpoint required from Instagram, actions will be stopped for the time above") ?></li>
                                      <li><?= __("Time in Seconds") ?></li>
                                    </ul>
                                </span>
                            </div>
                            <!--div class="col s3 m3 l3  s-last m-last l-last">
                              <label class="form-label"><?= __("Actions by Cicle") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="action_by_cicle" 
                                       value="<?= (int) $Settings->get("data.action_by_cicle");?>">
                                </label>
                                  <span>
                                    <ul class="field-tips">
                                      <li><?= __("Number of action runned in each cron") ?></li>
                                      <li><?= __("For exemple, if you ser 3, every account will run 3 actions in each cron, but always respecting the speed") ?></li>
                                      <li><?= __("Recomended: 1 to 5") ?></li>
                                    </ul>
                                </span>
                            </div-->
                            <div class="col s3 m3 l3 pt-30">
                              <label>
                                <input type="checkbox" class="checkbox" name="save_debug" value="1" <?= $Settings->get("data.save_debug") ? "checked" : "" ?>>
                                  <span>
                                      <span class="icon unchecked">
                                          <span class="mdi mdi-check"></span>
                                      </span>
                                      <?= __("Save debug?") ?>
                                  </span>
                                </label>
                            </div>
                            <div class="col s6 m6 l6 s-last m-last l-last">
                              <label class="form-label"><?= __("Cron Type") ?></label>
                              <select name="cron_type" class="input">
                                  <option value="default" <?= ($Settings->get("data.cron_type") == "default" || !$Settings->get("data.cron_type")) ? "selected" : "" ?>>
                                      <?= __("Default") ?>
                                  </option>
                                  <option value="dedicated" <?= ($Settings->get("data.cron_type") == "dedicated") ? "selected" : "" ?>>
                                      <?= __("Dedicated") ?>
                                  </option>
                                  <option value="multiple" <?= ($Settings->get("data.cron_type") == "multiple") ? "selected" : "" ?>>
                                      <?= __("Multiple") ?>
                                  </option>
                              </select>
                              <span>
                                <ul class="field-tips">
                                  <li><?= __("Default: use default NextPost cron") ?></li>
                                  <li><?= __("Dedicated: an exclusive cron to boost. You need to set a new cron (just like your current cron), but with this url: <strong>https://your-site.com/e/boost/cron</strong>") ?></li>
                                  <li><?= __("Multiple: 10 exclusives cron to boost. You need to set 10 new crons (just like your current cron), but with this url: <br><strong>https://your-site.com/e/boost/cron/0<br>https://your-site.com/e/boost/cron/1<br>...<br>https://your-site.com/e/boost/cron/9</strong>") ?></li>
                                </ul>
                              </span>
                            </div>
                          </div>
                          <hr>
                          <div class="mb-10 clearfix">
                            <div class="col s3 m3 l3 pt-30">
                                <label>
                                <input type="checkbox" class="checkbox" name="stats" value="1" <?= $Settings->get("data.stats") ? "checked" : "" ?>>
                                  <span>
                                      <span class="icon unchecked">
                                          <span class="mdi mdi-check"></span>
                                      </span>
                                      <?= __("Integrate with stats plugin?") ?>
                                  </span>
                                </label>
                                  <span>
                                    <ul class="field-tips">
                                      <li><?= __("Check this and stats plugin will get data from boost instead others plugins (only for actions enabled in this page.)") ?></li>
                                    </ul>
                                </span>
                            </div>
                            <div class="col s3 m3 l3">
                              <label class="form-label"><?= __("Max try") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="max_try" 
                                       value="<?= (int) $Settings->get("data.max_try");?>">
                                </label>
                                  <span>
                                    <ul class="field-tips">
                                      <li><?= __("We need to send a request to IG to check some filters. How many times we can do it?") ?></li>
                                      <li><?= __("The higher the number you choose, the more likely you are to find media, but the execution will slow down") ?></li>
                                      <li><?= __("Recomended: 1 to 5") ?></li>
                                    </ul>
                                </span>
                            </div>
                            <div class="col s3 m3 l3 pt-30">
                              <label>
                                <input type="checkbox" class="checkbox" name="action_save_followers" value="1" <?= $Settings->get("data.action_save_followers") ? "checked" : "" ?>>
                                  <span>
                                      <span class="icon unchecked">
                                          <span class="mdi mdi-check"></span>
                                      </span>
                                      <?= __("Save best targets?") ?>
                                  </span>
                                </label>
                            </div>
                            <div class="col s3 m3 l3  s-last m-last l-last">
                              <label class="form-label"><?= __("Max Paginations") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="max_pagination" 
                                       value="<?= (int) $Settings->get("data.max_pagination");?>">
                                </label>
                                  <span>
                                    <ul class="field-tips">
                                      <li><?= __("Number max of paganation when getting data for linkin, commenting, following...") ?></li>
                                      <li><?= __("Choose a value between: 1 and 10") ?></li>
                                    </ul>
                                </span>
                            </div>
                          </div>
                          <hr>
                          <div class="mb-10 clearfix">
                            <div class="col s3 m3 l3">
                              <label>
                                <input type="checkbox" class="checkbox" name="stop" value="1" <?= $Settings->get("data.stop") ? "checked" : "" ?>>
                                  <span>
                                      <span class="icon unchecked">
                                          <span class="mdi mdi-check"></span>
                                      </span>
                                      <?= __("Stop Automation?") ?>
                                  </span>
                                </label>
                                  <span>
                                    <ul class="field-tips">
                                      <li><?= __("WARNING: if you check this, Boost wont run any action. This is useful when IG is down or you have other problem and dont want show a lot of error to user.") ?></li>
                                    </ul>
                                </span>
                            </div>
                            <div class="col s3 m3 l3">
                              <label>
                                <input type="checkbox" class="checkbox" name="wizard" value="1" <?= $Settings->get("data.wizard") ? "checked" : "" ?>>
                                  <span>
                                      <span class="icon unchecked">
                                          <span class="mdi mdi-check"></span>
                                      </span>
                                      <?= __("Use Wizard?") ?>
                                  </span>
                                </label>
                                  <span>
                                    <ul class="field-tips">
                                      <li><?= __("Wizard split settings in tabs.") ?></li>
                                    </ul>
                                </span>
                            </div>
                            <div class="col s3 m3 l3 s-last m-last l-last">
                              <label>
                                <input type="checkbox" class="checkbox" name="cron_overlap" value="1" <?= $Settings->get("data.cron_overlap") ? "checked" : "" ?>>
                                  <span>
                                      <span class="icon unchecked">
                                          <span class="mdi mdi-check"></span>
                                      </span>
                                      <?= __("Block cron overlap?") ?>
                                  </span>
                                </label>
                                  <span>
                                    <ul class="field-tips">
                                      <li><?= __("We'll flag each account as running (when running, of course). Overlapping cron will skip this accounts.") ?></li>
                                    </ul>
                                </span>
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="action_by_cicle" value="1" />
                    </section>
                  
                </div>
                <!-- end others -->
                  
                <!-- start package wise  -->
<div class="col s12 m12 l12  clearfix">
<section class="section mb-10">
   <div class="section-header clearfix">
      <h2 class="section-title"><?= __("Package wise settings") ?></h2>
   </div>
   <div class="section-content clearfix">
     <?php
     $Packages = Controller::model("Packages");
     $Packages->search(Input::get("q"))
              ->setPageSize(10)
              ->setPage(Input::get("page"))
              ->orderBy("id","DESC")
              ->fetchData();
              $str="";
              foreach ($Packages->getDataAs("Package") as $p):
                $str= $str . $p->get("id"). ",";
              endforeach;
              $str = substr($str,0,strlen($str)-1) ;
              $str = $str . ",0";
              ?>
             
               <input name="packageIds" type="text" value="<?=$str ?>" style="display:none;"/>
              <?php
               foreach ($Packages->getDataAs("Package") as $p):?> 
              
      <div class="mb-10 clearfix my_own_class">
         <div class="col s3 m3 l3">
            <label>
            <input type="text" 
               class="input" 
               value="<?= __($p->get('title')) ?>" style="color: black;" disabled>
               <input name="id-<?=__($p->get('id')) ?>" 
               class="input"
               style="display:none;" 
               value="<?= __($p->get('id')) ?>">
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="<?=$p->get("id")?>action_follow" value="1" <?= $Settings->get("data.package_setting.".$p->get("id").".action_follow") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked" > <span class="mdi mdi-check"></span> </span> <?=__('Auto follow') ?> </span>
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="<?=$p->get("id")?>action_unfollow" value="1" <?= $Settings->get("data.package_setting.".$p->get("id").".action_unfollow") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked" > <span class="mdi mdi-check"></span> </span> <?= __('Auto unfollow') ?> </span>
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="<?=$p->get("id")?>action_comment" value="1" <?= $Settings->get("data.package_setting.".$p->get("id").".action_comment") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked" > <span class="mdi mdi-check"></span> </span> <?= __('Auto Comment') ?> </span>
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="<?=$p->get("id")?>action_welcomedm" value="1" <?= $Settings->get("data.package_setting.".$p->get("id").".action_welcomedm") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked" > <span class="mdi mdi-check"></span> </span> <?= __('Welcome DM') ?> </span>
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="<?=$p->get("id")?>action_viewstory" value="1" <?= $Settings->get("data.package_setting.".$p->get("id").".action_viewstory") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked" > <span class="mdi mdi-check"></span> </span> <?= __('View story') ?> </span>
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="<?=$p->get("id")?>action_like" value="1" <?= $Settings->get("data.package_setting.".$p->get("id").".action_like") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked" > <span class="mdi mdi-check"></span> </span> <?= __('Auto Like') ?> </span>
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="<?=$p->get("id")?>follow_plus_like" value="1" <?= $Settings->get("data.package_setting.".$p->get("id").".follow_plus_like") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked"> <span class="mdi mdi-check"></span> </span> <?= __('follow + like') ?> </span>
            </label>
         </div>
            </div>

         
         <?php endforeach?>
      
         <div class="mb-10 clearfix my_own_class">
         <div class="col s3 m3 l3">
            <label>
            <input type="text" 
               class="input" 
               value="<?= __("Trial") ?>" style="color: black;" disabled>
               <input name="id-0" 
               class="input"
               style="display:none;" 
               value="0">
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="0action_follow" value="1" <?= $Settings->get("data.package_setting.trial.action_follow") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked" > <span class="mdi mdi-check"></span> </span> <?=__('Auto follow') ?> </span>
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="0action_unfollow" value="1" <?= $Settings->get("data.package_setting.trial.action_unfollow") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked" > <span class="mdi mdi-check"></span> </span> <?= __('Auto unfollow') ?> </span>
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="0action_comment" value="1" <?= $Settings->get("data.package_setting.trial.action_comment") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked" > <span class="mdi mdi-check"></span> </span> <?= __('Auto Comment') ?> </span>
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="0action_welcomedm" value="1" <?= $Settings->get("data.package_setting.trial.action_welcomedm") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked" > <span class="mdi mdi-check"></span> </span> <?= __('Welcome DM') ?> </span>
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="0action_viewstory" value="1" <?= $Settings->get("data.package_setting.trial.action_viewstory") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked" > <span class="mdi mdi-check"></span> </span> <?= __('View story') ?> </span>
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="0action_like" value="1" <?= $Settings->get("data.package_setting.trial.action_like") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked" > <span class="mdi mdi-check"></span> </span> <?= __('Auto Like') ?> </span>
            </label>
         </div>
         <div class="col s2 m2 l2">
            <label class="mb-10 block">
            <input type="checkbox" class="checkbox" name="0follow_plus_like" value="1" <?= $Settings->get("data.package_setting.trial.follow_plus_like") ? "checked" : "" ?>>
            <span style="font-size: 10px;"> <span class="icon unchecked"> <span class="mdi mdi-check"></span> </span> <?= __('follow + like') ?> </span>
            </label>
         </div>
            </div>
    </div> 
</section>
</div>
<!-- end package wise -->
              
                <!-- start clear  -->
                <div class="col s12 m12 l12  clearfix">
                  <section class="section mb-10">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Remove Log data") ?></h2>
                        </div>

                        <div class="section-content clearfix">
                          <div class="mb-10 clearfix">
                            <div class="col s3 m3 l3">
                              <label class="form-label"><?= __("Keep Activity Log for X days") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="keep_data_days" 
                                       value="<?= (int) $Settings->get("data.clean.keep_data_days");?>">
                                  <span>
                                    <ul class="field-tips">
                                        <li><?= __("e.g: type 30 and all Boost Log Activity after 30 days will be removed") ?></li>
                                        <li><?= __("Use 0 and well'll never remove old logs.") ?></li>
                                    </ul>
                                </span>
                              </label>
                            </div>
                            
                            <div class="col s3 m3 l3">
                              <label class="form-label">
                                  <label class="mb-10 block">
                                      <input type="checkbox" class="checkbox" name="keep_essential" value="1" <?= $Settings->get("data.clean.keep_essential") ? "checked" : "" ?>>
                                      <span> <span class="icon unchecked"> <span class="mdi mdi-check"></span> </span> <?= __('Keep necessary data') ?> </span>
                                  </label>
                              </label>
                              <span>
                                <ul class="field-tips">
                                  <li><?= __("E.g. Success Follow data will not be removed beacuse unfollow may need it ") ?></li>
                                </ul>
                              </span>
                            </div>
                            
                            <div class="col s3 m3 l3">
                              <label class="form-label">
                                  <label class="mb-10 block">
                                      <input type="checkbox" class="checkbox" name="keep_success" value="1" <?= $Settings->get("data.clean.keep_success") ? "checked" : "" ?>>
                                      <span> <span class="icon unchecked"> <span class="mdi mdi-check"></span> </span> <?= __('Keep success log') ?> </span>
                                  </label>
                              </label>
                              <span>
                                <ul class="field-tips">
                                  <li><?= __("Only error messages will be removed") ?></li>
                                </ul>
                              </span>
                            </div>
                            
                            <div class="col s3 m3 l3 s-last m-last l-last">
                              <label class="form-label"><?= __("Remove from expired accounts after X days") ?></label>
                                <label>
                                  <input type="number" 
                                       class="input" 
                                       name="keep_remove_expired" 
                                       value="<?= (int) $Settings->get("data.clean.keep_remove_expired");?>">
                                  <span>
                                    <ul class="field-tips">
                                        <li><?= __("e.g: type 15 and all Boost Log Activity from EXPIRED USERS after 15 days will be removed") ?></li>
                                        <li><?= __("Use 0 and well'll never remove logs from expired users, except if you set the first box.") ?></li>
                                    </ul>
                                </span>
                              </label>
                            </div>
                          </div>
                          <pre>
                            <?= __("in order to use this feature, you need to set a new cronjob to run once a day:<br><strong>https://your-site.com/e/boost/clean/</strong>"); ?>
                          </pre>
                    </section>
                  
                </div>
                  <input class="fluid button button--footer" type="submit" value="<?= __("Save") ?>">
                <!-- end clear -->
              
              
            </div>
        </div>
    </form>
</div>