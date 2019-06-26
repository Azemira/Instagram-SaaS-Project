<?php 
namespace Plugins\Inbox;
const IDNAME = "inbox";

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?"); 


/**
 * Event: plugin.install
 */
function install($Plugin)
{
    if ($Plugin->get("idname") != IDNAME) {
        return false;
    }
}
\Event::bind("plugin.install", __NAMESPACE__ . '\install');



/**
 * Event: plugin.remove
 */
function uninstall($Plugin)
{
    if ($Plugin->get("idname") != IDNAME) {
        return false;
    }
}
\Event::bind("plugin.remove", __NAMESPACE__ . '\uninstall');


/**
 * Add module as a package options
 * Only users with granted permission
 * Will be able to use module
 * 
 * @param array $package_modules An array of currently active 
 *                               modules of the package
 */
function add_module_option($package_modules)
{
    $config = include __DIR__."/config.php";
    ?>
        <div class="mt-15">
            <label>
                <input type="checkbox" 
                       class="checkbox" 
                       name="modules[]" 
                       value="<?= IDNAME ?>" 
                       <?= in_array(IDNAME, $package_modules) ? "checked" : "" ?>>
                <span>
                    <span class="icon unchecked">
                        <span class="mdi mdi-check"></span>
                    </span>
                    <?= __('Inbox') ?>
                </span>
            </label>
        </div>
    <?php
}
\Event::bind("package.add_module_option", __NAMESPACE__ . '\add_module_option');




/**
 * Map routes
 */
function route_maps($global_variable_name)
{
    // Settings (admin only)
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/settings/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/SettingsController.php",
        __NAMESPACE__ . "\SettingsController"
    ]);
  
    // Thread
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/thread/[i:id]/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/ThreadController.php",
        __NAMESPACE__ . "\ThreadController"
    ]);

    // Index
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/IndexController.php",
        __NAMESPACE__ . "\IndexController"
    ]);

    // Inbox
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/[i:id]/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/InboxController.php",
        __NAMESPACE__ . "\InboxController"
    ]);


}
\Event::bind("router.map", __NAMESPACE__ . '\route_maps');


/**
 * Event: navigation.add_special_menu
 */
function navigation($Nav, $AuthUser)
{
    $idname = IDNAME;
    include __DIR__."/views/fragments/navigation.fragment.php";
}
\Event::bind("navigation.add_menu", __NAMESPACE__ . '\navigation');

//depends of API update
//@TODO
function hasSeen($thread)
{
  return false;
  /*print_r(json_decode($x)); exit;
  try {
    return $thread->getLastPermanentItem()->getActionLog() ? false : true;
  } catch(\Exception $e) {
    return true;
  }*/
}


