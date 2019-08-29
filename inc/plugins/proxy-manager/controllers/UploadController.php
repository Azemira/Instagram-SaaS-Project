<?php
namespace Plugins\ProxyManager;
use League\Csv\Reader;

require_once PLUGINS_PATH."/proxy-manager/vendor/autoload.php";
require_once PLUGINS_PATH."/proxy-manager/models/ProxyModel.php";

// Disable direct access
if (!defined('APP_VERSION')) {
    die("Yo, what's up?");
}

/**
 * Upload Controller
 *
 * @author Nextpass <mail@nextpass.io>
 * @website https://nextpass.io
 *
 */
class UploadController extends \Controller
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
        $Route = $this->getVariable("Route");

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


        if (isset($Route->params->hash)) {
            if (file_exists(TEMP_PATH . "/proxy-". $Route->params->hash . ".csv")) {
                $this->import();
            } else {
                header("Location: ".APPURL."/e/".self::IDNAME);
                exit;
            }
        }

        if (\Input::post("action") == "upload") {
            $this->upload();
        }

        $this->setVariable("idname", self::IDNAME);

        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/upload.php", null);
    }

    /**
     * Upload csv
     * @return void
     */
    private function upload()
    {
        $this->resp->result = 0;

        // Check file
        if (empty($_FILES["file"]) || $_FILES["file"]["size"] <= 0) {
            $this->resp->msg = __("File not received!");
            $this->jsonecho();
        }

        // Check file extension
        $ext = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
        if ($ext != "csv") {
            $this->resp->msg = __("Only csv files are allowed");
            $this->jsonecho();
        }

        // Upload file
        $tempname = uniqid();
        $temp_dir = TEMP_PATH;
        if (!file_exists($temp_dir)) {
            mkdir($temp_dir);
        }
        $filepath = $temp_dir . "/proxy-" . $tempname . ".csv";
        if (!move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) {
            $this->resp->msg = __("Oops! An error occured. Please try again later!");
            $this->jsonecho();
        }

        $this->resp->result = 1;
        $this->resp->redirect = APPURL . "/e/".self::IDNAME."/upload/".$tempname;
        $this->jsonecho();
    }

    private function import()
    {
        $Route = $this->getVariable("Route");
        $tempname = $Route->params->hash;
        $filepath = TEMP_PATH . "/proxy-" . $tempname . ".csv";

        $UploadResult = new \stdClass;
        $UploadResult->resp = 0;

        $csv = Reader::createFromPath($filepath);
        $csv->setHeaderOffset(0);
        $csvHeader = $csv->getHeader();

        $records = $csv;
        foreach ($records as $record) {
            $Proxy = new ProxyModel();

            // Proxy
            $proxy = null;
            if(isset($csvHeader[0])) {
                $header = $csvHeader[0];
                $proxy = $record[$header];
            }

            // Country Code
            $countryCode = null;
            if(isset($csvHeader[1])) {
                $header = $csvHeader[1];
                $countryCode = $record[$header];
            }

            // Limit Usage
            $limitUsage = 0;
            if(isset($csvHeader[2])) {
                $header = $csvHeader[2];
                $limitUsage = $record[$header];
            }

            // Package Id
            $packageId = 0;
            if(isset($csvHeader[3])) {
                $header = $csvHeader[3];
                $packageId = $record[$header];
            }

            $Proxy->set("proxy", $proxy)
                  ->set("country_code", $countryCode)
                  ->set("limit_usage", $limitUsage)
                  ->set("package_id", $packageId)
                  ->save();
        }


        // Installed, remove zip archive
        delete($filepath);

        $UploadResult->resp = 1;
        $this->setVariable("UploadResult", $UploadResult);

        return false;
    }
}