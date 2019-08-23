<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class="skeleton skeleton--full">
    <div class="clearfix">
        <aside class="skeleton-aside hide-on-medium-and-down">
            <div class="aside-list js-loadmore-content" data-loadmore-id="1"></div>

            <div class="loadmore pt-20 none">
                <a class="fluid button button--light-outline js-loadmore-btn js-autoloadmore-btn" data-loadmore-id="1" href="<?= APPURL."/e/".$idname."?aid=".$Account->get("id")."&ref=duplicate" ?>">
                    <span class="icon sli sli-refresh"></span>
                    <?= __("Load More") ?>
                </a>
            </div>
        </aside>

        <section class="skeleton-content">
            <form class="js-auto-like-duplicate-form"
                  action="<?= APPURL."/e/".$idname."/".$Account->get("id") . "/duplicate" ?>"
                  method="POST">

                <input type="hidden" name="action" value="save">

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

                <div class="al-tab-heads clearfix">
                    <a href="<?= APPURL."/e/".$idname."/".$Account->get("id") ?>"><?= __("Target & Settings") ?></a>
                    <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/log" ?>"><?= __("Activity Log") ?></a>
                    <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/duplicate" ?>" class="active"><?= __("Duplicate Settings") ?></a>

                </div>

                <div class="section-content">
                    <div class="form-result mb-25" style="display:none;"></div>

                    <div class="clearfix">
                   

                    <div class="col s12 m10 l8">

                    <ul class="field-tips mb-20">
                                <p><?= __("Duplicate settings from <b>" .htmlchars($Account->get("username")) . "</b> to selected user."  ) ?></p>

                                 
                            </ul>
                    <div class="mb-20">
                        <label>
                            <input type="checkbox" 
                                    class="checkbox" 
                                    name="duplicate-target"
                                    value="1">
                            <span>
                                <span class="icon unchecked">
                                    <span class="mdi mdi-check"></span>
                                </span>
                                <?= __('Select to include Targets') ?>
                            </span>
                        </label>
                    </div>
                        <div class="col s12 m12 l6 mb-20">

                            <select class="selectpicker"  multiple data-actions-box="true" name="select_user" multiple>
                            <?php foreach ($Accounts->getDataAs("Account") as $a): ?>

                            <?php if($a->get("id") !==  $Account->get("id")) {
                                 $print_account = true;
                                 } else{
                                    $print_account =false;
                                } ?>

                            <?php if ($print_account): ?>
                            <option value="<?= $a->get("id"); ?>"><?= htmlchars($a->get("username"));?></option>
                        
                            <?php endif ?>
                            <?php endforeach ?>
                            </select>

                        </div>
                                    <div class="col s12 m12 l4 l-last">
                                        <input class="fluid button" type="submit" value="<?= __("Save") ?>">
                                    <div class="">

                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>






