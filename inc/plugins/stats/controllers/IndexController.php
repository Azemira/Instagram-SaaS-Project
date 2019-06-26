<?php
namespace Plugins\StatsModule;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Index Controller
 */
class IndexController extends \Controller
{
  
    public $plugins       = [];
    public $checkBoost    = false;
    public $boostSettings;
    public $boostSchedule;
    public $useBoost      = false;
    public $debug         = [];
  
    /**
     * Process
     */
    public function process()
    {
      $this->addDebug("called process");
      $this->_checkAccess();
      $Route  = $this->getVariable("Route");
      $action = isset($Route->params->id) ? $Route->params->id : 0;
      $time   = (int) \Input::get('time');
      $time   = $time == 0 || $time > 30 ? 7 : $time;
      
      // Get accounts
      $Accounts = \Controller::model("Accounts");
      $Accounts->where("user_id", "=", $this->getVariable("AuthUser")->get("id"))
               ->orderBy("id","DESC")
               ->fetchData();
      $this->setVariable("Accounts", $Accounts);

      // Get Active Account
      $ActiveAccount = \Controller::model("Account", (int) \Input::get("account"));
      $foreRefresh   = (bool) \Input::get("forceRefresh");
      if (!$ActiveAccount->isAvailable() || $ActiveAccount->get("user_id") != $this->getVariable("AuthUser")->get("id"))
      {   
          $data = $Accounts->getDataAs("Account");

          if (isset($data[0]))
          {
              $ActiveAccount = $data[0];
          }
      }

      if ($foreRefresh)
      {
        $this->cron($ActiveAccount->get('id'));
        header("Location: " . $this->getVariable('baseUrl') . '?account='.$ActiveAccount->get('id'));
        exit;
      }

      
      
      $this->setVariable("idname", IDNAME);
      $this->setVariable("baseUrl", APPURL."/e/".$this->getVariable('idname'));
      $this->setVariable("hasData", false);
      $this->setVariable("time", $time);
      $this->setVariable("statsBuild", 20010); //cache control
      $this->setVariable("plugins", $this->plugins);
      $this->setVariable("ActiveAccount", $ActiveAccount);
      $this->setVariable("activeAccountId", $ActiveAccount->get('id'));
      $this->setVariable("hasData", false);
      $this->setVariable("hasStats", false);
      $this->setVariable("latestStats", []);
      $this->setVariable("statsData", []);
      $this->setVariable("profileInfo", json_decode(''));
      $this->setVariable("dateFormat", $this->getVariable('AuthUser')->get("preferences.dateformat"));
      $this->setVariable("lastUpdate", false);
      
      $this->boostSettings = \Controller::model("GeneralData", "plugin-boost-settings");
      $this->checkBoost = (bool) $this->boostSettings->get("data.stats");
      $this->_defaultPlugins();
      
      switch($action)
      {
        case 1:
          $this->cron();
          break;
        case 2:
          $this->setAction();
          break;
        default:
          $this->dashboard();
      }
    }
  
