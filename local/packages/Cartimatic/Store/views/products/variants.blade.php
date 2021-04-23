<div class="x_content">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Master Attribute 1</th>
            <th>Master Attribute 1 Value</th>
            <th>Master Attribute 2</th>
            <th>Master Attribute 2 Value</th>
            <th>Cost Price</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Total Quantity</th>
            <th>In Stock</th>
            <th>Sent to POS</th>
            <th>Sold</th>
            <th>Stock Alert Quantity</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $index => $product)
        <tr>
            <th scope="row">{{$index}}</th>
            <td>{{$product->attribute_label_1}}</td>
            <td>{{$product->attribute_1_value}}</td>
            <td>{{$product->attribute_label_2}}</td>
            <td>{{$product->attribute_2_value}}</td>
            <td>{{$product->cost_price}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->discount}}</td>
            <?php
            $sentToPos = getSentToPosByVariant($product->product_id, $product->keeping_id);
            $total = getTotalByVariant($product->product_id, $product->keeping_id,'store', $user->id);
            ?>

            <td>{{$total}}</td>
            <td>{{$product->quantity}}</td>
            <td>{{$sentToPos}}</td>
            <td>{{$total-$sentToPos-$product->quantity}}</td>

            <td>{{$product->stock_alert_quantity}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
