<?php
namespace Plugins\Inbox;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Thread Controller
 */
class ThreadController extends \Controller
{
    /**
     * idname of the plugin for internal use
     */
    const IDNAME = 'inbox';
  
    /**
     * Process
     */
    public function process()
    {
        $chats    = "";
        $AuthUser = $this->getVariable("AuthUser");
        $Route    = $this->getVariable("Route");
        $this->setVariable("idname", self::IDNAME);
      
        // Auth
        if (!$AuthUser) {
            echo __("You are not logged in.");
            exit;
        } else if ($AuthUser->isExpired()) {
            echo __("Your account is expired");
            exit;
        }

        $user_modules = $AuthUser->get("settings.modules");
        if (!is_array($user_modules) || !in_array(self::IDNAME, $user_modules)) {
            // Module is not accessible to this user
            echo __("You dont have access to this module");
            exit;
        }

        // Get account
        $Account = \Controller::model("Account", $Route->params->id);
        if (!$Account->isAvailable() || $Account->get("user_id") != $AuthUser->get("id")) {
            echo __("Invalid Account");
            exit;
        }
      
        $this->setVariable("Account", $Account);
      
        $this->setVariable("thread", \Input::get("id") ? \Input::get("id") : null);
        $this->setVariable("userId", \Input::get("userid") ? \Input::get("userid") : null);
        $this->setVariable("cursor", \Input::get("cursor") ? \Input::get("cursor") : null);
        $this->setVariable("lastTimestamp", \Input::get("lasttimestamp") ? \Input::get("lasttimestamp") : null);
        $this->setVariable("msgSent", \Input::post("msgSent") ? \Input::post("msgSent") : null);
        $this->setVariable("isLoadmore", (bool) \Input::get("loadmore") == 1);

        if (\Input::get("action") == "msg") {
          $this->getThreadMessages();
        } elseif (\Input::get("action") == "pending") {
          $this->getPending();
        } elseif (\Input::get("action") == "sendmsg") {
          $this->sendMessage();
        } elseif (\Input::get("action") == "cancel") {
          $this->cancelMessage();
        } else {
          $this->loadThread();
        }
    }
  
  
    /**
     * load wrap content to iframe chat
     */
    private function loadThread()
    {
      $this->setVariable("currentUrl", APPURL . "/e/" . IDNAME . "/thread/" . $this->getVariable("Account")->get("id") . "/?id=" . $this->getVariable("thread") . "&userid=" . $this->getVariable("userId"));
      $this->setVariable("ajaxUrl", APPURL . "/e/" . IDNAME . "/thread/" . $this->getVariable("Account")->get("id") . "/?action=msg");
      $this->setVariable("ajaxPendingUrl", APPURL . "/e/" . IDNAME . "/thread/" . $this->getVariable("Account")->get("id") . "/?action=pending&userid=" . $this->getVariable("userId"));
      $this->setVariable("ajaxSendMessageUrl", APPURL . "/e/" . IDNAME . "/thread/" . $this->getVariable("Account")->get("id") . "/?action=sendmsg&userid=" . $this->getVariable("userId"));
      $this->view(PLUGINS_PATH."/".self::IDNAME."/views/thread.php", null);
    }
  
