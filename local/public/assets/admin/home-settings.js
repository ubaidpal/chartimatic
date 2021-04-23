/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 02-May-16 10:49 AM
 * File Name    :
 */

;(function ($) {

    var console = window.console || {
            log: function () {
            }
        };


    $.fn.initiate = function () {
        var formSubmitBtn = $('#modal-submit');
        var formSelector = '';
        var $avatarView = $('.crop-avatar');

        // Other Events;
        $(document).ready(function () {
            $('a[data-toggle="modal"]').on('click', function (e) {
                formSelector = $(this).data('form');
            });

            $(document).on('click', '.get-image', function () {
                $('#select-image').trigger('click')
            });

            formSubmitBtn.click(function (e) {
                e.preventDefault();
                var submit = true;
                $('input[name^="url"]').each(function () {

                    if ($(this).val() == '' && $(this).attr('required')) {
                        $(this).parent().addClass('has-error');
                        submit = false;

                        return false;
                    } else {
                        $(this).parent().removeClass('has-error')
                    }
                });

                if (submit) {
                    $('.' + formSelector).submit();
                }

            });

            $(document).on('click', '.url-type', function () {

                var val = $(this).val();
                $('.url-type-field').addClass('hide');
                if (val == 'category') {
                    $('#category-field').removeClass('hide');
                    $('#url-field').find('input').prop('required', false);
                    $('#category-field').find('select').prop('required', true);
                } else {
                    $('#url-field').removeClass('hide');
                    $('#category-field').find('select').prop('required', false);
                    $('#url-field').find('input').prop('required', true);
                }
            });

            $(document).on('click', '#add-more', function () {
                var count = $('.single-field').length;
                if (count <= 5) {
                    var placeholder = $(this).data('placeholder');
                    var html = '<div class="single-field" id=""><div class="col-sm-12"><div class="col-sm-1"><span class="sort" aria-hidden="true"></span></div><div class="col-sm-4"><input class="hide slider-file-field" type="file" name="sliderImage[]"><img src="' + placeholder + '" class="img-thumbnail add-slider-image" alt="Cinque Terre" width="304" height="236"></div><div class="col-sm-6"><div class="form-group url-type-field" id="url-field"><label for="title">URL:</label><input type="text" name="url[]" class="form-control" id="title" required placeholder="Enter URL"></div></div><div class="col-sm-1"><span class="remove remove-single-field" aria-hidden="true"></span></div></div></div>';
                    $('#field-box').append(html);
                    $('#form').validator();
                }
                var count = $('.single-field').length;
                if (count == 5) {
                    $('#add-more').hide();
                }
            });

            var deleteSlider = function ($id) {
                $.ajax({
                    url: '/admin/delete-slider',
                    method: "POST",
                    data: {id: $id},
                    success: function (data) {

                    }
                })
            };
            $(document).on('click', '.remove-single-field', function () {
                $(this).parents('.single-field').remove();
                if ($(this).attr('data-id')) {
                    deleteSlider($(this).data('id'));
                }
                var count = $('.single-field').length;
                if (count < 5) {
                    $('#add-more').show();
                }
            });

            $(document).on('click', '.add-slider-image', function () {
                $(this).siblings('.slider-file-field').trigger('click')
            });

            $(document).on('change', '.slider-file-field', function () {
                var url = $(this).val();
                var $this = $(this);
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if ($(this).prop('files') && $(this).prop('files')[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $this.siblings('.add-slider-image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL($(this).prop('files')[0]);
                }
                else {
                    $('#img').attr('src', '/assets/no_preview.png');
                }
            });

            $('.change-status').click(function(){
                var url = $(this).data('href');
                var $this = $(this);
                $.ajax({
                    method:'GET',
                    url:url,
                    success:function($data){
                        if($data == 1){
                            $this.text('UnPublish')
                        }else{
                            $this.text('Publish')
                        }
                    }
                })
            })
        });


    };

    var initiate = $.fn.initiate();
    $(document).ajaxSuccess(function () {
        $('#form').validator();
    })
})(jQuery, window, document);


