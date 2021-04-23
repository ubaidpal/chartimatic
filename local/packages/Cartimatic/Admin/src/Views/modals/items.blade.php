{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 29-Apr-16 10:13 AM
    * File Name    : 

--}}
<div class="col-sm-12 ">

    {!! Form::open(['route' => 'admin.home-settings','role'=>'form', 'class'=>'main-banner',"enctype"=>"multipart/form-data" ,'data-toggle'=>"validator",'id'=>'form']) !!}
    {!! Form::file('image', ['id'=>'select-image', 'style'=> 'top:30px;position:absolute;display:none']) !!}
    {!! Form::hidden('parent_id', $categoryId) !!}

    <div class="col-sm-12">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" id="title" required placeholder="Title">
        </div>
        <div class="checkbox">

            <label class="radio-inline" for="url">
                <input class="url-type" type="radio" name="url_type" value="url" id="url" checked> URL</label>
            <label class="radio-inline" for="category">
                <input class="url-type" type="radio" name="url_type" value="category" id="category"> Category</label>
        </div>
        <div class="form-group url-type-field" id="url-field">
            <label for="title">URL:</label>
            <input type="text" name="url" class="form-control" id="title" required placeholder="Enter URL">
        </div>
        <div class="form-group url-type-field hide" id="category-field">
            <label for="title">Category:</label>
            {!! Form::select('category', $categories, NULL, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="title">Sub Title:</label>
            <input type="text" name="sub_title" class="form-control" id="title" required placeholder="Enter Subtitle">
        </div>
    </div>
    {!! Form::close() !!}
</div>
