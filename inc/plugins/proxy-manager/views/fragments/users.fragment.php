<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class="skeleton skeleton--full" id="users">
    <div class="clearfix">
        <aside class="skeleton-aside">

            <?php
                $form_action = APPURL."/e/".$idname."/users";
                include APPPATH."/views/fragments/aside-search-form.fragment.php";
            ?>

            <div class="js-search-results">
                <?php if ($Users->getTotalCount() > 0): ?>
                    <?php $active_item_id = Input::get("aid"); ?>
                    <div class="aside-list js-loadmore-content" data-loadmore-id="1">
                        <?php foreach ($Users->getDataAs("User") as $u): ?>
                            <div class="aside-list-item js-list-item <?= $active_item_id == $u->get("id") ? "active" : "" ?>">
                                <div class="clearfix">
                                    <?php $title = htmlchars($u->get("firstname")." ".$u->get("lastname")); ?>
                                    <span class="circle">
                                                <span><?= textInitials($title, 2); ?></span>
                                            </span>

                                    <div class="inner">
                                        <div class="title"><?= $title ?></div>
                                        <?php
                                        if ($u->get("id") == $AuthUser->get("id")) {
                                            $sub = __("Your account");
                                        } else if ($u->isAdmin()) {
                                            $sub = __("Admin");
                                        } else {
                                            $sub = __("Regular user");
                                        }
                                        ?>
                                        <div class="sub"><?= $sub ?></div>

                                        <div class="meta">
                                            <?php if ($u->isExpired()): ?>
                                                <span class="color-primary">
                                                            <span class="mdi mdi-history"></span>
                                                    <?= __("Expired") ?>
                                                        </span>
                                            <?php elseif ($u->get("is_active")): ?>
                                                <span class="color-success">
                                                            <span class="mdi mdi-check-circle"></span>
                                                    <?= __("Active") ?>
                                                        </span>
                                            <?php else: ?>
                                                <span class="color-danger">
                                                            <span class="mdi mdi-close-circle"></span>
                                                    <?= __("Deactive") ?>
                                                        </span>
                                            <?php endif; ?>

                                            <?php if ($u->get("title")): ?>
                                                <span>
                                                            <span class="mdi mdi-package-variant"></span>
                                                    <?= htmlchars($u->get("title")) ?>
                                                        </span>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <?php if ($AuthUser->canEdit($u)): ?>
                                        <a class="full-link js-ajaxload-content" href="<?= APPURL."/e/".$idname."/users/".$u->get("id") ?>"></a>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>

                    <?php if($Users->getPage() < $Users->getPageCount()): ?>
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
                            <a class="fluid button button--light-outline js-loadmore-btn" data-loadmore-id="1" href="<?= $url.($Users->getPage()+1) ?>">
                                <span class="icon sli sli-refresh"></span>
                                <?= __("Load More") ?>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if ($Users->searchPerformed()): ?>
                        <p class="search-no-result">
                            <?= __("Couldn't find any result for your search query.") ?>
                        </p>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </aside>

        <section class="skeleton-content hide-on-medium-and-down">
            <div class="no-data">
                <span class="no-data-icon sli sli-user"></span>
                <p><?= __("Please select a user from left side list to view or modify it's details.") ?></p>
            </div>
        </section>
    </div>
</div>