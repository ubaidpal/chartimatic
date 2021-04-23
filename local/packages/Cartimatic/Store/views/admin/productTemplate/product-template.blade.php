
@extends('Store::layouts.store-admin')
@section('styles')
    {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
    {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
@stop
@section('content')

    <div class="col-md-12" style="background-color: #fff">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Product Template
                    <small>
                    </small>
                </h3>
            </div>
        </div>

        <div class="col-md-6 col-md-offset-3">
            <div class="row">
                {!! Form::model(null , ['method' => 'POST', 'url' => "store/$store_id/admin/savedProductTemplate","id" =>"profileTemplate"]) !!}
                @if(Session::has('message'))
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert {{ Session::get('alert-class display-danger', 'alert-info') }}" aria-label="close">&times;</a>
                        <strong>Error!</strong> {{ Session::get('message') }}
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert {{ Session::get('alert-class display-success', 'alert-info') }}" aria-label="close">&times;</a>
                        <strong>Success!</strong> {{ Session::get('success') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-error" style="width:100%;line-height: 20px;
                color: #fff;">
                        <a href="#" class="close">&times;</a>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <span>
                        <li>{{ $error }}</li>
                        </span>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group row">
                    <?php $categories = allCategory();?>
                        <label for="list-item" class="col-xs-2 col-form-label">List Item</label>
                        <div class="col-xs-10">
                            @if(isset($parent_category_id))
                                {!!  Form::select('category_id', $categories, $parent_category_id, ['class' => 'form-control category_id' ,'id' => 'categories'])!!}@else
                                {!!  Form::select('category_id', $categories, 0, ['class' => 'form-control category_id' ,'id' => 'categories'])!!}
                            @endif
                        </div>

                </div>
                <div class="form-group row">
                    <label for="name" class="col-xs-2 col-form-label">Name</label>
                    <div class="col-xs-10">
                        <input class="form-control" value="{{@$name}}" type="text" name="name"
                               placeholder="Name e.g mobile">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="code" class="col-xs-2 col-form-label">Code</label>
                    <div class="col-xs-10">
                        <input class="form-control" value="{{@$code}}" type="text" name="code"
                               placeholder="Code e.g 6666">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sort" class="col-xs-2 col-form-label">Sort Order</label>
                    <div class="col-xs-10">
                        <input class="form-control" value="{{@$sort_number}}" type="text" name="sort_number"
                               placeholder="Sort Order e.g. 1">
                    </div>
                </div>
                  <input type="hidden" value="{{$store_id}}" id="store_id">
                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-success saveTemp">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Sort</th>
                                {{--<th>Action</th>--}}

                            </tr>
                            </thead>
                            <tbody id="product-wrapper">
                                @foreach($productTemplate as $product)
                                    <tr>

                                        <td>{{$product->name}}</td>
                                        <td>
                                            {{$product->code}}
                                        </td>
                                        <td>{{$product->sort_number}}</td>
                                        {{--<td>
                                                <a href="{{url('store/'.$store_id.'/admin/editProductTemplate/'.$product->id)}}" title="Edit">
                                                    <i class="fa fa-edit fa-2x"></i>
                                                </a>

                                                <a href="#" title="Delete" data-toggle="confirmation"
                                                   data-href="{{url('store/'.$store_id.'/admin/deleteProductTemplate/'.$product->id)}}">
                                                    <i class="fa fa-trash fa-2x"></i>
                                                </a>
                                        </td>--}}
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
    {!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/bootstrap-tooltip.js') !!}
    {!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/confirmation.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/pace/pace.min.js') !!}
    {!! HTML::script('local/public/assets/js/jquery.validate.min.js') !!}
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
        $('.saveTemp').click(function (e) {
            var category_id = $('.category_id').val();
            if(category_id == 0){
                $('.category_id').val('');
                return false;
            }else{
                $('.category_id').val();
                return true;
            }
        });

        jQuery(document).ready(function(e){
            jQuery('#profileTemplate').validate({
                errorElement : 'span',
                rules : {
                    'category_id' : {required:true},
                    'name'         : {required:true, alpha:true,maxlength:25},
                    'code'         : {required:true,alphanumeric:true,maxlength:4 },
                    'sort_number' : {maxlength:2 ,number:true}
                }
            });
        });
        jQuery.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z0-9\s]+$/);
        },'Code can contain alphanumeric value only');

        jQuery.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);

        },'Name can contain alphabets value only');

        jQuery(document).on('click','.saveTemp',function(e){
            e.preventDefault();
            jQuery('#profileTemplate').submit();
        });
        $('.close').click(function(e){
            $('.alert').hide('slow');
            $('.alert-error').hide('slow');
        });


        $(document).on("click", "#categories", function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            var cat = $('#categories').val();
           var store_id = $('#store_id').val();
            jQuery.ajax({
                url: '{{ url("store/$store_id/admin/productTemplateFilter") }}',
                type: "Post",
                data: {category: cat,store_id :store_id},
                success: function (data) {
                    if (data != 0) {
                        $("#product-wrapper").html(data);
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });
    </script>
    <script type="text/javascript">
        TableManageButtons.init();
    </script>

@stop
