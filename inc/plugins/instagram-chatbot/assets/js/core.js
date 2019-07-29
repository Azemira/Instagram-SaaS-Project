(function() {
    
    console.log('test');
    function modal() {
    // Get the modal
    var modal = document.getElementById('myModal');
    // Get the main container and the body
    var body = document.getElementsByTagName('body');
    // Get the open button
    var btnOpen = document.getElementById("myBtn");
    // Get the close button
    var btnClose = document.getElementById("closeModal");
    // Open the modal
    btnOpen.onclick = function() {
        modal.className = "Modal is-visuallyHidden";
        setTimeout(function() {
        modal.className = "Modal";
        }, 100);
    }
    // Close the modal
    btnClose.onclick = function() {
        modal.className = "Modal is-hidden is-visuallyHidden";
        body.className = "";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.className = "Modal is-hidden";
            body.className = "";
        }
    }
}
     var $form = '';
    setTimeout(() => {
        $form = $(".js-chatbot-message-form");
        modal();
        form_submit();
        // emojiLoad('meessageedit');
        emojiLoad('.meessageinput');
        enableInputField();
        messageUpdate();
        messageDelete();
        settings_form();
        document.getElementById("chatbot-messages-tab-button").click();
        messagesOrderEvents();
    }, 1000);

})();
    // Submit the form
    function form_submit() {
        var $form = '';
        $form = $(".js-chatbot-message-form");
        $form.on("submit", function() {
            event.preventDefault();
        
            var message = $(".meessageinput")[0].emojioneArea.getText()
            function unicodeEscape(str) {
            for (var result = '', index = 0, charCode; !isNaN(charCode = str.charCodeAt(index++));) {
                result += '\\u' + ('0000' + charCode.toString(16)).slice(-4);
            }
            return result;
            }
            message = unicodeEscape(message);
            $.ajax({
                url: $form.attr("action"),
                type: 'POST',
                dataType: 'jsonp',
                data: {
                    action: "save", title: "hello", message : message
                },
                error: function(resp) {
          
                },
                success: function(resp) {
                    console.log(resp);
                    console.log('success save');
                    insertNewMessage(resp.message, resp.id, true, resp.order);
                    enableInputField();
                    messageUpdate();
                    messageDelete();
                    $('#closeModal').click();
                    checkFirstAndLastElement();
                    setTimeout(() => {
                        checkiFNotFirstOrLastElement();
                    }, 500);
                }
            });
    
            return false;
        });
    }

function enableInputField(){
    $(".chatbot-message-item").each(function(i){
        $(this).click(function(){
            $('#'+this.id+'-editor').attr( "contenteditable","true" );
            // $(this).next().show();
            $(this).next().addClass('button');
            emojiLoad('#'+this.id+'-editor');
            // console.log($(this).next().css( "display", "inline-block !important" ));
        });
    });
  }
   //    // Emoji
   function emojiLoad(emoji) {
    var emoji = $(emoji).emojioneArea({
        saveEmojisAs      : "unicode", // unicode | shortname | image
        tonesStyle: "radio",
        pickerPosition: 'bottom',
        buttonTitle: "Use the TAB key to insert emoji faster"
    });
    var $form = '';
    $form = $(".js-chatbot-message-form");

    // Emoji area input filter
    emoji[0].emojioneArea.on("drop", function(obj, event) {
        event.preventDefault();
    });

    emoji[0].emojioneArea.on("paste keyup input emojibtn.click", function() {
        $form.find(":input[name='new-comment-input']").val(emoji[0].emojioneArea.getText());
    });
}
function messageUpdate() {
    $(".message-update-submit").each(function(i){
        $(this).click(function(){
            event.preventDefault();
            var $form = '';
            $form = $(".js-chatbot-message-form");
            var message = $("#message-"+this.id+"-editor")[0].emojioneArea.getText()
            function unicodeEscape(str) {
            for (var result = '', index = 0, charCode; !isNaN(charCode = str.charCodeAt(index++));) {
                result += '\\u' + ('0000' + charCode.toString(16)).slice(-4);
            }
            return result;
            }
            let identifier = this.id;
            message = unicodeEscape(message);
            console.log($form.attr("action"));
          
            $.ajax({
                // url: '/chatbot/message/new',
                url: $form.attr("action"),
                type: 'POST',
                dataType: 'jsonp',
                data: {
                    action: "update", title: "hello", message : message, id : identifier
                },
                error: function(resp) {
          
                },
                success: function(resp) {
                   
                    insertNewMessage(resp.message, resp.id, false, resp.order);
                    enableInputField();
                    messageUpdate();
                    messageDelete();
                    console.log(resp);
                    console.log('success');
                    checkFirstAndLastElement();
                
                }
            });
            $(this).removeClass('button');
            $(this).hide();
            return false;
            

        });
    });
}

