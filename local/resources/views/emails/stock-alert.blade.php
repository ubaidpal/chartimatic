{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 24-Nov-16 4:08 PM
    * File Name    : 

--}}
        <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cartimatic: Stock Alert</title>
</head>
<body style="background:#ccc;">
<div style=" width:580px; margin: 0 auto; overflow:hidden; padding-top: 20px;">

    <div style="background:#505050; overflow:hidden; padding:20px 10px; border-radius:8px 8px 0px 0px; font-family: Arial, Gotham, 'Helvetica Neue', Helvetica, sans-serif; ">
        <div style="float:left;">

        </div>
        <div style="float:right; color:#ffffff; font-size:16px; font-weight:bold; padding-top:8px;">Cartimatic: Stock Alert</div>
    </div>

    <div style="overflow:hidden;padding:20px 10px; border-radius: 0px 0px 8px 8px; background:#ffffff; font-family: Arial, Gotham, 'Helvetica Neue', Helvetica, sans-serif; font-size:14px;">
        <div style="float: left;">
            <b>Dear {{$data['seller']}},</b>
        </div>
        <div style="float: right;">
            <div style="font-weight:bold; float: left; padding-right:5px; color:#505050;">Date:</div>
            <div style="float:left; color:#737373;">{{date('m/d/Y')}}</div>
            <div style="clear: both;"></div>
        </div>
        <div style="clear: both;"></div>
        <div>
            <p>
                Your Following products are out of stock.
            </p>
        </div>
        <div style="overflow:hidden; padding:10px; background:#f5f5f5; color:#909090; border-radius:8px; margin-top:30px;">
            <div style="float:left; padding:10px; width: 170px;">Id</div>
            <div style="float:left; padding:10px; width: 160px;">Title</div>
            <div style="float:left; padding:10px; width: 150px;">In Stock Quantity</div>

        </div>
        @foreach($data['products'] as $product)
            <div style="overflow:hidden; padding:10px; background:#f5f5f5; color:#909090; border-radius:8px; margin-top:5px;">
                <div style="float:left; padding:10px; width: 170px;">{{$product['product_id']}}</div>
                <div style="float:left; padding:10px; width: 160px;">{{$product['product']['title']}}</div>
                <div style="float:left; padding:10px; width: 150px;">{{$product['quantity']}}</div>
            </div>
        @endforeach
        <div style="clear:both; height:0px; line-height:0;"></div>
    </div>

    <h1 style="font-size:18px; font-family: Arial, Gotham, 'Helvetica Neue', Helvetica, sans-serif; text-align:center;font-weight: normal; padding-top: 20px;">
        <?php echo date('Y') ?> &copy; <a href="{{url('/')}}">cartimatic.com</a>
    </h1>
</div>
</body>
</html>
