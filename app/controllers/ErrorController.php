<?php
/**
 * Accounts Controller
 */
class ErrorController extends Controller
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

        // Get account
        $Accounts = Controller::model("Accounts");
            $Accounts->setPageSize(8)
                     ->setPage(Input::get("page"))
                     ->where("user_id", "=", $AuthUser->get("id"))
                     ->orderBy("id","DESC")
                     ->fetchData();

        $this->setVariable("Accounts", $Accounts);
  

        $Route = $this->getVariable("Route");
        $id = $Route->params->id;

        $this->setVariable("Route", $id);




        $are_plugins_activated  =  $this->checkForErrors($Route->params->id, $AuthUser->get("id"));
        $checkForErrorsChatBot  = $this->checkForErrorsChatBot($Route->params->id, $AuthUser->get("id"));

        $this->setVariable("Errors", $are_plugins_activated);
        $this->setVariable("ErrorsChatbot", $checkForErrorsChatBot);


        $this->view("errors-overview");
    }


public function checkForErrors($account_id, $user_id)
    {

        $are_plugins_activated = [];

             $np_auto_comment_log = \DB::table('np_auto_comment_log')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->where("status", "=", 'error')
            ->orderBy("date","DESC")
            ->select("*")
            ->get();

            $np_auto_follow_log = \DB::table('np_auto_follow_log')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->where("status", "=", 'error')
            ->orderBy("date","DESC")
            ->select("*")
            ->get();

            $np_auto_like_log = \DB::table('np_auto_like_log')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->where("status", "=", 'error')
            ->orderBy("date","DESC")
            ->select("*")
            ->get();

       


            if (!empty($np_auto_comment_log)) {

                $are_plugins_activated['Auto Comment'] = $np_auto_comment_log;
            }else{
                $are_plugins_activated['Auto Comment'] = null;

            }
            if (!empty($np_auto_follow_log)) {

                $are_plugins_activated['Auto Follow'] = $np_auto_follow_log;
            }else{
                $are_plugins_activated['Auto Follow'] = null;

            }
            if (!empty($np_auto_like_log)) {

                $are_plugins_activated['Auto Like'] = $np_auto_like_log;
            }else{
                $are_plugins_activated['Auto Like'] = null;

            }

       
         
        return $are_plugins_activated;
    }
    public function checkForErrorsChatBot($account_id, $user_id) {

    $are_plugins_activated = [];


    $np_chatbot_error_log = \DB::table('np_chatbot_error_log')
    ->where("account_id", "=", $account_id)
    ->where("user_id", "=", $user_id)
    ->orderBy("date","DESC")
    ->select("*")
    ->get();

    if (!empty($np_chatbot_error_log)) {

        $are_plugins_activated['Chat Bot'] = $np_chatbot_error_log;
    }else{
        $are_plugins_activated['Chat Bot'] = null;

    }


    return $are_plugins_activated;

    }

}