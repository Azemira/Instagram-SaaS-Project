<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class='skeleton' id="account">
    <form class="" 
          action="<?= APPURL . "/chatbot/admin/settings" ?>"
          method="POST">
        <input type="hidden" name="action" value="settings">

        <div class="container-1200">
            <div class="row clearfix">
                <div class="form-result">
                </div>

                <div class="col s12 m8 l4">
                    <section class="section mb-20">
                        <div class="section-header">
                            <h2 class="section-title"><?= __("Messages Check settings") ?></h2>
                        </div>

                        <div class="section-content">

                            <div class="mb-20">
                                <label for="form-label"><?= __("Messages request check:") ?></label><br>
                                Min<input class="input" name="pending-from" type="text" value="<?= $PendingFrom !== '' ? $PendingFrom: '' ?>" placeholder="Min" >
                                Max<input class="input" name="pending-to" type="text" value="<?= $PendingTo !== '' ? $PendingTo: '' ?>" placeholder="Max" >
                            </div>
                            <div class="mb-20">
                                <label for="form-label"><?= __("New conversation check:") ?></label><br>
                                Min<input class="input" name="conversation-from" type="text" value="<?= $NewConversationFrom !== '' ? $NewConversationFrom: '' ?>" placeholder="Min" >
                                Max<input class="input" name="conversation-to" type="text" value="<?= $NewConversationTo !== '' ? $NewConversationTo: '' ?>" placeholder="Max" >
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col s12 m8 l4">
                    <section class="section mb-20">
                        <div class="section-header">
                            <h2 class="section-title"><?= __("Messages sending Speed settings") ?></h2>
                        </div>

                        <div class="section-content">
                        
                            <div class="mb-20">
                                <label for="form-label"><?= __("Fast speed:") ?></label><br>
                                Min<input class="input" name="fast-speed-from" type="text" value="<?= $FastSpeedFrom !== '' ? $FastSpeedFrom: '' ?>" placeholder="Min" >
                                Max<input class="input" name="fast-speed-to" type="text" value="<?= $FastSpeedTo !== '' ? $FastSpeedTo: '' ?>" placeholder="Max" >
                            </div>
                            
                            <div class="mb-20">
                                <label for="form-label"><?= __("Slow speed:") ?></label><br>
                                Min<input class="input" name="slow-speed-from" type="text" value="<?= $SlowSpeedFrom !== '' ? $SlowSpeedFrom: '' ?>" placeholder="Min" >
                                Max<input class="input" name="slow-speed-to" type="text" value="<?= $SlowSpeedTo !== '' ? $SlowSpeedTo: '' ?>" placeholder="Max" >
                            </div>
                         
                        </div>
                    </section>


                    <section class="section">

                        <input class="fluid button button--footer" type="submit" value="<?= __("Save") ?>">
                    </section>
                </div>
            </div>
        </div>
    </form>
</div>