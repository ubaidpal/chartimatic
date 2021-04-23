{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 06-May-16 6:44 PM
    * File Name    :

--}}
@extends('Store::layouts.store-admin')
@section('content')
        <!-- page content -->


<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Statement
                {{--<small>
                    All Orders
                </small>--}}
            </h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="text">
                    <h2 class="">Your Balance:&nbsp; {{format_currency($earning)}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php $debit = 0;
    $totalDebits = 0;
    $totalCredit = 0;
    ?>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="x_content">
                            <br>

                            {!! Form::open(['url' => 'store/'.$user->username.'/admin/statement']) !!}

                            <div class="form-group col-sm-2 col-xs-12">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from">
                                    From
                                </label>

                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input value="{{date('Y/m/d',strtotime($from))}}" type="text" id="from"
                                           required="required"
                                           class="form-control col-md-12 col-xs-12" name="from" data-parsley-id="9756"
                                           placeholder="{{\Carbon\Carbon::now()->format('Y/m/d')}}">
                                    <ul class="parsley-errors-list" id="parsley-id-9756"></ul>
                                </div>
                            </div>
                            <div class="form-group col-sm-2 col-xs-12">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="to">
                                    To
                                </label>

                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" id="to" name="last-name" required="required"
                                           class="form-control col-md-12 col-xs-12" data-parsley-id="0947"
                                           {{\Carbon\Carbon::now()->format('Y/m/d')}} value="{{date('Y/m/d',strtotime($to))}}">
                                    <ul class="parsley-errors-list" id="parsley-id-0947"></ul>
                                </div>
                            </div>
                            <div class="form-group col-sm-3 col-xs-12">
                                <label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">
                                    Transaction Type
                                </label>

                                <div class="form-group col-sm-8 col-xs-12">
                                    <select class="form-control" name="transaction_type">
                                        <option value="">All Transaction Types</option>
                                        <option @if($transaction_type == 'credit') selected="selected"
                                                @endif value="credit">Credit
                                        </option>
                                        <option @if($transaction_type == 'debit') selected="selected"
                                                @endif value="debit">Debit
                                        </option>
                                    </select>
                                    <ul class="parsley-errors-list" id="parsley-id-1206"></ul>
                                </div>
                            </div>
                            <div class="form-group col-sm-3 col-xs-12">
                                <label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">
                                    Select For
                                </label>

                                <div class="form-group col-sm-8 col-xs-12">
                                    {!! Form::select('statement_for', $poss, NULL, ['class' => 'form-control', 'placeholder' => 'All']) !!}
                                    <ul class="parsley-errors-list" id="parsley-id-1206"></ul>
                                </div>
                            </div>


                                <div class="form-group col-sm-2">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="x_title">
                    <h2>Statement
                    </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <section class="content invoice">

                        @if(count($transactions) > 0)
                                <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Ref. ID</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($transactions as $row)
                                        <tr>
                                            <td>{{getTimeByTZ($row->created_at, 'M. d, Y')}}</td>
                                            <td> @if($row->type == config('constants_brandstore.STATEMENT_TYPES.SALE'))
                                                    {{\Vinkla\Hashids\Facades\Hashids::connection('store')->encode($row->id)}}

                                                    <a class="btn-link"
                                                       href="{{url('store/'.$url_user_id.'/admin/order-invoice/'.$row->parent_id)}}">
                                                        View Details
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{config('constants_brandstore.STATEMENT_TYPES_STRING.'.$row->type)}}</td>

                                            @if($row->type == config('constants_brandstore.STATEMENT_TYPES.SALE'))
                                                <td>
                                                    <?php $products = getOrderAllProductsDetail($row->parent_id);?>
                                                    @foreach($products as $product)
                                                        <strong>{{$product->title}}</strong>
                                                        <div class="clearfix"></div>
                                                        <div class="text">{{format_currency($product->price)}}</div>
                                                    @endforeach
                                                </td>
                                                <td>{{format_currency($row->amount)}}</td>
                                            @elseif($row->type == config('constants_brandstore.STATEMENT_TYPES.WITHDRAW_FEE'))
                                                <td>Delivery Sure Fee</td>
                                                <td>{{format_currency($row->amount)}}</td>
                                            @elseif($row->type == config('constants_brandstore.STATEMENT_TYPES.ORDER_SHIPPING_FEE'))
                                                <td>Shipping Fee</td>
                                                <td>{{format_currency($row->amount)}}</td>
                                            @else
                                                <td>Funds transfer</td>
                                                <td>{{format_currency($row->amount)}}</td>
                                            @endif


                                            <td>
                                                @if($row->transaction_type == 'credit')
                                                    <?php $debit = $debit + $row->amount;
                                                    $totalDebits = $totalDebits + $row->amount;
                                                    ?>
                                                    {{format_currency($row->amount)}}
                                                @elseif($row->transaction_type == 'debit')
                                                    <?php $debit = $debit - $row->amount;
                                                    $totalCredit = $totalCredit + $row->amount;
                                                    ?>
                                                    {{format_currency($row->amount)}}
                                                @else
                                                    {{format_currency($row->amount)}}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class=" col-xs-12">
                            <div class="col-sm-5 col-xs-12">

                                <strong>Statement Period:</strong> {{getTimeByTZ($from, 'M. d, Y')}}
                                to {{getTimeByTZ($to, 'M. d, Y')}}

                            </div>
                            <div class="col-sm-3 col-xs-12 pull-right">
                                <table class="table table-striped ">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <strong>Beginning Balance:</strong>
                                        </td>
                                        <td><strong>{{format_currency($beginning_balance)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Total Debits:
                                        </td>
                                        <td>{{format_currency($totalDebits)}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Total Credits:
                                        </td>
                                        <td>{{format_currency($totalCredit)}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Ending Balance:</strong>
                                        </td>
                                        <td><strong>{{format_currency($debit+$beginning_balance)}}</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        @else
                            <div class="text">There is no transaction</div>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->
@endsection
@section('scripts')
    {!! HTML::script('local/public/assets/gentelella/js/moment/moment.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datepicker/daterangepicker.js') !!}
    {!! HTML::script('local/public/assets/store/datepicker.js') !!}

@endsection
