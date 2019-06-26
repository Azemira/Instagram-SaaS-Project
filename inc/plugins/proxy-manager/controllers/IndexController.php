<?php
namespace Plugins\ProxyManager;

// Disable direct access
if (!defined('APP_VERSION')) {
    die("Yo, what's up?");
}

/**
 * Index Controller
 *
 * @author Nextpass <mail@nextpass.io>
 * @website https://nextpass.io
 *
 */
class IndexController extends \Controller
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
        require_once PLUGINS_PATH."/".self::IDNAME."/models/ProxiesModel.php";

        $Proxies = new ProxiesModel();
        $Proxies->search(\Input::get("q"))
                ->setPageSize(20)
                ->setPage(\Input::get("page"))
                ->orderBy("id","DESC")
                ->fetchData();

        // Get countries
        require_once(APPPATH.'/inc/countries.inc.php');

        $this->setVariable("Proxies", $Proxies)
            ->setVariable("Countries", $Countries)
            ->setVariable("idname", self::IDNAME)
            ->setVariable("controllerName", get_class($this))
            ->setVariable("AuthUser", $AuthUser);

        if (\Input::post("action") == "remove") {
            $this->remove();
        }

        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/index.php", null);
    }

    /**
     * Remove Proxy
     * @return void
     */
    private function remove()
    {
        $this->resp->result = 0;

        if (!\Input::post("id")) {
            $this->resp->msg = __("ID is requred!");
            $this->jsonecho();
        }

        $Proxy = \Controller::model("Proxy", \Input::post("id"));

        if (!$Proxy->isAvailable()) {
            $this->resp->msg = __("Proxy doesn't exist!");
            $this->jsonecho();
        }


        $Proxy->delete();

        $this->resp->result = 1;
        $this->jsonecho();
    }
}
