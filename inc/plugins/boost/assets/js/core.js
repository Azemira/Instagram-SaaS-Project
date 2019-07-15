/**
 * Boost Namespane
 */
var Boost = {};

Boost.isSaving = false;

/**
 * Boost Schedule Form
 */
Boost.ScheduleForm = function()
{  
  var $form = $(".js-boost-schedule-form");
  var elem;
  var init;
  
  Boost.CopyPaste();
  
  /*$('body').on('click', '.js-boost-schedule-form .tag .remove, .js-boost-schedule-form .remove-message-btn, .js-boost-schedule-form .remove-comment-btn, .js-boost-schedule-form .js-add-new-comment-btn', function() {
    Boost.DanAutoSave();
  });
  $form.find(".tag .remove, .remove-message-btn, .js-add-new-message-btn, .remove-comment-btn, .js-add-new-comment-btn").on("click", function() {
    alert("a");
    Boost.DanAutoSave();
  });*/
  
  $form.find("[type=checkbox], select").on("change", function() {
    Boost.DanAutoSave();
  });
  
  if($("#action_follow_switch").length) {
      elem = document.querySelector("#action_follow_switch");
      init = new Switchery(elem);
  }
  if($("#action_unfollow_switch").length) {
      elem = document.querySelector("#action_unfollow_switch");
      init = new Switchery(elem);
  }
  if($("#action_like_switch").length) {
      elem = document.querySelector("#action_like_switch");
      init = new Switchery(elem);
  }
  if($("#action_comment_switch").length) {
      elem = document.querySelector("#action_comment_switch");
      init = new Switchery(elem);
  }
  if($("#action_viewstory_switch").length) {
      elem = document.querySelector("#action_viewstory_switch");
      init = new Switchery(elem);
  }
  if($("#action_welcomedm_switch").length) {
      elem = document.querySelector("#action_welcomedm_switch");
      init = new Switchery(elem);
  }
  

    var $searchinp = $form.find("#boost-source :input[name='search']");
    var query;
    var icons = {};
        icons.hashtag = "mdi mdi-pound";
        icons.location = "mdi mdi-map-marker";
        icons.people = "mdi mdi-instagram";
    var target = [];

    // Current tags
    $form.find("#boost-source .tag").each(function() {
        target.push($(this).data("type") + "-" + $(this).data("id"));
    });

    // Search input
    $searchinp.devbridgeAutocomplete({
        serviceUrl: $searchinp.data("url"),
        type: "GET",
        dataType: "jsonp",
        minChars: 2,
        deferRequestBy: 200,
        appendTo: ".wrap-search-targets",
        forceFixPosition: true,
        paramName: "q",
        params: {
            action: "search",
            type: $form.find("#boost-source :input[name='type']:checked").val(),
        },
        onSearchStart: function() {
            $form.find("#boost-source .js-search-loading-icon").removeClass('none');
            query = $searchinp.val();
            $('#boost-source .resultSearch').text(Boost.in18.searching);
        },
        onSearchComplete: function() {
            $('#boost-source .resultSearch').text('');
            $form.find("#boost-source .js-search-loading-icon").addClass('none');
        },

        transformResult: function(resp) {
          resp.login_required>0?(setTimeout(function(){$("#boost-source .resultSearch").text(Boost.in18.no_result)},100),$.confirm({title:resp.title,content:resp.msg,theme:"supervan",animation:"opacity",closeAnimation:"opacity",buttons:{btn1:{text:resp.links[0].label,btnClass:"small button button--oval mr-5 mb-10",action:function(){$("body").addClass("onprogress"),window.location.href=resp.links[0].uri}}}})):resp.items.length<=0&&setTimeout(function(){$("#boost-source .resultSearch").text(Boost.in18.no_result)},100);
            return {
                suggestions: resp.result == 1 ? resp.items : []
            };
        },

        beforeRender: function (container, suggestions) {
            for (var i = 0; i < suggestions.length; i++) {
                var type = $form.find("#boost-source :input[name='type']:checked").val();
                if (target.indexOf(type + "-" + suggestions[i].data.id) >= 0) {
                    container.find("#boost-source .autocomplete-suggestion").eq(i).addClass('none')
                }
            }
        },

        formatResult: function(suggestion, currentValue){
            var pattern = '(' + currentValue.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&") + ')';
            var type = $form.find("#boost-source :input[name='type']:checked").val();

            return (suggestion.data.img ? "<span class='boost-sc-img img pull-left'><img src='"+suggestion.data.img+"'></span>" : '') + suggestion.value
                        .replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>')
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .replace(/&lt;(\/?strong)&gt;/g, '<$1>') + 
                    (suggestion.data.sub ? "<span class='sub'>"+suggestion.data.sub+"<span>" : "");
        },

        onSelect: function(suggestion){ 
            $searchinp.val(query);
            var type = $form.find("#boost-source :input[name='type']:checked").val();

            if (target.indexOf(type+"-"+suggestion.data.id) >= 0) {
                return false;
            }
            
            var $tag = $("<span style='margin: 0px 2px 3px 0px' title='"+suggestion.data.sub+"'></span>");
                $tag.addClass("tag pull-left preadd");
                $tag.attr({
                    "data-type": type,
                    "data-id": suggestion.data.id,
                    "data-value": suggestion.value,
                });
                $tag.text(suggestion.value);

                $tag.prepend("<span class='icon "+icons[type]+"'></span>");
                $tag.append("<span class='mdi mdi-close remove'></span>");

            $tag.appendTo($form.find("#boost-source .tags"));

            setTimeout(function(){
                $tag.removeClass("preadd");
                Boost.DanAutoSave();
            }, 50);

            target.push(type+ "-" + suggestion.data.id);
        }
    });


    // Change search source
    $form.find("#boost-source :input[name='type']").on("change", function() {
        var type = $form.find("#boost-source :input[name='type']:checked").val();

        $searchinp.autocomplete('setOptions', {
            params: {
                action: "search",
                type: type
            }
        });

        $searchinp.trigger("blur");
        setTimeout(function(){
            $searchinp.trigger("focus");
        }, 200)
    });

    // Remove target
    $form.on("click", "#boost-source .tag .remove", function() {
        var $tag = $(this).parents(".tag");

        var index = target.indexOf($tag.data("type") + "-" + $tag.data("id"));
        if (index >= 0) {
            target.splice(index, 1);
        }

        $tag.remove();
        Boost.DanAutoSave();
    });

    // Daily pause
    $form.find(":input[name='daily-pause']").on("change", function() {
        if ($(this).is(":checked")) {
            $form.find(".js-daily-pause-range").css("opacity", "1");
            $form.find(".js-daily-pause-range").find(":input").prop("disabled", false);
        } else {
            $form.find(".js-daily-pause-range").css("opacity", "0.25");
            $form.find(".js-daily-pause-range").find(":input").prop("disabled", true);
        }
    }).trigger("change");
  
  
    //unfollow whitelist
    var $searchinpWhitelist = $form.find("#boost-unfollow :input[name='search']");
    var whitelist = [];

    // Current tags
    $form.find("#boost-unfollow .tag").each(function() {
        whitelist.push('' + $(this).data("id"));
    });


    // Search input
    $searchinpWhitelist.devbridgeAutocomplete({
        serviceUrl: $searchinp.data("url"),
        type: "GET",
        dataType: "jsonp",
        minChars: 2,
        deferRequestBy: 200,
        appendTo: ".wrap-whitelist-targets",
        forceFixPosition: true,
        paramName: "q",
        params: {
            action: "search",
            type: "people"
        },
        onSearchStart: function() {
            $form.find("#boost-unfollow .js-search-loading-icon").removeClass('none');
            query = $searchinpWhitelist.val();
            $('#boost-unfollow .resultSearch').text(Boost.in18.searching);
        },
        onSearchComplete: function() {
            $form.find("#boost-unfollow .js-search-loading-icon").addClass('none');
            $('#boost-unfollow .resultSearch').text('');
        },

        transformResult: function(resp) {
          resp.login_required>0?(setTimeout(function(){$("#boost-unfollow .resultSearch").text(Boost.in18.no_result)},100),$.confirm({title:resp.title,content:resp.msg,theme:"supervan",animation:"opacity",closeAnimation:"opacity",buttons:{btn1:{text:resp.links[0].label,btnClass:"small button button--oval mr-5 mb-10",action:function(){$("body").addClass("onprogress"),window.location.href=resp.links[0].uri}}}})):resp.items.length<=0&&setTimeout(function(){$("#boost-unfollow .resultSearch").text(Boost.in18.no_result)},100);
            return {
                suggestions: resp.result == 1 ? resp.items : []
            };
        },

        beforeRender: function (container, suggestions) {
            for (var i = 0; i < suggestions.length; i++) {
                if (whitelist.indexOf('' + suggestions[i].data.id) >= 0) {
                    container.find("#boost-unfollow .autocomplete-suggestion").eq(i).addClass('none')
                }
            }
        },

        formatResult: function(suggestion, currentValue){
            var pattern = '(' + currentValue.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&") + ')';

            return (suggestion.data.img ? "<span class='boost-sc-img img pull-left'><img src='"+suggestion.data.img+"'></span>" : '') + suggestion.value
                        .replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>')
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .replace(/&lt;(\/?strong)&gt;/g, '<$1>') + 
                    (suggestion.data.sub ? "<span class='sub'>"+suggestion.data.sub+"<span>" : "");
        },

        onSelect: function(suggestion){ 
            $searchinpWhitelist.val(query);

            if (whitelist.indexOf('' + suggestion.data.id) >= 0) {
                return false;
            }
            
            var $tag = $("<span style='margin: 0px 2px 3px 0px' title='"+suggestion.data.sub+"'></span>");
                $tag.addClass("tag pull-left preadd");
                $tag.attr({
                    "data-id": ''+suggestion.data.id,
                    "data-value": suggestion.value,
                });
                $tag.text(suggestion.value);

                $tag.prepend("<span class='icon mdi mdi-instagram'></span>");
                $tag.append("<span class='mdi mdi-close remove'></span>");

            $tag.appendTo($form.find("#boost-unfollow .whitelist"));

            setTimeout(function(){
                $tag.removeClass("preadd");
              Boost.DanAutoSave();
            }, 50);

            whitelist.push('' + suggestion.data.id);
        }
    });


    // Remove tag
    $form.on("click", "#boost-unfollow .tag .remove", function() {
        var $tag = $(this).parents(".tag");

        var index = whitelist.indexOf(''+$tag.data("id"));
        if (index >= 0) {
            whitelist.splice(index, 1);
        }

        $tag.remove();
        Boost.DanAutoSave();
    });
  
  
  
    //unfollow whitelist
    var $searchinpBlacklist = $form.find("#boost-blacklist :input[name='search']");
    var blacklist = [];

    // Current tags
    $form.find("#boost-blacklist .tag").each(function() {
        whitelist.push('' + $(this).data("id"));
    });


    // Search input
    $searchinpBlacklist.devbridgeAutocomplete({
        serviceUrl: $searchinp.data("url"),
        type: "GET",
        dataType: "jsonp",
        minChars: 2,
        deferRequestBy: 200,
        appendTo: ".wrap-blacklist-targets",
        forceFixPosition: true,
        paramName: "q",
        params: {
            action: "search",
            type: "people"
        },
        onSearchStart: function() {
            $form.find("#boost-blacklist .js-search-loading-icon").removeClass('none');
            query = $searchinpWhitelist.val();
            $('#boost-blacklist .resultSearch').text(Boost.in18.searching);
        },
        onSearchComplete: function() {
            $form.find("#boost-blacklist .js-search-loading-icon").addClass('none');
            $('#boost-blacklist .resultSearch').text('');
        },

        transformResult: function(resp) {
          resp.login_required>0?(setTimeout(function(){$("#boost-blacklist .resultSearch").text(Boost.in18.no_result)},100),$.confirm({title:resp.title,content:resp.msg,theme:"supervan",animation:"opacity",closeAnimation:"opacity",buttons:{btn1:{text:resp.links[0].label,btnClass:"small button button--oval mr-5 mb-10",action:function(){$("body").addClass("onprogress"),window.location.href=resp.links[0].uri}}}})):resp.items.length<=0&&setTimeout(function(){$("#boost-blacklist .resultSearch").text(Boost.in18.no_result)},100);
            return {
                suggestions: resp.result == 1 ? resp.items : []
            };
        },

        beforeRender: function (container, suggestions) {
            for (var i = 0; i < suggestions.length; i++) {
                if (whitelist.indexOf('' + suggestions[i].data.id) >= 0) {
                    container.find("#boost-blacklist .autocomplete-suggestion").eq(i).addClass('none')
                }
            }
        },

        formatResult: function(suggestion, currentValue){
            var pattern = '(' + currentValue.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&") + ')';

return (suggestion.data.img ? "<span class='boost-sc-img img pull-left'><img src='"+suggestion.data.img+"'></span>" : '') + suggestion.value
                        .replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>')
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .replace(/&lt;(\/?strong)&gt;/g, '<$1>') + 
                    (suggestion.data.sub ? "<span class='sub'>"+suggestion.data.sub+"<span>" : "");
        },

        onSelect: function(suggestion){ 
            $searchinpBlacklist.val(query);

            if (blacklist.indexOf('' + suggestion.data.id) >= 0) {
                return false;
            }
            
            var $tag = $("<span style='margin: 0px 2px 3px 0px' title='"+suggestion.data.sub+"'></span>");
                $tag.addClass("tag pull-left preadd");
                $tag.attr({
                    "data-id": ''+suggestion.data.id,
                    "data-value": suggestion.value,
                });
                $tag.text(suggestion.value);

                $tag.prepend("<span class='icon mdi mdi-instagram'></span>");
                $tag.append("<span class='mdi mdi-close remove'></span>");

            $tag.appendTo($form.find("#boost-blacklist .blacklist"));

            setTimeout(function(){
                $tag.removeClass("preadd");
              Boost.DanAutoSave();
            }, 50);

            blacklist.push('' + suggestion.data.id);
        }
    });


    // Remove tag
    $form.on("click", "#boost-blacklist .tag .remove", function() {
        var $tag = $(this).parents(".tag");

        var index = blacklist.indexOf(''+$tag.data("id"));
        if (index >= 0) {
            blacklist.splice(index, 1);
        }

        $tag.remove();
      Boost.DanAutoSave();
    });
  
    $form.on("submit", function(evt) {
      evt.preventDefault();
      Boost.submitBoostForm(false);
    });
    
}

