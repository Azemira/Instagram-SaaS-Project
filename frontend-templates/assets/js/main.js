$(function () {
    if ($('.btn-rotate-form').length) {
        $('.btn-rotate-form').on('click', function () {
            $('.show').removeClass('show');
            var openFormID = $(this).data('openformid')
            $('#' + openFormID).addClass('show')
        });
    }

    var ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf('safari') != -1) {
        if (ua.indexOf('chrome') > -1) {
             // Chrome
             $("body").addClass("chrome")
        } else {
            // Safari
            $("body").addClass("safari")
        }
    }
})
