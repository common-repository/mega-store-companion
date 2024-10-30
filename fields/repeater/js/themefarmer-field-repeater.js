/* global jQuery */
/* global wp */
/**
 * File repeater.js
 *
 * The main.
 *
 * @package Mega Store
 */

/* global control_settings */
jQuery(document).ready(function($) {
    'use strict';
    // var saved_data_input   = control_settings.saved_data_input;
    var tf_repeater = jQuery(".themefarmer-repeater").sortable({
        axis: 'y',
        items: '> li',
        update: function(event, ui) {
            update_tf_repeater($(this));
        }
    }).disableSelection();

    var update_tf_repeater = function(obj) {
        var data = [];
        obj.children('li').each(function(index, obj) {
            // console.log();
            var repeater_item = {};
            $(this).children().find('span.index').text(index + 1);

            $(this).find('.themefarmer-repeater-field').each(function(i, iobj) {
                var tf_index = $(this).data('tf-index');
                var tf_value = $(this).val();
                repeater_item[tf_index] = tf_value;
            });

            var repeater_repeater_item = [];
            $(this).children().find('.themefarmer-repeater-repeater-group').each(function(j, jobj) {
                var r_r_data = {};
                $(this).find('.themefarmer-repeater-repeater-field').each(function(k, kobj) {
                    var r_tf_index = $(this).data('tf-index');
                    var r_tf_value = $(this).val();
                    var r_r_e_data = {};
                    r_r_data[r_tf_index] = r_tf_value;
                    // r_r_data.push(r_r_e_data);
                });
                // console.log(r_r_e_data);
                repeater_repeater_item.push(r_r_data);
            });
            repeater_item['team_socials'] = repeater_repeater_item;
            data.push(repeater_item);
        });
        
        obj.children('.themefarmer-repeater-data').val(JSON.stringify(data));
        obj.children('.themefarmer-repeater-data').trigger('change');
    }


    $(document).on('keyup', '.themefarmer-repeater-field, .themefarmer-repeater-repeater-field', function(event) {
        $(this).trigger('change');
    });

    $(document).on('change', '.themefarmer-repeater-field, .themefarmer-repeater-repeater-field', function(event) {
        var selector = $(this).parents('.themefarmer-repeater');
        update_tf_repeater(selector);
    });

    $(document).on('click', '.themefarmer-repeater-add-new', function(event) {
        var repeater = $(this).siblings('.themefarmer-repeater');
        var repeater_item = $(this).siblings('.themefarmer-repeater-copy').children('.themefarmer-repeater-item-copy').clone();
        repeater_item.removeClass('themefarmer-repeater-item-copy').addClass('themefarmer-repeater-item');
        console.log(repeater_item);
        var index = repeater.children('.themefarmer-repeater-item').length;
        repeater_item.find('.index').text(index + 1);
        repeater.append(repeater_item);
        var selector = $(this).siblings('.themefarmer-repeater');
        update_tf_repeater(selector);
    });

    $(document).on('click', '.themefarmer-repeater-add-repeater', function(event) {
        var r_repeater = $(this).siblings('.themefarmer-repeater-repeater-group');
        var r_repeater_item = $(this).parents('.themefarmer-repeater-repeater').siblings('.themefarmer-repeater-repeater-copy').children('.themefarmer-repeater-repeater-group-copy').clone();
        r_repeater_item.removeClass('themefarmer-repeater-repeater-group-copy').addClass('themefarmer-repeater-repeater-group');
        $(this).before(r_repeater_item);
        var selector = $(this).parents('.themefarmer-repeater');
        update_tf_repeater(selector);
    });

    $(document).on('click', '.themefarmer-repeater-remove-item', function(event) {
        var selector = $(this).parents('.themefarmer-repeater');
        $(this).parents('.themefarmer-repeater-item').remove();
        update_tf_repeater(selector);
    });

    $(document).on('click', '.themefarmer-repeater-remove-repeater', function(event) {
        var selector = $(this).parents('.themefarmer-repeater');
        $(this).parents('.themefarmer-repeater-repeater-group').remove();
        update_tf_repeater(selector);
    });

});
jQuery(document).ready(function($) {
    'use strict';
    var button_class = '.image-select-button';
    jQuery(document).on('click', button_class, function() {
        var button_id = '#' + jQuery(this).attr('id');
        var display_field = jQuery(this).parent().children('input:text');
        var _custom_media = true;

        wp.media.editor.send.attachment = function(props, attachment) {

            if (_custom_media) {
                if (typeof display_field !== 'undefined') {
                    switch (props.size) {
                        case 'full':
                            display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
                            break;
                        case 'medium':
                            display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
                            break;
                        case 'thumbnail':
                            display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
                            break;
                        default:
                            display_field.val(attachment.url);
                            display_field.trigger('change');
                    }
                }
                _custom_media = false;
            } else {
                return wp.media.editor.send.attachment(button_id, [props, attachment]);
            }
        };
        wp.media.editor.open(button_class);
        return false;
    });









    $(document).on('click', '.repeater-head', function(event) {
        var r_contaier = $(this).parent();
        if (r_contaier.hasClass('repeater-expanded')) {
            r_contaier.removeClass('repeater-expanded');
            r_contaier.children('.repeater-body').hide('fast');

        } else {
            r_contaier.addClass('repeater-expanded');
            r_contaier.children('.repeater-body').show('fast');
        }
    });


});


function media_upload(button_class) {
    'use strict';
    jQuery('body').on('click', button_class, function() {
        var button_id = '#' + jQuery(this).attr('id');
        var display_field = jQuery(this).parent().children('input:text');
        var _custom_media = true;

        wp.media.editor.send.attachment = function(props, attachment) {

            if (_custom_media) {
                if (typeof display_field !== 'undefined') {
                    switch (props.size) {
                        case 'full':
                            display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
                            break;
                        case 'medium':
                            display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
                            break;
                        case 'thumbnail':
                            display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
                            break;
                        default:
                            display_field.val(attachment.url);
                            display_field.trigger('change');
                    }
                }
                _custom_media = false;
            } else {
                return wp.media.editor.send.attachment(button_id, [props, attachment]);
            }
        };
        wp.media.editor.open(button_class);
        window.send_to_editor = function(html) {

        };
        return false;
    });
}