Boost.submitBoostForm = function(autosave) {
    var $form = $(".js-boost-schedule-form");


      Boost.isSaving = true;
      if(autosave !== true) {
        $("body").addClass("onprogress");
      }
        

        var target    = [];
        var whitelist = [];
        var blacklist = [];
        var comments  = [];
        var messages  = [];
        var modules = [];
      

        $form.find("#boost-actions .stats_plugin_list").each(function() {
            var t = {};
                t.module = $(this).data("plugin");
                t.value = $(this).attr("checked") ? 1 : 0;
            modules.push(t);
        });


        $form.find("#boost-source .tags .tag").each(function() {
            var t = {};
                t.type = $(this).data("type");
                t.id = $(this).data("id").toString();
                t.value = $(this).data("value");

            target.push(t);
        });
      
        $form.find("#boost-unfollow .whitelist .tag").each(function() {
            var t = {};
                t.id = $(this).data("id").toString();
                t.value = $(this).data("value");

            whitelist.push(t);
        });
      
      $form.find("#boost-blacklist .blacklist .tag").each(function() {
            var t = {};
                t.id = $(this).data("id").toString();
                t.value = $(this).data("value");

            blacklist.push(t);
        });
      
        $form.find(".ac-comment-list-item").each(function() {
            comments.push($(this).data("comment"));
        });
      
        $form.find(".wdm-message-list-item").each(function() {
            messages.push($(this).data("message"));
           // messages.push($(this).html());
        });

        $.ajax({
            url: $form.attr("action"),
            type: $form.attr("method"),
            dataType: 'jsonp',
            data: {
                action: "save",
                is_active: 1,
                target: JSON.stringify(target),
                action_follow: $form.find(":input[name='action_follow']").is(":checked") ? 1 : 0,
                action_unfollow: $form.find(":input[name='action_unfollow']").is(":checked") ? 1 : 0,
                action_like: $form.find(":input[name='action_like']").is(":checked") ? 1 : 0,
                action_comment: $form.find(":input[name='action_comment']").is(":checked") ? 1 : 0,
                action_viewstory: $form.find(":input[name='action_viewstory']").is(":checked") ? 1 : 0,
                action_welcomedm: $form.find(":input[name='action_welcomedm']").is(":checked") ? 1 : 0,
                speed: $form.find(":input[name='speed']").val(),
                daily_pause: $form.find(":input[name='daily-pause']").is(":checked") ? 1 : 0,
                daily_pause_from: $form.find(":input[name='daily-pause-from']").val(),
                daily_pause_to: $form.find(":input[name='daily-pause-to']").val(),
                timeline_feed: $form.find(":input[name='timeline-feed']").is(":checked") ? 1 : 0,
                follow_cicle: $form.find(":input[name='follow-cicle']").val(),
                gender: $form.find(":input[name='gender']").val(),
                ignore_private: $form.find(":input[name='ignore_private']").val(),
                has_picture: $form.find(":input[name='has_picture']").val(),
                business: $form.find(":input[name='business']").val(),
                nfsw: $form.find(":input[name='nfsw']").is(":checked") ? 1 : 0,
                black_keywords: $form.find(":input[name='black-keywords']").val(),
                modules: JSON.stringify(modules),
                whitelist: JSON.stringify(whitelist),
                blacklist: JSON.stringify(blacklist),
                keep_followers: $form.find("#boost-unfollow :input[name='keep-followers']").is(":checked") ? 1 : 0,
                unfollow_all: $form.find("#boost-unfollow :input[name='unfollow_all']").is(":checked") ? 1 : 0,
                source: $form.find("#boost-unfollow :input[name='source']").val(),
                follow_plus_like_limit: $form.find(":input[name='follow-plus-like-limit']").val(),
                follow_plus_like: $form.find(":input[name='follow-plus-like']").val(),
                follow_plus_mute_type: $form.find(":input[name='follow-plus-mute-type']").val(),
                follow_plus_mute: $form.find(":input[name='follow-plus-mute']").val(),


                comments: JSON.stringify(comments),
                messages: JSON.stringify(messages)
            },
            error: function() {
                $("body").removeClass("onprogress");
                if(autosave !== true) {
                  NextPost.DisplayFormResult($form, "error", __("Oops! An error occured. Please try again later!"));
                }
                Boost.isSaving = false;
            },

            success: function(resp) {
              if(autosave === true) {
              } else {
                if (resp.result == 1) {
                    NextPost.DisplayFormResult($form, "success", resp.msg);
                } else {
                    NextPost.DisplayFormResult($form, "error", resp.msg);
                }
                $("body").removeClass("onprogress"); 
              }
              Boost.isSaving = false
            }
        });
        return false;
  
}

