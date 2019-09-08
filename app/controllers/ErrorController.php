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
        $Route = $this->getVariable("Route");


        $Account = \Controller::model("Account", $Route->params->id);
        if (
            !$Account->isAvailable() ||
            $Account->get("user_id") != $AuthUser->get("id")
        ) {
            header("Location: " . APPURL . "/e/" . self::IDNAME);
            exit;
        }
        $this->setVariable("Account", $Account);


        require_once APPPATH . "/models/UserChecksModel.php";
        $UserChecksModel = new UserChecksModel([
            "account_id" => $Account->get("id"),
            "user_id" => $Account->get("user_id")
        ]);

        $this->setVariable("UserChecksModel", $UserChecksModel);



        // Auth
        if (!$AuthUser) {
            header("Location: " . APPURL . "/login");
            exit;
        } else if (
            !$AuthUser->isAdmin() &&
            !$AuthUser->isEmailVerified() &&
            $EmailSettings->get("data.email_verification")
        ) {
            header("Location: " . APPURL . "/profile?a=true");
            exit;
        } else if ($AuthUser->isExpired()) {
            header("Location: " . APPURL . "/expired");
            exit;
        }

        // Get account
        $Accounts = Controller::model("Accounts");
        $Accounts->setPageSize(8)
            ->setPage(Input::get("page"))
            ->where("user_id", "=", $AuthUser->get("id"))
            ->orderBy("id", "DESC")
            ->fetchData();

        $this->setVariable("Accounts", $Accounts);


        $Route = $this->getVariable("Route");
        $id = $Route->params->id;

        $this->setVariable("Route", $id);

        $are_plugins_activated  =  $this->checkForErrors($Route->params->id, $AuthUser->get("id"));
        $checkForErrorsChatBot  = $this->checkForErrorsChatBot($Route->params->id, $AuthUser->get("id"));

        $this->setVariable("Errors", $are_plugins_activated);
        $this->setVariable("ErrorsChatbot", $checkForErrorsChatBot);

        if (\Input::post("errors_seen") == "errors_seen") {
            $this->save();
        }

        $this->view("errors-overview");
    }


    public function save()
    {

        $Route = $this->getVariable("Route");
        $Account = \Controller::model("Account", $Route);

        $UserChecksModel = $this->getVariable("UserChecksModel");

        $AuthUser = $this->getVariable("AuthUser");

        $error_count = $this->countErrors($Account->get("id"), $Account->get("user_id"));

        $UserChecksModel->set("user_id", $AuthUser->get("id"))
            ->set("account_id", $Account->get("id"))
            ->set("errors_seen", "1")
            ->set('error_count', $error_count)
            ->set("value", 'error_checking')
            ->set('date', date("Y-m-d H:i:s"))
            ->save();
    }

    public function countErrors($account_id, $user_id)
    {


        $np_auto_comment_log = \DB::table('np_auto_comment_log')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->where("status", "=", 'error')
            ->orderBy("date", "DESC")
            ->select("*")
            ->get();

        $np_auto_follow_log = \DB::table('np_auto_follow_log')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->where("status", "=", 'error')
            ->orderBy("date", "DESC")
            ->select("*")
            ->get();

        $np_auto_like_log = \DB::table('np_auto_like_log')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->where("status", "=", 'error')
            ->orderBy("date", "DESC")
            ->select("*")
            ->get();


        $np_chatbot_error_log = \DB::table('np_chatbot_error_log')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->orderBy("date", "DESC")
            ->select("*")
            ->get();

        $total_errors = count($np_auto_comment_log) + count($np_auto_follow_log) + count($np_auto_like_log) + count($np_chatbot_error_log);


        return $total_errors;
    }


    public function checkForErrors($account_id, $user_id)
    {

        $are_plugins_activated = [];

        $np_auto_comment_log = \DB::table('np_auto_comment_log')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->where("status", "=", 'error')
            ->orderBy("date", "DESC")
            ->select("*")
            ->get();

        $np_auto_follow_log = \DB::table('np_auto_follow_log')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->where("status", "=", 'error')
            ->orderBy("date", "DESC")
            ->select("*")
            ->get();

        $np_auto_like_log = \DB::table('np_auto_like_log')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->where("status", "=", 'error')
            ->orderBy("date", "DESC")
            ->select("*")
            ->get();




        if (!empty($np_auto_comment_log)) {

            $are_plugins_activated['Auto Comment'] = $np_auto_comment_log;
        } else {
            $are_plugins_activated['Auto Comment'] = null;
        }
        if (!empty($np_auto_follow_log)) {

            $are_plugins_activated['Auto Follow'] = $np_auto_follow_log;
        } else {
            $are_plugins_activated['Auto Follow'] = null;
        }
        if (!empty($np_auto_like_log)) {

            $are_plugins_activated['Auto Like'] = $np_auto_like_log;
        } else {
            $are_plugins_activated['Auto Like'] = null;
        }

        return $are_plugins_activated;
    }
    public function checkForErrorsChatBot($account_id, $user_id)
    {

        $are_plugins_activated = [];


        $np_chatbot_error_log = \DB::table('np_chatbot_error_log')
            ->where("account_id", "=", $account_id)
            ->where("user_id", "=", $user_id)
            ->orderBy("date", "DESC")
            ->select("*")
            ->get();

        if (!empty($np_chatbot_error_log)) {

            $are_plugins_activated['Chat Bot'] = $np_chatbot_error_log;
        } else {
            $are_plugins_activated['Chat Bot'] = null;
        }

        return $are_plugins_activated;
    }
}
