@extends('Store::layouts.store-admin')

@section('content')
    <div>
        <div class="page-title">
            <div class="title_left">
                @if(empty($supplier->id))
                <h3>Add Supplier</h3>
                @else
                <h3>Edit Supplier</h3>
                @endif
            </div>
            <div class="pull-right">
                <!--<a class="btn btn-primary btn-sm save-supplier" href="#">Save</a>-->
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal" method="post" action="{{url('store/'.$store_id.'/admin/postSupplier')}}" id="addSupplierForm">
                            <input type="hidden" name="supplier-id" value="{{@$supplier->id}}">
                            <div class="form-group">
                                <label class="control-label col-md-3">Name:</label>
                                <div class="col-md-4">
                                    <input type="text" name="name" class="form-control" value="@if(!empty(\Request::old('name'))){{\Request::old('name')}}@else{{trim(@$supplier->name)}}@endif">
                                    <label id="name-error" class="error text-danger" for="name">{{@$errors->first('name')}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Supplier Code:</label>
                                <div class="col-md-4">
                                    <input type="text" name="code" class="form-control" value="@if(!empty(\Request::old('code'))){{\Request::old('code')}}@else{{trim(@$supplier->code)}}@endif">
                                    <label id="name-error" class="error text-danger" for="name">{{@$errors->first('code')}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Contact Number:</label>
                                <div class="col-md-4">
                                    <input type="text" name="contact_no" class="form-control" value="@if(\Request::old('contact_no')){{\Request::old('contact_no')}}@else{{@$supplier->contact_no}}@endif">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Address:</label>
                                <div class="col-md-4">
                                    <textarea name="address" class="form-control">@if(\Request::old('address')){{\Request::old('address')}}@else{{trim(@$supplier->address)}}@endif</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">City:</label>
                                <div class="col-md-4">
                                    <input type="text" name="city" class="form-control" value="@if(\Request::old('city')){{\Request::old('city')}}@else{{@$supplier->city}}@endif">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Phone 1:</label>
                                <div class="col-md-4">
                                    <input type="text" name="phone_1" class="form-control" value="@if(\Request::old('phone_1')){{\Request::old('phone_1')}}@else{{@$supplier->phone_1}}@endif">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Phone 2:</label>
                                <div class="col-md-4">
                                    <input type="text" name="phone_2" class="form-control" value="@if(\Request::old('phone_2')){{\Request::old('phone_2')}}@else{{@$supplier->phone_2}}@endif">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Mobile:</label>
                                <div class="col-md-4">
                                    <input type="text" name="mobile" class="form-control" value="@if(\Request::old('mobile')){{\Request::old('mobile')}}@else{{@$supplier->mobile}}@endif">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Email:</label>
                                <div class="col-md-4"><input type="text" name="email" class="form-control" value="@if(\Request::old('email')){{\Request::old('email')}}@else{{@$supplier->email}}@endif">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Fax:</label>
                                <div class="col-md-4"><input type="text" name="fax" class="form-control" value="@if(\Request::old('fax')){{\Request::old('fax')}}@else{{@$supplier->fax}}@endif">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">NTN:</label>
                                <div class="col-md-4"><input type="text" name="ntn" class="form-control" value="@if(\Request::old('ntn')){{\Request::old('ntn')}}@else{{@$supplier->ntn}}@endif">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Opening Balance:</label>
                                <div class="col-md-4"><input type="text" name="opening_balance" class="form-control" value="@if(\Request::old('opening_balance')){{\Request::old('opening_balance')}}@else{{@$supplier->opening_balance}}@endif">
                                </div>
                            </div>

                            <div class="form-group">
                              <?php
                              $opening_date = explode(' ',\Carbon\Carbon::today())[0];
                              if(\Request::old('opening_date')){
                                $opening_date = \Request::old('opening_date');
                              }
                              if(isset($supplier->opening_date)){
                                $opening_date = $supplier->opening_date;
                              }
                              ?>
                                <label class="control-label col-md-3">Opening Date:</label>
                                <div class="col-md-4"><input type="text" placeholder="yyyy/mm/dd" name="opening_date" id="opening_date" class="form-control" value="{{$opening_date}}">
                                </div>
                            </div>

                            <div class="form-group">
                              <?php
                              $end_date = explode(' ',\Carbon\Carbon::tomorrow())[0];
                              if(\Request::old('end_date')){
                                $end_date = \Request::old('end_date');
                              }
                              if(isset($supplier->end_date)){
                                $end_date = $supplier->end_date;
                              }
                              ?>
                                <label class="control-label col-md-3">End Date:</label>
                                <div class="col-md-4"><input type="text" placeholder="yyyy/mm/dd" id="end_date" name="end_date" class="form-control" value="{{$end_date}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Comments:</label>
                                <div class="col-md-4">
                                    <textarea name="comments" class="form-control">@if(\Request::old('comments')){{\Request::old('comments')}}@else{{trim(@$supplier->comments)}}@endif</textarea>
                                </div>
                            </div>

                        <!--<div class="form-group">
                                <label class="control-label col-md-3">GL Account:</label>
                                <div class="col-md-4"> <input type="text" name="gl_account" class="form-control" value="@if(\Request::old('gl_account')){{\Request::old('gl_account')}}@else{{@$supplier->gl_account}}@endif">
                                </div>
                            </div>-->

                            <div class="form-group">
                                <label class="control-label col-md-3">&nbsp;</label>
                                <div class="col-md-4 ">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right">Save</button>
                                    <a href="{{url('store/'.$store_id.'/admin/suppliers')}}" class="btn btn-default btn-sm pull-right">Cancel</a>
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
    {!! HTML::script('local/public/assets/gentelella/js/moment/moment.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datepicker/daterangepicker.js') !!}
    <script type="text/javascript" src="{{asset('local/public/assets/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function (e) {
            jQuery('#addSupplierForm').validate({
                rules : {
                    'name' : {required:true}
                }
            });
        });
        jQuery(document).on('click','.save-supplier',function (e) {
            e.preventDefault();
            jQuery('#addSupplierForm').submit();
        });
        $(document).ready(function () {
          $('#opening_date').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            showDropdowns: true,
            locale: {
              format: 'YYYY-MM-DD'
            },
            startDate: {{$opening_date}},
          }, function (start, end, label) {
          });
          $('#end_date').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            showDropdowns: true,
            locale: {
              format: 'YYYY-MM-DD'
            },
            startDate: {{$end_date}},
          }, function (start, end, label) {
            // var years = moment().diff(start, 'years');
            //alert("You are " + years + " years old.");
          });
        });
    </script>
@endsection
