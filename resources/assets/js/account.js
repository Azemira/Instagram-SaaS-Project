window.Pilot = {
    username: null,
    password: null,
    proxy: null
}

$(function() {

    $('#accounts > tbody > tr').each(function() {
        var $row = $(this);
        var username = $row.data('username');
        var request = $.get('https://www.instagram.com/' + username + '/', function(response) {

            $json = JSON.parse(response.split("window._sharedData = ")[1].split(";<\/script>")[0]);

            var $user = $json.entry_data.ProfilePage[0].graphql.user;
            var followed_by_count = $user.edge_followed_by.count
            var following_count = $user.edge_follow.count
            var posts_count = $user.edge_owner_to_timeline_media.count
            var avatar = response.match(/<meta property="og:image" content="(.*?)" \/>/)[1];

            $row.find('td:first > div.avatar').css('background-image', 'url(' + avatar + ')');
            $row.find('span.followers').text(followed_by_count);
            $row.find('span.following').text(following_count);
            $row.find('span.posts').text(posts_count);
        });
    });


    $('.btn-account-submit').on('click', function() {

        window.Pilot.username = $('input[name="username"]').val();
        window.Pilot.password = $('input[name="password"]').val();
        window.Pilot.proxy = $('input[name="proxy"]').val();

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/account',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'username' : window.Pilot.username,
                'password' : window.Pilot.password,
                'proxy' : window.Pilot.proxy
            },
            beforeSend: function(){
                $('.dimmer').addClass('active');
            },
            success: function( response ) {

                if (response['result'] == 'success') {

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        callback: function() {

                            $('.dimmer').removeClass('active');

                            window.location.replace(BASE_URL + '/account');
                        }
                    })

                } else if(response['result'] == 'two_factor') {

                    bootbox.prompt({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        inputType: 'number',
                        required: true,
                        callback: function(code) {

                            if (code == null) {
                                $('.dimmer').removeClass('active');
                            } else {
                                if (code.length != 6) {
                                    return false;
                                }

                                confirmTwoFactor(code);
                            }
                        }
                    });

                } else if(response['result'] == 'challenge_required') {

                    bootbox.prompt({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        inputType: 'radio',
                        inputOptions: [
                            {
                                text: 'SMS',
                                value: '0',
                            },
                            {
                                text: 'E-mail',
                                value: '1',
                            }
                        ],
                        callback: function (method) {

                            if (method == '0' || method == '1') {
                                challengeMethodRequest(response['api_path'], method);
                            } else {
                                $('.dimmer').removeClass('active');
                            }

                        }
                    });

                } else if (response['result'] == 'error') {

                    var bootboxBody = '<ul class="mb-0">';

                    $.each(response['errors'], function(k, v) {
                        bootboxBody += '<li>' + v + '</li>';
                    });

                    bootboxBody += '</ul>';

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: bootboxBody,
                        closeButton: false,
                        callback: function () {
                            $('.dimmer').removeClass('active');
                        }
                    });

                }

            },
            error: function( error ) {
                bootbox.alert({
                    closeButton: false,
                    message: 'Something went wrong. Please try again.'
                });
            }
        });

    });


    challengeMethodRequest = function(api_path, choice) {

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/account/confirm',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'action': 'request_challenge',
                'api_path': api_path,
                'choice': choice,
                'username' : window.Pilot.username,
                'password' : window.Pilot.password,
                'proxy' : window.Pilot.proxy
            },
            success: function( response ) {

                if (response['result'] == 'confirm_challenge') {

                    bootbox.prompt({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        inputType: 'number',
                        required: true,
                        callback: function(code) {

                            if (code == null) {
                                $('.dimmer').removeClass('active');
                            } else {
                                if (code.length != 6) {
                                    return false;
                                }

                                confirmChallenge(code, api_path);
                            }
                        }
                    });

                } else if (response['result'] == 'challenge_request_failed') {

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        callback: function () {
                            $('.dimmer').removeClass('active');
                        }
                    });

                } else if (response['result'] == 'error') {

                    var bootboxBody = '<ul class="mb-0">';

                    $.each(response['errors'], function(k, v) {
                        bootboxBody += '<li>' + v + '</li>';
                    });

                    bootboxBody += '</ul>';

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: bootboxBody,
                        closeButton: false,
                        callback: function () {
                            $('.dimmer').removeClass('active');
                        }
                    });

                }

            },
            error: function( error ) {
                bootbox.alert({
                    closeButton: false,
                    message: 'Something went wrong. Please try again.'
                });
            }
        });
    }

    confirmTwoFactor = function(code) {

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/account/confirm',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'action': 'confirm_twofactor_login',
                'code': code,
                'username' : window.Pilot.username,
                'password' : window.Pilot.password,
                'proxy' : window.Pilot.proxy
            },
            success: function( response ) {

                if (response['result'] == 'twofactor_success') {

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        callback: function() {

                            $('.dimmer').removeClass('active');

                            $('.btn-account-submit').trigger("click");
                        }
                    })

                } else if (response['result'] == 'invalid_sms_code') {

                    bootbox.prompt({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        inputType: 'number',
                        required: true,
                        callback: function(code) {

                            if (code == null) {
                                $('.dimmer').removeClass('active');
                            } else {
                                if (code.length != 6) {
                                    return false;
                                }

                                confirmTwoFactor(code);
                            }
                        }
                    });

                } else if (response['result'] == 'error') {

                    var bootboxBody = '<ul class="mb-0">';

                    $.each(response['errors'], function(k, v) {
                        bootboxBody += '<li>' + v + '</li>';
                    });

                    bootboxBody += '</ul>';

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: bootboxBody,
                        closeButton: false,
                        callback: function () {
                            $('.dimmer').removeClass('active');
                        }
                    });

                }

            },
            error: function( error ) {
                bootbox.alert({
                    closeButton: false,
                    message: 'Something went wrong. Please try again.'
                });
            }
        });
    }

    confirmChallenge = function(code, api_path) {

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/account/confirm',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'action': 'confirm_challenge',
                'code': code,
                'api_path': api_path,
                'username' : window.Pilot.username,
                'password' : window.Pilot.password,
                'proxy' : window.Pilot.proxy
            },
            success: function( response ) {

                if (response['result'] == 'challenge_success') {

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        callback: function() {

                            $('.dimmer').removeClass('active');

                            $('.btn-account-submit').trigger("click");

                        }
                    })

                } else if (response['result'] == 'error') {

                    var bootboxBody = '<ul class="mb-0">';

                    $.each(response['errors'], function(k, v) {
                        bootboxBody += '<li>' + v + '</li>';
                    });

                    bootboxBody += '</ul>';

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: bootboxBody,
                        closeButton: false,
                        callback: function () {
                            $('.dimmer').removeClass('active');
                        }
                    });

                }

            },
            error: function( error ) {
                bootbox.alert({
                    closeButton: false,
                    message: 'Something went wrong. Please try again.'
                });
            }
        });
    }

});