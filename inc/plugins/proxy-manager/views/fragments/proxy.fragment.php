<?php if (!defined('APP_VERSION')) {
    die("Yo, what's up?");
} ?>

<div class="skeleton skeleton--full" id="user">
    <div class="clearfix">
        <aside class="skeleton-aside hide-on-medium-and-down">

            <?php
                $form_action = APPURL."/e/".$idname;
                include APPPATH."/views/fragments/aside-search-form.fragment.php";
            ?>

            <div class="js-search-results">
                <div class="aside-list js-loadmore-content" data-loadmore-id="1"></div>

                <div class="loadmore pt-20 none">
                    <a class="fluid button button--light-outline js-loadmore-btn js-autoloadmore-btn"
                       data-loadmore-id="1" href="<?= APPURL."/e/".$idname."?aid=".$Proxy->get("id") ?>">
                        <span class="icon sli sli-refresh"></span>
                        <?= __("Load More") ?>
                    </a>
                </div>
            </div>
        </aside>

        <section class="skeleton-content">
            <form class="js-proxy-manager-proxy-form"
                  action="<?= APPURL."/e/".$idname."/".($Proxy->isAvailable() ? $Proxy->get("id") : "new") ?>"
                  method="POST">

                <input type="hidden" name="action" value="save">

                <div class="section-header clearfix">
                    <h2 class="section-title"><?= $Proxy->isAvailable() ? htmlchars($Proxy->get("proxy").($Proxy->get("country_code") ? " - ".$Proxy->get("country_code") : "")) : __("New Proxy") ?></h2>
                </div>

                <?php if($Proxy->isAvailable()): ?>
                    <?php require_once(__DIR__.'/tab.fragment.php'); ?>
                <?php endif; ?>

                <div class="section-content">
                    <div class="form-result"></div>

                    <div class="clearfix">
                        <div class="col s12 m12 l8">
                            <div class="mb-20">
                                <label class="form-label">
                                    <?= __("Proxy") ?>
                                    <span class="compulsory-field-indicator">*</span>
                                </label>

                                <input class="input js-required"
                                       name="proxy"
                                       value="<?= htmlchars($Proxy->get("proxy")) ?>"
                                       type="text"
                                       maxlength="255">

                                <ul class="field-tips">
                                    <li><?= __("Proxy should match following pattern: http://ip:port OR http://username:password@ip:port") ?></li>
                                </ul>
                            </div>
                            <div class="clearfix mb-20">
                                <div class="col s6 m6 l6">
                                    <label class="form-label">
                                        <?= __("Limit Usage") ?>
                                    </label>

                                    <input class="input js-required"
                                           name="limit-usage"
                                           value="<?= $Proxy->isAvailable() ? $Proxy->get("limit_usage") : 0 ?>"
                                           type="number"
                                           maxlength="255">
                                </div>

                                <div class="col s6 s-last m6 m-last l6 l-last">
                                    <label class="form-label"><?= __('Package') ?></label>

                                    <select class="input" name="package-id">
                                        <option value="-2" <?= $Proxy->get("package_id") == -2  ? "selected" : "" ?>></option>
                                        <option value="-1" <?= $Proxy->get("package_id") == -1  ? "selected" : "" ?>><?= __("All Pack") ?></option>
                                        <option value="0" <?= $Proxy->get("package_id")==0 ? "selected" : "" ?>><?= __("Free Trial") ?></option>

                                        <?php foreach ($Packages->getDataAs("Package") as $p): ?>
                                            <option value="<?= $p->get("id") ?>" <?= $p->get("id") == $Proxy->get("package_id") ? "selected" : "" ?>>
                                                <?= htmlchars($p->get("title")) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>

                            <div class="clearfix mb-20">

                                <div class="col s12 m12 l12">
                                    <label class="form-label"><?= __("Country") ?>
                                        <?php if(!$Proxy->isAvailable()): ?>
                                        <span class="mdi mdi-refresh refresh-country"></span>
                                        <?php endif ?>
                                    </label>

                                    <select class="input combobox" name="country">
                                        <option value=""><?= __("Unknown") ?></option>
                                        <?php foreach ($Countries as $k => $v): ?>
                                            <option value="<?= $k ?>" <?= $k == $Proxy->get("country_code") ? 'selected' : "" ?>><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <?php if($Proxy->isAvailable()): ?>
                            <div class="clearfix mb-20">
                                <div class="col s12 m12 l12">
                                    <label class="form-label"><?= __("Replace Proxy") ?></label>

                                    <div class="clearfix mb-20">
                                        <input class="input js-required"
                                               name="replace-proxy"
                                               value="<?= htmlchars($Proxy->get("replace_proxy")) ?>"
                                               type="text"
                                               maxlength="255">
                                        <ul class="field-tips">
                                            <li><?= __("Replace all account using this proxy ( Leave empty if you don't want to replace )") ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="clearfix">
                                <div class="col s12 m6 l6">
                                    <input class="fluid button" type="submit" value="<?= __("Save") ?>">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>