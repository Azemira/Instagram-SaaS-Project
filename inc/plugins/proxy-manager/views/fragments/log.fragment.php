<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class="skeleton skeleton--full">
    <div class="clearfix">
        <aside class="skeleton-aside hide-on-medium-and-down">
            <?php
                $form_action = APPURL."/e/".$idname;
                include APPPATH."/views/fragments/aside-search-form.fragment.php";
            ?>
            <div class="js-search-results">

                <div class="aside-list js-loadmore-content" data-loadmore-id="1"></div>

                <div class="loadmore pt-20 mb-20 none">
                    <a class="fluid button button--light-outline js-loadmore-btn js-autoloadmore-btn" data-loadmore-id="1" href="<?= APPURL."/e/".$idname."?aid=".$Proxy->get("id")."&ref=log" ?>">
                        <span class="icon sli sli-refresh"></span>
                        <?= __("Load More") ?>
                    </a>
                </div>
            </div>
        </aside>

        <section class="skeleton-content">

            <div class="section-header clearfix">
                <h2 class="section-title"><?= htmlchars($Proxy->get("proxy").($Proxy->get("country_code") ? " - ".$Proxy->get("country_code") : "")) ?></h2>
            </div>

            <?php if($Proxy->isAvailable()): ?>
                <?php require_once(__DIR__.'/tab.fragment.php'); ?>
            <?php endif; ?>

            <?php if ($ActivityLog->getTotalCount() > 0): ?>
                <div class="arp-log-list js-loadmore-content" data-loadmore-id="2">
                    <?php foreach ($Logs as $l): ?>
                        <?php
                            $Account = \Controller::model("Account", $l->get("account_id"));
                            $User = \Controller::model("User", $l->get("user_id"));
                        ?>
                        <div class="arp-log-list-item <?= $l->get("status") ?>">
                            <div class="clearfix">
                                <span class="circle">
                                    <?php $title = htmlchars($Account->get("username")); ?>
                                    <?php if ($l->get("status") == "success"): ?>
                                        <span class="text"><?= textInitials($title, 2); ?></span>
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
                                            <strong><?= $Account->get("username") ?></strong>
                                            <?= $l->get("data.msg"); ?>
                                            <span class="date" title="<?= $fulldate ?>"><?= $date->fromNow()->getRelative() ?></span>
                                        <?php else: ?>
                                            <?php if ($l->get("data.msg")): ?>
                                                <div class="error-msg">
                                                    <?= __($l->get("data.msg")) ?>
                                                    <span class="date" title="<?= $fulldate ?>"><?= $date->fromNow()->getRelative() ?></span>
                                                </div>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </div>

                                    <a class="meta mr-20" target="_blank">
                                        <span class="icon mdi mdi-account"></span>
                                        <?= htmlchars($User->get("firstname")." ".$User->get("lastname")) ?>
                                    </a>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="arp-amount-of-action">
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
                    <p><?= __("Proxy manager activity log for this proxy is empty") ?></p>
                </div>
            <?php endif ?>
        </section>
    </div>
</div>