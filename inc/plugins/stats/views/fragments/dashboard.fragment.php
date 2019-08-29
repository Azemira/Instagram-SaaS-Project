<div class="clearfix" id="stats-dashboard">
  <div class="stats-user clearfix">
    
    <!-- account and time select -->
    <div class="stats-box clearfix">
          <div class="stats-head" style="display: inline-block;margin-bottom: 0; padding-bottom: 0;">
            <h3><?= __('<span>Select</span> an account'); ?></h3>
          </div>
          <div class="row">
            <div class="col s12 m6 l6">
              <form action="<?= $baseUrl . '?time='.$time; ?>" method="GET" id="formAccounts">
              <div class="account-selector clearfix">
                <select class="input input--small" name="account">
                    <?php foreach ($Accounts->getData() as $a): ?>
                        <option value="<?= $a->id ?>" <?= $a->id == $ActiveAccount->get("id") ? "selected" : "" ?>>
                            <?= htmlchars($a->username); ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <p class="stats-subtitle">
                  <?php if($lastUpdate) : ?>
                    <?= __("Last Update"); ?>: <strong><?=$lastUpdate;?></strong>
                    <a class="refresh-stats" 
                       href="<?= $baseUrl.'?account='.$ActiveAccount->get("id").'&forceRefresh=1&time='.$time?>" 
                       title="<?=__('Click to Refresh')?>">
                      <span class="sli sli-refresh"></span>
                    </a>
                  <?php else : ?> 
                    <a class="refresh-stats" 
                       href="<?= $baseUrl.'?account='.$ActiveAccount->get("id").'&forceRefresh=1&time='.$time?>" 
                       title="<?=__('Click to Refresh')?>">
                      <span class="sli sli-refresh"></span> <?= __("Click to Refresh"); ?>
                    </a>
                  <?php endif; ?>
                  <?php if ($ActiveAccount->get("login_required")): ?>
                      <hr/>
                      <a class="color-danger" href="<?= APPURL."/accounts/".$ActiveAccount->get("id") ?>">
                          <span class='mdi mdi-information'></span>
                          <?= __("Re-login required!") ?>
                      </a>
                  <?php endif; ?>
                </p>
              </div>
              <input class="none" type="submit" value="<?= __("Submit") ?>">
            </form>
            </div>
            
            <div class="col s12 m6 l6 l-last m-last s-last stats-time-wrap">
              <div class="stats-head" style="margin-top: -52px; padding-bottom:0; margin-bottom:0;">
                <h3><?= __('<span>Number of</span> result displayed'); ?>:</h3>
            </div>
            <ul class="stats-time">
              <li class="<?= $time == 7 ? 'time-selected' : '';?>"><a href="<?= $baseUrl . '?account='.$ActiveAccount->get("id").'&time=7'; ?>">7</a></li>
              <li class="<?= $time == 14 ? 'time-selected' : '';?>"><a href="<?= $baseUrl . '?account='.$ActiveAccount->get("id").'&time=14'; ?>">14</a></li>
              <li class="<?= $time == 21 ? 'time-selected' : '';?>"><a href="<?= $baseUrl . '?account='.$ActiveAccount->get("id").'&time=21'; ?>">21</a></li>
              <li class="<?= $time == 30 ? 'time-selected' : '';?>"><a href="<?= $baseUrl . '?account='.$ActiveAccount->get("id").'&time=30'; ?>">30</a></li>
            </ul>
            </div>
          </div>
    </div>
    <!-- end account and time select -->
<?php if($hasData) : ?>
    <!-- plugin actions -->
    <div class='row'>
      <div class="col s12 m12 l12" style="text-align:center;">
<?php $aux = 0; $countPlugins = []; foreach($plugins as $k => $p) : if( !$p['isCore'] && $p['ok']): $aux++;?>
        <div class="stats-box stats-top bg-<?=$aux?>">
          <h3>
            <span class="<?= $p['iconClass']?>"></span>
            <div id="countAnimation-<?=$k?>"><?= $countPlugins[$k] = $p['count']; ?></div>
          </h3>
            
          <h4><?=$p['title']; ?></h4>
        </div>
