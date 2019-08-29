        <div class='skeleton' id="account">
            <form class="js-ajax-form" 
                  action="<?= APPURL . "/accounts/" . ($Account->isAvailable() ? $Account->get("id") : "new") ?>"
                  method="POST"
                  autocomplete="off">
                <input type="hidden" name="action" value="save">

                <div class="container-1200">
                    <div class="row clearfix">
                        <?php if ($Pages->get("data.aa_page.notice")): ?>
                            <div class="col s12 m12 l12 js-hide-aa-notice none">
                                <?php
                                    $n_color = "#fff;";
                                    $n_border = "";
                                    if (($Pages->get("data.aa_page.notice_color")) == "1") {
                                        $n_color = "#ffd2d2;";
                                        $n_border = "border-color: #ffd2d2;";
                                    } else if (($Pages->get("data.aa_page.notice_color")) == "2") {
                                        $n_color = "#ddffd2;";
                                        $n_border = "border-color: #ddffd2;";
                                    } else if (($Pages->get("data.aa_page.notice_color")) == "3") {
                                        $n_color = "#ffd78c;";
                                        $n_border = "border-color: #ffd78c;";
                                    } else if (($Pages->get("data.aa_page.notice_color")) == "4") {
                                        $n_color = "#bbd1ff;";
                                        $n_border = "border-color: #bbd1ff;";
                                    } 
                                ?>
                                <section class="section mb-20" style="<?= $n_border ?>">
                                    <div class="section-content aa-notice" style="background-color: <?= $n_color ?>; ">
                                        <?= ($Pages->get("data.aa_page.notice")) ?>
                                        <?php if ($Pages->get("data.aa_page.notice_buttons")): ?>
                                            <a class="button small yes"><?= __('I Agree') ?></a>
                                            <a class="button small no" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><?= __('Go Back') ?></a>
                                        <?php endif ?>
                                    <div>
                                </section>        
                            </div>
                        <?php endif ?>
                        <div class="col s12 m8 l4 mb-20">
                            <section class="section">
                                <div class="section-content">
                                    <div class="form-result">
                                    </div>

                                    <div class="js-login">
                                        <div class="mb-20">
                                            <label class="form-label">
                                                <?= __("Username") ?>
                                                <span class="compulsory-field-indicator">*</span>    
                                            </label>

                                            <input class="input js-required"
                                                   name="username" 
                                                   type="text" 
                                                   value="<?= htmlchars($Account->get("username")) ?>" 
                                                   placeholder="<?= __("Enter username") ?>"
                                                   maxlength="30">
                                        </div>

                                        <div class="">
                                            <label class="form-label">
                                                <?= __("Password") ?>
                                                <span class="compulsory-field-indicator">*</span>    
                                            </label>

                                            <input class="input js-required"
                                                   name="password" 
                                                   type="password" 
                                                   placeholder="<?= __("Enter password") ?>">
                                        </div>

                                        <?php if ($Settings->get("data.proxy") && $Settings->get("data.user_proxy")): ?>
                                            <div class="mt-20">
                                                <label class="form-label"><?= __("Proxy") ?> (<?= ("Optional") ?>)</label>

                                                <input class="input"
                                                       name="proxy" 
                                                       type="text" 
                                                       value="<?= htmlchars($Account->get("proxy_added_by_user") ? $Account->get("proxy") : "") ?>"
                                                       placeholder="<?= __("Proxy for your country") ?>">
                                            </div>

                                            <ul class="field-tips">
                                                <li><?= __("Proxy should match following pattern: http://ip:port OR http://username:password@ip:port") ?></li>
                                                <li><?= __("It's recommended to to use a proxy belongs to the country where you've logged in this acount in Instagram's official app or website.") ?></li>
                                            </ul>
                                        <?php endif ?>
                                    </div>

                                    <div class="js-2fa none">
                                        <input type="hidden" name="2faid" value="" disabled>

                                        <div class="mb-20">
                                            <label class="form-label">
                                                <?= __("Security Code") ?>
                                                <span class="compulsory-field-indicator">*</span>    
                                            </label>

                                            <input class="input js-required"
                                                   name="twofa-security-code"
                                                   type="text" 
                                                   value="" 
                                                   placeholder="<?= __("Enter security code") ?>"
                                                   maxlength="8"
                                                   disabled>
                                        </div>

                                        <div>
                                            <div class="js-not-received-security-code">
                                                <?= __("Didn't get a security code?") ?>
                                                <a class="resend-btn" href='javascript:void(0)'>
                                                    <?= __("Resend it") ?>
                                                    <span class="timer" data-text="<?= __("after %s seconds", "{seconds}") ?>"></span>
                                                </a>
                                            </div>
                                            <div class="resend-result color-danger fz-12"></div>
                                        </div>

                                        <p class="backup-note">
                                            <?= 
                                                __(
                                                    "If you're unable to receive a security code, use one of your <a href='{url}' target='_blank'>backup codes</a>.", 
                                                    ["{url}" => "https://help.instagram.com/1006568999411025"]
                                                );
                                            ?>
                                        </p>
                                    </div>


                                    <div class="js-challenge none">
                                        <input type="hidden" name="challengeid" value="" disabled>

                                        <div class="mb-20">
                                            <label class="form-label">
                                                <?= __("Security Code") ?>
                                                <span class="compulsory-field-indicator">*</span>    
                                            </label>

                                            <input class="input js-required"
                                                   name="challenge-security-code"
                                                   type="text" 
                                                   value="" 
                                                   placeholder="<?= __("Enter security code") ?>"
                                                   maxlength="6"
                                                   disabled>
                                        </div>

                                        <div>
                                            <div class="js-not-received-security-code">
                                                <?= __("Didn't get a security code?") ?>
                                                <a class="resend-btn" href='javascript:void(0)'>
                                                    <?= __("Resend it") ?>
                                                    <span class="timer" data-text="<?= __("after %s seconds", "{seconds}") ?>"></span>
                                                </a>
                                            </div>
                                            <div class="resend-result color-danger fz-12"></div>
                                        </div>

                                        <p class="backup-note">
                                            <?= 
                                                __("You should receive the 6 digit security code sent by Instagram.");
                                            ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="js-login">
                                    <input class="fluid button button--footer js-login" type="submit" value="<?= $Account->isAvailable() ? __("Save changes") :  __("Add account") ?>">
                                </div>

                                <div class="js-2fa js-challenge js-challenge-phone none">
                                    <input class="fluid button button--footer" type="submit" value="<?= __("Confirm") ?>">
                                </div>
                            </section>
                        </div>
                        <?php if ($Pages->get("data.aa_page.message")): ?>
                            <div class="col s12 m8 l8 mr-0 js-hide-aa-message none">
                                <section class="section">
                                    <div class="section-content aa-message">
                                        <?= ($Pages->get("data.aa_page.message")) ?>
                                    <div>
                                </section>        
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </form>
        </div>
        