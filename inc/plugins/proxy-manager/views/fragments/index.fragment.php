<?php if (!defined('APP_VERSION')) {
    die("Yo, what's up?");
} ?>

<div class="skeleton skeleton--full" id="proxies">
    <div class="clearfix">
        <aside class="skeleton-aside">

            <?php
                $form_action = APPURL."/e/".$idname;
                include APPPATH."/views/fragments/aside-search-form.fragment.php";
            ?>

            <div class="js-search-results">
                <?php if ($Proxies->getTotalCount() > 0): ?>
                    <?php $active_item_id = Input::get("aid"); ?>
                    <div class="aside-list js-loadmore-content" data-loadmore-id="1">
                        <?php foreach ($Proxies->getDataAs("Proxy") as $p): ?>
                            <div class="aside-list-item js-list-item <?= $active_item_id == $p->get("id") ? "active" : "" ?>">
                                <div class="clearfix">
                                            <span class="circle">
                                                <span><?= textInitials($p->get("country_code") ? $p->get("country_code") : "..", 2); ?></span>
                                            </span>

                                    <div class="inner">
                                        <div class="title"><?= htmlchars($p->get("proxy")) ?></div>
                                        <?php if (isset($Countries[$p->get("country_code")])): ?>
                                            <div class="sub"><?= $Countries[$p->get("country_code")] ?></div>
                                        <?php endif ?>

                                        <div class="meta">
                                            <?php  $remain = $p->get("limit_usage") - $p->get("assign_count"); ?>
                                            <?php if($remain > 0): ?>
                                                <span style="color:green;"><?= n__("One left", "%s left", $remain, $remain) ?></span>
                                            <?php else: ?>
                                                <span style="color:red;"><?= __("Out of usage") ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="options context-menu-wrapper">
                                        <a href="javascript:void(0)" class="mdi mdi-dots-vertical"></a>

                                        <div class="context-menu">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)"
                                                       class="js-remove-list-item"
                                                       data-id="<?= $p->get("id") ?>"
                                                       data-url="<?= APPURL."/e/".$idname ?>">
                                                        <?= __("Delete") ?>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <a class="full-link js-ajaxload-content" href="<?= APPURL."/e/".$idname."/".$p->get("id") ?>"></a>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>

                    <?php if($Proxies->getPage() < $Proxies->getPageCount()): ?>
                        <div class="loadmore mt-20">
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
                            <a class="fluid button button--light-outline js-loadmore-btn" data-loadmore-id="1" href="<?= $url.($Proxies->getPage()+1) ?>">
                                <span class="icon sli sli-refresh"></span>
                                <?= __("Load More") ?>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php elseif ($Proxies->searchPerformed()): ?>
                    <p class="search-no-result">
                        <?= __("Couldn't find any result for your search query.") ?>
                    </p>
                <?php else: ?>
                    <div class="no-data">
                        <p><?= __("There is not any proxy address yet. Click the button below to add your first proxy address.") ?></p>
                        <a class="small button" href="<?= APPURL."/e/".$idname."/new" ?>">
                            <span class="mdi mdi-plus-circle"></span>
                            <?= __("Add New") ?>
                        </a>
                    </div>
                <?php endif ?>
            </div>
        </aside>

        <section class="skeleton-content hide-on-medium-and-down">
            <div class="no-data">
                <span class="no-data-icon mdi mdi-server-security"></span>
                <p><?= __("Please select a proxy from left side list to view or modify it's details.") ?></p>
            </div>
        </section>
    </div>
</div>