<?php
/**
 * AutoDimesChatBotController Controller
 */
class AutoDimesChatBotController extends Controller
{
    /**
     * Process
     */
    public function process()
    {   
        $AuthUser = $this->getVariable("AuthUser");
        // $Route = $this->getVariable("Route");
        // $EmailSettings = \Controller::model("GeneralData", "email-settings");
  // Get accounts
        $Accounts = \Controller::model("Accounts");
        $Accounts->setPageSize(20)
                 ->setPage(\Input::get("page"))
                 ->where("user_id", "=", $AuthUser->get("id"))
                 ->orderBy("id","DESC")
                 ->fetchData();

        $this->setVariable("Accounts", $Accounts);

        $this->view("chatbot");
    }

    public function createDbTable(){

    }
}
