<?php
namespace Plugins\InstagramChatbot;
// use \Plugins\InstagramChatbot\SpinTxt;
/**
 * Cron Controller
 */

class ChatbotCronController extends \Controller
{
    const IDNAME = "instagram-chatbot";
    /**
     * Process
     */
    public function process(){
        set_time_limit(0);
        $accountIds = $this->getActiveChatbotAccountIDs();
        $Settings = $this->settingsData();
        echo "<br>-----------------------------------------------------------------------";
        echo "<br> NEW CRON RUN";
       
        foreach($accountIds as $id){
          echo "<br>-----------------------------------------------------------------------";
          echo "<br> Check for pending requests - account id=".$id->account_id ." minutes pased: ". $Settings->since_pending_start . " max wait: ". $Settings->pending_max_time;
          if($Settings->since_pending_start >= $Settings->random_pending_time){
            try {
              echo "<br>Check for pending requests STARTED";
              require_once PLUGINS_PATH."/".self::IDNAME."/controllers/PendingRequests.php";
              $PendingRequests = new PendingRequests;
              $PendingRequests->process($id->account_id);
              $this->setCroneRuntime('pending');
            } catch (\Exception $e) {
              echo "Error: " . $e->getMessage();
            }
          } 

          echo "<br>-----------------------------------------------------------------------";
          echo "<br>Check for new conversation - account id=".$id->account_id ." minutes pased: ". $Settings->since_direct_start . " max wait: ". $Settings->direct_max_time;
          if($Settings->since_direct_start >= $Settings->random_direct_time){
            try {
              echo "<br>Check for new conversation STARTED";
              require_once PLUGINS_PATH."/".self::IDNAME."/controllers/DirectRequests.php";
              $DirectRequests = new DirectRequests;
              $DirectRequests->process($id->account_id);
              $this->setCroneRuntime('direct');
            } catch (\Exception $e) {
              echo "Error: " . $e->getMessage();
            }
          }
        }
        echo "<br>----------------------------------------------------------------------";
        echo "<br>last fast speed run - minutes pased: ". $Settings->since_fast_start . " max wait: ". $Settings->fast_max_time . " curr random: ".$Settings->random_fast_time;
        if($Settings->since_fast_start >= $Settings->random_fast_time){
          $activeFastCronJobs = $this->getActiveCronjobs('fast');
          if($activeFastCronJobs) {
            foreach($activeFastCronJobs as $cron){
              try {
                echo "<br>Check for new messages account_id=".$cron->account_id;
                require_once PLUGINS_PATH."/".self::IDNAME."/controllers/DirectMessages.php";
                $DirectMessages = new DirectMessages;
                $DirectMessages->process($cron);
                $this->setCroneRuntime('fast');
              } catch (\Exception $e) {
                echo "Error: " . $e->getMessage();
              }
    
            }
          } else {
              echo "<br> No fast speed messages to check";
          }
        }
        
        echo "<br>-----------------------------------------------------------------------";
        echo "<br>last slow speed run - minutes pased: ". $Settings->since_slow_start . " max wait: ". $Settings->slow_max_time . " curr random: ".$Settings->random_slow_time;
        if($Settings->since_slow_start >= $Settings->random_slow_time){
          $activeSlowCronJobs = $this->getActiveCronjobs('slow');
          if($activeSlowCronJobs) {
            foreach($activeSlowCronJobs as $cron){
              try {
                echo "<br>Check for new messages account_id=".$cron->account_id;
                require_once PLUGINS_PATH."/".self::IDNAME."/controllers/DirectMessages.php";
                $DirectMessages = new DirectMessages;
                $DirectMessages->process($cron);
                $this->setCroneRuntime('slow');
              } catch (\Exception $e) {
                echo "Error: " . $e->getMessage();
              }
    
            }
          } else {
            echo "<br> No slow speed messages to check";
          }
        }


        echo "<br>-----------------------------------------------------------------------";
        echo "<br>Cron task processed!";
    }

