<?php 
namespace Plugins\InstagramChatbot;

// Disable direct access
// if (!defined('APP_VERSION')) 
//     die("Yo, what's up?"); 



/**
 * All functions related to the cron task
 */



/**
 * Add cron task to like new posts
 */
function addCronTask(){
    const IDNAME = "instagram-chatbot";
    require_once PLUGINS_PATH."/".self::IDNAME."/controllers/ChatbotCronController.php";
    $ChatbotCron = new ChatbotCronController;
    $ChatbotCron->process();

}
addCronTask();
\Event::bind("cron.add", __NAMESPACE__."\addCronTask");