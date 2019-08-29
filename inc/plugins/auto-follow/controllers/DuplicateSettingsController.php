<?php
namespace Plugins\AutoFollow;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Schedule Controller
 */
class duplicateSettingsController extends \Controller
{
    /**
     * idname of the plugin for internal use
     */
    const IDNAME = 'auto-follow';


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
        require_once PLUGINS_PATH."/".self::IDNAME."/models/DuplicateModel.php";
        $Schedule = new DuplicateModel([
            "account_id" => $Account->get("id"),
            "user_id" => $Account->get("user_id")
        ]);
        $this->setVariable("Schedule", $Schedule);

        if (\Input::request("action") == "search") {
            $this->search();
        } else if (\Input::post("action") == "save") {
            $this->save();
        }

        $Accounts = \Controller::model("Accounts");
        $Accounts->setPageSize(20)
                 ->setPage(\Input::get("page"))
                 ->where("user_id", "=", $AuthUser->get("id"))
                 ->orderBy("id","DESC")
                 ->fetchData();

        $this->setVariable("Accounts", $Accounts);

        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/duplicateSettings.php", null);

    }


    /**
     * Search hashtags, people, locations
     * @return mixed 
     */
    private function search()
    {
        $this->resp->result = 0;
        $AuthUser = $this->getVariable("AuthUser");
        $Account = $this->getVariable("Account");

        $query = \Input::request("q");
        if (!$query) {
            $this->resp->msg = __("Missing some of required data.");
            $this->jsonecho();
        }

        $type = \Input::request("type");
        if (!in_array($type, ["hashtag", "location", "people"])) {
            $this->resp->msg = __("Invalid parameter");
            $this->jsonecho();   
        }

        // Login
        try {
            $Instagram = \InstagramController::login($Account);
        } catch (\Exception $e) {
            $this->resp->msg = $e->getMessage();
            $this->jsonecho();   
        }



        $this->resp->items = [];

        // Get data
        try {
            if ($type == "hashtag") {
                $search_result = $Instagram->hashtag->search($query);
                if ($search_result->isOk()) {
                    foreach ($search_result->getResults() as $r) {
                        $this->resp->items[] = [
                            "value" => $r->getName(),
                            "data" => [
                                "sub" => n__("%s public post", "%s public posts", $r->getMediaCount(), $r->getMediaCount()),
                                "id" => str_replace("#", "", $r->getName())
                            ]
                        ];
                    }
                }
            } else if ($type == "location") {
                $search_result = $Instagram->location->findPlaces($query);
                if ($search_result->isOk()) {
                    foreach ($search_result->getItems() as $r) {
                        $this->resp->items[] = [
                            "value" => $r->getLocation()->getName(),
                            "data" => [
                                "sub" => false,
                                "id" => $r->getLocation()->getFacebookPlacesId()
                            ]
                        ];
                    }
                }
            } else if ($type == "people") {
                $search_result = $Instagram->people->search($query);
                if ($search_result->isOk()) {
                    foreach ($search_result->getUsers() as $r) {
                        $this->resp->items[] = [
                            "value" => $r->getUsername(),
                            "data" => [
                                "sub" => $r->getFullName(),
                                "id" => $r->getPk()
                            ]
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            $this->resp->msg = $e->getMessage();
            $this->jsonecho();   
        }


        $this->resp->result = 1;
        $this->jsonecho();
    }


    /**
     * Save schedule
     * @return mixed 
     */
    private function save()
    {
        $this->resp->result = 0;
        $AuthUser = $this->getVariable("AuthUser");
        $Account = $this->getVariable("Account");
        $Schedule = $this->getVariable("Schedule");

        $user_ids = \Input::post("duplicate");
        $duplicate_target = \Input::post("duplicate_target");

        require_once PLUGINS_PATH."/".self::IDNAME."/models/DuplicateModel.php";
        
        $target = $Schedule->get("target");

        foreach ($user_ids as $key => $id) {

            $Schedule_duolicated = new DuplicateModel([
                "account_id" =>$id,
                "user_id" => $Account->get("user_id")
            ]);
  
            $Schedule_duolicated->set("user_id", $AuthUser->get("id"))
            ->set("account_id", $id)
            ->set("timeline_feed",$Schedule->get("timeline_feed"))
            ->set("speed",$Schedule->get("speed"))
            ->set("daily_pause",$Schedule->get("daily_pause"))
            ->set("daily_pause_from",$Schedule->get("daily_pause_from"))
            ->set("daily_pause_to",$Schedule->get("daily_pause_to"))
            ->set("is_active",$Schedule->get("is_active"))
            ->set("schedule_date",$Schedule->get("schedule_date"))
            ->set("end_date",$Schedule->get("end_date"))
            ->set("last_action_date",$Schedule->get("last_action_date"))
            ->set("data",$Schedule->get("data"));

            if($duplicate_target == "1") {

                $Schedule_duolicated->set("target", $target);
            }
           
            $Schedule_duolicated->save();

        }
        
        $this->resp->msg = __("Changes saved!");
        $this->resp->result = 1;
        $this->jsonecho();
    }


}
