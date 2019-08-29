/**
 * Inbox Namespane
 */
var Inbox = {};


/**
 * Index
 */
Inbox.Index = function()
{
    $(document).ajaxComplete(function(event, xhr, settings) {
        var rx = new RegExp("(inbox\/[0-9]+(\/)?)$");
        if (rx.test(settings.url)) {
            Inbox.LoadInbox();
        }
    })
}

Inbox.HideChat = function()
{
  $("#inbox-chat-frame").remove();
}

Inbox.cursorChat = "";

/**
 * Load inbox conversations
 */
Inbox.LoadInbox = function()
{
  $('body').on('click', '#inbox-loadmore', function(e) {
    e.preventDefault();
    var cursor = $(this).data("cursor") ? $(this).data("cursor") : '';
    var url = $(this).data("ajaxurl") + '&cursor=' + Inbox.cursorChat + '&loadmore=1';
    Inbox.GetMessages(url);
  })
}

/**
 * Load chat frame
 */
Inbox.Chat = function(url)
{
  $("#inbox-chat-frame").remove();
  $('body').addClass("inbox-open").append('<iframe id="inbox-chat-frame" class="inbox-chat" src=""></iframe>');
  $("#inbox-chat-frame").prop("src", url).show();
}


/**
 * Get all inbox messages
 */
Inbox.GetMessages = function(url) {
  
  $("body").addClass("onprogress");
   $.ajax({
      url: url,
      error: function(err) {
        console.log("error ",err);
          $("body").removeClass("onprogress");
      },
      success: function(resp) {
        var result = resp;        
        if(result.ok) {
          $('#inbox-chat-list').append(result.content);
          $("#inbox-loadmore").attr("data-cursor", result.cursor);
          Inbox.cursorChat = result.cursor;
        } else {
          console.log("error", result);
        }
        $("body").removeClass("onprogress");
      }
  });
}



Inbox.GetChat = function(url) {
  
  $("body").addClass("onprogress");
   $.ajax({
      url: url,
      error: function(err) {
        $("body").removeClass("onprogress");
        alert("could not load chat");
      },
      success: function(resp) {
        if(resp.ok) {
          $('#inbox-threads .direct-chat-messages').append(resp.content);
          $("#inbox-threads").attr("data-cursor", resp.cursor);
          if(resp.title) {
            $('#inbox-threads .box-title').html(resp.title);
          }
          $('#inbox-threads').show();
        } else {
          alert("could not load chat");
        }
        $("body").removeClass("onprogress");
      }
  });
}



Inbox.GetIbox = function(url) {
  
  $("body").addClass("onprogress");
   $.ajax({
      url: url,
      dataType: 'json',
      error: function() {
          $("body").removeClass("onprogress");
          alert("errouuu!");
      },
      success: function(resp) {
        if(resp.ok) {
          $('#inbox-chat-list').append(resp.content);
          $("#inbox-loadmore").attr("data-cursor", resp.cursor);
        } else {
          alert("errouuu aqui!");
        }
        $("body").removeClass("onprogress");
      }
  });
}


/**
 * Lnky users and tags
 */
Inbox.LinkyComments = function()
{
    $(".ac-comment-list-item .comment").not(".js-linky-done")
        .addClass("js-linky-done")
        .linky({
            mentions: true,
            hashtags: true,
            urls: false,
            linkTo:"instagram"
        });
}



Inbox.CommentsForm = function()
{
    var $form = $(".js-setup-schedule-form");

    // Emoji
    var emoji = $("#setup-comments .new-comment-input").emojioneArea({
        saveEmojisAs      : "unicode", // unicode | shortname | image
        imageType         : "svg", // Default image type used by internal CDN
        pickerPosition: 'bottom',
        buttonTitle: __("Use the TAB key to insert emoji faster")
    });

    // Emoji area input filter
    emoji[0].emojioneArea.on("drop", function(obj, event) {
        event.preventDefault();
    });

    emoji[0].emojioneArea.on("paste keyup input emojibtn.click", function() {
        $form.find(":input[name='new-comment-input']").val(emoji[0].emojioneArea.getText());
    });

    // Linky
    Setup.LinkyComments();

    // Add comment
    $("#setup-comments .js-add-new-comment-btn").on("click", function() {
        var comment = $.trim(emoji[0].emojioneArea.getText());

        if (comment) {
            $comment = $("<div class='ac-comment-list-item'></div>");
            $comment.append('<a href="javascript:void(0)" class="remove-comment-btn mdi mdi-close-circle"></a>');
            $comment.append("<span class='comment'></span>");
            $comment.find(".comment").text(comment);

            $comment.data("comment", comment);

            // Replace new lines to <br>
            comment = $comment.find(".comment").text();
            comment = comment.replace(/(?:\r\n|\r|\n)/g, '<br>');
            $comment.find(".comment").html(comment);

            $comment.prependTo(".ac-comment-list");

            Setup.LinkyComments();

            emoji[0].emojioneArea.setText("");
        }
    });
  
    // Remove message
    $("body").on("click", "#setup-comments .remove-message-btn", function() {
        $(this).parents(".wdm-message-list-item").remove();
    });

}