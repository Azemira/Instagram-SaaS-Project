<?php
namespace Plugins\InstagramChatbot;
/**
 * Chatbot
 */
class duplicateSettingsController extends \Controller
{
    const IDNAME = "instagram-chatbot";
    /**
     * Process
     */
    public function process()
    {   
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");
        $Accounts = \Controller::model("Accounts");
        $Accounts->setPageSize(20)
                 ->setPage(\Input::get("page"))
                 ->where("user_id", "=", $AuthUser->get("id"))
                 ->orderBy("id","ASC")
                 ->fetchData();


        // Messages
        $ChatbotMessages = 'no messages';
        if (isset($Route->params->id)) {
            require_once PLUGINS_PATH."/".self::IDNAME."/models/ChatbotMessagesModel.php";
            $ChatbotMessages = new ChatbotMessagesModel;

            $ChatbotMessages->setPageSize(20)
                     ->setPage(\Input::get("page"))
                     ->where("account_id", "=", $Route->params->id)
                     ->where("is_deleted", "=", false)
                     ->orderBy("message_order","ASC")
                     ->fetchData();
                  
            $this->setVariable("ChatbotMessages", $ChatbotMessages);

            $Account = \Controller::model("Account", $Route->params->id);
            $this->setVariable("Account", $Account);

            require_once PLUGINS_PATH."/".self::IDNAME."/controllers/SettingsController.php";
            $SettingsController = new SettingsController;
            $ErrorLog = $SettingsController->getUserErrorLogs($Account);
            $this->setVariable("ErrorLog", $ErrorLog);
        } 


        $this->setVariable("Accounts", $Accounts);
        $this->setVariable("Route", $Route);

        if (\Input::post("action") == "save") {
            $this->save();
        }
        
        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/chatbot.php", null);
        
    }

        /**
     * Save (new|edit) caption
     * @return void 
     */
    private function save()
    {
   
        require_once PLUGINS_PATH."/".self::IDNAME."/models/ChatbotMessageModel.php";
     
        $AuthUser = $this->getVariable("AuthUser");

        $user_ids = \Input::post("duplicate");
        
        foreach ($user_ids as $key => $account_id) {
            $this->deleteMessages($account_id);
            $CleanMessages = $this->getVariable("CleanMessages");
            $CleanMessages->delete();
            
        }

        $ChatbotMessages = $this->getVariable("ChatbotMessages");
        $messages = $ChatbotMessages->getDataAs("Caption");
        foreach ($user_ids as $key => $account_id) {
            
            foreach($messages as $message_key => $value) {

            $MessageDuplicate = new ChatbotMessageModel;
            
            $MessageDuplicate->set("user_id", $AuthUser->get("id"))
            ->set("account_id", $account_id)
            ->set("title",$value->get("title"))
            ->set("message_order",$value->get("message_order"))
            ->set("message",$value->get("message"))
            ->save();

            }
        }

        $this->resp->msg = __("Changes saved!");
        $this->resp->result = 1;
        $this->jsonecho();
    }
   
    public function deleteMessages($account_id) {

        $CleanMessages = new ChatbotMessagesModel;
        $CleanMessages->setPageSize(20)
                 ->setPage(\Input::get("page"))
                 ->where("account_id", "=", $account_id)
                 ->orderBy("message_order","ASC")
                 ->fetchData();
                 
        $this->setVariable("CleanMessages", $CleanMessages);
    }
}
