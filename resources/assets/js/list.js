$(function() {

    var $repeaterList = $('.repeater').repeater({
    	show: function () {
    		$(this).show();
            window.emojiPicker.discover();
        }
    });

	$('#addMultiple').on('shown.bs.modal', function (e) {
		$('#addMultiple textarea').focus();
	}).on('hidden.bs.modal', function (e) {
		$('#addMultiple textarea').val('');
		$('.searchByHashtagForm input[name="q"]').val('');
	});

    $('#addMultiple button.btn-parse').on('click', function(e) {

    	var clearUsernames = [];
    	var usernamesText = $('#addMultiple textarea').val().trim();

    	if (usernamesText != '') {

    		var usernames = usernamesText.split(/\r|\n/);

	    	if (usernames.length > 0) {

	    		$.each(usernames, function(i, username) {

	    			username = username.trim();

	    			if (username != '') {
	    				clearUsernames.push({
	    					'text' : username
	    				});
	    			}
	    		});

				if (clearUsernames.length > 0) {
					$repeaterList.setList(clearUsernames);
					$('#addMultiple').modal('hide');
				}
	    	}
    	}

    });


    $('.searchByHashtagForm button.btn').on('click', function(e) {

    	var $button = $(this);
    	var q = $('.searchByHashtagForm input[name="q"]').val().trim();
    	var account_id = $('.searchByHashtagForm select[name="account_id"]').val();

    	if (q != '' && account_id != '') {

    		$.ajax({
	            type: 'POST',
	            url: BASE_URL + '/users/list/search/hashtag',
	            data: {
	                '_token': $('meta[name="csrf-token"]').attr('content'),
	                'account_id' : account_id,
	                'q' : q,
	            },
	            beforeSend: function(){
	                $button.addClass('btn-loading');
	            },
	            success: function( response ) {
	                $button.removeClass('btn-loading');
	            	$.each(response, function(pk, username) {
	            		$('#addMultiple textarea').append(username + "\r\n");
	            	});
	            },
	            error: function( error ) {
	            	$button.removeClass('btn-loading');
	                bootbox.alert({
	                    closeButton: false,
	                    message: 'Something went wrong. Please try again.'
	                });
	            }
	        });


    	}
    });
});