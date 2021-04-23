@extends('Admin::layout.store-admin')

@section('content')
        <!-- Post Div-->
@include('Admin::layout.arbitrator-leftnav')
<div class="mainCont">
    <div class="product-Analytics">
        <div class="post-box">
            <h1>Categories</h1>
            @include('Admin::alert.alert')
            <div class="selectdiv m0">
                {!! Form::open(['url' => url("admin/save/categories"), "id" => "Category", "Method" => "Post", "enctype"=>"multipart/form-data"]) !!}
                <input required="required" type="text" id="name" name="name" placeholder="Add Category..." class="storeInput fltL mr10 w340">
                <input type="text" id="category_icon_url" name="category_icon_url" value="icon.png" placeholder="Add Category icon url." class="storeInput fltL mr10 w340">
                <input type="hidden" name="category_image" value="admin_main_categories/default.jpg" id="image_file" class="img_upt">
              <br><br><br>
                <h2>Click to upload category image</h2>
                <div class="crop-avatar" data-aspect-ratio="6/1" data-height="200"
                     data-width="1200" data-item-id="{{1}}" data-target-field="#image_file">
                    <!-- Current avatar -->
                    <div class="avatar-view" title="Change the image">
                        <img src="{!! asset('local/public/assets/bootstrap/images/menclothing.jpg') !!}"
                             class="img-responsive" alt="promotion banner">
                    </div>
                </div>

                <input type="submit" class="btn blue fltL" id="add_button" value="Add"
                       title="Save your New Category"/>

                <div style="color:red;display: none;width: 190px;padding-top: 45px;" id="alert"></div>
                {!! Form::close() !!}
            </div>

            @if(is_object($allCategories))

                @foreach($allCategories as $category)
                    <div class="categoryList">
                        @if(isset($category->category_image))
                            <div class="crop-avatar" data-aspect-ratio="6/1" data-height="200"
                                 data-width="1200" data-item-id="{{$category->id}}" data-target-field="#image_file">
                                <!-- Current avatar -->
                                <div class="avatar-view" title="Click to change the {{$category->name}}'s banner image">
                                   <img src="{{ url($category->category_image) }}"
                                   class="img-responsive cat_Image" alt="promotion banner" style="width:80px;height:54px;">
                                </div>
                            </div>

                        @endif
                        <div>{{$category->name}}</div>
                        <div class="actW">

                            <a class="js-open-modal" data-modal-id="popup1-{{$category->id}}"
                               title="Edit {{$category->name}}" href="#">
                                <span class="editProduct ml20 mr20"></span>
                            </a>
                            <a class="js-open-modal" data-modal-id="popup2-{{$category->id}}"
                               title="Delete {{$category->name}}" href="#">
                                <span class="deleteProduct"></span>
                            </a>

                        </div>
                    </div>
                    {!! Form::open(array('method'=> 'post','url'=> "admin/edit/category/".$category->id)) !!}
                    @include('Admin::include.Editpop',
                    ['submitButtonText' => 'Update',
                     'title'=>$category->name,
                     'item' => 'Category',
                     'id' => 'popup1-'.$category->id])
                    {!! Form::close() !!}

                    {!! Form::open(array('method'=> 'get','url'=> "admin/delete/category/".$category->id)) !!}
                    @include('Admin::include.deletePop',
                        ['submitButtonText' => 'Delete',
                        'cancelButtonText' => 'Cancel',
                        'title' => 'Delete Category',
                        'text' => 'Are You Sure You Want To delete This category? All the Sub-categories and product will also be deleted',
                        'id' => 'popup2-'.$category->id])
                    {!! Form::close() !!}
                @endforeach
            @else
                <div class="categoryList">
                    <h3 class="notify">You have no categories added, create new one for your store product(s).</h3>
                </div>
            @endif
        </div>
<style>
     .category-list-item{
        padding: 5px 0px 2px 1px;
     }
    .sub-cal-list-wrapper{
        margin-left: 10px;
    }
     .cat-name:hover{
         cursor: pointer;
         background-color: #c9ecbb;
     }
    .cat-name{
        cursor: pointer;
        background-color: #dff0d8;
        width: 100%;
        height: 45px;
        padding-top: 13px;
        padding-left: 18px;
        font-size: 14px;
        color: #79763d;
    }


      ul li .cat-name a:hover {
         background-color: #fff;

     }
    .col{
        text-decoration: none;
        color: #0080e8;
    }


