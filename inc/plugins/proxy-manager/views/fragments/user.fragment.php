<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class="skeleton skeleton--full">
    <div class="clearfix">
        <aside class="skeleton-aside hide-on-medium-and-down">

            <?php
                $form_action = APPURL."/e/".$idname."/users";
                include APPPATH."/views/fragments/aside-search-form.fragment.php";
            ?>

            <div class="js-search-results">
                <div class="aside-list js-loadmore-content" data-loadmore-id="1"></div>

                <div class="loadmore pt-20 mb-20 none">
                    <a class="fluid button button--light-outline js-loadmore-btn js-autoloadmore-btn" data-loadmore-id="1" href="<?= APPURL."/e/".$idname."/users?aid=".$User->get("id")."&ref=log" ?>">
                        <span class="icon sli sli-refresh"></span>
                        <?= __("Load More") ?>
                    </a>
                </div>
            </div>
        </aside>

        <section class="skeleton-content">
            <div class="section-header clearfix">
                <h2 class="section-title">
                    <?= htmlchars($User->get("firstname")." ".$User->get("lastname")) ?>
                </h2>
            </div>

            <?php if ($Accounts->getTotalCount() > 0): ?>
                <div class="arp-log-list js-loadmore-content" data-loadmore-id="2">
                    <?php foreach ($Accounts->getDataAs("Account") as $a): ?>
                        <input type="hidden" name="base-url" value="<?= APPURL."/e/".$idname."/users/".$User->get("id") ?>">
                        <div class="arp-log-list-item success">
                            <div class="clearfix">
                                <?php $title = htmlchars($a->get("username")); ?>
                                <span class="circle">
                                    <span class="text"><?= textInitials($title, 2); ?></span>
                                </span>

                                <div class="inner clearfix">
                                    <div class="action">
                                        <?= $title ?>
                                    </div>

                                    <div class="meta mr-20">
                                        <?php if(!empty($a->get("proxy"))): ?>
                                            <?= $a->get("proxy") ?>
                                        <?php else: ?>
                                            No proxy
                                        <?php endif; ?>
                                    </div>

                                    <div class="buttons clearfix">
                                        <a class="button small button--light-outline" onclick="ProxyManager.SetProxyForm(<?= $a->get("id"); ?>)">
                                            <?= __("Set Proxy") ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="arp-amount-of-action">
                    <?= __("Total %s accounts", $Accounts->getTotalCount()) ?>
                </div>

                <?php if($Accounts->getPage() < $Accounts->getPageCount()): ?>
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
                        <a class="fluid button button--light-outline js-loadmore-btn" data-loadmore-id="2" href="<?= $url.($Accounts->getPage()+1) ?>">
                            <span class="icon sli sli-refresh"></span>
                            <?= __("Load More") ?>
                        </a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="no-data">
                    <p><?= __("there is no account for %s", htmlchars($User->get("firstname")." ".$User->get("lastname"))) ?></p>
                </div>
            <?php endif ?>
        </section>
    </div>
</div>