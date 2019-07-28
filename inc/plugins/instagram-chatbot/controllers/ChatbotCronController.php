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

        foreach($accountIds as $id){
          if($Settings->since_pending_start >= $Settings->random_pending_time){
            try {
              require_once PLUGINS_PATH."/".self::IDNAME."/controllers/PendingRequests.php";
              $PendingRequests = new PendingRequests;
              $PendingRequests->process($id->account_id);
              $this->setCroneRuntime('pending');
            } catch (\Exception $e) {
              echo "Error: " . $e->getMessage();
            }
          }

          if($Settings->since_direct_start >= $Settings->random_direct_time){
            try {
              require_once PLUGINS_PATH."/".self::IDNAME."/controllers/DirectRequests.php";
              $DirectRequests = new DirectRequests;
              $DirectRequests->process($id->account_id);
              $this->setCroneRuntime('direct');
            } catch (\Exception $e) {
              echo "Error: " . $e->getMessage();
            }
          }
        }

       
        $activeFastCronJobs = $this->getActiveCronjobs('fast');
        if($activeFastCronJobs) {
          foreach($activeFastCronJobs as $cron){

            try {
              require_once PLUGINS_PATH."/".self::IDNAME."/controllers/DirectMessages.php";
              $DirectMessages = new DirectMessages;
              $DirectMessages->process($cron);
              $this->setCroneRuntime('fast');
            } catch (\Exception $e) {
              echo "Error: " . $e->getMessage();
            }
  
          }
        }
        
        var_dump('last slow speed run '. $Settings->since_slow_start);
        if($Settings->since_slow_start >= $Settings->random_slow_time){
          $activeSlowCronJobs = $this->getActiveCronjobs('slow');
          if($activeSlowCronJobs) {
            foreach($activeSlowCronJobs as $cron){

              try {
                require_once PLUGINS_PATH."/".self::IDNAME."/controllers/DirectMessages.php";
                $DirectMessages = new DirectMessages;
                $DirectMessages->process($cron);
                $this->setCroneRuntime('slow');
              } catch (\Exception $e) {
                echo "Error: " . $e->getMessage();
              }
    
            }
          }
        }



        echo "Cron task processed!";
    }

    private function getActiveCronjobs($speed){
      $query = \DB::table('np_chatbot_cron_jobs')
      ->where("is_terminated", "=", false)
      ->where("fast_speed", "=", $speed == 'fast' ? true : false)
      ->where("slow_speed", "=", $speed == 'slow' ? true : false)
      ->select("*")
      ->get();
      return sizeOf($query)  > 0 ? $query : false;
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

    $json_data = '[{ 
      "last_pending_cron_run":'.$cronRunLog["last_pending_cron_run"].',
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

  $random_direct_time = mt_rand($settings["direct_message_time_from"],$settings["direct_message_time_to"]);
  $directToTime = $settings["direct_message_time_to"];
  $direct_start_date = $cronlog["last_direct_cron_run"] > 0 ? new \DateTime(date('Y-m-d h:i:s',$cronlog["last_direct_cron_run"]) ) : new \DateTime(date('Y-m-d h:i:s', strtotime("-$directToTime minute")));
  $since_direct_start = $direct_start_date->diff(new \DateTime(date('Y-m-d h:i:s', time())));
  $SettingsData->random_direct_time = $random_direct_time;
  $SettingsData->since_direct_start = $since_direct_start->i;

  $random_slow_time = mt_rand($settings["slow_speed_time_from"],$settings["slow_speed_time_to"]);
  $slowToTime = $settings["slow_speed_time_to"];
  $slow_start_date = $cronlog["last_slow_cron_run"] > 0 ? new \DateTime(date('Y-m-d h:i:s',$cronlog["last_slow_cron_run"]) ) : new \DateTime(date('Y-m-d h:i:s', strtotime("-$slowToTime minute")));
  $since_slow_start = $slow_start_date->diff(new \DateTime(date('Y-m-d h:i:s', time())));
  $SettingsData->random_slow_time = $random_slow_time;
  $SettingsData->since_slow_start = $since_slow_start->i;

  return $SettingsData;
}

}