function insertNewMessage(message, id, insert = true, order) {
    let mesageRow = '';
    if(insert) {
        mesageRow += '<div class="pt-25 pb-25 pl-10 pr-10 mb-20 chatbot-messages-list" data-order-id="'+order+'" data-id="'+id+'" id="message-main-'+id+'" style="background-color: #F8F8F8">';
    }
    mesageRow += '<div class="messages-order-up">';
    mesageRow += '<a href="javascript:void(0)" class="message-sent-up" id="'+id+'">up</a>';
    mesageRow += '</div>';
    mesageRow += '<div class="mb-20">';
    mesageRow += '<label class="form-label chatbot-form-label">'+order+'</label>';
    mesageRow += '<div class="clearfix">';

    mesageRow += '<div class="col s12 m12 l10 mb-20">';
    mesageRow += '<div class="new-comment-input input meessageedit"';
    mesageRow += 'id="message-'+id+'-editor"';
    mesageRow += 'contenteditable="false">'+message+'</div>';
    mesageRow += '</div>';

    mesageRow += '<div class="col s12 m12 l2 l-last">';
    mesageRow += '<a href="javascript:void(0)" id="'+id+'" style="background-color:#D45F5F !important; color:white;" class="chatbot-message-delete fluid button button--light-outline mb-15 js-add-new-comment-btn">Delete</a>';
    mesageRow += '<a href="javascript:void(0)" id="message-'+id+'"  class="chatbot-message-item fluid button button--light-outline mb-15 js-add-new-comment-btn">Edit</a>';
    mesageRow += '<a href="javascript:void(0)" hidden class="chatbot-button message-update-submit"  id="'+id+'">Save</a>'
    mesageRow += '</div>';

    mesageRow += '</div>';
    mesageRow += '</div>';

    mesageRow += '<ul class="field-tips">';
    mesageRow += '<li>';
    mesageRow += '"You can use following variables in the comments:"';
    mesageRow += '<div class="mt-5">';
    mesageRow += '<strong>{{username}}</strong>Media owner username';
    mesageRow += '</div>';
    mesageRow += ' <div class="mt-5">';
    mesageRow += '<strong>{{full_name}}</strong>';
    mesageRow += 'Media owners full name. If users full name is not set, username will be used.';
    mesageRow += '</div>';
    mesageRow += ' </li>';
    mesageRow += '</ul>';
    mesageRow += '<div class="messages-order-down">';
    mesageRow += '</div>';
    if(insert) {
    $('.messages-list-content').append(mesageRow);
    mesageRow += '</div>';
    console.log('no');
    } else {
    $('#message-main-'+id).html(mesageRow);
    console.log('yes');
    }
    
 }
