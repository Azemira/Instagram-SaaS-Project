<?php 
namespace Plugins\Boost;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?"); 

ini_set("display_errors", 1);
error_reporting(E_ALL);
set_time_limit(0);

/**
 * Boost
 * run actions to boost your IG
 * @author Dan Developer <dandeveloper.br@gmail.com>
 * @author Jonatan froes <jonatanfroes@gmail.com>
 */
class Boost {
  
  /**
  * \Instagram objects
  */
  protected $ig;
  protected $igMedia;
  protected $igUser;
  protected $rank_token;
  protected $max_id = null;
  protected $feed; //ig feed
  protected $isUserFull;
  
  /**
  * Debug and helper variables
  */
  protected $debug;
  protected $debugSc; //rebug for each $schedule
  protected $debugTime;
  protected $showDebug = false;
  protected $startDate; //date formated
  protected $currentTime; //timestamp
  protected $maxTimeWaitToRun = 6; //max time in minutes the each account will be wait to run
  
  /**
  * Module Models
  */
  protected $Logs;
  protected $Log;
  protected $Account;
  protected $User;
  protected $Schedules; //all schedules
  protected $sc; //each schedule
  protected $settings; // schedule settings  
  protected $scheduleDates; // schedule date for each ation
  protected $TargetsObj;


  protected $random_delay;
  protected $rand_min;
  protected $rand_max;
  protected $default_speeds;
  protected $speeds;
  protected $scSpeed; //speed for the selected shcedule
  protected $scSpeedUnfollow; //use different speeds for follow/unfollow
  protected $isOk; //success or error in action
  protected $whitelist = [];

  protected $actionsByCicle; //nr of actions performed by each ig account
  protected $followCicle; //nr of follow action before change to other action
  protected $likeCicle; //nr of like action before change to other action
  protected $commentCicle; //nr of comments action before change to other action
  protected $action; //follow/unfollow/like
  protected $hasTarget; //true target list is empty and is not unfollow
  protected $sleepTime; //time in seconds to sleep when paginating
  protected $saveFollowers;
  protected $saveFollowersSpeed;


  protected $maxPagination; //nr loop to get feed
  protected $maxTry; //nr of times we'll try to get data
  protected $maxTried; //nr of times we tried
  
  protected $cronType; //default, dedicated or multiple
  protected $cronKey;
  
  /**
   * start automation
   * @param $name string
   * @param $gender string
   * @return void
   */
  public function __construct()
  {
    set_time_limit(0);
    
    $this->debugTime    =  microtime(true);
    $this->debug        = [];
    
    $this->startDate    = date("Y-m-d H:i:s");
    $this->currentTime  = time();
    
    $this->addDebug("Stating at " . date('Y-m-d H:i:s'));

    $this->setSettings();
  }
 
  /**
   * end of running - show debug
   * @return void
   */
  public function __destruct()
  {
    echo 'boost runned!';
    //$this->showDebug = true;
    if (!$this->showDebug && !isset($_GET["debug"])) {
      return;
    }
    $runnedTime = number_format((microtime(true) - $this->debugTime), 6, ",", ".");

    //memory
    $unit = array('B','KB','MB','GB','TB','TB');
    $size = memory_get_usage();
    $pic  = memory_get_peak_usage();
    $pic2 = memory_get_peak_usage(true);
    $size = @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    $size2 = @round($pic/pow(1024,($i=floor(log($pic,1024)))),2).' '.$unit[$i];
    $size3 = @round($pic2/pow(1024,($i=floor(log($pic2,1024)))),2).' '.$unit[$i];
    
    $this->addDebug("Ending at " . date('Y-m-d H:i:s'));
    $this->addDebug("Runtime: {$runnedTime} Seconds; Memory Usage: {$size}, High Usage: {$size2}, High Usage Real: {$size3}");
    $load = sys_getloadavg();
  	$cpu  = isset($load[0]) ? $load[0] : 0;
    $this->addDebug("CPU usage: {$cpu}");

    echo '<pre>';
    print_r($this->debug);
    echo '</pre>';

    if ($this->settings && isset($_GET["debug"])) {
      //$this->dd(json_decode($this->settings->get("data")), false);
    }
    
  }
  
 
  /**
   * get value from an atribute
   * @return mixed
   */
  public function getObj($key)
  {
      return isset($this->{$key}) ? $this->{$key} : null;
  }
  
  /**
   * Set multiple cron key
   * @return void
   */
  public function setCronKey($val) {
    $this->cronKey = $val;
  }

  
  
/*---------------------------
    General Helper methods
___________________________ */  
  
 
  /**
   * Add data to debug
   * @param any $data
   * @return void
   */
  public function addDebug($data = '', $item = false)
  {
    $time = number_format((microtime(true) - $this->debugTime), 6, ",", ".");
    $load = sys_getloadavg();
    $cpu  = isset($load[0]) ? $load[0] : 0;
    if(\Input::get("show")) {
      echo "<code>[{$time}][{$cpu}] " . $data."<br>\r\n<code>";
    } else {
      $this->debug[]    = "[{$time}][{$cpu}] " . $data;
    }
    
    if($item) {
      $this->debugSc[]  = "[{$time}][{$cpu}] " . $data;
    }
    return $this;
  }
  
  /**
   * Get debug to save in log
   * @return void
   */
  protected function setLogDebug($Log = null)
  {
    return $this;
    if( !$this->settings->get("data.save_debug")) {
      return;
    }
    
    $result = "";
    foreach($this->debugSc as $d) {
      $result .= $d . "\r\n";
    }
    
    if ($Log) {
      $Log->set("data.debug", $result);
    } else {
      $this->Log->set("data.debug", $result);
    }
    $this->debugSc = [];
    return;
  }
  

  /**
   * Get media thumb url from the Instagram feed item
   * @param  stdObject $item Instagram feed item
   * @return string|null       
   */
  protected function get_media_thumb_igitem($item)
  {
      $media_thumb = null;

      $media_type = empty($item->getMediaType()) ? null : $item->getMediaType();

      if ($media_type == 1 || $media_type == 2) {
          // Photo (1) OR Video (2)
          $media_thumb = $item->getImageVersions2()->getCandidates()[0]->getUrl();
      } else if ($media_type == 8) {
          // ALbum
          $media_thumb = $item->getCarouselMedia()[0]->getImageVersions2()->getCandidates()[0]->getUrl();
      }    

      return $media_thumb;
  }
  

  /**
   * Debug and Die (or not)
   * a better way to print_r or var_dump
   * @param any $data
   * @param bool $die
   * @param bool $dump
   * @return void
   */
  protected function dd($data = [], $die = true, $dump = false)
  {
    echo '<pre>';
    $dump ? var_dump($data) : print_r($data);
    echo '</pre>';
    $die ? exit : null;
  }
  
/*---------------------------
    Before/after run
___________________________ */  
  /**
   * Get Schedules
   * @return void
   */
  protected function getSchedules()
  {
    $tbUsers      = TABLE_PREFIX . TABLE_USERS;
    $tbAccounts   = TABLE_PREFIX . TABLE_ACCOUNTS;
    $tbSchedules  = TABLE_PREFIX . "boost_schedule";
    
    $this->Schedules = new SchedulesModel();
    $this->Schedules->fetchData();

    $this->Schedules
      ->innerJoin($tbUsers, $tbUsers.".id", "=", $tbSchedules.".user_id") //to check users
      ->where($tbUsers.".expire_date", ">=", $this->startDate)
      ->where($tbUsers.".is_active", "=", 1)
      
      ->innerJoin($tbAccounts, $tbAccounts.".id", "=", $tbSchedules.".account_id") //to check account
      ->where($tbAccounts.".login_required", "=", 0)
      
      ->where($tbSchedules.".is_active", "=", 1)
      ->where($tbSchedules.".schedule_date", "<=", $this->startDate)
      ->where(function($q) use ($tbSchedules) { //get only with active rules
        $q->where($tbSchedules.".action_follow", "=", 1);
        $q->orWhere($tbSchedules.".action_unfollow", "=", 1);
        $q->orWhere($tbSchedules.".action_like", "=", 1);
        $q->orWhere($tbSchedules.".action_comment", "=", 1);
        $q->orWhere($tbSchedules.".action_welcomedm", "=", 1);
        $q->orWhere($tbSchedules.".action_viewstory", "=", 1);
      });
      
    if($this->settings->get("data.cron_overlap")) {
      $this->Schedules->where(function($q) use ($tbSchedules) {
        $time = $this->currentTime - ($this->maxTimeWaitToRun * 60);
        $q->where($tbSchedules.".running", "=", 0);
        $q->orWhereNull($tbSchedules.".running");
        $q->orWhere($tbSchedules.".running", "<", $time);
      }); 
    }
    
      if($this->cronType == "multiple" && $this->cronKey !== null) {
        $this->Schedules->where(\DB::raw("RIGHT(".$tbAccounts.".id, 1) = " . $this->cronKey));
      }

      $this->Schedules->orderBy($tbSchedules.".last_action_date", "ASC")
      ->setPageSize(10) //required to prevent server overload
      ->setPage(1)
      ->fetchData();
  }
  
  
  /**
   * Set Settings
   * @return void
   */
  protected function setSettings()
  {
    $this->settings = namespace\settings();

    // Random delays between actions
    $this->random_delay   = 0;
    $this->rand_min       = (int) $this->settings->get("data.rand_min");
    $this->rand_max       = (int) $this->settings->get("data.rand_max");
    $this->followCicle    = (int) $this->settings->get("data.follow_cicle");
    $this->likeCicle      = (int) $this->settings->get("data.like_cicle");
    $this->commentCicle   = (int) $this->settings->get("data.comment_cicle");
    $this->actionsByCicle = (int) $this->settings->get("data.action_by_cicle");
    $this->maxPagination  = (int) $this->settings->get("data.max_pagination");
    $this->maxTry         = (int) $this->settings->get("data.max_try");
    $this->saveFollowers  = (int) $this->settings->get("data.action_save_followers");
    $this->saveFollowersSpeed = (int) $this->settings->get("data.save_followers_speed");
    $this->cronType       = $this->settings->get("data.cron_type");
    
    $this->followCicle    = $this->followCicle ? $this->followCicle : 6;
    $this->likeCicle      = $this->likeCicle ? $this->likeCicle : 5;
    $this->commentCicle   = $this->commentCicle ? $this->commentCicle : 2;
    $this->actionsByCicle = $this->actionsByCicle ? $this->actionsByCicle : 1;
    $this->maxPagination  = $this->maxPagination ? $this->maxPagination : 2;
    $this->saveFollowersSpeed  = $this->saveFollowersSpeed ? $this->saveFollowersSpeed : 1;
    $this->maxTry         = $this->maxTry ? $this->maxTry : 3;
    $this->maxTried       = 0;
    $this->cronType       = $this->cronType ? $this->cronType : 'default';
    $this->sleepTime      = 1;
  
    if ($this->rand_min || $this->rand_max) {
        $this->random_delay = rand($this->rand_min, $this->rand_max);
    }

    // Speeds
    $this->default_speeds = [
        "auto"      => 1,
        "very_slow" => 1,
        "slow"      => 2,
        "medium"    => 3,
        "fast"      => 4,
        "very_fast" => 5,
    ];
  
    $this->speeds = $this->settings->get("data.speeds");
    
    if (!$this->speeds) {
        $this->speeds = [];
    } else {
        $this->speeds = json_decode(json_encode($this->speeds), true);
    }
    $this->speeds = array_merge($this->default_speeds, $this->speeds);

  }

  
  /**
   * run actions
   * @return void
   */
  public function initActions()
  {
    $this->addDebug("cron type: " . $this->cronType, true);
    
    if($this->cronType == "multiple") {
      $this->addDebug("cron key: " . $this->cronKey, true);
    }

    if($this->settings->get("data.stop")) {
      $this->addDebug("***** ACTION STOPED IN BOOST SETTINGS. NOTHING TO DO! *****");
      return;
    }

    $this->getSchedules();
    
    if ($this->Schedules->getTotalCount() < 1) {
      $this->addDebug("no valid schedule");
      return false;
    }
    
    $as = [__DIR__."/models/ScheduleModel.php", __NAMESPACE__."\ScheduleModel"];
    
    //check if cron is running
    $ids = [];
    foreach ($this->Schedules->getDataAs($as) as $sc) {
      $ids[] = $sc->get("id");
    }
    if($ids) {
      $table  = $sc->getTable();
      \DB::table($table)->whereIn('id', $ids)->update(['running' => $this->currentTime]);
    }
    
    foreach ($this->Schedules->getDataAs($as) as $sc) {
      $this->sc = $sc;
      $this->sc->data2 = [];
      $this->addDebug("Preparing actions for account #" . $this->sc->get("account_id"), true);
      
      if (!$this->prepareActions()) {
        $this->addDebug("Error preparing actions. Finish and go to next schedule");
        $this->setNextSchedule('all');
        $this->finishAction();
        continue;
      }
      
        $actions = $this->orderActionsList();
        $this->addDebug('actions: ' . print_r($actions, true));
        foreach($actions as $k => $a) {
          if (!$a || $a >= time()) {
            $this->addDebug("invalid time. Action -> time : ".$k." -> ".$a."; time(): " . time());
            if(!$this->sc->get("all_schedules.{$k}")) {
              $this->setNextSchedule($k);
            }
            continue;
          }
          
          if($k == "follow") {
            $this->action = $this->resolveFollowUnfollow();
          } else {
            $this->action = $k;
          }
          
          if(!$this->action) {
            $this->addDebug("no action... continue");
            continue;
          }
          $this->addDebug("action: " .$this->action);
          
          if(!in_array($this->action, ["unfollow", "welcomedm", "viewstory"])) {
            $this->setTarget();

            if(!$this->target) {
              $this->addDebug("could not set target");
              continue;
            }
          }
          
          
          
          $this->setNextSchedule($this->action);
          

          if ($this->action == "follow") {
            $this->runFollow();
          } elseif($this->action == "unfollow") {
            $this->runUnfollow();
          } elseif($this->action == "like") {
            $this->runLike();
          } elseif($this->action == "comment") {
            $this->runComment();
          } elseif($this->action == "welcomedm") {
            $this->runWelcomeDM();
          } elseif($this->action == "viewstory") {
            $this->runViewStory();
          }

          $this->finishAction($this->action);
      }
      $this->runNewFollowers();
      $this->finishAction();
    }
    $this->addDebug("No more schedule");
  }
  
