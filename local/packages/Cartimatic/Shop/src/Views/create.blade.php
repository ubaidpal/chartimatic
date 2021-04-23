@extends('Store::layouts.store-admin')
@section('styles')

@stop
@section('content')

    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Add Shop</h3>
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

                        {!! Form::open(['url' => 'admin/store/store-shop','class' => 'form-horizontal form-label-left','data-parsley-validate', 'enctype'=>"multipart/form-data" , 'id'=> 'shopForm']) !!}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!--<div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select Manager <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('manager_id', $managers, NULL, ['class' => 'form-control col-md-7 col-xs-12','placeholder' => 'Select Manager']) !!}
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Shop Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                {!! Form::text('shop_name',NULL, ['class' => 'form-control col-md-7 col-xs-12', 'required' ,'placeholder' => 'e.g.Chartimatic']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Code <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('code',NULL, ['class' => 'form-control col-md-7 col-xs-12', 'required', 'placeholder' => 'Code e.g 6666']) !!}

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">City <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('city',NULL, ['class' => 'form-control col-md-7 col-xs-12', 'required' ,'placeholder' => 'e.g.Lahore']) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <label title="Shop History will be cleared after selected number of days" for="clear_history" class="control-label col-md-3 col-sm-3 col-xs-12">Priority<span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control valid" name="priority">
                                    <option value="" selected="selected">Select Priority</option>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                    <option value="lowest">Lowest</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label title="Shop History will be cleared after selected number of days" for="clear_history" class="control-label col-md-3 col-sm-3 col-xs-12">Group<span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control valid" name="shop_group">
                                    <option value="" selected="selected">Select Group</option>
                                    <option value="packing_shop">Packing Shop</option>
                                    <option value="sales_shop">Sales Shop</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shop">Shop <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('shop_name',NULL, ['class' => 'form-control col-md-7 col-xs-12', 'required' ,'placeholder' => 'e.g.H.S.Y']) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <label title="Shop History will be cleared after selected number of days" for="clear_history" class="control-label col-md-3 col-sm-3 col-xs-12">Shop Region<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control valid" name="shop_region">
                                    <option value="" selected="selected">Select Region</option>
                                    <option value="not_for_bi">Not for BI</option>
                                    <option value="local">Local</option>
                                    <option value="foreign">Foreign</option>
                                    <option value="exhibition">Exhibition</option>
                                    <option value="packing_room">Packing Room</option>
                                </select>
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

                        <!--<div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Location <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('location',NULL, ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password" class="form-control col-md-7 col-xs-12" type="password" name="password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Shop Logo</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="file" class="form-control col-md-7 col-xs-12" type="file" name="logo">
                            </div>
                        </div>
                        <div class="form-group hide" id="preview">
                            <div class="right col-xs-3 col-md-1 text-center col-md-offset-3 col-sm-offset-3">
                                <img class="img-circle img-responsive" src="" alt="" height="100" width="100">
                            </div>
                        </div>
                        <div class="form-group">
                            <label title="Shop History will be cleared after selected number of days" for="clear_history" class="control-label col-md-3 col-sm-3 col-xs-12">Clear History (Days) <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                {!! Form::selectRange('clear_history', 1, 20,null,['class' => 'form-control']) !!}
                            </div>
                        </div>-->
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a href="{{URL::previous()}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" id="save_btn" class="btn btn-success">Submit</button>
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
    <script type="text/javascript" src="{{asset('local/public/assets/js/jquery.validate.min.js')}}"></script>    <script type="text/javascript">
        jQuery(document).ready(function(e){
            jQuery('#shopForm').validate({
                errorElement : 'span',
                rules : {
                    'shop_name' : {required:true},
                    'city'         : {required:true},
                    'shop'         : {required:true},
                    'code'         : {required:true,maxlength:4 ,alphanumeric:true},
                    password: {
                        required: true,
                        pwcheck: true,
                        minlength: 7
                    }
                },
                messages: {
                    password: {
                        pwcheck: "Password must be Alphanumeric with one special character!",
                        minlength: "Your password must be at least 7 characters long!"
                    }

                }
            });
        });
        jQuery.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z0-9\s]+$/);
        },'Code can contain alphanumeric value only');
        jQuery.validator.addMethod("pwcheck", function(value, element) {
            return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
                    && /[a-z]/.test(value) // has a lowercase letter
                    && /\d/.test(value); // has a digit
        });

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
