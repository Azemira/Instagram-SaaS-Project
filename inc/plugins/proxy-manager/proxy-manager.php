<?php
namespace Plugins\ProxyManager;

const IDNAME = "proxy-manager";

// Disable direct access
if (!defined('APP_VERSION')) {
    die("Yo, what's up?");
}

// File Manager
include 'libs/ModuleFileManager.php';

/**
 * Event: plugin.install
 */
function install($Plugin)
{
    if ($Plugin->get("idname") != IDNAME) {
        return false;
    }

    // Create instance of File Manager
    $fm = new ModuleFileManager();

    // Backup routes file
    $fm->setModuleFolder("storage/backup")
        ->addPath("app/inc/routes.inc.php")
        ->backup();

    // Detect version and use file in this version
    if(version_compare(APP_VERSION, "4.2", "<")) {
        $fm->setModuleFolder("storage/4.0");
    }

    if(version_compare(APP_VERSION, "4.2", ">=")) {
        $fm->setModuleFolder("storage/4.2");
    }

    // Copy all file from storage to app folder
    $fm->addPath("app/controllers/PMAccountsController.php")
        ->addPath("app/controllers/PMAccountController.php")
        ->addPath("app/views/pm.account.php")
        ->addPath("app/views/fragments/pm.account.fragment.php")
        ->replace();

    $routes = file_get_contents(APPPATH."/inc/routes.inc.php");
    $routes = str_replace('"Account"', '"PMAccount"', $routes);
    $routes = str_replace('"Accounts"', '"PMAccounts"', $routes);
    file_put_contents(APPPATH."/inc/routes.inc.php", $routes);

    //CREATE TABLE
    $sql = "CREATE TABLE IF NOT EXISTS `".TABLE_PREFIX."proxy_manager_log` (
                `id` INT NOT NULL AUTO_INCREMENT ,
                `user_id` INT NOT NULL ,
                `account_id` INT NOT NULL ,
                `proxy_id` INT NOT NULL,
                `status` VARCHAR(20) NOT NULL,
                `data` TEXT NOT NULL ,
                `date` DATETIME NOT NULL ,
                PRIMARY KEY (`id`),
                INDEX (`user_id`),
                INDEX (`account_id`),
                INDEX (`proxy_id`)
            ) ENGINE = InnoDB;";

    $sql .= "ALTER TABLE `".TABLE_PREFIX."proxy_manager_log`
                ADD CONSTRAINT `".uniqid("ibfk_")."` FOREIGN KEY (`user_id`)
                REFERENCES `".TABLE_PREFIX."users`(`id`)
                ON DELETE CASCADE ON UPDATE CASCADE;";

    $sql .= "ALTER TABLE `".TABLE_PREFIX."proxy_manager_log`
                ADD CONSTRAINT `".uniqid("ibfk_")."` FOREIGN KEY (`account_id`)
                REFERENCES `".TABLE_PREFIX."accounts`(`id`)
                ON DELETE CASCADE ON UPDATE CASCADE;";

    $sql .= "ALTER TABLE `".TABLE_PREFIX."proxy_manager_log`
                ADD CONSTRAINT `".uniqid("ibfk_")."` FOREIGN KEY (`proxy_id`)
                REFERENCES `".TABLE_PREFIX."proxies`(`id`)
                ON DELETE CASCADE ON UPDATE CASCADE;";

    // Modify proxies table
    $sql .= "ALTER TABLE ".TABLE_PREFIX."proxies ADD limit_usage int(11) NOT NULL;";
    $sql .= "ALTER TABLE ".TABLE_PREFIX."proxies ADD package_id int(11) NOT NULL;";
    $sql .= "ALTER TABLE ".TABLE_PREFIX."proxies ADD replace_proxy VARCHAR(255) NOT NULL;";
    $sql .= "ALTER TABLE ".TABLE_PREFIX."proxies ADD assign_count int(11) NOT NULL;";
    $sql .= "ALTER TABLE ".TABLE_PREFIX."accounts ADD proxy_added_by_user BOOLEAN NOT NULL;";

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

    // Create instance of File Manager
    $fm = new ModuleFileManager();

    // Restore all files from backup folder
    $fm->setModuleFolder("storage/backup")
        ->addPath("app/inc/routes.inc.php")
        ->restore();

    // Delete files
    $fm->addPath("app/controllers/PMAccountsController.php")
        ->addPath("app/controllers/PMAccountController.php")
        ->addPath("app/views/pm.account.php")
        ->addPath("app/views/fragments/pm.account.fragment.php")
        ->delete();

    //  Drop column on proxies table
    $sql = "DROP TABLE `".TABLE_PREFIX."proxy_manager_log`;";
    $sql .= "ALTER TABLE ".TABLE_PREFIX."proxies DROP assign_count;";
    $sql .= "ALTER TABLE ".TABLE_PREFIX."proxies DROP limit_usage;";
    $sql .= "ALTER TABLE ".TABLE_PREFIX."proxies DROP package_id;";
    $sql .= "ALTER TABLE ".TABLE_PREFIX."proxies DROP replace_proxy;";
    $sql .= "ALTER TABLE ".TABLE_PREFIX."accounts DROP proxy_added_by_user;";

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
    $config = include __DIR__."/config.php"; ?>
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
                    <?= __('Proxy Manager') ?>
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
    // Index
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/IndexController.php",
        __NAMESPACE__ . "\IndexController"
    ]);

    // Proxy
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/[i:id]/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/ProxyController.php",
        __NAMESPACE__ . "\ProxyController"
    ]);

    // New Proxy
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/new?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/ProxyController.php",
        __NAMESPACE__ . "\ProxyController"
    ]);

    // User
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/users/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/UsersController.php",
        __NAMESPACE__ . "\UsersController"
    ]);

    // Users
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/users/[i:id]/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/UserController.php",
        __NAMESPACE__ . "\UserController"
    ]);

    // Upload
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/upload/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/UploadController.php",
        __NAMESPACE__ . "\UploadController"
    ]);

    // Upload Hash
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/upload/[a:hash]/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/UploadController.php",
        __NAMESPACE__ . "\UploadController"
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
    include "views/fragments/navigation.fragment.php";
}
\Event::bind("navigation.add_special_menu", __NAMESPACE__ . '\navigation');

