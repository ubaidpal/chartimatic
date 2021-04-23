{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 25-Apr-16 4:20 PM
    * File Name    :

--}}
@extends('Admin::layout.store-admin')
@section('content')
        <!-- Post Div-->
@include('Admin::layout.arbitrator-leftnav')
@include('Admin::alert.alert')
<div class="ad_main_wrapper" id="ad_main_wrapper">
    <div class="task_inner_wrapper">
        <div class="main_heading">
            <h1>Select Home Page Categories</h1>
        </div>
        <div class="task-tabs">
            <a href="{{route('admin.settings')}}"
               class="@if(\Request::is('admin/settings')) active @endif">Permissions</a>
            <a href="{{route('admin.home-settings')}}" class="@if(\Request::is('admin/home-categories')) active @endif">Home
                Page Categories</a>
        </div>

        {!! Form::open(['route'=> 'admin.save-categories']) !!}

        <div class="assigned-task-wrapper">
            <div class="user-table heading">
                <div class="role" style="width: 84px">Select</div>
                <div class="name" style="width: 215px">Category</div>
                <div class="name" style="width: 215px">Image</div>
                <div class="action">Status</div>
            </div>

            @if(count($categories) > 0)
                @foreach($categories as $category)
                    <div class="user-table">
                        <div class="role" style="width: 84px">
                            {!! Form::checkbox('categories[]', $category->id, (isset($category->home_category) && $category->home_category->status == 1?TRUE:FALSE)) !!}
                        </div>
                        <div class="name" style="width: 215px">{{$category->name}}</div>
                        <div class="name" style="width: 215px">
                            @if(isset($category->home_category))
                                <img src="">
                            @endif
                        </div>
                        <div class="action">
                            <a title="Edit permissions" href="#" class="add-detail" id="{{$category->id}}">
                                Add Detail
                            </a>
                        </div>

                    </div>

                @endforeach
                {!! Form::submit('Save') !!}
            @else
                No record found
            @endif
        </div>
        {!! Form::close() !!}
    </div>
    {!!  $categories->render() !!}
</div>

<style>
    .user-table div.role {
        width: 120px;
    }
</style>
<div class="modal-box cart" id="confirmation_popup" style="display: none;">
    <a href="#" class="js-modal-close close">?</a>

    <div class="modal-body">
        {!! Form::open(['route' => 'admin.save-categories']) !!}
        {!! Form::hidden('category_id', '',['id'=>'category_id']) !!}
        <div class="bank-detail-popup">
            <div class="bd-ttle">Category Details</div>
            <div class="bd-itm">
                <div class="bd-itml">Title:</div>
                <div class="bd-itmr">
                    <input type="text" placeholder="" value="" required>
                </div>
            </div>
            <div class="bd-itm">
                <div class="bd-itml">Subtitle:</div>
                <div class="bd-itmr">
                    <input type="text" placeholder="" value="" required>
                </div>
            </div>
            <div class="bd-itm">
                <div class="bd-itml">Image:</div>
                <div class="bd-itmr">
                    {!! Form::file('image') !!}
                </div>
            </div>
            <div class="bd-itm">

                <div class="bd-itmr">
                    {!! Form::submit('Save') !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
@section('footer-scripts')
    <script>
        $(document).ready(function () {

            $('.add-detail').click(function (e) {
                e.preventDefault();
                var id = $(this).attr('id');
                $('#category_id').val(id);

                var appendthis = ("<div class='modal-overlay js-modal-close'></div>");

                $("body").append(appendthis);
                jQuery('body').css('overflow', 'hidden');
                $(".modal-overlay").fadeTo(500, 0.7);

                $('#confirmation_popup').fadeIn($(this).data());

                var url = jQuery(this).attr('id');
                jQuery('.confirmed').attr('id', url);
            })

        });

    </script>
@endsection
