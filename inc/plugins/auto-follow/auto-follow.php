<?php 
namespace Plugins\AutoFollow;
const IDNAME = "auto-follow";

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?"); 


/**
 * Event: plugin.install
 */
function install($Plugin)
{
    if ($Plugin->get("idname") != IDNAME) {
        return false;
    }

    $sql = "CREATE TABLE `".TABLE_PREFIX."auto_follow_schedule` ( 
                `id` INT NOT NULL AUTO_INCREMENT , 
                `user_id` INT NOT NULL , 
                `account_id` INT NOT NULL , 
                `target` TEXT NOT NULL , 
                `speed` VARCHAR(20) NOT NULL , 
                `daily_pause` BOOLEAN NOT NULL, 
                `daily_pause_from` TIME NOT NULL, 
                `daily_pause_to` TIME NOT NULL,
                `is_active` BOOLEAN NOT NULL , 
                `schedule_date` DATETIME NOT NULL , 
                `end_date` DATETIME NOT NULL , 
                `last_action_date` DATETIME NOT NULL , 
                `data` TEXT NOT NULL,
                PRIMARY KEY (`id`), 
                INDEX (`user_id`), 
                INDEX (`account_id`)
            ) ENGINE = InnoDB;";

    $sql .= "CREATE TABLE `".TABLE_PREFIX."auto_follow_log` ( 
                `id` INT NOT NULL AUTO_INCREMENT , 
                `user_id` INT NOT NULL , 
                `account_id` INT NOT NULL , 
                `status` VARCHAR(20) NOT NULL,
                `followed_user_pk` VARCHAR(50) NOT NULL,
                `data` TEXT NOT NULL , 
                `date` DATETIME NOT NULL , 
                PRIMARY KEY (`id`), 
                INDEX (`user_id`), 
                INDEX (`account_id`),
                INDEX (`followed_user_pk`)
            ) ENGINE = InnoDB;";

    $sql .= "ALTER TABLE `".TABLE_PREFIX."auto_follow_schedule` 
                ADD CONSTRAINT `".uniqid("ibfk_")."` FOREIGN KEY (`user_id`) 
                REFERENCES `".TABLE_PREFIX."users`(`id`) 
                ON DELETE CASCADE ON UPDATE CASCADE;";

    $sql .= "ALTER TABLE `".TABLE_PREFIX."auto_follow_schedule` 
                ADD CONSTRAINT `".uniqid("ibfk_")."` FOREIGN KEY (`account_id`) 
                REFERENCES `".TABLE_PREFIX."accounts`(`id`) 
                ON DELETE CASCADE ON UPDATE CASCADE;";

    $sql .= "ALTER TABLE `".TABLE_PREFIX."auto_follow_log` 
                ADD CONSTRAINT `".uniqid("ibfk_")."` FOREIGN KEY (`user_id`) 
                REFERENCES `".TABLE_PREFIX."users`(`id`) 
                ON DELETE CASCADE ON UPDATE CASCADE;";

    $sql .= "ALTER TABLE `".TABLE_PREFIX."auto_follow_log` 
                ADD CONSTRAINT `".uniqid("ibfk_")."` FOREIGN KEY (`account_id`) 
                REFERENCES `".TABLE_PREFIX."accounts`(`id`) 
                ON DELETE CASCADE ON UPDATE CASCADE;";

    $pdo = \DB::pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}
\Event::bind("plugin.install", __NAMESPACE__ . '\install');



/**
 * Event: plugin.remove
 */
function uninstall($Plugin)
{
    if ($Plugin->get("idname") != IDNAME) {
        return false;
    }

    // Remove plugin settings
    $Settings = \Controller::model("GeneralData", "plugin-auto-follow-settings");
    $Settings->remove();

    // Remove plugin tables
    $sql = "DROP TABLE `".TABLE_PREFIX."auto_follow_schedule`;";
    $sql .= "DROP TABLE `".TABLE_PREFIX."auto_follow_log`;";

    $pdo = \DB::pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}
\Event::bind("plugin.remove", __NAMESPACE__ . '\uninstall');


/**
 * Add module as a package options
 * Only users with correct permission
 * Will be able to use module
 * 
 * @param array $package_modules An array of currently active 
 *                               modules of the package
 */
function add_module_option($package_modules)
{
    $config = include __DIR__."/config.php";
    ?>
        <div class="mt-15">
            <label>
                <input type="checkbox" 
                       class="checkbox" 
                       name="modules[]" 
                       value="<?= IDNAME ?>" 
                       <?= in_array(IDNAME, $package_modules) ? "checked" : "" ?>>
                <span>
                    <span class="icon unchecked">
                        <span class="mdi mdi-check"></span>
                    </span>
                    <?= __('Auto Follow') ?>
                </span>
            </label>
        </div>
    <?php
}
\Event::bind("package.add_module_option", __NAMESPACE__ . '\add_module_option');




/**
 * Map routes
 */
function route_maps($global_variable_name)
{
    // Settings (admin only)
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/settings/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/SettingsController.php",
        __NAMESPACE__ . "\SettingsController"
    ]);

    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/[i:id]/duplicate?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/DuplicateSettingsController.php",
        __NAMESPACE__ . "\duplicateSettingsController"
    ]);
    
    // Index
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/IndexController.php",
        __NAMESPACE__ . "\IndexController"
    ]);

    // Schedule
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/[i:id]/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/ScheduleController.php",
        __NAMESPACE__ . "\ScheduleController"
    ]);

    // Log
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/[i:id]/log/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/LogController.php",
        __NAMESPACE__ . "\LogController"
    ]);
}
\Event::bind("router.map", __NAMESPACE__ . '\route_maps');



/**
 * Event: navigation.add_special_menu
 */
function navigation($Nav, $AuthUser)
{
    $idname = IDNAME;
    include __DIR__."/views/fragments/navigation.fragment.php";
}
\Event::bind("navigation.add_special_menu", __NAMESPACE__ . '\navigation');



/**
 * Add cron task to follow new users
 */
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
