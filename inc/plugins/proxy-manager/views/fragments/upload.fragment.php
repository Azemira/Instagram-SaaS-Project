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
                       data-loadmore-id="1" href="<?= APPURL."/e/".$idname; ?>">
                        <span class="icon sli sli-refresh"></span>
                        <?= __("Load More") ?>
                    </a>
                </div>
            </div>
        </aside>

        <section class="skeleton-content hide-on-medium-and-down">
            <?php if (empty($UploadResult)): ?>
                <form class="js-proxy-manager-upload-form" action="<?= APPURL . "/e/".$idname."/upload" ?>" method="POST">
                    <input type="hidden" name="action" value="upload">
                        <div class="to-middle">
                            <section class="section border">
                                <div class="section-content">
                                    <div class="form-result"></div>

                                    <div class="mb-20">
                                        <ul class="field-tips">
                                            <li><?= __('Choose your csv file and click "Upload" button') ?></li>
                                        </ul>
                                    </div>

                                    <div>
                                        <label>
                                            <input class="fileinp" name="file"
                                                   data-label="<?= __("Choose CSV File") ?>"
                                                   type="file" value="">
                                            <div>
                                                <?= __("Choose CSV File") ?>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <input class="fluid button button--footer" type="submit" value="<?= __("Upload") ?>">
                            </section>
                        </div>
                </form>
            <?php else: ?>
                <div class="minipage">
                    <?php if ($UploadResult->resp == 1): ?>
                        <div class="to-middle">
                            <h1 class="page-primary-title"><?= __('Success!') ?></h1>

                            <p><?= __("Proxies has been uploaded successfully!") ?></p>

                            <a href="<?= APPURL."/e/".$idname ?>" class="small button"><?= __("View Proxies") ?></a>
                        </div>
                    <?php else: ?>
                        <div class="to-middle">
                            <h1 class="page-primary-title"><?= __('Error!') ?></h1>
                            <p><?= __('An error occured during the upload process! Please try again later!') ?></p>

                            <div class="system-error">
                                <?= $UploadResult->msg ?>
                            </div>

                            <a href="<?= APPURL."/e/".$idname."/upload" ?>" class="small button"><?= __('Try Again') ?></a>
                        </div>
                    <?php endif ?>
                </div>
            <?php endif ?>
        </section>
    </div>
</div>