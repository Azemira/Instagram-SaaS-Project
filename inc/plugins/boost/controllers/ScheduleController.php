<?php
namespace Plugins\Boost;

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

        $Settings = namespace\settings();
        $this->setVariable("Settings", $Settings);
      
        $user_modules = $AuthUser->get("settings.modules");
        if (!is_array($user_modules) || !in_array(self::IDNAME, $user_modules)) {
            // Module is not accessible to this user
            header("Location: ".APPURL."/post");
            exit;
        }

        // Get accounts
        $Accounts = \Controller::model("Accounts");
        $Accounts->fetchData();

        $this->setVariable("Accounts", $Accounts);

      
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
      
      //force check active button
      if(!$Schedule->isAvailable()) {
        $Schedule->set("is_active", 1);
      }

      
      $followCicle = namespace\followCicle();
      $this->setVariable("followCicle", $followCicle);
      
      $defaultCicle = $Schedule->isAvailable()  ? $Schedule->get("follow_cicle") : $Settings->get("data.default.follow_cicle");
      $this->setVariable("defaultCicle", $defaultCicle);
      
      $defaultIgnorePrivate = $Schedule->isAvailable() ? $Schedule->get("ignore_private") : $Settings->get("data.default.ignore_private");
      $this->setVariable("defaultIgnorePrivate", $defaultIgnorePrivate);
      
      $defaultHasPicture = $Schedule->isAvailable() ? $Schedule->get("has_picture") : $Settings->get("data.default.has_picture");
      $this->setVariable("defaultHasPicture", $defaultHasPicture);
      
      $defaultUnfollowAll = $Schedule->isAvailable() ? $Schedule->get("unfollow_all") : $Settings->get("data.default.unfollow_all");
      $this->setVariable("defaultUnfollowAll", $defaultUnfollowAll);
      
      $defaultKeepFollowers = $Schedule->isAvailable() ? $Schedule->get("keep_followers") : $Settings->get("data.default.keep_followers");
      $this->setVariable("defaultKeepFollowers", $defaultKeepFollowers);
      
      $speeds = [
        'auto' => __("Auto"),
        'very_slow' => __("Very Slow"),
        'slow' => __("Slow"),
        'medium' => __("Medium"),
        'fast' => __("Fast"),
        'very_fast' => __("Very Fast"),
      ];

      $visibleSpeeds = [];
      if($Schedule->isAvailable() && $Settings->get("data.visible_speed")) {
        foreach($Settings->get("data.visible_speed") as $k => $v) {
          if($v) {
            $visibleSpeeds[$k] = $speeds[$k];
          }
        }
      }
      
      $speeds = $visibleSpeeds ? $visibleSpeeds : $speeds;
      $this->setVariable("speeds", $speeds);
      
      $defaultVisibleSpeeds = $Schedule->isAvailable() ? $Schedule->get("keep_followers") : $Settings->get("data.default.keep_followers");
      $this->setVariable("defaultKeepFollowers", $defaultKeepFollowers);
      
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
      
      //start: direct ig search
      try {
        $q = urlencode($query);
        if($type == "hashtag") {
          $url = "https://www.instagram.com/web/search/topsearch/?context=hashtag&query={$q}";
$curl = curl_init();

          $s = array(
              CURLOPT_URL => $url,
              CURLOPT_REFERER => "https://google.com",
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36",
              CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,
          );

          curl_setopt_array($curl, $s);
          $response = curl_exec($curl);
          curl_close($curl);
          $items = @json_decode($response);
          if(isset($items->hashtags) && $items->hashtags) {
              foreach ($items->hashtags as $r) {
                $mediaCount = readableNumber($r->hashtag->media_count);
                $this->resp->items[] = [
                    "value" => $r->hashtag->name,
                    "data" => [
                        "img" => PLUGINS_URL."/".self::IDNAME."/assets/img/hashtag-pesq.jpg",
                        "sub" => n__("%s public post", "%s public posts", $mediaCount, $mediaCount),
                        "id" => str_replace("#", "", $r->hashtag->name)
                    ]
                ];
              }

            $this->resp->result = 1;
            $this->jsonecho();
            return;
          }
          
        } elseif($type == "location") {
$url = "https://www.instagram.com/web/search/topsearch/?context=place&query={$q}";
$curl = curl_init();

          $s = array(
              CURLOPT_URL => $url,
              CURLOPT_REFERER => "https://google.com",
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36",
              CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,
          );

          curl_setopt_array($curl, $s);
          $response = curl_exec($curl);
          curl_close($curl);
          $items = @json_decode($response);
          if(isset($items->places) && $items->places) {
              foreach ($items->places as $r) {
                $address = "";
                if (!empty($r->place->location->address)) {
                  $address = $r->place->location->address;
                  if (!empty($r->place->location->city)) {
                  $address .= ', '.$r->place->location->city;
                  }
                }
                $this->resp->items[] = [
                    "value" => $r->place->location->name,
                    "data" => [
                        "img" => PLUGINS_URL."/".self::IDNAME."/assets/img/location-pesq.jpg",
                        "sub" => $address,
                        "id" => $r->place->location->facebook_places_id
                    ]
                ];
              }

            $this->resp->result = 1;
            $this->jsonecho();
            return;
          }
          
        } elseif ($type == "people") {
          $url = "https://www.instagram.com/web/search/topsearch/?context=user&query={$q}";
          $curl = curl_init();

          $s = array(
              CURLOPT_URL => $url,
              CURLOPT_REFERER => "https://google.com",
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36",
              CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,
          );

          curl_setopt_array($curl, $s);
          $response = curl_exec($curl);
          curl_close($curl);
          $items = @json_decode($response);
          if(isset($items->users) && $items->users) {
              foreach ($items->users as $r) {
                $followersCount = readableNumber($r->user->follower_count);
                  if (empty($r->user->full_name)) {
                      $name = $followersCount.__(" followers");
                  } else {
                      $name = $r->user->full_name." - ".$followersCount.__(" followers");
                  }
                  $this->resp->items[] = [
                      "value" => $r->user->username,
                      "data" => [
                          "img" => $r->user->profile_pic_url,
                          "sub" => $name,
                          "id" => $r->user->pk
                      ]
                  ];
              }

            $this->resp->result = 1;
            $this->jsonecho();
            return;
          }
        }
      } catch(\Exception $e) {
        $this->resp->exception = $e->getMessage();
      }
      //end: direct ig search

        // Login
        try {
            $Instagram = \InstagramController::login($Account);
        } catch (\Exception $e) {
            $this->resp->login_required = 1;
            $this->resp->msg = __("We could not connect to Instagram. Please log in again from your account.");
            $this->resp->title = __("Login again!");        
            $this->resp->links = [
                [
                    "name" => "ok",
                    "label" => __("Login"),
                    "uri" => APPURL."/accounts/".$Account->get('id')
                ]
            ];
            $this->jsonecho();   
        }



        $this->resp->items = [];

        // Get data
        try {
            if ($type == "hashtag") {
                $search_result = $Instagram->hashtag->search($query);
                if ($search_result->isOk()) {
                    foreach ($search_result->getResults() as $r) {
                      $mediaCount = readableNumber($r->getMediaCount());
                        $this->resp->items[] = [
                            "value" => $r->getName(),
                            "data" => [
                                "img" => PLUGINS_URL."/".self::IDNAME."/assets/img/hashtag-pesq.jpg",
                                "sub" => n__("%s public post", "%s public posts", $mediaCount, $mediaCount),
                                "id" => str_replace("#", "", $r->getName())
                            ]
                        ];
                    }
                }
            } else if ($type == "location") {
                $search_result = $Instagram->location->findPlaces($query);
                if ($search_result->isOk()) {
                    foreach ($search_result->getItems() as $r) {
                        if (!empty($r->getLocation()->getAddress())) {                            
                            $address = $r->getLocation()->getAddress();
                            if (!empty($r->getLocation()->getCity())) {
                                $address .= ', '.$r->getLocation()->getCity();
                            }
                        } else {
                            $address = false;
                        }
                        $this->resp->items[] = [
                            "value" => $r->getLocation()->getName(),
                            "data" => [
                                "img" => PLUGINS_URL."/".self::IDNAME."/assets/img/location-pesq.jpg",
                                "sub" => $address,
                                "id" => $r->getLocation()->getFacebookPlacesId()
                            ]
                        ];
                    }
                }
            } else if ($type == "people") {
                $search_result = $Instagram->people->search($query);
                if ($search_result->isOk()) {
                    foreach ($search_result->getUsers() as $r) {
                      $followersCount = readableNumber($r->getFollowerCount());
                        if (empty($r->getFullName())) {
                            $name = $followersCount.__(" followers");
                        } else {
                            $name = $r->getFullName()." - ".$followersCount.__(" followers");
                        }
                        $this->resp->items[] = [
                            "value" => $r->getUsername(),                            
                            "data" => [
                                "img" => $r->getProfilePicUrl(),
                                "sub" => $name,
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
        $Account  = $this->getVariable("Account");
        $Schedule = $this->getVariable("Schedule");
        $Settings = $this->getVariable("Settings");

        //targets
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
      
        //whitelist
        $whitelist = @json_decode(\Input::post("whitelist"));
        if (!$whitelist) {
            $whitelist = @json_decode($Schedule->get("whitelist"));
        }
        if (!$whitelist) {
            $whitelist = [];
        }

        $valid_whitelist = [];
        foreach ($whitelist as $t) {
            if (isset($t->value, $t->id)) {
                $valid_whitelist[] = [
                    "id" => $t->id,
                    "value" => $t->value
                ];
            }
        }
        $whitelist = json_encode($valid_whitelist);
      
        
        //blacklist
        $blacklist = @json_decode(\Input::post("blacklist"));
        if (!$blacklist) {
            $blacklist = @json_decode($Schedule->get("blacklist"));
        }
        if (!$blacklist) {
            $blacklist = [];
        }

        $valid_blacklist = [];
        foreach ($blacklist as $t) {
            if (isset($t->value, $t->id)) {
                $valid_blacklist[] = [
                    "id" => $t->id,
                    "value" => $t->value
                ];
            }
        }
        $blacklist = json_encode($valid_blacklist);
      
        //comments
        $Emojione = new \Emojione\Client(new \Emojione\Ruleset());
        $raw_comments = @json_decode(\Input::post("comments"));
        $valid_comments = [];
        if ($raw_comments) {
            foreach ($raw_comments as $c) {
                $valid_comments[] = $Emojione->toShort($c);
            }
        }
      
        $comments = json_encode($valid_comments);
      
        //messages
        $Emojione = new \Emojione\Client(new \Emojione\Ruleset());
        $raw_messages = @json_decode(\Input::post("messages"));
        $valid_messages = [];
        if ($raw_messages) {
            foreach ($raw_messages as $c) {
                $valid_messages[] = $Emojione->toShort($c);
            }
        }
      
        $messages = json_encode($valid_messages);
      
        //validation
        $totalTargets = sizeof($valid_targets);
        $minTargets = (int) $Settings->get("data.min_target");
        if($minTargets > $totalTargets && 
           (\Input::post("action_like") || \Input::post("action_comment") || \Input::post("action_follow"))
          ) {
          $this->resp->msg = __("Please, choose at least %s targts", $minTargets);
          $this->jsonecho();
          return;
        }
      
        $totalComments = sizeof($valid_comments);
        $minComments = (int) $Settings->get("data.min_comments");
        if(\Input::post("action_comment") && ($minComments > $totalComments)) {
          $this->resp->msg = __("Please, choose at least %s coments", $minComments);
          $this->jsonecho();
          return;
        }
      
        $totalMessages = sizeof($valid_messages);
        $minMessages = (int) $Settings->get("data.min_welcomedm");
        if(\Input::post("action_welcomedm") && ($minMessages > $totalMessages)) {
          $this->resp->msg = __("Please, choose at least %s coments", $minMessages);
          $this->jsonecho();
          return;
        }

        $daily_pause = (bool)\Input::post("daily_pause");

        $Schedule->set("user_id", $AuthUser->get("id"))
                ->set("account_id", $Account->get("id"))
                ->set("action_follow", (int)\Input::post("action_follow"))
                ->set("action_unfollow", (int)\Input::post("action_unfollow"))
                ->set("action_like", (int)\Input::post("action_like"))
                ->set("action_comment", (int)\Input::post("action_comment"))
                ->set("action_viewstory", (int)\Input::post("action_viewstory"))
                ->set("action_welcomedm", (int)\Input::post("action_welcomedm"))
                ->set("comments", $comments)
                ->set("dms", $messages)
                ->set("follow_cicle", (int)\Input::post("follow_cicle"))
                ->set("target", $target)
                ->set("gender", \Input::post("gender"))
                ->set("ignore_private", (int)\Input::post("ignore_private"))
                ->set("has_picture", (int)\Input::post("has_picture"))
                ->set("business", \Input::post("business"))
                //skip items
                ->set("blacklist", $blacklist)
                ->set("bad_words", \Input::post("black_keywords"))
                ->set("whitelist", $whitelist)
                ->set("unfollow_all", (int)\Input::post("unfollow_all"))
                ->set("keep_followers", (int)\Input::post("keep_followers"))
                //skip timeline_feed
                ->set("speed", \Input::post("speed"))
                ->set("daily_pause", $daily_pause)
          
                 ->set("is_active", 1/*(bool)\Input::post("is_active")*/)
                 ->set("end_date", "2030-12-12 23:59:59")
                ->set("data.follow_plus_like", (int)\Input::post("follow_plus_like"))
                ->set("data.follow_plus_like_limit", (int)\Input::post("follow_plus_like_limit"))
                ->set("data.follow_plus_mute", (int)\Input::post("follow_plus_mute"))
                ->set("data.follow_plus_mute_type", \Input::post("follow_plus_mute_type"));


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
        
        $allSchedulesDate = [
          'follow'    => $schedule_date,
          'like'      => $schedule_date,
          'comment'   => $schedule_date,
          'welcomedm' => $schedule_date,
          'viewstory' => $schedule_date,
        ];

        $Schedule->set("schedule_date", $schedule_date)
              ->set("all_schedules", json_encode($allSchedulesDate));
      
        $Schedule->save();


        $this->resp->msg = __("Changes saved!");
        $this->resp->result = 1;
        $this->jsonecho();
    }
}
