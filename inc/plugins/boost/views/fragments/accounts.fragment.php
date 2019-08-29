<?php
namespace Plugins\Boost;
if (!defined('APP_VERSION')) die("Yo, what's up?"); 
?>

    <div class="clearfix">
            <?php if ($Accounts->getTotalCount() > 0): ?>
                <?php $active_item_id = \Input::get("aid"); ?>
                <div class="aside-list js-loadmore-content" data-loadmore-id="1">
                    <?php
                      $pics = (array)$AuthUser->get("data.accpics");
                      foreach ($Accounts->getDataAs("Account") as $a):
                    ?>
                        <div class="aside-list-item js-list-item <?= $active_item_id == $a->get("id") ? "active" : "" ?>">
                            <div class="clearfix">
                              <?php $title = htmlchars($a->get("username")); ?>
                              <?php if(isset($pics[$a->get("username")]) && $pics[$a->get("username")] != "") : ?>
                              <img class="circle" src="<?= $pics[$a->get("username")] ?>">
                              <?php else : ?>
                                <span class="circle">
                                    <span><?= textInitials($title, 2); ?></span>
                                </span>
                              <?php endif; ?>

                                <div class="inner">
                                    <div class="title"><?= $title ?></div>
                                    <div class="sub">
                                        <?= __("Instagram user") ?>

                                        <?php if ($a->get("login_required")): ?>
                                            <span class="color-danger ml-5">
                                                <span class="mdi mdi-information"></span>    
                                                <?= __("Re-login required!") ?>
                                            </span>
                                        <?php endif ?>    
                                    </div>
                                </div>
                                <a class="full-link" href="<?= APPURL."/e/".$idname."/".$a->get("id")."/wizard" ?>" target="_top"></a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>

                <?php if($Accounts->getPage() < $Accounts->getPageCount()): ?>
                    <div class="loadmore mt-20">
                        <?php 
                            $url = parse_url($_SERVER["REQUEST_URI"]);
                            $path = $url["path"];
                            if(isset($url["query"])){
                                $qs = parse_str($url["query"], $qsarray);
                                unset($qsarray["page"]);

                                $url = $path."?".(count($qsarray) > 0 ? http_build_query($qsarray)."&" : "")."page=";
                            }else{
                                $url = $path."?page=";
                            }
                        ?>
                        <a class="fluid button button--light-outline js-loadmore-btn" data-loadmore-id="1" href="<?= $url.($Accounts->getPage()+1) ?>">
                            <span class="icon sli sli-refresh"></span>
                            <?= __("Load More") ?>
                        </a>
                    </div>
                <?php endif; ?>
            <?php else: ?>

            <?php endif ?>


    </div>