    /**
     * load thread messages
     */
    private function getThreadMessages()
    {
      $AuthUser = $this->getVariable("AuthUser");
      $Account  = $this->getVariable("Account");
      $cursor   = $this->getVariable("cursor");
      $threadId = $this->getVariable("thread");
      $isLoadmore = $this->getVariable("isLoadmore");
      $this->setVariable("currentUrl", APPURL . "/e/" . IDNAME . "/thread/" . $this->getVariable("Account")->get("id") . "/?id=" . $this->getVariable("thread") . "&userid=" . $this->getVariable("userId"));
      $lastTimestamp = null;

        //ajax request
        $result = [
          'ok'      => false,
          'msg'     => '',
          'content' => '',
          'title'   => '',
          'cursor'  => $cursor
        ];
      
      try {
        $Instagram = \InstagramController::login($Account);
      } catch (\Exception $e) {
        $result['msg'] = $e->getMessage();
        if($isLoadmore) {
          header('Content-Type: application/json');
          echo json_encode($result);
        } else {
          echo $result['msg'];
        }
        exit;
      }
      try {
        $thread = $Instagram->direct->getThread($threadId, $cursor);
      } catch (\Exception $e) {
        $result['msg'] = $e->getMessage();
        if($isLoadmore) {
          header('Content-Type: application/json');
          echo json_encode($result);
        } else {
          echo $result['msg'];
        }
        exit;
      }
      //echo '<pre>'; print_r($thread); exit;
      //echo $thread->printJson(); exit;
      foreach($thread->getThread()->getUsers() as $u) {
        $pk = $u->getPk();
        $users[$pk] = [
          'username'  => $u->getUsername(),
          'fullname'  => $u->getFullName(),
          'img'       => $u->getProfilePicUrl(),
        ];
      }

      $items = array_reverse($thread->getThread()->getItems());
      $cursor = $thread->getThread()->getOldestCursor();
      $content = "";
      foreach($items as $item) {
        try {
          $lastTimestamp = date('Y-m-d H:i:s', $item->getTimestamp() / 1000000);
          $content .= namespace\formatThreadItem($item, $Account, $AuthUser, $users, $threadId);
        } catch(\Exception $e) {
          continue;
        }
      }
      
      $this->setVariable("chats", $content);
        $result = [
          'ok'      => true,
          'msg'     => __("ok"),
          'title'   => $thread->getThread()->getThreadTitle(),
          'content' => $content,
          'cursor'  => $cursor,
          'lasttimestamp' => $lastTimestamp
        ];
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
      
    /**
     * Get pending inbox data.
     */
    private function getPending()
    {         
        $AuthUser = $this->getVariable("AuthUser");
        $Account  = $this->getVariable("Account");
        $cursor   = $this->getVariable("cursor");
        $threadId = $this->getVariable("thread");
        $userId   = $this->getVariable("userId");
        $lastTimestamp = $this->getVariable("lastTimestamp");

        try {
          $Instagram = \InstagramController::login($Account);
        } catch (\Exception $e) {
          if($isLoadmore) {
            $result['msg'] = $e->getMessage();
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
          }
          echo "Error: " . $e->getMessage();
        }

        try {
          $thread = $Instagram->direct->getThread($threadId, $cursor);
          
          foreach($thread->getThread()->getUsers() as $u) {
            $pk = $u->getPk();
            $users[$pk] = [
              'username'  => $u->getUsername(),
              'fullname'  => $u->getFullName(),
              'img'       => $u->getProfilePicUrl(),
           ];
          }
          
          $messages = [];
          $key = 0;
          $content = "";
          foreach(array_reverse($thread->getThread()->getItems()) as $item) {
            if($this->getVariable("Account")->get("instagram_id") == $item->getUserId()) {
              continue;
            }
            $timestamp = date('Y-m-d H:i:s', $item->getTimestamp() / 1000000);
            if(strtotime($timestamp) > strtotime($lastTimestamp)) { 
              $lastTimestamp = $timestamp;
              $content .= namespace\formatThreadItem($item, $Account, $AuthUser, $users, $threadId);
            }
          }

          $result = [
            'ok'      => true,
            'msg'     => __("ok"),
            'lasttimestamp' => $lastTimestamp,
            'content' => $content,
          ];
          header('Content-Type: application/json');
          echo json_encode($result);
          exit;
        } catch (\Exception $e) {
            $result['msg'] = $e->getMessage();
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }
  
    /**
     * Send message to a user
     */
    private function sendMessage()
    {         
        $AuthUser = $this->getVariable("AuthUser");
        $Account  = $this->getVariable("Account");
        $cursor   = $this->getVariable("cursor");
        $threadId = $this->getVariable("thread");
        $userId = $this->getVariable("userId");
        $msgSent = $this->getVariable("msgSent");

        try {
          $Instagram = \InstagramController::login($Account);
        } catch (\Exception $e) {
          if($isLoadmore) {
            $result['msg'] = $e->getMessage();
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
          }
          echo "Error: " . $e->getMessage();
        }

        try {
          $text = $msgSent;
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

    /**
     * Delete a message
     */
    private function cancelMessage()
    {

      $result = [
        'ok'      => false,
        'msg'     => "",
      ];

      $AuthUser = $this->getVariable("AuthUser");
      $Account  = $this->getVariable("Account");
      $threadId = \Input::get("id");
      $itemId   = \Input::get("threadItemId");

      try {
        $Instagram = \InstagramController::login($Account);
      } catch (\Exception $e) {
        $result['msg'] = $e->getMessage();
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
      }

      try {
        $res = $Instagram->direct->deleteItem($threadId, $itemId);
        $result = [
          'ok'      => true,
          'msg'     => __("ok"),
        ];
      } catch (\Exception $e) {
        $result['msg'] = $e->getMessage();
      }
      header('Content-Type: application/json');
      echo json_encode($result);
      exit;


    }
}
