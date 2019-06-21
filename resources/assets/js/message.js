$(function() {

    $('input[name="audience"]').on('change', function() {
        var selected = $(this).val();

        switch(selected) {
            case '1':
                $('select[name="speed"]').val('25');
                $('select[name="speed"] option[value="86400"]').hide();
            case '2':
                $('select[name="speed"]').val('25');
                $('select[name="speed"] option[value="86400"]').hide();
            case '3':
                $('select[name="speed"]').val('25');
                $('select[name="speed"] option[value="86400"]').hide();
                $('.users_list').show('fast');
            break;
            case '4':
                $('select[name="speed"] option[value="86400"]').show();
                $('select[name="speed"]').val('86400');
                $('.users_list').hide('fast');
            break;
        }

    });

    $('.check_post').on('click', function() {
        var $input = $('input[name="post_url"]');
        var url = $input.val();

        if (url != '') {
            $.ajax({
                url: "https://api.instagram.com/oembed/",
                dataType: "json",
                data: {
                    url: url
                },
                beforeSend: function(){
                    $input.attr('disabled', true);
                },
                success: function( response ) {
                    $input
                        .removeClass('is-invalid')
                        .removeClass('state-invalid')
                        .addClass('is-valid')
                        .addClass('state-valid');

                    $('input[name="media_id"]').val(response.media_id);

                    $('#post_preview .post_thumbnail').attr('src', response.thumbnail_url);
                    $('#post_preview .post_author_name').html('<a href="' + response.author_url + '" target="_blank">' + response.author_name + '</a>');
                    $('#post_preview .post_title').html(response.title);
                    $('#post_preview').show();

                },
                complete: function() {
                    $input.attr('disabled', false);
                },
                error: function() {
                    $('#post_preview').hide();
                    $('input[name="media_id"]').val('');
                    $input
                        .addClass('is-invalid')
                        .addClass('state-invalid')
                        .removeClass('is-valid')
                        .removeClass('state-valid');
                }
            });
        }

    });


    $('input[name="message_type"]').on('change', function() {
        var selected = $(this).val();

        switch(selected) {
            case 'list':
                $('.options:not(.option_list)').hide('fast', function(){
                    $('.option_list').show('fast');
                    $('input[name="disappearing"]').attr('checked', false);
                    $('textarea[name="text"]').val('');
                    $('input[name="photo"]').val('');
                    $('input[name="video"]').val('');
                    $('input[name="hashtag"]').val('');
                    $('textarea[name="hashtag_text"]').val('');
                });
            break;
            case 'text':
                $('.options:not(.option_text)').hide('fast', function(){
                    $('.option_text').show('fast');
                    $('input[name="disappearing"]').attr('checked', false);
                    $('select[name="lists_id"]').val('');
                    $('input[name="photo"]').val('');
                    $('input[name="video"]').val('');
                    $('input[name="hashtag"]').val('');
                    $('textarea[name="hashtag_text"]').val('');
                });
            break;
            case 'like':
                $('.options:not(.option_like)').hide('fast', function(){
                    $('.option_like').show('fast');
                    $('input[name="disappearing"]').attr('checked', false);
                    $('textarea[name="text"]').val('');
                    $('select[name="lists_id"]').val('');
                    $('input[name="photo"]').val('');
                    $('input[name="video"]').val('');
                    $('input[name="hashtag"]').val('');
                    $('textarea[name="hashtag_text"]').val('');
                });
            break;
            case 'hashtag':
                $('.options:not(.option_hashtag)').hide('fast', function(){
                    $('.option_hashtag').show('fast');
                    $('input[name="disappearing"]').attr('checked', false);
                    $('select[name="lists_id"]').val('');
                    $('input[name="photo"]').val('');
                    $('input[name="video"]').val('');
                });
            break;
            case 'photo':
                $('.options:not(.option_photo)').hide('fast', function(){
                    $('input[name="disappearing"]').attr('checked', false);
                    $('textarea[name="text"]').val('');
                    $('select[name="lists_id"]').val('');
                    $('input[name="video"]').val('');
                    $('input[name="hashtag"]').val('');
                    $('textarea[name="hashtag_text"]').val('');

                    $('.option_photo').show('fast', function(){
                        $('.option_disappearing').show('fast');
                    });
                });
            break;
            case 'video':
                $('.options:not(.option_video)').hide('fast', function(){
                    $('input[name="disappearing"]').attr('checked', false);
                    $('textarea[name="text"]').val('');
                    $('select[name="lists_id"]').val('');
                    $('input[name="photo"]').val('');
                    $('input[name="hashtag"]').val('');
                    $('textarea[name="hashtag_text"]').val('');

                    $('.option_video').show('fast', function(){
                        $('.option_disappearing').show('fast');
                    });
                });
            break;
            case 'post':
                $('.options:not(.option_post)').hide('fast', function(){
                    $('.option_post').show('fast');
                    $('input[name="disappearing"]').attr('checked', false);
                    $('select[name="lists_id"]').val('');
                    $('input[name="photo"]').val('');
                    $('input[name="video"]').val('');
                });
            break;
        }

    });
});