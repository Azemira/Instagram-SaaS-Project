<?php
namespace Plugins\AutoComment;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Schedule Controller
 */
class ScheduleController extends \Controller
{
    /**
     * idname of the plugin for internal use
     */
    const IDNAME = 'auto-comment';
    
    /**
     * Process
     */
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");
        $this->setVariable("idname", "auto-comment");

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

        if (\Input::request("action") == "search") {
            $this->search();
        } else if (\Input::post("action") == "save") {
            $this->save();
        }

        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/schedule.php", null);
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
            $msg = $e->getMessage();
            $msg = explode(":", $msg, 2);
            $msg = isset($msg[1]) ? $msg[1] : $msg[0];

            $this->resp->msg = $msg;
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

        // Targets
        $targets = @json_decode(\Input::post("target"));
        if (!$targets) {
            $targets = [];
        }

        $valid_targets = [];
        foreach ($targets as $t) {
            if (isset($t->type, $t->value, $t->id) && 
                in_array($t->type, ["hashtag", "location", "people"])) 
            {
                $valid_targets[] = [
                    "type" => $t->type,
                    "id" => $t->id,
                    "value" => $t->value
                ];
            }
        }
        $target = json_encode($valid_targets);

        $end_date = count($valid_targets) > 0 || (bool)\Input::post("timeline_feed")
                  ? "2030-12-12 23:59:59" : date("Y-m-d H:i:s");

        $daily_pause = (bool)\Input::post("daily_pause");

        $Schedule->set("user_id", $AuthUser->get("id"))
                 ->set("account_id", $Account->get("id"))
                 ->set("target", $target)
                 ->set("speed", \Input::post("speed"))
                 ->set("is_active", (bool)\Input::post("is_active"))
                 ->set("timeline_feed.enabled", (bool)\Input::post("timeline_feed"))
                 ->set("daily_pause", $daily_pause)
                 ->set("end_date", $end_date);

        if (!$Schedule->get("timeline_feed.schedule_date")) {
            $Schedule->get("timeline_feed.schedule_date", date("Y-m-d H:i:s", time() + 3600));
        }

        $schedule_date = date("Y-m-d H:i:s", time() + 60);
        if ($daily_pause) {
            $from = new \DateTime(date("Y-m-d")." ".\Input::post("daily_pause_from"),
                                  new \DateTimeZone($AuthUser->get("preferences.timezone")));
            $from->setTimezone(new \DateTimeZone("UTC"));

            $to = new \DateTime(date("Y-m-d")." ".\Input::post("daily_pause_to"),
                                new \DateTimeZone($AuthUser->get("preferences.timezone")));
            $to->setTimezone(new \DateTimeZone("UTC"));

            $Schedule->set("daily_pause_from", $from->format("H:i:s"))
                     ->set("daily_pause_to", $to->format("H:i:s"));


            $to = $to->format("Y-m-d H:i:s");
            $from = $from->format("Y-m-d H:i:s");
            if ($to <= $from) {
                $to = date("Y-m-d H:i:s", strtotime($to) + 86400);
            }

            if ($schedule_date > $to) {
                // Today's pause interval is over
                $from = date("Y-m-d H:i:s", strtotime($from) + 86400);
                $to = date("Y-m-d H:i:s", strtotime($to) + 86400);
            }

            if ($schedule_date >= $from && $schedule_date <= $to) {
                $schedule_date = $to;
                $Schedule->set("schedule_date", $schedule_date);
            }
        }
        $Schedule->set("schedule_date", $schedule_date);
        $Schedule->save();

        $this->resp->msg = __("Changes saved!");
        $this->resp->result = 1;
        $this->jsonecho();
    }
}
