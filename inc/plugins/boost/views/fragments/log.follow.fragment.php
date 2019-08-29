                <div class="boost-log-list-item <?= $l->get("status") ?>">
                            <div class="clearfix">
                                <span class="circle">
                                    <?php if ($l->get("status") == "success"): ?>
                                        <?php $img = $l->get("data.followed.profile_pic_url"); ?>
                                        <span class="img" style="<?= $img ? "background-image: url('".htmlchars($img)."');" : "" ?>" title="<?= $l->get("id"); ?>"></span>
                                    <?php else: ?>
                                        <span class="text">E</span>    
                                    <?php endif ?>
                                </span>

                                <div class="inner clearfix">
                                    <?php 
                                        $date = new \Moment\Moment($l->get("date"), date_default_timezone_get());
                                        $date->setTimezone($AuthUser->get("preferences.timezone"));

                                        $fulldate = $date->format($AuthUser->get("preferences.dateformat")) . " " 
                                                  . $date->format($AuthUser->get("preferences.timeformat") == "12" ? "h:iA" : "H:i");
                                    
                                     if ($l->get("data.liked") == true && $l->get("data.liked.count")) : ?>

                                      <div class="pull-right boost-liked-info">
                                        <div class="icon mdi mdi-heart"></div>
                                        <div class="boost-liked-count"><?= $l->get("data.liked.count") ?> <?= (intval($l->get("data.liked.count")) > 1) ? __("likes") : __("like") ?></div>
                                      </div>

                                      <?php foreach ($l->get("data.liked.items") as $i):?>
                                        <span class="pull-right boost-liked-media">
                                              <img class="img" src="<?= $i->media_thumb ?>">
                                        </span>
                                      <?php endforeach; ?>

                                   <?php endif ?>

                                    <div class="action">
                                        <?php if ($l->get("status") == "success"): ?>
                                            <?= __("Followed %s", "<a href='https://www.instagram.com/".htmlchars($l->get("data.followed.username"))."' target='_blank'>".htmlchars($l->get("data.followed.username"))."</a>") ?>

                                            <span class="date" title="<?= $fulldate ?>"><?= $date->fromNow()->getRelative() ?></span>
                                        <?php else: ?>
                                            <?php if ($l->get("data.error.msg")): ?>
                                                <div class="error-msg">
                                                    <?= __($l->get("data.error.msg")) ?>
                                                    <span class="date" title="<?= $fulldate ?>"><?= $date->fromNow()->getRelative() ?></span>    
                                                </div>
                                            <?php endif ?>
                                            <?php if ($l->get("data.error.details")): ?>
                                                <div class="error-details"><?= __($l->get("data.error.details")) ?></div>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </div>

                                    <?php if ($l->get("data.trigger")): ?>
                                        <?php $trigger = $l->get("data.trigger"); ?>
                                        <?php if ($trigger->type == "hashtag"): ?>
                                            <a class="meta" href="<?= "https://www.instagram.com/explore/tags/".htmlchars($trigger->value) ?>" target="_blank">
                                                <span class="icon mdi mdi-pound"></span>
                                                <?= htmlchars($trigger->value) ?>
                                            </a>
                                        <?php elseif ($trigger->type == "location"): ?>
                                            <a class="meta" href="<?= "https://www.instagram.com/explore/locations/".htmlchars($trigger->id) ?>" target="_blank">
                                                <span class="icon mdi mdi-map-marker"></span>
                                                <?= htmlchars($trigger->value) ?>
                                            </a>
                                        <?php elseif ($trigger->type == "people"): ?>
                                            <a class="meta" href="<?= "https://www.instagram.com/".htmlchars($trigger->value) ?>" target="_blank">
                                                <span class="icon mdi mdi-instagram"></span>
                                                <?= htmlchars($trigger->value) ?>
                                            </a>
                                        <?php endif ?>
                                    <?php endif ?>
                                  <?php if(isset($management)) : ?>
                                    <p><a href="<?= APPURL."/e/management/?a=accounts&id=".$l->get("account_id")?>"><?= __("Account: ") . "#" . $l->get("account_id"); ?></a></p>
                                  <?php endif; ?>
                                  <?php if (((isset($showDebug) && $showDebug) || $AuthUser->isAdmin()) && $l->get("data.debug")) : ?>
                                    <hr />
                                    <a href="#" class="boost-debug" data-id="boost-debug-<?= $l->get("id");?>"><?= __("show debug")?></a>
                                    <div class="boost-debug" id="boost-debug-<?= $l->get("id");?>" style="display:none;">
                                      <pre><?= $l->get("data.debug"); ?></pre>
                                    </div>
                                  <?php endif ?>

                                    <div class="buttons clearfix">
                                        <?php if ($l->get("data.followed.username")): ?>
                                            <a href="<?= "https://www.instagram.com/".htmlchars($l->get("data.followed.username")) ?>" class="button small button--light-outline" target="_blank">
                                                <?= __("View Profile") ?>
                                            </a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>