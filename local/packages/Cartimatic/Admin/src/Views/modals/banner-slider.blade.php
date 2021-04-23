{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 29-Apr-16 10:13 AM
    * File Name    : 

--}}

<div class="col-sm-12">
	<div class="instructions">
    	<p>- An image shloud have minimum width ot 770px and minimum height of 386px</p>
        <p>- You can mark an image as featured by clicking the start icon, otherwise first image will be considered featured image</p>
    </div>
    {!! Form::open(['route' => 'admin.save-banner-slider','role'=>'form', 'class'=>'main-banner', 'id'=>'form',"enctype"=>"multipart/form-data", 'data-toggle'=>"validator"]) !!}
    {!! Form::hidden('banner_id', $categoryId) !!}

    <div class="row" id="field-box">

        @if(count($slider)  > 0)
            @foreach($slider as $key => $row)
                <div class="single-field" id="">
                    <div class="col-sm-12">
                        <div class="col-sm-1"><span class="sort" aria-hidden="true"></span></div>
                        <div class="col-sm-4">

                            {!! Form::file('sliderImage[]', ['class'=>'hide slider-file-field']) !!}
                            {!! Form::hidden('slider_id[]',$row->id) !!}
                            <img src="{!! getImage($row->banner_path) !!}"
                                 class="img-thumbnail add-slider-image" alt="Cinque Terre" width="304" height="236">
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group url-type-field" id="url-field">
                                <label for="title">URL:</label>
                                <input type="url" name="url[]" class="form-control" id="title" required placeholder="Enter URL" value="{{$row->object_value}}">
                            </div>
                        </div>
                        @if($key != 0)
                            <div class="col-sm-1">
                                <span class="remove remove-single-field" aria-hidden="true"
                                      data-id="{{$row->id}}">

                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="single-field" id="">
                <div class="col-sm-12">
                    <div class="col-sm-4">
                        <span class="sort" aria-hidden="true"></span>
                        {!! Form::file('sliderImage[]', ['class'=>'hide slider-file-field']) !!}
                        <img src="{!! asset('local/public/assets/image/upload-btn.png') !!}"
                             class="img-thumbnail add-slider-image" alt="Cinque Terre" width="304" height="236">
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group url-type-field" id="url-field">
                            <label for="title">URL:</label>
                            <input type="url" name="url[]" class="form-control" id="title" required
                                   placeholder="Enter URL">
                        </div>
                    </div>
                </div>
            </div>
        @endif


    </div>
    @if(count($slider)  < 5)
        <div class="col-sm-12">
            <span class="add-more" id="add-more"
                  data-placeholder="{!! asset('local/public/assets/image/upload-btn.png') !!}">Add More</span>
        </div>
    @endif
    {!! Form::close() !!}
</div>
