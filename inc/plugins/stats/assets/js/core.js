/**
 * Module Namespace
 */
var StatsModule = {};
  StatsModule.go = function() {
    StatsModule.startSwitch();
    StatsModule.changeAccount();
    StatsModule.resizeBox();
  };
  
  StatsModule.startSwitch =  function() {
    $.each(pluginsDashboard, function(i, v) {
      StatsModule.handleSwitch(v+'_switch')
    });
  };
  
  StatsModule.handleSwitch = function(itemId) {
    var elem = document.querySelector('#'+itemId);
    var init = new Switchery(elem, {size: 'small'});
    var sendData = true;
    
    elem.onchange = function() {
      if(!sendData) {
        sendData = true;
        return;
      }
      $.blockUI({
        css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: 0.5, 
            color: '#fff',
            fontSize: '12px'
        },
        message: $('#stats-preloading')
      });
      
      var status = $(elem).is(':checked') ? 1 : 0;
      
      var ajaxData = {
        'action' : itemId,
        'accountId': accountId,
        'status': status
      }
      var elemResult = $("#stats-profile-box");
      $.ajax({
        type: "POST",
        url: pluginUrl + '/2',
        data: ajaxData,
        success: function(res) {
          setTimeout($.unblockUI, 200);
          if(!res.status) {
            sendData = false;
            $('#' + itemId).trigger('click');
          }
          NextPost.DisplayFormResult(elemResult, res.status ? 'success' : 'error', res.msg);
        },
        error: function(res) {
          setTimeout($.unblockUI, 200);
          sendData = false;
          $('#' + itemId).trigger('click');
        },
        dataType: 'json'
      });
    };
    
  };
  
  StatsModule.changeAccount = function() {
    var $form = $("#formAccounts");
      $form.find(":input[name='account']").on("change", function() {
          $form.trigger("submit");
      });
  };

  StatsModule.formatNumber = function(number, decimals, dec_point, thousands_sep) {
// *     example: number_format(1234.56, 2, ',', ' ');
// *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
  
  StatsModule.resizeBox = function() {
    $('.resize-box').click(function(){
      $(this).parents('.stats-box').toggleClass('stats-box-full');
      $('body').toggleClass('stats-body-full');
      //document.body.scrollTop = 0; // For Safari
      //document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    });
    $(document).keydown(function(e){
        if(e.keyCode == 27) {
          $('.stats-box').removeClass('stats-box-full');
          $('body').removeClass('stats-body-full');
        }
    });
  };
  
  StatsModule.removeLoading = function() {
    $('body').removeClass('onprogress');
  };