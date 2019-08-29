<?php 
namespace Plugins\Boost;
const IDNAME = "boost";

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
  $sql = "DROP TABLE IF EXISTS `".TABLE_PREFIX."boost_schedule`; ";
  $sql .= "CREATE TABLE `".TABLE_PREFIX."boost_schedule` (
            `id` int(11) NOT NULL,
            `user_id` int(11) NOT NULL,
            `account_id` int(11) NOT NULL,
            `action_follow` tinyint(1) NOT NULL,
            `action_unfollow` tinyint(1) NOT NULL,
            `action_like` tinyint(1) NOT NULL,
            `action_comment` tinyint(1) NOT NULL,
            `action_welcomedm` tinyint(1) NOT NULL,
            `action_repost` tinyint(1) NOT NULL,
            `action_viewstory` tinyint(1) NOT NULL,
            `comments` longtext CHARACTER SET utf8 NOT NULL,
            `dms` longtext CHARACTER SET utf8 NOT NULL,
            `follow_cicle` int(11) NOT NULL,
            `target` text NOT NULL,
            `gender` varchar(20) NOT NULL,
            `ignore_private` tinyint(1) NOT NULL,
            `has_picture` tinyint(1) NOT NULL,
            `business` varchar(20) NOT NULL,
            `items` longtext NOT NULL,
            `blacklist` longtext NOT NULL,
            `bad_words` longtext NOT NULL,
            `whitelist` longtext NOT NULL,
            `unfollow_all` int(1) NOT NULL,
            `keep_followers` int(1) NOT NULL,
            `timeline_feed` text NOT NULL,
            `cicle_action` varchar(30) DEFAULT NULL,
            `cicle_follow` varchar(30) DEFAULT NULL,
            `cicle_count` int(11) DEFAULT NULL,
            `follow_count` int(11) DEFAULT NULL,
            `speed` varchar(20) NOT NULL,
            `daily_pause` int(1) NOT NULL,
            `daily_pause_from` time NOT NULL,
            `daily_pause_to` time NOT NULL,
            `is_active` int(1) NOT NULL,
            `schedule_date` datetime NOT NULL,
            `all_schedules` TEXT NOT NULL,
            `end_date` datetime NOT NULL,
            `last_action_date` datetime NOT NULL,
            `running` INT(11) NULL,
            `data` text NOT NULL
          ) ENGINE=InnoDB; ";
  
  $sql .= "ALTER TABLE `".TABLE_PREFIX."boost_schedule`
            ADD PRIMARY KEY (`id`),
            ADD KEY `user_id` (`user_id`),
            ADD KEY `account_id` (`account_id`);

          ALTER TABLE `".TABLE_PREFIX."boost_schedule` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

          ALTER TABLE `".TABLE_PREFIX."boost_schedule`
            ADD CONSTRAINT `ibfk_5b5a2b4de79aa` FOREIGN KEY (`user_id`) REFERENCES `".TABLE_PREFIX."users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT `ibfk_5b5a2b4de7a04` FOREIGN KEY (`account_id`) REFERENCES `".TABLE_PREFIX."accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;" ;
  
  
  
  $sql .= "DROP TABLE IF EXISTS `".TABLE_PREFIX."boost_log`;";
  $sql .= "CREATE TABLE `".TABLE_PREFIX."boost_log` (
            `id` int(11) NOT NULL,
            `user_id` int(11) NOT NULL,
            `account_id` int(11) NOT NULL,
            `status` varchar(20) NOT NULL,
            `action` varchar(50) NOT NULL,
            `source_pk` varchar(50) NOT NULL,
            `user_pk` varchar(50) NOT NULL,
            `target` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
            `target_value` varchar(80) DEFAULT NULL,
            `unfollowed` int(1) NOT NULL,
            `error_code` int(11) NULL,
            `data` longtext NOT NULL,
            `date` datetime NOT NULL
          ) ENGINE=InnoDB; ";
  
    $sql .= "ALTER TABLE `".TABLE_PREFIX."boost_log`
              ADD PRIMARY KEY (`id`),
              ADD KEY `user_id` (`user_id`),
              ADD KEY `account_id` (`account_id`),
              ADD KEY `status` (`status`),
              ADD KEY `source_pk` (`source_pk`),
              ADD KEY `user_pk` (`user_pk`),
              ADD KEY `unfollowed` (`unfollowed`),
              ADD KEY `target_value` (`target_value`),
              ADD KEY `target` (`target`);

            ALTER TABLE `".TABLE_PREFIX."boost_log`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

            ALTER TABLE `".TABLE_PREFIX."boost_log`
              ADD CONSTRAINT `ibfk_5b5a2b4de7a4a` FOREIGN KEY (`user_id`) REFERENCES `".TABLE_PREFIX."users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `ibfk_5b5a2b4de7a8f` FOREIGN KEY (`account_id`) REFERENCES `".TABLE_PREFIX."accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;";
  
  
    $sql .= "DROP TABLE IF EXISTS `".TABLE_PREFIX."boost_targets`; ";
    $sql .= "CREATE TABLE `".TABLE_PREFIX."boost_targets` (
              `id` int(11) NOT NULL,
              `user_id` int(11) NOT NULL,
              `account_id` int(11) NOT NULL,
              `type` varchar(50) NOT NULL,
              `value` varchar(256) NOT NULL,
              `target_id` varchar(50) NOT NULL,
              `items` MEDIUMTEXT NOT NULL,
              `data` text NOT NULL
            ) ENGINE=InnoDB; ";

    $sql .= "ALTER TABLE `".TABLE_PREFIX."boost_targets`
              ADD PRIMARY KEY (`id`),
              ADD KEY `user_id` (`user_id`),
              ADD KEY `account_id` (`account_id`);

            ALTER TABLE `".TABLE_PREFIX."boost_targets` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

            ALTER TABLE `".TABLE_PREFIX."boost_targets`
              ADD CONSTRAINT `ibfk_5b5a2b4de80bb` FOREIGN KEY (`user_id`) REFERENCES `".TABLE_PREFIX."users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `ibfk_5b5a2b4de8b15` FOREIGN KEY (`account_id`) REFERENCES `".TABLE_PREFIX."accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;";
  
  $sql .= "DROP TABLE IF EXISTS ".TABLE_PREFIX."boost_new_followers; 
            CREATE TABLE `".TABLE_PREFIX."boost_new_followers` (
                `id` int(11) NOT NULL,
                `user_id` int(11) NOT NULL,
                `account_id` int(11) NOT NULL,
                `action` varchar(50) NOT NULL,
                `user_pk` varchar(50) NOT NULL, 
                `username` varchar(250) NOT NULL,
                `target` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
                `target_value` varchar(80) DEFAULT NULL,
                `date` datetime NOT NULL
            ) ENGINE=InnoDB;";
  
  $sql .= "
  ALTER TABLE `".TABLE_PREFIX."boost_new_followers`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`),
    ADD KEY `account_id` (`account_id`),
    ADD KEY `user_pk` (`user_pk`),
    ADD KEY `target_id` (`target_value`),
    ADD KEY `target` (`target`);
    
  ALTER TABLE `".TABLE_PREFIX."boost_new_followers`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  ALTER TABLE `".TABLE_PREFIX."boost_new_followers`
    ADD CONSTRAINT `ibfk_5b5a2b4de6y5u` FOREIGN KEY (`user_id`) REFERENCES `".TABLE_PREFIX."users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `ibfk_5b5a2b4de9q3z` FOREIGN KEY (`account_id`) REFERENCES `".TABLE_PREFIX."accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;";
 
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
    $settings = namespace\settings();
    $settings->remove();

    $sql = "DROP TABLE IF EXISTS `".TABLE_PREFIX."boost_schedule`; ";
    $sql .= "DROP TABLE IF EXISTS `".TABLE_PREFIX."boost_log`; ";
    $sql .= "DROP TABLE IF EXISTS `".TABLE_PREFIX."boost_targets`; ";
    $sql .= "DROP TABLE IF EXISTS ".TABLE_PREFIX."boost_new_followers;";

    $pdo = \DB::pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}
\Event::bind("plugin.remove", __NAMESPACE__ . '\uninstall');


/**
 * Add module as a package options
 * Only users with granted permission
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
                    <?= __('Boost') ?>
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
  
    // Cron
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/cron/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/CronController.php",
        __NAMESPACE__ . "\CronController"
    ]);
  
    // Cron
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/cron/[i:id]/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/CronController.php",
        __NAMESPACE__ . "\CronController"
    ]);
  
    // Cron to celan
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/clean/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/CleanController.php",
        __NAMESPACE__ . "\CleanController"
    ]);

    // Schedule
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/[i:id]/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/ScheduleController.php",
        __NAMESPACE__ . "\ScheduleController"
    ]);
  
    // Wizard
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/[i:id]/wizard/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/ScheduleController.php",
        __NAMESPACE__ . "\ScheduleController"
    ]);  

    // Log
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/[i:id]/log/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/LogController.php",
        __NAMESPACE__ . "\LogController"
    ]);
  
    // Best Source
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/[i:id]/source?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/SourceController.php",
        __NAMESPACE__ . "\SourceController"
    ]);

    // Index
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/IndexController.php",
        __NAMESPACE__ . "\IndexController"
    ]);
  
    // Accounts
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/accounts/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/IndexController.php",
        __NAMESPACE__ . "\IndexController"
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
 * Get Plugin Settings
 * @return \GeneralDataModel 
 */
function settings()
{
    $settings = \Controller::model("GeneralData", "plugin-".IDNAME."-settings");
    return $settings;
}

/**
 * Get list of follow cicle
 * @return array 
 */
function followCicle()
{
  return [
    500,
    1000,
    1500,
    2000,
    3000,
    4000
  ];
}

/**
 * Get Speeds
 * @return array 
 */
function getSpeeds()
{
  return [
    'auto'      => __("Auto"),
    'very_slow' => __("Very Slow"),
    'slow'      => __("Slow"),
    'medium'    => __("Medium"),
    'fast'      => __("Fast"),
    'very_fast' => __("Very Fast"),
  ];
}

   /**
     * get IG Picuture
     * @param $username string
     * @return mixed
     */
    function getIgPic($username = '')
    {
      if(!$username) {
        return null;
      }

        $curl = curl_init();

        $curtOpt = [
            CURLOPT_URL => "https://www.instagram.com/" . $username,
            CURLOPT_REFERER => "https://google.com",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ];

        curl_setopt_array($curl, $curtOpt);
        $result = curl_exec($curl);
        curl_close($curl);

        $regex = '@<meta property="og:image" content="(.*?)"@si';
        preg_match_all($regex, $result, $return);
      
      return isset($return[1][0]) ? $return[1][0] : null;
    }


/**
 * Include Cron Task functions
 */
require_once __DIR__ . "/gender.male.php";
require_once __DIR__ . "/gender.female.php";
require_once __DIR__ . "/cron.php";
