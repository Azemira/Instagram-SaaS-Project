<?php 
$lastUser = null;
$align = 'left';
$items = array_reverse($thread->getThread()->getItems());
foreach($items as $k => $t) :
  if('2018-11-08 21:21:39' <> date('Y-m-d H:i:s', $t->getTimestamp() / 1000000)) {
  $userId = $t->getUserId();
  $isMine = $Account->get("instagram_id") == $userId;
  $align  = $isMine ? 'left' : 'right';
?>
<div class="direct-chat-msg <?= $align; ?>">

  <div class="direct-chat-info inbox-list-item clearfix">
    <?php if(!$isMine) : ?>
      <span class="direct-chat-name pull-<?=$align; ?>"><?= $users[$userId]['username']; ?></span>
    <?php endif; ?>
    <?php if(!$isMine && $lastUser == $userId) : ?>  
      <span class="direct-chat-timestamp pull-<?= $align == 'right' ? 'left' : 'right'; ?>"><?= date('Y-m-d H:i:s', $t->getTimestamp() / 1000000); ?></span>
    <?php endif; ?>
  </div>
  <?php if(!$isMine && $lastUser == $userId) : ?>
  <img class="direct-chat-img" src="<?= $users[$userId]['img']; ?>" alt="<?= $users[$userId]['fullname']; ?>">
  <?php endif; ?>
  
  <?php if($t->getItemType() == 'action_log') : ?>
  <div class="direct-chat-text"><?= $t->getText() ?></div>
  <?php elseif($t->getItemType() == 'text') : ?>
    <div class="direct-chat-text"><?= $t->getText(); ?></div>
  <?php else:  ?>
    <div class="direct-chat-text"><?= 'unhandled itemType: ' . $t->getItemType(); ?></div>
  <?php endif; ?>
  <!-- /.direct-chat-text -->
  
</div>
<?php
$lastUser = $userId;
  }
endforeach;
?>