  /**
   * called after run each action
   * @return void
   */
  protected function finishAction($action = false)
  {
    if (!$this->hasTarget) {
      $this->addDebug("finishing without target");
    }
    
    $this->sc->set("running", 0);
    
    $this->addDebug("isOk? " . ($this->isOk ? 'yes' : 'no'));
    //increment follow count
    if ($action == "follow" && $this->isOk) {
      $this->addDebug("Incrementing follow_count");
      $this->sc->set("follow_count", $this->sc->get("follow_count") + 1);
    }


    //update schedule
    $this->sc->save();

    //reset data
    $this->maxTried   = 0;

    $this->igMedia    = null;
    $this->igUser     = null;
    $this->rank_token = null;
    $this->max_id     = null;
    $this->feed       = null;
    $this->isUserFull = null;
    $this->isOk       = null;
    
    $this->Log        = new LogModel;
    // Set default values for the log (not save yet)...
    $this->Log->set("user_id", $this->User->get("id"))
        ->set("account_id", $this->Account->get("id"))
        ->set("unfollowed", 0)
        ->set("status", "error");

    if(!$action) {
      $this->ig         = null;
      $this->scSpeed    = null;
      $this->hasTarget  = null;
      $this->addDebug("END -------- GO TO NEXT SCHEDULE", true);
      $this->debugSc    = [];
    } else {
      $this->addDebug("*** END - GO TO NEXT ACTION ***");
    }

    

    return true;
    
  }
  
  
/*---------------------------
    Validation Methods
___________________________ */
  
  /**
   * run validation
   * @param $ignore = ['user', 'media']
   * @return void
   */
  protected function validate($ignore = [])
  {
    $ignoreUser   = in_array('user', $ignore);
    $ignoreMedia  = in_array('media', $ignore);
    
    //check blacklist
    if ( !$ignoreUser && !$this->checkBlacklist($this->igUser->getPk())) {
      $this->addDebug("user in blacklist", true);
      return false;
    }
    //check if profile has pic
    $strValidadePic = "a8539c22ed9fec8e1c43b538b1ebfd1d/5C5A1A7A/t51.2885-19/11906329_960233084022564_1448528159";
    if ( !$ignoreUser && $this->sc->get("has_picture") && 
        (!$this->igUser->getProfilePicUrl() || strstr($this->igUser->getProfilePicUrl(), $strValidadePic)) ) {
      $this->addDebug("ignored user without picture: @" . $this->igUser->getUsername(), true);
      return false;
    }

    //check if profiles is private
    if ( !$ignoreUser && $this->sc->get("ignore_private") && $this->igUser->getIsPrivate()) {
      $this->addDebug("ignored user private: @" . $this->igUser->getUsername(), true);
      return false;
    }

    //check gender
    if ( !$ignoreUser && $this->sc->get("gender") != "everyone" && 
        $this->sc->get("business") != 'business' &&
        !$this->checkGender($this->igUser->getFullName(), $this->sc->get("gender"))) 
    {
      $this->addDebug("ignored because of gender. Expeceted: ".$this->sc->get("gender").". Account: @" . $this->igUser->getUsername() . " - " . $this->igUser->getFullName(), true);
      return false;
    }

    //check if this user was followed
    if ( !$ignoreUser && $this->action == "follow" && $this->checkUserWasFollowed($this->igUser->getPk())) {
      $this->addDebug("User was followed once: @" . $this->igUser->getUsername(), true);
      return false;
    }

    //check if medias was commented
    if ( !$ignoreMedia && $this->action == "comment" && $this->checkMediaWasCommented()) {
      $this->addDebug("Media already commented!" . $this->igMedia->getCode(), true);
      return false;
    }
    
    //check if profile is business
    if ( !$ignoreUser && $this->sc->get("business") == 'business' || $this->sc->get("business") == 'personal') {
      if(!$this->isUserFull) {
        $this->maxTried++;
        try {
          $this->igUser = $this->ig->people->getInfoById($this->igUser->getPk())->getUser();
          $this->isUserFull = true;
          sleep($this->sleepTime);
        } catch(\Exception $e) {
          $this->isUserFull = false;
          $this->handleActionError($e->getMessage());
          $this->addDebug("could not check if user info to check if is personal/business account: @" . $this->igUser->getUsername() . " Error: " . $e->getMessage(), true);
          sleep($this->sleepTime);
          return false;
        }
      }
      if ($this->sc->get("business") == 'business' && !$this->igUser->getIsBusiness()) {
        $this->addDebug("Expected business and got personal. Inogred account: @" . $this->igUser->getUsername(), true);
        return false;
      } elseif($this->sc->get("business") == 'personal' && $this->igUser->getIsBusiness()) {
        $this->addDebug("Expected personal and got business. Inogred account: @" . $this->igUser->getUsername(), true);
        return false;
      }
    }
    
    //check badwords
    if (trim($this->sc->get("bad_words"))) {
      
      if( !$ignoreMedia && ($this->action == "like" || $this->action == "comment")) {
        if (!$this->igMedia) {
          $this->addDebug("Invalid Media", true);
          return false;
        }
        if(!$this->checkBadWords($this->igMedia->getCaption()->getText(), $this->sc->get("bad_words"))) {
          $this->addDebug("badword found in media: " . $this->igMedia->getCode(), true);
          return false;
        }
        return true;
      }
      
      //get user to validate
      if(!$this->isUserFull) {
        $this->maxTried++;
        try {
          $this->igUser = $this->ig->people->getInfoById($this->igUser->getPk())->getUser();
          $this->isUserFull = true;
        } catch(\Exception $e) {
          $this->handleActionError($e->getMessage());
          $this->addDebug("Error getting user detail: " . $e->getMessage(), true);
          $this->isUserFull = false;
          return false;
        }
      }
      
      //check badwords in biography
      if( !$ignoreUser && !$this->checkBadWords($this->igUser->getBiography(), $this->sc->get("bad_words"))) {
        $this->addDebug("badword found: @" . $this->igUser->getUsername(), true);
        return false;
      }
    }
    return true;
  }
  
  
  /**
   * run validation
   * @param $item
   * @return void
   */
  protected function validateUser($item)
  {   
    //check blacklist
    if (!$this->checkBlacklist($item['pk'])) {
      $this->addDebug("user in blacklist: @" . $item['username'], true);
      return false;
    }
    //check if profile has pic
    if ($this->sc->get("has_picture") && 
        !$this->checkHasPic($item['profile_pic_url'], $item['username'])) {
      $this->addDebug("ignored user without picture: @" . $item['username'], true);
      return false;
    }

    //check if profiles is private
    if ($this->sc->get("ignore_private") && $item['is_private']) {
      $this->addDebug("ignored user private: @" . $item['username'], true);
      return false;
    }

    //check gender
    if ($this->sc->get("gender") != "everyone" && 
        $this->sc->get("business") != 'business' &&
        !$this->checkGender($item['full_name'], $this->sc->get("gender"))) 
    {
      $this->addDebug("ignored because of gender. Expeceted: ".$this->sc->get("gender").". Account: @" . $item['username'] . " - " . $item['full_name'], true);
      return false;
    }

    //check if this user was followed
    if ($this->action == "follow" && $this->checkUserWasFollowed($item['pk'])) {
      $this->addDebug("User was followed once: @" . $item['username'], true);
      return false;
    }
    
    //check if profile is business
    if ($this->sc->get("business") == 'business' || $this->sc->get("business") == 'personal') {
      if(!isset($item['full'])) {
        $this->addDebug("no full");
      }
      
      if(!isset($item['full']) || !$item['full']) {
        $this->maxTried++;
        try {
          $this->igUser = $this->ig->people->getInfoById($item['pk'])->getUser();
          $item['full'] = $this->isUserFull = true;
          sleep($this->sleepTime);
        } catch(\Exception $e) {
          $item['full'] = $this->isUserFull = false;
          $this->handleActionError($e->getMessage());
          $this->addDebug("could not check if user info to check if is personal/business account: @" . $item['username'] . " Error: " . $e->getMessage(), true);
          
          return false;
        }
      }
      if ($this->sc->get("business") == 'business' && !$this->igUser->getIsBusiness()) {
        $this->addDebug("Expected business and got personal. Inogred account: @" . $this->igUser->getUsername(), true);
        return false;
      } elseif($this->sc->get("business") == 'personal' && $this->igUser->getIsBusiness()) {
        $this->addDebug("Expected personal and got business. Inogred account: @" . $this->igUser->getUsername(), true);
        return false;
      }
    }

    return true;
  }
  
  /**
   * run validation media
   * @param $item
   * @return void
   */
  protected function validateMedia($item, $ignore = [])
  {
    if (!$item) {
      $this->addDebug("invalid item for validation", true);
      return false;
    }
    $ignoreUser   = isset($ignore['user']);
    $ignoreMedia  = isset($ignore['media']);
    /* 
      dont need to check: 
        if is private in liking
        if this user was followed
        check if profile is business - check only in follow
    */

    
    //check blacklist
    if ( !$ignoreUser && !$this->checkBlacklist($item['user']['pk'])) {
      $this->addDebug("user in blacklist", true);
      return false;
    }
    
    //check if profile has pic
    if ( !$ignoreUser && $this->sc->get("has_picture")) {
      if(!$this->checkHasPic($item['user']['profile_pic_url'], $item['user']['username'])) {
        $this->addDebug("ignored user without picture: @" . $item['user']['username'], true);
        return false; 
      }
    }

    //check gender
    if ( !$ignoreUser 
        && $this->sc->get("gender") != "everyone" && 
        $this->sc->get("business") != 'business' &&
        !$this->checkGender($item['user']['full_name'], $this->sc->get("gender"))) 
    {
      $this->addDebug("ignored because of gender. Expeceted: ".$this->sc->get("gender").". Account: @" . $item['user']['username'] . " - " . $item['user']['full_name'], true);
      return false;
    }


    //check if medias was commented
    if ( !$ignoreMedia && $this->action == "comment" && $this->checkMediaWasCommented($item['code'])) {
      $this->addDebug("Media already commented!" . $item['code'], true);
      return false;
    }

    //check badwords
    if ( !$ignoreMedia && trim($this->sc->get("bad_words"))) {
      
      if($this->action == "like" || $this->action == "comment") {
        if(!$this->checkBadWords($item['caption'], $this->sc->get("bad_words"))) {
          $this->addDebug("badword found in media: " . $item['code'], true);
          return false;
        }
      }
    }
    return true;
  }
  
  protected function checkHasPic($profile_pic_url = '', $username = '')
  {
    //check if profile has pic
    //try to guess if pic exists. some invalid pics url:
    //https://instagram.fric1-2.fna.fbcdn.net/vp/c012aa3473e225c235b274cb8a51c620/5C716EDF/t51.2885-19/38905493_2193354514245732_6791661364604567552_n.jpg
    //https://instagram.fbsb6-1.fna.fbcdn.net/vp/c012aa3473e225c235b274cb8a51c620/5C716EDF/t51.2885-19/38905493_2193354514245732_6791661364604567552_n.jpg
      $invalidPics = [
        "/11906329_960233084022564_1448528159",
        "/38905493_2193354514245732_6791661364604567552",
        "/44884218_345707102882519_2446069589734326272",
      ];
      if(!$profile_pic_url) {
        return false;        
      }
      foreach($invalidPics as $pic) {
        if(strstr($profile_pic_url, $pic)) {
          return false;
        }
      }
    return true;
  }
  
  
  /*
   * check if user is in blacklist
   * @param $userPK int
   * @return bool
   */
  protected function checkBlacklist($userPk = false)
  {
    //check blacklist
    $blacklist = @json_decode($this->sc->get("blacklist"));
    if (!$blacklist || !is_array($blacklist) || !$userPk) {
      return true;
    }
    if (in_array($userPk, array_column($blacklist, 'id'))) {
      return false;
    }
    return true;
  }
  