function formatIboxItems($item)
{
  if( (int) \InstagramAPI\Constants::IG_VERSION <= 50) {
    $msg = "";
    try {
      switch($item->getItemType()) {
        case 'text':
          $msg = $item->getText();
          break;
        case 'action_log':
          $aux = $item->getActionLog();
          $msg = is_array($aux) ? $aux["description"] : $item->getActionLog()->getDescription();
          break;
        case 'media_share':
          $msg = __("shared a media");
          break;
        case 'media':
          $msg = __("send a media");
          break;
        case 'link':
          $msg = __("shared a link");
          break;
        case 'like':
          $msg = $item->getLike();
          break;
        case 'video_call_event':
          $aux = $item->getVideoCallEvent();
          $msg = is_array($aux) ? $aux["description"] : $item->getVideoCallEvent()->getDescription();
          break;
        case 'placeholder':
          $aux = $item->getPlaceholder();
          $msg = is_array($aux) ? $aux["message"] : $item->getPlaceholder()->getMessage();
          break;
        case 'story_share':
          $msg = __("Shared an story");
          break;
        case 'profile':
          $aux = $item->getProfile();
          $msg = "@". (is_array($aux) ? $aux["username"] : $item->getProfile()->getUsername());
          break;
        case 'location':
          $msg = $item->getLocation()->getName();
          break;
        case 'hashtag':
          $msg = "#".$item->getHashtag()->getName();
          break;
        case 'reel_share':
          if($item->getReelShare()->getType() == "reaction") {
            $msg = __("reacted to your story");
          } else {
            $msg = __("replied your story");
          }
          break;
        case 'raven_media':
          $msg = 'Sent a media';
          break;
        case 'felix_share':
          $msg = 'Sent a video from IG TV';
          break;
        default:
          $msg = __("other") . ": " . $item->getItemType();
      }
    } catch(\Exception $e) {
      $msg = "undefined: " . $e->getMessage();
    }
  } else {
    $msg = "";
    try {
      switch($item->getItemType()) {
        case 'text':
          $msg = $item->getText();
          break;
        case 'action_log':
          $msg = $item->getActionLog()->getDescription();
          break;
        case 'media_share':
          $msg = __("shared a post");
          break;
        case 'media':
          $msg = __("send a media");
          break;
        case 'link':
          $msg = __("shared a link");
          break;
        case 'like':
          $msg = $item->getLike();
          break;
        case 'video_call_event':
          $msg = $item->getVideoCallEvent()->getDescription();
          break;
        case 'placeholder':
          $msg = $item->getPlaceholder()->getMessage();
          break;
        case 'story_share':
          $msg = __("Shared an story");
          break;
        case 'profile':
          $msg = "@".$item->getProfile()->getUsername();
          break;
        case 'location':
          $msg = $item->getLocation()->getName();
          break;
        case 'hashtag':
          $aux = $item->getHashtag();
          $msg = is_array($aux) ? $aux["name"] : $item->getHashtag()->getName();
          break;
        case 'reel_share':
          if($item->getReelShare()->getType() == "reaction") {
            $msg = __("reacted to your story");
          } else {
            $msg = __("replied your story");
          }
          break;
        case 'raven_media':
          $msg = 'Sent a media';
          break;
        case 'felix_share':
          $msg = 'Sent a video from IG TV';
          break;
        default:
          $msg = __("other") . ": " . $item->getItemType();
      }
    } catch(\Exception $e) {
      $msg = "undefined: " . $e->getMessage();
    }
  }
  
  return $msg;
}

