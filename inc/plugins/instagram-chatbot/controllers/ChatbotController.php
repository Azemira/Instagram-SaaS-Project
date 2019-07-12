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
                     ->where("is_deleted", "=", false)
                     ->orderBy("id","ASC")
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
        if (\Input::post("action") == "delete") {
            $this->update(true);
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
        $Route = $this->getVariable("Route");
        $AuthUser = $this->getVariable("AuthUser");
        $url = $this->full_path();
        $parts = explode("/", $url);
        $accountID = end($parts);
        require_once PLUGINS_PATH."/".self::IDNAME."/models/ChatbotMessageModel.php";
        $Message = new ChatbotMessageModel;
        $messagesCount = $this->getCountOfUserMessages($accountID);
        $title = "Message-".strval($messagesCount);
        $message = \Input::post("message");

        if (!$title) {
            $this->resp->msg = __("Missing some of required data.");
            $this->jsonecho();
        }

        $Message->set("user_id", $AuthUser->get("id"))
                ->set("title", $title)
                ->set("account_id", $accountID)
                ->set("message_order", $messagesCount)
                ->set("message", $message)
                ->save();

        $this->resp->result = 1;
        $this->resp->redirect = APPURL."/chatbot";
        $this->resp->id = $Message->get("id");
        $this->resp->title = $Message->get("title");
        $this->resp->message = json_decode('"'.$Message->get("message").'"');
        
        $this->jsonecho();
    }
    private function update($delete = false)
    {
        $this->resp->result = 0;
        $AuthUser = $this->getVariable("AuthUser");
       
       
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
        if ($delete) {
            $Message->set("is_deleted", 1)
            ->save();
            $this->resp->result = 1;
            $this->resp->redirect = APPURL."/chatbot";
            $this->resp->deleted = $Message->get("is_deleted");
            $this->resp->id = $Message->get("id");
        } else {
            $Message->set("message_order", 1)
            ->set("message", $message)
            ->save();

            $this->resp->result = 1;
            $this->resp->redirect = APPURL."/chatbot";
            $this->resp->id = $Message->get("id");
            $this->resp->title = $Message->get("title");
            $this->resp->message = json_decode('"'.$Message->get("message").'"');
        }
    
        
        $this->jsonecho();
    }

    private function delete()
    {
        $this->resp->result = 0;
        $messageId = \Input::post("id");
        require_once PLUGINS_PATH."/".self::IDNAME."/models/ChatbotMessageModel.php";
        $Message = new ChatbotMessageModel;
        if (isset($messageId)) {
            $Message->select($messageId);
           
        }
        $Message->set("is_deleted", true)
        ->save();
        $this->resp->result = 1;
        $this->resp->redirect = APPURL."/chatbot";
        $this->resp->id = $Message->get("id");
        
        $this->jsonecho();
    }

    public function getCountOfUserMessages($account_id){
        $query = \DB::table('np_chatbot_messages')
        ->where("account_id", "=", $account_id)
        ->limit(1)
        ->select("*");

        return $query->count();
    }
    public function full_path()
{
    $s = &$_SERVER;
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    $uri = $protocol . '://' . $host . $s['REQUEST_URI'];
    $segments = explode('?', $uri, 2);
    $url = $segments[0];
    return $url;
}
}
