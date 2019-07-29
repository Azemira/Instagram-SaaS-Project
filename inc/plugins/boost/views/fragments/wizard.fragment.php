<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>
<?php
        $Settings->set("data.action_follow",  $Settings->get("data.package_setting." . ($AuthUser->get("package_id") == "0" ? "trial" : $AuthUser->get("package_id") ) . ".action_follow"));
        $Settings->set("data.action_unfollow",  $Settings->get("data.package_setting." . ($AuthUser->get("package_id") == "0" ? "trial" : $AuthUser->get("package_id") ) . ".action_unfollow"));
        $Settings->set("data.action_like",  $Settings->get("data.package_setting." . ($AuthUser->get("package_id") == "0" ? "trial" : $AuthUser->get("package_id") ) . ".action_like"));
        $Settings->set("data.action_comment",  $Settings->get("data.package_setting." . ($AuthUser->get("package_id") == "0" ? "trial" : $AuthUser->get("package_id") ) . ".action_comment"));
        $Settings->set("data.action_viewstory",  $Settings->get("data.package_setting." . ($AuthUser->get("package_id") == "0" ? "trial" : $AuthUser->get("package_id") ) . ".action_viewstory"));
        $Settings->set("data.action_welcomedm",  $Settings->get("data.package_setting." . ($AuthUser->get("package_id") == "0" ? "trial" : $AuthUser->get("package_id") ) . ".action_welcomedm"));
        $Settings->set("data.follow_plus_like",  $Settings->get("data.package_setting." . ($AuthUser->get("package_id") == "0" ? "trial" : $AuthUser->get("package_id") ) . ".follow_plus_like"));
