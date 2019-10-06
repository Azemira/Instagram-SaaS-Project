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
 * Include Cron Task functions
 */
require_once __DIR__ . "/cron.php";
