<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class="skeleton skeleton--full" id="auto-comment-schedule">
    <div class="clearfix">
        <aside class="skeleton-aside hide-on-medium-and-down">
            <div class="aside-list js-loadmore-content" data-loadmore-id="1"></div>

            <div class="loadmore pt-20 none">
                <a class="fluid button button--light-outline js-loadmore-btn js-autoloadmore-btn" data-loadmore-id="1" href="<?= APPURL."/e/".$idname."?aid=".$Account->get("id")."&ref=comments" ?>">
                    <span class="icon sli sli-refresh"></span>
                    <?= __("Load More") ?>
                </a>
            </div>
        </aside>

        <section class="skeleton-content">
            <form class="js-auto-comment-comments-form"
                  action="<?= APPURL."/e/".$idname."/".$Account->get("id")."/comments" ?>"
                  method="POST">

                <input type="hidden" name="action" value="save">

                <div class="section-header clearfix">
                    <h2 class="section-title"><?= htmlchars($Account->get("username")) ?></h2>
                </div>

                <div class="ac-tab-heads clearfix">
                    <a href="<?= APPURL."/e/".$idname."/".$Account->get("id") ?>"><?= __("Target & Settings") ?></a>
                    <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/comments" ?>" class="active"><?= __("Comments") ?></a>
                    <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/log" ?>"><?= __("Activity Log") ?></a>
                    <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/duplicate" ?>"><?= __("Duplicate Settings") ?></a>
                </div>

                <div class="section-content">
                    <div class="form-result"></div>

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
                                        <input class="fluid button" type="submit" value="<?= __("Save") ?>">
                                    </div>
                                </div>
                            </div>

                            <ul class="field-tips">
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
                                    $comments = $Schedule->isAvailable()
                                              ? json_decode($Schedule->get("comments"))
                                              : [];
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
            </form>
        </section>
    </div>
</div>