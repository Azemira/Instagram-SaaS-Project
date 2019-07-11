<?php
namespace Plugins\InstagramChatbot;
/**
 * Chatbot
 */
class ChatbotController extends \Controller
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
                 ->orderBy("id","DESC")
                 ->fetchData();


        // Messages
        $ChatbotMessages = 'no messages';
        if (isset($Route->params->id)) {
            // $ChatbotMessages = \Controller::model(PLUGINS_PATH."/".self::IDNAME."/models/ChatbotMessagesModel.php");
            require_once PLUGINS_PATH."/".self::IDNAME."/models/ChatbotMessagesModel.php";
            $ChatbotMessages = new ChatbotMessagesModel;
            $ChatbotMessages->setPageSize(20)
                     ->setPage(\Input::get("page"))
                     ->where("account_id", "=", $Route->params->id)
                     ->orderBy("id","DESC")
                     ->fetchData();

            $this->setVariable("ChatbotMessages", $ChatbotMessages);

            $Account = \Controller::model("Account", $Route->params->id);
            $this->setVariable("Account", $Account);
        } 
        
        $this->setVariable("Accounts", $Accounts);
        $this->setVariable("Route", $Route);

        if (\Input::post("action") == "save") {
            $this->save();
        }
        if (\Input::post("action") == "update") {
            $this->update();
        }
        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/chatbot.php", null);
    }

        /**
     * Save (new|edit) caption
     * @return void 
     */
    private function save()
    {
        $this->resp->result = 0;
        $AuthUser = $this->getVariable("AuthUser");
        // $Message = \Controller::model("ChatbotMessage");
        require_once PLUGINS_PATH."/".self::IDNAME."/models/ChatbotMessageModel.php";
        $Message = new ChatbotMessageModel;
        $title = \Input::post("title");
        // $message_order = Input::post("msg-group");
        $message = \Input::post("message");
        $title = 'test';

        if (!$title) {
            $this->resp->msg = __("Missing some of required data.");
            $this->jsonecho();
        }

        $Message->set("user_id", $AuthUser->get("id"))
                ->set("title", $title)
                ->set("account_id", 1)
                ->set("message_order", 1)
                ->set("message", $message)
                ->save();

                $this->resp->result = 1;
            $this->resp->redirect = APPURL."/chatbot";
            $this->resp->id = $Message->get("id");
            $this->resp->message = json_decode('"'.$Message->get("message").'"');
        
        $this->jsonecho();
    }
    private function update()
    {
        $this->resp->result = 0;
        $AuthUser = $this->getVariable("AuthUser");
       
        $title = \Input::post("title");
        $message = \Input::post("message");
        $messageId = \Input::post("id");
        $title = 'test';

        if (!$title) {
            $this->resp->msg = __("Missing some of required data.");
            $this->jsonecho();
        }

        require_once PLUGINS_PATH."/".self::IDNAME."/models/ChatbotMessageModel.php";
        $Message = new ChatbotMessageModel;
        if (isset($messageId)) {
            $Message->select($messageId);

            
        }

        $Message->set("message_order", 1)
                ->set("message", $message)
                ->save();

                $this->resp->result = 1;
            $this->resp->redirect = APPURL."/chatbot";
            $this->resp->id = $Message->get("id");
            $this->resp->message = json_decode('"'.$Message->get("message").'"');
        
        $this->jsonecho();
    }
}
