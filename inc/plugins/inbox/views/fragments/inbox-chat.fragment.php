<?php
  namespace Plugins\Inbox;
  foreach($Threads as $k => $t) :
    $k++;
    //$lastItem = $t->getLastPermanentItem();
    $lastItem = $t->getItems()[0];
    $firstUser = $t->getUsers()[0];
?>

<div class="inbox-chat-list-item direct-chat-msg">
    <div class="clearfix">
        <span class="circle">
          <span class="img" style="background-image: url(<?= htmlchars($firstUser->getProfilePicUrl()); ?>)"></span>
        </span>

        <div class="inner clearfix">
            <?php 
                $date = new \Moment\Moment(date("Y-m-d H:i:s", $lastItem->getTimestamp() / 1000000), date_default_timezone_get());
                $date->setTimezone($AuthUser->get("preferences.timezone"));

                $fulldate = $date->format($AuthUser->get("preferences.dateformat")) . " " 
                          . $date->format($AuthUser->get("preferences.timeformat") == "12" ? "h:iA" : "H:i");
            ?>

            <div class="action">
              <strong>
                <?= !$t->getIsGroup() ? $t->getThreadTitle() : ($t->getInviter()->getUsername() . " " . __("more") . " " . (count($t->getUsers()) - 1)); ?>
              </strong>
              <span class="date" title="<?= $fulldate ?>"><?= $date->fromNow()->getRelative();?></span>
            </div>

            <span class="meta">
              <?php echo namespace\formatIboxItems($lastItem); ?>  
            </span>
              <div class="buttons clearfix">
                <a class="inbox-open-chat button small button--light-outline" 
                href="#"
                onclick="Inbox.Chat('<?= APPURL."/e/".$idname."/thread/".$Account->get("id") . "/?id=" . $t->getThreadId() . "&userid=".$lastItem->getUserId(); ?>')">
                <?= __("Open chat"); ?>
              </a>
              </div>
        </div>
    </div>
</div>
<?php endforeach; ?>