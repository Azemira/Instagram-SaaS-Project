<?php 
namespace Plugins\AutoComment;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?"); 



/**
 * All functions related to the cron task
 */



/**
 * Add cron task to comment on new posts
 */
function addCronTask()
{
    $tempScheduleData = [];
    $ExecuteData = [];
    require_once __DIR__."/models/SchedulesModel.php";
    require_once __DIR__."/models/LogModel.php";

    $speedSettings = getSpeedsSettings();
    
    
    
    // Get auto comment schedules 
    $Schedules = new SchedulesModel;
    $Schedules->where("is_active", "=", 1)
              ->where("schedule_date", "<=", date("Y-m-d H:i:s"))
              ->where("end_date", ">=", date("Y-m-d H:i:s"))
              ->orderBy("last_action_date", "ASC")
              ->setPageSize(10) // required to prevent server overload
              ->setPage(1)
              ->fetchData();
             
  
    if ($Schedules->getTotalCount() < 1) {
        // There is not any active schedule
        return false;
    }

    // Get settings 
    $settings = namespace\settings();


    // Random delays between actions
    $random_delay = 0;
    if ($settings->get("data.random_delay")) {
        $random_delay = rand(0, 300);
    }


    //Speeds
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
        $randomWait = rand(intval($speedSettings[$speedCategotry]['wait-from']),intval($speedSettings[$speedCategotry]['wait-to']));
        $randomSleep = rand(intval($speedSettings[$speedCategotry]['delay-secconds-from']),intval($speedSettings[$speedCategotry]['delay-secconds-to']));
        $randomCommentsCount = rand(intval($speedSettings[$speedCategotry]['comment-limit-min']),intval($speedSettings[$speedCategotry]['comment-limit-max']));
        $daily_account_limit = intval($speedSettings[$speedCategotry]['comment-per-day-limit']);
        $checkSentComments =  getAccountSentComments($sc->get("account_id"));
        $last_action_date = new \DateTime(date('Y-m-d h:i:s', strtotime($sc->get("last_action_date"))));
        $last_action_date_diff = $last_action_date->diff(new \DateTime(date('Y-m-d h:i:s')));
        $last_action_min = $last_action_date_diff->i;
        // $operation = 'new';

       
        $Log = new LogModel;
        $Account = \Controller::model("Account", $sc->get("account_id"));
        $User = \Controller::model("User", $sc->get("user_id"));


        // Set default values for the log (not save yet)...
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


        // Check user
        if (!$User->isAvailable() || !$User->get("is_active") || $User->isExpired()) {
            // User is not valid
            // Deactivate schedule
            $sc->set("is_active", 0)->save();

            // Log data
            $Log->set("data.error.msg", "Activity has been stopped")
                ->set("data.error.details", "User account is either disabled or expired.")
                ->save();
            continue;
        }

        if ($User->get("id") != $Account->get("user_id")) {
            // Unexpected, data modified by external factors
            // Deactivate schedule
            $sc->set("is_active", 0)->save();
            continue;
        }


        // Check user access to the module
        $user_modules = $User->get("settings.modules");
        if (!is_array($user_modules) || !in_array(IDNAME, $user_modules)) {
            // Module is not accessible to this user
            // Deactivate schedule
            $sc->set("is_active", 0)->save();

            // Log data
            $Log->set("data.error.msg", "Activity has been stopped")
                ->set("data.error.details", "Module is not accessible to your account.")
                ->save();
            continue;
        }


        // Define feed type
        $feed_type = "target";
        if ($sc->get("timeline_feed.enabled")) {
            $tf_schedule = $sc->get("timeline_feed.schedule_date");
            if (!$tf_schedule) {
                $tf_schedule = date("Y-m-d H:i:s");
            }

            if ($tf_schedule <= date("Y-m-d H:i:s")) {
                $feed_type = "timeline";

                $refresh_interval = (int)$settings->get("data.timeline.refresh_interval");
                if ($refresh_interval < 0) {
                    $refresh_interval = 1800;
                }

                $tf_schedule 
                    = date("Y-m-d H:i:s", time() + $refresh_interval + $random_delay);

                $sc->set("timeline_feed.schedule_date", $tf_schedule)
                   ->save();
            }   
        }


       // Calculate next schedule datetime...
        if (isset($speeds[$sc->get("speed")]) && (int)$speeds[$sc->get("speed")] > 0) {
           
            $last_operation_comments_count = $sc->get("last_operation_comments");
            $last_operation_comments_step = $sc->get("last_operation_step");
            // $last_operation_start = $sc->get("last_operation_start");
            // $commensFromLastOperation = !empty($last_operation_start) ? getLastOperationSentComments($sc->get("account_id"), $last_operation_start) : null;
            
            if($last_operation_comments_count > $last_operation_comments_step){
                // $operation = 'process';
                $randomSleep = (int)$randomSleep;
                $delta = $randomSleep;
                $sc->set("last_operation_step", $last_operation_comments_step + 1)
                    ->save();
                if($last_operation_comments_count == $last_operation_comments_step + 1){
                    $delta = (int)$randomWait * 60;
                    $sc->set("last_operation_start", date("Y-m-d H:i:s"))
                       ->set("last_operation_comments", (int)$randomCommentsCount)
                       ->set("last_operation_step", 0)
                       ->save();
                }
                   
            } 
            // else {
            //     $operation = 'new';
            //     $delta = (int)$randomWait * 60;
            //     $sc->set("last_operation_start", date("Y-m-d H:i:s"))
            //        ->set("last_operation_comments", (int)$randomCommentsCount)
            //        ->set("last_operation_step", 0)
            //        ->save();
            // }

        } else {
            $delta = rand(720, 7200);
        }

        $next_schedule = date("Y-m-d H:i:s", time() + $delta);
        if ($feed_type == "target" && !empty($tf_schedule) && $tf_schedule < $next_schedule) {
            // Next schedule is for timeline feed
            $next_schedule = $tf_schedule;
        }

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

        if ($feed_type == "timeline" && $tf_schedule <= $next_schedule) {
            // Force next schedule for target
            $tf_schedule = date("Y-m-d H:i:s", strtotime($next_schedule) + 59);
            $sc->set("timeline_feed.schedule_date", $tf_schedule)
               ->save();
        }


        // Check comments
        $comments = @json_decode($sc->get("comments"));
        if (is_null($comments)) {
            // Unexpected, data modified by external factors or empty comments
            // Deactivate schedule
            $sc->set("is_active", 0)->save();
            continue;
        }

        if (count($comments) < 1) {
            // Comment list is empty
            // Deactivate schedule
            $sc->set("is_active", 0)->save();

            // Log data
            $Log->set("data.error.msg", "Comment list is empty.")
                ->save();
            continue;
        }
        // if($operation == 'new'){
        //     continue;
        // }


        // Login into the account
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
        $last_action_date = $sc->get("last_action_date");

        $do_spintax = (bool)$User->get("settings.spintax");
        $sc->set("last_action_date", date("Y-m-d H:i:s"))
        ->save();
       
        if ($feed_type == "target") {
            namespace\_comment_target_feed($sc, $Instagram, $comments, $do_spintax);
        } else if ($feed_type == "timeline") {
            namespace\_comment_timeline_feed($sc, $Instagram, $comments, $do_spintax);
        }


    }
}
\Event::bind("cron.add", __NAMESPACE__."\addCronTask");