  /*
   * search for bad word
   * @param $text array|string
   * @param $badWords array
   * @return bool
   */
  protected function checkBadWords($text = null, $badWords = null)
  {
    //@TODO add hashtag to list
    if (!$text || ! $badWords) {
      return true;
    }
    $text     = is_array($text) ? $text : [$text];
    $text     = array_map("trim", $text);
    $text     = array_map("strtolower", $text);
    
    $badWords = explode(",", $badWords);
    $badWords = array_map("trim", $badWords);
    $badWords = array_map("strtolower", $badWords);
    
    if (!$badWords) {
      return true;
    }
    
    foreach($badWords as $b) {
      foreach($text as $t) {
        if ($b && trim($t) && preg_match("/\b{$b}\b/",$t)) {
          $this->addDebug("bad word found...: {$b}", true);
          return false;
        }
      }
    }
    return true;
  }
  
  /*
   * check gender
   * @param $name string
   * @param $gender string
   * @return bool
   */
  protected function checkGender($name = "", $gender = null)
  {
    $name = explode(" ", $name);
    $name = preg_replace('~[^a-zA-Z]+~', '', $name[0]);
    $name = strtolower($name);
    
    if (!$name) {
      return false;
    }
    
    if ($gender == "male") {
      $list = namespace\getMaleList();
    } elseif($gender == "female") {
      $list = namespace\getFemaleList();
    } else {
      //all genders
      return true;
    }
    
    //invalid list. skip validation
    if (!$list || ! is_array($list)) {
      return true;
    }
    $list = array_map('strtolower', $list);
    
    //name found?
    if (in_array($name, $list)) {
        return true;
    }

    return false;
  }
  
   /*
    * check if user was followed (prevent user be followed twice)
    * @param $userPk integer
    * @return boolean
   */
  protected function checkUserWasFollowed($userPk = null)
  {
    if (!$userPk) {
      return false;
    }
    $log = new LogModel([
        "user_id"       => $this->sc->get("user_id"),
        "account_id"    => $this->sc->get("account_id"),
        "source_pk"     => $userPk,
        "action"        => "follow",
        "status"        => "success"
    ]);
    return $log->isAvailable();
  }
  
   /*
    * check if medias was commented (prevent be commented twice)
    * @param $mediaCode string
    * @return boolean
   */
  protected function checkMediaWasCommented($mediaCode = null)
  {
    /*if ($this->igMedia) {
      return false;
    }
    $mediaCode = $mediaCode ? $mediaCode : $this->igMedia->getCode();*/
    
    if (!$mediaCode) {
      return false;
    }
    
    $log = new LogModel([
        "user_id" => $this->sc->get("user_id"),
        "account_id" => $this->sc->get("account_id"),
        "source_pk"     => $mediaCode,
        "action"        => "comment",
        "status"        => "success"
    ]);
    
    return $log->isAvailable();
  }
  
  
   /*
    * check if user was commented (prevent be commented twice)
    * @param $userPk string
    * @return boolean
   */
  protected function checkUserWasCommented($userPk = null)
  {    
    if (!$userPk) {
      return false;
    }
    
    $log = new LogModel([
        "user_id"     => $this->sc->get("user_id"),
        "account_id"  => $this->sc->get("account_id"),
        "user_pk"     => $userPk,
        "action"      => "comment",
        "status"      => "success"
    ]);
    
    return $log->isAvailable();
  }
    
   /*
    * Hande IG error
    * @param $msg string
    * @param $key string
    * @return void
   */
  protected function handleActionError($msg = "", $key = "")
  {
    $this->addDebug("handleActionError(). Msg: " . $msg, true);
    $msg = strtolower($msg);
    $errors = [
      "max_follow"        => "following the max limit of accounts",
      "feedback_required" => "feedback required",
      "max_unfollow"      => "no one to unfollow",
      "login_required"    => "login required",
      "challenge_required"=> "challenge required",
      "too_many_request"  => "throttled by",
    ];
    
    //Handle feedback required
    if(strstr($msg, $errors["feedback_required"])) {
      
      \Event::trigger("feedback.required", $this->Account);
      
      if (!$this->settings->get("data.feedback")) {
        return;
      }
      
      $d = \DateTime::createFromFormat('Y-m-d H:i:s', $this->sc->get("schedule_date"));
      $newSchedule = $d->getTimestamp() + (int) $this->settings->get("data.feedback");
      
      $this->sc->set("schedule_date", $newSchedule)->save();
      
      return;
    }    

    //cant follow no one else. Set unfollow
    if(strstr($msg, $errors["max_follow"])) {
      
      $this->addDebug("error cant follow");
      
      if($this->sc->get("action_unfollow")) {
        $this->sc->set("follow_count", 0);
        $this->sc->set("cicle_follow", "unfollow")->save();
      } else {
        //@todo notification - nothing to do
        //disable follow
        $_log = new LogModel();
        $_log->set("user_id", $this->sc->get("user_id"))
            ->set("account_id", $this->sc->get("account_id"))
            ->set("status", "error")
            ->set("action", "follow")
            ->set("source_pk", 0)
            ->set("data.error.msg", __('Error, no more users to follow.'))
            ->set("data.error.details", 'Follow turned off')
            ->save();
        $this->sc->set("action_unfollow", 0)->save();
      }
      
      return;
    }  

    //too many requests
    if(strstr($msg, $errors["too_many_request"])) {
      
      $this->addDebug("sleep a while");
      //sleep(10);
      return;
    }
    
    //back to follow
    if(strstr($msg, $errors["max_unfollow"])) {
      $this->addDebug("error cant unfollow");
      if($this->sc->get("action_follow")) {
        $this->sc->set("follow_count", 0)->set("cicle_follow", "follow")->save();
      } else {
          $_log = new LogModel();
          $_log->set("user_id", $this->sc->get("user_id"))
            ->set("account_id", $this->sc->get("account_id"))
            ->set("status", "error")
            ->set("action", "unfollow")
            ->set("source_pk", 0)
            ->set("data.error.msg", __('Error, no more users to unfollow.'))
            ->set("data.error.details", 'Unfollow turned off')
            ->save();
        $this->sc->set("action_unfollow", 0)->save();
      }
      return;
    }
    
  }

  
  
/*---------------------------
    Actions
___________________________ */
  
   /*
    * Save Notification
    * @return void
   */
  protected function saveNotication($msg = "", $details = "")
  {
    $_log = new LogModel();
    $_log->set("user_id", $this->sc->get("user_id"))
        ->set("account_id", $this->sc->get("account_id"))
        ->set("status", "info")
        ->set("action", "notification")
        ->set("source_pk", 0)
        ->set("data.error.msg", $msg)
        ->set("data.error.details", $details)
        ->save();
  }
  
   /*
    * Follow
    * @return bool
   */
  protected function runFollow()
  {
    $liked = []; // follow + like
    
    $this->Log->set("action", "follow")
      ->set("data.trigger", $this->target);
    
    $userFound = null;
    $feed = $this->getFeed();
   
    
    if (!isset($feed) || !$feed || !count($feed)) {
      $this->addDebug("Empty feed", true)->setLogDebug();

      $this->Log->set("data.error.msg", "Couldn't get the feed")
        ->set("data.error.details", "Empty feed")
        ->save();

      return false;
    }
    $this->addDebug("Feed size: " . count($feed), true);
    
    //check if user was followed: all from the feed
    $usersIds = array_keys($feed);
    if($usersIds) {
      $this->addDebug("cheking if users was followed");
      //we need to do a manual sql
      $resUserIds = null;
      $tb         = TABLE_PREFIX."boost_log";
      $user_id    = $this->sc->get("user_id");
      $account_id = $this->sc->get("account_id");
      $user_pks   = implode(",",$usersIds);
      $query = "
        SELECT user_pk
        FROM {$tb}
        WHERE user_id = {$user_id}
          AND account_id = {$account_id}
          AND action = 'follow'
          AND status = 'success'
          AND user_pk IN({$user_pks})
      ";
      try {
        $res = \DB::query($query)->get();
        $remove = [];
        foreach($res as $k => $v) {
          $pk = $v->user_pk;
          $remove[$pk] = $pk;
        }
        
        $this->addDebug(count($remove) . " users removed");
        if($remove) {
          $feed = array_diff_key($feed, $remove);
        }
      } catch(\Exception $e) {
        $this->addDebug("error cheking if user was followed");
      }
    }
    
    foreach($feed as $k => $item) {
      $userFound = $this->target->type == "people" ? $item : $item['user'];
      if($item['pk'] == $this->Account->get("instagram_id") || $userFound['friendship']) {
        unset($feed[$k]);
        $this->addDebug("cant follow (friendship status) @" . $userFound['username'], true);
        continue;
      }

      if ($this->validateUser($userFound))  {
        $this->addDebug("User found! " . $userFound['username'], true);
        $this->Log->set("source_pk", $userFound['pk'])
          ->set("user_pk", $userFound['pk']);
        unset($feed[$k]);
        break;
      }
      unset($feed[$k]);
      $userFound = null;
    }
    
    $this->addDebug("Feed size now: " . sizeof($feed), true);
    $this->TargetsObj->set("items", json_encode($feed))->save();
    
    if(!$userFound) {
      $this->addDebug("user not found", true)->setLogDebug();
      $this->Log->set("data.error.msg", "Couldn't find new user to follow")->save();
      return false;
    }

    // New user found to follow
    try {
      //check follow + like
      if($this->settings->get("data.follow_plus_like") && 
         $this->sc->get("data.follow_plus_like") &&
         $this->settings->get("data.follow_plus_like_limit") > 0 &&
         $this->sc->get("data.follow_plus_like_limit") > 0 &&
         !$userFound["is_private"]) {
        
        $maxLike = $this->sc->get("data.follow_plus_like_limit") > $this->settings->get("data.follow_plus_like_limit") ? 
          $this->settings->get("data.follow_plus_like_limit") : 
          $this->sc->get("data.follow_plus_like_limit");
        
        $nrLikes  = rand(1, $maxLike);
        $this->addDebug("Follow + Like: " . $nrLikes . "x");
        $userFeed = $this->ig->timeline->getUserFeed($userFound['pk']);
        $items    = $userFeed->getItems();
        
        foreach ($items as $k => $item) {          
          $media = [];
          
          if(empty($item->getId()) || $item->getHasLiked()) {
            continue;
          }
          
          $k++;
          if($k > $nrLikes) {
            break;
          }
          
          $media = [
            'media_id' => $item->getId(),
            'media_code' => $item->getCode(),
            'media_type' => $item->getMediaType(),
            'media_thumb' => $this->get_media_thumb_igitem($item),
            'user_pk' => $item->getUser()->getPk(),
            'user_username' => $item->getUser()->getUsername(),
            'user_full_name' => $item->getUser()->getFullName()
          ];
          
          try {
            $respLike = $this->ig->media->like($item->getId());
            sleep($this->sleepTime);
           } catch (\Exception $e) {
            sleep($this->sleepTime);
            continue;
           }

           if (!$respLike->isOk()) {
               continue;
           } else {
             $this->addDebug("Liked media " . $item->getCode());
             $liked[] = $media;
           }
        }
      }
      $resp = $this->ig->people->follow($userFound['pk']);
      // mute after follow 

if($this->settings->get("data.follow_plus_mute") && $this->sc->get("data.follow_plus_mute") &&
!$userFound["is_private"]){
       
$mute = $this->ig->people->muteUserMedia($userFound['pk'],$this->sc->get("data.follow_plus_mute_type"));
   
}
    } catch (\Exception $e) {
        $msg = $e->getMessage();
        $msg = explode(":", $msg, 2);
        $msg = isset($msg[1]) ? $msg[1] : $msg[0];
      
        $this->handleActionError($e->getMessage());
      
        $this->addDebug("Erro in people->follow(): " . $e->getMessage(), true)->setLogDebug();
      
        $this->Log->set("data.error.msg", "Couldn't follow the user")
            ->set("data.error.details", $msg)
            ->save();
        return false;
    }


    if (!$resp->isOk()) {
      $this->addDebug("error in isOk() after people->follow()", true)->setLogDebug();
      
      $this->Log->set("data.error.msg", "Couldn't follow the user")
          ->set("data.error.details", "Something went wrong")
          ->save();
        
      return false;
    }
    
    $this->isOk = true;
    
    $this->addDebug("Followed @" . $userFound['username'], true)->setLogDebug();
    
    $this->Log->set("status", "success")
      ->set("data.followed", [
        "pk" => $userFound['pk'],
        "username" => $userFound['username'],
        "full_name" => $userFound['full_name'],
        "profile_pic_url" => $userFound['profile_pic_url']
    ])->set("data.liked", [
        "count" => count($liked),
        "items" => $liked
    ])->save();

    return true;
  }
  

