$(function() {
    if ($('.btn-rotate-form').length) {
        $('.btn-rotate-form').on('click', function() {
            $('.show').removeClass('show');
            var openFormID = $(this).data('openformid')
            $('#' + openFormID).addClass('show')
        });
    }
})