/**
 * Select a feed item according to the target and put a comment
 * @param  __NAMESPACE__\ScheduleModel $sc        Schedule Model
 * @param  \InstagramController $Instagram Instagram Controller
 * @param  Array $comments  An array of the comments
 * @param  Bool $do_spintax 
 * @return null            
 */
function _comment_target_feed($sc, $Instagram, $comments, $do_spintax = false)
{
    // Set default values for the log (not save yet)...
    $Log = new LogModel;
    $Log->set("user_id", $sc->get("user_id"))
        ->set("account_id", $sc->get("account_id"))
        ->set("status", "error");

    // Emojione client
    $Emojione = new \Emojione\Client(new \Emojione\Ruleset());

    // Parse targets
    $targets = @json_decode($sc->get("target"));
    if (is_null($targets)) {
        // Unexpected, data modified by external factors
        // Deactivate schedule
        $sc->set("is_active", 0)->save();
        return false;
    }

    if (count($targets) < 1) {
        // Couldn't find any target for the feed
        // Log data
        $Log->set("data.error.msg", "Couldn't find any target to search for the feed.")
            ->save();
        return false;
    }

    // Select random target
    $i = rand(0, count($targets) - 1);
    $target = $targets[$i];

    if (empty($target->type) || empty($target->id) ||
        !in_array($target->type, ["hashtag", "location", "people"])) 
    {
        // Unexpected invalid target, 
        // data modified by external factors
        $sc->set("is_active", 0)->save();
        return false;   
    }


    // Log trigger
    $Log->set("data.trigger", $target);


    // Generate a random rank token.
    $rank_token = \InstagramAPI\Signatures::generateUUID();
    
    if ($target->type == "hashtag") {
        $hashtag = str_replace("#", "", trim($target->id));
        if (!$hashtag) {
            return false;
        }

        try {
            $feed = $Instagram->hashtag->getFeed(
                $hashtag,
                $rank_token);
        } catch (\Exception $e) {
            // Couldn't get instagram feed related to the hashtag
            // Log data
            $msg = $e->getMessage();
            $msg = explode(":", $msg, 2);
            $msg = isset($msg[1]) ? $msg[1] : $msg[0];

            $Log->set("data.error.msg", "Couldn't get the feed")
                ->set("data.error.details", $msg)
                ->save();
            return false;
        }

        $items = $feed->getItems();
    } else if ($target->type == "location") {
        try {
            $feed = $Instagram->location->getFeed(
                $target->id,
                $rank_token);
        } catch (\Exception $e) {
            // Couldn't get instagram feed related to the location id
            // Log data
            $msg = $e->getMessage();
            $msg = explode(":", $msg, 2);
            $msg = isset($msg[1]) ? $msg[1] : $msg[0];

            $Log->set("data.error.msg", "Couldn't get the feed")
                ->set("data.error.details", $msg)
                ->save();
            return false;
        }

        $items = $feed->getItems();
    } else if ($target->type == "people") {
        try {
           
            $users = $Instagram->people->getFollowers(
            $target->id,
            $rank_token);
            $feed = getAllUserFeeds($users->getUsers(), $Instagram);
        } catch (\Exception $e) {
            // Couldn't get instagram feed related to the user id
            // Log data
            $msg = $e->getMessage();
            $msg = explode(":", $msg, 2);
            $msg = isset($msg[1]) ? $msg[1] : $msg[0];

            $Log->set("data.error.msg", "Couldn't get the feed")
                ->set("data.error.details", $msg)
                ->save();
            return false;
        }

        $items = $feed;
        shuffle($items);
    }
    if ($target->type !== "people") {
        if (count($feed->getItems()) < 1) {
            // Invalid
            return false;
        }
    } else {
        if (count($feed) < 1) {
            // Invalid
            return false;
        }
    }


    // Find media to comment
    $media_id = null;
    $media_code = null;
    $media_type = null;
    $media_thumb = null;
    $user_pk = null;
    $user_username = null;
    $user_full_name = null;

    foreach ($items as $item) {
        if ($item->getId() && !$item->getCommentsDisabled())  {
            $_log = new LogModel([
                "user_id" => $sc->get("user_id"),
                "account_id" => $sc->get("account_id"),
                "commented_media_code" => $item->getCode(),
                "status" => "success"
            ]);

            if (!$_log->isAvailable()) {
                // Found the media to comment
                $media_id = $item->getId();
                $media_code = $item->getCode();
                $media_type = $item->getMediaType();
                $media_thumb = namespace\_get_media_thumb_igitem($item);
                $user_pk = $item->getUser()->getPk();
                $user_username = $item->getUser()->getUsername();
                $user_full_name = $item->getUser()->getFullName();
                break;
            }
        }
    }

    if (empty($media_id)) {
        $Log->set("data.error.msg", "Couldn't find the new media to comment")
            ->save();
        return false;
    }


    // Found the media to comment
    // Get random comment
    $variables = [
        "{{username}}" => "@".$user_username,
        "{{full_name}}" => $user_full_name
    ];
    $comment = namespace\_get_comment($comments, $do_spintax, $variables);

    try {
        $resp = $Instagram->media->comment($media_id, $comment);
    } catch (\Exception $e) {
        $msg = $e->getMessage();
        $msg = explode(":", $msg, 2);
        $msg = isset($msg[1]) ? $msg[1] : $msg[0];

        $Log->set("data.error.msg", "Something went wrong")
            ->set("data.error.details", $msg)
            ->save();
        return false;
    }


    if (!$resp->isOK()) {
        $Log->set("data.error.msg", "Couldn't comment to the media")
            ->set("data.error.details", "Something went wrong")
            ->save();
        return false;   
    }


    // Post a comment successfully
    // Save log
    $Log->set("status", "success")
        ->set("data.commented", [
            "media_id" => $media_id,
            "media_code" => $media_code,
            "media_type" => $media_type,
            "media_thumb" => $media_thumb,
            "user" => [
                "pk" => $user_pk,
                "username" => $user_username,
                "full_name" => $user_full_name
            ],
            "comment" => $Emojione->toShort($comment)
        ])
        ->set("commented_media_code", $media_code)
        ->save();
}