   /*
    * Unfollow
    * @return bool
   */
  protected function runUnfollow()
  {
    $this->Log->set("target", null)
      ->set("target_value", null)
      ->set("action", "unfollow");
    
    $rank_token = \InstagramAPI\Signatures::generateUUID();

    //self info
    try {
        $me = $this->ig->people->getSelfInfo();
      } catch (\Exception $e) {
        //error getting followers. return
          $msg = $e->getMessage();
          $msg = explode(":", $msg, 2);
          $msg = isset($msg[1]) ? $msg[1] : $msg[0];
      
          $this->handleActionError($e->getMessage());
          $this->addDebug("error in people->getSelfInfo(): " . $e->getMessage(), true)->setLogDebug();
      
          $this->Log->set("data.error.msg", "Couldn't check your followers.")
              ->set("data.error.details", $msg)
              ->save();
          
          

        return false;
      }
    
    //following nobody
    if(!$me->getUser()->getFollowingCount()) {
      
      $this->handleActionError("no one to unfollow");
      
      $this->addDebug("empty getFollowingCount()", true)->setLogDebug();
      
      $this->Log->set("data.error.msg", "Couldn't find any user to unfollow")
        ->set("data.error.details", "You are not following anyone right now")
        ->save();
      
      

      return false;
    }
    
    /*
    unfollowed log status
    0 -> no try
    1 -> unfollowed
    2 -> we dont follow
    3 -> keep
    4 -> error
    */
    $unfollow_pk                = null;
    $unfollow_username          = null;
    $unfollow_full_name         = null;
    $unfollow_profile_pic_url   = null;
    $unfollow_log               = null;
    
    $k  = 0;
    
    // Get whitelist
    $this->addDebug("building whitelist");
    $this->handleWhitelist();
    $whitelist_pks = [];
    foreach ($this->whitelist as $u) {
        if ($u->id) {
            $whitelist_pks[] = $u->id;
        }
    }
    
    //unfollow only followed by us
    if(!$this->sc->get("unfollow_all")) {
      
      
      // Get boost log
      $this->Logs = new LogsModel;
      $this->Logs->where("user_id", "=", $this->sc->get("user_id"))
              ->where("account_id", "=", $this->sc->get("account_id"))
              ->where("status", "=", "success")
              ->where("action", "=", "follow")
              ->where("unfollowed", "=", "0")
              ->orderBy("id", "ASC")
              ->setPageSize(20) //required to prevent server overload
              ->setPage(1);

      if ($whitelist_pks) {
        $this->Logs->whereNotIn("source_pk", $whitelist_pks);
      }
      
      $this->Logs->fetchData();
      
      $this->addDebug("get data to unfollow from system: " . $this->Logs->getTotalCount(), true);

      if(!$this->Logs->getTotalCount()) {
        $this->handleActionError("no one to unfollow");
        $this->addDebug("empty follow log list", true)->setLogDebug();
        
          $this->Log->set("status", "error")
            ->set("data.error.msg", "Couldn't find any user to unfollow")
            ->set("data.error.details", "There is not any user to unfollow according to the task settings")
            ->save();
        
        
        return false;
      }
      
      $as = [__DIR__."/models/LogModel.php", __NAMESPACE__."\LogModel"];
      foreach ($this->Logs->getDataAs($as) as $log) {
        
        if (in_array($log->get("source_pk"), $whitelist_pks)) {
          $this->addDebug("@" . $log->get("data.followed.username") . " in whitelist");
          continue;
        }
        
        $this->maxTried++;
        if($this->maxTried > $this->maxTry) {
          $this->addDebug("maxTry reached: {$this->maxTry}", true);
          break;
        }
        
        try {
            $friendship = $this->ig->people->getFriendship($log->get("source_pk"));
            sleep($this->sleepTime);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $msg = explode(":", $msg, 2);
            $msg = isset($msg[1]) ? $msg[1] : $msg[0];

            $this->handleActionError($e->getMessage());
            $this->addDebug("Error in getFriendship() - " . $log->get("source_pk") . ": " . $e->getMessage(), true);

            //update currente log - unfollowed status as error (#4)
            $log->set("unfollowed", 4)->save();
            sleep($this->sleepTime);
          continue;
        }
        
        //we dont follow this guy
        if(!$friendship->getFollowing() && !$friendship->getOutgoingRequest()) {
          $this->addDebug("we dont follow this guy: @" . $log->get("data.followed.username"), true);
          $log->set("unfollowed", 2)->save();
          continue;
        }
        
        //keep this follower
        if($this->sc->get("keep_followers") && $friendship->getFollowedBy()) {
          $this->addDebug("this guy follow us. skip him: @" . $log->get("data.followed.username"), true);
          $log->set("unfollowed", 3)->save();
          continue;
        }
        
        $unfollow_pk                = $log->get("data.followed.pk");
        $unfollow_username          = $log->get("data.followed.username");
        $unfollow_full_name         = $log->get("data.followed.full_name");
        $unfollow_profile_pic_url   = $log->get("data.followed.profile_pic_url");
        $unfollow_log               = $log;
        break;
      }
    } else {
      //unfollow all
      $this->addDebug("Unfollow all :)");
      try {
        $followers = $this->ig->people->getSelfFollowing($rank_token);
      } catch (\Exception $e) {
        //error getting followers. return
          $msg = $e->getMessage();
          $msg = explode(":", $msg, 2);
          $msg = isset($msg[1]) ? $msg[1] : $msg[0];

          $this->handleActionError($e->getMessage());
          $this->addDebug("Error getting getSelfFollowing() :" . $e->getMessage(), true)->setLogDebug();

          //register log
          $this->Log->set("data.error.msg", "Couldn't get your followers")
              ->set("data.error.details", $msg)
              ->save();

        return false;
      }
      
      // no followers
      if (empty($followers->getUsers())) {
          $this->handleActionError("no one to unfollow");
          $this->addDebug("no one to unfollow", true)->setLogDebug();
        
            $this->Log->set("data.error.msg", "Couldn't find any user to unfollow")
                ->set("data.error.details", "There is not any user to unfollow")
                ->save();
        
            
            
            return false;
      }
      $this->addDebug("Reverting list o followers. size: " . count($followers->getUsers()));
      $followersList = array_reverse($followers->getUsers());
      
      foreach($followersList as $u) {
        //whitelist
        if (in_array($u->getPk(), $whitelist_pks)) {
          $this->addDebug($u->getUsername() . " in whitelist", true);
          continue;
        }

        if($this->maxTried > $this->maxTry) {
          $this->addDebug("maxTry reached: {$this->maxTry}", true);
          //break;
        }
        
        //check friendship status
        if($this->sc->get("keep_followers")) {
          try {
            $friendship = $this->ig->people->getFriendship($u->getPk());
          } catch (\Exception $e) {
            $msg = $e->getMessage();
            $msg = explode(":", $msg, 2);
            $msg = isset($msg[1]) ? $msg[1] : $msg[0];

            $this->handleActionError($e->getMessage());
            $this->maxTried++;
            $this->addDebug("error getting getFriendship() @" . $u->getUsername(), true);
            continue;
          }
          
          if($friendship->getFollowedBy()) {
            $this->maxTried++;
            $this->addDebug("this guy follow us: @" . $u->getUsername() . " - add to whitelist", true);
            $this->handleWhitelist("add", ["id" => $u->getPk(), "value" => $u->getUsername()]);
            continue;
          } 
        }
        
        $unfollow_pk                = $u->getPk();
        $unfollow_username          = $u->getUsername();
        $unfollow_full_name         = $u->getFullName();
        $unfollow_profile_pic_url   = $u->getProfilePicUrl();
        break;
      }      
    }

    

    if (empty($unfollow_pk)) {
      $this->addDebug("Empty unfollow_pk", true)->setLogDebug();
      
        $this->Log->set("status", "error")
            ->set("data.error.msg", "Couldn't find any user to unfollow in this round")
            ->set("data.error.details", "We'll retry shortly")
            ->save();

      return false;
    }
    
    // Unfollow the found account
    $this->isOk = false;
    try {
       $resp = $this->ig->people->unfollow($unfollow_pk);
    } catch (\Exception $e) {
        $msg = $e->getMessage();
        $msg = explode(":", $msg, 2);
        $msg = isset($msg[1]) ? $msg[1] : $msg[0];
      
        $this->addDebug("Error unfollow():" . $e->getMessage(), true)->setLogDebug();
      
        $this->Log->set("data.error.msg", "Couldn't unfollow the user")
            ->set("data.error.details", $msg)
            ->save();
        
      return;
    }
    
    // Unfollowed the account successfully
    $this->addDebug("Unfollowed: @" . $unfollow_username, true)->setLogDebug();
    $this->Log->set("status", "success")
        ->set("data.unfollowed", [
            "pk" => $unfollow_pk,
            "username" => $unfollow_username,
            "full_name" => $unfollow_full_name,
            "profile_pic_url" => $unfollow_profile_pic_url
        ])
        ->set("source_pk", $unfollow_pk)
        ->set("user_pk", $unfollow_pk)
        ->save();
    
    $this->isOk = true;
    if ($unfollow_log) {
      $unfollow_log->set("unfollowed", 3)->save();
    }
    
    
    return true;
  }
   
   /*
    * Like
    * @return bool
   */
  protected function runLike()
  {
    $this->Log->set("action", "like")
      ->set("data.trigger", $this->target);
    
    $this->addDebug("called runLike()", true);
    $feed           = null;
    $itemFound      = false;
    $media_id       = null;
    $media_code     = null;
    $media_type     = null;
    $media_thumb    = null;
    $user_pk        = null;
    $user_username  = null;
    $user_full_name = null;
    
    $feed = $this->getFeed();
    
    if (!isset($feed) || !$feed || !count($feed)) {

      $this->addDebug("Empty feed", true)->setLogDebug();

      $this->Log->set("data.error.msg", "Couldn't get the feed")
        ->set("data.error.details", "Empty feed")
        ->save();

      return false;
    }
    $this->addDebug("Feed size: " . count($feed), true);
    
    if($this->target->type == 'people') {
      
      //get feed fron an user
      $res = $this->getFeedFromUserList($feed);
      
      if(!$res || !isset($res['items']) || !isset($res['userSelected'])) {
        $this->addDebug("no media_id", true)->setLogDebug();
        $this->Log->set("data.error.msg", "Couldn't find the new media to like")->save();
        return false;
      }
      $this->addDebug("user feed size: " . sizeof($res['items']), true);
      
      foreach($res['items'] as $k => $item) {
        
        if(!$item['id']) {
          $this->addDebug("invalid media id: " . $item['code'], true);
          continue;
        }
        
        if($item['has_liked']) {
          $this->addDebug("Media already liked: " . $item['code'], true);
          continue;
        }
        
        if ($this->validateMedia($item, ['user'])) {

          // Found the media to like
          $media_id       = $item['id'];
          $media_code     = $item['code'];
          $media_type     = $item['media_type'];
          $media_thumb    = $item['image'];
          $user_pk        = $item['user']['pk'];
          $user_username  = $item['user']['username'];
          $user_full_name = $item['user']['full_name'];
          break;
        }
        $this->addDebug("error in validateMedia. go to next item.", true);
      }

      if (empty($media_id)) {
        $this->addDebug("no media_id", true)->setLogDebug();
        $this->Log->set("data.error.msg", "Couldn't find the new media to like")->save();
        return false;
      }

      $like_module = "profile";
      $like_extra_data['username'] = $user_username;
      $like_extra_data['user_id'] = $item['user']['pk'];
      
    } else {
      foreach($feed as $k => $item) {

        if(!$item['code']) { 
          $this->addDebug("invalid media id: " . $item['code'], true);
          unset($feed[$k]);
          continue;
        }
        
        if($item['has_liked']) {
          unset($feed[$k]);
          $this->addDebug("Media already liked: " . $item['code'], true);
          continue;
        }
        
        if ($this->validateMedia($item))  {

          // Found the media to like
          $media_id       = $item['id'];
          $media_code     = $item['code'];
          $media_type     = $item['media_type'];
          $media_thumb    = $item['image'];
          $user_pk        = $item['user']['pk'];
          $user_username  = $item['user']['username'];
          $user_full_name = $item['user']['full_name'];
          unset($feed[$k]);
          break;
        }
        unset($feed[$k]);
      }
      $feed = $feed ? $feed : [];
      $this->addDebug("Feed size now: " . sizeof($feed), true);
      $this->TargetsObj->set("items", json_encode($feed))->save();
      
      if (empty($media_id)) {
        $this->addDebug("no media_id", true)->setLogDebug();
        $this->Log->set("data.error.msg", "Couldn't find the new media to like")->save();
        return false;
      }
      
      if($this->target->type == "hashtag") {
        $like_module = "feed_contextual_hashtag";
        $like_extra_data["hashtag"] = $this->target->value;
        
      } elseif($this->target->type == "location") {
        $like_module = "feed_contextual_location";
        $like_extra_data['location_id'] = $this->target->id;
      }
      
    }

      
      // New media found
      // Like it!
      try {
          $resp = $this->ig->media->like($media_id, $like_module, $like_extra_data);
      } catch (\Exception $e) {
          $msg = $e->getMessage();
          $msg = explode(":", $msg, 2);
          $msg = isset($msg[1]) ? $msg[1] : $msg[0];
        
          $this->handleActionError($e->getMessage());
          $this->addDebug("Error when Liking: " . $e->getMessage(), true)->setLogDebug();
        
          $this->Log->set("data.error.msg", "Something went wrong")
              ->set("data.error.details", $msg)
              ->save();
          
          return false;
      }


    if (!$resp->isOk()) {
      $this->addDebug("isOk() null", true)->setLogDebug();
      $this->Log->set("data.error.msg", "Couldn't like the new media")
          ->set("data.error.details", "Something went wrong")
          ->save();
        
      return false;   
    }


    // Liked new media successfully
    $this->addDebug("Liked media " . $media_code, true)->setLogDebug();
    $this->Log->set("status", "success")
        ->set("data.liked", [
            "media_id" => $media_id,
            "media_code" => $media_code,
            "media_type" => $media_type,
            "media_thumb" => $media_thumb,
            "user" => [
                "pk" => $user_pk,
                "username" => $user_username,
                "full_name" => $user_full_name
            ]
        ])
        ->set("source_pk", $media_code)
        ->set("user_pk", $user_pk)
        ->save();
    
      return true;
  }
  
