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
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                
                <?php $slider = isset($slider)?$slider: []?>
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
                                <img src="{{$row->banner_path}}"
                                     alt="Chania">
                            </a>


                            <!--<div class="carousel-caption">
                                <h3>Static Title of slide</h3>

                                <p>The static description of slide.</p>
                            </div>-->
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