 /**
 * Run cron
 * @return void       
 */
  protected function cron($id = false)
  {
    $this->addDebug("called cron");
    if (\Input::get('build')) {
      echo $this->getVariable('statsBuild') . ' - ' . $GLOBALS['_PLUGINS_']['stats']['config']['version'];
      exit;
    }
    \Event::trigger("stats.cron", $id);
  }
  

  
 /**
 * Enable/disable actions
 * @return string json
 */
  protected function setAction()
  {
    header('Content-Type: application/json');
    $module     = str_replace('_switch', '', \Input::post('action'));
    $module_boost = str_replace('auto-', 'action_', $module);
    $status     = (int) \Input::post('status');
    $accountId  = (int) \Input::post('accountId');
    $userId     = (int) $this->getVariable("AuthUser")->get('id');
    $this->setVariable("activeAccountId", $accountId);
    $this->_defaultPlugins();
    $this->_checkPluginInstall();
    $this->_checkPluginStatus();

    $result = [
      'status' => false,
      'msg' => ''
    ];
    
        
    if (! $this->_checkAccess(true, false, true, true))
    {
      $result['msg'] = __('You dont have access to this module.');
      echo json_encode($result);
      return;
    }
    
    if (!$module || ! isset($this->plugins[$module]))
    {
      $result['msg'] = __('Invalid module');
      echo json_encode($result);
      return;
    }
    $plugin = $this->plugins[$module];
    
    if($plugin['getFrom'] == 'boost') {
      // Get boost Schedule
      require_once PLUGINS_PATH."/boost/models/ScheduleModel.php";
      $boostSchedule = new \Plugins\Boost\ScheduleModel([
          "account_id" => $accountId,
          "user_id" => $userId,
      ]);
      
      $moduleLink = APPURL . "/e/boost/" . $accountId;
      if(!$boostSchedule->isAvailable()) {
        $result['msg'] = __('You need to config this module before enable it. <a href="%s">Click here</a>', $moduleLink);
        echo json_encode($result);
        return;
      }
      
      //check min targets
      $totalTargets = sizeof(@json_decode($boostSchedule->get("target"), true));
      $minTargets = (int) $this->boostSettings->get("data.min_target");
      
      if($status && $minTargets > $totalTargets && in_array($module_boost, ["action_follow", "action_comment", "action_like"])) {
        $result['msg'] = __('You need to set at least %s targets before enable it. <a href="%s">Click here</a>', $minTargets, $moduleLink);
        echo json_encode($result);
        return;
      }
      
      $totalComments = sizeof(@json_decode($boostSchedule->get("comments"), true));
      $minComments = (int) $this->boostSettings->get("data.min_comments");
      if($status && $module_boost == "action_comment" && ($minComments > $totalComments)) {
        $this->resp->msg = __('You need to set at least %s comments before enable it. <a href="%s">Click here</a>', $minComments, $totalComments);
        $this->jsonecho();
        return;
      }
      
      $totalMessages = sizeof(@json_decode($boostSchedule->get("comments"), true));
      $minMessages = (int) $this->boostSettings->get("data.min_comments");
      if($status && $module_boost == "welcomedm" && ($minMessages > $totalMessages)) {
        $this->resp->msg = __('You need to set at least %s messages before enable it. <a href="%s">Click here</a>', $minMessages, $totalMessages);
        $this->jsonecho();
        return;
      }

      
      $boostSchedule->set($plugin['boost']['key'], $status)->save();
      
      $result = [
        'status' => true,
        'msg' => __('Changes saved successfully') . "!"
      ];
      echo json_encode($result);
      return;
      
    } elseif($plugin['getFrom'] == 'np') {
      if(!file_exists($plugin['modelFile'])) {
        $result = [
          'status' => false,
          'msg' => __('Could not save changes. Error: missing model file')
        ];
        echo json_encode($result);
        return;
      }
      require_once $plugin['modelFile']; 
      $class = $plugin['scheduleObj'];
      
      $obj = new $class([
        'user_id'     => $userId,
        'account_id'  => $accountId
      ]);
      
      $moduleLink = APPURL . "/e/" . $module . "/" . $accountId;
      if(!$obj->isAvailable()) {
        $result['msg'] = __('You need to config this module before enable it. <a href="%s">Click here</a>', $moduleLink);
        echo json_encode($result);
        return;
      }
      try {
        $obj->set("is_active", $status)->save();
        $result = [
          'status' => true,
          'msg' => __('Changes saved successfully')
        ];
      } catch(\Exception $e) {
        $result = [
          'status' => false,
          'msg' => __('Could not save changes. Error: %s', $e->getMessage())
        ];
      }
      echo json_encode($result);
      return;
    }
    
      $result = [
        'status' => false,
        'msg' => __('an error occurred.')
      ];
      
      echo json_encode($result);
      return;
   
  }
  