  /*
   * Comment
   * @return bool
   */
  protected function runComment()
  {
    $this->Log->set("action", "comment");
    
    $this->addDebug("called runComment()");
    $Emojione       = new \Emojione\Client(new \Emojione\Ruleset());
    $comments       = @json_decode($this->sc->get("comments"));
    $feed           = null;
    $itemFound      = false;
    $media_id       = null;
    $media_code     = null;
    $media_type     = null;
    $media_thumb    = null;
    $user_pk        = null;
    $user_username  = null;
    $user_full_name = null;
    $user_first_name= null;
    
    // Check comments
    if (is_null($comments)) {
        // Unexpected, data modified by external factors or empty comments
        // Deactivate schedule
        $this->sc->set("action_comment", 0)->save();

        // Log data
      $this->addDebug("commments list is null", true)->setLogDebug();
        $this->Log->set("data.error.msg", "Couldn't get comments list")->save();
        return false;
    }

    if (count($comments) < 1) {
        // Comment list is empty
        // Deactivate schedule
        $this->sc->set("action_comment", 0)->save();

        $this->addDebug("commments list is empty", true)->setLogDebug();
        // Log data
        $this->Log->set("data.error.msg", "Comment list is empty.")->save();
        return false;
    }
    $feed = $this->getFeed();
    $this->Log->set("data.trigger", $this->target);
    
    if (!isset($feed) || !$feed || !count($feed)) {

      $this->addDebug("Empty feed", true)->setLogDebug();

      $this->Log->set("data.error.msg", "Couldn't get the feed")
        ->set("data.error.details", "Empty feed")
        ->save();

      return false;
    }
    $this->addDebug("Feed size: " . count($feed));
    
    
    if($this->target->type == 'people') {
      
      //get feed fron an user
      $res = $this->getFeedFromUserList($feed);
      
      if(!$res || !isset($res['items']) || !isset($res['userSelected'])) {
        $this->addDebug("no media_id", true)->setLogDebug();
        $this->Log->set("data.error.msg", "Couldn't find the new media to like")->save();
        return false;
      }
      $this->addDebug("user feed size: " . sizeof($res['items']), true);
      
      foreach($res['items'] as $k => $item) {
        if(!$item['id']) {
          $this->addDebug("invalid media id: " . $item['code'], true);
          continue;
        }
        if ($this->validateMedia($item, ['user']) && !$this->checkUserWasCommented($item['user']['pk'])) {
          // Found the media to like
          $media_id       = $item['id'];
          $media_code     = $item['code'];
          $media_type     = $item['media_type'];
          $media_thumb    = $item['image'];
          $user_pk        = $item['user']['pk'];
          $user_username  = $item['user']['username'];
          $user_full_name = $item['user']['full_name'];
          $user_first_name = explode(" ", $user_full_name)[0];
          break;
        }
      }

      if (empty($media_id)) {
        $this->addDebug("no media_id", true)->setLogDebug();
        $this->Log->set("data.error.msg", "Couldn't find the new media to like")->save();
        return false;
      }

      $comment_module = "comments_feed_timeline";
      
    } else {
      foreach($feed as $k => $item) {
        if(!$item['id']) {
          $this->addDebug("invalid media id: " . $item['code']);
          unset($feed[$k]);
          continue;
        }
        
        if ($this->validateMedia($item) && !$this->checkUserWasCommented($item['user']['pk']))  {

          // Found the media to like
          $media_id       = $item['id'];
          $media_code     = $item['code'];
          $media_type     = $item['media_type'];
          $media_thumb    = $item['image'];
          $user_pk        = $item['user']['pk'];
          $user_username  = $item['user']['username'];
          $user_full_name = $item['user']['full_name'];
          $user_first_name = explode(" ", $user_full_name)[0];
          unset($feed[$k]);
          break;
        }
        unset($feed[$k]);
      }
      $feed = $feed ? $feed : [];
      $this->addDebug("Feed size now: " . sizeof($feed), true);
      $this->TargetsObj->set("items", json_encode($feed))->save();
      
      if (empty($media_id)) {
        $this->addDebug("no media_id", true)->setLogDebug();
        $this->Log->set("data.error.msg", "Couldn't find the new media to like")->save();
        return false;
      }
      
      if($this->target->type == "hashtag") {
        $comment_module = "feed_contextual_hashtag";
        
      } elseif($this->target->type == "location") {
        $comment_module = "feed_contextual_location";
      }
      
    }

      $variables = [
          "{{username}}" => "@".$user_username,
          "{{full_name}}" => $user_full_name,
          "{{first_name}}" => $user_first_name
      ];
      $comment = $this->chooseComment($comments, $this->User->get("settings.spintax"), $variables);
      
      // New media found
      // Comment
      try {
          $resp = $this->ig->media->comment($media_id, $comment, null, $comment_module);
      } catch (\Exception $e) {
          $msg = $e->getMessage();
          $msg = explode(":", $msg, 2);
          $msg = isset($msg[1]) ? $msg[1] : $msg[0];
        
          $this->handleActionError($e->getMessage());
          $this->addDebug("Error in media->comment(): " . $e->getMessage(), true)->setLogDebug();
          

          $this->Log->set("data.error.msg", "Something went wrong")
              ->set("data.error.details", $msg)
              ->save();
          
          return false;
      }


    if (!$resp->isOk()) {
        $this->addDebug("isOk() null", true)->setLogDebug();
      
        $this->Log->set("data.error.msg", "Couldn't comment the media")
            ->set("data.error.details", "Something went wrong")
            ->save();
        
        return false;   
    }


    // Liked new media successfully    
    $this->addDebug("Commented media " . $media_code)->setLogDebug();
    $this->Log->set("status", "success")
        ->set("data.commented", [
            "media_id" => $media_id,
            "media_code" => $media_code,
            "media_type" => $media_type,
            "media_thumb" => $media_thumb,
            "user" => [
                "pk" => $user_pk,
                "username" => $user_username,
                "full_name" => $user_full_name
            ],
            "comment" => $Emojione->toShort($comment)
        ])
        ->set("source_pk", $media_code)
        ->set("user_pk", $user_pk)
        ->save();
      
      
      return true;
  }
  
  protected function chooseComment($comments, $do_spintax, $variables)
  {
    $i = rand(0, count($comments) - 1);
    $comment = $comments[$i];

    $default_variables = [
        "{{username}}" => "{{username}}",
        "{{full_name}}" => "{{full_name}}",
        "{{first_name}}" => "{{first_name}}",
    ];
    $variables = array_merge($default_variables, $variables);
    if (empty($variables["{{full_name}}"])) {
        $variables["{{full_name}}"] = $variables["{{username}}"];
    }
    if (empty($variables["{{first_name}}"])) {
        $variables["{{ffirst_name}}"] = $variables["{{username}}"];
    }

    $search = array_keys($variables);
    $replace = array_values($variables);

    $comment = str_replace($search, $replace, $comment,$comment);

    // Emojione client
    $Emojione = new \Emojione\Client(new \Emojione\Ruleset());

    $comment = $Emojione->shortnameToUnicode($comment);
    if ($do_spintax) {
        $comment = \Spintax::process($comment);
    }

    return $comment;
  }

  protected function runNewFollowers()
  {
    $this->addDebug("called runNewFollowers()");
    if(!$this->saveFollowers) {
      $this->addDebug("saveFollowers is disabled");
     // return false;
    }
    
    $now = new \DateTime();
    
    if($this->sc->get("all_schedules.new_followers")) {
      
      $this->addDebug("all_schedules.new_followers exists");
      $date = new \DateTime($this->sc->get("all_schedules.new_followers"));
      $time = $date->getTimestamp();
      
      $this->addDebug("***");
      $this->addDebug("NF shcedule getTimestamp: " . $time . " - " . $this->sc->get("all_schedules.new_followers"));
      $this->addDebug("NF shcedule strtotime: " . strtotime($this->sc->get("all_schedules.new_followers")) . " - " . $this->sc->get("all_schedules.new_followers"));
      $this->addDebug("***");
      $this->addDebug("getTimestamp without date: " . $now->getTimestamp() . " - " . date("Y-m-d H:i:s", $now->getTimestamp()));
      $this->addDebug("time() : " . time() . " - " . date("Y-m-d H:i:s", time()));
      $this->addDebug("strtotime(now) : " . strtotime("now") . " - " . date("Y-m-d H:i:s", strtotime("now")));
      $this->addDebug("***");
      
      if ($time >= $now->getTimestamp()) {
        $this->addDebug("not time to check for new followers...");
        return false;
      }
      
    } else {
      
      $this->addDebug("all_schedules.new_followers doest exists");
      $time = $now->getTimestamp();
      $this->sc->set("all_schedules.new_followers", date("Y-m-d H:i:s", $time))->save();
      
    }

    
    if ($this->rand_min || $this->rand_max) {
      $this->random_delay = rand($this->rand_min, $this->rand_max);
    }
      
    $delta = (round(3600/$this->saveFollowersSpeed)) + $this->random_delay;

    $next_schedule = date("Y-m-d H:i:s", $now->getTimestamp() + $delta);
    $this->sc->set("all_schedules.new_followers", $next_schedule)->save();
    
    $this->addDebug("Next Schedule for new followers: " . $next_schedule);
    $list = $this->getFeedNewFollowers();
    
    if(!$list) {
      $this->addDebug("empty new followers feed");
      return false;
    }
    
    $log = new LogModel();
    $tb = $log->getTableName();
    
    foreach($list as $k => $v) {
      $follower = new NewFollowerModel([
          "user_id"     => $this->User->get("id"),
          "account_id"  => $this->Account->get("id"),
          "user_pk"     => $v['id'],
      ]);
      if ($follower->isAvailable()) {
        $this->addDebug("follower already saved: @" . $v['username']);
        continue;
      }
      
      //check where user came from
      $log = \DB::table($tb)
        ->where("user_id", "=", $this->User->get("id"))
        ->where("account_id", "=", $this->Account->get("id"))
        ->where("status", "=", "success")
        ->where("action", "!=", "unfollow")
        ->where("action", "!=", "welcomedm")
        ->where("action", "!=", "viewstory")
        ->where("user_pk", "=", $v['id'])
        ->orderBy("id", "DESC")
        ->limit(1)
        ->get();
      
      $log = isset($log[0]) ? $log[0] : null;
      if(!$log) {
        continue;
      }
      $type = explode(".",$log->target);

      $follower->set("user_id", $this->User->get("id"))
        ->set("account_id", $this->Account->get("id"))
        ->set("action", $log->action ? $log->action : "unknow")
        ->set("username", $v['username'])
        ->set("user_pk", $v['id'])
        ->set("target", $log->target)
        ->set("target_value", $log->target_value)
        ->save();
    }
    return true;
   
    
  }
  