<?php endif; endforeach; ?>
        
      </div>
    </div>
    <!-- end plugin actions -->
    
    <div class="row">
      <div class="col s12 m12 l12">
        
        <!-- user profile -->
        <div class="stats-box" id="stats-profile-box">
          <div class="stats-head">
            <h3><?= __('<span>Your</span> Profile'); ?></h3>
            <ul>
              <li class="resize-box">
                <span class="sli sli-size-fullscreen"></span>
              </li>
            </ul>
          </div>
          <div class="row clearfix">
            <!-- img-profile column -->
            <div class="col s12 m3 l3">
              <div class="img-profile">
                <div class="stats-inner">
                  <img src="<?= $profileInfo->pic?>" alt="" />
                  <span class="img-username"><a href="https://www.instagram.com/<?= $ActiveAccount->get('username');?>">@<?= $ActiveAccount->get('username')?></a></span>           
                </div>
              </div>
            </div>
            <!-- end of img-profile column -->
            
            <!-- img-info column -->
            <div class="col s12 m5 l5">
              <div class="profile-info">
                <div class="profile-detail">
                  <h3><?= $profileInfo->name;?></h3>
                  <p class="profile-bio"><?= $profileInfo->bio?></p>
                </div>
                <div class="profile-nrs">
                  <div class="nrs-detail">
                    <small><?= __('Followers'); ?></small>
                    <span><?= readableNumber($latestStats['followers'])?></span>
                  </div>
                  <div class="nrs-detail">
                    <small><?= __('Following'); ?></small>
                    <span><?= readableNumber($latestStats['followings'])?></span>
                  </div>
                  <div class="nrs-detail">
                    <small><?= __('Posts'); ?></small>
                    <span><?= readableNumber($latestStats['posts'])?></span>
                  </div>
                  <div class="nrs-detail">
                    <small><?= __('Engagement'); ?></small>
                    <span><?= number_format($profileInfo->engagement, 2, '.', ',')?>%</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- end img-info column -->
            
            <!-- actions status -->
            <div class="col s12 m4 l4  last s-last m-last l-last">
              <div class="stats-head" style="margin: -52px 20px -20px -20px;display: none;">
                <h3><?= __('<span>Actions</span> running in your account'); ?></h3>
              </div>  
              <div class="profile-actions"> 
                <div class="form-result"></div>
                  <ul class="list-actions">
                    <?php foreach($plugins as $k => $v) : if ($v['ok'] && !$v['isCore']) :?>
                      <li>
                          <span class="action-sum"><?= readableNumber($v['count'],2)?></span>
                          <span class="action-action"><?= $v['title']; ?></span>
                          <span class="action-status"><input id="<?= $k;?>_switch" type="checkbox" class="js-switch" name="<?= $k;?>_switch" value="1" <?= $v['active'] ? 'checked' : ''; ?> /></span>
                        </li>
                      <li>
                    <?php endif; endforeach; ?>
                  </ul>
                </div>
            </div>
            <!-- end actions status -->
       
            
          </div>
        </div>
        <!-- end user profile -->
        
        <!-- grow -->
        <div class="stats-box" id="stats-grow-evolution">
          <div class="stats-head">
            <h3><?= __('<span>Profile</span> Growing Evolution'); ?></h3>
            <ul>
              <li class="resize-box">
                <span class="sli sli-size-fullscreen"></span>
              </li>
            </ul>
          </div>
          <div class="wrap-chart" style="height:350px">
            <canvas id="statsNrFollowersGraphic" width="" height=""></canvas>
          </div>
          <?php $result = end($statsData)['followers'] - reset($statsData)['followers']; if($result) {?>
          <div class="stats-footer">
            <div class="stats-total">
              <span><?=readableNumber($result);?></span> <?= __('New Followers'); ?>
            </div>
          </div>
          <?php } ?>
        </div>
        <!-- end grow -->
        
      </div>
    </div>
    <div class="row">
      <div class="col s12 m6 l6">
        
        <!-- follow vs followings -->        
        <div class="stats-box dark">
          <div class="stats-head">
            <h3><?= __('<span>New</span> Followers vs Followings'); ?></h3>
            <ul>
              <li class="resize-box">
                <span class="sli sli-size-fullscreen"></span>
              </li>
            </ul>
          </div>
          <div class="wrap-chart" style="height:250px">
            <canvas id="statsFollowersFollowingsGraphic" width="" height=""></canvas>
          </div>
        </div>
        <!-- end follow vs followings -->
        
      </div>
      <div class="col s12 m6 l6 l-last m-last s-last">
        
        <!-- follow vs followings -->        
        <div class="stats-box">
          <div class="stats-head">
            <h3><?= __('<span>Total</span> Followers vs Followings'); ?></h3>
            <ul>
              <li class="resize-box">
                <span class="sli sli-size-fullscreen"></span>
              </li>
            </ul>
          </div>
          <div class="wrap-chart" style="height:250px">
            <canvas id="statsNrFollowersFollowingsGraphic" width="" height=""></canvas>
          </div>
        </div>
        <!-- end follow vs followings -->
        
      </div>
    </div>
    <div class="row">
      <div class="col s12 m12 l12">
        
      <?php if(isset($profileInfo->feed) && $profileInfo->feed) : ?>
        <!-- posts -->
        <div class="stats-box clearfix">
          <div class="stats-head">
            <h3><?= __('<span>Top 3 Post</span> based on <small>last 10 posts</small>'); ?></h3>
          </div>
          <div class="stats-last-post">
            <div class="row clearfix">
              <?php foreach ($profileInfo->feed as $k => $m) : ?>
                <div class="col s12 m4 l4 <?= $k == 2 ? 'l-last m-last s-last': '';?>">
                  <?= $m->embed;?>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <!-- end posts -->
        <?php endif; ?>

        
        <!-- table -->
        <div class="stats-box">
          <div class="stats-head">
            <h3><?= __('<span>Daily</span> Stats'); ?></h3>
            <ul>
              <li class="resize-box">
                <span class="sli sli-size-fullscreen"></span>
              </li>
            </ul>
          </div>
          <table class="tb-stats">
            <tbody>
              <tr>
                  <td><strong><?= __('Date'); ?></strong></td>
                  <td><strong><?= __('Followers'); ?></strong></td>
                  <td><strong><?= __('Following'); ?></strong></td>
                  <td><strong><?= __('Posts'); ?></strong></td>
              </tr>
              <?php
              $sum = [
                'posts'     => 0,
                'followers' => 0,
                'followings'=> 0
              ];
              $date = new \DateTime();
              $numberSeparetor = ',';
              foreach($statsData as $tb):
                $sum['followers'] += $tb['followers_diff'];
                $sum['followings'] += $tb['followings_diff'];
                $sum['posts'] += $tb['posts_diff'];
              ?>
              <tr>
                <td data-label="<?= __('Date'); ?>"><?= $date->modify($tb['dt'])->format($dateFormat); ?></td>
                <td data-label="<?= __('Followers'); ?>">
                  <?= number_format($tb['followers'], 0, '', $numberSeparetor) . ' ' . ($tb['followers_diff'] > 0 
                        ? ('<span class="color-success">(+'.$tb['followers_diff'].')</span>')
                        : ($tb['followers_diff'] < 0 ? '<span class="color-danger">('.$tb['followers_diff'].')</span>' : '<span class="">(0)</span>'));
                  ?>
                </td>
                <td data-label="<?= __('Following'); ?>">
                  <?= number_format($tb['followings'], 0, '', $numberSeparetor) . ' ' . ($tb['followings_diff'] > 0 
                        ? ('<span class="color-success">(+'.$tb['followings_diff'].')</span>')
                        : ($tb['followings_diff'] < 0 ? '<span class="color-danger">('.$tb['followings_diff'].')</span>' : '<span class="">(0)</span>'));
                  ?>
                </td>
                <td data-label="<?= __('Posts'); ?>">
                  <?= number_format($tb['posts'], 0, '', $numberSeparetor) . ' ' . ($tb['posts_diff'] > 0 
                        ? ('<span class="color-success">(+'.$tb['posts_diff'].')</span>')
                        : ($tb['posts_diff'] < 0 ? ('<span class="color-danger">('.$tb['posts_diff'].')</span>') : ('<span class="">(0)</span>')));
                  ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
              <td data-label="<?= __('Total')?>"><?= __('Total')?></td>
              <td data-label="<?= __('Followers'); ?>">
                  <?= ($sum['followers'] > 0 
                        ? ('<span class="color-success">+'.number_format($sum['followers'], 0, '', $numberSeparetor).'</span>')
                        : ($sum['followers'] < 0 ? ('<span class="color-danger">'.number_format($sum['followers'], 0, '', $numberSeparetor).'</span>') : ('<span class="">0</span>')));
                  ?>
              </td>
              <td data-label="<?= __('Followings'); ?>">
                  <?= ($sum['followings'] > 0 
                        ? ('<span class="color-success">+'.number_format($sum['followings'], 0, '', $numberSeparetor).'</span>')
                        : ($sum['followings'] < 0 ? ('<span class="color-danger">'.number_format($sum['followings'], 0, '', $numberSeparetor).'</span>') : ('<span class="">0</span>')));
                  ?>
              </td>
              <td data-label="<?= __('Posts'); ?>">
                  <?= ($sum['posts'] > 0 
                        ? ('<span class="color-success">+'.number_format($sum['posts'], 0, '', $numberSeparetor).'</span>')
                        : ($sum['posts'] < 0 ? ('<span class="color-danger">'.number_format($sum['posts'], 0, '', $numberSeparetor).'</span>') : ('<span class="">0</span>')));
                  ?>
              </td>
            </tr>
            <tr>
              <td data-label="<?= __('Average'); ?>"><?= __('Average')?></td>
              <td data-label="<?= __('Followers'); ?>">
                  <?php $av = $sum['followers'] / (sizeof($statsData) == 0 ? 1 : sizeof($statsData));
                        echo ($av > 0 
                        ? ('<span class="color-success">+'.number_format($av, 0, '', $numberSeparetor).'</span>')
                        : ($av < 0 ? ('<span class="color-danger">'.number_format($av, 0, '', $numberSeparetor).'</span>') : ('<span class="">0</span>')));
                  ?>
              </td>
              <td data-label="<?= __('Followings'); ?>">
                  <?php $av = $sum['followings'] / (sizeof($statsData) == 0 ? 1 : sizeof($statsData));
                        echo ($av > 0 
                        ? ('<span class="color-success">+'.number_format($av, 0, '', $numberSeparetor).'</span>')
                        : ($av < 0 ? ('<span class="color-danger">'.number_format($av, 0, '', $numberSeparetor).'</span>') : ('<span class="">0</span>')));
                  ?>
              </td>
              <td data-label="<?= __('Post'); ?>">
                  <?php $av = $sum['posts'] / (sizeof($statsData) == 0 ? 1 : sizeof($statsData));
                        echo ($av > 0 
                        ? ('<span class="color-success">+'.number_format($av, 0, '', $numberSeparetor).'</span>')
                        : ($av < 0 ? ('<span class="color-danger">'.number_format($av, 0, '', $numberSeparetor).'</span>') : ('<span class="">0</span>')));
                  ?>
              </td>
            </tr>
            </tfoot>
        </table>
        </div>
        <!-- end table -->
      </div>
     
    </div>
<?php else : ?>
  <!-- start: no data -->
  <div class="stats-box">
    <div class="stats-head">
      <h3><?= __('<span>No</span> data'); ?></h3>
    </div>
    <p><?= __("We could not retrieve data from your Account")?></p>
    <hr/>
    <?php if ($ActiveAccount->get("login_required")): ?>
        <p>
          <a class="color-danger" href="<?= APPURL."/accounts/".$ActiveAccount->get("id") ?>">
            <span class='mdi mdi-information'></span>
            <?= __("Re-login required!") ?>
          </a>
        </p>
    <?php else: ?>
    <p><?= __('Please, contact the support.'); ?></p>
    <?php endif; ?>
  </div>
  <!-- end: no data -->
<?php endif; ?>
  </div>
</div>

<div class="clearfix"></div>