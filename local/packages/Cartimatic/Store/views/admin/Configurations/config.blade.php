@extends('Store::layouts.store-admin')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h1>System Configuration</h1>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="ajax-error"></div>


        @include('includes.alerts')
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Save System Configuration</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        {!! Form::open(['url' => 'save-config', 'class'=>'']) !!}
                        <div class="row">
                            <div class="">
                                <div class="form-group row col-sm-12">
                                    <label class="col-md-2 col-sm-2 col-xs-12" for="dropdown1">Currency</label>

                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                        {!! Form::select(config('store_configuration.CURRENCY.NAME'), config('store_configuration.CURRENCY.OPTIONS'), NULL, ['id'=>"dropdown1",'class'=>"form-control"]) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row col-sm-12">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="variable 1">Product Variable Code</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">

                                    {!! Form::text(config('store_configuration.PRODUCT_VARIABLE_CODE.NAME'),(isset(\Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_CODE'])? \Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_CODE']:config('store_configuration.PRODUCT_VARIABLE_CODE.DEFAULT_VALUE')),['placeholder'=>"Product Variable 1",'id'=>"variable-1",'class'=>"form-control",'required']) !!}
                                </div>
                            </div>

                            <div class="form-group row col-sm-12">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="variable 1">Product Variable 1</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">

                                    {!! Form::text(config('store_configuration.PRODUCT_VARIABLE_1.NAME'),(isset(\Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_1'])? \Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_1']:config('store_configuration.PRODUCT_VARIABLE_1.DEFAULT_VALUE')),['placeholder'=>"Product Variable 1",'id'=>"variable-1",'class'=>"form-control",'required']) !!}
                                </div>
                            </div>

                            <div class="form-group row col-sm-12">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="variable 2">Product Variable 2</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    {!! Form::text(config('store_configuration.PRODUCT_VARIABLE_2.NAME'),(isset(\Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_2'])? \Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_2']:config('store_configuration.PRODUCT_VARIABLE_2.DEFAULT_VALUE')),['placeholder'=>"Product Variable 2",'id'=>"variable-2",'class'=>"form-control",'required']) !!}
                                </div>
                            </div>

                            <div class="form-group row col-sm-12">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="variable 3">Product Variable 3</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    {!! Form::text(config('store_configuration.PRODUCT_VARIABLE_3.NAME'),(isset(\Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_3'])? \Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_3']:config('store_configuration.PRODUCT_VARIABLE_3.DEFAULT_VALUE')),['placeholder'=>"Product Variable 3",'id'=>"variable-3",'class'=>"form-control",'required']) !!}
                                </div>
                            </div>

                            <div class="form-group row col-sm-12">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="variable 4">Product Variable 4</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    {!! Form::text(config('store_configuration.PRODUCT_VARIABLE_4.NAME'),(isset(\Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_4'])? \Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_4']:config('store_configuration.PRODUCT_VARIABLE_4.DEFAULT_VALUE')),['placeholder'=>"Product Variable 4",'id'=>"variable-4",'class'=>"form-control",'required']) !!}
                                </div>
                            </div>

                            <div class="form-group row col-sm-12">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="variable 5">Product Variable 5</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    {!! Form::text(config('store_configuration.PRODUCT_VARIABLE_5.NAME'),(isset(\Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_5'])? \Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_5']:config('store_configuration.PRODUCT_VARIABLE_5.DEFAULT_VALUE')),['placeholder'=>"Product Variable 5",'id'=>"variable-5",'class'=>"form-control",'required']) !!}
                                </div>

                            </div>
                            <div class="form-group row col-sm-12">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="dropdown2">Decimal Points in Value</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">

                                    {!! Form::select(config('store_configuration.DECIMAL_POINTS_VALUE.NAME'), config('store_configuration.DECIMAL_POINTS_VALUE.OPTIONS'),(isset(\Session::get('SYSTEM_CONFIGURATION')['DECIMAL_POINTS_VALUE'])? \Session::get('SYSTEM_CONFIGURATION')['DECIMAL_POINTS_VALUE']:NULL), ['id'=>"dropdown2",'class'=>"form-control"]) !!}
                                </div>

                            </div>
                            <div class="form-group row col-sm-12">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="dropdown2">Stock Opening </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">

                                    {!! Form::select(config('store_configuration.STOCK_OPENING.NAME'), $suppliers,(isset(\Session::get('SYSTEM_CONFIGURATION')['STOCK_OPENING'])? \Session::get('SYSTEM_CONFIGURATION')['STOCK_OPENING']:NULL), ['id'=>"dropdown2",'class'=>"form-control"]) !!}
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- <div class="ln_solid"></div>--}}
                    <div class="form-group col-sm-12">
                        <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">
                            <a href="{{URL::previous()}}" class="btn btn-primary">Cancel</a>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>


            </div>
        </div>
    </div>


@stop
