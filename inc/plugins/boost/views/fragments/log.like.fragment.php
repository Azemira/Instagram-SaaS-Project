                        <div class="boost-log-list-item <?= $l->get("status") ?>">
                            <div class="clearfix">
                                <span class="circle">
                                    <?php if ($l->get("status") == "success"): ?>
                                        <?php $img = $l->get("data.liked.media_thumb"); ?>
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
                                    ?>

                                    <div class="action">
                                        <?php if ($l->get("status") == "success"): ?>
                                            <?php
                                                $media_type = $l->get("data.liked.media_type");
                                                if ($media_type == 1) {
                                                    $type_label = "photo";
                                                } else if ($media_type == 2) {
                                                    $type_label = "video";
                                                } else if ($media_type == 8) {
                                                    $type_label = "album";
                                                } else {
                                                    $type_label = "post";
                                                }

                                                $username = "<a href='https://www.instagram.com/".htmlchars($l->get("data.liked.user.username"))."' target='_blank'>".htmlchars($l->get("data.liked.user.username"))."</a>";
                                                $type_label = "<a href='https://www.instagram.com/p/".htmlchars($l->get("data.liked.media_code"))."' target='_blank'>".$type_label."</a>";

                                                echo __("Liked {username}'s {post}", [
                                                    "{username}" => $username,
                                                    "{post}" => $type_label 
                                                ]);
                                            ?>
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
                                        <?php elseif ($trigger->type == "timeline_feed"): ?>
                                            <span class="meta">
                                                <span class="icon mdi mdi-home"></span>
                                                <?= __("Timeline Feed") ?>
                                            </span>
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
                                        <?php if ($l->get("data.liked.media_code")): ?>
                                            <a href="<?= "https://www.instagram.com/p/".htmlchars($l->get("data.liked.media_code")) ?>" class="button small button--light-outline" target="_blank">
                                                <?= __("View Post") ?>
                                            </a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>