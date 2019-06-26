<?php
namespace Plugins\ProxyManager;

require_once PLUGINS_PATH."/proxy-manager/models/AccountModel.php";
require_once PLUGINS_PATH."/proxy-manager/models/LogModel.php";


// Disable direct access
if (!defined('APP_VERSION'))
    die("Yo, what's up?");



/**
 * All functions related to the cron task
 */



/**
 * Add cron task to remove user's proxy belongs to expire package
 */
function addCronTask()
{
    $Users = \DB::table(TABLE_PREFIX.TABLE_USERS);
    $Users = $Users->get();

    foreach($Users as $UserData) {
        $User = \Controller::model("User", $UserData->id);

        // Check user is exist or expired
        if(!$User->isAvailable() || $User->isExpired()) {

            // Account
            $Accounts = \DB::table(TABLE_PREFIX.TABLE_ACCOUNTS);

            // Get all accounts of this user before removed proxy
            $Accounts->select("id")
                ->select("user_id")
                ->select("proxy")
                ->where("user_id", "=", $User->get("id"));

            foreach ($Accounts->get() as $Account) {

                if(empty($Account->proxy)) {
                    continue;
                }

                $Proxy = \Controller::model("Proxy", $Account->proxy);

                if(!$Proxy->isAvailable()) {
                    continue;
                }

                // Log
                $Log = new LogModel;
                $Log->set("user_id", $Account->user_id)
                    ->set("account_id", $Account->id)
                    ->set("proxy_id", $Proxy->get("id"))
                    ->set("data.type", "expired")
                    ->set("data.msg", "was removed proxy because the package expired")
                    ->set("status", "success")
                    ->save();
            }


            // Remove proxy when user's package expired
            $Accounts->where("user_id", "=", $User->get("id"));
            $Accounts->update(["proxy" => ""]);

            // Refresh count of all proxies
            \Event::trigger("refresh.count.of.proxies");

        }
    }
}
\Event::bind("cron.add", __NAMESPACE__."\addCronTask");