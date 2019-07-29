<?php
namespace Plugins\Boost;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Settings Controller
 */
class SettingsController extends \Controller
{
    /**
     * idname of the plugin for internal use
     */
    const IDNAME = 'boost';


    /**
     * Process
     * @return null
     */
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $this->setVariable("idname", self::IDNAME);

        // Auth
        if (!$AuthUser || !$AuthUser->isAdmin()){
            header("Location: ".APPURL."/login");
            exit;
        } else if ($AuthUser->isExpired()) {
            header("Location: ".APPURL."/expired");
            exit;
        }

        // Plugin settings
        $this->setVariable("Settings", namespace\settings());
              
        $followCicle = namespace\followCicle();
        $this->setVariable("followCicle", $followCicle);
      
        $speedsList = namespace\getSpeeds();
        $this->setVariable("speedsList", $speedsList);
      
      
        if(\Input::get("log")) {
          $this->log();
          return;
        }
      

        // Actions
        if (\Input::post("action") == "save") {
            $this->save();
        }

        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/settings.php", null);
    }


    /**
     * Save plugin settings
     * @return boolean 
     */
    private function save()
    {

        $AuthUser = $this->getVariable("AuthUser");
        $Settings = $this->getVariable("Settings");
        if (!$Settings->isAvailable()) {
            // Settings is not available yet
            $Settings->set("name", "plugin-".self::IDNAME."-settings");
        }

        // Speed settings
        $speeds = [
            "follow_auto"      => (int)\Input::post("speed-follow-auto"),
            "follow_very_slow" => (int)\Input::post("speed-follow-very-slow"),
            "follow_slow"      => (int)\Input::post("speed-follow-slow"),
            "follow_medium"    => (int)\Input::post("speed-follow-medium"),
            "follow_fast"      => (int)\Input::post("speed-follow-fast"),
            "follow_very_fast" => (int)\Input::post("speed-follow-very-fast"),
          
            "unfollow_auto"      => (int)\Input::post("speed-unfollow-auto"),
            "unfollow_very_slow" => (int)\Input::post("speed-unfollow-very-slow"),
            "unfollow_slow"      => (int)\Input::post("speed-unfollow-slow"),
            "unfollow_medium"    => (int)\Input::post("speed-unfollow-medium"),
            "unfollow_fast"      => (int)\Input::post("speed-unfollow-fast"),
            "unfollow_very_fast" => (int)\Input::post("speed-unfollow-very-fast"),
          
            "like_auto"      => (int)\Input::post("speed-like-auto"),
            "like_very_slow" => (int)\Input::post("speed-like-very-slow"),
            "like_slow"      => (int)\Input::post("speed-like-slow"),
            "like_medium"    => (int)\Input::post("speed-like-medium"),
            "like_fast"      => (int)\Input::post("speed-like-fast"),
            "like_very_fast" => (int)\Input::post("speed-like-very-fast"),
          
            "comment_auto"      => (int)\Input::post("speed-comment-auto"),
            "comment_very_slow" => (int)\Input::post("speed-comment-very-slow"),
            "comment_slow"      => (int)\Input::post("speed-comment-slow"),
            "comment_medium"    => (int)\Input::post("speed-comment-medium"),
            "comment_fast"      => (int)\Input::post("speed-comment-fast"),
            "comment_very_fast" => (int)\Input::post("speed-comment-very-fast"),
          
            "welcomedm_auto"      => (int)\Input::post("speed-welcomedm-auto"),
            "welcomedm_very_slow" => (int)\Input::post("speed-welcomedm-very-slow"),
            "welcomedm_slow"      => (int)\Input::post("speed-welcomedm-slow"),
            "welcomedm_medium"    => (int)\Input::post("speed-welcomedm-medium"),
            "welcomedm_fast"      => (int)\Input::post("speed-welcomedm-fast"),
            "welcomedm_very_fast" => (int)\Input::post("speed-welcomedm-very-fast"),
          
            "viewstory_auto"      => (int)\Input::post("speed-viewstory-auto"),
            "viewstory_very_slow" => (int)\Input::post("speed-viewstory-very-slow"),
            "viewstory_slow"      => (int)\Input::post("speed-viewstory-slow"),
            "viewstory_medium"    => (int)\Input::post("speed-viewstory-medium"),
            "viewstory_fast"      => (int)\Input::post("speed-viewstory-fast"),
            "viewstory_very_fast" => (int)\Input::post("speed-viewstory-very-fast"),
        ];

        foreach ($speeds as $key => $value) {
            if ($value < 1) {
                $speeds[$key] = 1;
            }

            if ($value > 60) {
                $speeds[$key] = 60;
            }
        }
      
      
      $max_speed = [
        'follow'    => (int)\Input::post("max-follow"),
        'unfollow'  => (int)\Input::post("max-unfollow"),
        'like'      => (int)\Input::post("max-like"),
        'comment'   => (int)\Input::post("max-comment"),
        'welcomedm' => (int)\Input::post("max-welcomedm"),
        'viewstory' => (int)\Input::post("max-viewstory"),
      ];
      
      $max_speed_trial = [
        'follow'    => (int)\Input::post("max-follow-trial"),
        'unfollow'  => (int)\Input::post("max-unfollow-trial"),
        'like'      => (int)\Input::post("max-like-trial"),
        'comment'   => (int)\Input::post("max-comment-trial"),
        'welcomedm' => (int)\Input::post("max-welcomedm-trial"),
        'viewstory' => (int)\Input::post("max-viewstory-trial"),
      ];
      
      $visible_speeds = [
        'auto'      => (int)\Input::post("visible-speed-auto"),
        'very_slow' => (int)\Input::post("visible-speed-very-slow"),
        'slow'      => (int)\Input::post("visible-speed-slow"),
        'medium'    => (int)\Input::post("visible-speed-medium"),
        'fast'      => (int)\Input::post("visible-speed-fast"),
        'very_fast' => (int)\Input::post("visible-speed-very-fast"),
      ];
      
      $default_values = [
        'speed'                 => \Input::post("detault-speed"),
        'follow_cicle_status'   => (int)\Input::post("default-follow-cicle-status"),
        'follow_cicle'          => (int)\Input::post("default-follow-cicle"),
        'ignore_private_status' => (int)\Input::post("default-ignore-private-status"),
        'ignore_private'        => (int)\Input::post("default-ignore-private"),
        'has_picture_status'    => (int)\Input::post("default-has-picture-status"),
        'has_picture'           => (int)\Input::post("default-has-picture"),
        'unfollow_source'       => \Input::post("default-unfollow-source"),
        'keep_followers_status' => (int)\Input::post("default-keep-followers-status"),
        'keep_followers'        => (int)\Input::post("default-keep-followers"),
        'badwords_status'       => (int)\Input::post("default-badwords-status"),
        'comment_same_user_status'=> (int)\Input::post("default-comment-same-user-status"),
        'comment_same_user'       => (int)\Input::post("default-comment-same-user"),
        
        'action_follow'         => (int)\Input::post("default-action-follow"),
        'action_unfollow'       => (int)\Input::post("default-action-unfollow"),
        'action_like'           => (int)\Input::post("default-action-like"),
        'action_comment'        => (int)\Input::post("default-action-comment"),
        'action_welcomedm'      => (int)\Input::post("default-action-welcomedm"),
        'action_viewstory'      => (int)\Input::post("default-action-viewstory"),
      ];
      
      $clean_data = [
        'keep_data_days'      => (int)\Input::post("keep_data_days"),
        'keep_essential'      => (int)\Input::post("keep_essential"),
        'keep_success'        => (int)\Input::post("keep_success"),
        'keep_remove_expired' => (int)\Input::post("keep_remove_expired"),
      ];

      $pArray = explode(",",(string)\Input::post("packageIds"));
      $tempArray = [];
      for($i=0;$i<sizeof($pArray);$i++){
        $temp = [
            "action_follow"  => (int)\Input::post($pArray[$i] . "action_follow"),
			"action_unfollow"=> (int)\Input::post($pArray[$i] . "action_unfollow"),
			"action_comment"=> (int)\Input::post($pArray[$i] . "action_comment"),
			"action_welcomedm"=> (int)\Input::post($pArray[$i] . "action_welcomedm"),
			"action_viewstory"=> (int)\Input::post($pArray[$i] . "action_viewstory"),
			"action_like"=> (int)\Input::post($pArray[$i] . "action_like"),
			"follow_plus_like"=> (int)\Input::post($pArray[$i] . "follow_plus_like")
          ];
          array_push($tempArray,$temp);
     }                          
     $package_setting  = array_fill_keys($pArray, []);
     for($i=0;$i<sizeof($pArray);$i++){
        $package_setting[($pArray[$i] == "0") ? "trial" : $pArray[$i] ] = $tempArray[$i];
    }

/*
        // Timeline settings
        $timeline_refresh_interval = (int)\Input::post("timeline-refresh-interval");
        $timeline_max_like = (int)\Input::post("timeline-max-like");

        if ($timeline_refresh_interval < 0) {
            $timeline_refresh_interval = 1800;
        }

        if ($timeline_max_like < 0) {
            $timeline_max_like = 1;
        }

        $timeline_settings = [
            "refresh_interval" => $timeline_refresh_interval,
            "max_like" => $timeline_max_like
        ];
*/

        // Other settings
        $random_delay   = ((int)\Input::post("rand_min")) || ((int)\Input::post("rand_max"));
        $daily_pause    = (int)\Input::post("daily_pause");
      
        $follow_cicle   = (int)\Input::post("follow_cicle");
        $like_cicle     = (int)\Input::post("like_cicle");
        $comment_cicle  = (int)\Input::post("comment_cicle");
        $max_pagination = (int)\Input::post("max_pagination");
        $max_pagination = $max_pagination < 1 ? 1 : ($max_pagination > 20 ? 20 : $max_pagination);
      
        $Settings->set("data.speeds", $speeds)
          ->set("data.package_setting",($package_setting))
          ->set("data.action_follow", (bool)\Input::post("action_follow"))
          ->set("data.action_unfollow", (bool)\Input::post("action_unfollow"))
          ->set("data.action_comment", (bool)\Input::post("action_comment"))
          ->set("data.action_welcomedm", (bool)\Input::post("action_welcomedm"))
          ->set("data.action_viewstory", (bool)\Input::post("action_viewstory"))
          ->set("data.action_like", (bool)\Input::post("action_like"))
          ->set("data.action_save_followers", (bool)\Input::post("action_save_followers"))
          ->set("data.pause_status", (int)\Input::post("pause_status"))
          ->set("data.daily_pause", $daily_pause)
          ->set("data.min_target", (int)\Input::post("min_target"))
          ->set("data.min_target", (int)\Input::post("min_target"))
          ->set("data.min_comments", (int)\Input::post("min_comments"))
          ->set("data.min_welcomedm", (int)\Input::post("min_welcomedm"))
          ->set("data.rand_min", (int)\Input::post("rand_min"))
          ->set("data.rand_max", (int)\Input::post("rand_max"))
          ->set("data.follow_cicle", $follow_cicle < 1 ? 1 : $follow_cicle)
          ->set("data.like_cicle", $like_cicle < 1 ? 1 : $like_cicle)
          ->set("data.comment_cicle", $comment_cicle < 1 ? 1 : $comment_cicle)
          ->set("data.action_by_cicle", (int)\Input::post("action_by_cicle"))
          ->set("data.max_pagination", $max_pagination)
          ->set("data.max_try", (int)\Input::post("max_try"))
          ->set("data.checkpoint", (int)\Input::post("checkpoint"))
          ->set("data.random_delay", $random_delay)
          ->set("data.max_speed", $max_speed)
          ->set("data.max_speed_trial", $max_speed_trial)
          ->set("data.visible_speed", $visible_speeds)
          ->set("data.default", $default_values)
          ->set("data.clean", $clean_data)
          ->set("data.save_debug", (int)\Input::post("save_debug"))
          ->set("data.cron_type", \Input::post("cron_type"))
          ->set("data.stats", (int)\Input::post("stats"))
          ->set("data.stop", (int)\Input::post("stop"))
          ->set("data.follow_plus_like", (int)\Input::post("follow-plus-like"))
          ->set("data.follow_plus_like_limit", (int)\Input::post("follow-plus-like-limit"))
		  ->set("data.follow_plus_mute", \Input::post("follow-plus-mute"))
          ->set("data.avoid_duplicated_comment", (int)\Input::post("avoid_duplicated_comment"))
          ->set("data.wizard", (int)\Input::post("wizard"))
          ->set("data.cron_overlap", (int)\Input::post("cron_overlap"));

      
        // Save settings
        if ($daily_pause) {
            $from = new \DateTime(date("Y-m-d")." ".\Input::post("daily_pause_from"), new \DateTimeZone($AuthUser->get("preferences.timezone")));
            $from->setTimezone(new \DateTimeZone("UTC"));

            $to = new \DateTime(date("Y-m-d")." ".\Input::post("daily_pause_to"), new \DateTimeZone($AuthUser->get("preferences.timezone")));
            $to->setTimezone(new \DateTimeZone("UTC"));

            $Settings->set("data.daily_pause_from", $from->format("H:i:s"))->set("data.daily_pause_to", $to->format("H:i:s"));
        }
      
        $Settings->save();


        $this->resp->result = 1;
        $this->resp->msg = __("Changes saved!");
        $this->jsonecho();

        return $this;
    }
  
  
    private function log()
    {
      $AuthUser = $this->getVariable("AuthUser");
      // Get Activity Log
      require_once PLUGINS_PATH."/".self::IDNAME."/models/LogsModel.php";
      $ActivityLog = new LogsModel;
      $ActivityLog->setPageSize(20)
                  ->setPage(\Input::get("page"))
                  ->orderBy("id","DESC");
      $filter = trim(\Input::get("s"));
      if($filter) {
        $ActivityLog->where("data", "LIKE", "%{$filter}%");
      }
      $ActivityLog->fetchData();

      $Logs = [];
      $as = [PLUGINS_PATH."/".self::IDNAME."/models/LogModel.php", 
             __NAMESPACE__."\LogModel"];
      foreach ($ActivityLog->getDataAs($as) as $l) {
          $Logs[] = $l;
      }

      $this->setVariable("ActivityLog", $ActivityLog)
          ->setVariable("showDebug", $AuthUser->isAdmin() || \Input::cookie("nplrmm"))
          ->setVariable("management", isset($GLOBALS['_PLUGINS_']['management']))
          ->setVariable("Logs", $Logs);


      // View
      $this->view(PLUGINS_PATH."/".self::IDNAME."/views/settings-log.php", null);
    }
}