/**
 * Select a feed items from the timeline feed and put a comment
 * @param  __NAMESPACE__\ScheduleModel $sc        Schedule Model
 * @param  \InstagramController $Instagram Instagram Controller
 * @param  Array $comments  An array of the comments
 * @param  Bool $do_spintax 
 * @return null            
 */
function _comment_timeline_feed($sc, $Instagram, $comments, $do_spintax = false)
{
    // Set default values for the log (not save yet)...
    $Log = new LogModel;
    $Log->set("user_id", $sc->get("user_id"))
        ->set("account_id", $sc->get("account_id"))
        ->set("status", "error");

    // Emojione client
    $Emojione = new \Emojione\Client(new \Emojione\Ruleset());

    // Log trigger
    $Log->set("data.trigger", ["type" => "timeline_feed"]);


    $settings = namespace\settings();
    $max = (int)$settings->get("data.timeline.max_comment");
    if ($max < 1) {
        $max = 1;
    }


    // Get timeline feed items
    $items = [];
    $loop = true;
    $round = 1;
    $max_id = null;

    while ($loop) {
        try {
            $feed = $Instagram->timeline->getTimelineFeed();
        } catch (\Exception $e) {
            // Couldn't get instagram timeline feed
            $loop = false;

            if ($round == 1) {
                // Log data
                $msg = $e->getMessage();
                $msg = explode(":", $msg, 2);
                $msg = isset($msg[1]) ? $msg[1] : $msg[0];

                $Log->set("data.error.msg", "Couldn't get the timeline feed")
                    ->set("data.error.details", $msg)
                    ->save();
                return false;
            }
        }

        if (count($feed->getFeedItems()) < 1) {
            // Invalid
            $loop = false;
        }

        $items = array_merge($items, $feed->getFeedItems());
        $round++;
        $max_id = $feed->getNextMaxId();

        if (!$max_id || count($items) >= $max || $round >= 5) {
            $loop = false;
        }
    }


    if (count($items) < 1) {
        return false;
    }

    $items = array_reverse($items);
    $items = array_slice($items, 0, $max);


    $comment_count = 0;
    foreach ($items as $item) {
        $item = $item->getMediaOrAd();

        if (!$item) {
            continue;
        }

        if ($item->getId() && !$item->getCommentsDisabled())  {
            $_log = new LogModel([
                "user_id" => $sc->get("user_id"),
                "account_id" => $sc->get("account_id"),
                "commented_media_code" => $item->getCode(),
                "status" => "success"
            ]);

            if (!$_log->isAvailable()) {
                // Found the media to comment
                // Get random comment
                $variables = [
                    "{{username}}" => "@".$item->getUser()->getUsername(),
                    "{{full_name}}" => $item->getUser()->getFullName()
                ];
                $comment = namespace\_get_comment($comments, $do_spintax, $variables);

                try {
                    $resp = $Instagram->media->comment($item->getId(), $comment);
                } catch (\Exception $e) {
                    continue;
                }

                if (!$resp->isOk()) {
                    continue;   
                }


                $media_thumb = namespace\_get_media_thumb_igitem($item);


                // Commented successfully
                $_log->set("status", "success")
                     ->set("account_id", $sc->get("account_id"))
                     ->set("user_id", $sc->get("user_id"))
                     ->set("data.trigger", ["type" => "timeline_feed"])
                     ->set("data.commented", [
                        "media_id" => $item->getId(),
                        "media_code" => $item->getCode(),
                        "media_type" => $item->getMediaType(),
                        "media_thumb" => $media_thumb,
                        "user" => [
                            "pk" => $item->getUser()->getPk(),
                            "username" => $item->getUser()->getUsername(),
                            "full_name" => $item->getUser()->getFullName()
                        ],
                        "comment" => $Emojione->toShort($comment)
                    ])
                     ->set("commented_media_code", $item->getCode())
                     ->save();

                $comment_count++;
            }
        }
    }

    if ($comment_count > 0) {
        return true;
    }


    $Log->set("data.error.msg", "Couldn't find any new media to comment in the timeline feed")
        ->save();
    return false;
}





