{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 10-Aug-16 5:56 PM
    * File Name    :

--}}
@extends('Store::layouts.store-admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{!! asset('local/public/assets/gentelella/css/maps/jquery-jvectormap-2.0.3.css')!!}"/>
@stop

@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Dashboard
                    <small>
                    </small>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            @include('includes.alerts')
            <div class="">

                <div class="row top_tiles">
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <h3 class="col-sm-12 text-center" style="margin: 10px 0">
                                Revenue
                            </h3>
                            <ul class="col-sm-12 to_do">
                                <li class="row">
                                   <span class="col-sm-6 pull-left text-center">Today</span>
                                   <span class="col-sm-6 pull-right text-center">Month</span>
                                </li>
                            </ul>
                            <ul class="col-sm-12">
                                <li class="row">
                                    <span class="col-sm-6 pull-left text-center " style="border-right: 1px solid">
                                        ${{number_format($today_revenue)}}
                                    </span>
                                    <span class="col-sm-6 pull-right text-center">
                                        ${{number_format($month_revenue)}}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <h3 class="col-sm-12 text-center" style="margin: 10px 0">
                                Profit
                            </h3>
                            <ul class="col-sm-12 to_do">
                                <li class="row">
                                    <span class="col-sm-6 pull-left text-center">Today</span>
                                    <span class="col-sm-6 pull-right text-center">Month</span>
                                </li>
                            </ul>
                            <ul class="col-sm-12">
                                <li class="row">
                                    <span class="col-sm-6 pull-left text-center " style="border-right: 1px solid">
                                        ${{number_format($today_profit)}}
                                    </span>
                                    <span class="col-sm-6 pull-right text-center">
                                        ${{number_format($month_profit)}}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <h3 class="col-sm-12 text-center" style="margin: 10px 0">
                                Orders
                            </h3>
                            <ul class="col-sm-12 to_do">
                                <li class="row">
                                    <span class="col-sm-6 pull-left text-center">Today</span>
                                    <span class="col-sm-6 pull-right text-center">Month</span>
                                </li>
                            </ul>
                            <ul class="col-sm-12">
                                <li class="row">
                                    <span class="col-sm-6 pull-left text-center " style="border-right: 1px solid">
                                        {{number_format($today_orders)}}
                                    </span>
                                    <span class="col-sm-6 pull-right text-center">
                                        {{number_format($month_orders)}}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <h3 class="col-sm-12 text-center" style="margin: 10px 0">
                                Customers
                            </h3>
                            <ul class="col-sm-12 to_do">
                                <li class="row">
                                    <span class="col-sm-6 pull-left text-center">Today</span>
                                    <span class="col-sm-6 pull-right text-center">Month</span>
                                </li>
                            </ul>
                            <ul class="col-sm-12">
                                <li class="row">
                                    <span class="col-sm-6 pull-left text-center " style="border-right: 1px solid">120</span>
                                    <span class="col-sm-6 pull-right text-center">1500</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <div class="row x_title">
                                    <div class="col-md-6">
                                        <h3>Sale Analysis
                                            <small>Graph title sub-title</small>
                                        </h3>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="reportrange" class="pull-right"
                                             style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                                    <div style="width: 100%;">
                                        <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Recent Notifications</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="dashboard-widget-content">

                                    <ul class="list-unstyled timeline widget">
                                        <li>
                                            <div class="block">
                                                <div class="block_content">
                                                    <h2 class="title">
                                                        <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                                    </h2>

                                                    <div class="byline">
                                                        <span>13 hours ago</span> by <a>Jane Smith</a>
                                                    </div>
                                                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They
                                                        were where you met the producers that could fund your project, and if the buyers
                                                        liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="block">
                                                <div class="block_content">
                                                    <h2 class="title">
                                                        <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                                    </h2>

                                                    <div class="byline">
                                                        <span>13 hours ago</span> by <a>Jane Smith</a>
                                                    </div>
                                                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They
                                                        were where you met the producers that could fund your project, and if the buyers
                                                        liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="block">
                                                <div class="block_content">
                                                    <h2 class="title">
                                                        <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                                    </h2>

                                                    <div class="byline">
                                                        <span>13 hours ago</span> by <a>Jane Smith</a>
                                                    </div>
                                                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They
                                                        were where you met the producers that could fund your project, and if the buyers
                                                        liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="block">
                                                <div class="block_content">
                                                    <h2 class="title">
                                                        <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                                    </h2>

                                                    <div class="byline">
                                                        <span>13 hours ago</span> by <a>Jane Smith</a>
                                                    </div>
                                                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They
                                                        were where you met the producers that could fund your project, and if the buyers
                                                        liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Latest Orders</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                        <th>Extn.</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Tiger</td>
                                        <td>Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                        <td>5421</td>
                                        <td><a class="btn btn-info" title="" data-toggle="tooltip"
                                               href="http://localhost/aspiredemo/admin/index.php?route=sale/order/info&amp;token=42xXQvQCVHDza1uaABIblnV6xwsD8tbc&amp;order_id=2"
                                               data-original-title="View"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Garrett</td>
                                        <td>Winters</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                        <td>2011/07/25</td>
                                        <td>$170,750</td>
                                        <td>8422</td>
                                        <td><a class="btn btn-info" title="" data-toggle="tooltip"
                                               href="http://localhost/aspiredemo/admin/index.php?route=sale/order/info&amp;token=42xXQvQCVHDza1uaABIblnV6xwsD8tbc&amp;order_id=2"
                                               data-original-title="View"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Ashton</td>
                                        <td>Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                        <td>66</td>
                                        <td>2009/01/12</td>
                                        <td>$86,000</td>
                                        <td>1562</td>
                                        <td><a class="btn btn-info" title="" data-toggle="tooltip"
                                               href="http://localhost/aspiredemo/admin/index.php?route=sale/order/info&amp;token=42xXQvQCVHDza1uaABIblnV6xwsD8tbc&amp;order_id=2"
                                               data-original-title="View"><i class="fa fa-eye"></i></a></td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="x_panel tile fixed_height_320 overflow_hidden">
                            <div class="x_title">
                                <h2>Device Usage</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table class="" style="width:100%">
                                    <tr>
                                        <th style="width:37%;">
                                            <p>Top 5</p>
                                        </th>
                                        <th>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                <p class="">Device</p>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <p class="">Progress</p>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                                        </td>
                                        <td>
                                            <table class="tile_info">
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square blue"></i>IOS </p>
                                                    </td>
                                                    <td>30%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square green"></i>Android </p>
                                                    </td>
                                                    <td>10%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square purple"></i>Blackberry </p>
                                                    </td>
                                                    <td>20%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square aero"></i>Symbian </p>
                                                    </td>
                                                    <td>15%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square red"></i>Others </p>
                                                    </td>
                                                    <td>30%</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Visitors location
                                    <small>geo-presentation</small>
                                </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                                                    class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="dashboard-widget-content">
                                    <div class="col-md-4 hidden-small">
                                        <h2 class="line_30">125.7k Views from 60 countries</h2>

                                        <table class="countries_list">
                                            <tbody>
                                            <tr>
                                                <td>United States</td>
                                                <td class="fs15 fw700 text-right">33%</td>
                                            </tr>
                                            <tr>
                                                <td>France</td>
                                                <td class="fs15 fw700 text-right">27%</td>
                                            </tr>
                                            <tr>
                                                <td>Germany</td>
                                                <td class="fs15 fw700 text-right">16%</td>
                                            </tr>
                                            <tr>
                                                <td>Spain</td>
                                                <td class="fs15 fw700 text-right">11%</td>
                                            </tr>
                                            <tr>
                                                <td>Britain</td>
                                                <td class="fs15 fw700 text-right">10%</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Transaction Summary
                                    <small>Weekly progress</small>
                                </h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="demo-container" style="height:280px">
                                        <div id="placeholder33x" class="demo-placeholder"></div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="x_panel tile overflow_hidden" style="height: 364px">
                            <div class="x_title">
                                <h2>Visitors</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table class="" style="width:100%">
                                    <tr>
                                        <th style="width:37%;">
                                            <p></p>
                                        </th>
                                        <th>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                <p class="">Visitors</p>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <p class="">Count</p>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <canvas id="visitors" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                                        </td>
                                        <td>
                                            <table class="tile_info">
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square blue"></i>Total </p>
                                                    </td>
                                                    <td>45</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square aero"></i>Returning Customers </p>
                                                    </td>
                                                    <td>15</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square green"></i>New Customers </p>
                                                    </td>
                                                    <td>30</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                </div>
            </div>


        </div>

    </div>

@stop
@section('scripts')
    <script src="{!! asset('local/public/assets/gentelella/js/chartjs/chart.min.js')!!}"></script>
    <script src="{!! asset('local/public/assets/gentelella/js/sparkline/jquery.sparkline.min.js')!!}"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="{!! asset('local/public/assets/gentelella/js/moment/moment.min.js')!!}"></script>
    <script type="text/javascript" src="{!! asset('local/public/assets/gentelella/js/datepicker/daterangepicker.js')!!}"></script>
    <script type="text/javascript" src="{!! asset('local/public/assets/gentelella/js/flot/jquery.flot.js')!!}"></script>
    <script type="text/javascript" src="{!! asset('local/public/assets/gentelella/js/flot/jquery.flot.pie.js')!!}"></script>
    <script type="text/javascript" src="{!! asset('local/public/assets/gentelella/js/flot/jquery.flot.orderBars.js')!!}"></script>
    <script type="text/javascript" src="{!! asset('local/public/assets/gentelella/js/flot/jquery.flot.time.min.js')!!}"></script>
    <script type="text/javascript" src="{!! asset('local/public/assets/gentelella/js/flot/date.js')!!}"></script>
    <script type="text/javascript" src="{!! asset('local/public/assets/gentelella/js/flot/jquery.flot.spline.js')!!}"></script>
    {{-- <script type="text/javascript" src="{!! asset('local/public/assets/gentelella/js/flot/jquery.flot.stack.js')!!}"></script>
     <script type="text/javascript" src="{!! asset('local/public/assets/gentelella/js/flot/curvedLines.js')!!}"></script>
     <script type="text/javascript" src="{!! asset('local/public/assets/gentelella/js/flot/jquery.flot.resize.js')!!}"></script>--}}
    <!-- pace -->
    <script src="{!! asset('local/public/assets/gentelella/js/pace/pace.min.js')!!}"></script>
    <script src="{!! asset('local/public/assets/gentelella/js/maps/gdp-data.js')!!}"></script>

    <script src="{!! asset('local/public/assets/gentelella/js/maps/jquery-jvectormap-2.0.3.min.js')!!}"></script>
    <script src="{!! asset('local/public/assets/gentelella/js/maps/jquery-jvectormap-world-mill-en.js')!!}"></script>
    <script src="{!! asset('local/public/assets/gentelella/js/maps/jquery-jvectormap-us-aea-en.js')!!}"></script>


    <script type="text/javascript">
        //define chart clolors ( you maybe add more colors if you want or flot will add it automatic )
        var chartColours = ['#2A3F54'];

        //generate random number for charts
        randNum = function () {
            return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
        };
        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }
        $(function () {
            var data1 = [
                [gd(2010, 1, 1), 17],
                [gd(2010, 1, 2), 74],
                [gd(2010, 1, 3), 6],
                [gd(2010, 1, 4), 39],
                [gd(2010, 1, 5), 20],
                [gd(2010, 1, 6), 85],
                [gd(2010, 1, 7), 7]
            ];

            var data2 = [
                [gd(2010, 1, 1), 82],
                [gd(2010, 1, 2), 23],
                [gd(2010, 1, 3), 66],
                [gd(2010, 1, 4), 9],
                [gd(2010, 1, 5), 119],
                [gd(2010, 1, 6), 6],
                [gd(2010, 1, 7), 9]
            ];
            $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
                data1, data2
            ], {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    //verticalLines: true,
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#fff'
                },
                colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
                xaxis: {
                    tickColor: "rgba(51, 51, 51, 0.06)",
                    mode: "time",
                    tickSize: [1, "day"],
                    //tickLength: 10,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Verdana, Arial',
                    axisLabelPadding: 10
                    //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
                },
                yaxis: {
                    ticks: 8,
                    tickColor: "rgba(51, 51, 51, 0.06)",
                },
                tooltip: false
            });


            var d1 = [];
            //var d2 = [];

            //here we generate data for chart
            for (var i = 0; i < 30; i++) {
                d1.push([new Date(Date.today().add(i).days()).getTime(), randNum() + i + i + 10]);
                //    d2.push([new Date(Date.today().add(i).days()).getTime(), randNum()]);
            }

            var chartMinDate = d1[0][0]; //first day
            var chartMaxDate = d1[20][0]; //last day

            var tickSize = [1, "day"];
            var tformat = "%d/%m/%y";

            //graph options
            var options = {
                grid: {
                    show: true,
                    aboveData: true,
                    color: "#2A3F54",
                    labelMargin: 10,
                    axisMargin: 0,
                    borderWidth: 0,
                    borderColor: null,
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 100
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        lineWidth: 2,
                        steps: false
                    },
                    points: {
                        show: true,
                        radius: 4.5,
                        symbol: "circle",
                        lineWidth: 3.0
                    }
                },
                legend: {
                    position: "ne",
                    margin: [0, -25],
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function (label, series) {
                        // just add some space to labes
                        return label + '&nbsp;&nbsp;';
                    },
                    width: 40,
                    height: 1
                },
                colors: chartColours,
                shadowSize: 0,
                tooltip: true, //activate tooltip
                tooltipOpts: {
                    content: "%s: %y.0",
                    xDateFormat: "%d/%m",
                    shifts: {
                        x: -30,
                        y: -50
                    },
                    defaultTheme: false
                },
                yaxis: {
                    min: 0
                },
                xaxis: {
                    mode: "time",
                    minTickSize: tickSize,
                    timeformat: tformat,
                    min: chartMinDate,
                    max: chartMaxDate
                }
            };
            var plot = $.plot($("#placeholder33x"), [{
                label: "Traffic Analysis",
                data: d1,
                lines: {
                    fillColor: "rgba(42, 63, 84, 0.25)"
                }, //#96CA59 rgba(150, 202, 89, 0.42)
                points: {
                    fillColor: "#fff"
                }
            }], options);
        });
    </script>
    <!-- /flot -->
    <!--  -->
    <script>

        $('document').ready(function () {
            var options = {
                legend: false,
                responsive: false
            };

            new Chart(document.getElementById("canvas1"), {
                type: 'doughnut',
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: [
                        "Symbian",
                        "Blackberry",
                        "Other",
                        "Android",
                        "IOS"
                    ],
                    datasets: [{
                        data: [15, 20, 30, 10, 30],
                        backgroundColor: [
                            "#BDC3C7",
                            "#9B59B6",
                            "#E74C3C",
                            "#26B99A",
                            "#3498DB"
                        ],
                        hoverBackgroundColor: [
                            "#CFD4D8",
                            "#B370CF",
                            "#E95E4F",
                            "#36CAAB",
                            "#49A9EA"
                        ]
                    }]
                },
                options: options
            });


            var options1 = {
                legend: true,
                responsive: true
            };

            new Chart(document.getElementById("visitors"), {
                type: 'doughnut',
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: [
                        "Returning",
                        "New"
                    ],
                    datasets: [{
                        data: [15, 20],
                        backgroundColor: [
                            "#9CC2CB",
                            "#1ABB9C"
                        ],
                        hoverBackgroundColor: [

                            "#9CC2CB",
                            "#1ABB9C"
                        ]
                    }]
                },
                options: options1
            });
        });
    </script>

    <!-- Doughnut Chart -->
    <script>
        $('document').ready(function () {
            $('#world-map-gdp').vectorMap({
                map: 'world_mill_en',
                backgroundColor: 'transparent',
                zoomOnScroll: false,
                series: {
                    regions: [{
                        values: gdpData,
                        scale: ['#E6F2F0', '#149B7E'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                onRegionTipShow: function (e, el, code) {
                    el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
                }
            });
        });
    </script>
    <!-- /Doughnut Chart -->

    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            };

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };
            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#reportrange').daterangepicker(optionSet1, cb);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            });
            $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange').data('daterangepicker').remove();
            });
        });
    </script>
@stop