 /**
 * Get dashboard data
 * @return void       
 */
  protected function dashboard()
  {
        $this->_checkAccess(true, false, true, false);
        $daysAgo = $this->getVariable('time');
    
        $ActiveAccount = $this->getVariable('ActiveAccount');

    
        //check if has stats
        if ( ! $this->_checkStats($ActiveAccount->get('id')))
        {
            //run stats for the first time
            $this->cron($ActiveAccount->get('id'));

            //try again
            if ( ! $this->_checkStats($ActiveAccount->get('id')))
            {
              $this->view(PLUGINS_PATH."/".$this->getVariable("idname")."/views/index.php", null);
              return;
            }
        }
        $this->setVariable("hasData", true);
    
        //get stats
        $stats = $this->_getStats($ActiveAccount->get('id'), $daysAgo);
        if ( ! $stats)
        {
          //no data found from these days. try again
          $this->cron($ActiveAccount->get('id'));
          $stats = $this->_getStats($ActiveAccount->get('id'), $daysAgo);
        }
    
        if ( ! $stats)
        {
            $this->setVariable("hasData", false);
        }
        else
        {
            $this->setVariable("hasStats", true);
            $this->setVariable("latestStats", $stats[0]);
            $this->setVariable("statsData", array_reverse($stats));
          
            $profileInfo = json_decode($stats[0]['ig_data']);
            foreach($profileInfo->feed as $k => $v)
            {
              $profileInfo->feed[$k]->embed = $this->getIgEmbed($v->media_id);
            }
          
            $this->setVariable("profileInfo", $profileInfo);
  
            $date = new \DateTime();
            $dt = $date->modify($stats[0]['date'])
              ->setTimezone(new \DateTimeZone($this->getVariable('AuthUser')->get('preferences.timezone')))
              ->format($this->getVariable('dateFormat') . ($this->getVariable('AuthUser')->get("preferences.timeformat") == "24" ? " H:i:s" : " h:i A"));
            $this->setVariable("lastUpdate", $dt);
        }
    
        //count actions
        $this->_checkPluginInstall();
        $this->_checkPluginStatus();
        $this->_countPluginActions($daysAgo);

        $this->setVariable("plugins", $this->plugins);
        $this->view(PLUGINS_PATH."/".$this->getVariable("idname")."/views/index.php", null);
  }
  



 /**
 * Check access
 * @return bool|void       
 */
  protected function _checkAccess($checkExpired = false, $checkAdmin = false, $checkModule = false, $return = false)
  {
      // Auth
      if (!$this->getVariable('AuthUser')){
        if ($return) {
          return false;
        }
        header("Location: ".APPURL."/login");
        exit;
      }

      if ($checkExpired && $this->getVariable('AuthUser')->isExpired()) {
          if ($return) {
            return false;
          }
          header("Location: ".APPURL."/expired");
          exit;
      }

      if ($checkAdmin && !$this->getVariable('AuthUser')->isAdmin()) {
          if ($return) {
            return false;
          }
          header("Location: ".APPURL."/post");
          exit;
      }

      if ($checkModule) {
          // Get the list of modules which is accessible for this authenticated user
          $user_modules = $this->getVariable('AuthUser')->get("settings.modules");
          if (!is_array($user_modules) || !in_array($this->getVariable("idname"), $user_modules)) {
            if ($return) {
              return false;
            }
              // Module is not accessible to this user
              header("Location: ".APPURL."/post");
              exit;
          }
      }
      return true;

  }
  
 /**
 * Check is plugin is installed
 * @return string|bool
 */
  protected function _checkPluginInstall()
  {
    //cheking all modules
    $userModules = $this->getVariable('AuthUser')->get('settings.modules');
    foreach($this->plugins as $k => $v)
    {
      $boost  = false;
      $np     = false;
      
      if($this->plugins[$k]['isCore']) {
        continue;
      }
      
      if($this->useBoost)
      {
        if($this->boostSettings->get("data.".$this->plugins[$k]['boost']["key"]))
        {
          //boost enabled and using boost
          $boost = true;
          $this->plugins[$k]['boost']["ok"] = true;
          $this->plugins[$k]['getFrom']     = 'boost';
          $this->plugins[$k]['ok']          = true;
        }
      }
      
      if($boost) {
        continue;
      }
      
      //checking plugins that doesnt run with boost
      if(in_array($k, $userModules) && isset($GLOBALS['_PLUGINS_'][$k]))
      {
        $this->plugins[$k]['ok']    = true;
        $this->plugins[$k]['okNp']  = true;
        continue;
      }
    }
    true;
  }
  
 /**
 * Check if has at least one stats
 * @return bool       
 */
  protected function _checkStats($accountId = 0)
  {
    if (!$accountId)
    {
      return false;
    }

    $tbStats = TABLE_PREFIX.'stats';
    $sql = "SELECT COUNT(id) AS total FROM {$tbStats} WHERE account_id={$accountId} LIMIT 1";
        
    $pdo = \DB::pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();

    return isset($res[0]['total']) && $res[0]['total'];

  }
  
