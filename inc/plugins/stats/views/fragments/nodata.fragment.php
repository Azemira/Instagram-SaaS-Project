<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class="skeleton">
    <div class="container-1200">
        <section class="">
            <div class="no-data">
                    <p><?= __("You haven't add any Instagram account yet or something is wrong with your account") ?></p>
                    <a class="small button" href="<?= APPURL."/accounts" ?>">
                        <span class="sli sli-user-follow"></span>
                        <?= __("My Accounts") ?>
                    </a>
            </div>
        </section>
    </div>
</div>