Boost.DanAutoSave = function()
{
  var $form = $(".js-boost-schedule-form");
  
  if(!$form.length || Boost.isSaving) {
    return;
  }
  Boost.submitBoostForm(true);
}

Boost.CopyPaste = function()
{
    // Colar e Copiar
    if ($("#boost-copy").length > 0) {
        if (typeof(Storage) !== "undefined") {
            $("#boost-copy").off('click');
            $("#boost-copy").on('click', function(){
                localStorage.setItem("parameters", $('.pasteBox').html());
            })
            $("#boost-paste").off('click');
            $("#boost-paste").on('click', function(){
                $('.pasteBox').html(localStorage.getItem("parameters"));
                Boost.DanAutoSave();
            })
        } else {
            $("#boost-copy, #boost-paste").hide();
        }   
    }
}



/**
 * boost Index
 */
Boost.Index = function()
{
    $(document).ajaxComplete(function(event, xhr, settings) {
        var rx = new RegExp("(boost\/[0-9]+(\/)?)$");
        if (rx.test(settings.url)) {
            Boost.ScheduleForm();
            Boost.CommentsForm();
            Boost.MessagesForm();
        }
    })
}



/**
 * Lnky users and tags
 */
Boost.LinkyComments = function()
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

Boost.CommentsForm = function()
{
    var $form = $(".js-boost-schedule-form");

    // Emoji
    var emoji = $("#boost-comments .new-comment-input").emojioneArea({
        saveEmojisAs      : "unicode", // unicode | shortname | image
        imageType         : "svg", // Default image type used by internal CDN
        pickerPosition: 'bottom',
        buttonTitle: __("Use the TAB key to insert emoji faster")
    });
  
    $form.find(".field-tips #comment_get_first_name").on("click", function() {      
        $('#boost-comments .emojionearea-editor').append(' {{first_name}} ');
    });
  
    $form.find(".field-tips #comment_get_username").on("click", function() {      
        $('#boost-comments .emojionearea-editor').append(' {{username}} ');
    });
  
    $form.find(".field-tips #comment_get_full_name").on("click", function() {      
        $('#boost-comments .emojionearea-editor').append(' {{full_name}} ');
    });

    // Emoji area input filter
    emoji[0].emojioneArea.on("drop", function(obj, event) {
        event.preventDefault();
    });

    emoji[0].emojioneArea.on("paste keyup input emojibtn.click", function() {
        $form.find(":input[name='new-comment-input']").val(emoji[0].emojioneArea.getText());
    });

    // Linky
    Boost.LinkyComments();

    // Add comment
    $("#boost-comments .js-add-new-comment-btn").on("click", function() {
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

            Boost.LinkyComments();

            emoji[0].emojioneArea.setText("");
          
            Boost.DanAutoSave();
        }
    });
  
    // Remove message
    $("body").on("click", "#boost-comments .remove-comment-btn", function() {
      $(this).parents(".ac-comment-list-item").remove();
      Boost.DanAutoSave();
    });

}