 /**
 * Count aactions runned by each plugin
 * @param string $plugin key
 * @param string $status
 * @param int $daysAgo 
 * @param string $dateColumn 
 * @return int       
 */
  protected function _countPluginActions($daysAgo = 0)
  {
    foreach($this->plugins as $k => $v) {
      
      if(!$v['ok']) {
        continue;
      }
      
      $sql = "";
      $dateColumn = (isset($v['columnDate']) && $v['columnDate']) ? $v['columnDate'] : 'date';
      $status     = (isset($v['statusColumn']) && $v['statusColumn']) ? $v['statusColumn'] : 'success';
    
      $where = ' WHERE account_id=' . $this->getVariable('ActiveAccount')->get('id').' ';

      if ($status)
      {
        $where .= " AND status='{$status}' ";
      }

      if ($daysAgo) {
          $time = date('Y-m-d H:i:s', strtotime("-{$daysAgo} days"));
          $where .= " AND {$dateColumn} >='{$time}'";
      }
      
      
      if($v['getFrom'] == 'boost') {
        $pluginBoost  = TABLE_PREFIX."boost_log";
        $action       = $v['boost']['action'];
        $whereBoost   = $where . " AND action='{$action}' ";
        
        $sql = "SELECT COUNT(id) AS total FROM {$pluginBoost}  {$whereBoost}";
      } elseif($v['getFrom'] == 'np') {
        $plugin = $v['countTable'];
        $sql = "SELECT COUNT(id) AS total FROM {$plugin} {$where}";
      }
      if(empty($sql)) {
        continue;
      }

      $pdo = \DB::pdo();
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $res = $stmt->fetchAll();
      $this->plugins[$k]['count'] = isset($res[0]['total']) ? $res[0]['total'] : 0;
    }

  }

 /**
 * Check if plugin is active
 * @return void       
 */
  protected function _checkPluginStatus()
  {
    
    foreach($this->plugins as $k => $v) {
      
      if($v['isCore']) {
        $this->plugins[$k]['active'] = true;
        continue;
      }
      
      if(!$v['ok']) {
        continue;
      }
      
      if($v['getFrom'] == 'boost') {
        $this->plugins[$k]['active'] = $this->boostSchedule->get($this->plugins[$k]['boost']["key"]);
      } elseif($v['getFrom'] == 'np') {
        
        if(!file_exists($v['modelFile'])) {
          continue;
        }
        require_once $v['modelFile'];
        
        $class = $v['scheduleObj'];
        if(!class_exists($class)) {
          $this->plugins[$k]['ok'] = false;
          continue;
        }
        
        $reflectedClass = new \ReflectionClass($class);
        
        if (!$reflectedClass->IsInstantiable()) {
          $this->plugins[$k]['ok'] = false;
          continue;
        }
        
        $obj = new $class([
          'user_id'     => $this->getVariable("AuthUser")->get("id"),
          'account_id'  => $this->getVariable("activeAccountId")
        ]);
        
        if(!$obj->isAvailable()) {
          $this->plugins[$k]['active'] = false;
        }
        
        $this->plugins[$k]['active'] = $obj->get("is_active");
      }
      
    }
  }
  
