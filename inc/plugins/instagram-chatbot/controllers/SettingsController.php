<?php
namespace Plugins\InstagramChatbot;
/**
 * Chatbot
 */
class SettingsController extends \Controller
{
    const IDNAME = "instagram-chatbot";
    /**
     * Process
     */
    public function process()
    {   
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");

        // Settings
        if (isset($Route->params->id)) {
            require_once PLUGINS_PATH."/".self::IDNAME."/models/SettingsModel.php";
            $Settings = new SettingsModel;
            $Settings->setPageSize(20)
                     ->setPage(\Input::get("page"))
                     ->where("account_id", "=", $Route->params->id)
                     ->orderBy("id","ASC")
                     ->fetchData();
            $this->setVariable("Settings", $Settings);

            $Account = \Controller::model("Account", $Route->params->id);
            $this->setVariable("Account", $Account);

            $this->setVariable("Route", $Route);

            if (\Input::post("action") == "save") {
                $this->save();
            }
            if (\Input::post("action") == "update") {
                $this->update();
            }
            
            $this->view(PLUGINS_PATH."/".self::IDNAME."/views/chatbot.php", null);
        } else {
           
          
            if (\Input::post("action") == "settings") {
               
                $this->updateSettings();
            }

            $settings = $this->getCronSettings();
            $this->setVariable("PendingFrom", $settings["pending_request_time_from"]);
            $this->setVariable("PendingTo", $settings["pending_request_time_to"]);
            $this->setVariable("NewConversationFrom", $settings["direct_message_time_from"]);
            $this->setVariable("NewConversationTo", $settings["direct_message_time_to"]);
            $this->setVariable("FastSpeedFrom", $settings["fast_speed_time_from"]);
            $this->setVariable("FastSpeedTo", $settings["fast_speed_time_to"]);
            $this->setVariable("SlowSpeedFrom", $settings["slow_speed_time_from"]);
            $this->setVariable("SlowSpeedTo", $settings["slow_speed_time_to"]);

            $this->view(PLUGINS_PATH."/".self::IDNAME."/views/settings.php", null);
        }
        
        
    }

        /**
     * Save (new|edit) caption
     * @return void 
     */
    private function save()
    {
        $this->resp->result = 0;
        $Route = $this->getVariable("Route");
        $AuthUser = $this->getVariable("AuthUser");
        $url = $this->full_path();
        $parts = explode("/", $url);
        $accountID = end($parts);
        require_once PLUGINS_PATH."/".self::IDNAME."/models/SettingModel.php";
        $Setting = new SettingModel;
        $status = \Input::post("chatbot_status");
        $hasSettings = $this->getUserSettings($accountID);
       
        if ($hasSettings) {
            $Setting->select($hasSettings->id);
            $Setting->set("chatbot_status", $status)->save();
        } else {
            $Setting->set("user_id", $AuthUser->get("id"))
            ->set("account_id", $accountID)
            ->set("chatbot_status", $status)
            ->save();
        }
      

        $this->resp->result = 1;
        $this->resp->id = $Setting->get("id");
        $this->resp->status = $Setting->get("chatbot_status");
        
        $this->jsonecho();
    }
    public function full_path(){
        $s = &$_SERVER;
        $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port = $s['SERVER_PORT'];
        $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
        $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
        $uri = $protocol . '://' . $host . $s['REQUEST_URI'];
        $segments = explode('?', $uri, 2);
        $url = $segments[0];
        return $url;
    }
    public function getUserSettings($account_id){
        $query = \DB::table('np_chatbot_settings')
        ->where("account_id", "=", $account_id)
        ->limit(1)
        ->select("*")
        ->get();
        return $query[0];
    }
    private function getCronSettings(){
        $json = file_get_contents(PLUGINS_PATH."/".self::IDNAME."/assets/json/cron_settings.json");
        return json_decode($json, true)[0];
    }
    private function updateSettings(){

        $json_data = '[{ 
            "pending_request_time_from":'.\Input::post("pending-from") .',
            "pending_request_time_to":'.\Input::post("pending-to") .',
            "direct_message_time_from":'.\Input::post("conversation-from") .',
            "direct_message_time_to":'.\Input::post("conversation-to") .',
            "fast_speed_time_from":'.\Input::post("fast-speed-from") .',
            "fast_speed_time_to":'.\Input::post("fast-speed-to") .',
            "slow_speed_time_from":'.\Input::post("slow-speed-from") .',
            "slow_speed_time_to":'.\Input::post("slow-speed-to").'}]';

          file_put_contents(PLUGINS_PATH."/".self::IDNAME."/assets/json/cron_settings.json", $json_data);
    }

    public function getUserErrorLogs($Account){
        $query = \DB::table('np_chatbot_error_log')
        ->where("user_id", "=",$Account->get("user_id"))
        ->where("account_id", "=",$Account->get("id"))
        ->select("*")
        ->orderBy("date","DESC")
        ->get();
        return sizeOf($query)  > 0 ? $query : false;
    }

}
