/**
 * Created by Admin on 06-1-16.
 */
var loading             = $('#loading');
var loading_2           = $('#loading-2');

var msg_form          = $('#msg-form');
var msg_body            = $('#msg-body');
var messageBox = $('#messageBox');
var new_message_trigger = $('#trigger');
var chat_title;
var is_new_conv         = 0;
$(document).ready(function(){
    //scroll to bottom
    setTimeout(function(){
        scroll();
    },500);

    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });


    //Search within conversations
    var selector_conversation = $('#search-input');
    selector_conversation.keyup(function(){
        var val       = $(this).val();
        var search_in = $('.conversation');
        search_in.hide();
        var i = 0;
        $('.not-found').remove();
        search_in.each(function(index, element){
            var text = $(element).find('div.msg-title').text();
            if(text.toLowerCase().indexOf(val) >= 0){
                $(this).show();
                i ++;
            }else{
                //console.log('no')
            }
        });
        if(i == 0){
            $('.messages-wrapper').append('<div class="user-msgs-box not-found" style="text-align: center">' + '<h3 >Not Found</h3>' + '<p>No people or conversations named ' + val + '</p>' + '</div>');
        }
    });

    // Send Message
    //var send_selector = $('.cht-send');
    $(document).on('click', '#send-msg', function (e) {
        e.preventDefault();
        var file = $('#postFiles').val();
        loading.show();
        var data = new FormData(msg_form[0]);
        console.log(data);
        var messageContent = msg_body.val();
        if (messageContent != '' || file != '') {
            msg_body.prop('disabled', true);
            msg_body.val('');
            $.ajax({
                type: 'POST',
                url: msg_form.attr('action'),
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {

                    msg_body.prop('disabled', false);
                    var attachment = '';
                    if (!jQuery.isEmptyObject(data.attachment)) {
                        console.log(data);
                        attachment = '<span class="attachment-icon"></span><div class="linkDownload mar-bt-10"><span class="attachment-name"><img src=" /photo/' + data.attachment.storage_path + '" width="100"> </span><span class="attachment-url"><a download="" href="/photo/' + data.attachment.storage_path + '"> Download</a></span></div>';
                    }
                    var msg = '<div class=" my-messages "><div class="col-md-2"></div><div class="col-md-8"><div class="text-message">' + attachment + messageContent + '</div></div><div class="col-md-2"><div class="user-name">Me</div><div class="msg-date">Sep 22 | 10:53 AM</div></div></div>';
                    $('#no-data').remove();
                    messageBox.append(msg);
                    loading.hide();
                    $('#postFiles').val('');
                    scroll();
                },
                error: function (error) {
                    msg_body.prop('disabled', false);
                    $('[data-form="create-new-message"]').remove();
                    loading.hide();
                }
            });
        }
    });

    // New Message
    var new_message = $('#new-message');
    new_message.click(function(){
        $('#friends').tokenize().clear();
        loading.show();
        $('#conversation-messages').hide();
        $('.conv-id').val('');
        loading.hide();
        $('.message-thread-title').hide();
        $('#all-friends').show();
        $('.message-btn').hide();
        $('#close-new-message').show();
        //$('#conversation-messages').html(data);
        message_box.removeClass('conversation-messages-update');
        is_new_conv = 1;
        reply_form.show();

        //Message filter
        $('.messages-conv').show();
        $('.dispute').hide();
        $('.msg-filter').removeClass('active');
        $("[data-type=messages-conv]").addClass('active');

    });

    // Leave Conversation
    var leave_conversation = $('.leave-conversation');
    $(document).on('click', '.leave-conversation', function(e){
        e.preventDefault();

        if(confirm('Are you sure to leave conversation?')){
            var $this = $(this);
            $this.parents('.conv-for').remove();
            loading.show();
            $.ajax({
                type : 'GET', url : $(this).data('url'), success : function(data){
                    loading.hide();
                    $(".conv-box").children().first().trigger('click');
                }
            });
        }
    });

    $('#trigger').click(function(event){

        //event.stopPropagation();
        $(this).hide();
        $('.rename-conv').focus(function(){
            $(this).select();
        });
        $('#rename').show();

    });

    $('#cancel-btn').click(function(e){
        e.preventDefault();
        $('#rename').hide();

    });

    $('#chat-attachment').on('click', function(e){
        e.preventDefault();
        $('#postFiles').trigger('click');
    });

    $('#postFiles').change(function(){
        $('#send-msg').click();
    });

    $('.chat-trigger').click(function(){

        $('.conv-chat-trigger').data('group', $('#groupId').val());
        $('.conv-chat-trigger').data('user', $('#userForChat').val());
        $('.conv-chat-trigger').data('type', $('#chat_type').val());

        $('.conv-chat-trigger').trigger('click');
    });
    var height = $(window).innerHeight();
    messageBox.css({
        maxHeight : height - 327, minHeight : height - 327
    });

    $('.new-message-field').css({
        maxHeight : height - 250, minHeight : height - 250
    });
    $('.mainContainer').css({
        maxHeight : height - 50, minHeight : height - 50
    });
    $('.conv-box').css({
        maxHeight : height - 206
    });

    // Hide New message BOX
    $('#close-new-message').click(function(){
        $('.message-btn').show();
        $(this).hide();
        $('#all-friends').hide();
        $('#conversation-messages').show();
        $('.message-thread-title').show();
    })


    // Message fiilter
    $('.msg-filter').click(function(e){
        e.preventDefault();
        var type = $(this).data('type');
        $('.msg-filter').removeClass('active');
        $(this).addClass('active');
        $('.conv-for').hide();
        $('.'+type).show();
    })

});
$(document).on('keypress', function(e){
    if(e.which == 13){
        e.preventDefault();
        if($('.rename-conv').is(':focus')){
            rename_conversation();
        }else if(msg_body.is(':focus')){
            $('#send-msg').click()
        }
    }
});

$(document).mouseup(function(e){
    var container = $("#rename");
    var clickBtn  = $("#trigger");
    if(! container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0 || clickBtn.is(e.target)) // ... nor a descendant of the
    // container
    {
        //container.hide();
    }

});

function rename_conversation(){
    loading.show();
    var rename_conversation = $('#rename-conversation');
    if(rename_conversation.find('input[name="name"]').val() != ''){
        $.ajax({
            type : 'POST',
            url : rename_conversation.attr('action'),
            data : rename_conversation.serialize(),
            success : function(data){
                loading.hide();
                $('#rename').hide();
                $('#trigger').show();
                $('#trigger').text(rename_conversation.find('input[name="name"]').val());

            }
        });
    }
}
/*$(document).ajaxSuccess(function(){
 $('#friends').tokenize({
 placeholder: 'Type to select friend'
 });
 })*/
function scroll(){
    messageBox.animate({
        scrollTop : messageBox.prop("scrollHeight")
    }, 0);
}
