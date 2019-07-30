<?php
namespace Plugins\InstagramChatbot;
/**
 * Chatbot
 */
class DirectMessages
{
    const IDNAME = "instagram-chatbot";
    /**
     * Process
     */
    public function process($cron)
    {
        $this->start_process($cron);
    }

    private function start_process($cron){
        $account_id = $cron->account_id;
        $thread_id = $cron->thread_id;
      
        try {
        $Account = \Controller::model("Account", '');
        $Instagram = \InstagramController::login($Account);
        } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
        require_once PLUGINS_PATH."/".self::IDNAME."/controllers/ChatbotCronController.php";
        $ChatbotCron = new ChatbotCronController;
        $ChatbotCron->disableInstagramAccountWithError($account_id);
        $ChatbotCron->chatbotErrorLog($account_id, $e->getMessage(), 'Account Chatbot deactivated');
        }
        $instagram_account_id = $Instagram->account_id;

        $thread = $Instagram->direct->getThread($thread_id);
        $all_messages = $thread->getThread()->getItems();

        $current_sender_id = $all_messages[0]->getUserId();
       
        echo "<br>account id: ".$instagram_account_id .' - last sender id: '. $current_sender_id;
        if($instagram_account_id !== $current_sender_id){
           
            $next_msg = $cron->last_sent_index !== null ? $cron->last_sent_index + 1: 0 ;
            $messages = json_decode($cron->messages, true);
            if(!empty($messages[$next_msg])){
                
                $msg = $messages[$next_msg];
                $this->generateNewMessage($Account, $thread_id, $msg , $current_sender_id, $cron, $next_msg );
                $this->changeSendingSpeedBasedOnActivity($thread, $cron, true);
            } 
        } else {
            $this->changeSendingSpeedBasedOnActivity($thread, $cron, false);
        }

    }

    private function changeSendingSpeedBasedOnActivity($thread, $cron, $on_send_request){
        $time = $thread->getThread()->getItems()[0]->getTimestamp();
        $time = strval($time);
        $time = substr($time, 0, 10);
        $start =  new \DateTime(date('Y-m-d h:i:s',intval($time)) );
        $diff = $start->diff(new \DateTime(date('Y-m-d h:i:s', time())));
        if($on_send_request){
            if( !$cron->fast_speed && $cron->slow_speed ){
                require_once PLUGINS_PATH."/".self::IDNAME."/models/CronJobModel.php";
                $CronJob = new CronJobModel;
                $cron = $this->getCronJobID($cron->thread_id);
                if (isset($cron)) {
                    $CronJob->select(intval($cron->id));
                    $CronJob
                    ->set("fast_speed", true)
                    ->set("slow_speed", false)
                    ->save();
                }
                return;
            }
        } else {
            if( $diff->h >= 1 && $cron->fast_speed && !$cron->slow_speed ){
                require_once PLUGINS_PATH."/".self::IDNAME."/models/CronJobModel.php";
                $CronJob = new CronJobModel;
                $cron = $this->getCronJobID($cron->thread_id);
                if (isset($cron)) {
                    $CronJob->select(intval($cron->id));
                    $CronJob
                    ->set("fast_speed", false)
                    ->set("slow_speed", true)
                    ->save();
                }
                return;
            }
            if( !$cron->fast_speed && $cron->slow_speed && $diff->d >= 1 ){
                $this->terminateCronJobs($cron->thread_id);
                return;
            }
        }
       
    }

    private function generateNewMessage($Account, $threadId, $msg_data, $recipient_id, $cron, $message_index){  
        $decoded_msg = json_decode('"'.$msg_data['message'].'"');
        require_once PLUGINS_PATH."/".self::IDNAME."/controllers/SpinText.php";
        $spinText = new SpinText;
        $generated_msg = $spinText->process($decoded_msg);
        $is_sent = $this->sendMessage($Account, $threadId, $generated_msg);
        if ($is_sent){
            $this->updateCronJobProcess($threadId, $msg_data, $cron, $message_index);
            $this->logSentMessage($Account->get('id'), $Account->get('user_id'), $recipient_id, $msg_data['message'], $msg_data['id']);
            if (!empty($cron->inbox_count) && !empty($cron->sent_count) && $cron->inbox_count == $cron->sent_count + 1){
              $this->terminateCronJobs($threadId);
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
            'messages' => $text
            ];
            header('Content-Type: application/json');
            echo "<br>". json_encode($result);
            if($sendMessage){
                return true;
             } else {
                return  false;
             }
        } catch (\Exception $e) {
            $result['msg'] = $e->getMessage();
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
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

    private function updateCronJobProcess($threadId, $msg_data, $cron, $message_index){
        require_once PLUGINS_PATH."/".self::IDNAME."/models/CronJobModel.php";
        $CronJob = new CronJobModel;
        $cron = $this->getCronJobID($threadId);
        if (isset($cron)) {
            $CronJob->select(intval($cron->id));
            $CronJob->set("sent_count", intval($cron->sent_count) + 1)
            ->set("last_sent_id", intval($msg_data["id"]))
            ->set("last_sent_index", intval($message_index))
            ->set("sent_date", date('Y-m-d h:i:s', time()))
            ->save();
        }
       
    }
    private function getCronJobID($threadId){
        $query = \DB::table('np_chatbot_cron_jobs')
        ->where("thread_id", "=", $threadId)
        ->select("*")
        ->get();
        return sizeOf($query) > 0 ? $query[0] : true ;
    }

    private function terminateCronJobs($threadId){
        require_once PLUGINS_PATH."/".self::IDNAME."/models/CronJobModel.php";
        $CronJob = new CronJobModel;
        $cron = $this->getCronJobID($threadId);
        if (isset($cron)) {
            $CronJob->select(intval($cron->id));
            $CronJob->set("is_terminated", true)
            ->save();
        }
    }
}