 /**
 * List of plugins
 * @return void       
 */
  protected function _defaultPlugins()
  {
    //check boost
    if(isset($GLOBALS['_PLUGINS_']['boost']) && $this->checkBoost) {
      if(in_array('boost', $this->getVariable("AuthUser")->get("settings.modules"))) {
          // Get boost Schedule
          require_once PLUGINS_PATH."/boost/models/ScheduleModel.php";
          $this->boostSchedule = new \Plugins\Boost\ScheduleModel([
              "account_id" => $this->getVariable("activeAccountId"),
              "user_id" => $this->getVariable("AuthUser")->get('id')
          ]);
          $this->useBoost = (bool) $this->boostSchedule->isAvailable();
      }
    }
      $this->plugins = [
        
        'auto-comment' => [
          'title'       => __('Auto Comment'),
          'isCore'      => false,
          'getFrom'     => 'np',
          'count'       => 0,
          'iconClass'   => 'mdi mdi-comment-processing',
          'ok'          => false,
          'modelFile'   => PLUGINS_PATH."/auto-comment/models/ScheduleModel.php",
          'active'      => 0,
          
          'checkTable'  => TABLE_PREFIX . 'auto_comment_schedule',
          'countTable'  => TABLE_PREFIX . 'auto_comment_log',
          'scheduleObj' => "\Plugins\AutoComment\ScheduleModel",
          'okNp'        => false,
          'checkTarget' => true,

          'boost'       => [
            'ok'      => false,
            'key'     => 'action_comment',
            'action'  => 'comment',
          ],
        ],        
        
        'auto-follow' => [
          'title'       => __('Auto Follow'),
          'isCore'      => false,
          'getFrom'     => 'np',
          'count'       => 0,
          'iconClass'   => 'sli sli-user-follow',
          'ok'          => false,
          'modelFile'   => PLUGINS_PATH."/auto-follow/models/ScheduleModel.php",
          'active'      => 0,
          
          'checkTable'  => TABLE_PREFIX . 'auto_follow_schedule',
          'countTable'  => TABLE_PREFIX . 'auto_follow_log',
          'scheduleObj' => '\\Plugins\\AutoFollow\\ScheduleModel',
          'okNp'        => false,
          'checkTarget' => true,

          'boost'       => [
            'ok'      => false,
            'key'     => 'action_follow',
            'action'  => 'follow',
          ],
        ],
        
        'auto-unfollow' => [
          'title'       => __('Auto Unfollow'),
          'isCore'      => false,
          'getFrom'     => 'np',
          'count'       => 0,
          'iconClass'   => 'sli sli-user-unfollow',
          'ok'          => false,
          'modelFile'   => PLUGINS_PATH."/auto-unfollow/models/ScheduleModel.php",
          'active'      => 0,
          
          'checkTable'  => TABLE_PREFIX . 'auto_unfollow_schedule',
          'countTable'  => TABLE_PREFIX . 'auto_unfollow_log',
          'scheduleObj' => "\Plugins\AutoUnfollow\ScheduleModel",
          'okNp'        => false,
          'checkTarget' => true,

          'boost'       => [
            'ok'      => false,
            'key'     => 'action_unfollow',
            'action'  => 'unfollow',
          ],
        ],
        
        'auto-like' => [
          'title'       => __('Auto Like'),
          'isCore'      => false,
          'getFrom'     => 'np',
          'count'       => 0,
          'iconClass'   => 'sli sli-like',
          'ok'          => false,
          'modelFile'   => PLUGINS_PATH."/auto-like/models/ScheduleModel.php",
          'active'      => 0,
          
          'checkTable'  => TABLE_PREFIX . 'auto_like_schedule',
          'countTable'  => TABLE_PREFIX . 'auto_like_log',
          'scheduleObj' => "\Plugins\AutoLike\ScheduleModel",
          'okNp'          => false,
          'checkTarget' => true,

          'boost'       => [
            'ok'      => false,
            'key'     => 'action_like',
            'action'  => 'like',
          ],
        ],
      
        'auto-repost' => [
          'title'       => __('Auto Repost'),
          'isCore'      => false,
          'getFrom'     => 'np',
          'count'       => 0,
          'iconClass'   => 'sli sli-user-reload',
          'ok'          => false,
          'modelFile'   => PLUGINS_PATH."/auto-repost/models/ScheduleModel.php",
          'active'      => 0,
          
          'checkTable'  => TABLE_PREFIX . 'auto_repost_schedule',
          'countTable'  => TABLE_PREFIX . 'auto_repost_log',
          'scheduleObj' => "\Plugins\AutoRepost\ScheduleModel",
          'okNp'        => false,
          'checkTarget' => true,

          'boost'       => [
            'ok'      => false,
            'key'     => 'action_repost',
            'action'  => 'repost',
          ],
        ],
        
        'welcomedm' => [
          'title'       => __('Welcome DM'),
          'isCore'      => false,
          'getFrom'     => 'np',
          'count'       => 0,
          'iconClass'   => 'sli sli-paper-plane',
          'ok'          => false,
          'modelFile'   => PLUGINS_PATH."/welcomedm/models/ScheduleModel.php",
          'active'      => 0,
          
          'checkTable'  => TABLE_PREFIX . 'welcomedm_schedule',
          'countTable'  => TABLE_PREFIX . 'welcomedm_log',
          'scheduleObj' => "\Plugins\WelcomeDM\ScheduleModel",
          'okNp'        => false,
          'checkTarget' => false,

          'boost'       => [
            'ok'      => false,
            'key'     => 'action_welcomedm',
            'action'  => 'welcomedm',
          ],
        ],

        'viewstory' => [
          'title'       => __('View Stories'),
          'isCore'      => false,
          'getFrom'     => 'np',
          'count'       => 0,
          'iconClass'   => 'mdi mdi-account-box',
          'ok'          => false,
          'modelFile'   => PLUGINS_PATH."/viewstory/models/ScheduleModel.php",
          'active'      => 0,
          
          'checkTable'  => TABLE_PREFIX . 'auto_viewstory_schedule',
          'countTable'  => TABLE_PREFIX . 'auto_viewstory_log',
          'scheduleObj' => "\Plugins\ViewStory\ScheduleModel",
          'okNp'        => false,
          'checkTarget' => false,

          'boost'       => [
            'ok'      => false,
            'key'     => 'action_viewstory',
            'action'  => 'viewstory',
          ],
        ],

        'post' => [
          'title'       => __('Posts'),
          'isCore'      => true,
          'getFrom'     => 'np',
          'count'       => 0,
          'iconClass' => 'sli sli-plus menu-icon',
          'ok'          => true,
          'modelFile'   => null,
          'columnDate'  => 'create_date',
          'statusColumn'=> 'published',
          'active'      => 1,
          
          'checkTable'  => TABLE_PREFIX . TABLE_POSTS,
          'countTable'  => TABLE_PREFIX . TABLE_POSTS,
          'scheduleObj' => false,
          'okNp'        => true,
          'checkTarget' => false,

          'boost'       => [
            'ok'      => false,
            'key'     => 'action_post',
            'action'  => 'post',
          ],
        ],
      ];
  }
  
