{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 29-Apr-16 10:13 AM
    * File Name    : 

--}}
<div class="col-sm-12 ">

    {!! Form::model($item,['route' => 'admin.home-settings','role'=>'form', 'class'=>'main-banner',"enctype"=>"multipart/form-data",'data-toggle'=>"validator",'id'=>'form']) !!}
    {!! Form::file('image', ['id'=>'select-image', 'style'=> 'top:30px;position:absolute;display:none']) !!}
    {!! Form::hidden('item_id', $categoryId) !!}

    <div class="col-sm-12">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" value="{{$item->title}}" name="title" class="form-control" id="title" required placeholder="Title">

        </div>
        <div class="checkbox">

            <label class="radio-inline" for="url">
                <input class="url-type" type="radio" name="url_type" value="url" id="url" @if($item->object_type == 'url') checked @endif> URL</label>
            <label class="radio-inline" for="category">
                <input class="url-type" type="radio" name="url_type" value="category" id="category" @if($item->object_type == 'category') checked @endif> Category
            </label>
        </div>
        <div class="form-group url-type-field @if($item->object_type == 'category') hide @endif" id="url-field" >
            <label for="title">URL:</label>
            <input type="text" name="url" class="form-control" id="title" required placeholder="Enter URL" value="{{$item->object_value}}">
        </div>
        <div class="form-group url-type-field @if($item->object_type == 'url') hide @endif" id="category-field">
            <label for="title">Category:</label>
            {!! Form::select('category', $categories, $item->object_value, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="title">Sub Title:</label>
            <input type="text" name="sub_title" class="form-control" id="title" required placeholder="Enter Subtitle" value="{{$item->secondary_title}}">
        </div>
    </div>
    {!! Form::close() !!}
</div>
