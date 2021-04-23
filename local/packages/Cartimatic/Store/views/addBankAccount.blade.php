{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 06-May-16 6:44 PM
    * File Name    :

--}}
@extends('Store::layouts.store-admin')
@section('styles')

{!! HTML::style('local/public/assets/gentelella/css/animate.min.css') !!}
@endsection
@section('content')
        <!-- page content -->


<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Add Bank Account
            </h3>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Bank account details

                    </h2>
                </div>
                <div class="x_content">

                    <form action="{{url('store/addBankAccount')}}" method="post" class="form-horizontal form-label-left" novalidate>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title of account <span
                                        class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                                       data-validate-words="2" name="account_title" placeholder="Full name e.g Jon Doe"
                                       required="required" type="text" value="{{$bank->account_title}}">

                                <div class="clearfix"></div>

                                Your full name that appears on your bank account statement.
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Permanent Billing Address <span
                                        class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="email" name="permanent_billing_address" required="required"
                                       class="form-control col-md-7 col-xs-12" value="{{$bank->permanent_billing_address}}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Temporary Billing Address <span
                                        class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="email2" name="temp_billing_address"
                                       required="required" class="form-control col-md-7 col-xs-12" value="{{$bank->temp_billing_address}}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">City  <span
                                        class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="number" name="city" required="required"
                                       data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12" value="{{$bank->city}}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">State <span
                                        class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="website" name="state" required="required"
                                       placeholder="" class="form-control col-md-7 col-xs-12" value="{{$bank->state}}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Post Code <span
                                        class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="occupation" type="text" name="post_code"
                                       class="optional form-control col-md-7 col-xs-12" required="required" value="{{$bank->post_code}}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password" class="control-label col-md-3">Country <span
                                        class="required">*</span></label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('country_code', $countries,$bank->country_code,['class'=>'form-control col-md-7 col-xs-12', 'required']) !!}
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Account Number</label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password2" type="text" name="account_number"
                                       class="form-control col-md-7 col-xs-12" required="required" value="{{$bank->account_number}}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">IBAN Number <span
                                        class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="telephone" name="iban_number" required="required"
                                       class="form-control col-md-7 col-xs-12" value="{{$bank->iban_number}}">
                                <div class="clearfix"></div>
                                Up to 34 numbers and letters
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Swift Code <span
                                        class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="telephone" name="swift_code" required="required"
                                      class="form-control col-md-7 col-xs-12" value="{{$bank->swift_code}}">


                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Bank name in full <span
                                        class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="telephone" name="bank_name" required="required"
                                       class="form-control col-md-7 col-xs-12" value="{{$bank->bank_name}}">


                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password" class="control-label col-md-3">Bank branch country  <span
                                        class="required">*</span></label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('bank_branch_country_code', $countries,$bank->bank_branch_country_code,['class'=>'form-control col-md-7 col-xs-12', 'required']) !!}
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Bank branch city <span
                                        class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="telephone" name="bank_branch_city" required="required"
                                        class="form-control col-md-7 col-xs-12" value="{{$bank->bank_branch_city}}">


                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <a href="{{URL::previous()}}" class="btn btn-primary">Cancel</a>
                                <button id="send" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->
@endsection
@section('scripts')
    {!! HTML::script('local/public/assets/gentelella/js/validator/validator.js') !!}
    <script>
        // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
                .on('blur', 'input[required], input.optional, select.required', validator.checkField)
                .on('change', 'select.required', validator.checkField)
                .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
                .on('keyup blur', 'input', function() {
                    validator.checkField.apply($(this).siblings().last()[0]);
                });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);

        $('form').submit(function(e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });

        /* FOR DEMO ONLY */
        $('#vfields').change(function() {
            $('form').toggleClass('mode2');
        }).prop('checked', false);

        $('#alerts').change(function() {
            validator.defaults.alerts = (this.checked) ? false : true;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    </script>

@endsection
