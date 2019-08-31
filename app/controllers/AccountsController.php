<?php
/**
 * Accounts Controller
 */
class AccountsController extends Controller
{
    /**
     * Process
     */
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $EmailSettings = \Controller::model("GeneralData", "email-settings");

        // Auth
        if (!$AuthUser){
            header("Location: ".APPURL."/login");
            exit;
        } else if (
            !$AuthUser->isAdmin() && 
            !$AuthUser->isEmailVerified() &&
            $EmailSettings->get("data.email_verification")) 
        {
            header("Location: ".APPURL."/profile?a=true");
            exit;
        } else if ($AuthUser->isExpired()) {
            header("Location: ".APPURL."/expired");
            exit;
        }

        // Get accounts
        $Accounts = Controller::model("Accounts");
            $Accounts->setPageSize(8)
                     ->setPage(Input::get("page"))
                     ->where("user_id", "=", $AuthUser->get("id"))
                     ->orderBy("id","DESC")
                     ->fetchData();

        $this->setVariable("Accounts", $Accounts);
  
        if (Input::post("action") == "remove") {
            $this->remove();
         } else if (Input::post("action") == "reconnect") {
            $this->reconnect(); 
         }

        $this->view("accounts");
    }



    /**
     * Remove Account
     * @return void
     */
    private function remove()
    {   
        $this->resp->result = 0;
        $AuthUser = $this->getVariable("AuthUser");

        if (!Input::post("id")) {
            $this->resp->msg = __("ID is requred!");
            $this->jsonecho();
        }

        $Account = Controller::model("Account", Input::post("id"));

        if (!$Account->isAvailable() ||
            $Account->get("user_id") != $AuthUser->get("id")) 
        {
            $this->resp->msg = __("Invalid ID");
            $this->jsonecho();
        }

        // Delete instagram session data
        delete(APPPATH . "/sessions/" 
                       . $AuthUser->get("id") 
                       . "/" 
                       . $Account->get("username"));

        $Account->delete();
        
        $this->resp->result = 1;
        $this->jsonecho();
    }

    /**
* Reconnect Instagram Account
* @return void
*/
public function reconnect()
{
   $this->resp->result = 0;
   $AuthUser = $this->getVariable("AuthUser"); 
   if (!Input::post("id")) {
      $this->resp->title = __("01 Error");
      $this->resp->msg = __("ID is requred!");
      $this->jsonecho();
   }
   $Account = Controller::model("Account", Input::post("id"));
   // Check Account ID and Account Status
   if (!$Account->isAvailable() ||
      $Account->get("user_id") != $AuthUser->get("id")) 
   {
      $this->resp->title = __("02 Error");
      $this->resp->msg = __("Invalid ID");
      $this->jsonecho();
   }
   // Set login_required to 0 before logining to Instagram
   // login() function will not work if login_required = 1
   $Account->set("login_required", 0)
           ->save();
   // Default redirect
   $this->resp->redirect = APPURL."/accounts";
   
   // Try login to Instagram
   try {
      $login_resp = \InstagramController::login($Account);
   } catch (\Exception $e) {
      $separated = $e->getMessage();
      $text = explode(" | ", $separated, 2);
      $this->resp->title = $text[0];
      $this->resp->msg= $text[1];
      if ($text[0] == __("Challenge Required") ||
         $text[0] == __("You changed account password?") ||
         $text[0] == __("You changed account username?")) {
         // Redirect user to account settings
         $account_id = Input::post("id"); 
         $this->resp->redirect = APPURL."/accounts/".$account_id; 
      }
      $this->jsonecho();
   }
   $this->resp->result = 1;  
   $this->jsonecho();
}

    public function checkForActivePluggins($account_id, $user_id)
    {

        $are_plugins_activated = [];

        $query_auto_like = \DB::table('np_auto_like_schedule')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->select("*")
            ->get();

        $query_auto_comment = \DB::table('np_auto_comment_schedule')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->select("*")
            ->get();

        $query_auto_follow = \DB::table('np_auto_follow_schedule')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->select("*")
            ->get();

        $query_chatboot = \DB::table('np_chatbot_settings')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->select("*")
            ->get();

        if (!empty($query_auto_like)) {
            $are_plugins_activated['Auto Like'] = array(
                "active" => $query_auto_like[0]->is_active,
                "url" => 'e/auto-like'
            );
        } else {
            $are_plugins_activated['Auto Like'] = array(
                "active" => "0",
                "url" => 'e/auto-like'
            );
        }

        if (!empty($query_auto_comment)) {

            $are_plugins_activated['Auto Comment'] = array(
                "active" =>  $query_auto_comment[0]->is_active,
                "url" => 'e/auto-comment'
            );
        } else {
            $are_plugins_activated['Auto Comment'] = array(
                "active" => "0",
                "url" => 'e/auto-comment'
            );
        }

        if (!empty($query_auto_follow)) {
            $are_plugins_activated['Auto Follow'] = array(
                "active" => $query_auto_follow[0]->is_active,
                "url" => 'e/auto-follow'
            );
        } else {
            $are_plugins_activated['Auto Follow'] = array(
                "active" => "0",
                "url" => 'e/auto-follow'
            );
        }

        if (!empty($query_chatboot)) {

            $are_plugins_activated['Chatboot'] = array(

                "active" =>   $query_chatboot[0]->chatbot_status,
                "url" => 'chatbot/account'
            );
        } else {
            $are_plugins_activated['Chatboot'] = array(

                "active" =>  "0",
                "url" => 'chatbot/account'
            );
        }

        return $are_plugins_activated;
    }
}