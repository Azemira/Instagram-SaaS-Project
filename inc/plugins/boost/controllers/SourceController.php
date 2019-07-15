<?php
namespace Plugins\Boost;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Source Controller
 */
class SourceController extends \Controller
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
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");
        $this->setVariable("idname", self::IDNAME);

        // Auth
        if (!$AuthUser){
            header("Location: ".APPURL."/login");
            exit;
        } else if ($AuthUser->isExpired()) {
            header("Location: ".APPURL."/expired");
            exit;
        }

        $user_modules = $AuthUser->get("settings.modules");
        if (!is_array($user_modules) || !in_array(self::IDNAME, $user_modules)) {
            // Module is not accessible to this user
            header("Location: ".APPURL."/post");
            exit;
        }


        // Get account
        $Account = \Controller::model("Account", $Route->params->id);
        if (!$Account->isAvailable() || 
            $Account->get("user_id") != $AuthUser->get("id")) 
        {
            header("Location: ".APPURL."/e/".self::IDNAME);
            exit;
        }
        $this->setVariable("Account", $Account);


        // Get Schedule
        require_once PLUGINS_PATH."/".self::IDNAME."/models/ScheduleModel.php";
        $Schedule = new ScheduleModel([
            "account_id" => $Account->get("id"),
            "user_id" => $Account->get("user_id")
        ]);
        $this->setVariable("Schedule", $Schedule);
      
        $Settings = namespace\settings();
        $this->setVariable("Settings", $Settings);


        // Get Best Sources
        require_once PLUGINS_PATH."/".self::IDNAME."/models/NewFollowersModel.php";
        $NewFollowers = new NewFollowersModel;
      
        $sourcesWithData  = $NewFollowers->getBestSources($AuthUser->get("id"), $Account->get("id"));
        $targets          = @json_decode($Schedule->get("target"));
      
        $items = [];
        if($targets) {
          foreach($targets as $t) {
            $key = $t->type . "." . $t->id;
            $items[$key] = [
              'type'      => $t->type,
              'id'        => $t->id,
              'value'     => $t->value,
              'is_target' => true,
              'followers' => 0,
            ];
          }
        }
        foreach($sourcesWithData as $s) {
          $key = $s->target;
          if(isset($items[$key])) {
            $items[$key]['followers'] = $s->followers;
          } else {
            $target = explode(".", $s->target);
            $items[$key] = [
              'type'      => $target[0],
              'id'        => $target[1],
              'value'     => $s->target_value,
              'is_target' => false,
              'followers' => $s->followers,
            ];
          }
        }
        $this->setVariable("Sources", $items);
      if($items) {
        $totalNewFollowers = array_sum(array_column($items, 'followers'));
      } else {
        $totalNewFollowers = 0;  
      }
      $this->setVariable("totalNewFollowers", $totalNewFollowers);
      
        // Get accounts
        $Accounts = \Controller::model("Accounts");
        $Accounts->fetchData();

        $this->setVariable("Accounts", $Accounts);

        // View
        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/sources.php", null);
    }
}
