{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 24-Aug-16 11:35 AM
    * File Name    : 

--}}
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
                    Damaged/Lost
                    <small>
                    </small>
                </h3>
            </div>
            <div class="title_right">
                <a href="{{URL::previous()}}" class="btn btn-success pull-right" type="button">Back</a>

                {{--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Item...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>--}}

            </div>

        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Barcode(variant)</th>
                                <th>Product Name</th>
                                <th>Attribute 1</th>
                                <th>Attribute 2</th>

                                <th>POS Name</th>
                                <th>Total sent</th>
                                <th>Returned</th>
                                <th>Returned Date</th>
                                <th>Description</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                @if(!empty($item->product))
                                    <tr>
                                        <td>
                                            @if(!empty($item->product))
                                                {{$item->product->custom_id}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{$item->keeping->barcode}}</td>
                                        <?php
                                        if(!empty($item->product)) {
                                            $productImage = getRandomImageOfProduct($item->product->id);
                                            $title        = $item->product->title;
                                        } else {
                                            $productImage = '';
                                            $title        = "";

                                        }
                                        ?>
                                        <td>
                                            <img
                                                    src="{{ $productImage }}" alt="image"
                                                    width="80 " height="54"
                                                    onError="this.onerror=null;this.src='{{getProductDefaultImage()}}';">
                                            {{$title}}
                                        </td>
                                        <td>{{$item->keeping->master1->label}} - {{$item->keeping->value1->value}}</td>
                                        <td>{{$item->keeping->master2->label}} - {{$item->keeping->value2->value}}</td>

                                        <td>{{$item->pos->location}}</td>
                                        <td>

                                            {{availableProducts($item->product->id, $item->keeping->id, 'pos', $item->pos->id)}}
                                        </td>
                                        <td>{{$item->total}}</td>
                                        <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</td>
                                        <td>{{\Illuminate\Support\Str::limit($item->description, 20)}}</td>
                                    </tr>
                                @endif
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

@stop
