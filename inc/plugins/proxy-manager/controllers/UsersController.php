<?php
namespace Plugins\ProxyManager;

// Disable direct access
if (!defined('APP_VERSION')) {
    die("Yo, what's up?");
}

/**
 * Users Controller
 *
 * @author Nextpass <mail@nextpass.io>
 * @website https://nextpass.io
 *
 */
class UsersController extends \Controller
{
    /**
     * idname of the plugin for internal use
     */
    const IDNAME = 'proxy-manager';


    /**
     * Process
     */
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");

        // Auth
        if (!$AuthUser){
            header("Location: ".APPURL."/login");
            exit;
        } else if ($AuthUser->isExpired()) {
            header("Location: ".APPURL."/expired");
            exit;
        } else if (!$AuthUser->isAdmin()) {
            header("Location: ".APPURL."/post");
            exit;
        }

        // Get Proxies
        $Users = \Controller::model("Users");
        $Users->search(\Input::get("q"))
              ->setPageSize(20)
              ->setPage(\Input::get("page"))
              ->orderBy("id","DESC")
              ->fetchData();

        $Proxies = \Controller::model("Proxies");
        $Proxies->orderBy("id", "DESC")
                ->fetchData();

        $this->setVariable("Users", $Users)
             ->setVariable("Proxies", $Proxies)
             ->setVariable("idname", self::IDNAME);

        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/users.php", null);
    }
}
