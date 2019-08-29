/**
 * AutoComment Namespane
 */
var AutoComment = {};



/**
 * Lnky users and tags
 */
AutoComment.Linky = function()
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


/**
 * AutoComment Schedule Form
 */
AutoComment.ScheduleForm = function()
{
    var $Form_duplicate = $(".js-auto-comment-duplicate-form");
    var $form = $(".js-auto-comment-schedule-form");
    var $searchinp = $form.find(":input[name='search']");
    var query;
    var icons = {};
        icons.hashtag = "mdi mdi-pound";
        icons.location = "mdi mdi-map-marker";
        icons.people = "mdi mdi-instagram";
    var target = [];

    // Current tags
    $form.find(".tag").each(function() {
        target.push($(this).data("type") + "-" + $(this).data("id"));
    });

    // Search auto complete for targeting
    $searchinp.devbridgeAutocomplete({
        serviceUrl: $searchinp.data("url"),
        type: "GET",
        dataType: "jsonp",
        minChars: 2,
        deferRequestBy: 200,
        appendTo: $form,
        forceFixPosition: true,
        paramName: "q",
        params: {
            action: "search",
            type: $form.find(":input[name='type']:checked").val(),
        },
        onSearchStart: function() {
            $form.find(".js-search-loading-icon").removeClass('none');
            query = $searchinp.val();
        },
        onSearchComplete: function() {
            $form.find(".js-search-loading-icon").addClass('none');
        },

        transformResult: function(resp) {
            return {
                suggestions: resp.result == 1 ? resp.items : []
            };
        },

        beforeRender: function (container, suggestions) {
            for (var i = 0; i < suggestions.length; i++) {
                var type = $form.find(":input[name='type']:checked").val();
                if (target.indexOf(type + "-" + suggestions[i].data.id) >= 0) {
                    container.find(".autocomplete-suggestion").eq(i).addClass('none')
                }
            }
        },

        formatResult: function(suggestion, currentValue){
            var pattern = '(' + currentValue.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&") + ')';
            var type = $form.find(":input[name='type']:checked").val();

            return suggestion.value
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
            var type = $form.find(":input[name='type']:checked").val();

            if (target.indexOf(type+"-"+suggestion.data.id) >= 0) {
                return false;
            }
            
            var $tag = $("<span style='margin: 0px 2px 3px 0px'></span>");
                $tag.addClass("tag pull-left preadd");
                $tag.attr({
                    "data-type": type,
                    "data-id": suggestion.data.id,
                    "data-value": suggestion.value,
                });
                $tag.text(suggestion.value);

                $tag.prepend("<span class='icon "+icons[type]+"'></span>");
                $tag.append("<span class='mdi mdi-close remove'></span>");

            $tag.appendTo($form.find(".tags"));

            setTimeout(function(){
                $tag.removeClass("preadd");
            }, 50);

            target.push(type+ "-" + suggestion.data.id);
        }
    });


    // Change search source
    $form.find(":input[name='type']").on("change", function() {
        var type = $form.find(":input[name='type']:checked").val();

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
    $form.on("click", ".tag .remove", function() {
        var $tag = $(this).parents(".tag");

        var index = target.indexOf($tag.data("type") + "-" + $tag.data("id"));
        if (index >= 0) {
            target.splice(index, 1);
        }

        $tag.remove();
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


    // Submit the form
    $form.on("submit", function() {
        $("body").addClass("onprogress");

        var target = [];

        $form.find(".tags .tag").each(function() {
            var t = {};
                t.type = $(this).data("type");
                t.id = $(this).data("id").toString();
                t.value = $(this).data("value");

            target.push(t);
        });

        $.ajax({
            url: $form.attr("action"),
            type: $form.attr("method"),
            dataType: 'jsonp',
            data: {
                action: "save",
                target: JSON.stringify(target),
                speed: $form.find(":input[name='speed']").val(),
                is_active: $form.find(":input[name='is_active']").val(),
                daily_pause: $form.find(":input[name='daily-pause']").is(":checked") ? 1 : 0,
                daily_pause_from: $form.find(":input[name='daily-pause-from']").val(),
                daily_pause_to: $form.find(":input[name='daily-pause-to']").val(),
                timeline_feed: $form.find(":input[name='timeline-feed']").is(":checked") ? 1 : 0
            },
            error: function() {
                $("body").removeClass("onprogress");
                NextPost.DisplayFormResult($form, "error", __("Oops! An error occured. Please try again later!"));
            },

            success: function(resp) {
                if (resp.result == 1) {
                    NextPost.DisplayFormResult($form, "success", resp.msg);
                } else {
                    NextPost.DisplayFormResult($form, "error", resp.msg);
                }

                $("body").removeClass("onprogress");
            }
        });

        return false;
    });

    $Form_duplicate.on("submit", function() {
        // console.log($Form_duplicate.find("[name='select_user']").val());
        $("body").addClass("onprogress");

        var target = [];

        $Form_duplicate.find(".tags .tag").each(function() {
            var t = {};
                t.type = $(this).data("type");
                t.id = $(this).data("id").toString();
                t.value = $(this).data("value");

            target.push(t);
        });
        var duplicate = $Form_duplicate.find("[name='select_user']").val();
        $.ajax({
            url: $Form_duplicate.attr("action"),
            type: $Form_duplicate.attr("method"),
            dataType: 'jsonp',
            data: {
                action: "save",
                duplicate: duplicate,
                duplicate_target: $Form_duplicate.find(":input[name='duplicate-target']").is(":checked") ? 1 : 0,

            },
            error: function() {
                $("body").removeClass("onprogress");
                NextPost.DisplayFormResult($Form_duplicate, "error", __("Oops! An error occured. Please try again later!"));
            },

            success: function(resp) {
                if (resp.result == 1) {
                    NextPost.DisplayFormResult($Form_duplicate, "success", resp.msg);
                } else {
                    NextPost.DisplayFormResult($Form_duplicate, "error", resp.msg);
                }

                $("body").removeClass("onprogress");
            }
        });

        return false;
    });
   
}



AutoComment.CommentsForm = function()
{
    var $form = $(".js-auto-comment-comments-form");

    // Emoji
    var emoji = $(".new-comment-input").emojioneArea({
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
    AutoComment.Linky();

    // Add comment
    $(".js-add-new-comment-btn").on("click", function() {
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

            AutoComment.Linky();

            emoji[0].emojioneArea.setText("");
        }
    });


    // Submit the form
    $form.on("submit", function() {
        $("body").addClass("onprogress");

        var comments = [];
        $form.find(".ac-comment-list-item").each(function() {
            comments.push($(this).data("comment"));
        })

        $.ajax({
            url: $form.attr("action"),
            type: $form.attr("method"),
            dataType: 'jsonp',
            data: {
                action: "save",
                comments: JSON.stringify(comments)
            },
            error: function() {
                $("body").removeClass("onprogress");
                NextPost.DisplayFormResult($form, "error", __("Oops! An error occured. Please try again later!"));
            },

            success: function(resp) {
                if (resp.result == 1) {
                    NextPost.DisplayFormResult($form, "success", resp.msg);
                } else {
                    NextPost.DisplayFormResult($form, "error", resp.msg);
                }

                $("body").removeClass("onprogress");
            }
        });

        return false;
    });

    
}




/**
 * Auto Comment Index
 */
AutoComment.Index = function()
{
    $(document).ajaxComplete(function(event, xhr, settings) {
        var rx = new RegExp("(auto-comment\/[0-9]+(\/)?)$");
        if (rx.test(settings.url)) {
            AutoComment.ScheduleForm();
            AutoComment.CommentsForm();
        }
    });

    // Remove comment
    $("body").on("click", ".remove-comment-btn", function() {
        $(this).parents(".ac-comment-list-item").remove();
    })
}

function openSettings(evt) {
    
    let setting = $("#speed-select").val();
    // Declare all variables
    var i, tabcontent, tablinks;
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(setting).style.display = "block";
    evt.currentTarget.className += " active";
  }