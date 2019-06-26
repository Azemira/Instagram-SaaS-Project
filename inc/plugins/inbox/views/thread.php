<?php if (!defined('APP_VERSION')) die("Yo, what's up?");  ?>
<!DOCTYPE html>
<html lang="<?= ACTIVE_LANG ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
        <meta name="theme-color" content="#fff">

        <meta name="description" content="<?= site_settings("site_description") ?>">
        <meta name="keywords" content="<?= site_settings("site_keywords") ?>">

        <link rel="icon" href="<?= site_settings("logomark") ? site_settings("logomark") : APPURL."/assets/img/logomark.png" ?>" type="image/x-icon">
        <link rel="shortcut icon" href="<?= site_settings("logomark") ? site_settings("logomark") : APPURL."/assets/img/logomark.png" ?>" type="image/x-icon">

        <link rel="stylesheet" type="text/css" href="<?= APPURL."/assets/css/plugins.css?v=".VERSION ?>">
        <link rel="stylesheet" type="text/css" href="<?= APPURL."/assets/css/core.css?v=".VERSION ?>">
      
        <link rel="stylesheet" type="text/css" href="<?= PLUGINS_URL."/".$idname."/assets/css/core.css?v=".VERSION ?>">

        <title><?= htmlchars($Account->get("username")) ?></title>
    </head>

    <body class="inbox-thread onprogress">
      
      <div class="inbox-direct-chat">
        <div class="inbox-thread-head">
          <h3 id="inbox-thread-title"></h3>
          <div class="inbox-tools">
            <?php if ( !\Input::get("newwindow")) : ?>
              <a href="<?= $currentUrl; ?>&newwindow=1" target="_blank" title="<?= __("open in a new window"); ?>" class="btn-action-thread btn-expand-thread"><i class="sli sli-size-fullscreen"></i></a>
              <a href="#" title="<?= __("close chat"); ?>" class="btn-action-thread btn-close-thread"><i class="sli sli-close"></i></a>
            <?php endif; ?>
          </div>
        </div>
        <div class="inbox-thread-body">
            <a class="fluid button button--light-outline -js-loadmore-btn" 
               id="inbox-thread-loadmore" 
               data-cursor="<?= $cursor?>" 
               data-ajaxurl="<?= APPURL."/e/".$idname."/".$Account->get("id") . "?ajax=1"?>"
               style="visibility:hidden;">
                <span class="icon sli sli-refresh"></span>
                <?= __("Load Older") ?>
            </a>
          <div class="direct-chat-msg" id="inbox-conversation" style="min-height: calc(100vh - 244px);">
            <div id="inbox-sending-status" style="display:none; position: absolute; bottom: 0; left: 0; right: 0; text-align: center;"><small><?= __("Processing"); ?></small></div>
          </div>
        </div>
        <div class="inbox-thread-footer">
          <div class="" id="inbox-input-msg" data-placeholder="<?= __("type your message"); ?>" contenteditable="true"></div>
            <a href="#" id="inbox-send-msg">
              <span class="sli sli-paper-plane"></span>
            </a>
            <input type="hidden" id="last-timestamp" value="<?= $lastTimestamp; ?>">
        </div>
      </div>
      
      
      
  

        <script type="text/javascript" src="<?= APPURL."/assets/js/plugins.js?v=".VERSION ?>"></script>
        <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
        <script type="text/javascript" src="<?= APPURL."/assets/js/core.js?v=".VERSION ?>"></script>

        <script type="text/javascript" src="<?= PLUGINS_URL."/".$idname."/assets/js/core.js?v=".VERSION ?>"></script>
        <script type="text/javascript" charset="utf-8">
            var InboxThread       = {};

            InboxThread.emoji;
            InboxThread.hasLoaded = false;
            InboxThread.isRunning = false;
            InboxThread.isRunningOld = false;
            InboxThread.isRunningRemove = false;
            InboxThread.cursor    = null;

            $(function() {
              
              
              //close chat
              $("body").on("click", ".btn-close-thread", function(evt) {
                  evt.preventDefault();
                  $("#inbox-chat-frame", window.parent.document).prop("src", "").hide();
                  $("body", window.parent.document).removeClass("inbox-open");
              });


              // remove msg
              $("body").on("click", ".direct-chat-remove", function(evt) {
                evt.preventDefault();
                if(InboxThread.isRunningRemove) {
                  return false;
                }
                $("body").addClass("onprogress");
                InboxThread.isRunningRemove = true;
                
                var item = $(this);
                var url = $(this).attr('href');
                 
                $.ajax({
                  url: url,
                  dataType: 'json',
                  error: function() {
                      $("body").removeClass("onprogress");
                      alert("<?= __('Could not remove this message.') ?>");
                      InboxThread.isRunningRemove = false;
                      $("body").removeClass("onprogress");
                  },
                  success: function(resp) {
                    if(resp.ok) {
                      item.parents('.inbox-direct-chat-msg').remove();
                    } else {
                      alert("<?= __('Could not remove this message.') ?>");
                    }
                    InboxThread.isRunningRemove = false;
                    $("body").removeClass("onprogress");
                  }
                });
              });
              
              InboxThread.scrollToBottom = function() {
                  $("html, body").animate({ scrollTop: $(document).height() }, 1000);
              }

              InboxThread.GetMessages = function(origin, url) {
                InboxThread.isRunningOld = true;
                if(origin == 2) {
                  // new message
                } else {
                  // first load - all messages
                  $("body").addClass("onprogress");
                   $.ajax({
                      url: url,
                      dataType: 'json',
                      error: function() {
                          $("body").removeClass("onprogress");
                          alert("<?= __('Could Load your messages') ?>");
                      },
                      success: function(resp) {
                        if(resp.ok) {
                          InboxThread.cursor = resp.cursor;
                          
                          if(origin == 3) {
                            //loading older
                            var old_height = $(document).height();
                            var old_scroll = $(window).scrollTop();
                            $('#inbox-conversation').prepend(resp.content);
                            $(document).scrollTop(old_scroll + $(document).height() - old_height);
                          } else {
                            //default loading
                            $('#last-timestamp').val(resp.lasttimestamp);
                            $('#inbox-conversation').append(resp.content);  
                            $('#inbox-thread-title').html(resp.title);
                            InboxThread.scrollToBottom();
                          }
                          if(resp.cursor === null) {
                            $("#inbox-thread-loadmore").hide().css("visibility", "hidden");
                          } else {
                            $("#inbox-thread-loadmore").show().css("visibility", "visible");
                          }
                        } else {
                          alert("Error: " + resp.msg);
                        }
                        InboxThread.hasLoaded = true;
                        InboxThread.isRunningOld = false;
                        $("body").removeClass("onprogress");
                      }
                  }); 
                }
              }
              
              InboxThread.GetPendingMessages = function(url) {
                if(!InboxThread.hasLoaded || InboxThread.isRunning || InboxThread.isRunningOld) {
                  console.log("not loaded yet");
                  return;
                }
                InboxThread.isRunning = true;
                   $.ajax({
                      url: url,
                      dataType: 'json',
                      error: function() {
                          //$("body").removeClass("onprogress");
                          InboxThread.isRunning = false;
                          console.log("errouuu!");
                          $('#inbox-sending-status').hide();
                      },
                      success: function(resp) {
                        $('#inbox-sending-status').hide();
                        if(resp.ok) {
                          
                          if(resp.content) {
                            $('#inbox-conversation').append(resp.content);
                            setTimeout(InboxThread.scrollToBottom(), 200);
                          }
                          
                        } else {
                          alert("Error: " + resp.msg);
                        }
                        $('#last-timestamp').val(resp.lasttimestamp);
                        InboxThread.isRunning = false;
                      }
                  });
              }
              
              InboxThread.SendMessage = function(url, message) {
                $('#inbox-sending-status').show();
                InboxThread.isRunning = true;
                  /* enviando mensagem*/                
                   $.ajax({
                      type: 'POST',
                      url: url,
                      data: { msgSent: message},
                      dataType: 'json',
                      error: function(e) {
                        InboxThread.isRunning = false;
                        $('#inbox-sending-status').hide();
                          console.log("error");
                      },
                      success: function(resp) {
                        $('#inbox-sending-status').hide();
                        InboxThread.isRunning = false;
                        console.log('sucesso');
                      }
                   });
              }
              
              InboxThread.Emoji = function()
              {

                  // Emoji
                  InboxThread.emoji = $("#inbox-input-msg").emojioneArea({
                      saveEmojisAs      : "unicode", // unicode | shortname | image
                      imageType         : "svg", // Default image type used by internal CDN
                      pickerPosition    : 'top',
                      buttonTitle: __("Use the TAB key to insert emoji faster")
                  });

                  // Emoji area input filter
                  InboxThread.emoji[0].emojioneArea.on("drop", function(obj, event) {
                      event.preventDefault();
                  });
              }
              
              
              InboxThread.GetMessages(1, "<?= $ajaxUrl . '&id=' . $thread?>");
              
              $('body').on('click', '#inbox-thread-loadmore', function(e) {
                e.preventDefault();
                if(!InboxThread.cursor) {
                  return;
                }
                var url = '<?= $ajaxUrl . '&id=' . $thread; ?>&cursor=' + InboxThread.cursor + '';
                InboxThread.GetMessages(3, url);
              })
              
              InboxThread.Emoji();
               
              /* Clique no botão enviar mensagem */
              $('#inbox-send-msg').on('click', function(e) {
                e.preventDefault();
                var message = $.trim(InboxThread.emoji[0].emojioneArea.getText());
                if(message != "") {
                  InboxThread.SendMessage("<?= $ajaxSendMessageUrl . '&id=' . $thread ?>", message);
                  message = message.replace(/(?:\r\n|\r|\n)/g, '<br>');
                  var msgContent = "<div class='inbox-direct-chat-msg inbox-msg-mine'>" + 
                        "<div class='inbox-direct-chat-info clearfix'></div>" +
                        "<div class='inbox-direct-chat-text'>"+message+"</div>" + 
                      "</div>";
                    $('#inbox-conversation').append(msgContent);
                    setTimeout(InboxThread.scrollToBottom(),500);
                }
                /*Limpando campo de texto*/
                InboxThread.emoji[0].emojioneArea.setText('');
              });
              
              
              /*função para verificar se possui novas mensagens */
              function checkNewMessages()
              {
                 InboxThread.GetPendingMessages("<?= $ajaxPendingUrl . '&id=' . $thread . '&lasttimestamp=' ?>"+$('#last-timestamp').val());
              }
              
              /* checando se possui novas mensagens */
              setInterval(checkNewMessages, 7000);
            })
        </script>
    </body>
</html>