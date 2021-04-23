/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 24-May-16 4:17 PM
 * File Name    :
 */
var HTMLEle = '<div class="col-right mar-bt-10 clearfix attachment-block"><label class="file col-sm-8"><input type="file" name="attachments[]" class="attachment"><span class="file-custom"></span></label><div class="col-sm-4"><a class="thumbnail" href="#"><img alt="..." src="http://dev.shalmi.com/local/public/assets/images/cartimatic/product-large-image.jpg"></a></div></div>';
$.ajaxSetup(
    {
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $(input).val().split('\\').pop();

        reader.onload = function (e) {
            var imgSelector = $(input).parents('.attachment-block').find('img');
            //$(input).siblings('.file-custom').empty();
            // $(input).siblings('.file-custom').text(filename)
            imgSelector.attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
$(document).on('change', '.attachment', function () {
    readURL(this);
});
$('.more-attachment').click(function () {
    $('.append-more').append(HTMLEle);
});

$('.remove-attachment').click(function () {
    var id = $(this).data('id');
    var $this = $(this);
    $.ajaxSetup(
        {
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        });
    $.ajax({
        type: 'POST',
        url: '/shalmi/store/dispute/delete-attachment',
        data: {id: id},
        success: function (data) {
            if (data == 1) {
                $('#attachment-' + id).remove();
            }
        }
    })
});
