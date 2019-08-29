/**
 * ProxyManager Namespace
 */
var ProxyManager = {};

/**
 * ProxyManager Schedule Form
 */
ProxyManager.ProxyForm = function()
{
    var $form = $(".js-proxy-manager-proxy-form");

    // Submit form
    $form.on("submit", function() {
        $("body").addClass("onprogress");

        $.ajax({
            url: $form.attr("action"),
            type: $form.attr("method"),
            dataType: 'jsonp',
            data: {
                action: "save",
                proxy: $form.find(":input[name='proxy']").val(),
                country: $form.find(":input[name='country']").val(),
                limit_usage: $form.find(":input[name='limit-usage']").val(),
                package_id: $form.find(":input[name='package-id']").val(),
                replace_proxy: $form.find(":input[name='replace-proxy']").val()
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
 * Proxy Manager Set Proxy
 */
ProxyManager.SetProxyForm = function(account_id) {
    var $form = $(".arp-log-list");

    swal({
        title: 'Set Proxy',
        input: 'select',
        confirmButtonText: 'Save',
        inputOptions: proxies,
        inputPlaceholder: 'Choose a proxy',
        inputClass: 'input',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        onOpen: function() {
            $('select.input').addClass('combobox');
            $("body").on("click", ".select2", function() {
                $(this).removeClass("error");
            });

            $(".combobox").select2({
                width: '100%'
            });
        },
        allowOutsideClick: function() {
            return !swal.isLoading()
        },
        inputValidator: (value) => {
            return new Promise((resolve) => {
                if (value === '') {
                    resolve("Error: You need to select one proxy")
                } else {
                    resolve();
                }
            })
        },
        preConfirm: function(proxy) {
            let url = $form.find(":input[name='base-url']").val();
            return $.ajax({
                url: url,
                method: "POST",
                dataType: 'jsonp',
                data: {
                    action: "save",
                    account_id: account_id,
                    proxy: proxy,
                }
            }).then(function (response) {
                if (!response.result) {
                    throw new Error(response.msg)
                }
                return response
            }).catch(function(error) {
                swal.showValidationMessage(error)
            })
        },
    }).then(function (response) {
        let { result, msg } = response.value;

        if (result) {
            swal(
                'Success!',
                msg,
                'success'
            ).then(function () {
                window.location.reload();
            })
        }
    })
}

/**
 * Proxy Manager Look Up Proxy
 */

ProxyManager.LookUpProxy = function() {
    var $form = $(".js-proxy-manager-proxy-form");
    var $combobox = $form.find(".combobox");
    var $inputProxy = $form.find(":input[name='proxy']");
    var proxy = $inputProxy.val();

    $inputProxy.blur();
    $inputProxy.prop("disabled", true);
    NextPost.DisplayFormResult($form, "info", __("Detecting ..."));

    $.ajax({
        url: $form.attr("action"),
        type: $form.attr("method"),
        dataType: 'jsonp',
        data: {
            action: "lookup",
            proxy: proxy
        },
        error: function () {
            $inputProxy.prop("disabled", false);
            NextPost.DisplayFormResult($form, "error", __("Oops! An error occured. Please try again later!"));
        },
        success: function (resp) {
            $inputProxy.prop("disabled", false);

            if (resp.result == 1) {
                $combobox.val(resp.info.country).trigger("change.select2");
                NextPost.DisplayFormResult($form, "success", resp.msg);
            } else {
                NextPost.DisplayFormResult($form, "error", resp.msg);
            }
        }
    })
}

/**
 * Upload new csv file
 * @constructor
 */
ProxyManager.Upload = function()
{
    var $form = $(".js-proxy-manager-upload-form");

    $form.on("submit", function() {
        var submitable = true;

        if (!$form.find(":input[name='file']").val()) {
            $form.find(":input[name='file']").addClass("error");
            submitable = false;
        }

        if (submitable && $form.find(":input[name='file']")[0].files.length > 0) {
            $("body").addClass("onprogress");

            var data = new FormData();
            data.append("action", "upload");
            data.append("file", $form.find(":input[name='file']")[0].files[0]);

            $.ajax({
                url: $form.attr("action"),
                type: "POST",
                dataType: 'jsonp',
                data: data,
                cache: false,
                contentType: false,
                processData: false,

                error: function() {
                    $("body").removeClass("onprogress");
                    NextPost.DisplayFormResult($form, "error", __("Oops! An error occured. Please try again later!"));
                },

                success: function(resp) {
                    if (resp.result == 1) {
                        window.location.href = resp.redirect;
                    } else {
                        NextPost.DisplayFormResult($form, "error", resp.msg);
                        $("body").removeClass("onprogress");
                    }

                }
            });
        }

        return false;
    })
}


/**
 * Proxy Manager Index
 */
ProxyManager.Index = function()
{
    $(document).ajaxComplete(function(event, xhr, settings) {
        var rx = new RegExp("(proxy-manager\/[0-9]+(\/)?)$");
        var $refresh = $('.refresh-country');
        if (rx.test(settings.url)) {
            ProxyManager.ProxyForm();
            NextPost.Combobox();
            $refresh.on('click', ProxyManager.LookUpProxy);
        }
    })
}