/**
 * Lnky users and tags
 */
Boost.LinkyDM = function()
{
    $(".wdm-message-list-item .message").not(".js-linky-done")
        .addClass("js-linky-done")
        .linky({
            mentions: true,
            hashtags: true,
            urls: false,
            linkTo:"instagram"
        });
}

Boost.MessagesForm = function()
{
    var $form = $(".js-boost-schedule-form");

    // Linky
    Boost.LinkyDM();

    // Emoji
    var emoji = $("#boost-welcomedm .new-message-input").emojioneArea({
        saveEmojisAs      : "unicode", // unicode | shortname | image
        imageType         : "svg", // Default image type used by internal CDN
        pickerPosition: 'bottom',
        buttonTitle: __("Use the TAB key to insert emoji faster")
    });
  
    $form.find(".field-tips #dm_get_first_name").on("click", function() {      
        $('#boost-welcomedm .emojionearea-editor').append(' {{first_name}} ');
    });
  
    $form.find(".field-tips #dm_get_username").on("click", function() {      
        $('#boost-welcomedm .emojionearea-editor').append(' {{username}} ');
    });
  
    $form.find(".field-tips #dm_get_full_name").on("click", function() {      
        $('#boost-welcomedm .emojionearea-editor').append(' {{full_name}} ');
    });

    // Emoji area input filter
    emoji[0].emojioneArea.on("drop", function(obj, event) {
        event.preventDefault();
    });

    emoji[0].emojioneArea.on("paste keyup input emojibtn.click", function() {
        $form.find("#boost-welcomedm :input[name='new-message-input']").val(emoji[0].emojioneArea.getText());
    });

    // Add message
    $("#boost-welcomedm .js-add-new-message-btn").on("click", function() {
        var message = $.trim(emoji[0].emojioneArea.getText());
      
        if (message) {
            $message = $("<div class='wdm-message-list-item'></div>");
            $message.append('<a href="javascript:void(0)" class="remove-message-btn mdi mdi-close-circle"></a>');
            $message.append("<span class='message'></span>");
            $message.find(".message").text(message);

            $message.data("message", message);

            // Replace new lines to <br>
            message = $message.find(".message").text();
            message = message.replace(/(?:\r\n|\r|\n)/g, '<br>');
            $message.find(".message").html(message);

            $message.prependTo(".wdm-message-list");

            Boost.LinkyDM();

            emoji[0].emojioneArea.setText("");
          
            Boost.DanAutoSave();
        }
      
    });
  
    // Remove message
    $("body").on("click", "#boost-welcomedm .remove-message-btn", function() {
        $(this).parents(".wdm-message-list-item").remove();
        Boost.DanAutoSave();
    });
}


Boost.showDebug = function()
{
  $(document).on("click", ".boost-debug", function(e) {
    e.preventDefault();
    var id = '#' + $(this).data("id");
    $(id).toggle();
  })
  
}