function formatThreadItem($item, $Account, $User, $users, $threadId)
{
  $msg = "";
  if( (int) \InstagramAPI\Constants::IG_VERSION <= 50) {
    try {
      switch($item->getItemType()) {
        case 'text':
          $msg = $item->getText();
          break;
        case 'action_log':
          $msg = $item->getActionLog()->getDescription();
          break;
        case 'like':
          $msg = $item->getLike();
          break;
        case 'story_share':
          if($item->getStoryShare()->getMedia()) {
            $imgPreview = namespace\_get_media_thumb_igitem($item->getStoryShare()->getMedia());
            $user = $item->getStoryShare()->getMedia()->getUser()->getUsername();
            $link = $item->getStoryShare()->getMedia()->getVideoDashManifest();
            $msg = "<span class='inbox-media-share-info'>". __("story from {username}", ["{username}" => $user])."</span>";
            $msg .= "<a href='{$link}' class='inbox-media-shared inbox-view-story_share' target='_blank'><img src='{$imgPreview}' /></a>";
          } else {
            $msg = "<span class='inbox-media-share-info'>". __($item->getStoryShare()->getTitle())."<br><small>".$item->getStoryShare()->getMessage()."</small></span>";
          }
          break;
        case 'placeholder':
          $msg = $item->getPlaceholder()->getMessage();
          break;
        case 'media':
          $imgPreview = namespace\_get_media_thumb_igitem($item->getMedia());
          $msg = "<span class='inbox-media-share-info'>". __("send a media")."</span>";
          $msg .= "<a href='{$imgPreview}' class='inbox-media-shared inbox-view-story_share' target='_blank'><img src='{$imgPreview}' /></a>";
          break;
        case 'raven_media':
          $imgPreview = namespace\_get_media_thumb_igitem($item->getVisualMedia()['media']);
          if($imgPreview) {
            $msg = "<span class='inbox-media-share-info'>". __("send an expireble media")."</span>";
            $msg .= "<a href='{$imgPreview}' class='inbox-media-shared inbox-view-story_share' target='_blank'><img src='{$imgPreview}' /></a>";
          } else {
            $msg = __("Image expired");
          }
          break;
        case 'media_share':
          $imgPreview = namespace\_get_media_thumb_igitem($item->getMediaShare());
          $link = "https://www.instagram.com/p/".$item->getMediaShare()->getCode();
          $msg .= "<a href='{$link}' class='inbox-media-shared inbox-view-story_share' target='_blank'><img src='{$imgPreview}' /></a>";
          break;
        case 'video_call_event':
          $msg = $item->getVideoCallEvent()["description"];
          break;
        case 'link':
          $linkUrl = $item->getLink()->getLinkContext()->getLinkUrl();
          $linkTitle = $item->getLink()->getLinkContext()->getLinkTitle();
          $text = $item->getLink()->getText();
          $msg = "<span class='inbox-media-share-info'>". $text."</span>";
          $msg .= "<a href='{$linkUrl}' class='inbox-media-shared inbox-view-link' target='_blank'>{$linkTitle}</a>";
          break;
        case 'location':
          $linkUrl = "http://maps.google.com/maps?q=".$item->getLocation()->getLat() . ',' . $item->getLocation()->getLng();
          $msg = "<span class='inbox-media-share-info'><a href='{$linkUrl}' class='inbox-media-shared inbox-view-link' target='_blank'>". $item->getLocation()->getName()."<br>
                <small>".$item->getLocation()->getAddress() . " - " . $item->getLocation()->getCity()."<br></small></a></span>";
          break;
        case 'hashtag':
          $msg = "<span class='inbox-media-share-info'>".__("shared a hashtag: #"). $item->getHashtag()["name"] . "</span>";
          break;
        case 'profile':
          $linkUrl = "https://www.instagram.com/" . $item->getProfile()->getUsername();
          $msg = "<a href='{$linkUrl}' class='inbox-media-shared inbox-view-link' target='_blank'>@" . $item->getProfile()->getUsername() ."</a>";
          break;
        case 'reel_share':
          if($item->getReelShare()->getType() == "reaction") {
            $text = "<small>" . __("reacted to your story") . "</small> ";
          } elseif($item->getReelShare()->getType() == "reply") {
            $text = __("replied your story");
          } else {
            $text = __("replied your story");
          }
          $msg = "<span class='inbox-media-share-info'>" . $text . ": " . $item->getReelShare()->getText()."</span>";
          $imgPreview = namespace\_get_media_thumb_igitem($item->getReelShare()->getMedia());
          if($imgPreview) {
            $msg .= "<img src='{$imgPreview}' />";
          } else {
            $msg .= "<br><small>" . __("expired") . "</small>";
          }
          break;
        case 'felix_share':
          $imgPreview = namespace\_get_media_thumb_igitem($item->getFelixShare()['video']);
          $href = $item->getFelixShare()['video']['video_versions'][0]['url'];
          $msg = "<span class='inbox-media-share-info'>". __("Sent a video from IG TV")."</span>";
          $msg .= "<a href='{$href}' class='inbox-media-shared inbox-view-story_share' target='_blank'><img src='{$imgPreview}' /></a>";
          break;
        default:
          //$msg = "<span class='inbox-media-share-other'>". __("other") . ": " .  $item->getItemType() . "<pre>".print_r($item, true) . "</pre></span>";
          $msg = "<span class='inbox-media-share-other'>". __("other") . ": " . $item->getItemType()."</span>";
      }
    } catch(\Exception $e) {
      $msg = "<span class='inbox-media-share-undefined'>". __("undefined") . ": " . $e->getMessage()."</span>";
    }
  } else {
    try {
      switch($item->getItemType()) {
        case 'text':
          $msg = $item->getText();
          break;
        case 'action_log':
          $msg = $item->getActionLog()->getDescription();
          break;
        case 'like':
          $msg = $item->getLike();
          break;
        case 'story_share':
          if($item->getStoryShare()->getMedia()) {
            $imgPreview = namespace\_get_media_thumb_igitem($item->getStoryShare()->getMedia());
            $user = $item->getStoryShare()->getMedia()->getUser()->getUsername();
            $link = $item->getStoryShare()->getMedia()->getVideoDashManifest();
            $msg = "<span class='inbox-media-share-info'>". __("story from {username}", ["{username}" => $user])."</span>";
            $msg .= "<a href='{$link}' class='inbox-media-shared inbox-view-story_share' target='_blank'><img src='{$imgPreview}' /></a>";
          } else {
            $msg = "<span class='inbox-media-share-info'>". __($item->getStoryShare()->getTitle())."<br><small>".$item->getStoryShare()->getMessage()."</small></span>";
          }
          break;
        case 'placeholder':
          $msg = $item->getPlaceholder()->getMessage();
          break;
        case 'media':
          $imgPreview = namespace\_get_media_thumb_igitem($item->getMedia());
          $msg = "<span class='inbox-media-share-info'>". __("send a media")."</span>";
          $msg .= "<a href='{$imgPreview}' class='inbox-media-shared inbox-view-story_share' target='_blank'><img src='{$imgPreview}' /></a>";
          break;
        case 'raven_media':
          $imgPreview = namespace\_get_media_thumb_igitem($item->getVisualMedia()['media']);
          if($imgPreview) {
            $msg = "<span class='inbox-media-share-info'>". __("send an expireble media")."</span>";
            $msg .= "<a href='{$imgPreview}' class='inbox-media-shared inbox-view-story_share' target='_blank'><img src='{$imgPreview}' /></a>";
          } else {
            $msg = __("Image expired");
          }
          break;
        case 'media_share':
          $imgPreview = namespace\_get_media_thumb_igitem($item->getMediaShare());
          $link = "https://www.instagram.com/p/".$item->getMediaShare()->getCode();
          $msg .= "<a href='{$link}' class='inbox-media-shared inbox-view-story_share' target='_blank'><img src='{$imgPreview}' /></a>";
          break;
        case 'video_call_event':
          $msg = $item->getVideoCallEvent()->getDescription();
          break;
        case 'link':
          $linkUrl = $item->getLink()->getLinkContext()->getLinkUrl();
          $linkTitle = $item->getLink()->getLinkContext()->getLinkTitle();
          $text = $item->getLink()->getText();
          $msg = "<span class='inbox-media-share-info'>". $text."</span>";
          $msg .= "<a href='{$linkUrl}' class='inbox-media-shared inbox-view-link' target='_blank'>{$linkTitle}</a>";
          break;
        case 'location':
          $linkUrl = "http://maps.google.com/maps?q=".$item->getLocation()->getLat() . ',' . $item->getLocation()->getLng();
          $msg = "<span class='inbox-media-share-info'><a href='{$linkUrl}' class='inbox-media-shared inbox-view-link' target='_blank'>". $item->getLocation()->getName()."<br>
                <small>".$item->getLocation()->getAddress() . " - " . $item->getLocation()->getCity()."<br></small></a></span>";
          break;
        case 'hashtag':
          $msg = "<span class='inbox-media-share-info'>".__("shared a hashtag: #"). $item->getHashtag()["name"] . "</span>";
          break;
        case 'profile':
          $linkUrl = "https://www.instagram.com/" . $item->getProfile()->getUsername();
          $msg = "<a href='{$linkUrl}' class='inbox-media-shared inbox-view-link' target='_blank'>@" . $item->getProfile()->getUsername() ."</a>";
          break;
        case 'reel_share':
          if($item->getReelShare()->getType() == "reaction") {
            $text = "<small>" . __("reacted to your story") . "</small> ";
          } elseif($item->getReelShare()->getType() == "reply") {
            $text = __("replied your story");
          } else {
            $text = __("replied your story");
          }
          $msg = "<span class='inbox-media-share-info'>" . $text . ": " . $item->getReelShare()->getText()."</span>";
          $imgPreview = namespace\_get_media_thumb_igitem($item->getReelShare()->getMedia());
          if($imgPreview) {
            $msg .= "<img src='{$imgPreview}' />";
          } else {
            $msg .= "<br><small>" . __("expired") . "</small>";
          }
          break;
        case 'felix_share':
          $imgPreview = namespace\_get_media_thumb_igitem($item->getFelixShare()['video']);
          $href = $item->getFelixShare()['video']['video_versions'][0]['url'];
          $msg = "<span class='inbox-media-share-info'>". __("Sent a video from IG TV")."</span>";
          $msg .= "<a href='{$href}' class='inbox-media-shared inbox-view-story_share' target='_blank'><img src='{$imgPreview}' /></a>";
          break;
        default:
          $msg = "<span class='inbox-media-share-other'>". __("other") . ": " . $item->getItemType()."</span>";
      }
    } catch(\Exception $e) {
      $msg = "<span class='inbox-media-share-undefined'>". __("undefined") . ": " . $e->getMessage()."</span>";
    }
  }

  
  $msg      = nl2br($msg);
  $userId   = $item->getUserId();
  $isMine   = $Account->get("instagram_id") == $userId;
  $isMineClass = $isMine ? 'inbox-msg-mine' : 'inbox-msg-not-mine';
  $msgCancel = __("Cancel sending");
  $linkCancel = APPURL . "/e/" . IDNAME . "/thread/" . $Account->get("id") . "/?action=cancel&id=" . $threadId . "&threadItemId=" . $item->getItemId();


  if(isset($users[$userId])) {
    $username = $users[$userId]['username'];
    $fullname = $users[$userId]['fullname'];
    $pic      = $users[$userId]['img'];
  } else {
    $username = "";
    $fullname = "";
    $pic      = "";
  }

  
  $align    = $isMine ? 'left' : 'right';
  $reversAlign = $isMine ? 'right' : 'left';

  $date = new \Moment\Moment(date("Y-m-d H:i:s", $item->getTimestamp() / 1000000), date_default_timezone_get());
  $date->setTimezone($User->get("preferences.timezone"));
  $niceDate = $date->fromNow()->getRelative();

  
  $str      = <<<EOT
                <div class="inbox-direct-chat-msg {$isMineClass}">
                  <div class="inbox-direct-chat-info clearfix">
                    <span class="inbox-direct-chat-timestamp">
                      <a href="{$linkCancel}" class="direct-chat-remove" title="{$msgCancel}"><span class="sli sli-trash"></span></a>
                      {$niceDate}
                    </span>
                  </div>
                  <img class="inbox-direct-chat-img" src="{$pic}" alt="{$fullname}">
                <div class="inbox-direct-chat-text">{$msg}</div>
              </div>
EOT;
  return $str;
}


/**
 * Get media thumb url from the Instagram feed item
 * @param  stdObject $item Instagram feed item
 * @return string|null       
 */
function _get_media_thumb_igitem($item, $tag = false)
{
  if(!$item) {
    return '';
  }
  //echo '<pre>'; print_r($item); exit;
  $url = null;
  if(is_array($item)) {
    if(isset($item['image_versions2']['candidates'][0]['url'])) {
      $url = $item['image_versions2']['candidates'][0]['url'];
    }
  } else {
    try {
      $media_type = empty($item->getMediaType()) ? null : $item->getMediaType();
    } catch(\Exception $e) {
      $media_type = 1;
    }
    
    if ($media_type == 1 || $media_type == 2) {
        // Photo (1) OR Video (2)
        $url = $item->getImageVersions2()->getCandidates()[0]->getUrl();
    } else if ($media_type == 8) {
        // ALbum
        $url = $item->getCarouselMedia()[0]->getImageVersions2()->getCandidates()[0]->getUrl();
    }
  }
  if($url && $tag) {
    return "<img src='{$url}' />";
  }
  return $url;
}