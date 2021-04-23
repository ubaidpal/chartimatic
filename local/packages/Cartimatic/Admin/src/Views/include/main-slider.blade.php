{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 28-Apr-16 12:16 PM
    * File Name    : 

--}}
<div class="col-md-9">
    <div class="row">
        <div class="product-slider">


            {{--<div class="crop-avatar" data-aspect-ratio="162/67" data-height="335"
                 data-width="860" data-item-id=""  data-type="slider-banner">
                <!-- Current avatar -->
                <div class="avatar-view" title="Change Banner ">
                    Add
                </div>
            </div>--}}
            <a data-form="main-banner" data-header="Slider" data-toggle="modal"
               data-target="#myModal"
               href="{{route('admin.modal',['banner-slider'])}}" class="edit-item">Edit</a>

            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->

                <ol class="carousel-indicators">
                    @foreach($slider as $key => $row)
                        <li data-target="#myCarousel" data-slide-to="{{$key}}"
                            class="@if($key == 0) active @endif"></li>
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @foreach($slider as $key => $row)
                        <div class="item @if($key == 0) active @endif">
                            <a href="{{$row->object_value}}">
                                <img src="{{url($row->banner_path)}}"
                                     alt="Image">
                            </a>


                            <div class="carousel-caption">
                                <h3>Chania</h3>

                                <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
