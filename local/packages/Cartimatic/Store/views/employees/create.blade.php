@extends('Store::layouts.store-admin')
@section('styles')

@stop
@section('content')

    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Add New Employee</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::open(['url' => 'admin/store/employees/store','class' => 'form-horizontal form-label-left','data-parsley-validate', 'enctype'=>"multipart/form-data" , 'id' => 'empForm']) !!}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Employee Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                {!! Form::text('employee_name',NULL, ['class' => 'form-control col-md-7 col-xs-12','required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::email('email',NULL, ['class' => 'form-control col-md-7 col-xs-12','required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Phone Number <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                {!! Form::text('phone_number',NULL, ['class' => 'form-control col-md-7 col-xs-12','required','id' => 'phone_number']) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">City <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('city',NULL, ['class' => 'form-control col-md-7 col-xs-12','required']) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('address',NULL, ['class' => 'form-control col-md-7 col-xs-12','required']) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Birthday <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('birthday',NULL, ['class' => 'form-control col-md-7 col-xs-12','required','id' => 'birthday', 'placeholder'=>"mm/dd/yyyy"]) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Hire Date <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('hire_date',NULL, ['class' => 'form-control col-md-7 col-xs-12','required','id' => 'hire_date', 'placeholder'=>"mm/dd/yyyy"]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Employee Number <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('employee_number',NULL, ['class' => 'form-control col-md-7 col-xs-12','required']) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Role <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php /*$roles = config('admin_constants.EMPLOYEES');
                                    $roles = array_flip($roles);
                                */?>
                                {!! Form::select('role', $roles, null, ['class' => 'form-control col-md-7 col-xs-12', 'required','placeholder' => 'Select Employee Role']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Employee Avatar *</label>
                            <div class="col-md-6 col-sm-6 col-xs-9">
                                <input id="file" class="form-control col-md-7 col-xs-12" type="file" name="avatar" >
                            </div>


                        </div>
                        <div class="form-group hide" id="preview">
                            <div class="right col-xs-3 col-md-1 text-center col-md-offset-3 col-sm-offset-3">
                                <img class="img-circle img-responsive" alt="" src="">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a href="{{URL::previous()}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" id="emp_save" class="btn btn-success">Submit</button>
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
    <script>
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


    </script>
    {!! HTML::script('local/public/assets/gentelella/js/moment/moment.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datepicker/daterangepicker.js') !!}
    <script src="{{url('local/public/assets/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#hire_date').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
            }, function (start, end, label) {
            });
            $('#birthday').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4",
                showDropdowns: true
            }, function (start, end, label) {
               // var years = moment().diff(start, 'years');
                //alert("You are " + years + " years old.");
            });
        });


        jQuery(document).ready(function(e){
            jQuery('#empForm').validate({
                errorElement : 'span',
                rules : {
                    'employee_name' : {required:true},
                    email: {
                        required: true,
                        email: true
                    },
                    phone_number: 'customphone',
                    'city'         : {required:true},
                    password: {
                        required: true,
                        pwcheck: true,
                        minlength: 7
                    }
                },

            });
        });

        jQuery.validator.addMethod('customphone', function (value, element) {
            return this.optional(element) || /^[+]?([0-9]*[\.\s\-\(\)]|[0-9]+){3,24}$/.test(value);
        }, "Please enter a valid phone number");

        jQuery(document).on('click','#emp_save',function(e){
            e.preventDefault();
            jQuery('#empForm').submit();
        });
    </script>
@stop
