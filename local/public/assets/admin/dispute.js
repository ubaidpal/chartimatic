/**
 * Created by Admin on 29-Feb-2016.
 */
var loading = $('#loading-2');
var msg_body = $('#msg-body');
var form = $('#msg-form');
var messageBox = $('#messageBox');
var no_message = $('#no-messages');

$(document).ready(function () {
    //scroll to bottom
    //scroll();

    $.ajaxSetup(
        {
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        });

    $(document).on('click', '#send-msg', function (e) {
        e.preventDefault();

        var file = $('#postFiles').val();
        loading.show();
        var data = new FormData(form[0]);
        var messageContent = msg_body.val();
        if (messageContent != '' || file != '') {
            msg_body.prop('disabled', true);
            msg_body.val('');
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    no_message.remove();
                    msg_body.prop('disabled', false);
                    var attachment = '';

                    if(!jQuery.isEmptyObject(data.attachment)){
                        attachment = '<div class="linkDownload"><span class="attachment-name">'+data.attachment.name+ ' </span><span class="attachment-url"><a href="/photo/'+data.attachment.storage_path+'" download="">Download</a></span></div>'
                    }

                    var msg = '<div class="comnt-wrapper"><a class="comntr-pic" href="http://dev.shalmi.com/brand/HeroMotoCorp">Me</a><div class="comnt-detail"><div class="post-name"><a href=""></a></div><div class="label"> ARBITRATOR</div><p>'+messageContent+'</p><span class="attachment-icon"></span>'+attachment+'<em title="">May 26 2016 06:55 AM</em></div></div>';

                    messageBox.append(msg);
                    loading.hide();
                    $('#postFiles').val('');
                },
                error: function (error) {
                    msg_body.prop('disabled', false);
                    $('[data-form="create-new-message"]').remove();
                    loading.hide();
                }
            });
        }
    });

    $(document).on('keypress', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            if ($('.rename-conv').is(':focus')) {
                rename_conversation();
            } else if (msg_body.is(':focus')) {
                $('#send-msg').click()
            }
        }
    });

    $('#chat-attachment').on('click', function (e) {
        e.preventDefault();
        $('#postFiles').trigger('click');
    });
    $('#postFiles').change(function () {

        $('#send-msg').click();
    })
});
