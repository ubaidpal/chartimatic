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
                    Product Detail
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">
                    <div class="x_content">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Barcode ID</th>
                                <th>Title</th>
                                <th>Affiliated</th>
                                <th>Total</th>
                                <th>In Stock</th>
                                <th>Shop Stock</th>

                                <th>Web Sold</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php $productId = $product->id;?>
                                <td>{{$product->custom_id}}</td>
                                <td>{{$product->barcode_id}}</td>
                                <?php $productImage = getRandomImageOfProduct($product->id); ?>
                                <td>
                                    <img
                                            src="{{ $productImage }}" alt="image"
                                            width="80 " height="54"
                                            onError="this.onerror=null;this.src='{{getProductDefaultImage()}}';">
                                    {{$product->title}}
                                </td>
                                <td>
                                    @if($product->affiliate == 1)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
                                <?php
                                $total = getTotal($product->id, 'store', $user->id);
                                $inStock = getInStock($product->id);
                                $sentToShop = getSentToShop($product->id);
                                ?>
                                <td>{{$total}}</td>
                                <td>{{$inStock}}</td>
                                <td>{{$sentToShop}}</td>


                                <td>{{$total-$inStock- $sentToShop}}</td>

                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Product in Shop
                    <small>
                        (Detail by Shop)
                    </small>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">
                    <div class="x_content">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Shop Name</th>
                                <th>City</th>
                                <th>Location</th>
                                <th>Attribute 1</th>
                                <th>Attribute 2</th>
                                <th>Total</th>
                                <th>In Stock</th>
                                <th>Sold</th>
                                <th>View</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($shopProducts as $product)
                                <tr>
                                    <td>{{$product->shop_name}}</td>
                                    <td>{{$product->city}}</td>
                                    <td>{{$product->location}}</td>
                                    <?php
                                    $total = getTotal($productId, 'shop', $product->id);
                                    $inStock = getInStockShop($productId, $product->id);
                                    ?>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>{{$total}}</td>
                                    <td>{{$inStock}}</td>
                                    <td>{{$total-$inStock}}</td>
                                    <td> <a title="Show variants of product." class="stats product_variants_btn btn btn-primary"
                                            data-product-id="{{$product->id}}" id="parent-{{$product->id}}" style="float: right;">
                                            <i class="fa fa-bars"></i> Show Variants</a></td>

                                </tr>
                                <?php
                                $numItems = count($product->productKeeping);
                                $i = 0;
                                ?>
                                @foreach($product->productKeeping as $keeping)
                                    <tr style="display: none;" class="child-{{$product->id}} @if(++$i === $numItems) border-bottom @endif">
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>{{$keeping->master1->label}} - {{$keeping->value1->value}}</td>
                                        <td>{{$keeping->master2->label}} - {{$keeping->value2->value}}</td>

                                        <?php


                                        $total = availableProducts($keeping->product_id, $keeping->id, 'shop', $product->id);

                                        ?>
                                        <td>{{$total}}</td>
                                        <td>{{$keeping->quantity}}</td>
                                        <td>{{$total -$keeping->quantity }}</td>
                                        <td>-</td>
                                    </tr>
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
    <style>
        tr.border-bottom {
            border-bottom: 2px solid #169f85;
        }
    </style>
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
                        responsive: !0,
                        order:false
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
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content row">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>

            </div>
        </div>
    </div>

@stop
