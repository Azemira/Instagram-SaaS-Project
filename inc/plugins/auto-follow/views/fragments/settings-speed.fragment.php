<div class="settings-speed">
                            <div class="mb-10 clearfix">
                            <section class="section mb-20">
                                <div class="section-header">
                            <h2 class="section-title"><?= __(ucfirst(str_replace("-", " ", $settings_tab))." Speed settings") ?></h2>
                        </div>
                        <?php 
                            $speed = $SpeedSettings[$settings_tab];
                        ?>
                        <div class="section-content">
                    
                         <div class="mb-20">
                                <label for="form-label"><?= __("Delay each follow per operation:") ?></label><br>
                                Min<select name="<?= $settings_tab ?>-wait-from" class="input">
                                    <?php for ($i=1; $i<=200; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $speed["wait-from"] ? "selected" : "" ?>>
                                        <?= n__($i == 1 ? "%s minute" : "%s minutes", $i == 1 ? "%s minute" : "%s minutes", $i, $i) ?>                                                                    
                                        </option>
                                    <?php endfor; ?>
                                    </select>
                                Max<select name="<?= $settings_tab ?>-wait-to" class="input">
                                    <?php for ($i=1; $i<=200; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $speed["wait-to"] ? "selected" : "" ?>>
                                        <?= n__($i == 1 ? "%s minute" : "%s minutes", $i == 1 ? "%s minute" : "%s minutes", $i, $i) ?>                                                       
                                        </option>
                                    <?php endfor; ?>
                                    </select>
                            </div>
                            
                            <div class="mb-20">
                                <label for="form-label"><?= __("Follows Limit:") ?></label><br>
                                Min<select name="<?= $settings_tab ?>-comment-limit-min" class="input">
                                    <?php for ($i=1; $i<=100; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $speed["comment-limit-min"] ? "selected" : "" ?>>
                                        <?= n__($i == 1 ? "%s comment" : "%s comments", $i == 1 ? "%s comment" : "%s comments", $i, $i) ?>                                                                    
                                        </option>
                                    <?php endfor; ?>
                                    </select>
                                Max<select name="<?= $settings_tab ?>-comment-limit-max" class="input">
                                    <?php for ($i=1; $i<=100; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $speed["comment-limit-max"] ? "selected" : "" ?>>
                                            <?= n__($i == 1 ? "%s comment" : "%s comments", $i == 1 ? "%s comment" : "%s comments", $i, $i) ?>                                                    
                                        </option>
                                    <?php endfor; ?>
                                    </select>
                            </div>

                            <div class="mb-20">
                                <label for="form-label"><?= __("Delay each follow per operation:") ?></label><br>
                                Min<select name="<?= $settings_tab ?>-delay-secconds-from" class="input">
                                    <?php for ($i=1; $i<=160; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $speed["delay-secconds-from"] ? "selected" : "" ?>>
                                        <?= n__($i == 1 ? "%s sec" : "%s sec", $i == 1 ? "%s sec" : "%s sec", $i, $i) ?>                                                                    
                                        </option>
                                    <?php endfor; ?>
                                    </select>
                                Max<select name="<?= $settings_tab ?>-delay-secconds-to" class="input">
                                    <?php for ($i=1; $i<=160; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $speed["delay-secconds-to"] ? "selected" : "" ?>>
                                        <?= n__($i == 1 ? "%s sec" : "%s sec", $i == 1 ? "%s sec" : "%s sec", $i, $i) ?>                                                     
                                        </option>
                                    <?php endfor; ?>
                                    </select>
                            </div>

                            <div class="mb-20">
                                <label for="form-label"><?= __("Follows Per Day Limit:") ?></label><br>
                                Limit<select name="<?= $settings_tab ?>-comment-per-day-limit" class="input">
                                    <?php for ($i=1; $i<=160; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == $speed["comment-per-day-limit"] ? "selected" : "" ?>>
                                        <?= n__($i == 1 ? "%s comment" : "%s comments", $i == 1 ? "%s comment" : "%s comments", $i, $i) ?>                                                                  
                                        </option>
                                    <?php endfor; ?>
                                    </select>
                            </div>
                        </div>
                    </section>
                            </div>
                        </div>