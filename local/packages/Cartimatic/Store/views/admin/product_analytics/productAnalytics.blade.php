@extends('Store::layouts.store-admin')
@section('content')
        <!-- Post Div-->

@include('Store::admin.product_analytics.canvas.canvas')
<div class="row">
    <div class="product-Analytics">
        <div class="addProduct">
            <h1>Product Analytics</h1>
            <div class="selectdiv" id="row_1">
                <div class="chart" >
                    <div id="chartContainerView"
                         style="float:left; height: 300px; width: 100%;"></div>
                    <a class="btn btn-add" href="#number-views">View Detail</a>
                </div>

            </div>

            <div class="selectdiv" id="row_2">
                <div class="chart" style="height:100%; width: 33.5%; float: left; display: none">
                    <div id="chartContainerAge" style="float: left; height: 300px; width: 100%;"></div>
                    <a class="btn btn-add" href="#age-views" style="float: left; width: 100%;">View Detail</a>
                </div>

                <div class="chart" style="width: 30%; ; float: left; display: none;">
                    <div id="chartContainerGender" style="float:left; height: 300px; width: 100%;"></div>
                    <a class="btn btn-add" href="#gender-views" style="float: left; width: 100%;">View Detail</a>
                </div>

                <div class="chart" style="width: 100%; height: 200px;float: left">
                    <div id="chartContainerRegion" style="float:left; height: 300px; width: 100%;"></div>
                    <a class="btn btn-add" href="#country-views" style="float: left; width: 100%;">View Detail</a>
                </div>

            </div>
            {{--<div class="field-item product-images" id="row_3">
                <div id="lineChart" style="height: 300px; width: 100%;"></div>
            </div>--}}
            <div class="chart" style="width: 100%; height: 100%">
                <div class="field-item product-images" id="row_4">
                    <div id="chartContainerView-1" style="height: 300px; width: 100%;"></div>
                </div>
                <a class="btn btn-add" href="#peak-views" style="float: left; width: 100%;">View Detail</a>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
    @include('Store::admin.product_analytics.chart-detail.number-views')
    @include('Store::admin.product_analytics.chart-detail.age-view')
    @include('Store::admin.product_analytics.chart-detail.peak-traffic-view')
    @include('Store::admin.product_analytics.chart-detail.gender')
    @include('Store::admin.product_analytics.chart-detail.region-view')

    {!! HTML::script('local/packages/Cartimatic/assets/js/charts.js') !!}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){

            /*var myAllCountries = [];
             $.each(document.getElementsByClassName("abc"), function (i, feature) {
             myAllCountries.push(feature.value);
             });*/

            var chart = new CanvasJS.Chart("chartContainerRegion", {
                title : {
                    text : "Region"
                },axisX:{
                    title:'Region'
                },axisY:{
                    title:'Views'
                }, animationEnabled : true, data : [{
                    // Change type to "doughnut", "line", "splineArea", etc.
                    type : "column", dataPoints : [<?php echo $myAllCountries; ?>
                        ]
                }]
            });
            chart.render();
        });

        $(document).ready(function(){
            var chart = new CanvasJS.Chart("chartContainerAge", {
                title : {
                    text : "Age"
                },axisX:{
                    title:'Age'
                },axisY:{
                    title:'Views'
                }, animationEnabled : true, data : [{
                    // Change type to "doughnut", "line", "splineArea", etc.
                    type : "column", dataPoints : [{
                        color : '#c5d6dd', label : "10-25", y : <?php echo $product_statics_by_age["firstCountView"]?>



                    }, {
                        color : '#78acc1', label : "25-35", y : <?php echo $product_statics_by_age["secondCountView"]?>



                    }, {
                        color : '#c5d6dd', label : "35-45", y : <?php echo $product_statics_by_age["thirdCountView"]?>



                    }, {
                        color : '#78acc1', label : "45-55", y : <?php echo $product_statics_by_age["fourthCountView"]?>



                    }, {
                        color : '#c5d6dd', label : "> 55", y : <?php echo $product_statics_by_age["fifthCountView"]?>

                    },]
                }]
            });
            chart.render();
        });

        $(document).ready(function(){
            var chart = new CanvasJS.Chart("chartContainerView-1", {
                animationEnabled : true, animationDuration : 2000,
                title : {
                    text : "Traffic and Peak hours",
                    font: "12px Arial,Helvetica,sans-serif"
                }, axisX : {
                    title : "Hours of the day ({{\Carbon\Carbon::now()->format('d-m-Y')}})", // gridThickness: 3,
                    interval : 1, intervalType : "hour", valueFormatString : "hh", //labelAngle: -30
                }, axisY : {
                    title : "Views",
                    interval : 1, intervalType : "number",
                }, data : [{
                    type : "column", color : "#78b0c1", indexLabelFontColor : "green",
                    dataPoints :[ <?php echo  $preparedStatViewsHours; ?>]
                }]
            });
            chart.render();
        });

        $(document).ready(function(){
            var chart = new CanvasJS.Chart("chartContainerGender", {
                title : {
                    text : "Gender", /*fontFamily: "Impact",
                     fontWeight: "normal"*/
                },axisX:{
                    title:'Gender'
                },axisY:{
                    title:'Views'
                }, animationEnabled : true,

                legend : {
                    verticalAlign : "bottom", horizontalAlign : "center"
                }, data : [{

                    type : "doughnut", showInLegend : true, dataPoints : [{
                        y : <?php echo $product_statics_by_age["maleCountView"]?>,
                        color : '#c5d6dd',
                        legendText : "Male <?php echo round($product_statics_by_age["maleCountViewPercent"]);?>%",
                        indexLabel : "Male <?php echo round($product_statics_by_age["maleCountViewPercent"]);?>%"
                    }, {
                        y : <?php echo $product_statics_by_age["femaleCountView"]?>,
                        color : '#dbbcce',
                        legendText : "Female <?php echo round($product_statics_by_age["femaleCountViewPercent"]);?>%",
                        indexLabel : "Female <?php echo round($product_statics_by_age["femaleCountViewPercent"]);?>%"
                    },

                    ]
                }]
            });

            chart.render();
        });

        $(document).ready(function(){
            var chart = new CanvasJS.Chart("chartContainerView", {
                title : {
                    text : "Total Number of views"
                }, data : [{
                    type : "splineArea", //or stackedColumn
                    color : "#78b0c1", dataPoints : [<?php echo $preparedStatViews ?>
                               /* {label: "Week 9" , y: 2 },{label: "Week 10" , y: 6 },*/]
                }]
            });

            chart.render();
        });
    </script>
    <style>
        .chart{
            width:100%;
        }
        .cssPopup_overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
        }

        .cssPopup_overlay:target {
            visibility: visible;
            opacity: 1;
            z-index: 5;
        }

        .cssPopup_popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 800px;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .cssPopup_popup .cssPopup_close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .bd-itm .bd-itmr input[type="checkbox"] {
            height: auto;
            width: auto;
        }

        .bd-itmr.label-box {
            float: left;
            width: 100px;
        }
        button.ui-datepicker-close {display: none;}​
    </style>
@endsection
