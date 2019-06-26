<?php
namespace Plugins\ProxyManager;

// Disable direct access
if (!defined('APP_VERSION')) {
    die("Yo, what's up?");
}

/**
 * Proxy Controller
 *
 * @author Nextpass <mail@nextpass.io>
 * @website https://nextpass.io
 *
 */
class LogController extends \Controller
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
        $Route = $this->getVariable("Route");
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

        // Get Proxy
        require_once PLUGINS_PATH."/".self::IDNAME."/models/ProxyModel.php";
        $Proxy = new ProxyModel();

        if (isset($Route->params->id)) {

            $Proxy->select($Route->params->id);

            if (!$Proxy->isAvailable()) {
                header("Location: ".APPURL."/e/".self::IDNAME);
                exit;
            }
        }

        // Get Activity Log
        $ActivityLog = \Controller::model([PLUGINS_PATH."/".self::IDNAME."/models/LogsModel.php",
            __NAMESPACE__."\LogsModel"]);
        $ActivityLog->setPageSize(20)
            ->setPage(\Input::get("page"))
            ->where("proxy_id", "=", $Proxy->get("id"))
            ->orderBy("id","DESC")
            ->fetchData();

        $Logs = [];
        $as = [PLUGINS_PATH."/".self::IDNAME."/models/LogModel.php",
            __NAMESPACE__."\LogModel"];
        foreach ($ActivityLog->getDataAs($as) as $l) {
            $Logs[] = $l;
        }

        $this->setVariable("ActivityLog", $ActivityLog)
            ->setVariable("Logs", $Logs)
            ->setVariable("Proxy", $Proxy)
            ->setVariable("idname", self::IDNAME)
            ->setVariable("controllerName", get_class($this));

        if (\Input::post("action") == "save") {
            $this->save();
        }

        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/log.php", null);
    }
}