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
                    Push Items to Shop
                    <small>
                        ({{$shop->location}})
                    </small>
                </h3>
            </div>

            <a href="{{URL::previous()}}" class="btn btn-success pull-right" type="button">Back</a>


        </div>
        <div class="clearfix"></div>
        @include('includes.alerts')
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    {!! Form::open(['admin/store/shop/push-items']) !!}
                    {!! Form::hidden('shop_id', $shop_id)  !!}
                    <div class="pull-right">
                        <button class="btn btn-success" type="submit">Push</button>

                        <a class="btn btn-primary" href="{{URL::previous()}}">Cancel</a>
                    </div>
                    <div class="x_content">

                        <table id="all-shop" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Select</th>
                                <th>Product ID</th>
                                <th>Barcode ID</th>
                                <th>Name</th>
                                <th>Attribute 1</th>
                                <th>Attribute 2</th>
                                <th>Sales Price</th>
                                <th>Cost Price</th>
                                <th>Discount (%)</th>
                                <th>Total</th>
                                <th>Available</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)

                                <tr>
                                    <th colspan="12">
                                        <div class="form-group" style="margin: 0; width: 25px;">
                                            <input class="form-control col-md-1 col-xs-1 check-all" type="checkbox"
                                                   name="" value="{{$category['id']}}" style=" height: auto">

                                        </div>
                                        @include('Store::includes.category-bredcrum',['categoryID' => $category['id']])
                                    </th>
                                </tr>
                                @if(isset($products[$category['id']]))
                                    @foreach($products[$category['id']] as $product)
                                        <?php
                                        $prd = $product[ 'product' ];
                                        $total = getTotal($prd[ 'id' ], 'store', $user->id);
                                        $inStock = getInStock($prd[ 'id' ], $user->id);
                                        ?>
                                        <tr>
                                            <td>
                                                {{--<div class="form-group">
                                                    <input id="middle-name"  class="form-control col-md-2 col-xs-2 cat-{{$category['id']}}" type="checkbox" name="" value="{{$prd['id']}}">
                                                </div>--}}
                                                -
                                            </td>
                                            <td>{{$prd['custom_id']}}</td>
                                            <td>{{$prd['barcode_id']}}</td>
                                            <?php $productImage = getRandomImageOfProduct($prd[ 'id' ]); ?>
                                            <td>
                                                <img
                                                        src="{{ $productImage }}" alt="image"
                                                        width="80 " height="54"
                                                        onError="this.onerror=null;this.src='{{getProductDefaultImage()}}';">
                                                {{$prd['title']}}
                                            </td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>

                                            <?php
                                            ?>
                                            <td>{{$total}}</td>
                                            <td>{{$inStock}}</td>

                                            <td>
                                                <a title="Show variants of product." class="stats product_variants_btn btn btn-primary"
                                                   data-product-id="{{$prd['id']}}" id="parent-{{$prd['id']}}" style="float: right;">
                                                    <i class="fa fa-bars"></i> Show Variants</a>
                                            </td>
                                        </tr>
                                        <?php
                                        $numItems = count($product[ 'attributes' ]);
                                        $i = 0;
                                        ?>
                                        @foreach($product['attributes'] as $attribute)
                                            <tr style="display: none;"
                                                class="child-{{$prd['id']}} @if(++$i === $numItems) border-bottom @endif select-row">
                                                <td>
                                                    <div class="form-group">
                                                        <input id=""
                                                               class="form-control col-md-2 col-xs-2 cat-{{$category['id']}} select-box"
                                                               type="checkbox" name="product_id[]"
                                                               value="{{$prd['id']}}-{{$attribute['id']}}">
                                                    </div>
                                                </td>
                                                <td>{{$attribute['custom_id']}}</td>
                                                <td>{{$attribute['barcode']}}</td>
                                                <td>-</td>
                                                <td>
                                                    {{$attribute['attribute_1']}} - {{$attribute['attribute_1_value']}}
                                                </td>

                                                <td>
                                                    {{$attribute['attribute_2']}} - {{$attribute['attribute_2_value']}}
                                                </td>


                                                <?php
                                                $total = availableProducts($prd['id'], $attribute['keeping_id'], 'store', $user->id)
                                                ?>
                                                <td>{{$attribute['price']}}</td>
                                                <td>{{$attribute['cost_price']}}</td>
                                                <td>{{$attribute['discount']}}</td>
                                                <td>{{$total}}</td>
                                                <td>{{$attribute['total']}}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="number"
                                                               value=""
                                                               name="quantity-{{$attribute['id']}}" max="{{$attribute['total']}}" min="" data-name="quantity">
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="pull-right">
                        <button class="btn btn-success" type="submit">Push</button>

                        <a class="btn btn-primary" href="{{URL::previous()}}">Cancel</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop
@section('scripts')
    <a class="cd-top hidden-xs " href="#0">Top</a>
    <style>
        tr.border-bottom {
            border-bottom: 2px solid #169f85;
        }

        .selected-row {
            background-color: #9cb0c5 !important;
            color: #fff;
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

            $('.select-box').click(function (e) {
                //e.preventDefault();
            })
            $('.select-row').click(function (e) {
                var checkbox = $(this).find('.select-box');

                var target = $( e.target );
                var attr = target.data('name');

                if (target.is('td')) {
                    checkbox.prop("checked", !checkbox.prop("checked"));
                }
                if (typeof attr == typeof undefined) {
                    $(this).toggleClass('selected-row')
                }
            });

            var offset = 300,
            //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
                    offset_opacity = 1200,
            //duration of the top scrolling animation (in ms)
                    scroll_top_duration = 700,
            //grab the "back to top" link
                    $back_to_top = $('.cd-top');

            //hide or show the "back to top" link
            $(window).scroll(function () {
                ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
                if ($(this).scrollTop() > offset_opacity) {
                    $back_to_top.addClass('cd-fade-out');
                }
            });

            //smooth scroll to top
            $back_to_top.on('click', function (event) {
                event.preventDefault();
                $('body,html').animate({
                            scrollTop: 0,
                        }, scroll_top_duration
                );
            });

        })
        var handleDataTableButtons = function () {
                    "use strict";
                    0 !== $("#all-shop").length && $("#all-shop").DataTable({
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
        $(document).ready(function () {
            $('.check-all').change(function () {
                var catId = $(this).val();
                $(".cat-" + catId).prop('checked', $(this).prop("checked"));

                var tr = $(".cat-" + catId).parents('tr.select-row');
                tr.toggleClass('selected-row');

            })
        })
    </script>
    <script type="text/javascript">
        // TableManageButtons.init();
    </script>
@stop
