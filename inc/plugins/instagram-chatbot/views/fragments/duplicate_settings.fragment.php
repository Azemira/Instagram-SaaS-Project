<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class="section-content">
    <?php $idname = "instagram-chatbot"; ?>
    <form class="js-chatboot-duplicate-form" action="<?= APPURL . "/" . $idname . "/" . $Account->get("id") . "/duplicate" ?>" method="POST">

        <input type="hidden" name="action" value="save">

        <div class="section-content">
            
            <div class="clearfix">
                    <div class="form-result mb-25" style="display:none;"></div>

                <div class="col s12 m10 l8">

                    <ul class="field-tips mb-20">
                        <p><?= __("Duplicate settings from <b>" . htmlchars($Account->get("username")) . "</b> to selected user.") ?></p>


                    </ul>
                    <div class="col s12 m12 l6 mb-20">

                        <select class="selectpicker" multiple data-actions-box="true" name="select_user" multiple>
                            <?php foreach ($Accounts->getDataAs("Account") as $a) : ?>

                            <?php if ($a->get("id") !==  $Account->get("id")) {
                                    $print_account = true;
                                } else {
                                    $print_account = false;
                                } ?>

                            <?php if ($print_account) : ?>
                            <option value="<?= $a->get("id"); ?>"><?= htmlchars($a->get("username")); ?></option>

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
</div>