</style>

        <div class="post-box">
            @if(is_object($allCategories))
                <ul>
                @foreach($allCategories as $category)
                <li class="category-list-item category-list-item-{{$category->id}}" id="{{$category->id}}">
                    <div class="cat-name">
                        <span>{{$category->name}}</span>
                        <span>
                            <a class="cat-edit col" data-modal-id="popup1-{{$category->id}}" title="{{$category->name}}" href="">Edit</a>
                            <a class="cat-delete col"  data-modal-id="popup2-{{$category->id}}"
                               title="Delete {{$category->name}}" href="">Delete</a>
  <a class="col"  data-modal-id="popup3-{{$category->id}}"
     title="{{$category->name}}" href="">Add Sub Category</a>   </span>
                            {!! Form::open(array('method'=> 'post','url'=> "admin/main/edit/category/".$category->id)) !!}
                            @include('Admin::include.Editpop',
                            ['submitButtonText' => 'Update',
                             'title'=>$category->name,
                             'item' => 'Category',
                             'id' => 'popup1-'.$category->id])
                            {!! Form::close() !!}

                            {!! Form::open(array('method'=> 'get','url'=> "admin/main/delete/category/".$category->id)) !!}
                            @include('Admin::include.deletePop',
                                ['submitButtonText' => 'Delete',
                                'cancelButtonText' => 'Cancel',
                                'title' => 'Delete Category',
                                'text' => 'Are You Sure You Want To delete This category? All the Sub-categories will also be deleted.',
                                'id' => 'popup2-'.$category->id])
                            {!! Form::close() !!}



                    </div>
                </li>
                        {!! Form::open(array('url' => "admin/main/add/subcategory/".$category->id)) !!}

                        @include('Admin::include.AddSubCat',
                        ['submitButtonText' => 'Add Sub Categories',
                         'name'=>$category->name,
                         'title' => 'Categories',
                         'item' => 'Category',
                         'id' => 'popup3-'.$category->id])

                        {!! Form::close() !!}
@endforeach

            </ul>
                @endif
        </div>
        <!-- end category tree -->

    </div>
</div>
<script>

    $(document).on("click", "#popupAddCat", function(evt){
     $('.add_cat').show();
    });
    $('#name').keypress(function (e) {

        var regex = new RegExp(/^[a-zA-Z0-9-_!\s\b]+$/);
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);

        var nameVal = $('#name').val();
        var isnum = /^\d+$/.test(nameVal);

        if (isnum === true) {
            $('#alert').html('Only numeric is not allowed.').show();
        } else {
            $('#alert').hide();
        }

        if (regex.test(str)) {
            return true;
        }

        e.preventDefault();
        return false;
    });

    $(document).ready(function () {

        $("form").submit(function () {
            var nameVal = $('#name').val();
            var isnum = /^\d+$/.test(nameVal);
            if (isnum === true) {
                $('#alert').html('Only numeric is not allowed.').show();
                return false;
            }
            $("#add_button").prop('disabled', true);
            $("#add_button").val("Saving..");
        });

    });

    $(document).on("click", ".category-list-item", function(evt){
        evt.preventDefault();

        var parentId = evt.target.id;
        parentId = $(this).closest('li').attr('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: '{{ url("admin/filteredCategoryAjaxly") }}',
            type: "Post",
            data: { parent_id: parentId},
            success: function (data) {

                if($('.category-list-item-'+parentId).hasClass('expanded')){
                  $('.category-list-item-'+parentId).removeClass('expanded');
                  $('.category-list-item-'+parentId+ " .sub-cal-list-wrapper").hide();
                  return false;
                }

                if(data.length < 1){
                  return false;
                }

                var htmlDiv = '<div class="sub-cal-list-wrapper"><ul>';

                $.each(data, function (key, val) {
                    htmlDiv += '<li class="category-list-item category-list-item-'+val.id+'" id="'+val.id+'"><div class="cat-name">'+val.name+'<span>' +
                            '<a href="' + val.name + '" class="cat_edit" id="'+ val.id +'">Edit</a>' +
                            '<a href="#" class="cat_delete" name="'+val.name+'" id="'+ val.id + '"> Delete </a>'+
                            ' <a href="' + val.name + '" class="add_sub" id="'+ val.id + '">Add Sub Category</a></span></div></li>';
                    //alert(val.id+" <> " + val.name);
                });

                htmlDiv += '</ul></div>';
                $('.category-list-item-'+parentId).append(htmlDiv);
                $('.category-list-item-'+parentId).addClass('expanded');

            }, error: function (xhr, ajaxOptions, thrownError) {
                alert("ERROR:" + xhr.responseText + " - " + thrownError);
            }
        });

        return false;
    });
</script>

