<?php
namespace Plugins\AutoComment;

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
    const IDNAME = 'auto-comment';


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

        $SpeedSettings = $this->getSpeedSettings();
        $this->setVariable("SpeedSettings", $SpeedSettings);
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
        $this->updateSettings();
        $Settings = $this->getVariable("Settings");
        if (!$Settings->isAvailable()) {
            // Settings is not available yet
            $Settings->set("name", "plugin-".self::IDNAME."-settings");
        }

        // Speed settings
        $speeds = [
            "very_slow" => (int)\Input::post("speed-very-slow"),
            "slow" => (int)\Input::post("speed-slow"),
            "medium" => (int)\Input::post("speed-medium"),
            "fast" => (int)\Input::post("speed-fast"),
            "very_fast" => (int)\Input::post("speed-very-fast"),
        ];

        foreach ($speeds as $key => $value) {
            if ($value < 1) {
                $speeds[$key] = 1;
            }

            if ($value > 60) {
                $speeds[$key] = 60;
            }
        }


        // Timeline settings
        $timeline_refresh_interval = (int)\Input::post("timeline-refresh-interval");
        $timeline_max_comment = (int)\Input::post("timeline-max-comment");

        if ($timeline_refresh_interval < 0) {
            $timeline_refresh_interval = 1800;
        }

        if ($timeline_max_comment < 0) {
            $timeline_max_comment = 1;
        }

        $timeline_settings = [
            "refresh_interval" => $timeline_refresh_interval,
            "max_comment" => $timeline_max_comment
        ];


        // Other settings
        $random_delay = (bool)\Input::post("random_delay");
        

        // Save settings
        $Settings->set("data.speeds", $speeds)
                 ->set("data.timeline", $timeline_settings)
                 ->set("data.random_delay", $random_delay)
                 ->save();

                    

        $this->resp->result = 1;
        $this->resp->msg = __("Changes saved!");
        $this->jsonecho();

       
        return $this;
    }

    private function updateSettings(){

        $json_data = '[{ 
            "very-slow" : {
                "wait-from": '.$this->validateInput(\Input::post("very-slow-wait-from")).',
                "wait-to": '.$this->validateInput(\Input::post("very-slow-wait-to")).',
                "comment-limit-min": '.\Input::post("very-slow-comment-limit-min").',
                "comment-limit-max": '.\Input::post("very-slow-comment-limit-max").',
                "delay-secconds-from": '.\Input::post("very-slow-delay-secconds-from").',
                "delay-secconds-to": '.\Input::post("very-slow-delay-secconds-to").',
                "comment-per-day-limit": '.\Input::post("very-slow-comment-per-day-limit").'
            },
            "slow" : {
                "wait-from": '.$this->validateInput(\Input::post("slow-wait-from")).',
                "wait-to": '.$this->validateInput(\Input::post("slow-wait-to")).',
                "comment-limit-min": '.\Input::post("slow-comment-limit-min").',
                "comment-limit-max": '.\Input::post("slow-comment-limit-max").',
                "delay-secconds-from": '.\Input::post("slow-delay-secconds-from").',
                "delay-secconds-to": '.\Input::post("slow-delay-secconds-to").',
                "comment-per-day-limit": '.\Input::post("slow-comment-per-day-limit").'
            },
            "medium" : {
                "wait-from": '.$this->validateInput(\Input::post("medium-wait-from")).',
                "wait-to": '.$this->validateInput(\Input::post("medium-wait-to")).',
                "comment-limit-min": '.\Input::post("medium-comment-limit-min").',
                "comment-limit-max": '.\Input::post("medium-comment-limit-max").',
                "delay-secconds-from": '.\Input::post("medium-delay-secconds-from").',
                "delay-secconds-to": '.\Input::post("medium-delay-secconds-to").',
                "comment-per-day-limit": '.\Input::post("medium-comment-per-day-limit").'
            },
            "fast" : {
                "wait-from": '.$this->validateInput(\Input::post("fast-wait-from")).',
                "wait-to": '.$this->validateInput(\Input::post("fast-wait-to")).',
                "comment-limit-min": '.\Input::post("fast-comment-limit-min").',
                "comment-limit-max": '.\Input::post("fast-comment-limit-max").',
                "delay-secconds-from": '.\Input::post("fast-delay-secconds-from").',
                "delay-secconds-to": '.\Input::post("fast-delay-secconds-to").',
                "comment-per-day-limit": '.\Input::post("fast-comment-per-day-limit").'
            },
            "very-fast" : {
                "wait-from": '.$this->validateInput(\Input::post("very-fast-wait-from")).',
                "wait-to": '.$this->validateInput(\Input::post("very-fast-wait-to")).',
                "comment-limit-min": '.\Input::post("very-fast-comment-limit-min").',
                "comment-limit-max": '.\Input::post("very-fast-comment-limit-max").',
                "delay-secconds-from": '.\Input::post("very-fast-delay-secconds-from").',
                "delay-secconds-to": '.\Input::post("very-fast-delay-secconds-to").',
                "comment-per-day-limit": '.\Input::post("very-fast-comment-per-day-limit").'
            }
        }]';

          file_put_contents(PLUGINS_PATH."/".self::IDNAME."/assets/json/speed-settings.json", $json_data);
    }   

    public function validateInput($input){
      return intval($input) > 0 ? $input : 0;
    }
    private function getSpeedSettings(){
        $json = file_get_contents(PLUGINS_PATH."/".self::IDNAME."/assets/json/speed-settings.json");
        return json_decode($json, true)[0];
    }
}