  protected function runWelcomeDM()
  {
    $this->Log->set("action", "welcomedm");
      
    $this->addDebug("called runWelcomeDM()");

    $follower_id          = null;
    $follower_username    = null;
    $follower_fullname    = null;
    $follower_profile_pic = null;
    $Emojione             = new \Emojione\Client(new \Emojione\Ruleset());
    $dms                  = @json_decode($this->sc->get("dms"));
    
    // Check dms
    if (is_null($dms)) {
        // Unexpected, data modified by external factors or empty comments
        // Deactivate schedule
        $this->sc->set("action_welcomedm", 0)->save();

        // Log data
      $this->addDebug("DMs list is null", true)->setLogDebug();
        $this->Log->set("data.error.msg", "Couldn't get messeges list")->save();
        return false;
    }

    if (count($dms) < 1) {
        // Comment list is empty
        // Deactivate schedule
        $this->sc->set("action_welcomedm", 0)->save();

        $this->addDebug("Direct Messeges list is empty", true)->setLogDebug();
        // Log data
        $this->Log->set("data.error.msg", "Direct Messeges list is empty.")->save();
        return false;
    }
    
    //$this->Log->set("data.trigger", $this->target);
    $list = $this->getFeedNewFollowers();
    
    if(!$list) {
      $this->addDebug("you dont have new followers.");
      return false;
    }
    
    $this->addDebug("Feed size: " . count($list));
    
    $log = new LogModel();
    $tb = $log->getTableName();
    
    foreach($list as $k => $v) {
      $log = new LogModel([
          "user_id"     => $this->sc->get("user_id"),
          "account_id"  => $this->sc->get("account_id"),
          "source_pk"   => $v['id'],
          "action"      => "welcomedm",
          "status"      => "success"
      ]);
      if($log->isAvailable()) {
        $this->addDebug("msg already sent to @" . $v['username']);
        continue;
      }
      $follower_id          = $v['id'];
      $follower_username    = $v['username'];
      $follower_fullname    = $v['fullname'];
      $follower_profile_pic = $v['pic'];
      break;
    
    }

    if(!$follower_id) {
      $this->addDebug("empty follower_id", true);
      return false;
    }

    // Emojione client
    $Emojione = new \Emojione\Client(new \Emojione\Ruleset());

    // Select random message from the defined message collection
    $i = rand(0, count($dms) - 1);
    $message = $dms[$i];
    
    //check user info to get full_name
    if((strstr($message, "{{full_name}}") || strstr($message, "{{first_name}}"))
      && !$follower_fullname) {
      try {
        $userDetail         = $this->ig->people->getInfoById($follower_id);
        $follower_fullname  = $userDetail->getUser()->getFullName();
        } catch (\Exception $e) {
          // Don't anything here, accept the issue as not found
        }
    }

    $search = ["{{username}}", "{{full_name}}", "{{first_name}}"];
    $first_name = $follower_fullname ? explode(" ", $follower_fullname)[0] : "@".$follower_username;
    $replace = ["@".$follower_username, 
                $follower_fullname ? $follower_fullname : "@".$follower_username,
                $first_name];
    $message = str_replace($search, $replace, $message);

    $message = $Emojione->shortnameToUnicode($message);

    // Check spintax permission
    if ($this->User->get("settings.spintax")) {
        $message = \Spintax::process($message);
    }
    
    // New folloer found
    // Send DM
    try {
        $res = $this->ig->direct->sendText(
            ["users" => [$follower_id]], 
            $message);
    } catch (\Exception $e) {
        $msg = $e->getMessage();
        $msg = explode(":", $msg, 2);
        $msg = isset($msg[1]) ? $msg[1] : $msg[0];
      
        $this->handleActionError($e->getMessage());
        $this->addDebug("Error in direct->sendText(): " . $e->getMessage(), true)->setLogDebug();

        $this->Log->set("data.error.msg", "Couldn't send a message")
            ->set("data.error.details", $msg)
            ->save();
      return false;
    }
    
    // Send DM successfully
    // Save log
    $this->Log->set("status", "success")
        ->set("data.message", $Emojione->toShort($message))
        ->set("data.to", [
            "id" => $follower_id,
            "username" => $follower_username,
            "fullname" => $follower_fullname,
            "profile_pic" => $follower_profile_pic
        ])
        ->set("source_pk", $follower_id)
        ->set("user_pk", $follower_id)
        ->save();
    
    $this->addDebug("DM sent to @" . $follower_username, true)->setLogDebug();
    
    return true;
   
    
  }
  
  protected function runViewStory()
  {
    $media_id       = null;
    $media_code     = null;
    $media_type     = null;
    $media_thumb    = null;
    $user_pk        = null;
    $user_username  = null;
    $user_full_name = null;
    $itemInstance   = null;
    
    $this->Log->set("action", "viewstory");
    $this->addDebug("called runViewStory()");
    
    try {
      $res = $this->ig->story->getReelsTrayFeed();
    } catch (\Exception $e) {
        $msg = $e->getMessage();
        $msg = explode(":", $msg, 2);
        $msg = isset($msg[1]) ? $msg[1] : $msg[0];
      
        $this->handleActionError($e->getMessage());
        $this->addDebug("Error in direct->getReelsTrayFeed(): " . $e->getMessage(), true)->setLogDebug();

        $this->Log->set("data.error.msg", "Couldn't send a message")
            ->set("data.error.details", $msg)
            ->save();
      return false;
    }
    //echo $res->printJson(); exit;
    
    foreach($res->getTray() as $tray) {
       if(!$tray->getUser()) {
          $this->addDebug("Invalid getUser");
          continue;
      }
      
      if($tray->getSeen()) {
        $this->addDebug("item saw");
        continue;
      }

      try {
        $user_pk        = $tray->getUser()->getPk();
        $user_username  = $tray->getUser()->getUsername();
        $user_full_name = $tray->getUser()->getFullName(); 
      } catch(\Exception $e) {
        $this->addDebug("cant get user from this story");
        continue;
      }
      
      if( !$tray->getItems()) {
        $this->addDebug("call getUserReelMediaFeed - empty getItem() @" . $user_username);
        try {
          $sub = $this->ig->story->getUserReelMediaFeed($user_pk);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $msg = explode(":", $msg, 2);
            $msg = isset($msg[1]) ? $msg[1] : $msg[0];

            $this->handleActionError($e->getMessage());
            $this->addDebug("Error in direct->getUserReelMediaFeed({$user_pk}): " . $e->getMessage(), true)->setLogDebug();
          
            $this->Log->set("data.error.msg", "Couldn't send a message")
                ->set("data.error.details", $msg)
                ->save();
          return false;
        }
        
        if( !$sub->getItems()) {
          $this->addDebug("empty getItems in subcall" . $user_username);
          continue;
        }
        
        if(!$sub->getUser()) {
          $this->addDebug("Invalid getUser (in sub)");
          continue;
        }
        
        $user_pk        = $sub->getUser()->getPk();
        $user_username  = $sub->getUser()->getUsername();
        $user_full_name = $sub->getUser()->getFullName();
        
        foreach($sub->getItems() as $item) {
          $media_id       = $item->getId();
          $media_code     = $item->getCode();
          $media_type     = $item->getMediaType();
          $media_thumb    = $this->get_media_thumb_igitem($item);
          $itemInstance   = $item;
          
          if($media_id) {
            break 2;
          }
        }
      } else {
        foreach($tray->getItems() as $item) {
          $media_id       = $item->getId();
          $media_code     = $item->getCode();
          $media_type     = $item->getMediaType();
          $media_thumb    = $this->get_media_thumb_igitem($item);
          $itemInstance   = $item;
          if($media_id) {
            break 2;
          }
        } 
      }
    }
    
   if (!$media_id) {
      $this->addDebug("no media_id", true)->setLogDebug();
      $this->Log->set("data.error.msg", "Couldn't find the new story to see")->save();
      return false;
    }
    
    
      // New media found
      // See it!
      try {
          $resp = $this->ig->story->markMediaSeen([$itemInstance]);
      } catch (\Exception $e) {
          $msg = $e->getMessage();
          $msg = explode(":", $msg, 2);
          $msg = isset($msg[1]) ? $msg[1] : $msg[0];
        
          $this->handleActionError($e->getMessage());
          $this->addDebug("Error when Seeing story: " . $e->getMessage(), true)->setLogDebug();
        
          $this->Log->set("data.error.msg", "Something went wrong")
              ->set("data.error.details", $msg)
              ->save();
          
          return false;
      }


    if (!$resp->isOk()) {
      $this->addDebug("isOk() null", true)->setLogDebug();
      $this->Log->set("data.error.msg", "Couldn't seen new story")
          ->set("data.error.details", "Something went wrong")
          ->save();
        
      return false;   
    }


    // Liked new media successfully
    $this->addDebug("Story saw " . $media_code, true)->setLogDebug();
    $this->Log->set("status", "success")
        ->set("data.saw", [
            "media_id" => $media_id,
            "media_code" => $media_code,
            "media_type" => $media_type,
            "media_thumb" => $media_thumb,
            "user" => [
                "pk" => $user_pk,
                "username" => $user_username,
                "full_name" => $user_full_name
            ]
        ])
        ->set("source_pk", $media_code)
        ->set("user_pk", $user_pk)
        ->save();
    
      return true;
  }
/*---------------------------
    Prepare Actions
___________________________ */
  
protected function orderActionsList()
{
  $this->addDebug("called orderActionsList()");
  $actions = [];
  if($this->sc->get('action_follow') || $this->sc->get('action_unfollow')) {
    if($this->sc->get("all_schedules.follow")) {
      $date = new \DateTime($this->sc->get("all_schedules.follow"));
      $time = $date->getTimestamp();
    } else {
      $time = time() + 60;
    }
    $actions['follow'] = $time;
    
  } else {
    $actions['follow'] = null;
  }
  
  if($this->sc->get('action_like')) {
    if($this->sc->get("all_schedules.like")) {
      $date = new \DateTime($this->sc->get("all_schedules.like"));
      $time = $date->getTimestamp();
    } else {
      $time = time() + 60;
    }
    $actions['like'] = $time;
  } else {
    $actions['like'] = null;
  }
  
  if($this->sc->get('action_comment')) {
    if($this->sc->get("all_schedules.comment")) {
      $date = new \DateTime($this->sc->get("all_schedules.comment"));
      $time = $date->getTimestamp();
    } else {
      $time = time() + 60;
    }
    $actions['comment'] = $time;
  } else {
    $actions['comment'] = null;
  }
  
  if($this->sc->get('action_welcomedm')) {
    if($this->sc->get("all_schedules.welcomedm")) {
      $date = new \DateTime($this->sc->get("all_schedules.welcomedm"));
      $time = $date->getTimestamp();
    } else {
      $time = time() + 60;
    }
    $actions['welcomedm'] = $time;
  } else {
    $actions['welcomedm'] = null;
  }
  
  if($this->sc->get('action_viewstory')) {
    if($this->sc->get("all_schedules.viewstory")) {
      $date = new \DateTime($this->sc->get("all_schedules.viewstory"));
      $time = $date->getTimestamp();
    } else {
      $time = time() + 60;
    }
    $actions['viewstory'] = $time;
  } else {
    $actions['viewstory'] = null;
  }
  
  asort($actions);
  return $actions;
  
}
  
   /*
    * Prepare to run actions
    * (check user, account and others)
    * @return bool
   */
  protected function prepareActions()
  {
    
    $this->Log      = new LogModel;
    $this->Account  = \Controller::model("Account", $this->sc->get("account_id"));
    $this->User     = \Controller::model("User", $this->sc->get("user_id"));
    
    $this->calculateSpeed();    
    
    // Check targets
    if (!$this->checkTargets()) {
        return false;
    }

    // Set default values for the log (not save yet)...
    $this->Log->set("user_id", $this->User->get("id"))
        ->set("account_id", $this->Account->get("id"))
        ->set("unfollowed", 0)
        ->set("status", "error");
    
    
    //in case of no action
    if ( !$this->sc->get("action_follow") && 
        !$this->sc->get("action_unfollow") && 
        !$this->sc->get("action_like") && 
        !$this->sc->get("action_comment") && 
        !$this->sc->get("action_welcomedm") &&
        !$this->sc->get("action_viewstory")) {
        
        $this->addDebug("No action active")->setLogDebug();
      
        $this->Log->set("data.error.msg", "Activity has been stopped")
            ->set("data.error.details", "No Action to run.")
            ->save();
        return false;
    }

    // Check account
    if (!$this->checkAccount()) {
        return false;
    }


    // Check user
    if (!$this->checkUser()) {
        return false;
    }

    // Login into the account
    if (!$this->loginInstagram()) {
        return false;
    }

    return true;
  }
  
   /*
    * Handle white list
    * @param $action string: get, add, remove
    * @param $item string|int
    * @return void
   */
  protected function handleWhitelist($action = "get", $item = null)
  {
    if($action == 'get') {
      $this->whitelist = (array) @json_decode($this->sc->get("whitelist"));
    } elseif($action == 'add') {
      $this->whitelist[] = $item;
      $this->sc->set("whitelist", json_encode($this->whitelist))->save();
      $this->whitelist = (array) @json_decode($this->sc->get("whitelist"));
    } elseif($action == 'remove') {
      if ($item && isset($this->whitelist[$item]) && is_int($item)) {
        unset($this->whitelist[$item]);
      }
    }
  }
  
   /*
    * Check is account is available
    * @return bool
   */
  protected function checkAccount()
  {
    if (!$this->Account->isAvailable() || $this->Account->get("login_required")) {
      // Account is either removed (unexected, external factors)
      // Or login required for this account
      // Deactivate schedule
      //$this->sc->set("is_active", 0)->save();

      // Log data
      $this->addDebug("Error in checkAccount()")->setLogDebug();
      $this->Log->set("data.error.msg", "Activity has been stopped")
          ->set("data.error.details", "Re-login is required for the account.")
          ->save();
      
      
      return false;
    }
    return true;
    
  }
  
   /*
    * Check is user is available
    * @return bool
   */
  protected function checkUser()
  {
    if (!$this->User->isAvailable() || !$this->User->get("is_active") || $this->User->isExpired()) {
        // User is not valid
        // Deactivate schedule
        //$this->sc->set("is_active", 0)->save();

        // Log data
        $this->addDebug("Error in checkUser(): user not available", true)->setLogDebug();
      
        /*
        $this->Log->set("data.error.msg", "Activity has been stopped")
            ->set("data.error.details", "User account is either disabled or expired.")
            ->save();
        */
        return false;
    }
    
    if ($this->User->get("id") != $this->Account->get("user_id")) {
      // Unexpected, data modified by external factors
      // Deactivate schedule
      //$this->sc->set("is_active", 0)->save();
      $this->addDebug("Error in checkUser(): user id different from account_user_id", true)->setLogDebug();
      return false;
    }
    
    // Check user access to the module
    $user_modules = $this->User->get("settings.modules");
    if (!is_array($user_modules) || !in_array(IDNAME, $user_modules)) {
        // Module is not accessible to this user
        // Deactivate schedule
        //$this->sc->set("is_active", 0)->save();

        // Log data
        $this->addDebug("Error in checkUser() user without access", true)->setLogDebug();
      /*
        $this->Log->set("data.error.msg", "Activity has been stopped")
            ->set("data.error.details", "Module is not accessible to your account.")
            ->save();
      */
      return false;
    }
    
    return true;
  }
  
