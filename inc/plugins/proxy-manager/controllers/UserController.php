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
class UserController extends \Controller
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

        // Get User
        $User = \Controller::model("User", $Route->params->id);

        if (!$User->isAvailable()) {
            header("Location: ".APPURL."/e/".self::IDNAME);
            exit;
        }

        $Accounts = \Controller::model("Accounts");
        $Accounts->getQuery()->where("user_id", "=", $User->get("id"));
        $Accounts->setPageSize(20)
                ->setPage(\Input::get("page"))
                ->orderBy("id","DESC")
                ->fetchData();

        $Proxies = \Controller::model("Proxies");
        $Proxies->orderBy("id", "DESC")
                ->fetchData();


        $this->setVariable("User", $User)
             ->setVariable("Accounts", $Accounts)
             ->setVariable("Proxies", $Proxies)
             ->setVariable("idname", self::IDNAME);

        if (\Input::post("action") == "save") {
            $this->save();
        }

        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/user.php", null);
    }


    /**
     * Save (new|edit) proxy
     * @return void
     */
    private function save()
    {
        $this->resp->result = 0;

        // Check required fields
        $required_fields = ["proxy"];

        foreach ($required_fields as $field) {
            if (!\Input::post($field)) {
                $this->resp->msg = __("Missing some of required data.");
                $this->jsonecho();
            }
        }

        // CHECK ACCOUNT ID
        if(empty(\Input::post("account_id"))) {
            $this->resp->msg = __("Account is not valid");
            $this->jsonecho();
        }

        // Proxy
        require_once PLUGINS_PATH."/".self::IDNAME."/models/ProxyModel.php";
        $Proxy = new ProxyModel(\Input::post("proxy"));

        // Check proxy is exist or not
        if(!$Proxy->isAvailable()) {
            $this->resp->msg = __("Proxy is not exist");
            $this->jsonecho();
        }

        // Check proxy limit
        if($Proxy->get("assign_count") >= $Proxy->get("limit_usage")) {
            $this->resp->msg = __("Proxy is out of usage!");
            $this->jsonecho();
        }

        require_once PLUGINS_PATH."/".self::IDNAME."/models/AccountModel.php";
        $Account = new AccountModel(\Input::post("account_id"));

        // Check account is exist or not
        if(!$Account->isAvailable()) {
            $this->resp->msg = __("Account is not exist");
            $this->jsonecho();
        }

        if($Account->get("proxy") === $Proxy->get("proxy")) {
            $this->resp->msg = __("This account is using this proxy");
            $this->jsonecho();
        }

        // Start setting data
        $Account->set("proxy", \Input::post("proxy"))
                ->save();

        // Log
        $Log = new LogModel;
        $Log->set("user_id", $Account->get("user_id"))
            ->set("account_id", $Account->get("id"))
            ->set("proxy_id", $Proxy->get("id"))
            ->set("data.type", "allocate")
            ->set("data.msg", "has allocated this proxy")
            ->set("status", "success")
            ->save();

        // Refresh count of all proxies
        \Event::trigger("refresh.count.of.proxies");

        $this->resp->result = 1;
        $this->resp->msg = __("Changes saved!");
        $this->jsonecho();
    }
}