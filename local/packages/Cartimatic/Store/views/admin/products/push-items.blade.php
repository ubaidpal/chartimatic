{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 24-Aug-16 6:08 PM
    * File Name    : 

--}}

<div class="col-sm-12">
    <h4>POS List</h4>
    @if(count($poss)>0)
        @foreach($poss as $pos)
            <div class="radio">
                <label>
                    <input type="radio" name="pos_id" id="optionsRadios1" value="{{$pos->id}}"
                           checked=""> {{$pos->location}}
                </label>
            </div>

        @endforeach
            <div class="ln_solid"></div>
            <h4>Product List</h4>
            <div class="x_content">

                <table id="all-pos" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Select</th>
                        <th>No.</th>
                        <th>Barcode ID</th>
                        <th>Name</th>
                        <th>Attribute 1</th>
                        <th>Attribute 2</th>
                        <th>Total</th>
                        <th>Available</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product->productKeeping as $keeping)
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input id="middle-name"  class="form-control col-md-2 col-xs-2" type="checkbox" name="product_id[]" value="{{$product->id}}-{{$keeping->id}}">
                                </div>
                            </td>
                            <td>{{$product->custom_id}}</td>
                            <td>{{$keeping->barcode}}</td>
                            <td>{{$product->title}}</td>

                            <td>{{$keeping->value1->value}}</td>
                            <td>{{$keeping->value2->value}}</td>

                            <?php  $total = availableProducts($product->id, $keeping->id, 'store', $user->id) ?>
                            <td>{{$total}}</td>
                            <td>{{$keeping->quantity}}</td>
                            <td>
                                <div class="form-group">
                                    <input id="middle-name" class="form-control col-md-2 col-xs-2" type="number"
                                           value=""
                                           name="quantity-{{$keeping->id}}" max="{{$keeping->quantity}}" min="">
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    @else
        No POS Found
    @endif
</div>

