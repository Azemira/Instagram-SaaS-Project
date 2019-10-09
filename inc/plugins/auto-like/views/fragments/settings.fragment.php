<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class='skeleton' id="account">
    <form class="js-ajax-form" 
          action="<?= APPURL . "/e/" . $idname . "/settings" ?>"
          method="POST">
        <input type="hidden" name="action" value="save">

        <div class="container-1200">
            <div class="row clearfix">
                <div class="form-result">
                </div>

                <div class="col s12 m8 l4">
                    <section class="section mb-20">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Speeds Settings") ?></h2>
                        </div>


                   
                        <div class="section-content">
                        <div class="mb-20">
                                <label class="form-label"><?= __("Select Speed setings") ?></label>
                                <select id="speed-select" name="speed-select" class="input" onchange="openSettings(event, $('.speed-select').val())">>
                                    <option value=""  selected="selected">-select- </option>
                                    <option value="very-slow">Very slow </option>
                                    <option value="slow" >Slow </option>
                                    <option value="medium" >Medium </option>
                                    <option value="fast" >Fast </option>
                                    <option value="very-fast" >Very Fast </option>
                                </select>
                            </div>
                   

                         <div id="very-slow" class="tabcontent" >
                         <?php $settings_tab = "very-slow" ?>
                           <?php include(__DIR__.'/settings-speed.fragment.php'); ?>
                        </div> 
                        <div id="slow" class="tabcontent" >
                         <?php $settings_tab = "slow" ?>
                           <?php include(__DIR__.'/settings-speed.fragment.php'); ?>
                        </div> 
                        <div id="medium" class="tabcontent" >
                         <?php $settings_tab = "medium" ?>
                           <?php include(__DIR__.'/settings-speed.fragment.php'); ?>
                        </div> 
                        <div id="fast" class="tabcontent" >
                         <?php $settings_tab = "fast" ?>
                           <?php include(__DIR__.'/settings-speed.fragment.php'); ?>
                        </div>
                        <div id="very-fast" class="tabcontent" >
                         <?php $settings_tab = "very-fast" ?>
                           <?php include(__DIR__.'/settings-speed.fragment.php'); ?>
                        </div>



                            <ul class="field-tips">
                                <li><?= __("These values indicates maximum amount of the requests per hour. They are not exact values. Depending on the server overload and delays between the requests, actual number of the requests might be less than these values.") ?></li>
                                <li><?= __("High speeds might be risky") ?></li>
                                <li><?= __("Developers are not responsible for any issues related to the Instagram accounts.") ?></li>
                            </ul>
                        </div>
                    </section>
                </div>

                <div class="col s12 m8 l4">
                    <section class="section mb-20">
                        <div class="section-header">
                            <h2 class="section-title"><?= __("Timeline Feed Settings") ?></h2>
                        </div>

                        <div class="section-content">
                            <div class="mb-20">
                                <label class="form-label"><?= __("Refresh Interval") ?></label>
                                <select name="timeline-refresh-interval" class="input">
                                    <?php $s = $Settings->get("data.timeline.refresh_interval") ?>
                                    <?php for ($i=6; $i>=1; $i--): ?>
                                        <option value="<?= $i * 3600 ?>" <?= $i * 3600 == $s ? "selected" : "" ?>>
                                            <?= n__("%s hour", "%s hours", $i, $i) ?>                                             
                                        </option>
                                    <?php endfor; ?>
                                    <option value="1800" <?= $s == 1800 ? "selected" : "" ?>><?= n__("%s minute", "%s minutes", 30, 30) ?></option>
                                </select>
                            </div>

                            <div class="mb-20">
                                <label for="form-label"><?= __("Max. amount of posts") ?></label>
                                <select name="timeline-max-like" class="input">
                                    <?php $s = $Settings->get("data.timeline.max_like") ?>
                                    <?php for ($i=1; $i<=20; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $s ? "selected" : "" ?>>
                                            <?= $i ?>                                               
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <ul class="field-tips">
                                <li><?= __("Maximum amount of the posts to be liked in each refresh. Post will be selected in descending order.") ?></li>
                            </ul>
                        </div>
                    </section>


                    <section class="section">
                        <div class="section-header clearfix">
                            <h2 class="section-title"><?= __("Other Settings") ?></h2>
                        </div>

                        <div class="section-content">
                            <div class="mb-20">
                                <label>
                                    <input type="checkbox" 
                                           class="checkbox" 
                                           name="random_delay" 
                                           value="1" 
                                           <?= $Settings->get("data.random_delay") ? "checked" : "" ?>>
                                    <span>
                                        <span class="icon unchecked">
                                            <span class="mdi mdi-check"></span>
                                        </span>
                                        <?= __('Enable Random Delays') ?>
                                        (<?= __("Recommended") ?>)

                                        <ul class="field-tips">
                                            <li><?= __("If you enable this option, script will add random delays automatically between each requests.") ?></li>
                                            <li><?= __("Delays could be up to 5 minutes.") ?></li>
                                        </ul>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <input class="fluid button button--footer" type="submit" value="<?= __("Save") ?>">
                    </section>
                </div>
            </div>
        </div>
    </form>
</div>