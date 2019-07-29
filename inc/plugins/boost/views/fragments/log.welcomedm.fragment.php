                        <div class="boost-log-list-item <?= $l->get("status") ?>">
                            <div class="clearfix">
                              <span class="circle">
                                    <?php if ($l->get("status") == "success"): ?>
                                        <?php $img = $l->get("data.to.profile_pic"); ?>
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
                                                $username = "<a href='https://www.instagram.com/".htmlchars($l->get("data.to.username"))."' target='_blank'>".htmlchars($l->get("data.to.username"))."</a>";

                                                echo __("Sent a message to {username}", [
                                                    "{username}" => $username
                                                ]);
                                            ?>
                                            <span class="date" title="<?= $fulldate ?>"><?= $date->fromNow()->getRelative() ?></span>

                                            <?php if ($l->get("data.message")): ?>
                                                <div class="message"><?= nl2br(htmlchars($Emojione->shortnameToUnicode($l->get("data.message")))); ?></div>
                                            <?php endif ?>
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
                                        <?php if ($l->get("data.to.username")): ?>
                                            <a href="<?= "https://www.instagram.com/p/".htmlchars($l->get("data.to.username")) ?>" class="button small button--light-outline" target="_blank">
                                                <?= __("View Profile") ?>
                                            </a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>