  protected function checkTargets()
  {
    $targets = @json_decode($this->sc->get("target"));
    $this->hasTarget = true;
    if ((is_null($targets) || count($targets) < 1)) {
      // no target set
      $this->hasTarget = false;
      $this->addDebug("No target... check if can unfollow", true);
    }
    
    if( !$this->hasTarget && 
       !$this->sc->get("action_unfollow") && 
       !$this->sc->get("action_welcomedm") && 
       !$this->sc->get("action_viewstory")
      ) {
        $this->addDebug("Invalid Target and cant unfollow", true);
        return false;
    }
    return true;
  }
  
   /*
    * Calculate next Schedule
    * @return void
   */
  protected function setNextSchedule($filter = "all")
  {
    $isUnfollow = $filter == "unfollow";
    $filter = $filter == "unfollow" ? "follow" : $filter;
    $allSchedulesDate = (array) json_decode($this->sc->get("all_schedules"));

    $this->addDebug("call setNextSchedule(). filter: " . $filter . '; now: ' . date('Y-m-d H:i:s'), true);
    $this->addDebug("scSpeed: " . print_r($this->scSpeed, true));
    
    if($filter == "follow" && $isUnfollow) {
      $this->addDebug("is unfollow: " . $this->scSpeedUnfollow);
    }
    
    $schedulesChanged = [];
    foreach($this->scSpeed as $action => $speed) {
      if(!$speed && $filter != "all") {
        continue;
      }
      if($filter == "follow" && $isUnfollow) {
        $speed = $this->scSpeedUnfollow;
      }
      if($filter == "all") {
        $speed = $speed == 0 ? 1 : $speed;
      }
      
      if($filter != "all" && $filter != $action) {
        $this->addDebug("skiping next schedule for {$action}", true);
        continue;
      }
      $this->addDebug("setting next schedule for {$action}", true);
      
      if ($this->rand_min || $this->rand_max) {
        $this->random_delay = rand($this->rand_min, $this->rand_max);
      }
      
      $delta = (round(3600/$speed)) + $this->random_delay;
      
      $next_schedule = date("Y-m-d H:i:s", time() + $delta);

      $dayle_pause = false;
      $dayle_pause_source = false;
      if ($this->settings->get("data.pause_status") == 2 && $this->settings->get("data.daily_pause")) {
        $this->addDebug("daily pause setted by system");
        $dayle_pause_source = 'system';

        //system daily pause 
        $dayle_pause = true;
        $pause_from = date("Y-m-d")." ".$this->settings->get("data.daily_pause_from");
        $pause_to = date("Y-m-d")." ".$this->settings->get("data.daily_pause_to");

      } elseif($this->settings->get("data.pause_status") == 1 && $this->sc->get("daily_pause")) {
        $this->addDebug("daily pause setted by user");
        $dayle_pause_source = 'user';
        //user daily pause
        $dayle_pause = true;
        $pause_from = date("Y-m-d")." ".$this->sc->get("daily_pause_from");
        $pause_to = date("Y-m-d")." ".$this->sc->get("daily_pause_to");

      } else {
        $this->addDebug("daily pause skiped");
      }
      
      if ($dayle_pause) {

          if ($pause_to <= $pause_from) {
              // next day
              $pause_to = date("Y-m-d", time() + 86400)." ".
                ($dayle_pause_source == 'user' ? $this->sc->get("daily_pause_to") : $this->settings->get("data.daily_pause_to"));
          }

          if ($next_schedule > $pause_to) {
              // Today's pause interval is over
              $pause_from = date("Y-m-d H:i:s", strtotime($pause_from) + 86400);
              $pause_to = date("Y-m-d H:i:s", strtotime($pause_to) + 86400);
          }

          if ($next_schedule >= $pause_from && $next_schedule <= $pause_to) {
              $next_schedule = $pause_to;
          }
      }
      if($speed) {
        $schedulesChanged[$action] = $next_schedule;  
      }    
      $allSchedulesDate[$action] = $next_schedule;
      
    }
    
    if(!$allSchedulesDate) {
      return false;
    }
    
    $timestamps = [];
    foreach($allSchedulesDate as $k => $v) {
      try {
        $date = new \DateTime($v);
        $timestamps[$k] = $date->getTimestamp();
      } catch(\Exception $e) {
        $this->addDebug("error in get timeStamp: " . $e->getMessage());
        continue;
      }
    }
    
    asort($timestamps);
    reset($timestamps);
    $first = key($timestamps);
    $next_schedule = $allSchedulesDate[$first];
    
    $this->addDebug("Next Schedule: " . print_r($allSchedulesDate, true), true);
    $this->addDebug("Random delay: " . $this->random_delay);
    
    if (isset($_GET["instant"])) {
      $this->addDebug("Skip setNexSchedule()");
      return;
    }

    $this->sc->set("schedule_date", $next_schedule)
        ->set("all_schedules", json_encode($allSchedulesDate))
        ->set("last_action_date", date("Y-m-d H:i:s"))
        ->save();
  }
  
   /*
    * Follow/unfollow does not run together
    * Here we decide which one will run
    * @return string
   */
  protected function resolveFollowUnfollow()
  {
    $this->addDebug("resolving follow (follow_count: " . $this->sc->get("follow_count") . ")", true);

    if(!$this->sc->get("action_unfollow")) {
      //cant unfollow...
      $this->addDebug("cant unfollow...");
      $this->sc->set("cicle_follow", "follow"); 
      $cicle_follow = "follow";
      
      // invalid target and cant unfollo. stop.
      if( !$this->hasTarget) {
        $this->addDebug("invalid target and cant unfollow :(", true);
        return false;
      }
      

    } elseif( !$this->sc->get("action_follow")) {

      //cant follow...
      $this->addDebug("cant follow");
      $this->sc->set("cicle_follow", "unfollow"); 
      $cicle_follow = "unfollow";

    } else {
      //unfollow is default
      if($this->sc->get("cicle_follow") == "unfollow") {

        $this->addDebug("unfollow is default");
        $cicle_follow = "unfollow";

      } else {
        $this->addDebug("can follow and unfollow");

        //change to unfollow
        if ($this->sc->get("follow_count") > 0 && 
            $this->sc->get("follow_count") >= $this->sc->get("follow_cicle"))
        {
          $this->addDebug("from follow to unfollow");
          $this->sc->set("cicle_follow", "unfollow")->set("follow_count", 0);
          $cicle_follow = "unfollow";
        } else {
          $this->addDebug("keep follow!");
          $this->sc->set("cicle_follow", "follow");
          $cicle_follow = "follow";
        }
      }
    }
    return $cicle_follow;
  }

  
   /*
    * Login in instagram
    * @return bool
   */
  protected function loginInstagram()
  {
      try {
        $this->ig = \InstagramController::login($this->Account);
        return true;
      } catch (\Exception $e) {
        $this->addDebug("Erro login Instagram: " . $e->getMessage(), true);
        // Couldn't login into the account
        $this->Account->refresh();
        // Log data
        if ($this->Account->get("login_required")) {
          //$this->sc->set("is_active", 0)->save();
          $this->Log->set("data.error.msg", "Activity has been stopped");
        } else {
          $this->Log->set("data.error.msg", "Action re-scheduled");
        }
        
        $this->handleActionError($e->getMessage());
        
        $this->addDebug("Erro Login Instagram (after refresh): " . $e->getMessage(), true)->setLogDebug();
        $this->Log->set("data.error.details", $e->getMessage())->save();
        
        return false;
      }
  }

  protected function calculateSpeed()
  {
    $this->addDebug("Calculating speed");

    $speedSelected  = $this->sc->get("speed") ? $this->sc->get("speed") : 'auto';
    $speed          = (int) (isset($this->default_speeds[$speedSelected]) ? $this->default_speeds[$speedSelected] : $this->default_speeds['auto']);
    
    $this->addDebug("Speed Selected: {$speedSelected} - Speed {$speed}");
    
    $speedFollow    = ($this->sc->get("action_follow") || $this->sc->get("action_unfollow")) ? $this->settings->get("data.speeds.follow_". $speedSelected) : 0;
    
    $speedUnfollow  = $this->sc->get("action_unfollow") ? $this->settings->get("data.speeds.unfollow_". $speedSelected) : 0;
    $speedLike      = $this->sc->get("action_like") ? $this->settings->get("data.speeds.like_". $speedSelected) : 0;
    $speedComment   = $this->sc->get("action_comment") ? $this->settings->get("data.speeds.comment_". $speedSelected) : 0;
    $speedDM        = $this->sc->get("action_welcomedm") ? $this->settings->get("data.speeds.welcomedm_". $speedSelected) : 0;
    $speedStory     = $this->sc->get("action_viewstory") ? $this->settings->get("data.speeds.viewstory_". $speedSelected) : 0;
    
    $this->addDebug("Speeds: follow ({$speedFollow}), like ({$speedLike}), comment ({$speedComment}, dm ({$speedDM}, story ({$speedStory})");
    //speed in trial
    if(!$this->User->isAdmin() && $this->User->get("package_id") < 1) {
      $speedFollow  = $this->settings->get("data.max_speed_trial.follow") < $speedFollow ? $this->settings->get("data.max_speed_trial.follow") : $speedFollow;
      $speedUnfollow  = $this->settings->get("data.max_speed_trial.unfollow") < $speedUnfollow ? $this->settings->get("data.max_speed_trial.unfollow") : $speedUnfollow;
      $speedLike    = $this->settings->get("data.max_speed_trial.like") < $speedLike ? $this->settings->get("data.max_speed_trial.like") :$speedLike;
      $speedComment = $this->settings->get("data.max_speed_trial.like") < $speedComment ? $this->settings->get("data.max_speed_trial.like") : $speedComment;
      $speedDM      = $this->settings->get("data.max_speed_trial.welcomedm") < $speedDM ? $this->settings->get("data.max_speed_trial.welcomedm") : $speedDM;
      $speedStory   = $this->settings->get("data.max_speed_trial.viewstory") < $speedStory ? $this->settings->get("data.max_speed_trial.viewstory") : $speedStory;
      $this->addDebug("User in trial. New speeds: follow ({$speedFollow}), like ({$speedLike}), comment ({$speedComment}, dm ({$speedDM}, story ({$speedStory})");
    }
    
    $this->scSpeed = [
      'follow'    => ($this->sc->get("action_follow") || $this->sc->get("action_unfollow")) && $speedFollow == 0 ? 1 : $speedFollow,
      'like'      => $this->sc->get("action_like") && $speedLike == 0 ? 1 : $speedLike,
      'comment'   => $this->sc->get("action_comment") && $speedComment == 0 ? 1 : $speedComment,
      'welcomedm' => $this->sc->get("action_welcomedm") && $speedDM == 0 ? 1 : $speedDM,
      'viewstory' => $this->sc->get("action_viewstory") && $speedStory == 0 ? 1 : $speedStory,
    ];
    $this->scSpeedUnfollow = $this->sc->get("action_unfollow") && $speedUnfollow == 0 ? 1 : $speedUnfollow;
  }
  
  protected function setTarget()
  {
    $this->target = null;
    $targets = @json_decode($this->sc->get("target"));
    if ((is_null($targets) || count($targets) < 1)) {
        $this->addDebug("No target on setTarget");
        return;
    }
    $i = rand(0, count($targets) - 1);

    $target = isset($targets[$i]) ? $targets[$i] : (object) ['type' => null, 'id' => null, 'value' => null];
    
    if ((empty($target->value) || empty($target->id) || !in_array($target->type, ["hashtag", "location", "people"])))
    {
      $this->addDebug("Target is invalid..");
      return;
    }
    if ($target->type) {
      $this->Log->set("target", $target->type . "." . $target->id);
      $this->Log->set("target_value", $target->value);
      $this->addDebug("Target: {$target->type} - {$target->id} - {$target->value}");
    } else {
      $this->addDebug("no target");
      return;
    }
    $this->target = $target;    
    $this->Log->set("data.trigger", $this->target);
  }
  
