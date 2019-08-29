<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class="skeleton skeleton--full">
    <div class="clearfix">
        <aside class="skeleton-aside hide-on-medium-and-down">
            <div class="aside-list js-loadmore-content" data-loadmore-id="1"></div>

            <div class="loadmore pt-20 none">
                <a class="fluid button button--light-outline js-loadmore-btn js-autoloadmore-btn" data-loadmore-id="1" href="<?= APPURL."/e/".$idname."?aid=".$Account->get("id")."&ref=schedule" ?>">
                    <span class="icon sli sli-refresh"></span>
                    <?= __("Load More") ?>
                </a>
            </div>
        </aside>

        <section class="skeleton-content">
            <div class="section-content">
              <div class="section-header clearfix">
                <h2 class="section-title">
                    <?= htmlchars($Account->get("username")) ?>
                    <?php if ($Account->get("login_required")): ?>
                        <small class="color-danger ml-15">
                            <span class="mdi mdi-information"></span>    
                            <?= __("Re-login required!") ?>
                        </small>
                    <?php endif ?>
                </h2>
            </div>

                <div class="inbox-chat-list">
                  <div class="direct-chat-msg" id="inbox-chat-list">
                    <?= $chats; ?>
                  </div>
                </div>

                <div class="loadmore mt-20 mb-20">
                    <a class="fluid button button--light-outline -js-loadmore-btn" 
                       id="inbox-loadmore" 
                       data-cursor="<?= $cursor?>" 
                       data-ajaxurl="<?= APPURL."/e/".$idname."/".$Account->get("id") . "?ajax=1"?>">
                        <span class="icon sli sli-refresh"></span>
                        <?= __("Load More") ?>
                    </a>
                </div>
        </section>
    </div>
</div>