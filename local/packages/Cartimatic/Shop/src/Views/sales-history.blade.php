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
                    Sales History
                    <small>
                        (All Shop)
                    </small>
                </h3>
            </div>
            <div class="title_right">
                <a href="{{URL::previous()}}" class="btn btn-success pull-right" type="button">Back</a>

                {{--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Item...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>--}}

            </div>

        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row line-solid">
                            <form novalidate="" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left">

                                <div class="form-group col-md-4">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Start Date<span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input  type="text" data-parsley-id="4864" id="start_date" required="required" class="form-control col-md-7 col-xs-12"><ul id="parsley-id-4864" class="parsley-errors-list"></ul>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">End Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" data-parsley-id="4117" id="end_date" name="last-name" required="required" class="form-control col-md-7 col-xs-12"><ul id="parsley-id-4117" class="parsley-errors-list"></ul>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="ln_solid"></div>
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Order No.</th>
                                <th>Shop Name</th>
                                <th>Purchaser Name</th>
                                <th>Amount</th>
                                <th>Date & Time</th>
                                <th>Items(Count) </th>


                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1158</td>
                                <td>Wapda Town</td>
                                <td>Tiger Nixon</td>
                                <td>$1150</td>
                                <td>09-08-2016 5:28 PM</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>1158</td>
                                <td>Link Road</td>
                                <td>Alam Din</td>
                                <td>$5250</td>
                                <td>09-08-2016 5:28 PM</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>1158</td>
                                <td>Mall Road</td>
                                <td>Al Asr</td>
                                <td>$150</td>
                                <td>09-08-2016 5:28 PM</td>
                                <td>5</td>
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
    <!-- daterangepicker -->
    {!! HTML::script('local/public/assets/gentelella/js/moment/moment.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datepicker/daterangepicker.js') !!}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#start_date, #end_date').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>

@stop
