<?php if (!defined('APP_VERSION')) die("Yo, what's up?"); ?>

<div class="skeleton skeleton--full">
    <div class="clearfix">
        
      <?php if(!$Settings->get("data.wizard")) : ?>
        <aside class="skeleton-aside hide-on-medium-and-down">
            <div class="aside-list js-loadmore-content" data-loadmore-id="1"></div>

            <div class="loadmore pt-20 mb-20 none">
                <a class="fluid button button--light-outline js-loadmore-btn js-autoloadmore-btn" data-loadmore-id="1" href="<?= APPURL."/e/".$idname."?aid=".$Account->get("id")."&ref=log" ?>">
                    <span class="icon sli sli-refresh"></span>
                    <?= __("Load More") ?>
                </a>
            </div>
        </aside>
      <?php endif; ?>
      
        <section class="skeleton-content" style="<?= $Settings->get("data.wizard") ? "float: none;width: 99%;" : ""?>">
            <div class="section-header clearfix">
              <?php if(!$Settings->get("data.wizard")) :?>
                <h2 class="section-title">
                    <?= htmlchars($Account->get("username")) ?>
                    <?php if ($Account->get("login_required")): ?>
                        <small class="color-danger ml-15">
                            <span class="mdi mdi-information"></span>    
                            <?= __("Re-login required!") ?>
                        </small>
                    <?php endif ?>
                  </h2>
               <?php else : ?>
                <div class="profileWizard">
                  
                  <?php 
                    $pics = (array) $AuthUser->get("data.accpics");
                    if(isset($pics[$Account->get("username")]) && $pics[$Account->get("username")] != "") : ?>
                    <div class="profilePic pull-left" style="background-image: url(<?= $pics[$Account->get("username")] ?>)"></div>
                  <?php elseif($Account->get("image")) :?>
                    <div class="profilePic pull-left" style="background-image: url(<?= htmlchars($Account->get("image")) ?>)"></div>
                  <?php endif; ?>
                  
                
                    <h2 class="section-title">
                        <?= htmlchars($Account->get("username")) ?> 
                        <?php if ($Account->get("login_required")): ?>
                            <small class="color-danger ml-15">
                                <span class="mdi mdi-information"></span>    
                                <?= __("Re-login required!") ?>
                            </small>
                        <?php endif ?>
                    </h2>
                  <?php if ($Accounts->getTotalCount() > 1): ?>
                  <div class="pull-left clearfix context-menu-wrapper">
                    <a class="small button button--light-outline button--oval" href="javascript:void(0)"><?= __("Change account") ?></a>
                    <div class="context-menu" style="z-index: 99979; right: unset; margin-top: 18px;">
                        <iframe src="<?= APPURL."/e/".$idname."/accounts" ?>" frameborder="0" style="width: 400px; height: 400px; border: solid 1px #CCC;" id="myFrame"></iframe>
                      </div>
                  </div>
                  <?php endif ?>
                </div>
               <?php endif ?>
            </div>

            <div class="boost-tab-heads clearfix">
                <?php if($Settings->get("data.wizard")) : ?>
                  <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/wizard" ?>"><?= __("Wizard") ?></a>
                <?php else : ?>
                  <a href="<?= APPURL."/e/".$idname."/".$Account->get("id") ?>"><?= __("Target & Settings") ?></a>
                <?php endif; ?>
                <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/log" ?>"><?= __("Activity Log") ?></a>
                <a href="<?= APPURL."/e/".$idname."/".$Account->get("id")."/source" ?>" class="active">
                  <?= __("Best Sources") ?>
                  <span class="boost-beta"><?= __("beta"); ?></span>
                </a>
            </div>

            <?php if ($Sources): ?>
          <table class="tb-boost-sources">
            <thead>
              <tr>
                <td><strong><?= __("Source")?></strong></td>
                <!--td><strong><?= __("New Followers")?></strong></td-->
                <td><strong><?= __("Average")?></strong></td>
                <td><strong><?= __("Status")?></strong></td>
              </tr>
            </thead>
            <tbody>
              <?php foreach($Sources as $k => $s) : 
                  $average = $s['followers'] ? 
                    (number_format($s['followers'] * 100 / $totalNewFollowers, 2, ".", ",") . "%") 
                    : __("Collecting data");
                  if($s['type'] == "hashtag") {
                    $icon = '<span class="icon mdi mdi-pound"></span>';
                  } elseif($s['type'] == "location") {
                    $icon = '<span class="icon mdi map-marker"></span>';
                  } elseif($s['type'] == "people") {
                    $icon = '<span class="icon mdi mdi-instagram"></span>';
                  } else {
                    $icon = '';
                  }
              ?>
              <tr>
                <td data-label="<?= __("Source")?>"><?= $icon . $s['value']?></td>
                <!--td data-label="<?= __("New Followers")?>"><?= (int) $s['followers']?></td-->
                <td data-label="<?= __("Average")?>"><?= $average;?></td>
                <td data-label="<?= __("Status")?>"><?= $s['is_target'] ? '<span class="color-success">Running</span>' : '<span class="color-danger">Removed</span>'?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
  
          </table>
            <?php else: ?>
                <div class="no-data">
                    <p><?= __("Best Sources for %s is empty", 
                    "<a href='https://www.instagram.com/".htmlchars($Account->get("username"))."' target='_blank'>".htmlchars($Account->get("username"))."</a>") ?></p>
                </div>
            <?php endif ?>
        </section>
    </div>
</div>