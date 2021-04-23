@extends('Store::layouts.store-admin')
@section('styles')

@stop
@section('content')

    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Edit Shop</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        @include('includes.alerts')
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br/>

                        {!! Form::model($shop,['url' => 'admin/store/shop/update/'.$shop->id,'class' => 'form-horizontal form-label-left','data-parsley-validate', 'enctype'=>"multipart/form-data" , 'id'=> 'shopForm']) !!}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Shop Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                {!! Form::text('shop_name',NULL, ['class' => 'form-control col-md-7 col-xs-12', 'required' ,'placeholder' => 'e.g.Chartimatic']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">City <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('city',NULL, ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}

                            </div>
                        </div>

                        <div class="form-group">
                            <label title="Shop History will be cleared after selected number of days" for="clear_history" class="control-label col-md-3 col-sm-3 col-xs-12">Priority<span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!!  \Form::select('priority', ["high"=>"high", "medium" =>"medium", "low" => "low" ,"lowest" => "lowest"], $shop->priority, ['class' => 'form-control valid' ,'id' => 'priority'])!!}
                            </div>

                        </div>

                        <div class="form-group">
                            <label title="Shop History will be cleared after selected number of days" for="clear_history" class="control-label col-md-3 col-sm-3 col-xs-12">Group<span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!!  \Form::select('shop_group', ["packing_shop"=>"Packing Shop", "sales_shop" =>"Sales Shop"], $shop->shop_group, ['class' => 'form-control valid' ,'id' => 'group'])!!}
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shop">Shop <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('shop_name',$shop->shop_name, ['class' => 'form-control col-md-7 col-xs-12', 'required' ,'placeholder' => 'e.g.H.S.Y']) !!}

                            </div>
                        </div>

                        <div class="form-group">
                            <label title="Shop History will be cleared after selected number of days" for="clear_history" class="control-label col-md-3 col-sm-3 col-xs-12">Shop Region<span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!!  \Form::select('shop_region', ["not_for_bi"=>"Not for BI", "local" =>"Local" ,
                                "foreign" =>"Foreign" , "exhibition" =>"Exhibition" , "packing_room" =>"Packing Room"], $shop->shop_region, ['class' => 'form-control valid' ,'id' => 'shop_region'])!!}
                            </div>

                        </div>

                        <div class="form-group">
                            <?php
                            $opening_date = explode(' ',\Carbon\Carbon::today())[0];
                            if(\Request::old('opening_date')){
                                $opening_date = \Request::old('opening_date');
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
                            ?>
                            <label class="control-label col-md-3">End Date:</label>
                            <div class="col-md-4"><input type="text" placeholder="yyyy/mm/dd" id="end_date" name="end_date" class="form-control" value="{{$end_date}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                {!! Form::text('email',NULL, ['class' => 'form-control col-md-7 col-xs-12', 'required' ,'placeholder' => 'e.g.chartimatic@gmail.com']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                {!! Form::textarea('address',NULL, ['class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Phone 1
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                {!! Form::text('phone_1',NULL, ['class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Phone 2
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                {!! Form::text('phone_2',NULL, ['class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Comments
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                {!! Form::textarea('comments',NULL, ['class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a href="{{URL::previous()}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" id="save_btn" class="btn btn-success">Update</button>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>


    </div>

@stop
@section('scripts')
    {!! HTML::script('local/public/assets/gentelella/js/moment/moment.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datepicker/daterangepicker.js') !!}
    <script src="{{url('local/public/assets/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function(e){
            jQuery('#shopForm').validate({
                errorElement : 'span',
                rules : {
                    'shop_name' : {required:true},
                    'city'         : {required:true},
                    'shop'         : {required:true}

                }
            });
        });
        jQuery.validator.addMethod("alphanum", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z0-9\s]+$/);
        },'Code can contain alphanumeric value only');

        jQuery(document).on('click','#save_btn',function(e){
            e.preventDefault();
            jQuery('#shopForm').submit();
        });

        $(document).ready(function () {
            $("#file").change(function () {
                readURL(this, $('#preview'));
            });
        });

        function readURL(input, preview) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.find('img').attr('src', e.target.result);
                    preview.removeClass('hide');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

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
@stop
