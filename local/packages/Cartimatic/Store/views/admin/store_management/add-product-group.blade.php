@extends('Store::layouts.store-admin')

@section('content')
    <div>
        <div class="page-title">
            <div class="title_left">
                @if(empty($supplier->id))
                <h3>Add Product Group</h3>
                @else
                <h3>Edit Product Group</h3>
                @endif
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm save-supplier" href="#">Save</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" method="post" action="{{url('store/'.$store_id.'/admin/postProductGroup')}}" id="addBrandForm">
                            <input type="hidden" name="supplier-id" value="{{@$supplier->id}}">
                            <div class="form-group">
                                <label class="control-label col-md-3">Name:</label>
                                <div class="col-md-4">
                                    <input type="text" name="name" class="form-control" value="{{@$supplier->name}}">
                                    <label id="name-error" class="error text-danger" for="name">{{@$errors->first('name')}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Contact Number:</label>
                                <div class="col-md-4">
                                    <input type="text" name="contact_no" class="form-control" value="{{@$supplier->contact_no}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">&nbsp;</label>
                                <div class="col-md-4 ">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right">Save</button>
                                    <a href="{{url('store/'.$store_id.'/admin/productGroups')}}" class="btn btn-default btn-sm pull-right">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script type="text/javascript" src="{{asset('local/public/assets/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function (e) {
            jQuery('#addBrandForm').validate({
                rules : {
                    'name' : {required:true}
                }
            });
        });
        jQuery(document).on('click','.save-supplier',function (e) {
            e.preventDefault();
            jQuery('#addSupplierForm').submit();
        });
    </script>
@endsection