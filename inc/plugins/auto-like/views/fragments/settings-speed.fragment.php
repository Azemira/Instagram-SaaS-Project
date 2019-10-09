<div class="settings-speed">
    <div class="mb-10 clearfix">
        <section class="section mb-20">
            <div class="section-header">
                <h2 class="section-title"><?= __(ucfirst(str_replace("-", " ", $settings_tab)) . " Speed settings") ?></h2>
            </div>
            <?php
            $speed = $SpeedSettings[$settings_tab];
            ?>
            <div class="section-content">

                <div class="mb-20">
                    <label for="form-label"><?= __("Delay each like per operation:") ?></label><br>
                    Min<select name="<?= $settings_tab ?>-wait-from" class="input">
                        <?php for ($i = 1; $i <= 200; $i++) : ?>
                            <option value="<?= $i ?>" <?= $i == $speed["wait-from"] ? "selected" : "" ?>>
                                <?= n__($i == 1 ? "%s minute" : "%s minutes", $i == 1 ? "%s minute" : "%s minutes", $i, $i) ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                    Max<select name="<?= $settings_tab ?>-wait-to" class="input">
                        <?php for ($i = 1; $i <= 200; $i++) : ?>
                            <option value="<?= $i ?>" <?= $i == $speed["wait-to"] ? "selected" : "" ?>>
                                <?= n__($i == 1 ? "%s minute" : "%s minutes", $i == 1 ? "%s minute" : "%s minutes", $i, $i) ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
        </section>
    </div>
</div>