<?php
namespace Plugins\Inbox;
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Setup Controller
 */
class InboxController extends \Controller
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
        $loadView = (bool) \Input::get("ajax") != 1;
        $this->setVariable("idname", self::IDNAME);
      
        // Auth
        if (!$AuthUser){
            $loadView ? exit : header("Location: ".APPURL."/login");
            exit;
        } else if ($AuthUser->isExpired()) {
            $loadView ? exit : header("Location: ".APPURL."/expired");
            exit;
        }

        $user_modules = $AuthUser->get("settings.modules");
        if (!is_array($user_modules) || !in_array(self::IDNAME, $user_modules)) {
            // Module is not accessible to this user
            $loadView ? exit : header("Location: ".APPURL."/post");
            exit;
        }

        // Get account
        $Account = \Controller::model("Account", $Route->params->id);
        if (!$Account->isAvailable() || 
            $Account->get("user_id") != $AuthUser->get("id")) 
        {
            $loadView ? exit : header("Location: ".APPURL."/e/".self::IDNAME);
            exit;
        }
        $this->setVariable("Account", $Account);
      
        $cursor = \Input::get("cursor") ? \Input::get("cursor") : null;
        $this->setVariable("cursor", $cursor);
      
        $isLoadmore = (bool) \Input::get("loadmore") == 1;

        if (\Input::post("action") == "chat") {
            $this->getChat();
        } elseif(\Input::get("action") == "thread") {
          $this->getThread($isLoadmore);
        }else {
          $this->getInbox($isLoadmore);
        }

        if($loadView) {
          $this->view(PLUGINS_PATH."/".self::IDNAME."/views/inbox.php", null);
        }
        
    }
  
    private function dd($data, $die = true)
    {
      echo '<pre>';
      print_r($data);
      echo '</pre>';
      $die ? exit : null;
    }


    /**
     * get Inbox
     * @return mixed 
     */
    private function getInbox($isLoadmore = false)
    {
      $AuthUser = $this->getVariable("AuthUser");
      $Account  = $this->getVariable("Account");
      $cursor   = \Input::get("cursor") ? \Input::get("cursor") : null;
      
        //ajax request
        $result = [
          'ok'      => false,
          'msg'     => '',
          'content' => '',
          'cursor'  => $cursor
        ];
      
      try {
        $Instagram = \InstagramController::login($Account);
      } catch (\Exception $e) {
        if($isLoadmore) {
          $result['msg'] = $e->getMessage();
          header('Content-Type: application/json');
          echo json_encode($result);
        } else {
          echo $e->getMessage();
        }
        exit;
      }
      
      try {
        $inbox = $Instagram->direct->getInbox($cursor);
      } catch (\Exception $e) {
        if($isLoadmore) {
          $result['msg'] = $e->getMessage();
          header('Content-Type: application/json');
          echo json_encode($result);
        } else {
          echo $e->getMessage();
        }
        exit;
      }
      //echo $inbox->printJson(); exit;

      $Threads = $inbox->getInbox()->getThreads();
      $cursor = $inbox->getInbox()->getOldestCursor();
      
      $this->setVariable('cursor', $inbox->getInbox()->getOldestCursor());
      $this->setVariable("Threads", $inbox->getInbox()->getThreads());
      
      try {
        ob_start();
        $this->view(PLUGINS_PATH."/".self::IDNAME."/views/fragments/inbox-chat.fragment.php", null);
        $content = ob_get_contents();
        ob_end_clean();
      } catch(\Exception $e) {
        $content = "Error: " . $e->getMessage();
      }

      $this->setVariable("chats", $content);
      if($isLoadmore) {
        $result = [
          'ok'      => true,
          'msg'     => __("ok"),
          'content' => $content,
          'cursor'  => $cursor
        ];
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
      }
    }
  
    /**
     * get Thread
     * @return mixed 
     */
    private function getThread($isLoadmore = false)
    {
      $AuthUser = $this->getVariable("AuthUser");
      $Account  = $this->getVariable("Account");
      $cursor   = \Input::get("cursor") ? \Input::get("cursor") : null;
      $threadId = \Input::get("thread") ? \Input::get("thread") : null;
      
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
      } catch (\Exception $e) {
          $result['msg'] = $e->getMessage();
          header('Content-Type: application/json');
          echo json_encode($result);
          exit;
      }
      foreach($thread->getThread()->getUsers() as $u) {
        $pk = $u->getPk();
        $users[$pk] = [
          'username'  => $u->getUsername(),
          'fullname'  => $u->getFullName(),
          'img'       => $u->getProfilePicUrl(),
        ];
      }
      $this->setVariable('users', $users);
      $this->setVariable("thread", $thread);
      

      ob_start();
      $this->view(PLUGINS_PATH."/".self::IDNAME."/views/fragments/inbox-thread.fragment.php", null);
      $content = ob_get_contents();
      ob_end_clean();
      
      $this->setVariable("chats", $content);
        $result = [
          'ok'      => true,
          'msg'     => _("ok"),
          'title'   => $thread->getThread()->getThreadTitle(),
          'content' => $content,
          'cursor'  => $cursor
        ];
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}