    private function getActiveCronjobs($speed){
      $cronjobs = new \stdClass();
      $tmp_count = 0;
      $query = \DB::table('np_chatbot_cron_jobs')
      ->where("is_terminated", "=", false)
      ->where("fast_speed", "=", $speed == 'fast' ? true : false)
      ->where("slow_speed", "=", $speed == 'slow' ? true : false)
      ->select("*")
      ->get();
     

      if(sizeOf($query)  > 0) {
        foreach($query as $q){
          $account = $this->getChatbotSettinsID($q->account_id);
          if($account->chatbot_status){
            $cronjobs->$tmp_count = $q;
            $tmp_count++;
          }
        }
      }
      return count((array)$cronjobs) > 0 ? $cronjobs : false;
    }

  
  private function getCronSettings(){
    $json = file_get_contents(PLUGINS_PATH."/".self::IDNAME."/assets/json/cron_settings.json");
    return json_decode($json, true)[0];
  }

  private function getCronRunLog(){
    $json = file_get_contents(PLUGINS_PATH."/".self::IDNAME."/assets/json/cron_run_log.json");
    return json_decode($json, true)[0];
  }

  private function setCroneRuntime($log = ''){
    $cronRunLog = $this->getCronRunLog();
    
    switch ($log) {
      case 'pending':
        $cronRunLog["last_pending_cron_run"] = strtotime(date('Y-m-d h:i:s', time()));
      break;
      case 'direct':
        $cronRunLog["last_direct_cron_run"] = strtotime(date('Y-m-d h:i:s', time()));
      break;
      case 'fast':
        $cronRunLog["last_fast_cron_run"] = strtotime(date('Y-m-d h:i:s', time()));
      break;
      case 'slow':
        $cronRunLog["last_slow_cron_run"] = strtotime(date('Y-m-d h:i:s', time()));
      break;
      default:
          return;
  }
   $cronRunLog["last_pending_cron_run"] = $cronRunLog["last_pending_cron_run"] ? $cronRunLog["last_pending_cron_run"] : 0;
   $cronRunLog["last_direct_cron_run"] = $cronRunLog["last_direct_cron_run"] ? $cronRunLog["last_direct_cron_run"] : 0;
   $cronRunLog["last_fast_cron_run"] = $cronRunLog["last_fast_cron_run"] ? $cronRunLog["last_fast_cron_run"] : 0;
   $cronRunLog["last_slow_cron_run"] = $cronRunLog["last_slow_cron_run"] ? $cronRunLog["last_slow_cron_run"] : 0;

    $json_data = '[{ 
      "last_pending_cron_run":'.$cronRunLog["last_pending_cron_run"] .',
      "last_direct_cron_run":'.$cronRunLog["last_direct_cron_run"].',
      "last_fast_cron_run":'.$cronRunLog["last_fast_cron_run"].',
      "last_slow_cron_run":'.$cronRunLog["last_slow_cron_run"]
      .'}]';
    file_put_contents(PLUGINS_PATH."/".self::IDNAME."/assets/json/cron_run_log.json", $json_data);
  }

  private function getActiveChatbotAccountIDs(){
    $query = \DB::table('np_chatbot_settings')
    ->where("chatbot_status", "=", 1)
    ->select("*")
    ->get();
    return $query;
 }

