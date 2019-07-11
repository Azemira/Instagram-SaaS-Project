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
    }, 1000);
    


    // Submit the form
   function form_submit() {
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
            url: '/chatbot/message/new',
            // url: $form.attr("action"),
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
                insertNewMessage(resp.message, resp.id);
                enableInputField();
                messageUpdate();
                $('#closeModal').click();
            
            }
        });

        return false;
    });
}


  function enableInputField(){
    $(".chatbot-message-item").each(function(i){
        $(this).click(function(){
            $('#'+this.id+'-editor').attr( "contenteditable","true" )
            emojiLoad('#'+this.id+'-editor');
            console.log('test');
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
            
                var message = $("#message-"+this.id+"-editor")[0].emojioneArea.getText()
                function unicodeEscape(str) {
                for (var result = '', index = 0, charCode; !isNaN(charCode = str.charCodeAt(index++));) {
                    result += '\\u' + ('0000' + charCode.toString(16)).slice(-4);
                }
                return result;
                }
                let identifier = this.id;
                message = unicodeEscape(message);
                $.ajax({
                    url: '/chatbot/message/new',
                    // url: $form.attr("action"),
                    type: 'POST',
                    dataType: 'jsonp',
                    data: {
                        action: "update", title: "hello", message : message, id : identifier
                    },
                    error: function(resp) {
              
                    },
                    success: function(resp) {
                       
                        insertNewMessage(resp.message, resp.id, false);
                        enableInputField();
                        messageUpdate();
                        console.log(resp);
                        console.log('success');
                    
                    }
                });
        
                return false;
                

            });
        });
    }
    function insertNewMessage(message, id, insert = true) {
        let mesageRow = '';
        if(insert) {
            mesageRow += '<div class="pt-25 pb-25 pl-10 pr-10 mb-20 chatbot-messages-list" id="message-main-'+id+'" style="background-color: #F8F8F8">';
        }
        
        mesageRow += '<div class="mb-20">';
        mesageRow += '<label class="form-label">Message '+id+'</label>';
        mesageRow += '<div class="clearfix">';

        mesageRow += '<div class="col s12 m12 l10 mb-20">';
        mesageRow += '<div class="new-comment-input input meessageedit"';
        mesageRow += 'id="message-'+id+'-editor"';
        mesageRow += 'contenteditable="false">'+message+'</div>';
        mesageRow += '</div>';

        mesageRow += '<div class="col s12 m12 l2 l-last">';
        mesageRow += '<a href="javascript:void(0)" id="message-'+id+'"  class="chatbot-message-item fluid button button--light-outline mb-15 js-add-new-comment-btn">Edit</a>';
        mesageRow += '<input class="fluid button message-update-submit" id="'+id+'"  value="Save">';
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
        if(insert) {
        $('.messages-list-content').prepend(mesageRow);
        mesageRow += '</div>';
        console.log('no');
        } else {
        $('#message-main-'+id).html(mesageRow);
        console.log('yes');
        }
        
     }

})();
  