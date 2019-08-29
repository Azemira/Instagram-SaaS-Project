<?php
namespace Plugins\ProxyManager;

// Lookup IP
require_once PLUGINS_PATH."/proxy-manager/libs/ProxyInfo.php";

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
class ProxyController extends \Controller
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

        // Get packages
        $Packages = \Controller::model("Packages");
        $Packages->fetchData();


        // Get countries
        require_once(APPPATH.'/inc/countries.inc.php');


        $this->setVariable("Proxy", $Proxy)
            ->setVariable("Packages", $Packages)
            ->setVariable("Countries", $Countries)
            ->setVariable("idname", self::IDNAME)
            ->setVariable("controllerName", get_class($this));

        if (\Input::post("action") == "save") {
            $this->save();
        }

        if (\Input::post("action") == "lookup") {
            $this->lookup();
        }

        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/proxy.php", null);
    }

    /**
     * Lookup Proxy
     * @return void
     */
    private function lookup() {
        $this->resp->result = 0;

        $proxy = \Input::post("proxy");

        try {
            $proxyInfo = getProxyInfo($proxy);
            $proxyInfo = json_decode($proxyInfo);
        } catch (\Exception $e) {
            $this->resp->msg = __("Proxy is not valid!");
            $this->jsonecho();
        }

        if(empty($proxy)) {
            $this->resp->msg = __("Proxy is requried!");
            $this->jsonecho();
        }

        $this->resp->result = 1;
        $this->resp->msg = __("Find out!");
        $this->resp->info = $proxyInfo;
        $this->jsonecho();
    }


    /**
     * Save (new|edit) proxy
     * @return void
     */
    private function save()
    {
        $this->resp->result = 0;
        $Proxy = $this->getVariable("Proxy");
        $Countries = $this->getVariable("Countries");

        // Check if this is new or not
        $is_new = !$Proxy->isAvailable();

        // Check required fields
        $required_fields = ["proxy"];

        foreach ($required_fields as $field) {
            if (!\Input::post($field)) {
                $this->resp->msg = __("Missing some of required data.");
                $this->jsonecho();
            }
        }


        // Check country
        $country = "";
        if (\Input::post("country") && isset($Countries[\Input::post("country")])) {
            $country = \Input::post("country");
        }


        // CHECK PROXY
        if (!isValidProxy(\Input::post("proxy"))) {
            $this->resp->msg = __("Proxy is not valid or active!");
            $this->jsonecho();
        }

        if($is_new) {
            // Get Proxy Mode
            require_once PLUGINS_PATH."/".self::IDNAME."/models/ProxyModel.php";
            $ProxyModel = new ProxyModel(\Input::post("proxy"));

            // Check proxy is exist or not
            if($ProxyModel->isAvailable()) {
                $this->resp->msg = __("Proxy is exist");
                $this->jsonecho();
            }
        }

        // PROXY
        $proxy = \Input::post("proxy");

        // CHECK LIMIT USAGE
        $limit_usage = 0;
        if((int)\Input::post("limit_usage") > 0) {
            $limit_usage = (int)\Input::post("limit_usage");
        }

        // PACKAGE
        $Package = \Controller::model("Package", \Input::post("package_id"));
        if ($Package->isAvailable()) {
            $package_id = $Package->get("id");
        } else if (\Input::post("package_id") == 0) {
            $package_id = 0;
        } else if (\Input::post("package_id") == -1) {
            $package_id = -1;
        } else {
            $package_id = -2;
        }

        // Replace Proxy
        $replace_proxy = "";
        if(!empty(\Input::post("replace_proxy"))) {
            $replace_proxy = \Input::post("replace_proxy");
        }


        // REPLACE ALL THIS PROXY TO REPLACE PROXY
        if(!empty($replace_proxy)) {

            // CHECK REPLACE PROXY
            if (!isValidProxy($replace_proxy)) {
                $this->resp->msg = __("Replace proxy is not valid!");
                $this->jsonecho();
            }

            $Accounts = \Controller::model("Accounts");
            $Accounts->getQuery()
                    ->where("proxy", "=", $proxy)
                    ->update(["proxy" => $replace_proxy]);
        }

        // RESET VARIABLES
        if(!empty($replace_proxy)) {
            $proxy = $replace_proxy;
            $replace_proxy = "";
        }

        // Start setting data
        $Proxy->set("proxy", $proxy)
            ->set("country_code", $country)
            ->set("limit_usage", $limit_usage)
            ->set("package_id", $package_id)
            ->set("replace_proxy", $replace_proxy)
            ->save();

        // Refresh count of proxy
        \Event::trigger("refresh.count.of.proxy", $proxy);

        $this->resp->result = 1;
        if ($is_new) {
            $this->resp->msg = __("Proxy added successfully! Please refresh the page.");
            $this->resp->reset = true;
        } else {
            $this->resp->msg = __("Changes saved!");
        }
        $this->jsonecho();
    }
}