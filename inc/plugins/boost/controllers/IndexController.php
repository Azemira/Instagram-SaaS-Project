<?php
namespace Plugins\Boost;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Index Controller
 */
class IndexController extends \Controller
{
    /**
     * idname of the plugin for internal use
     */
    const IDNAME = 'boost';


    /**
     * Process
     */
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $this->setVariable("idname", self::IDNAME);

        // Auth
        if (!$AuthUser){
            header("Location: ".APPURL."/login");
            exit;
        } else if ($AuthUser->isExpired()) {
            header("Location: ".APPURL."/expired");
            exit;
        }

        $user_modules = $AuthUser->get("settings.modules");
        if (!is_array($user_modules) || !in_array(self::IDNAME, $user_modules)) {
            // Module is not accessible to this user
            header("Location: ".APPURL."/post");
            exit;
        }


        // Get accounts
        $Accounts = \Controller::model("Accounts");
        $Accounts->setPageSize(20)
                 ->setPage(\Input::get("page"))
                 ->where("user_id", "=", $AuthUser->get("id"))
                 ->orderBy("id","DESC")
                 ->fetchData();

        $this->setVariable("Accounts", $Accounts);
      
        $accpics    = (array) $AuthUser->get("data.accpics");
        $lastCheck  = (int) $AuthUser->get("data.check_accpics");
        $changed    = false;
        if( !$lastCheck || (time() > ($lastCheck + 86400)) ) {
          $changed = true;
        }

        
        
        foreach($Accounts->getDataAs("Account") as $acc){
		
            if(!isset($accpics[$acc->get("username")]) || $changed) {
                $accpics[$acc->get("username")] = $this->getAccountPicture($acc->get("username"));
                $changed = true;
            }

        }

        if($changed){
            $AuthUser->set("data.accpics", $accpics)
              ->set("data.check_accpics", time() + 86400)->save();
        }
      
        $Settings = namespace\settings();
        $this->setVariable("Settings", $Settings);
      
      
        if($Accounts->getTotalCount() == 1 && !\Input::get("ref")) {
          $account_id = $Accounts->getData()[0]->id;
          $wizard = $Settings->get("data.wizard") ? "/wizard" : "";
          header("Location: ".APPURL."/e/".self::IDNAME."/".$account_id . $wizard);
          exit;
        }
      

        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/index.php", null);
    }
  
    private function getAccountPicture($accountname)
    {

        $instagramname = $accountname;

        $curl = curl_init();

        $s = array(
            CURLOPT_URL => "https://www.instagram.com/" . $instagramname,
            CURLOPT_REFERER => "https://google.com",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36",
            CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,
        );

        curl_setopt_array($curl, $s);
        $response = curl_exec($curl);
        curl_close($curl);

        $regex = '@<meta property="og:image" content="(.*?)"@si';
        preg_match_all($regex, $response, $return);

        if(isset($return[1][0])){

            $ret = $return[1][0];
        
        }else{
            $ret = null;
        }
        
        return $ret;

    }
  
}
