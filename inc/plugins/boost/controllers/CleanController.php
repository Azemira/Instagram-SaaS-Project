<?php
namespace Plugins\Boost;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Cron Controller
 */
class CleanController extends \Controller
{
    /**
     * idname of the plugin for internal use
     */
    const IDNAME = 'boost';
  

    /**
     * Process
     */
    public function process()
    {
      $Settings = namespace\settings();
      $tableLog = TABLE_PREFIX."boost_log";
      $tableUser = TABLE_PREFIX.TABLE_USERS;
      $clean    = $Settings->get("data.clean");
      $today    = date("Y-m-d H:i:s");
      
      if(!$clean || !isset($clean->keep_data_days)) {
        echo "invalid clean settings";
        return;
      }
      
      
      
      //remove data from all accounts
      if($clean->keep_data_days) {
        $keepSuccess = false;
        $daysAgo = $clean->keep_data_days + 1; //just for safety
        $maxDate = date('Y-m-d H:i:s', strtotime("-{$daysAgo} days"));
        
        $db = \DB::table($tableLog)->where("date", "<", $maxDate)->orderBy("id", "DESC");
        
        if(isset($clean->keep_success) && $clean->keep_success) {
          $keepSuccess = true;
        }
        
        if(isset($clean->keep_essential) && $clean->keep_essential) {
          $keepSuccess = true;
          $db->where("action", "!=", "follow")
            ->where("action", "!=", "comment");
        }
        if($keepSuccess) {
          $db->where("status", "!=", "success");
        }
        $res = $db->delete();
        echo "cleaned data from all users | ";
      }
      if(isset($clean->keep_remove_expired) && $clean->keep_remove_expired) {
        $daysAgo = $clean->keep_remove_expired + 1; //just for safety
        $maxDate = date('Y-m-d H:i:s', strtotime("-{$daysAgo} days"));
        $db = \DB::table($tableLog)->where(\DB::raw("user_id IN(SELECT id FROM {$tableUser} WHERE expire_date < '{$maxDate}')"));
        $res = $db->delete();
        echo "cleaned data from expired users | ";
      }
      echo "cron clean runned.";
    }
}