  private function settingsData(){
    $SettingsData = new \stdClass();
  
    $settings = $this->getCronSettings();
    $cronlog = $this->getCronRunLog();

    $random_pending_time = mt_rand($settings["pending_request_time_from"],$settings["pending_request_time_to"]);
    $pendingToTime = $settings["pending_request_time_to"];
    $pending_start_date = $cronlog["last_pending_cron_run"] > 0 ? new \DateTime(date('Y-m-d h:i:s',$cronlog["last_pending_cron_run"]) ) : new \DateTime(date('Y-m-d h:i:s', strtotime("-$pendingToTime minute")));
    $since_pending_start = $pending_start_date->diff(new \DateTime(date('Y-m-d h:i:s', time())));
    $SettingsData->random_pending_time = $random_pending_time;
    $SettingsData->since_pending_start = $since_pending_start->i;
    $SettingsData->pending_max_time = $settings["pending_request_time_to"];

    $random_direct_time = mt_rand($settings["direct_message_time_from"],$settings["direct_message_time_to"]);
    $directToTime = $settings["direct_message_time_to"];
    $direct_start_date = $cronlog["last_direct_cron_run"] > 0 ? new \DateTime(date('Y-m-d h:i:s',$cronlog["last_direct_cron_run"]) ) : new \DateTime(date('Y-m-d h:i:s', strtotime("-$directToTime minute")));
    $since_direct_start = $direct_start_date->diff(new \DateTime(date('Y-m-d h:i:s', time())));
    $SettingsData->random_direct_time = $random_direct_time;
    $SettingsData->since_direct_start = $since_direct_start->i;
    $SettingsData->direct_max_time = $settings["direct_message_time_to"];

    $random_fast_time = mt_rand($settings["fast_speed_time_from"],$settings["fast_speed_time_to"]);
    $fastToTime = $settings["fast_speed_time_to"];
    $fast_start_date = $cronlog["last_fast_cron_run"] > 0 ? new \DateTime(date('Y-m-d h:i:s',$cronlog["last_fast_cron_run"]) ) : new \DateTime(date('Y-m-d h:i:s', strtotime("-$fastToTime minute")));
    $since_fast_start = $fast_start_date->diff(new \DateTime(date('Y-m-d h:i:s', time())));
    $SettingsData->random_fast_time = $random_fast_time;
    $SettingsData->since_fast_start = $since_fast_start->i;
    $SettingsData->fast_max_time = $settings["fast_speed_time_to"];

    $random_slow_time = mt_rand($settings["slow_speed_time_from"],$settings["slow_speed_time_to"]);
    $slowToTime = $settings["slow_speed_time_to"];
    $slow_start_date = $cronlog["last_slow_cron_run"] > 0 ? new \DateTime(date('Y-m-d h:i:s',$cronlog["last_slow_cron_run"]) ) : new \DateTime(date('Y-m-d h:i:s', strtotime("-$slowToTime minute")));
    $since_slow_start = $slow_start_date->diff(new \DateTime(date('Y-m-d h:i:s', time())));
    $SettingsData->random_slow_time = $random_slow_time;
    $SettingsData->since_slow_start = $since_slow_start->i;
    $SettingsData->slow_max_time = $settings["slow_speed_time_to"];

    return $SettingsData;
  }

  public function disableInstagramAccountWithError($account_id){
    require_once PLUGINS_PATH."/".self::IDNAME."/models/SettingModel.php";
    $Setting = new SettingModel;
    $settings = $this->getChatbotSettinsID($account_id);
    $Setting->select($settings->id);
    $Setting->set("chatbot_status", 0)
    ->save();
  }

  public function chatbotErrorLog($account_id, $error, $action){
    $settings = $this->getChatbotSettinsID($account_id);
    require_once PLUGINS_PATH."/".self::IDNAME."/models/ChatbotErrorLog.php";
    $ChatbotErrorLog = new ChatbotErrorLog;
    if(!empty($settings->user_id)){
      $ChatbotErrorLog->set("user_id", $settings->user_id)
      ->set("error_action", $action)
      ->set("date", date('Y-m-d h:i:s', time()))
      ->set("account_id", $account_id)
      ->set("error_message", $error)
      ->save();
    }
  }

  public function getChatbotSettinsID($account_id){
    $query = \DB::table('np_chatbot_settings')
    ->where("account_id", "=",$account_id)
    ->select("*")
    ->get();
    return sizeOf($query) > 0 ? $query[0] : true ;
  }

}