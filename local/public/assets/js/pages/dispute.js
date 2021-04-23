/**
 * Created by Admin on 29-Feb-2016.
 */
var loading = $('#loading-2');
var msg_body = $('#msg-body');
var form = $('#msg-form');
var messageBox = $('#messageBox');
var no_message = $('#no-messages');

var changeFields = function (number) {
    $('input[name="receiver_id"]').remove();
    $('input[name="order_id"]').remove();
    var field = '<input type="hidden" value="' + number + '" name="conv_id">';
    form.append(field);
};
function getMessages(URL, $oldCount, $newCount) {
    $.ajaxSetup(
        {
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        });
    var id = $('input[name="conv_id"]').val();
    if (id !== undefined || id !== null) {
        $.ajax({
            type: "POST",
            url: "/store/get-messages",
            data: {conv_id: id},
            success: function (data) {
                messageBox.empty();
                messageBox.append(data)
            }
        })
    }
}
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
        var receiver = $('input[name="receiver_id"]').val();

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
                    if (!jQuery.isEmptyObject(data.attachment)) {
                        attachment = '<span class="attachment-icon"></span><div class="linkDownload mar-bt-10"><span class="attachment-name">' + data.attachment.name + '</span><span class="attachment-url"><a download="" href="/photo/' + data.attachment.storage_path + '"> Download</a></span></div>';
                    }
                    var msg = '<div class="msg-list"><div class="col-md-2"><div class="name">Me</div><div class="td">May 25 | 11:19 AM</div></div><div class="col-md-10"><div class="msg me">' + attachment + messageContent + '</div></div></div>';
                    $('#no-data').remove();
                    messageBox.append(msg);
                    if (receiver !== undefined) {

                        changeFields(data.data.conv_id);
                    }
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
    });

    setInterval("getMessages('checker.php',$('old_count'),$('new_count'));", 10000);
});