  protected function getFeed()
  {    
    $this->TargetsObj = new TargetModel([
      "user_id"       => $this->sc->get("user_id"),
      "account_id"    => $this->sc->get("account_id"),
      "type"          => $this->target->type,
      "value"         => $this->target->value,
      "target_id"     => $this->target->id,
    ]);
    
    if($this->TargetsObj->isAvailable()) {
      $list = @json_decode($this->TargetsObj->get("items"), true);
      if($list && sizeof($list) > 0) {
        $this->addDebug("getting feed from DB: " . sizeof($list),true);
        return $list;
      }
      $data = @json_decode($this->TargetsObj->get("data"), true);
    } else {
      $this->addDebug("building feed", true);
      $data = [];
      $data = json_decode(json_encode($data));
    }
    
    $data = [];
    $data = json_decode(json_encode($data));
    
    $rank_token = \InstagramAPI\Signatures::generateUUID();
    $maxId      = null;
   
    if($this->target->type == "hashtag") {
      $feed = [];
      $hashtag = str_replace("#", "", trim($this->target->id));
      if (!$hashtag) {
        $this->addDebug("Invalid hashtag #" . $hashtag);

        $this->Log->set("data.error.msg", "Couldn't get the feed")
          ->set("data.error.details", "Invalid hashtag")
          ->save();

        return false;
      }

      for($i=1; $i<=$this->maxPagination; $i++) {
        $this->addDebug("Build list page #" . $i . " of #" . $this->maxPagination);
        $currentItem = [];
        $error = false;
        $msg = "";
        try {
            $res = $this->ig->hashtag->getFeed($hashtag, $rank_token, $maxId);
            $currentItem = $res->getItems();
            $this->addDebug("size: " . sizeof($currentItem));
            $maxId = $res->getNextMaxId();
          } catch (\Exception $e) {
            $msg = $e->getMessage();
            $msg = explode(":", $msg, 2);
            $msg = isset($msg[1]) ? $msg[1] : $msg[0];

            $this->handleActionError($e->getMessage());
            $this->addDebug("Error getting feed: " . $e->getMessage());
          
            $error = true;
        }
        
        if($error) {
          $this->Log->set("data.error.msg", "Couldn't get the feed")
              ->set("data.error.details", $msg)
              ->save();
          
          $this->addDebug("Error getting data: " . $msg, true);
          return false;
        }
        
        if(!$currentItem) {
          $this->addDebug("current page is empty");
          break;
        }
        $feed[] = $currentItem;
        if($maxId == null) {
          $this->addDebug("no more maxId");
          break;
        }
        sleep($this->sleepTime);
      }
      
    } elseif($this->target->type == "location") {
      $feed = [];
      for($i=1; $i<=$this->maxPagination; $i++) {
        $this->addDebug("Build list page #" . $i . " of #" . $this->maxPagination);
        $currentItem = [];
        $error = false;
        $msg = "";
        try {
          $res = $this->ig->location->getFeed($this->target->id, $rank_token, $maxId);
          $currentItem = $res->getItems();
          $this->addDebug("size: " . sizeof($currentItem));
          $maxId = $res->getNextMaxId();
          
        } catch (\Exception $e) {
          $msg = $e->getMessage();
          $msg = explode(":", $msg, 2);
          $msg = isset($msg[1]) ? $msg[1] : $msg[0];

          $this->handleActionError($e->getMessage());
          $this->addDebug("Error getting feed: " . $e->getMessage());

          $error = true;
        }
        if($error) {
          $this->Log->set("data.error.msg", "Couldn't get the feed")
              ->set("data.error.details", $msg)
              ->save();
          
          $this->addDebug("Error getting data: " . $msg, true);
          return false;
        }
        
        if(!$currentItem) {
          $this->addDebug("current page is empty");
          break;
        }
        
        $feed[] = $currentItem;
        if($maxId == null) {
          $this->addDebug("no more maxId");
          break;
        }
        
        sleep($this->sleepTime);
      }
      
    } elseif($this->target->type == "people") {
      $feed = [];
      for($i=1; $i<=$this->maxPagination; $i++) {
        $this->addDebug("Build list page #" . $i . " of #" . $this->maxPagination);
        $currentItem = [];
        $error = false;
        $msg = "";
        try {
          $res = $this->ig->people->getFollowers($this->target->id, $rank_token, null, $maxId);
          $currentItem = $res->getUsers();
          $this->addDebug("size: " . sizeof($currentItem));
          $maxId = $res->getNextMaxId();
        } catch (\Exception $e) {
          $msg = $e->getMessage();
          $msg = explode(":", $msg, 2);
          $msg = isset($msg[1]) ? $msg[1] : $msg[0];

          $this->handleActionError($e->getMessage());
          $this->addDebug("Error getFollowers: " . $e->getMessage());

          $error = true;
        }
        if($error) {
          $this->Log->set("data.error.msg", "Couldn't get the feed")
              ->set("data.error.details", $msg)
              ->save();
          
          $this->addDebug("Error getting data: " . $msg, true);
          return false;
        }
        
        if(!$currentItem) {
          $this->addDebug("current page is empty");
          break;
        }
        
        $feed[] = $currentItem;
        if($maxId == null) {
          $this->addDebug("no more maxId");
          break;
        }
        
        sleep($this->sleepTime);
      }
    }
    $items = [];
    $count = 0;
    foreach($feed as $obj) {
      foreach($obj as $k => $f) {
        if($this->target->type == "people") {
          $key = $f->getPk();
          $items[$key] = [
            'type'            => $this->target->type,
            'full'            => false,
            'pk'              => $f->getPk(),
            'username'        => $f->getUsername(),
            'full_name'       => $f->getFullName(),
            'is_private'      => $f->getIsPrivate(),
            'profile_pic_url' => $f->getProfilePicUrl(),
            'friendship'      => null,
          ];
        } else {
          $user = $f->getUser();
          $key = $f->getPk();
          $items[$key] = [
            'type'        => $this->target->type,
            'pk'          => $f->getPk(),
            'id'          => $f->getId(),
            'media_type'  => $f->getMediaType(),
            'code'        => $f->getCode(),
            'image'       => $this->get_media_thumb_igitem($f),
            'user'        => [
                  'type'            => $this->target->type,
                  'full'            => false,
                  'pk'              => $user->getPk(),
                  'username'        => $user->getUsername(),
                  'full_name'       => $user->getFullName(),
                  'is_private'      => $user->getIsPrivate(),
                  'profile_pic_url' => $user->getProfilePicUrl(),
            ],
            'has_liked' => $f->getHasLiked()
          ];
          if($user->getFriendshipStatus()) {
            try {
              $items[$key]['user']["friendship"] = $user->getFriendshipStatus()->getFollowing() || $user->getFriendshipStatus()->getOutgoingRequest();
            } catch(\Exception $e) {
              $items[$key]['user']["friendship"] = false;
            }
          } else {
            $items[$key]['user']["friendship"] = false;
          }
          if($f->getCaption()) {
            $items[$key]['caption'] = $f->getCaption()->getText();
          } else {
            $items[$key]['caption'] = "";
          }
        }
        $count++;
      }
      $count++;
    }
    $this->addDebug("list size: " . sizeof($items));
    
    $items = json_encode($items);
    $this->TargetsObj->set("user_id", $this->sc->get("user_id"))
      ->set("account_id", $this->sc->get("account_id"))
      ->set("type", $this->target->type)
      ->set("value", $this->target->value)
      ->set("target_id", $this->target->id)
      ->set('items', $items)
      ->set("data", json_encode($data))
      ->save();
    
    return json_decode($items, true);
  }
  
  protected function getFeedFromUserList($userList = [])
  {
    $this->addDebug("Looking for a user to get his feed", true);
    $feed = [];
    foreach($userList as $k => $item) {
      $selected = null;
      if ($item['is_private']) {
        $this->addDebug("user @" . $item['username'] . " is private. skipped", true);
        unset($userList[$k]);
        continue;
      }
      
      if ($item['pk'] != $this->Account->get("instagram_id") && $this->validateUser($item)) {

        if($this->maxTried > $this->maxTry) {
          $this->addDebug("max IG request reached: {$this->maxTry}", true);
          break;
        }

        $this->maxTried++;

        $this->addDebug("getting feed from @" . $item['username'], true);

        try {
          $res = $this->ig->timeline->getUserFeed($item['pk']);
          $feed = $res->getItems();
          sleep($this->sleepTime);
        } catch (\Exception $e) {
          $this->addDebug("error getting feed: " . $e->getMessage());
          unset($userList[$k]);
          sleep($this->sleepTime);
          continue;
        }

        if(count($feed) < 1) {
          $this->addDebug("empty feed :/", true);
          continue;
          unset($userList[$k]);
        }
        
        $selected = $item;
        shuffle($feed);
        unset($userList[$k]);
        break;
      }
      unset($userList[$k]);
    }
    
    $items = [];
    foreach($feed as $k => $f) {
      $user = $f->getUser();
      $items[$k] = [
        'type'        => $this->target->type,
        'pk'          => $f->getPk(),
        'id'          => $f->getId(),
        'media_type'  => $f->getMediaType(),
        'code'        => $f->getCode(),
        'image'       => $this->get_media_thumb_igitem($f),
        'user'        => [
              'pk'              => $user->getPk(),
              'username'        => $user->getUsername(),
              'full_name'       => $user->getFullName(),
              'is_private'      => $user->getIsPrivate(),
              'profile_pic_url' => $user->getProfilePicUrl(),
              'friendship'      => null,
        ],
        'has_liked'   => $f->getHasLiked()
      ];
      if($f->getCaption()) {
        $items[$k]['caption'] = $f->getCaption()->getText();
      } else {
        $items[$k]['caption'] = "";
      }
    }
    $this->TargetsObj->set("items", json_encode($userList))->save();
    
    return [
      'userSelected' => $selected,
      'items' => $items
    ];
    
  }
  
  protected function getFeedNewFollowers()
  {
    try {
      $res = $this->ig->people->getRecentActivityInbox();
    } catch (\Exception $e) {
      $msg = $e->getMessage();
      $msg = explode(":", $msg, 2);
      $msg = isset($msg[1]) ? $msg[1] : $msg[0];

      $this->handleActionError($e->getMessage());
      $this->addDebug("Error getting getRecentActivityInbox: " . $e->getMessage());//->setLogDebug();
      return false;
    }

    $stories = array_merge($res->getNewStories(), $res->getOldStories());
    $stories = array_reverse($stories);
    $list = [];
    foreach ($stories as $s) {
      $item = [];
      if ($s->getType() != 3 || !$s->getArgs()->getProfileId()) {
          continue;
      }

      if ($s->getArgs()->getInlineFollow()) {
        $item = [
          'username'  => $s->getArgs()->getInlineFollow()->getUserInfo()->getUsername(),
          'fullname'  => $s->getArgs()->getInlineFollow()->getUserInfo()->getFullName(),
          'pic'       => $s->getArgs()->getInlineFollow()->getUserInfo()->getProfilePicUrl()
        ];
      } else {
        $item = [
          'username'  => $s->getArgs()->getProfileName(),
          'fullname'  => '',
          'pic'       => $s->getArgs()->getProfileImage()
        ];
      }
      $item['id']     = $s->getArgs()->getProfileId();
      $item['timestamp'] = $s->getArgs()->getTimestamp();

      $list[] = $item;

      if ($s->getArgs()->getSecondProfileId()) {
        // Get user info for the second profile
        try {
          $second_profile_info = $this->ig->people->getInfoById($s->getArgs()->getSecondProfileId());
          $list[] = [
            'username'  => $second_profile_info->getUser()->getUsername(),
            'fullname'  => $second_profile_info->getUser()->getFullName(),
            'pic'       => $s->getArgs()->getSecondProfileImage(),
            'id'        => $s->getArgs()->getSecondProfileId(),
            'timestamp' => $s->getArgs()->getTimestamp()
          ];
        } catch (\Exception $e) {
          // Don't anything here, accept the issue as not found
        }
        sleep($this->sleepTime);
      }
    }
    
    return $list;
  }

}

/**
 * Add cron task to run automation
 */
function addCronTask($type = 'default', $key = null)
{
  require_once __DIR__."/models/SchedulesModel.php";
  
  require_once __DIR__."/models/LogsModel.php";
  require_once __DIR__."/models/LogModel.php";
  
  require_once __DIR__."/models/TargetsModel.php";
  require_once __DIR__."/models/TargetModel.php";
  
  require_once __DIR__."/models/NewFollowerModel.php";
  require_once __DIR__."/models/NewFollowersModel.php";
  
  
  //pevent cron running over cron  
  $file = PLUGINS_PATH."/boost/cron-status.txt";
  if(!file_exists($file)) {
    file_put_contents($file, "1");
  }

  if(\Input::get("cs")) { //cs = cronStatus
    file_put_contents($file, "2");
    return false;
  }
  
  if(\Input::get("scs")) { //show cron status code
    header('Content-Type: text/plain; charset=utf-8');
    $res = @file_get_contents($file);
    echo $res == 2 ? 2 : 1;
    return false;
  }

  $cronStatus = file_get_contents($file);
  if($cronStatus == 1) {
    //@TODO block to avoid cron over cron
  }

  $boost = new Boost();
  $BoostCronType = $boost->getObj("cronType");
  $boost->setCronKey($key);
  
  if($BoostCronType == "default" && ($type != "default" || !is_null($key))) {
    return false;
  }
  if ($BoostCronType == "dedicated" && ($type != "dedicated" || !is_null($key))) {
    return false;
  }
  
  if($BoostCronType == "multiple" && ($type != "multiple" || is_null($key))) {
    return false;
  }

  $boost->initActions();
}
\Event::bind("cron.boost", __NAMESPACE__."\addCronTask");
\Event::bind("cron.add", __NAMESPACE__."\addCronTask");

