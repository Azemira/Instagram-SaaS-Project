<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class='skeleton' id="account">
    <form class="" action="<?= APPURL . "/e/" . $idname . "/settings" ?>" method="GET">
      <input type="hidden" name="log" value="1" />
        <div class="container-1200">
            <div class="row clearfix">
                <div class="form-result"></div>
              <div class="col s12 m12 l12 clearfix">
                <section class="section mb-20">
                  <div class="section-header clearfix">
                    <h2 class="section-title">
                        <a href="<?= APPURL . "/e/" . $idname . "/settings" ?>"><?= __("Go to ") . " " . __("Settings") ?></a>
                    </h2>
                  </div>
                </section>
              </div>
              
                <!-- start follow -->
                <div class="col s12 m12 l12 clearfix">
                    <section class="section mb-20">
                        <div class="section-header clearfix">
                          <h2 class="section-title"><?= __("Activity Log") ?></h2>
                        </div>
                        <div class="section-content">
                          <div class="mb-10 clearfix">
                            <div class="clearfix">
                              <div class="col s8 m8 l8">
                                <input class="input" name="s" value="<?= \Input::get("s"); ?>" placeholder="<?= __("search in log"); ?>" />
                              </div>
                              <div class="col s4 m4 l4 s-last m-last l-last">
                                <input class="fluid button button--outline" type="submit" value="<?= __("filter"); ?>">
                              </div>
                            </div>
                          </div>
                          <div class="mb-10 clearfix">
                            <div class="col s12 m12 l12">
                              
<?php if ($ActivityLog->getTotalCount() > 0): ?>
    <div class="boost-log-list js-loadmore-content" data-loadmore-id="2">
        <?php 
          $Emojione = new \Emojione\Client(new \Emojione\Ruleset());
          $boostPath = PLUGINS_PATH . "/boost/views/fragments/";
          foreach ($Logs as $l) : //echo '<p>' . $l->get("action") . '</p>';
              if($l->get("action") == "like") {
                require($boostPath.'/log.like.fragment.php');
              } elseif ($l->get("action") == "follow") {
                require($boostPath.'/log.follow.fragment.php');
              } elseif ($l->get("action") == "unfollow") {
                require($boostPath.'/log.unfollow.fragment.php');
              } elseif ($l->get("action") == "comment") {
                require($boostPath.'/log.comment.fragment.php');
              } elseif ($l->get("action") == "viewstory") {
                require($boostPath.'/log.viewstory.fragment.php');
              } elseif ($l->get("action") == "welcomedm") {
                require($boostPath.'/log.welcomedm.fragment.php');
              }
          endforeach;
      ?>
    </div>

    <div class="boost-amount-of-action">
        <?= __("Total %s actions", number_format($ActivityLog->getTotalCount(), 0, "", ".")) ?>
    </div>

    <?php if($ActivityLog->getPage() < $ActivityLog->getPageCount()): ?>
        <div class="loadmore mt-20 mb-20">
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
            <a class="fluid button button--light-outline js-loadmore-btn" data-loadmore-id="2" href="<?= $url.($ActivityLog->getPage()+1) ?>">
                <span class="icon sli sli-refresh"></span>
                <?= __("Load More") ?>
            </a>
        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="no-data">
        <p><?= __("Activity log for is empty") ?></p>
    </div>
<?php endif ?>
                              
                              
                            </div>
                          </div>
                        </div>
                    </section>
                </div>
                <!-- end follow -->
  
            </div>
        </div>
    </form>
</div>