function messageDelete() {
    $(".chatbot-message-delete").each(function(i){
        $(this).click(function(){
            event.preventDefault();
            let identifier = this.id;
            var $form = '';
            $form = $(".js-chatbot-message-form");
            $.ajax({
                // url: '/chatbot/message/new',
                url: $form.attr("action"),
                type: 'POST',
                dataType: 'jsonp',
                data: {
                    action: "delete", id : identifier
                },
                error: function(resp) {
          
                },
                success: function(resp) {
                   
                    // insertNewMessage(resp.message, resp.id, false, resp.title);
                    // enableInputField();
                    // messageUpdate();
                    console.log(resp);

                    console.log('success');
                    $('#message-main-'+resp.id).remove();
                    checkFirstAndLastElement();
                    setTimeout(() => {
                        checkiFNotFirstOrLastElement();
                    }, 500);
                }
            });
    
            return false;
            

        });
    });
}
    // Settings

        // Submit the form
        function settings_form() {
            $('.chatbot_status').click(function(){
                event.preventDefault();
                var status = $("#chatbot_status_select").val();
                var url = this.id;
        
                // console.log(status);
                // console.log(url);
        
                $.ajax({
                    url: this.id,
                    type: 'POST',
                    dataType: 'jsonp',
                    data: {
                        action: "save", chatbot_status: status
                    },
                    error: function(resp) {
              
                    },
                    success: function(resp) {
                        console.log(resp);
                        console.log('success save 2');
                    }
                });
        
                return false;
            });
        }

function messagesOrderEvents(){
    $(".message-sent-up").each(function(i){
        $(this).click(function(){
            let elem = $('#message-main-'+ this.id);
            elem.prev().insertAfter(elem);
           
            checkFirstAndLastElement();
            setTimeout(() => {
                checkiFNotFirstOrLastElement();
            }, 500);
            
        });
    });
    $(".message-sent-down").each(function(i){
        $(this).click(function(){
            let elem = $('#message-main-'+ this.id);
            console.log(elem.next().attr('data-order-id'));
            elem.next().insertBefore(elem);
            
            checkFirstAndLastElement();
            setTimeout(() => {
                checkiFNotFirstOrLastElement();
            }, 500);
           
        });
    });
}

function checkFirstAndLastElement(){
    $( ".chatbot-messages-list" ).first().find('.message-sent-up').remove();
    $( ".chatbot-messages-list" ).last().find('.message-sent-down').remove();
}
function checkiFNotFirstOrLastElement(){
    $(".chatbot-messages-list").each(function(key, value){
        let message_id = $(this)[0].id.replace('message-main-', '');
        let messages = document.getElementsByClassName("chatbot-messages-list");
        if($(this).find('.message-sent-up').length == 0 && key !== 0){
            $(this).find('.messages-order-up').html('<a href="javascript:void(0)" class="message-sent-up" id="'+message_id+'">up</a>');
        }
        if($(this).find('.message-sent-down').length == 0  && key + 1 !== messages.length){
            $(this).find('.messages-order-down').html('<a href="javascript:void(0)" class="message-sent-down" id="'+message_id+'">down</a>');
            
        }
        $(this).find('.chatbot-form-label').text(key);
        $(this).attr('data-order-id', key);
     });
     unbindEvents();
     messagesOrderEvents();
     saveNewMessagesOrder();
}

function saveNewMessagesOrder(){
    showHideShiftButtons('hide');
    $(".chatbot-messages-list").each(function(key, value){
        let message_id = $(this).attr('data-id');
        let order = $(this).attr('data-order-id');
        var $form = '';
        $form = $(".js-chatbot-message-form");
        $.ajax({
            // url: '/chatbot/message/new',
            url: $form.attr("action"),
            type: 'POST',
            dataType: 'jsonp',
            data: {
                action: 'update-order',  id : message_id, message_order: order
            },
            error: function(resp) {
      
            },
            success: function(resp) {
                // enableInputField();
                // messageUpdate();
                // messageDelete();
                // console.log(resp);
                console.log('success');
            
            }
        });
    });
    showHideShiftButtons('show');
}
function unbindEvents(){
    $(".message-sent-up").each(function(i){
        $(this).unbind( "click" );
    });
    $(".message-sent-down").each(function(i){
        $(this).unbind( "click" );
    });
}
function showHideShiftButtons(action){
if(action == 'show'){
    $(".message-sent-up").each(function(i){
        $(this).show();
    });
    $(".message-sent-down").each(function(i){
        $(this).show();
    });
}

if(action == 'hide'){
    $(".message-sent-up").each(function(i){
        console.log($(this))
        $(this).hide();
    });
    $(".message-sent-down").each(function(i){
        $(this).hide();
    });
}
}

function openCity(evt, cityName) {
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
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  
  