{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 28-Nov-16 6:48 PM
    * File Name    : 

--}}
<html>
<head>
    <style>
        .barcode-img {
            float: left;
            margin: 30px 16px 0 0;
        }

        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        .barcode {
            width: 100%;
        }
    </style>
</head>
<body>
@if(!empty($products))
    @foreach($products->productKeeping as $product)
        <div class="barcode">
            <h2 class="" style="float: left; width: 100%; text-align: center ">
                {{$products->title.'-'. $product->value1->value.'-'.$product->value2->value}}
            </h2>
            @for($i = 1; $i<= $product->quantity; $i++  )
                {{--<img src="{{storage_path('app'.DIRECTORY_SEPARATOR.'barcode'.DIRECTORY_SEPARATOR.$product->barcode.'.png')}}">--}}
                <div class="barcode-img">
                    <img src="{{url('/local/storage/app/barcode/'.$product->barcode.'.png')}}">
                </div>

            @endfor
        </div>

    @endforeach
@endif
</body>
</html>
