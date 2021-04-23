
<div class="col-md-12 col-sm-12 best-products">
    <div class="row">
        <div class="col-md-9 col-sm-9 mb0">
            <h3>Best seller products</h3>
        </div>
        <div class="col-md-3 col-sm-3">
            <!-- Controls -->
            <div class="controls pull-right hidden-xs">
                <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example"
                   data-slide="prev">&lt;</a>
                <a class="right fa fa-chevron-right btn btn-success" href="#carousel-example"
                   data-slide="next">&gt;</a>
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="row">
                <ul id="flexiselDemo3" class="col-md-12">
                <?php $countingItems = 0; ?>
                            @foreach($bestSellingProducts as $bestSellingProduct)
                        <li >
                            <?php
                            if(!isset($bestSellingProduct->id)){ continue;}
                            ?>
                            <a href="{{url('product/'.$bestSellingProduct->id)}}" title="{{$bestSellingProduct->title}}">
                                                <div class="">
                                                    <div class="col-item">
                                                        <div class="photo" style="background-color: #ffffff">
                                                            <img src="{!! getRandomImageOfProduct($bestSellingProduct->id) !!}"
                                                                 class="img-responsive" title="{{$bestSellingProduct->title}}" alt="Product Thumb" onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';" src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"/>
                                                        </div>
                                                        <div class="info">
                                                            <div class="row">
                                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                                    <h5>{{$bestSellingProduct->title}}</h5>
                                                                </div>
                                                                <div class="price col-md-4 col-sm-4 col-xs-6">
                                                                    <h5 class="actual">&#36;{{getMinimumProductPrice($bestSellingProduct->id)}}</h5>
                                                                    <!--<h5 class="discount">&#36;642.22</h5>-->
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <h5>{{getCategoryName($bestSellingProduct->category_id)}}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </a></li>
                            @endforeach
                        </ul>

        </div>
    </div>
</div>
</div>
@section('footer-scripts')
<script>
    $(document).ready(function () {
        $(".fa-chevron-left").click(function (evt) {
            $(".nbs-flexisel-nav-left").click();
        });

        $(".fa-chevron-right").click(function (evt) {
            $(".nbs-flexisel-nav-right").click();
        });

        $(function () {
            $('#carousel-example').carousel({
                interval: 552000 // Here you can specify your time interval
            });
        });
    });
</script>
@endsection