?>
<div class="skeleton skeleton--full">
            <form class="js-boost-schedule-form"
                  action="<?= APPURL."/e/".$idname."/".$Account->get("id") ?>"
                  method="POST">
              
                <input type="hidden" name="action" value="save">
                <div class="section-header clearfix">
                <div class="profileWizard">
                  
                  <?php 
                    $pics = (array) $AuthUser->get("data.accpics");
                    if(isset($pics[$Account->get("username")]) && $pics[$Account->get("username")] != "") : ?>
                    <div class="profilePic pull-left" style="background-image: url(<?= $pics[$Account->get("username")] ?>)"></div>
                  <?php elseif($Account->get("image")) :?>
                    <div class="profilePic pull-left" style="background-image: url(<?= htmlchars($Account->get("image")) ?>)"></div>
                  <?php endif; ?>
                  
                
                    <h2 class="section-title">
                        <?= htmlchars($Account->get("username")) ?> 
                        <?php if ($Account->get("login_required")): ?>
                            <small class="color-danger ml-15">
                                <span class="mdi mdi-information"></span>    
                                <?= __("Re-login required!") ?>
                            </small>
                        <?php endif ?>
                    </h2>
                  <?php if ($Accounts->getTotalCount() > 1): ?>
                  <div class="pull-left clearfix context-menu-wrapper">
                    <a class="small button button--light-outline button--oval" href="javascript:void(0)"><?= __("Change account") ?></a>
                    <div class="context-menu" style="z-index: 99979; right: unset; margin-top: 18px;">
                        <iframe src="<?= APPURL."/e/".$idname."/accounts" ?>" frameborder="0" style="width: 400px; height: 400px; border: solid 1px #CCC;" id="myFrame"></iframe>
                      </div>
                  </div>
                  <?php endif ?>
                </div>
                </div>
                <?php if ($Account->get("login_required")): ?>
                <div class="container-1200 mt-30">
                    <div class="row clearfix">
                        <div class="alert danger <?= \Input::get("a") ? "heartbeat" : "" ?>">
                            <div class="msg">
                                <?= __("The <strong>").__($Account->get("username")).__("</strong> Instagram is needing a new login for the operation of this module. <br />")."<a href='".APPURL."/accounts/".$Account->get("id")."'>".__("CLICK HERE")."</a> ".__("so I can redirect you and you can log in again.") ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>

                <div class="boost-tab-heads clearfix">
                    <?php if($Settings->get("data.wizard")) : ?>
                      <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/wizard" ?>"  class="active"><?= __("Wizard") ?></a>
                    <?php else : ?>
                      <a href="<?= APPURL."/e/".$idname."/".$Account->get("id") ?>"><?= __("Target & Settings") ?></a>
                    <?php endif; ?>
                    <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/log" ?>"><?= __("Activity Log") ?></a>
                    <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/source" ?>" 
                       <?= !$Settings->get("data.action_save_followers") ? 'style="display:none"' : ''; ?>>
                      <?= __("Best Sources") ?>
                      <span class="boost-beta"><?= __("beta"); ?></span>
                    </a>
                </div>

                <div class="section-content" style="margin-bottom: 100px;">
                    <div class="form-result mb-25" style="display:none;"></div>

                    <div class="clearfix">
                        <div class="col s12 m12 l12"  data-wizard-init>     
                          <ul class="steps">
                            <li data-step="1"><?=__('<span>Select </span> the actions'); ?></li>
                            <li data-step="2"><?=__('<span>Choose</span> the source'); ?></li>
                            <li data-step="3"><?=__('<span>Growth</span> your profile'); ?></li>
                            <?php if($Settings->get("data.action_unfollow")) :  ?>                            
                              <li data-step="4"><?=__('Unfollow'); ?></li>
                             <?php 
                                endif;
                                $stp = 4;
                                if($Settings->get("data.action_comment")) :
                                $stp++
                             ?>
                              <li data-step="<?=$stp?>"><?=__('<span>Auto</span> comment'); ?></li>
                            <?php endif;
                              if($Settings->get("data.action_welcomedm")) :
                              $stp++
                            ?>                            
                            <li data-step="<?=$stp?>"><?=__('<span>Welcome</span> Direct Message'); ?></li>
                            <?php 
                              endif; 
                              $stp++ 
                            ?>
                            <li data-step="<?=$stp?>"><?=__('<span>Black</span> list'); ?></li>
                          </ul>
                          
                          <div class="steps-content">
                          
                          <!-- start: actions list -->
                          <div class="boost-box" id="boost-actions" data-step="1">
                            <div class="boost-head">
                              <h3 class="boost-title"><?=__('<span>Select </span> the actions'); ?></h3>
                            </div>
                            
                            <div class="boost-body">
                              <div class="boost-content">
                                <div class="mb-5 clearfix">
                                  

                                <?php if($Settings->get("data.action_follow")) : ?>
                                  <label class="inline-block mr-50 mb-15">
                                        <input type="checkbox" id="action_follow_switch" class="js-switch stats_plugin_list js-switch" data-plugin="action_follow" name="action_follow"  value="1" 
                                               <?= $Schedule->get("action_follow") || ( !$Schedule->isAvailable() && $Settings->get("data.default.action_follow")) ? "checked" : "" ?>>
                                        <span><?= __("Auto Follow"); ?></span>
                                  </label>
                                <?php
                                  endif;
                                  if($Settings->get("data.action_unfollow")) :
                                ?>
                                    <label class="inline-block mr-50 mb-15">
                                        <input type="checkbox" id="action_unfollow_switch" class="js-switch stats_plugin_list" data-plugin="action_unfollow" name="action_unfollow"  value="1" 
                                               <?= $Schedule->get("action_unfollow") || ( !$Schedule->isAvailable() && $Settings->get("data.default.action_unfollow")) ? "checked" : "" ?>>
                                        <span><?= __("Auto Unfollow"); ?></span>
                                    </label>
                                <?php
                                  endif;
                                  if($Settings->get("data.action_like")) :
                                ?>
                                    <label class="inline-block mr-50 mb-15">
                                        <input type="checkbox" id="action_like_switch" class="js-switch stats_plugin_list" data-plugin="action_like" name="action_like"  value="1" 
                                               <?= $Schedule->get("action_like") || ( !$Schedule->isAvailable() && $Settings->get("data.default.action_like")) ? "checked" : "" ?>>
                                        <span><?= __("Auto Like"); ?></span>
                                    </label>
                                <?php
                                  endif;
                                  if($Settings->get("data.action_comment")) :
                                ?>
                                    <label class="inline-block mr-50 mb-15">
                                        <input type="checkbox" id="action_comment_switch" class="js-switch stats_plugin_list" data-plugin="action_comment" name="action_comment"  value="1" 
                                               <?= $Schedule->get("action_comment") || ( !$Schedule->isAvailable() && $Settings->get("data.default.action_comment")) ? "checked" : "" ?>>
                                        <span><?= __("Auto Comment"); ?></span>
                                    </label>
                                <?php endif;
                                  if($Settings->get("data.action_viewstory")) :
                                ?>
                                    <label class="inline-block mr-50 mb-15">
                                        <input type="checkbox" id="action_viewstory_switch" class="js-switch stats_plugin_list" data-plugin="action_viewstory" name="action_viewstory"  value="1" 
                                               <?= $Schedule->get("action_viewstory") || ( !$Schedule->isAvailable() && $Settings->get("data.default.action_viewstory")) ? "checked" : "" ?>>
                                        <span><?= __("View Stories"); ?></span>
                                    </label>
                                <?php endif;
                                  if($Settings->get("data.action_welcomedm")) :
                                ?>
                                    <label class="inline-block mr-50 mb-15">
                                        <input type="checkbox" id="action_welcomedm_switch" class="js-switch stats_plugin_list" data-plugin="action_welcomedm" name="action_welcomedm"  value="1" 
                                               <?= $Schedule->get("action_welcomedm") || ( !$Schedule->isAvailable() && $Settings->get("data.default.action_welcomedm")) ? "checked" : "" ?>>
                                        <span><?= __("Send Welcome Direct Messages"); ?></span>
                                    </label>
                                <?php endif;?>
                                  
                                </div>
                         
                                  <div class="boost-helper">
                                    <p><?= __("Turn on/off the actions that your account will run!");?></p>
                                  </div>
                                <!--div class="mb-5 clearfix">
                                  <label class="inline-block mr-50 mb-15">
                                        <input type="checkbox" class="checkbox" name="disabled"  value="1" 
                                               <?= !$Schedule->get("is_active") ? "checked" : "" ?>>
                                        <span>
                                            <span class="icon unchecked"><span class="mdi mdi-check"></span></span>
                                            <?= __("STOP all actions"); ?>
                                        </span>
                                  </label>
                                </div-->
                            
                              </div>
                            </div>
                            
                          </div>
                          <!-- end: actions list -->
                          
                          
                          <!-- start: search source -->
                          <div class="boost-box" id="boost-source" data-step="2">
                            <div class="boost-head">
                              <h3 class="boost-title"><?=__('<span>Choose</span> the source'); ?></h3>
                            </div>
                            
                            <div class="boost-body">
                              <div class="boost-content">
                                 
                                <div class="mb-5 clearfix">                                

                                    <label class="inline-block mr-50 mb-15">
                                        <input class="radio" name='type' type="radio" value="people" checked>
                                        <span>
                                            <span class="icon"></span>
                                            <?= __("People") ?>
                                        </span>
                                    </label>
                                  
                                    <label class="inline-block mr-50 mb-15">
                                        <input class="radio" name='type' type="radio" value="hashtag">
                                        <span>
                                            <span class="icon"></span>
                                            #<?= __("Hashtags") ?>
                                        </span>
                                    </label>

                                    <label class="inline-block mb-15">
                                        <input class="radio" name='type' type="radio" value="location">
                                        <span>
                                            <span class="icon"></span>
                                            <?= __("Places") ?>
                                        </span>
                                    </label>
                                </div>
                          
                                <div class="clearfix mb-20 pos-r wrap-search-targets">
                                    <label class="form-label"><?= __('Search') ?></label>
                                    <input class="input rightpad" name="search"  type="text" value="" 
                                           data-url="<?= APPURL."/e/".$idname."/".$Account->get("id") ?>">
                                    <span class="field-icon--right pe-none none js-search-loading-icon">
                                        <img src="<?= APPURL."/assets/img/round-loading.svg" ?>" alt="Loading icon">
                                    </span>
                                  <p class="resultSearch mb-20" style="margin: 0px 0 0 0; padding: 0; color: #CECECE; font-size: 10px; position: relative;"></p>
                                </div>

                                <div class="tags clearfix mt-20">
                                    <?php 
                                      $targets = $Schedule->isAvailable() ? json_decode($Schedule->get("target")) : []; 
                                        $icons = [
                                            "hashtag" => "mdi mdi-pound",
                                            "location" => "mdi mdi-map-marker",
                                            "people" => "mdi mdi-instagram"
                                        ];
                                    ?>
                                    <?php foreach ($targets as $t): ?>
                                        <span class="tag pull-left"
                                              data-type="<?= htmlchars($t->type) ?>" 
                                              data-id="<?= htmlchars($t->id) ?>" 
                                              data-value="<?= htmlchars($t->value) ?>" 
                                              style="margin: 0px 2px 3px 0px;">
                                            <?php if (isset($icons[$t->type])): ?>
                                                <span class="<?= $icons[$t->type] ?>"></span>
                                            <?php endif ?>  

                                            <?= htmlchars($t->value) ?>
                                            <span class="mdi mdi-close remove"></span>
                                          </span>
                                    <?php endforeach ?>
                                </div>
                              <div class="boost-helper">
                                
                                <p><?= $Settings->get("data.min_target")
                                        ? __("Choose here where your new followers will come from. Select at least %s sources. Our platform will interage (like, comment,follow and more) with what you select here!", $Settings->get("data.min_source") )
                                        : __("Choose here where your new followers will come from. Our platform will interage (like, comment,follow and more) with what you select here!");
                                ?></p>
                              </div>
                            
                              </div>
                            </div>
                            
                          </div>
                          <!-- end: search source -->
                          
                          <div  data-step="3">                                                       
                          <!-- start: growth -->
                          <div class="boost-box">
                            <div class="boost-head">
                              <h3 class="boost-title"><?=__('<span>Growth</span> your profile'); ?></h3>
                            </div>
                            
                            <div class="boost-body">
                              <div class="boost-content">

                                <div class="clearfix">
                                  <!-- start: speed -->
                                  <?php $defaultSpeed = $Schedule->get("speed") ? $Schedule->get("speed") : $Settings->get("data.default.speed");?>
                                  <div class="col s12 m6 l6 mb-30">
                                    <label class="form-label boost-label-speed" style=""><?= __('Speed') ?></label>
                                    <select class="input" name="speed">
                                      <?php foreach($speeds as $k => $v) : ?>
                                        <option value="<?= $k; ?>" <?= $defaultSpeed == $k ? "selected" : "" ?>><?= $v ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                    <div class="boost-helper">
                                      <p><?= __("How fast our system should work? Set it here, but be careful.");?></p>
                                    </div>                                    
                                  </div>
                                  <!-- end: speed -->

                                <!-- start: Business -->
                                  <div class="col s12 m6 l6 l-last m-last s-last mb-30">
                                    <label class="form-label"><?=__("Business Accounts"); ?></label>

                                      <select class="input" name="business">
                                        <option value="both" <?= $Schedule->get("business") == "both" ? "selected" : "" ?>><?= __("Both"); ?></option>
                                        <option value="business" <?= $Schedule->get("business") == "business" ? "selected" : "" ?>><?= __("Business"); ?></option>
                                        <option value="personal" <?= $Schedule->get("business") == "personal" ? "selected" : "" ?>><?= __("Personal"); ?></option>
                                      </select>
                                  </div>
                                <!-- end: Private and Picture -->
                                  
                                  
                                </div>
                                
                                <!-- start: Cicle and gender -->
                                <div class="clearfix">
                                  <?php if($Settings->get("data.default.follow_cicle_status") != 2) : ?>
                                  <div class="col s12 m6 l6 mb-30">
                                    <label class="form-label"><?=__("Follow Cicle"); ?></label>
                                      <select class="input" name="follow-cicle">
                                        <?php foreach($followCicle as $f) : ?>
                                        <option value="<?=$f?>" <?= $f == $defaultCicle ? "selected" : "" ?>><?=$f?></option>
                                        <?php endforeach; ?>
                                      </select>
                                    <div class="boost-helper">
                                      <?= __("Automatically switch to unfollow when follow the number of accounts discribed here"); ?>
                                    </div>
                                  </div>
                                  <?php else : ?>
                                  <input type="hidden" name="follow-cicle" value="<?= $Settings->get("data.default.follow_cicle"); ?>" />
                                  <?php endif; ?>
                                  
                                  <div class="col s12 m6 l6 last m-last s-last l-last mb-30">
                                    <label class="form-label"><?= __("Gender"); ?></label>
                                    <select class="input" name="gender">
                                      <option value="everyone" <?= $Schedule->get("gender") == "everyone" ? "selected" : "" ?>><?= __("Everyone"); ?></option>
                                      <option value="male" <?= $Schedule->get("gender") == "male" ? "selected" : "" ?>><?= __("Male"); ?></option>
                                      <option value="female" <?= $Schedule->get("gender") == "female" ? "selected" : "" ?>><?= __("Female"); ?></option>
                                    </select>
                                    <div class="boost-helper">
                                      <?= __("Do you want to interact with only certain genders?"); ?>
                                    </div>
                                  </div>
                                </div>
                                <!-- end: Cicle and gender -->
                                
                                <!-- start: Private and Picture -->
                                <div class="clearfix">
                                  
                                  <?php if($Settings->get("data.default.ignore_private_status") != 2) : ?>
                                  
                                  <div class="col s12 m6 l6 mb-30">
                                    <label class="form-label"><?=__("Ignore Private Accounts?"); ?></label>
                                    
                                      <select class="input" name="ignore_private">
                                        <option value="1" <?= $defaultIgnorePrivate ? "selected" : "" ?>><?= __("Yes"); ?></option>
                                        <option value="0" <?= !$defaultIgnorePrivate ? "selected" : "" ?>><?= __("No"); ?></option>
                                      </select>
                                    <div class="boost-helper">
                                      <?= __("Do you want to send a follow request to private accounts? (follow only)"); ?>
                                    </div>
                                  </div>
                                  <?php else : ?>
                                  <input type="hidden" name="ignore_private" value="<?= $Settings->get("data.default.ignore_private"); ?>" />
                                  <?php endif; ?>
                                  
                                  <?php if($Settings->get("data.default.has_picture_status") != 2) : ?>
                                  
                                  <div class="col s12 m6 l6 last m-last s-last l-last mb-30">
                                    <label class="form-label"><?= __("Has Profile Picture?"); ?></label>
                                    <select class="input" name="has_picture">
                                        <option value="1" <?= $defaultHasPicture ? "selected" : "" ?>><?= __("Yes"); ?></option>
                                        <option value="0" <?= !$defaultHasPicture ? "selected" : "" ?>><?= __("No"); ?></option>
                                    </select>
                                    <div class="boost-helper">
                                      <?= __("Do you only want to interact ONLY with accounts that have a profile picture?"); ?>
                                    </div>
                                  </div>
                                  <?php else : ?>
                                  <input type="hidden" name="has_picture" value="<?= $Settings->get("data.default.has_picture"); ?>" />
                                  <?php endif; ?>
                                  
                                </div>
                                <!-- end: Private and Picture -->
                                
                                <div class="clearfix">
                                <!-- start: daily pause -->
                                  <?php if ($Settings->get("data.pause_status") == 1) : ?>
                                  <div class="col s12 m6 l6 mb-30">
                                    <div class="clearfix">
                                        <div class="mb-20">
                                            <label>
                                                <input type="checkbox" 
                                                       class="checkbox" 
                                                       name="daily-pause" 
                                                       value="1"
                                                       <?= ($Settings->get('data.daily_pause') && ! $Schedule->isAvailable()) || $Schedule->get("daily_pause") ? "checked" : "" ?>>
                                                <span>
                                                    <span class="icon unchecked">
                                                        <span class="mdi mdi-check"></span>
                                                    </span>
                                                    <?= __('Pause actions everyday') ?> ...
                                                </span>
                                            </label>
                                        </div>

                                        <div class="clearfix mb-20 js-daily-pause-range">
                                            <?php $timeformat = $AuthUser->get("preferences.timeformat") == "12" ? 12 : 24; ?>

                                            <div class="col s6 m6 l6">
                                                <label class="form-label"><?= __("From") ?></label>

                                                <?php
                                                    $daily_pause_from = $Schedule->get('daily_pause_from') ? $Schedule->get('daily_pause_from') : $Settings->get('data.daily_pause_from');
                                                    $from = new \DateTime(date("Y-m-d")." ". $daily_pause_from);
                                                    $from->setTimezone(new \DateTimeZone($AuthUser->get("preferences.timezone")));
                                                    $from = $from->format("H:i");
                                                ?>

                                                <select class="input" name="daily-pause-from">
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
                                                    $daily_pause_to = $Schedule->get('daily_pause_to') ? $Schedule->get('daily_pause_to') : $Settings->get('data.daily_pause_to');
  
                                                    $to = new \DateTime(date("Y-m-d")." ". $daily_pause_to);
                                                    $to->setTimezone(new \DateTimeZone($AuthUser->get("preferences.timezone")));
                                                    $to = $to->format("H:i");
                                                ?>

                                                <select class="input" name="daily-pause-to">
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
                                        <div class="boost-helper">
                                          <p><?= __("Resting an account will allow it to run longer without issues."); ?></p>
                                        </div>
                                    </div>
                                    </div>
                                  </div>
                                  <?php
                                    else :
                                      $from = new \DateTime(date("Y-m-d")." ".$Settings->get('data.daily_pause_from'));
                                      $from->setTimezone(new \DateTimeZone($AuthUser->get("preferences.timezone")));
                                      $from = $from->format("H:i");
                                  
                                      $to = new \DateTime(date("Y-m-d")." ".$Settings->get('data.daily_pause_to'));
                                      $to->setTimezone(new \DateTimeZone($AuthUser->get("preferences.timezone")));
                                      $to = $to->format("H:i");
                                  ?>
                                  <input type="hidden" name="daily-pause" value="<?= $Settings->get('data.daily_pause') ? 1 : 0; ?>">
                                  <input type="hidden" name="daily-pause-from" value="<?= $from; ?>">
                                  <input type="hidden" name="daily-pause-to" value="<?= $to; ?>">
                                  <?php endif; ?>
                                  <!-- end: daily pause -->
                                
                                  

                                
                              </div>
                            </div>
                          </div>
                          <!-- end: growth -->
                          
                          <?php if($Settings->get("data.follow_plus_like")) : ?>
                          <div class="boost-box">
                            <div class="boost-head">
                              <h3 class="boost-title"><?=__('<span>Follow</span> + Like'); ?></h3>
                            </div>
                            
                            <div class="boost-body">
                              <div class="boost-content">
                                <div class="clearfix">
                                  <div class="clearfix mb-20">
                                    <div class="col s6 m6 l6">
                                        <label class="form-label"><?= __("Enable this and we'll like some post from the followed user"); ?></label>

                                        <select class="input" name="follow-plus-like">
                                          <option value="0" <?= $Schedule->get("data.follow_plus_like") == 0 ? "selected" : "" ?>><?= __("No") ?></option>
                                          <option value="1" <?= $Schedule->get("data.follow_plus_like") == 1 ? "selected" : "" ?>><?= __("Yes") ?></option>
                                        </select>
                                    </div>
                                    <?php if($Settings->get("data.follow_plus_like_limit") <= 1) : ?>
                                      <input type="hidden" name="follow-plus-like-limit" value="<?= $Settings->get("data.follow_plus_like_limit"); ?>" />
                                    <?php else : ?>
                                      <div class="col s6 s-last m6 m-last l6 l-last">
                                        <label class="form-label"><?= __("Like Count") ?></label>

                                        <select class="input" name="follow-plus-like-limit">
                                          <?php for($i=1; $i<=$Settings->get("data.follow_plus_like_limit"); $i++) : ?>
                                            <option value="<?=$i?>" <?= $Schedule->get("data.follow_plus_like_limit") == $i ? 'selected' : '';?> ><?=$i?></option>
                                          <?php endfor; ?>
                                        </select>
                                      </div>
                                    <?php endif; ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php else :  ?>
                          <input type="hidden" name="follow-plus-like-limit" value="<?= $Settings->get("data.follow_plus_like_limit"); ?>" />
                          <input type="hidden" name="follow-plus-like" value="0" />
                          <?php endif; ?>
                          </div>
                          
                          <!-- start: Follow + Mute -->
                          <?php if(true) : //$Settings->get("data.follow_plus_mute") ?>
                          <div class="boost-box">
                            <div class="boost-head">
                              <h3 class="boost-title"><?=__('<span>Follow</span> + Mute'); ?></h3>
                            </div>
                            
                            <div class="boost-body">
                              <div class="boost-content">
                                <div class="clearfix">
                                  <div class="clearfix mb-20">
                                    <div class="col s6 m6 l6">
                                        <label class="form-label"><?= __("Enable this and we'll mute the followed user"); ?></label>

                                        <select class="input" name="follow-plus-mute">
                                          <option value="0" <?= $Schedule->get("data.follow_plus_mute") == 0 ? "selected" : "" ?>><?= __("No") ?></option>
                                          <option value="1" <?= $Schedule->get("data.follow_plus_mute") == 1 ? "selected" : "" ?>><?= __("Yes") ?></option>
                                        </select>
                                    </div>
                                    
                                      <div class="col s6 s-last m6 m-last l6 l-last">
                                        <label class="form-label"><?= __('Mute Option'); ?></label>

                                        <select class="input" name="follow-plus-mute">
                                            <option value="all" <?= $Schedule->get("data.follow_plus_mute_type") == "all" ? "selected" : "" ?>><?= __("Mute all Posts & Stories") ?></option>
                                            <option value="post" <?= $Schedule->get("data.follow_plus_mute_type") == "post" ? "selected" : "" ?>><?= __("Mute only Posts") ?></option>
                                            <option value="story" <?= $Schedule->get("data.follow_plus_mute_type") == "story" ? "selected" : "" ?>><?= __("Mute only Stories") ?></option>
                                        </select>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php else :  ?>
                          <input type="hidden" name="data.follow_plus_mute" value="0" />
                          <?php endif; ?>

                          <!-- end: Follow + Mute -->

                          <!-- start: unfollow settgings -->
                          <?php
                          $whitelist = $Schedule->isAvailable() ? json_decode($Schedule->get("whitelist")) : []; 
                          if($Settings->get("data.action_unfollow")) : ?>
                          <div class="boost-box" id="boost-unfollow" data-step="4">
                            <div class="boost-head">
                              <h3 class="boost-title"><?=__('<span>Unfollow</span> settings'); ?></h3>
                            </div>
                            
                            <div class="boost-body">
                              <div class="boost-content">
                                <div class="clearfix">
                                  <div class="col s12 m6 l6">
                                    <!-- start: Unfollow source -->
                                    <div class="clearfix">
                                      
                                      <div class="mb-20 mt-30">
                                        <label>
                                            <input type="checkbox" 
                                                   class="checkbox" 
                                                   name="unfollow_all" 
                                                   value="1"
                                                   <?= $defaultUnfollowAll ? "checked" : "" ?>>
                                            <span>
                                                <span class="icon unchecked">
                                                    <span class="mdi mdi-check"></span>
                                                </span>
                                                <?= __("Unfollow Everyone!") ?>
                                            </span>
                                        </label>
                                        <div class="boost-helper">
                                          <?= __("Caution: If you check this box we will remove ALL your followers (except those in White list)"); ?>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- end: Unfollow source -->
                                  </div>
                                  
                                  
                                <?php if($Settings->get("data.default.keep_followers_status") != 2) : ?>
                                  <div class="col s12 m6 l6 m-last l6 l-last">
                                    <!-- start: Unfollow keep followers -->
                                    <div class="mb-20 mt-30">
                                        <label>
                                            <input type="checkbox" 
                                                   class="checkbox" 
                                                   name="keep-followers" 
                                                   value="1"
                                                   <?= $defaultKeepFollowers ? "checked" : "" ?>>
                                            <span>
                                                <span class="icon unchecked">
                                                    <span class="mdi mdi-check"></span>
                                                </span>
                                                <?= __("Don't unfollow my followers") ?>
                                            </span>
                                        </label>
                                    </div>
                                    <!-- end: Unfollow keep followers -->
                                  </div>
                                  <?php else : ?>
                                  <input type="hidden" name="keep-followers" value="<?= $Settings->get("data.default.keep_followers"); ?>" />
                                  <?php endif; ?>
                                  
                                </div>
                                
                                <div class="clearfix mt-40 pos-r wrap-whitelist-targets">
                                  <!-- start: whitelist -->
                                  <div class="pos-r">
                                      <label class="form-label"><?= __("White list") ?></label>
                                      <input class="input rightpad" name="search" type="text" value="" 
                                             data-url="<?= APPURL."/e/".$idname."/".$Account->get("id") ?>"
                                             <?= $Account->get("login_required") ? "disabled" : "" ?>>
                                      <span class="field-icon--right pe-none none js-search-loading-icon">
                                          <img src="<?= APPURL."/assets/img/round-loading.svg" ?>" alt="Loading icon">
                                      </span>
                                  <p class="resultSearch mb-20" style="margin: 0px 0 0 0; padding: 0; color: #CECECE; font-size: 10px; position: relative;"></p>
                                  </div>
                                  <div class="boost-helper">
                                    <p><?= __("Adding accounts will insure we never unfollows them. We recommend adding your family, friends, and the people that engage with your content the most") ?></p>
                                  </div>
                                  <div class="whitelist clearfix mb-40">
                                <?php foreach ($whitelist as $t): ?>
                                    <span class="tag pull-left"
                                          data-id="<?= htmlchars($t->id) ?>" 
                                          data-value="<?= htmlchars($t->value) ?>" 
                                          style="margin: 0px 2px 3px 0px;">
                                          <span class="mdi mdi-instagram"></span>

                                          <?= htmlchars($t->value) ?>
                                          <span class="mdi mdi-close remove"></span>
                                      </span>
                                <?php endforeach ?>
                                  </div>
                                  <!-- end: whitelist -->
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          <?php else : ?>
                            <input type="hidden" name="unfollow_all" value="<?= $Schedule->get("unfollow_all") ? 1 : 0; ?>" />
                            <input type="hidden" name="keep-followers" value="<?= $keepFollowers ? 1 : 0; ?>" />
                          <?php endif; ?>
                          <!-- end: unfollow settgings -->
                          <?php $stp = 4 ?>
                          <?php 
                                  if($Settings->get("data.action_comment")) :
                                    $stp++;
                                  endif;
                          ?>
                          <!-- start: comments -->
                          <div class="boost-box" id="boost-comments" <?= !$Settings->get("data.action_comment") ? 'style="display:none;"' : 'data-step="'.htmlchars($stp).'"'; ?>>
                            <div class="boost-head">
                              <h3 class="boost-title"><?=__('<span>Auto</span> comment'); ?></h3>
                            </div>
                            
                            <div class="boost-body">
                              <div class="boost-content">
                                <div class="clearfix">
                                  <div class="col s12 m10 l8">
                                    <div class="mb-20">
                                        <label class="form-label"><?= __("Comment") ?></label>

                                        <div class="clearfix">
                                            <div class="col s12 m12 l8 mb-20">
                                                <div class="new-comment-input input" 
                                                     data-placeholder="<?= __("Add your comment") ?>"
                                                     contenteditable="true"></div>
                                            </div>

                                            <div class="col s12 m12 l4 l-last">
                                                <a href="javascript:void(0)" class="fluid button button--light-outline mb-15 js-add-new-comment-btn">
                                                    <span class="mdi mdi-plus-circle"></span>
                                                    <?= __("Add Comment") ?>    
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="field-tips">
                                      <?php if($Settings->get("data.min_comments")) : ?>
                                      <li><?= __("Choose at least %s comments", $Settings->get("data.min_comments"));?></li>
                                      <?php endif; ?>
                                        <li>
                                            <?= __("You can use following variables in the comments:") ?>

                                            <div class="mt-5">
                                                <strong>{{username}}</strong>
                                                <?= __("Media owner's username") ?>
                                            </div>

                                            <div class="mt-5">
                                                <strong>{{full_name}}</strong>
                                                <?= __("Media owner's full name. If user's full name is not set, username will be used.") ?>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="ac-comment-list clearfix">
                                      <?php 
                                      $comments = $Schedule->isAvailable() ? json_decode($Schedule->get("comments")) : [];
                                      $Emojione = new \Emojione\Client(new \Emojione\Ruleset());
                                      ?>
                                      <?php if ($comments): ?>
                                          <?php foreach ($comments as $c): ?>
                                              <div class="ac-comment-list-item" data-comment="<?= htmlchars($Emojione->shortnameToUnicode($c)) ?>">
                                                  <a href="javascript:void(0)" class="remove-comment-btn mdi mdi-close-circle"></a>
                                                  <span class="comment">
                                                      <?= str_replace(array("\\n", "\\r", "\r", "\n"), "<br>", htmlchars($Emojione->shortnameToUnicode($c))) ?>
                                                  </span>
                                              </div>
                                          <?php endforeach ?>
                                      <?php endif ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end: comments -->
                          <?php 
                                  if($Settings->get("data.action_welcomedm")) :
                                    $stp++;
                                  endif;
                          ?>                          
                          <!-- start: welcomedm -->
                          <div class="boost-box" id="boost-welcomedm" <?= !$Settings->get("data.action_welcomedm") ? 'style="display:none;"' : 'data-step="'.htmlchars($stp).'"'; ?>>
                            <div class="boost-head">
                              <h3 class="boost-title"><?=__('<span>Welcome</span> Direct Message'); ?></h3>
                            </div>
                            
                            <div class="boost-body">
                              <div class="boost-content">
                                <div class="clearfix">
                                  <div class="col s12 m10 l8">
                                    <div class="mb-20">
                                        <label class="form-label"><?= __("Messages") ?></label>

                                        <div class="clearfix">
                                            <div class="col s12 m12 l8 mb-20">
                                                <div class="new-message-input input" 
                                                     data-placeholder="<?= __("Add your message") ?>"
                                                     contenteditable="true"></div>
                                            </div>

                                            <div class="col s12 m12 l4 l-last">
                                                <a href="javascript:void(0)" class="fluid button button--light-outline mb-15 js-add-new-message-btn">
                                                    <span class="mdi mdi-plus-circle"></span>
                                                    <?= __("Add Message") ?>    
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="field-tips">
                                      <?php if($Settings->get("data.min_welcomedm")) : ?>
                                      <li><?= __("Choose at least %s messages", $Settings->get("data.min_welcomedm"));?></li>
                                      <?php endif; ?>
                                        <li>
                                            <?= __("You can use following variables in the messages:") ?>

                                            <div class="mt-5">
                                                <strong>{{username}}</strong>
                                                <?= __("Media owner's username") ?>
                                            </div>

                                            <div class="mt-5">
                                                <strong>{{full_name}}</strong>
                                                <?= __("Media owner's full name. If user's full name is not set, username will be used.") ?>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="wdm-message-list clearfix">
                                      <?php 
                                      $messages = $Schedule->isAvailable() ? json_decode($Schedule->get("dms")) : [];
                                      $Emojione = new \Emojione\Client(new \Emojione\Ruleset());
                                      ?>
                                      <?php if ($messages): ?>
                                          <?php foreach ($messages as $m): ?>
                                              <div class="wdm-message-list-item" data-message="<?= htmlchars($Emojione->shortnameToUnicode($m)) ?>">
                                                  <a href="javascript:void(0)" class="remove-message-btn mdi mdi-close-circle"></a>
                                                  <span class="message">
                                                      <?= str_replace(array("\\n", "\\r", "\r", "\n"), "<br>", htmlchars($Emojione->shortnameToUnicode($m))) ?>
                                                  </span>
                                              </div>
                                          <?php endforeach ?>
                                      <?php endif ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end: welcomedm -->

                          <?php $stp++ ?>
                          <!-- start: blacklist -->
                          <div class="boost-box" id="boost-blacklist" data-step="<?=$stp?>">
                            <div class="boost-head">
                              <h3 class="boost-title"><?=__('<span>Black</span> list'); ?></h3>
                            </div>
                            
                            <div class="boost-body">
                              <div class="boost-content">
                                <div class="clearfix">
                                  <div class="col s12 m12 l12">
                                    
                                    <!-- start: Account Blacklist -->
                                    <div class="clearfix pos-r wrap-blacklist-targets">
                                      <div class="pos-r">
                                          <label class="form-label"><?= __("Account Blacklist") ?></label>
                                          <input class="input rightpad" name="search" type="text" value="" 
                                                 data-url="<?= APPURL."/e/".$idname."/".$Account->get("id") ?>"
                                                 <?= $Account->get("login_required") ? "disabled" : "" ?>>
                                          <span class="field-icon--right pe-none none js-search-loading-icon">
                                              <img src="<?= APPURL."/assets/img/round-loading.svg" ?>" alt="Loading icon">
                                          </span>
                                  <p class="resultSearch mb-20" style="margin: 0px 0 0 0; padding: 0; color: #CECECE; font-size: 10px; position: relative;"></p>
                                      </div>
                                      <div class="boost-helper">
                                        <p><?= __("We will never follow or engage with content posted by any of the selected accounts.") ?></p>
                                      </div>
                                      <div class="blacklist clearfix mb-40">
                                        <?php 
                                          $blacklist = $Schedule->isAvailable() ? json_decode($Schedule->get("blacklist")) : []; 
                                          foreach ($blacklist as $t):
                                        ?>
                                            <span class="tag pull-left"
                                                  data-id="<?= htmlchars($t->id) ?>" 
                                                  data-value="<?= htmlchars($t->value) ?>" 
                                                  style="margin: 0px 2px 3px 0px;">
                                                  <span class="mdi mdi-instagram"></span>

                                                  <?= htmlchars($t->value) ?>
                                                  <span class="mdi mdi-close remove"></span>
                                              </span>
                                        <?php endforeach ?>
                                      </div>
                                    </div>
                                    <!-- end: Account Blacklist -->
                                    
                                    <!-- start: Keyword Blacklist -->
                                    <?php if($Settings->get("data.default.badwords_status") == 1) : ?>
                                    <div class="clearfix" id="boost-black-keyword">
                                      <div class="col s12 m8 l8">
                                            <label class="form-label"><?= __("Keywords Blacklist") ?></label>

                                            <div class="clearfix">
                                                <div class="col s12 m12 l12 mb-20">
                                                  <textarea name="black-keywords" class="input textarea new-black-keyword-input" placeholder="<?= __("Add words that will be blocked") ?>"><?= $Schedule->get("bad_words")?></textarea>
                                                </div>
                                            </div>
                                        <div class="boost-helper">
                                          <p><?= __("Skip media (caption and tags) and accounts (username, full name, biography, website) that match any of the selected keywords.") ?></p>
                                          <p><?= __("Use comma <strong>,</strong> to separe the keywords.") ?></p>
                                        </div>
                                        <!--
                                        <div class="mb-20 mt-30">
                                          <label>
                                              <input type="checkbox" 
                                                     class="checkbox" 
                                                     name="nfsw" 
                                                     value="1"
                                                     >
                                              <span>
                                                  <span class="icon unchecked">
                                                      <span class="mdi mdi-check"></span>
                                                  </span>
                                                  <?= __("Avoid Not Safe For Work keywords"); ?></span>
                                          </label>
                                        </div>
                                        -->
                                      </div>
                                    </div>
                                    <!-- end: Keyword Blacklist -->
                                    <?php else : ?>
                                      <input type="hidden" name="black-keywords" value="" />
                                    <?php endif; ?>
                                    
                                  </div>
                                  
                                </div>
                                
                                
                                
                              </div>
                            </div>
                          </div>
                          <!-- end: unfollow settgings
                          
                            <div class="clearfix mt-20">
                                <div class="col s12 m6 l6">
                                    <input class="fluid button" type="submit" value="<?= __("Save") ?>">
                                </div>
                            </div> -->
                          
                        </div>
                    </div>
                  
                </div>
              </div>
            </form>
    </div>
</div>