<script>
    $(document).on("click", ".cat_delete", function (e) {

       e.preventDefault();
        var appendthis = ("<div class='modal-overlay js-modal-close'></div>");
        $("body").append(appendthis);
        jQuery('body').css('overflow','hidden');

        $(".modal-overlay").fadeTo(500, 0.7);
        var subCategoriesId =  e.target.id;

        $(".del").attr("id", 'popup2-' + subCategoriesId);
        $(".del").show();
        $('#yes').click(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                type: "Post",
                url: '{{url("admin/subCategory/delete")}}',
                data: {subCategoriesId: subCategoriesId},
                success: function (data) {
                    if (data > 0 ) {

                        var url1 = '{{url('admin/categories' )}}';
                        window.location.href = url1 + '/' + 'deleted';

                    }else{
                        return false;
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });
        $('#no').click(function () {
            $('body').css({'overflow-y': 'auto', 'position': 'static', 'width': 'auto'});
            $(".modal-box, .modal-overlay").fadeOut(500, function () {
                $(".modal-overlay").remove();
            });
            $(".del").hide();
            return false;
        });

    });


    $(document).on("click", ".cat_edit", function (e) {
        var subCategoriesName = $(this).attr('href');
        e.preventDefault();
        var appendthis = ("<div class='modal-overlay js-modal-close'></div>");
        $("body").append(appendthis);
        jQuery('body').css('overflow','hidden');

        $(".modal-overlay").fadeTo(500, 0.7);
        var subCategoriesId = e.target.id;

        $(".sub_cate").val(subCategoriesName);
        $(".su_cat_update").val(subCategoriesId);
        $(".edit").attr("id", 'popup2-' + subCategoriesId);
        $(".edit").show();

        return false;


        //return false;
    });


    $(document).on("click", ".add_sub", function (e) {
        var subCategoriesName = $(this).attr('href');
        e.preventDefault();
        var appendthis = ("<div class='modal-overlay js-modal-close'></div>");
        $("body").append(appendthis);
        jQuery('body').css('overflow','hidden');

        $(".modal-overlay").fadeTo(500, 0.7);
        var subCategoriesId = e.target.id;

        $(".subCat").html(subCategoriesName);
        $(".su_cat_id").val(subCategoriesId);
        $(".add_Sub").attr("id", 'popup2-' + subCategoriesId);
        $(".add_Sub").show();

        return false;


        //return false;
    });
</script>
<div class="modal-box del" id="">
    <a href="#" class="js-modal-close close">?</a>
    <div class="modal-body">
        <div class="edit-photo-poup">
            <h3 style="color: #0080e8;">Delete Category</h3>
            <p class="mt10" style="width: 315px;height: 56px;line-height: normal">Are You Sure You Want To delete This Sub-category? All the Nested Sub-categories will also be deleted. </p>
            <input type="button" class="btn fltL blue mr10" id="yes" value="Yes"/>
            <input type="button" id="no" class="btn blue js-modal-close fltL close" value="Cancel"/>
        </div>
    </div>
</div>

<div class="modal-box edit" id="">
    {!! Form::open(array('url' => "admin/update/Subcategory")) !!}
    <a href="#" class="js-modal-close close">?</a>
    <div class="modal-body">
        <div class="edit-photo-poup">
            <h3 style="color: #0080e8;">Edit Sub Categories</h3>
            <input type="hidden" id="su-cat-id-update" class="su_cat_update" name="su_cat_id_update" value='' />
            <input required="required" type="text" id="edited_name" name="sub_cate" value="" placeholder="" class="storeInput cata
            input sub_cate"><div class="clrfix"></div>
            <input type="submit" class="btn fltL blue mr10" id="update" value="Update"/>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<div class="modal-box add_Sub" id="">
    {!! Form::open(array('url' => "admin/saves/Subcategories")) !!}
    <a href="#" class="js-modal-close close">?</a>
    <div class="modal-body">
        <div class="edit-photo-poup">
            <h3 style="color: #0080e8">Add Sub Categories</h3>
            <span class="subCat"></span>
            <div class="wall-photos">
                <div class="photoDetail">
                    <div class="form-container">
                        <div class="saveArea">
                            <input type="hidden" id="su_cat_id" class="su_cat_id" name="su_cat_id" value='' />
                            <input required="required" type="text" id="edited_name" name="sub_cate" value="" placeholder="" class="storeInput cata-input"><div class="clrfix"></div>
                            <input type="submit" class="btn fltL blue mr10" id="add" value="add"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>



@endsection

@section('footer-scripts')

    @include('Admin::modals.cropper', ['url'=> route('admin.update-main-image-category')])

    {!! HTML::script('local/public/assets/plugins/jquery-cropper/js/cropper.min.js') !!}
    {!! HTML::script('local/public/assets/plugins/jquery-cropper/js/main.js') !!}
    {!! HTML::script('local/public/assets/admin/home-settings.js') !!}
    @if(Session::has('data')['category_parent'])
      <script>
        $(document).ready(function () {
          //to move on recently added category
          var category_parent = 0;
          var category_id = 0;
          var info = 0;

          category_parent = '<?php echo Session::get('data')['category_parent']; ?>';
          category_id = '<?php echo Session::get('data')['category_id']; ?>';
          if (category_parent != 0) {
            $("#" + category_parent).click();
          }

          if (category_id != 0) {
            $("#" + category_id).click();
            $('html, body').animate({scrollTop: $(".category-list-item").offset().top}, 1000);
          }

          //end to move on recently added category
        });
      </script>
    @endif
@endsection
