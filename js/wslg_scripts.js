(function ($, window, document) {
    $(document).ready(function () {

        $(".wslg_social a").click(function (event) {
            event.preventDefault();
            var ele = this;
            $("#dialog-confirm").html("Are you sure you want to delete?");

            $("#dialog-confirm").dialog({
                resizable: false,
                modal: true,
                title: "Confirm",
                height: 150,
                width: 400,
                buttons: {
                    "Yes": function () {
                        $(ele).parent('.wslg_social').remove();
                        $(this).dialog("close");
                    },
                    "No": function () {
                        $(this).dialog('close');
                    }
                }
            });
        });

        var $value = $('#txt_social_icon_type').val();
        var $position = $('#txt_i_position').val();

        if (($value == 'fontawesome')) {
            $('.icons_font').css('display', 'block');
            $('.icons_image').css('display', 'none');
        } else {
            $('.icons_font').css('display', 'none');
            $('.icons_image').css('display', 'block');
        }
        if (($position == 'rfixed') || ($position == 'lfixed')) {
            $('.p_fixed').css('display', 'block');
        }
        $('#txt_i_position').change(function () {
            $position = $('#txt_i_position').val();
            if (($position == 'rfixed') || ($position == 'lfixed')) {
                $('.p_fixed').css('display', 'block');
            } else {
                $('.p_fixed').css('display', 'none');
            }
        });


        $('#txt_social_icon_type').change(function () {
            $value = $('#txt_social_icon_type').val();

            if (($value == 'fontawesome')) {
                $('.icons_font').css('display', 'block');
                $('.icons_image').css('display', 'none');
            } else {
                $('.icons_font').css('display', 'none');
                $('.icons_image').css('display', 'block');
            }
        });

        $("#add_field_button_id").click(function (e) {

            var gid = $('#txt_gid').val();
            var txt_social_icon = $('.new_field_form #txt_social_icon').val();
            var txt_social_link = $('.new_field_form #txt_social_link').val();
            if (txt_social_icon !== '' && txt_social_link !== '') {

//                if (validateURL(txt_social_link)) {
                $('.new_field_form #txt_social_icon').removeClass('error');
                $('.new_field_form #txt_social_link').removeClass('error');

                var div = document.createElement('DIV');
                div.setAttribute("class", "wslg_social animated flipInX  clearfix");
                div.innerHTML = GetDynamicTextBox(txt_social_icon, txt_social_link, gid);
                document.getElementById("TextBoxContainer").appendChild(div);

                $('.new_field_form #txt_social_icon').val('');
                $('.new_field_form #txt_social_link').val('');
//                } else {
//                    $('.new_field_form #txt_social_link').focus();
//                    $('.new_field_form #txt_social_link').addClass('error');
//                }
            }
            else {
                if (txt_social_icon === '') {
                    $('.new_field_form #txt_social_icon').focus();
                    $('.new_field_form #txt_social_icon').addClass('error');
                    exit;
                } else {
                    $('.new_field_form #txt_social_icon').removeClass('error');
                }
                if (txt_social_link === '') {
                    $('.new_field_form #txt_social_link').focus();
                    $('.new_field_form #txt_social_link').addClass('error');
                    exit;
                } else {
                    $('.new_field_form #txt_social_link').removeClass('error');
                }
            }
        });
    });
}(window.jQuery, window, document));

function GetDynamicTextBox(txt_social_icon, txt_social_link, gid) {
    return '<div class="col-md-2"><label>' + txt_social_icon + '</label></div><div class="col-md-8"><input type="tetx" class="form-control" name="' + gid + '[icons][' + txt_social_icon + ']" value="' + txt_social_link + '"></div><a><span class="dashicons dashicons-dismiss"></span></a>';
}

function validateURL(textval) {
    var urlregex = /^(https?|ftp):\/\/([a-zA-Z0-9.-]+(:[a-zA-Z0-9.&%$-]+)*@)*((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}|([a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(:[0-9]+)*(\/($|[a-zA-Z0-9.,?'\\+&%$#=~_-]+))*$/;
    return urlregex.test(textval);
}

function myconfirm() {
    $("#dialog-confirm").html("Are you sure you want to delete?");

    $("#dialog-confirm").dialog({
        resizable: false,
        modal: true,
        title: "Confirm",
        height: 150,
        width: 400,
        buttons: {
            "Yes": function () {
                $(this).dialog("close");
                return true;
            },
            "No": function () {
                $(this).dialog('close');
                return false;
            }
        }
    });
}
