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
                    Shop
                    <small>
                        All Shops
                    </small>
                </h3>
            </div>
            <a href="{{url('admin/store/add-shop')}}" class="btn btn-success pull-right" type="button">Setup New Shop</a>
        </div>

        <div class="clearfix"></div>
        @include('includes.alerts')
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content table-responsive">
                        <table id="datatable-shop" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Shop Name</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($shops as $shop)
                                <tr>
                                    <td>{{$shop->shop_name}}</td>
                                    <td>{{$shop->email}}</td>
                                    <td>{{$shop->city}}</td>
                                    <td>
                                        <a href="{{url('admin/store/shop/manage-inventory/'.$shop->id)}}" class="btn btn-primary" type="button">
                                            Manage Inventory
                                        </a>
                                        <a href="{{url('admin/store/shop/view-sales/'.$shop->id)}}" class="btn btn-success" type="button">
                                            View Sales
                                        </a>
                                        {!! HTML::link('admin/store/shop/edit/'.$shop->id,'Edit', ['class' =>'btn btn-success']) !!}
                                    </td>
                                </tr>
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
    <script>
        var handleDataTableButtons = function () {
                    "use strict";
                    0 !== $("#datatable-shop").length && $("#datatable-shop").DataTable({
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