/**
 * Get media thumb url from the Instagram feed item
 * @param  stdObject $item Instagram feed item
 * @return string|null       
 */
function _get_media_thumb_igitem($item)
{
    $media_thumb = null;

    $media_type = empty($item->getMediaType()) ? null : $item->getMediaType();

    if ($media_type == 1 || $media_type == 2) {
        // Photo (1) OR Video (2)
        $media_thumb = $item->getImageVersions2()->getCandidates()[0]->getUrl();
    } else if ($media_type == 8) {
        // ALbum
        $media_thumb = $item->getCarouselMedia()[0]->getImageVersions2()->getCandidates()[0]->getUrl();
    }

    return $media_thumb;
}


/**
 * Get random comment from the list
 * @param  [type]  $comments   [description]
 * @param  boolean $do_spintax [description]
 * @param  array   $variables  [description]
 * @return [type]              [description]
 */
function _get_comment($comments, $do_spintax = false, $variables = [])
{
    $i = rand(0, count($comments) - 1);
    $comment = $comments[$i];

    $default_variables = [
        "{{username}}" => "{{username}}",
        "{{full_name}}" => "{{full_name}}"
    ];
    $variables = array_merge($default_variables, $variables);
    if (empty($variables["{{full_name}}"])) {
        $variables["{{full_name}}"] = $variables["{{username}}"];
    }

    $search = array_keys($variables);
    $replace = array_values($variables);

    $comment = str_replace($search, $replace, $comment,$comment);

    // Emojione client
    $Emojione = new \Emojione\Client(new \Emojione\Ruleset());

    $comment = $Emojione->shortnameToUnicode($comment);
    if ($do_spintax) {
        $comment = \Spintax::process($comment);
    }

    return $comment;
}

function getAllUserFeeds($users, $Instagram) {
    $feeds = [];
        foreach($users as $user){
            try {
                $feed = $Instagram->timeline->getUserFeed($user->getPk());
                $items = $feed->getItems();
                 foreach($items as $item){
                    array_push($feeds, $item);
                  }
            } catch (\Exception $e) {
                continue;
            }
        }
        
    return $feeds;
}

function getSpeedsSettings(){
    $json = file_get_contents(PLUGINS_PATH."/auto-comment/assets/json/speed-settings.json");
    return json_decode($json, true)[0];
}

function  getAccountSentComments($account_id){
    $query = \DB::table('np_auto_comment_log')
    ->where("account_id", "=",$account_id)
    ->where("date", ">=", date("Y-m-d 00:00:00")) 
    ->select("*")
    ->get();
    return sizeOf($query) > 0 ? $query : [];
  }
  function  getLastOperationSentComments($account_id, $last_operation_start){
    $query = \DB::table('np_auto_comment_log')
    ->where("account_id", "=",$account_id)
    ->where("date", ">=", $last_operation_start) 
    ->select("*")
    ->get();
    return sizeOf($query) > 0 ? $query : [];

  }
