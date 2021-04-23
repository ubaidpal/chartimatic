{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 29-Apr-16 10:13 AM
    * File Name    : 

--}}
<div class="col-sm-12 ">

    {!! Form::open(['route' => 'admin.home-settings','role'=>'form', 'class'=>'main-banner',"enctype"=>"multipart/form-data"]) !!}
    {!! Form::hidden('banner_id', $categoryId) !!}

    <div class="col-sm-12">
        <div class="form-group url-type-field" id="category-field">
            @if(count($categories) > 0)
                <label for="title">Category:</label>
                {!! Form::select('category', $categories, NULL, ['class'=>'form-control']) !!}
            @else
                There is no category found
            @endif
        </div>
    </div>
    {!! Form::close() !!}
</div>
