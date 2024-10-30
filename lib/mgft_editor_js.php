<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function ($) {
    $("#select_mgft_shortcode").dialog({
        dialogClass:'wp-dialog',
        autoOpen:false,
        closeOnEscape:true,
        modal:true,
        draggable:true,
        resizable:true,
        width:640,
        height:640,
        buttons:{
            "<?php _e("Create the shortcode", misamee_gf_tools::$localizationDomain); ?>":function () {
                $messages = '';
                if ($('#form_id').val() == '') {
                    $messages += "\n- " + "<?php _e("Select a Form", misamee_gf_tools::$localizationDomain); ?>"
                }
                if ($('#exp').val() == '') {
                    $messages += "\n- " + "<?php _e("Type an Expression", misamee_gf_tools::$localizationDomain); ?>"
                }
                if ($('#shortcode_type').val() == 'progressbar' && $('#maxvalueexp').val() == '') {
                    $messages += "\n- " + "<?php _e("Type a Maximum Value Expression", misamee_gf_tools::$localizationDomain); ?>"
                }
                if ($messages == '') {
                    window.send_to_editor($('#shortcodepreview').text());
                    $(this).dialog("close");
                } else {
                    $messages = "<?php _e("Error(s)", misamee_gf_tools::$localizationDomain); ?>" + $messages;
                    alert($messages);
                }
            },
            "<?php _e("Cancel", misamee_gf_tools::$localizationDomain); ?>":function () {
                $(this).dialog("close");
            }
        }
    });

    $('.fieldslistcontainer').dialog({
        dialogClass:'wp-dialog',
        autoOpen:false,
        closeOnEscape:true,
        draggable:true,
        resizable:true,
        show:"slide",
        position: 'right',
        width:360,
        height:580
    });

    $('.selectfields').click(function () {
        event.preventDefault();

        var $resultsContainer = $('#' + $(this).attr('rel'));

        if ($('#form_id').val() != '') {
            var data = {
                action:"get_fields",
                form_id:$('#form_id').val()
            };

            jQuery.post(ajaxurl, data,
                    function (response) {
                        $resultsContainer.empty();
                        $resultsContainer.append(response);
                        $resultsContainer.dialog('open');
                    }
            );
        } else {
			alert('<?php _e("Please select a form first.", misamee_gf_tools::$localizationDomain); ?>');
		}
		return false;
    });

    $("#add_mgftshortcode").click(function () {
        event.preventDefault();
        $("#select_mgft_shortcode").dialog("open");
		return false;
    });

    $("#addcolor").click(function () {
        event.preventDefault();
        $('.color').miniColors('destroy');
        var $itemToClone = $('#colorswrapper .colorcontainer').last().clone().appendTo('#colorswrapper');
        updateColors();
        updatePicker();
		return false;
    });

    $('.shortcodeargument').change(function () {
        updateShortCode();
    });
    $('.shortcodeargument').click(function () {
        if(event.target.localName == 'a') {
            event.preventDefault();
        }
        if($(this).attr('type') == 'checkbox' || $(this).attr('type') == 'radio') {
            updateShortCode();
        }
    });

    $('#shortcode_type').change(function () {
        updateForm();
    });

    updatePicker();
    updateShortCode();
    $('.progressbar').hide();
});

function updateForm() {
    if (jQuery('#shortcode_type').val() == 'grandtotal') {
        jQuery('.progressbar').fadeOut();
    }
    if (jQuery('#shortcode_type').val() == 'progressbar') {
        jQuery('.progressbar').fadeIn();
    }
}

function updatePicker() {
    jQuery('#colorswrapper .colorcontainer .color').miniColors({
        change:function (hex, rgb) {
            updateColors();
            updateShortCode();
        }
    });
    jQuery('#colorswrapper .colorcontainer').each(function (index, el) {
        if (index > 0 && jQuery(this).find('.removecolor').length == 0) {
            jQuery(this).append('<a href="#" class="shortcodeargument removecolor">[-]</a>')
        }
    });

    jQuery(".removecolor").click(function () {
        event.preventDefault();
        jQuery(this).parent().remove();
        updateColors();
        updatePicker();
		return false;
    });

    jQuery('.shortcodeargument').change(function () {
        updateShortCode();
    });
}

