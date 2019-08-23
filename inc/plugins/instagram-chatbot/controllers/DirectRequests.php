<?php
namespace Plugins\InstagramChatbot;
/**
 * Chatbot
 */
class DirectRequests
{
    const IDNAME = "instagram-chatbot";
    /**
     * Process
     */
    public function process($account_id)
    {
        $this->start_process($account_id);
    }

    private function start_process($account_id){
        $Account = \Controller::model("Account", $account_id);
        if($Account ) {
            $this->getDirectMessageRequests($Account);
        }
        
    }

     private function getDirectMessageRequests($Account){
       
        try {
            $Instagram = \InstagramController::login($Account);
            $inbox = $Instagram->direct->getInbox();
            $threads = $inbox->getInbox()->getThreads();
            $this->addAccountToCron($Account, $threads, $Instagram);
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            require_once PLUGINS_PATH."/".self::IDNAME."/controllers/ChatbotCronController.php";
            $ChatbotCron = new ChatbotCronController;
            $ChatbotCron->disableInstagramAccountWithError($Account->get("id"));
            $ChatbotCron->chatbotErrorLog($Account->get("id"), $e->getMessage(), 'Account Chatbot deactivated');
        }
        
     }

     private function getThreadIDs($threads){
       $ids = [];
       foreach($threads as $thread){
        array_push($ids, $thread->getThreadId());
       }
       return $ids;
     }

     public function addAccountToCron($Account, $threads, $Instagram){
     
       foreach($threads as $thread) {
        $instagram_account_id = $Instagram->account_id;
        $current_sender_id = $thread->getItems()[0]->getUserId();
        $is_thread_active = $this->checkIsThreadActive($thread->getThreadId());
        $is_conversation_terminated =  $this->checkIsRecipientAvailable($Account->get('id'), $Account->get('user_id'), $current_sender_id);
            if(!$is_thread_active && !$is_conversation_terminated){
            
                if($instagram_account_id !== $current_sender_id) {
                    
                    $last_message_timestamp = $thread->getItems()[0]->getTimestamp();
                    $in_last_24h = $this->checkWhenMessageIsSent($last_message_timestamp);
                    $is_old_conversation = $this->checkIsOldConversation($Instagram, $thread->getThreadId());
        
                    if($is_old_conversation) {
                        $this->terminateChatbotForThisUser($Account->get('id'), $Account->get('user_id'), $current_sender_id);
                        echo "<br>conversation terminated";
                    } else {
                        $this->saveCronJob($Account, $thread);
                        echo "<br>added to cronjob";
                    }
                
                } 
            }
       }
    }

    private function checkWhenMessageIsSent($time) {
      $time = strval($time);
      $time = substr($time, 0, 10);
      $start =  new \DateTime(date('Y-m-d h:i:s',intval($time)) );
      $diff = $start->diff(new \DateTime(date('Y-m-d h:i:s', time())));
      return $diff->h >= 24 ? true : false;
    }

    private function checkIsOldConversation($Instagram, $thread_id){
        $thread = $Instagram->direct->getThread($thread_id);
        $messages = $thread->getThread()->getItems();
        foreach($messages as $m){
            if($Instagram->account_id == $m->getUserId()){
                return true;
            }
        }
        return  false;
    }

    private function saveCronJob($Account, $thread){
      require_once PLUGINS_PATH."/".self::IDNAME."/models/CronJobModel.php";
      $CronJob = new CronJobModel;
      $messages = $this->getCurrentMessagesOrder($Account);
      $messages_count = count(json_decode($messages ,true));
      $CronJob->set("user_id", $Account->get('user_id'))
      ->set("account_id", $Account->get('id'))
      ->set("recipient_id", $thread->getInviter()->getPk())
      ->set("thread_id", $thread->getThreadId())
      ->set("fast_speed", true)
      ->set("inbox_count", $messages_count)
      ->set("messages", $messages)
      ->set("received_date", date('Y-m-d h:i:s', time()))
      ->save();
    }

    public function getCurrentMessagesOrder($Account) {
      $messages = [];
      $query = \DB::table('np_chatbot_messages')
      ->where("account_id", "=", $Account->get('id'))
      ->where("user_id", "=", $Account->get('user_id'))
      ->where("is_deleted", "=", false)
      ->select("*")
      ->orderBy("message_order","ASC")
      ->get();
      if(sizeOf($query)  > 0) {
        foreach($query as $q){
            $tmp = [ "id" => $q->id, "message" => $q->message ];
            array_push($messages, $tmp);
        }
      }
      return json_encode($messages);
    }

    private function checkIsThreadActive($thred_id){
      $query = \DB::table('np_chatbot_cron_jobs')
      ->where("thread_id", "=", $thred_id)
      ->select("*")
      ->get();
      return sizeOf($query)  > 0 ? true : false;
    }

    public function terminateChatbotForThisUser($account_id, $user_id, $recipient_id){
      require_once PLUGINS_PATH."/".self::IDNAME."/models/ChatbotTerminateModel.php";
      $ChatbotTerminate = new ChatbotTerminateModel;
      $ChatbotTerminate->set("user_id", $user_id)
      ->set("account_id", $account_id)
      ->set("recipient_id", $recipient_id)
      ->save();
    }
    public function checkIsRecipientAvailable($account_id, $user_id, $recipient_id){
      $query = \DB::table('np_chatbot_finished_requests')
      ->where("account_id", "=", $account_id)
      ->where("user_id", "=", $user_id)
      ->where("recipient_id", "=", $recipient_id)
      ->select("*")
      ->get();
      return sizeOf($query) > 0 ? true : false ;
    }

  

}