<?php 
namespace Plugins\AutoFollow;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?"); 

function addCronTask()
{
    require_once __DIR__."/models/SchedulesModel.php";
    require_once __DIR__."/models/LogModel.php";


    // Get auto follow schedules
    $Schedules = new SchedulesModel;
    $Schedules->where("is_active", "=", 1)
              ->where("schedule_date", "<=", date("Y-m-d H:i:s"))
              ->where("end_date", ">=", date("Y-m-d H:i:s"))
              ->orderBy("last_action_date", "ASC")
              ->setPageSize(10) // required to prevent server overload
              ->setPage(1)
              ->fetchData();

    if ($Schedules->getTotalCount() < 1) {
        return false;
    }

    $settings = namespace\settings();
    $default_speeds = [
        "very_slow" => 1,
        "slow" => 2,
        "medium" => 3,
        "fast" => 4,
        "very_fast" => 5,
    ];
    $speeds = $settings->get("data.speeds");
    if (empty($speeds)) {
        $speeds = [];
    } else {
        $speeds = json_decode(json_encode($speeds), true);
    }
    $speeds = array_merge($default_speeds, $speeds);

    $as = [__DIR__."/models/ScheduleModel.php", __NAMESPACE__."\ScheduleModel"];
    foreach ($Schedules->getDataAs($as) as $sc) {
        $speedCategotry = str_replace("_", "-", $sc->get("speed"));
        // $randomWait = rand(intval($speedSettings[$speedCategotry]['wait-from']),intval($speedSettings[$speedCategotry]['wait-to']));
        // $randomSleep = rand(intval($speedSettings[$speedCategotry]['delay-secconds-from']),intval($speedSettings[$speedCategotry]['delay-secconds-to']));
        // $randomCommentsCount = rand(intval($speedSettings[$speedCategotry]['comment-limit-min']),intval($speedSettings[$speedCategotry]['comment-limit-max']));
        $daily_account_limit = intval($speedSettings[$speedCategotry]['comment-per-day-limit']);
        $checkSentComments =  getAccountSentComments($sc->get("account_id"));
        // $last_action_date = new \DateTime(date('Y-m-d h:i:s', strtotime($sc->get("last_action_date"))));
        // $last_action_date_diff = $last_action_date->diff(new \DateTime(date('Y-m-d h:i:s')));
        // $last_action_min = $last_action_date_diff->i;
        $operation = 'new';
        $Log = new LogModel;
        $Account = \Controller::model("Account", $sc->get("account_id"));
        $User = \Controller::model("User", $sc->get("user_id"));

        // Calculate next schedule datetime...
        if (isset($speeds[$sc->get("speed")]) && (int)$speeds[$sc->get("speed")] > 0) {
            $speed = (int)$speeds[$sc->get("speed")];
            $delta = round(3600/$speed);

            if ($settings->get("data.random_delay")) {
                $delay = rand(0, 300);
                $delta += $delay;
            }
        } else {
            $delta = rand(720, 7200);
        }

        $next_schedule = date("Y-m-d H:i:s", time() + $delta);
        if ($sc->get("daily_pause")) {
            $pause_from = date("Y-m-d")." ".$sc->get("daily_pause_from");
            $pause_to = date("Y-m-d")." ".$sc->get("daily_pause_to");
            if ($pause_to <= $pause_from) {
                // next day
                $pause_to = date("Y-m-d", time() + 86400)." ".$sc->get("daily_pause_to");
            }

            if ($next_schedule > $pause_to) {
                // Today's pause interval is over
                $pause_from = date("Y-m-d H:i:s", strtotime($pause_from) + 86400);
                $pause_to = date("Y-m-d H:i:s", strtotime($pause_to) + 86400);
            }

            if ($next_schedule >= $pause_from && $next_schedule <= $pause_to) {
                $next_schedule = $pause_to;
            }
        }
           //daily limit
           if(sizeOf($checkSentComments) +1 >= $daily_account_limit){
            $next_schedule = date("Y-m-d H:i:s", strtotime('tomorrow midnight'));
        }
        $sc->set("schedule_date", $next_schedule)
           ->set("last_action_date", date("Y-m-d H:i:s"))
           ->save();

        
        // Set default values for the log...
        $Log->set("user_id", $User->get("id"))
            ->set("account_id", $Account->get("id"))
            ->set("status", "error");


        // Check account
        if (!$Account->isAvailable() || $Account->get("login_required")) {
            // Account is either removed (unexected, external factors)
            // Or login required for this account
            // Deactivate schedule
            $sc->set("is_active", 0)->save();

            // Log data
            $Log->set("data.error.msg", "Activity has been stopped")
                ->set("data.error.details", "Re-login is required for the account.")
                ->save();
            continue;
        }

        // Check user account
        if (!$User->isAvailable() || !$User->get("is_active") || $User->isExpired()) {
            // User is not valid
            // Deactivate schedule
            $sc->set("is_active", 0)->save();

            // Log data
            $Log->set("data.error.msg", "Activity has been stopped")
                ->set("data.error.details", "User account is either disabled or expred.")
                ->save();
            continue;
        }

        if ($User->get("id") != $Account->get("user_id")) {
            // Unexpected, data modified by external factors
            // Deactivate schedule
            $sc->set("is_active", 0)->save();
            continue;
        }

        // Check targets
        $targets = @json_decode($sc->get("target"));
        if (!$targets) {
            // Unexpected, data modified by external factors
            // Deactivate schedule
            $sc->set("is_active", 0)->save();
            continue;
        }

        // Select random target
        $i = rand(0, count($targets) - 1);
        $target = $targets[$i];

        // Check selected target
        if (empty($target->type) ||
            empty($target->id) ||
            !in_array($target->type, ["hashtag", "location", "people"])) 
        {
            // Unexpected, data modified by external factors
            continue;   
        }

        try {
            $Instagram = \InstagramController::login($Account);
        } catch (\Exception $e) {
            // Couldn't login into the account
            $Account->refresh();

            // Log data
            if ($Account->get("login_required")) {
                $sc->set("is_active", 0)->save();
                $Log->set("data.error.msg", "Activity has been stopped");
            } else {
                $Log->set("data.error.msg", "Action re-scheduled");
            }
            $Log->set("data.error.details", $e->getMessage())
                ->save();

            continue;
        }


        // Logged in successfully
        // Now script will try to get feed and follow new user
        // And will log result
        $Log->set("data.trigger", $target);


        // Find username to follow
        $follow_pk = null;
        $follow_username = null;
        $follow_full_name = null;
        $follow_profile_pic_url = null;

        // Generate a random rank token.
        $rank_token = \InstagramAPI\Signatures::generateUUID();

        if ($target->type == "hashtag") {
            try {
                $feed = $Instagram->hashtag->getFeed(
                    str_replace("#", "", trim($target->id)),
                    $rank_token);
            } catch (\Exception $e) {
                // Couldn't get instagram feed related to the hashtag

                // Log data
                $Log->set("data.error.msg", "Couldn't get the feed")
                    ->set("data.error.details", $e->getMessage())
                    ->save();
                continue;
            }

            if (count($feed->getItems()) < 1) {
                // Invalid
                continue;
            }


            foreach ($feed->getItems() as $item) {
                if (empty($item->getUser()->getFriendshipStatus()->getFollowing()) && 
                    empty($item->getUser()->getFriendshipStatus()->getOutgoingRequest()) &&
                    $item->getUser()->getPk() != $Account->get("instagram_id")) 
                {
                    $_log = new LogModel([
                        "user_id" => $User->get("id"),
                        "account_id" => $Account->get("id"),
                        "followed_user_pk" => $item->getUser()->getPk(),
                        "status" => "success"
                    ]);

                    if (!$_log->isAvailable()) {
                        // Found new user
                        $follow_pk = $item->getUser()->getPk();
                        $follow_username = $item->getUser()->getUsername();
                        $follow_full_name = $item->getUser()->getFullName();
                        $follow_profile_pic_url = $item->getUser()->getProfilePicUrl();

                        break;
                    }
                }
            }
        } else if ($target->type == "location") {
            try {
                $feed = $Instagram->location->getFeed(
                    $target->id, 
                    $rank_token);
            } catch (\Exception $e) {
                // Couldn't get instagram feed related to the location id

                // Log data
                $Log->set("data.error.msg", "Couldn't get the feed")
                    ->set("data.error.details", $e->getMessage())
                    ->save();
                continue;
            }

            if (count($feed->getItems()) < 1) {
                // Invalid
                continue;
            }

            foreach ($feed->getItems() as $item) {
                if (empty($item->getUser()->getFriendshipStatus()->getFollowing()) && 
                    empty($item->getUser()->getFriendshipStatus()->getOutgoingRequest()) &&
                    $item->getUser()->getPk() != $Account->get("instagram_id")) 
                {
                    $_log = new LogModel([
                        "user_id" => $User->get("id"),
                        "account_id" => $Account->get("id"),
                        "followed_user_pk" => $item->getUser()->getPk(),
                        "status" => "success"
                    ]);

                    if (!$_log->isAvailable()) {
                        // Found new user
                        $follow_pk = $item->getUser()->getPk();
                        $follow_username = $item->getUser()->getUsername();
                        $follow_full_name = $item->getUser()->getFullName();
                        $follow_profile_pic_url = $item->getUser()->getProfilePicUrl();

                        break;
                    }
                }
            }
        } else if ($target->type == "people") {
            $round = 1;
            $loop = true;
            $next_max_id = null;

            while ($loop) {
                try {
                    $feed = $Instagram->people->getFollowers(
                        $target->id,
                        $rank_token, 
                        null, 
                        $next_max_id);
                } catch (\Exception $e) {
                    // Couldn't get instagram feed related to the user id
                    $loop = false;

                    if ($round == 1) {
                        // Log data
                        $Log->set("data.error.msg", "Couldn't get the feed")
                            ->set("data.error.details", $e->getMessage())
                            ->save();
                    }

                    continue 2;
                }

                if (count($feed->getUsers()) < 1) {
                    // Invalid
                    $loop = false;
                    continue 2;
                }

                // Get friendship statuses
                $user_ids = [];
                foreach ($feed->getUsers() as $user) {
                    $user_ids[] = $user->getPk();
                }

                try {
                    $friendships = $Instagram->people->getFriendships($user_ids);
                } catch (\Exception $e) {
                    // Couldn't get instagram friendship statuses
                    $loop = false;

                    if ($round == 1) {
                        // Log data
                        $Log->set("data.error.msg", "Couldn't get the friendship statuses")
                            ->set("data.error.details", $e->getMessage())
                            ->save();
                    }

                    continue 2;
                }

                $followings = [];
                foreach ($friendships->getFriendshipStatuses()->getData() as $pk => $fs) {
                    if ($fs->getOutgoingRequest() || $fs->getFollowing()) {
                        $followings[] = $pk;
                    }
                }


                foreach ($feed->getUsers() as $user) {
                    if (!in_array($user->getPk(), $followings) &&
                        $user->getPk() != $Account->get("instagram_id")) 
                    {
                        $_log = new LogModel([
                            "user_id" => $User->get("id"),
                            "account_id" => $Account->get("id"),
                            "followed_user_pk" => $user->getPk(),
                            "status" => "success"
                        ]);

                        if (!$_log->isAvailable()) {
                            // Found new user
                            $follow_pk = $user->getPk();
                            $follow_username = $user->getUsername();
                            $follow_full_name = $user->getFullName();
                            $follow_profile_pic_url = $user->getProfilePicUrl();

                            break 2;
                        }
                    }
                }
                
                $round++;
                $next_max_id = $feed->getNextMaxId();
                if ($round >= 5 || !empty($follow_pk) || $next_max_id === null) {
                    $loop = false;
                }
            }
        }

        if (empty($follow_pk)) {
            $Log->set("data.error.msg", "Couldn't find new user to follow")
                ->save();
            continue;
        }


        // New user found to follow
        try {
            $resp = $Instagram->people->follow($follow_pk);
        } catch (\Exception $e) {
            $Log->set("data.error.msg", "Couldn't follow the user")
                ->set("data.error.details", $e->getMessage())
                ->save();
            continue;
        }


        if (!$resp->isOk()) {
            $Log->set("data.error.msg", "Couldn't follow the user")
                ->set("data.error.details", "Something went wrong")
                ->save();
            continue;   
        }


        // Followed new user successfully
        $Log->set("status", "success")
            ->set("data.followed", [
                "pk" => $follow_pk,
                "username" => $follow_username,
                "full_name" => $follow_full_name,
                "profile_pic_url" => $follow_profile_pic_url
            ])
            ->set("followed_user_pk", $follow_pk)
            ->save();
    }
}
\Event::bind("cron.add", __NAMESPACE__."\addCronTask");


/**
 * Get Plugin Settings
 * @return \GeneralDataModel 
 */
function settings()
{
    $settings = \Controller::model("GeneralData", "plugin-auto-follow-settings");
    return $settings;
}
function getSpeedsSettings(){
  
    $json = file_get_contents(PLUGINS_PATH."/auto-follow/assets/json/speed-settings.json");
    return json_decode($json, true)[0];
}

function  getAccountSentComments($account_id){
  
    $query = \DB::table('np_auto_follow_log')

    ->where("account_id", "=",$account_id)
    ->where("date", ">=", date("Y-m-d 00:00:00")) 
    ->select("*")
    ->get();
    return sizeOf($query) > 0 ? $query : [];
  }