/**
 * Event: refresh.count.of.proxy
 */
function refreshCountOfProxy($proxy)
{
    $tableProxies = TABLE_PREFIX.TABLE_PROXIES;
    $tableAccount = TABLE_PREFIX.TABLE_ACCOUNTS;
    $query = "UPDATE ".$tableProxies." SET assign_count = IFNULL((SELECT COUNT(proxy) FROM ".$tableAccount." WHERE proxy = \"".$proxy."\" GROUP BY proxy), 0) WHERE proxy = \"".$proxy."\" ";
    \DB::query($query);
}
\Event::bind("refresh.count.of.proxy", __NAMESPACE__ . '\refreshCountOfProxy');

/**
 * Event: refresh.count.of.proxies
 */
function refreshCountOfProxies()
{
    $tableProxies = TABLE_PREFIX.TABLE_PROXIES;
    $tableAccount = TABLE_PREFIX.TABLE_ACCOUNTS;
    $query = "UPDATE ".$tableProxies." SET assign_count = IFNULL((SELECT COUNT(proxy) FROM ".$tableAccount." WHERE ".$tableAccount.".proxy = ".$tableProxies.".proxy GROUP BY proxy), 0)";
    \DB::query($query);
}
\Event::bind("refresh.count.of.proxies", __NAMESPACE__ . '\refreshCountOfProxies');


/**
 * Include Cron Task functions
 */
require_once __DIR__ . "/cron.php";

