<?php 
namespace Plugins\InstagramChatbot;

// Disable direct access
// if (!defined('APP_VERSION')) 
//     die("Yo, what's up?"); 



/**
 * All functions related to the cron task
 */



/**
 * Add cron task to like new posts
 */
function addCronTask()
{
    require_once __DIR__."/models/SettingsModel.php";
    // require_once __DIR__."/models/LogModel.php";


    // Get auto like schedules
    $ActiveChatbots = new SettingsModel;
    $ActiveChatbots->where("chatbot_status", "=", 1)
              ->setPageSize(10) // required to prevent server overload
              ->setPage(1)
              ->fetchData();

    if ($ActiveChatbots->getTotalCount() < 1) {
        // There is not any active schedule
        return false;
    }
    var_dump(count($ActiveChatbots));



    // $as = [__DIR__."/models/ScheduleModel.php", __NAMESPACE__."\ScheduleModel"];
    // foreach ($Schedules->getDataAs($as) as $sc) {
    //     $Log = new LogModel;
    //     $Account = \Controller::model("Account", $sc->get("account_id"));
    //     $User = \Controller::model("User", $sc->get("user_id"));



    //     // Set default values for the log (not save yet)...
    //     $Log->set("user_id", $User->get("id"))
    //         ->set("account_id", $Account->get("id"))
    //         ->set("status", "error");



    //     // Check account
    //     if (!$Account->isAvailable() || $Account->get("login_required")) {
    //         // Account is either removed (unexected, external factors)
    //         // Or login required for this account
    //         // Deactivate schedule
    //         $sc->set("is_active", 0)->save();

    //         // Log data
    //         $Log->set("data.error.msg", "Activity has been stopped")
    //             ->set("data.error.details", "Re-login is required for the account.")
    //             ->save();
    //         continue;
    //     }

    //     // Check user
    //     if (!$User->isAvailable() || !$User->get("is_active") || $User->isExpired()) {
    //         // User is not valid
    //         // Deactivate schedule
    //         $sc->set("is_active", 0)->save();

    //         // Log data
    //         $Log->set("data.error.msg", "Activity has been stopped")
    //             ->set("data.error.details", "User account is either disabled or expired.")
    //             ->save();
    //         continue;
    //     }

    //     if ($User->get("id") != $Account->get("user_id")) {
    //         // Unexpected, data modified by external factors
    //         // Deactivate schedule
    //         $sc->set("is_active", 0)->save();
    //         continue;
    //     }


    //     // Check user access to the module
    //     $user_modules = $User->get("settings.modules");
    //     if (!is_array($user_modules) || !in_array(IDNAME, $user_modules)) {
    //         // Module is not accessible to this user
    //         // Deactivate schedule
    //         $sc->set("is_active", 0)->save();

    //         // Log data
    //         $Log->set("data.error.msg", "Activity has been stopped")
    //             ->set("data.error.details", "Module is not accessible to your account.")
    //             ->save();
    //         continue;
    //     }



    //     // Define feed type
    //     $feed_type = "target";
    //     if ($sc->get("timeline_feed.enabled")) {
    //         $tf_schedule = $sc->get("timeline_feed.schedule_date");
    //         if (!$tf_schedule) {
    //             $tf_schedule = date("Y-m-d H:i:s");
    //         }

    //         if ($tf_schedule <= date("Y-m-d H:i:s")) {
    //             $feed_type = "timeline";

    //             $refresh_interval = (int)$settings->get("data.timeline.refresh_interval");
    //             if ($refresh_interval < 0) {
    //                 $refresh_interval = 1800;
    //             }

    //             $tf_schedule 
    //                 = date("Y-m-d H:i:s", time() + $refresh_interval + $random_delay);

    //             $sc->set("timeline_feed.schedule_date", $tf_schedule)
    //                ->save();
    //         }   
    //     }


    //     // Calculate next schedule datetime...
    //     if (isset($speeds[$sc->get("speed")]) && (int)$speeds[$sc->get("speed")] > 0) {
    //         $speed = (int)$speeds[$sc->get("speed")];
    //         $delta = round(3600/$speed) + $random_delay;
    //     } else {
    //         $delta = rand(720, 7200);
    //     }

    //     $next_schedule = date("Y-m-d H:i:s", time() + $delta);
    //     if ($feed_type == "target" && !empty($tf_schedule) && $tf_schedule < $next_schedule) {
    //         // Next schedule is for timeline feed
    //         $next_schedule = $tf_schedule;
    //     }

    //     if ($sc->get("daily_pause")) {
    //         $pause_from = date("Y-m-d")." ".$sc->get("daily_pause_from");
    //         $pause_to = date("Y-m-d")." ".$sc->get("daily_pause_to");
    //         if ($pause_to <= $pause_from) {
    //             // next day
    //             $pause_to = date("Y-m-d", time() + 86400)." ".$sc->get("daily_pause_to");
    //         }

    //         if ($next_schedule > $pause_to) {
    //             // Today's pause interval is over
    //             $pause_from = date("Y-m-d H:i:s", strtotime($pause_from) + 86400);
    //             $pause_to = date("Y-m-d H:i:s", strtotime($pause_to) + 86400);
    //         }

    //         if ($next_schedule >= $pause_from && $next_schedule <= $pause_to) {
    //             $next_schedule = $pause_to;
    //         }
    //     }
    //     $sc->set("schedule_date", $next_schedule)
    //        ->set("last_action_date", date("Y-m-d H:i:s"))
    //        ->save();


    //     if ($feed_type == "timeline" && $tf_schedule <= $next_schedule) {
    //         // Force next schedule for target
    //         $tf_schedule = date("Y-m-d H:i:s", strtotime($next_schedule) + 59);
    //         $sc->set("timeline_feed.schedule_date", $tf_schedule)
    //            ->save();
    //     }


    //     // Login into the account
    //     try {
    //         $Instagram = \InstagramController::login($Account);
    //     } catch (\Exception $e) {
    //         // Couldn't login into the account
    //         $Account->refresh();

    //         // Log data
    //         if ($Account->get("login_required")) {
    //             $sc->set("is_active", 0)->save();
    //             $Log->set("data.error.msg", "Activity has been stopped");
    //         } else {
    //             $Log->set("data.error.msg", "Action re-scheduled");
    //         }
    //         $Log->set("data.error.details", $e->getMessage())
    //             ->save();

    //         continue;
    //     }

    //     if ($feed_type == "target") {
    //         namespace\_like_from_target($sc, $Instagram);
    //     } else if ($feed_type == "timeline") {
    //         namespace\_like_from_timeline($sc, $Instagram);
    //     }
    // }
}
addCronTask();
// \Event::bind("cron.add", __NAMESPACE__."\addCronTask");