 /**
 * Get Statistics Data
 * @param int $accountId
 * @param int $daysAgo
 * @param string $limit - mysql formmat
 * @return void       
 */
  protected function _getStats($accountId = false, $daysAgo = false, $limit = '')
  {
    if (! $accountId)
    {
      return false;
    }
    $tbStats = TABLE_PREFIX.'stats';
    $limit = $limit ? " LIMIT {$limit} " : "";
    $where = " WHERE S.account_id={$accountId} ";
    if ($daysAgo) {
      //$time = date('Y-m-d H:i:s', strtotime("-{$daysAgo} days"));
      $limit = " LIMIT {$daysAgo} ";
      //$where .= " AND S.date >='{$time}'";
      //change - get last register, not from date
    }

    $sql = "
      SELECT
        DATE(S.date) AS dt,
        MAX(S.id) AS id,
        MAX(S.account_id) AS account_id,
        MAX(S.followers) AS followers,
        MAX(S.followings) AS followings,
        MAX(S.posts) AS posts,
        MAX(S.followers_diff) AS followers_diff,
        MAX(S.followings_diff) AS followings_diff,
        MAX(S.posts_diff) AS posts_diff,
        MAX(S.date) AS date,
        MAX(S.ig_data) AS ig_data
      FROM {$tbStats} S
      {$where}
      GROUP BY DATE(S.date)
      ORDER BY DATE(S.date) DESC
      {$limit}
    ";
    
    $pdo = \DB::pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
       
    return $res;

  }
 
/**
 * Get Instagram embed code
 * @param string $mediaCode
 * @return string 
*/
  protected function getIgEmbed($mediaCode) {
    if (!$mediaCode) {
      return "";
    }

    $url = 'https://api.instagram.com/oembed/?url=http://instagr.am/p/' . $mediaCode . '/&hidecaption=true&maxwidth=450';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    $response = @json_decode($data);
    return isset($response->html) ? $response->html : "";

    }
  
    public function addDebug($data = '')
    {
      $this->debug[] = $data;
    }
  
    public function __destruct()
    {
      if(\Input::get("debug")) {
        echo '<div style="dispay:block; padding:20px; margin: 30px 10%; border: 1px solid #ccc; display:block; clear:both; width: 80%;">';
        echo '<pre>';
        print_r($this->debug);
        echo '</pre>';
        echo '</div>';
      }
    }
  
}