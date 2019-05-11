jQuery(document).ready(function ($) {

    var custom_uploader;
    jQuery('#songbook_addfile_button').click(function (e) {
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: songbook_filebox_script.choosefiles,
            button: {
                text: songbook_filebox_script.selectfiles_butt
            },
            multiple: true
        });
        custom_uploader.on('select', function () {
            var selection = custom_uploader.state().get('selection');
            selection.map(function (attachment) {
                attachment = attachment.toJSON();
                filediv(extension(attachment.url), attachment.filename, attachment.url, attachment.id, sbfDef.lock);
            });
        });
        custom_uploader.open();
    });

    jQuery("#obal").sortable({
        handle: ".exticon",
        axis: "y"
    });

    jQuery('#obal').on('click', '.textch', function () {
        var elid = jQuery(this).attr('rel');
        var newtitle = window.prompt(songbook_filebox_func.new_title);
        if (newtitle) {
            var hrefid = 'href_' + elid;
            var titleid = 'title_' + elid;
            jQuery("#" + hrefid).html(newtitle);
            jQuery("#" + titleid).val(newtitle);
        }
    });
    jQuery('#obal').on('click', '.remover', function () {
        var elid = jQuery(this).attr('rel');
        var remconfirm = window.confirm(songbook_filebox_func.unlink_confirm);
        if (remconfirm) {
            var idname = 'file_' + elid;
            jQuery("#" + idname).remove();

            if (jQuery('#obal .file').length == 0)
                jQuery('#obal .nofile').css('display', 'block');
        }

    });
    jQuery("#obal").on('click', '.lock', function () {
        var elid = jQuery(this).attr('rel');
        jQuery(this).toggleClass('locked');
        jQuery(this).toggleClass('unlocked');
        var idname = 'private_' + elid;
        var privvalue = jQuery("#" + idname).val();
        if (privvalue === 'private')
            jQuery("#" + idname).val('public');
        if (privvalue === 'public')
            jQuery("#" + idname).val('private');
    });

    jQuery('#songbook_addfile_gdocs').click(function () {
        jQuery('#dialog_add_gdocs').dialog({
            open: function (event, ui) {
                jQuery('#dialog_add_gdocs input').val('');
                jQuery('#selicon img.selected').removeClass('selected');
                jQuery('#pgtitle').hide();

                jQuery(".ui-dialog-titlebar-close", ui.dialog || ui).hide();
            },
            buttons: [
                {
                    text: 'Add file',
                    click: function () {

                        var url = jQuery('#dialog_add_gdocs #fileurl').val();
                        if (url.indexOf('http') === -1)
                            url = 'http://' + url;

                        var title = jQuery('#pgtitle input').val();
                        var id = 'g' + toascii(jQuery('#dialog_add_gdocs #fileurl').val());
                        var ictype = jQuery('#selicon img.selected').attr('id');

                        if (title.length > 2 && ictype.length > 2)
                            filediv(ictype, title, url, id, sbfDef.lock);
                        else {
                            alert(songbook_filebox_script.docs_nocontent);
                            return;
                        }

                        jQuery(this).dialog("close");
                    },
                }
            ]
        });

        jQuery('#fileurl').on('keyup blur', function () {
            var expression = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
            var regex = new RegExp(expression);
            var t = jQuery(this).val();

            if (t.match(regex)) {
                jQuery('#pgtitle').show();

                jQuery.post(ajaxurl, {
                    'action': 'gdocstitle',
                    'url': t
                }, function (response) {
                    jQuery('#pgtitle input').val(response.replace('0', ''));
                });

            } else
                jQuery('#pgtitle').hide();
        });
    });

    jQuery('.subopt').hide();

    jQuery('#selicon img').on('click', function () {
        jQuery('#selicon img.selected').toggleClass('selected');
        jQuery(this).toggleClass('selected');
    });

});
