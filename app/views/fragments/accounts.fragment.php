        <div class='skeleton' id="accounts">
            <div class="container-1200">
                <div class="row clearfix">
                    <?php if ($Accounts->getTotalCount() > 0) : ?>
                        <div class="box-list clearfix js-loadmore-content" data-loadmore-id="1">
                            <?php $number = ($Accounts->getPage() - 1) * $Accounts->getPageSize() + 1 ?>
                            <?php foreach ($Accounts->getDataAs("Account") as $a) : ?>
                                <div class="box-list-item text-c js-list-item">
                                    <div class="inner">
                                        <div class="circle"><span><?= $number++ ?></span></div>
                                        <div class="title"><?= htmlchars($a->get("username")) ?></div>
                                        <?php if ($a->get("login_required")) : ?>
                                            <a href="javascript:void(0)" class="js-re-connect re-connect" data-id="<?= $a->get("id") ?>" data-url="<?= APPURL . "/accounts" ?>"></a>
                                        <?php endif ?>

                                        <?php

                                                $date = new Moment\Moment($a->get("date"), date_default_timezone_get());
                                                $date->setTimezone($AuthUser->get("preferences.timezone"));
                                                $format = $AuthUser->get("preferences.dateformat");
                                                ?>
                                        <div class="sub" title="<?= $date->format("c") ?>">
                                            <?= __("Added on %s", $date->format($format)) ?>
                                        </div>

                                        <div class="quick-info">
                                            <?php if ($a->get("login_required")) : ?>
                                                <a class="color-danger js-re-connect" href="javascript:void(0)" data-id="<?= $a->get("id") ?>" data-url="<?= APPURL . "/accounts" ?>">
                                                    <span class='mdi mdi-information'></span>
                                                    <?= __("Re-login required!") ?>
                                                </a>
                                            <?php endif ?>
                                        </div>
                                        <!--Show errors info -->
                                        <div class="quick-info quick-info-error">
                                            <?php
                                                    $error_count = $this->countErrors($a->get("id"), $AuthUser->get("id"));
                                                    $checkIfErrorAppear = $this->checkIfErrorAppear($a->get("id"), $AuthUser->get("id"));
                                                    $display_num_of_errors = "";
                                                    $show_span = false;
                                                    if (!empty($checkIfErrorAppear[0]->error_count) && $error_count > $checkIfErrorAppear[0]->error_count) {
                                                        $show_danger_class = "color-danger";
                                                        $show_span = true;
                                                        $display_num_of_errors = $error_count - $checkIfErrorAppear[0]->error_count;
                                                    } else {
                                                        $show_danger_class = "";
                                                    }
                                                    ?>
                                            <?php if (!empty($checkIfErrorAppear[0]->errors_seen)) : ?>
                                                <a class="<?= $show_danger_class ?> " data-id="<?= $a->get("id") ?>" href="<?= APPURL . "/errors-overview/" . $a->get("id") ?>">
                                                    <?php if ($show_span) {
                                                                    echo "<span class='mdi mdi-information'></span>";
                                                                }
                                                                ?>
                                                    <?php if (!empty($display_num_of_errors)) {
                                                                    echo "$display_num_of_errors New Erros";
                                                                } else {
                                                                    echo "Error overview";
                                                                }
                                                                ?>
                                                <?php endif ?>
                                                <?php if (empty($checkIfErrorAppear[0]->errors_seen) && empty($checkIfErrorAppear[0]->error_count)) : ?>
                                                    <a href="javascript:void(0)" class="<?= $show_danger_class ?> enable-errors" data-id="<?= $a->get("id") ?>" data-url="<?= APPURL . "/errors-overview/" . $a->get("id") ?>">Enable error tracking
                                                    <?php endif ?>
                                                    </a>
                                        </div>

                                        <!-- INACTIVE PLUGINS PART -->

                                        <div class="quick-info inactive-plugins">
                                            <?php

                                                    $are_plugins_activated = $this->checkForActivePluggins($a->get("id"), $AuthUser->get("id"));
                                                    $print_inactive  = false;
                                                    $counter = 0;

                                                    foreach ($are_plugins_activated as $inner_array => $value) {

                                                        if ($value['active'] == 0) {
                                                            $counter++;
                                                            $print_inactive  = true;
                                                        }
                                                    }

                                                    if ($print_inactive) {

                                                        echo "<span class='color-danger ml-5'><span class='mdi mdi-information' style = 'white-space: normal;'> Inactive plugins</span></span><br>";
                                                        echo '<div class="inactivate-plugins-container">';
                                                        foreach ($are_plugins_activated as $inner_array => $inner_value) {
                                                            if ($inner_value['active'] == 0) {

                                                                echo  " <span><a href=" . APPURL . "/" . $inner_value['url'] . "/" . $a->get("id") . ">" . $inner_array . "</a></span>";

                                                                if ($counter > 1) {

                                                                    echo " | ";
                                                                }

                                                                $counter--;
                                                            }
                                                        }
                                                        echo "</div>";
                                                    } else {
                                                        echo "<span class='all-plugins-are-active'>All plugins are active</span>";
                                                    }

                                                    ?>

                                        </div>


                                    </div>

                                    <div class="options context-menu-wrapper">
                                        <a href="javascript:void(0)" class="mdi mdi-dots-vertical"></a>

                                        <div class="context-menu">
                                            <ul>
                                                <li>
                                                    <a href="<?= APPURL . "/accounts/" . $a->get("id") ?>">
                                                        <?= __("Edit") ?>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="javascript:void(0)" class="js-remove-list-item" data-id="<?= $a->get("id") ?>" data-url="<?= APPURL . "/accounts" ?>">
                                                        <?= __("Delete") ?>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div>
                                        <a class="fluid button button--footer" href="<?= "https://instagram.com/" . $a->get("username") ?>" target="_blank">
                                            <?= __("View timeline") ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <?php if ($Accounts->getPage() < $Accounts->getPageCount()) : ?>
                            <div class="loadmore">
                                <?php
                                        $url = parse_url($_SERVER["REQUEST_URI"]);
                                        $path = $url["path"];
                                        if (isset($url["query"])) {
                                            $qs = parse_str($url["query"], $qsarray);
                                            unset($qsarray["page"]);

                                            $url = $path . "?" . (count($qsarray) > 0 ? http_build_query($qsarray) . "&" : "") . "page=";
                                        } else {
                                            $url = $path . "?page=";
                                        }
                                        ?>
                                <a class="fluid button button--light-outline js-loadmore-btn" data-loadmore-id="1" href="<?= $url . ($Accounts->getPage() + 1) ?>">
                                    <span class="icon sli sli-refresh"></span>
                                    <?= __("Load More") ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <div class="no-data">
                            <?php if ($AuthUser->get("settings.max_accounts") == -1 || $AuthUser->get("settings.max_accounts") > 0) : ?>
                                <p><?= __("You haven't add any Instagram account yet. Click the button below to add your first account.") ?></p>
                                <a class="small button" href="<?= APPURL . "/accounts/new" ?>">
                                    <span class="sli sli-user-follow"></span>
                                    <?= __("New Account") ?>
                                </a>
                            <?php else : ?>
                                <p><?= __("You don't have a permission to add any Instagram account.") ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>