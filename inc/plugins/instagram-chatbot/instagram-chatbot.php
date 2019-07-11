<?php 
namespace Plugins\InstagramChatbot;
const IDNAME = "instagram-chatbot";

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
    $sql  = "DROP TABLE IF EXISTS `".TABLE_PREFIX."chatbot_messages`;";
    $sql .= "CREATE TABLE `".TABLE_PREFIX."chatbot_messages` ( 
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `user_id` int(11) NOT NULL,
                `account_id` int(11) NOT NULL,
                `message_order` int(11) NOT NULL,
                `title` varchar(255),
                `message` LONGTEXT,
                PRIMARY KEY (`id`), 
                INDEX (`account_id`)
            ) ENGINE = InnoDB;";


    $sql .= "ALTER TABLE `".TABLE_PREFIX."chatbot_messages` 
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

 /*
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
                    <?= __('Inbox') ?>
                </span>
            </label>
        </div>
    <?php
}
\Event::bind("package.add_module_option", __NAMESPACE__ . '\add_module_option');
*/



/**
 * Map routes
 */
function route_maps($global_variable_name)
{
    // chatbot page
    $GLOBALS[$global_variable_name]->map("GET|POST","/chatbot/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/ChatbotController.php",
        __NAMESPACE__ . "\ChatbotController"
    ]);
  
    // Messages
    $GLOBALS[$global_variable_name]->map("GET|POST", "/chatbot/account/[i:id]/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/ChatbotController.php",
        __NAMESPACE__ . "\ChatbotController"
    ]);

    // save message
    $GLOBALS[$global_variable_name]->map("GET|POST", "/chatbot/message/new/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/ChatbotController.php",
        __NAMESPACE__ . "\ChatbotController"
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
\Event::bind("navigation.add_menu", __NAMESPACE__ . '\navigation');
