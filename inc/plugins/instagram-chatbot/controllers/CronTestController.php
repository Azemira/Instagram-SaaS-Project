<?php
namespace Plugins\InstagramChatbot;
// use \Plugins\InstagramChatbot\SpinTxt;
/**
 * Cron Controller
 */

class CronTestController extends \Controller
{
    const IDNAME = "instagram-chatbot";
    /**
     * Process
     */
    public function process(){
        set_time_limit(0);

        $this->start_job();

        echo "Cron task processed!";
       
    }

    private function start_job(){
        $accountIds = $this->getActiveChatbotAccountIDs();
        foreach($accountIds as $id){
            $Account = \Controller::model("Account", $id->account_id);
            $this->getPending($Account);
        }
    }
   
    private function getPending($Account){         
        try {
          $Instagram = \InstagramController::login($Account);
        } catch (\Exception $e) {
          echo "Error: " . $e->getMessage();
        }

        try {
        $inbox = $Instagram->direct->getInbox();
        $Threads = $inbox->getInbox()->getThreads();
        // $cursor = $inbox->getInbox()->getOldestCursor();

        $threadMessages = [];
        foreach($Threads as $k => $t) {
            $lastItem = $t->getItems()[0];
            $firstUser = $t->getUsers()[0];
            $tmp = [
                'thread_id' => $t->getThreadId(), 
                'last_item' => $lastItem = $t->getItems()[0],
                'owner_id' => $Instagram->account_id
            ];
            array_push($threadMessages, $tmp);
        }
        foreach($threadMessages as $key => $message) {
            $this->checkMessageActivity($Account, $message);
        }

        } catch (\Exception $e) {
            $result['msg'] = $e->getMessage();
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }
    private function checkMessageActivity($Account, $message) {
        if ($message['last_item']->getUserId() !== $message['owner_id']) {
          $recipient_id = $message['last_item']->getUserId();
           $available_recipient = $this->checkIsRecipientAvailable($Account->get('id'), $Account->get('user_id'), $message['last_item']->getUserId());
           if ($available_recipient) {
            
             $last_msg_sent = $this->checkForSentMessages($Account->get('id'), $Account->get('user_id'), $message['last_item']->getUserId());
             if ($last_msg_sent) {
               $next_message = $this->getNextMessage($Account, $last_msg_sent);
               if($next_message) {
                 $this->generateNewMessage($Account, $message['thread_id'], $next_message, $recipient_id);
               } 
               else {
                 $this->terminateChatbotForThisUser($Account->get('id'), $Account->get('user_id'), $message['last_item']->getUserId());
               }
             } else {
              $first_message = $this->getFirstMessageInOrder($Account);
              $this->generateNewMessage($Account, $message['thread_id'], $first_message, $recipient_id);
             }

           }
        }
    }
  
    private function sendMessage($Account, $threadId, $msg){         
        try {
          $Instagram = \InstagramController::login($Account);
        } catch (\Exception $e) {
      
          echo "Error: " . $e->getMessage();
        }

        try {
          $text = $msg;
          $recipients = [
            'thread' => $threadId
          ];
          $sendMessage = $Instagram->direct->sendText($recipients, $text);

          $result = [
            'ok'      => true,
            'msg'     => __("ok"),
            //'lasttimestamp' => $lastTimestamp,
            //'messages' => $messages
          ];
          header('Content-Type: application/json');
          echo json_encode($result);
        } catch (\Exception $e) {
            $result['msg'] = $e->getMessage();
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }

    public function checkIsRecipientAvailable($account_id, $user_id, $recipient_id){
      $query = \DB::table('np_chatbot_finished_requests')
      ->where("account_id", "=", $account_id)
      ->where("user_id", "=", $user_id)
      ->where("recipient_id", "=", $recipient_id)
      ->select("*")
      ->get();
      return sizeOf($query) > 0 ? false : true ;
    }

    private function checkForSentMessages($account_id, $user_id, $recipient_id){
      $query = \DB::table('np_chatbot_log')
      ->where("account_id", "=", $account_id)
      ->where("user_id", "=", $user_id)
      ->where("recipient_id", "=", $recipient_id)
      ->select("*")
      ->orderBy("sent_date","DESC")
      ->limit(1)
      ->get();
      return sizeOf($query) > 0 ? $query : false;
    }

    public function getNextMessage($Account, $last_sent_msg_order){
      $sent_msg_id = $this->getSentMessageById($last_sent_msg_order[0]->message_id);
      $query = \DB::table('np_chatbot_messages')
      ->where("account_id", "=", $Account->get('id'))
      ->where("user_id", "=", $Account->get('user_id'))
      // ->where("id", "!=", intval($last_sent_msg_order[0]->message_id))
      ->where("message_order", "=", intval($sent_msg_id[0]->message_order) +1)
      ->where("is_deleted", "=", false)
      ->select("*")
      // ->orderBy("message_order","DESC")
      ->limit(1)
      ->get();
      return sizeOf($query)  > 0 ? $query : false;
    }
    
    public function getActiveChatbotAccountIDs(){
      $query = \DB::table('np_chatbot_settings')
      ->where("chatbot_status", "=", 1)
      ->select("*")
      ->get();
      return $query;
   }

   public function terminateChatbotForThisUser($account_id, $user_id, $recipient_id){
    require_once PLUGINS_PATH."/".self::IDNAME."/models/ChatbotTerminateModel.php";
    $ChatbotTerminate = new ChatbotTerminateModel;

    $ChatbotTerminate->set("user_id", $user_id)
            ->set("account_id", $account_id)
            ->set("recipient_id", $recipient_id)
            ->save();
   }

   private function generateNewMessage($Account, $threadId, $msg_data, $recipient_id){  
    $decoded_msg = json_decode('"'.$msg_data[0]->message.'"');
    $generated_msg = $this->spinText($decoded_msg);
    $this->sendMessage($Account, $threadId, $generated_msg);
    $this->logSentMessage($Account->get('id'), $Account->get('user_id'), $recipient_id, $msg_data[0]->message, $msg_data[0]->id);
   }

   public function logSentMessage($account_id, $user_id, $recipient_id, $msg, $msg_id) {
    require_once PLUGINS_PATH."/".self::IDNAME."/models/ChatbotLogModel.php";
    $MessageLog = new ChatbotLogModel;

    $MessageLog->set("user_id", $user_id)
            ->set("account_id", $account_id)
            ->set("recipient_id", $recipient_id)
            ->set("message_id", $msg_id)
            ->set("sent_message", $msg)
            ->set("sent_date", date('Y-m-d h:i:s', time()))
            ->save();
   }

   private function getFirstMessageInOrder($Account) {
    $query = \DB::table('np_chatbot_messages')
    ->where("account_id", "=", $Account->get('id'))
    ->where("user_id", "=", $Account->get('user_id'))
    ->where("is_deleted", "=", false)
    ->select("*")
    ->orderBy("message_order","ASC")
    ->limit(1)
    ->get();
    return sizeOf($query) > 0 ? $query : false;
   }

   private function getSentMessageById($id){
    $query = \DB::table('np_chatbot_messages')
    ->where("id", "=", $id)
    ->limit(1)
    ->get();
    return sizeOf($query)  > 0 ? $query : false;
   }
   private function spinText($text){
    return preg_replace_callback(
        '/\{(((?>[^\{\}]+)|(?R))*)\}/x',
        array($this, 'replace'),
        $text
    );
  }

  public function replace($text){
      $text = $this->spinText($text[1]);
      $parts = explode('|', $text);
      return $parts[array_rand($parts)];
  }
}