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
                    All Products
                    <small>

                    </small>
                </h3>
            </div>
            <a href="{{URL::previous()}}" class="btn btn-success pull-right" type="button">Back</a>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Barcode ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Total</th>
                                <th>In Stock</th>
                                <th>Sold</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>54654</td>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>120</td>
                                <td>110</td>
                                <td>80</td>
                                <td>
                                    <a href="{{url('admin/store/shop/shop-product/15')}}" class="btn btn-primary">
                                        View Detail
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>54654</td>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>120</td>
                                <td>110</td>
                                <td>80</td>
                                <td>
                                    <a href="{{url('admin/store/shop/shop-product/15')}}" class="btn btn-primary">
                                        View Detail
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>54654</td>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>120</td>
                                <td>110</td>
                                <td>80</td>
                                <td>
                                    <a href="{{url('admin/store/shop/shop-product/15')}}" class="btn btn-primary">
                                        View Detail
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>54654</td>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>120</td>
                                <td>110</td>
                                <td>80</td>
                                <td>
                                    <a href="{{url('admin/store/shop/shop-product/15')}}" class="btn btn-primary">
                                        View Detail
                                    </a>
                                </td>
                            </tr>

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