function updateColors() {
    if (jQuery('#colorswrapper .colorcontainer').length > 0) {
        var $colors = '';
        jQuery('#colorswrapper .colorcontainer .color').each(function (index, el) {
            $colors += ($colors.length > 0 ? ',' : '') + (jQuery(this).val() != '' ? jQuery(this).val() : '');
        });
        jQuery('#colors').val($colors);
    }
}

function buildShortcodeSettings() {
    var $shortcodeType = jQuery('#shortcode_type').val();
    return {
        'shortcodeType':$shortcodeType,
        'id':jQuery('#form_id').val(),
        'params':{
            'cssclass':{
                value:jQuery('#cssclass').val(),
                isDefault:jQuery('#cssclass').data('default') == jQuery('#cssclass').val()
            },
            'htmlelement':{
                value:jQuery('#htmlelement').val(),
                isDefault:jQuery('#htmlelement').data('default') == jQuery('#htmlelement').val()
            },
            'exp':{
                value:jQuery('#exp').val(),
                isDefault:false
            },
            'maxvalueexp':{
                value:jQuery('#maxvalueexp').val(),
                isDefault:false
            },
            'autostyle':{
                value:jQuery('#autostyle').is(':checked') ? "1" : "0",
                isDefault:jQuery('#autostyle').data('default') == (jQuery('#autostyle').is(':checked') ? "1" : "0")
            },
            'hidevalue':{
                value:jQuery('#hidevalue').is(':checked') ? "1" : "0",
                isDefault:jQuery('#hidevalue').data('default') == (jQuery('#hidevalue').is(':checked') ? "1" : "0")
            },
            'colors':{
                value:jQuery('#colors').val(),
                isDefault:jQuery('#colors').data('default') == jQuery('#colors').val()
            },
            'thousandsseparator':{
                value:jQuery('#thousandsseparator').is(':checked') ? "1" : "0",
                isDefault:jQuery('#thousandsseparator').data('default') == (jQuery('#thousandsseparator').is(':checked') ? "1" : "0")
            },
            'decimals':{
                value:jQuery('#decimals').val(),
                isDefault:jQuery('#decimals').data('default') == jQuery('#decimals').val()
            },
            'search':{
                value:jQuery('#search').val(),
                isDefault:jQuery('#search').data('default') == jQuery('#search').val()
            },
            'star':{
                value:jQuery('#star').val(),
                isDefault:jQuery('#star').data('default') == jQuery('#star').val()
            },
            'entrystatus':{
                value:jQuery('#entrystatus').val(),
                isDefault:jQuery('#entrystatus').data('default') == jQuery('#entrystatus').val()
            }
        }
    };
}

function buildShortCode($settings) {

    $shortcode = 'mgft-';
    $shortcode += $settings['shortcodeType'];
    $shortcode += ' id="' + $settings['id'] + '"';

    $params = $settings['params'];
    for (var $index in $params) {
        if (!$params[$index]['isDefault']) {
            switch ($index) {
                case 'maxvalueexp':
                case 'autostyle':
                case 'hidevalue':
                case 'colors':
                    if ($settings['shortcodeType'] == 'progressbar') {
                        $shortcode += ' ' + $index + '="' + $params[$index]['value'] + '"';
                    }
                    break;
                default:
                    $shortcode += ' ' + $index + '="' + $params[$index]['value'] + '"';
            }
        }
    }

    return '[' + $shortcode + ']';
}

function updateShortCode() {
    var $settings = buildShortcodeSettings();

    jQuery('#shortcodepreview').text(buildShortCode($settings));

    var data = {
        action:"get_sample",
        settings:$settings
    };

    jQuery.post(ajaxurl, data,
            function (response) {
                jQuery('#shortcodesamples').html(response);
            }
    );
}
/* ]]> */
</script>