<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class="skeleton skeleton--full">
    <div class="clearfix">
      <?php if(!$Settings->get("data.wizard")) : ?>
        <aside class="skeleton-aside hide-on-medium-and-down">
            <div class="aside-list js-loadmore-content" data-loadmore-id="1"></div>

            <div class="loadmore pt-20 mb-20 none">
                <a class="fluid button button--light-outline js-loadmore-btn js-autoloadmore-btn" data-loadmore-id="1" href="<?= APPURL."/e/".$idname."?aid=".$Account->get("id")."&ref=log" ?>">
                    <span class="icon sli sli-refresh"></span>
                    <?= __("Load More") ?>
                </a>
            </div>
        </aside>
      <?php endif; ?>
        <section class="skeleton-content" style="<?= $Settings->get("data.wizard") ? "float: none;width: 99%;" : ""?>">
            <div class="section-header clearfix">
              <?php if(!$Settings->get("data.wizard")) :?>
                <h2 class="section-title">
                    <?= htmlchars($Account->get("username")) ?>
                    <?php if ($Account->get("login_required")): ?>
                        <small class="color-danger ml-15">
                            <span class="mdi mdi-information"></span>    
                            <?= __("Re-login required!") ?>
                        </small>
                    <?php endif ?>
                  </h2>
               <?php else : ?>
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
               <?php endif ?>
                
            </div>

            <div class="boost-tab-heads clearfix">
                  <?php if($Settings->get("data.wizard")) : ?>
                    <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/wizard" ?>"><?= __("Wizard") ?></a>
                  <?php else : ?>
                    <a href="<?= APPURL."/e/".$idname."/".$Account->get("id") ?>"><?= __("Target & Settings") ?></a>
                  <?php endif; ?>
                <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/log" ?>" class="active"><?= __("Activity Log") ?></a>
                <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/source" ?>" 
                   <?= !$Settings->get("data.action_save_followers") ? 'style="display:none"' : ''; ?>>
                  <?= __("Best Sources") ?>
                  <span class="boost-beta"><?= __("beta"); ?></span>
                </a>
            </div>

            <?php if ($ActivityLog->getTotalCount() > 0): ?>
                <div class="boost-log-list js-loadmore-content" data-loadmore-id="2">
                    <?php if ($ActivityLog->getPage() == 1 && $Schedule->get("is_active")): ?>
                        <?php 
                            $nextdate = new \Moment\Moment($Schedule->get("schedule_date"), date_default_timezone_get());
                            $nextdate->setTimezone($AuthUser->get("preferences.timezone"));

                            $diff = $nextdate->fromNow(); 
                        ?>
                        <?php if ($diff->getDirection() == "future"): ?>
                            <div class="boost-next-schedule">
                                <?= __("Next request will be sent %s approximately", $diff->getRelative()) ?>
                            </div>
                        <?php elseif (abs($diff->getSeconds()) < 60*10): ?>
                            <div class="boost-next-schedule">
                                <?= __("Next request will be sent in a few moments") ?>
                            </div>
                        <?php endif; ?>
                    <?php endif ?>

                    <?php // print_r($Logs); exit;
                      $Emojione = new \Emojione\Client(new \Emojione\Ruleset());
                      foreach ($Logs as $l) : //echo '<p>' . $l->get("action") . '</p>';
                          if($l->get("action") == "like") {
                            require(__DIR__.'/log.like.fragment.php');
                          } elseif ($l->get("action") == "follow") {
                            require(__DIR__.'/log.follow.fragment.php');
                          } elseif ($l->get("action") == "unfollow") {
                            require(__DIR__.'/log.unfollow.fragment.php');
                          } elseif ($l->get("action") == "comment") {
                            require(__DIR__.'/log.comment.fragment.php');
                          } elseif ($l->get("action") == "viewstory") {
                            require(__DIR__.'/log.viewstory.fragment.php');
                          } elseif ($l->get("action") == "welcomedm") {
                            require(__DIR__.'/log.welcomedm.fragment.php');
                          }
                      endforeach;
                  ?>
                </div>

                <div class="boost-amount-of-action">
                    <?= __("Total %s actions", $ActivityLog->getTotalCount()) ?>
                </div>

                <?php if($ActivityLog->getPage() < $ActivityLog->getPageCount()): ?>
                    <div class="loadmore mt-20 mb-20">
                        <?php 
                            $url = parse_url($_SERVER["REQUEST_URI"]);
                            $path = $url["path"];
                            if(isset($url["query"])){
                                $qs = parse_str($url["query"], $qsarray);
                                unset($qsarray["page"]);

                                $url = $path."?".(count($qsarray) > 0 ? http_build_query($qsarray)."&" : "")."page=";
                            }else{
                                $url = $path."?page=";
                            }
                        ?>
                        <a class="fluid button button--light-outline js-loadmore-btn" data-loadmore-id="2" href="<?= $url.($ActivityLog->getPage()+1) ?>">
                            <span class="icon sli sli-refresh"></span>
                            <?= __("Load More") ?>
                        </a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="no-data">
                    <p><?= __("Activity log for %s is empty", 
                    "<a href='https://www.instagram.com/".htmlchars($Account->get("username"))."' target='_blank'>".htmlchars($Account->get("username"))."</a>") ?></p>
                </div>
            <?php endif ?>
        </section>
    </div>
</div>