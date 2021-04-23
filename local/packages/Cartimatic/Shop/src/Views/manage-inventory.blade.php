@extends('Store::layouts.store-admin')
@section('styles')
    {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
    {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
@stop
@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Manage Inventory
                    <small>
                        ({{$shop->location}})
                    </small>
                </h3>
            </div>
            <a href="{{url('admin/store/shop/push-items/'.$shop->id)}}" class="btn btn-success pull-right" type="button">Push Items</a>
        </div>
        <div class="clearfix"></div>
        @include('includes.alerts')
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <table id="datatable-buttons" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Barcode ID.</th>
                                <th>Name</th>
                                {{--<th>Category</th>--}}
                                <th>Master Attribute 1</th>
                                <th>Master Attribute 2</th>
                                <th>Sales Price</th>
                                <th>Cost Price</th>
                                <th>Discount</th>
                                <th>Total</th>
                                <th>In Stock</th>
                                <th>Sold</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $index => $category)
                                <tr>
                                    <th colspan="13">
                                        @include('Store::includes.category-bredcrum',['categoryID' => $category['id']])
                                    </th>


                                </tr>
                                @foreach($products[$index] as $product)
                                    <tr>
                                        <?php
                                        $status = config('constant_shop.PUSHED_ITEMS_STATUS');
                                        $status = array_flip($status);

                                        $total = getTotal($product->id, 'shop', $shop->id);
                                        $inStock = getInStockShop($product->id, $shop->id);

                                        ?>
                                        <td>{{$product->custom_id}}</td>
                                        <td>{{$product->barcode_id}}</td>
                                        <?php $productImage = getRandomImageOfProduct($product->id); ?>
                                        <td>
                                            <img
                                                    src="{{ $productImage }}" alt="image"
                                                    width="80 " height="54"
                                                    onError="this.onerror=null;this.src='{{getProductDefaultImage()}}';"> {{$product->title}}
                                        </td>
                                        {{-- <td>{{$product->category->name}}</td>--}}
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>{{number_format($total)}}</td>
                                        <td>{{number_format($inStock)}}</td>
                                        {{--<td>-</td>--}}
                                        <td>{{number_format($total - $inStock )}}</td>

                                        <td>
                                            <a title="Show variants of product." class="stats product_variants_btn btn btn-primary"
                                               data-product-id="{{$product->id}}" id="parent-{{$product->id}}" style="float: right;">
                                                <i class="fa fa-bars"></i> Show Variants</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $numItems = count($product[ 'productKeeping' ]);
                                    $i = 0;
                                    ?>
                                    @foreach($product['productKeeping'] as $keeping)
                                        <tr style="display: none;"
                                            class="child-{{$product->id}} @if(++$i === $numItems) border-bottom @endif">
                                            <td>{{$keeping->custom_product_id}}</td>
                                            <td>{{$keeping->barcode}}</td>
                                            {{--<td>-</td>--}}
                                            <td>-</td>
                                            <td>{{$keeping->master1->label}} - {{$keeping->value1->value}}</td>
                                            <td>{{$keeping->master2->label}} - {{$keeping->value2->value}}</td>
                                            <td>{{$keeping->price}}</td>
                                            <td>{{$keeping->cost_price}}</td>
                                            <td>{{$keeping->discount}}</td>
                                            <?php
                                            $total = availableProducts($product->id, $keeping->id, 'shop', $shop->id);
                                            ?>
                                            <td>{{number_format($total)}}</td>
                                            <td>{{number_format($keeping->quantity)}}</td>
                                            {{--<td>-</td>--}}
                                            <td>{{number_format($total- $keeping->quantity)}}</td>
                                            <td>{{$status[$keeping->status]}}</td>

                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('scripts')
    {!! HTML::script('local/public/assets/gentelella/js/datatables/jquery.dataTables.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/dataTables.bootstrap.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/dataTables.buttons.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/jszip.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/pdfmake.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/vfs_fonts.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/buttons.html5.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/buttons.print.min.js') !!}
    {!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/bootstrap-tooltip.js') !!}
    {!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/confirmation.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/pace/pace.min.js') !!}
    <script>
        $(document).ready(function () {
            $('.product_variants_btn').click(function (e) {
                e.preventDefault();

                var id = $(this).data('productId');
                $('.child-' + id).toggle();
                var btnText = $(this).text();
                if (btnText.indexOf('Show Variants') > -1) {
                    $(this).html('<i class="fa fa-bars"></i> Hide Variants');
                } else {
                    $(this).html('<i class="fa fa-bars"></i> Show Variants');
                }
            });

        })
        var handleDataTableButtons = function () {
                    "use strict";
                    0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                        dom: "Bfrtip",
                        buttons: [{
                            extend: "copy",
                            className: "btn-sm"
                        }, {
                            extend: "csv",
                            className: "btn-sm"
                        }, {
                            extend: "excel",
                            className: "btn-sm"
                        }, {
                            extend: "pdf",
                            className: "btn-sm"
                        }, {
                            extend: "print",
                            className: "btn-sm"
                        }],
                        responsive: !0
                    })
                },
                TableManageButtons = function () {
                    "use strict";
                    return {
                        init: function () {
                            handleDataTableButtons()
                        }
                    }
                }();
    </script>
    <script type="text/javascript">
        TableManageButtons.init();

    </script>
    <style>
        tr.border-bottom {
            border-bottom: 2px solid #169f85;
        }
    </style>
@stop
