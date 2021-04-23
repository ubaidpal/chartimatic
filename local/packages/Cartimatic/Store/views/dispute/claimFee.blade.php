@extends('layouts.default')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="pro-header">
                <h1>Pay Processing Fee</h1>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            @include('Store::includes.orders-sidebar')

            <div class="col-md-9">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{html_entity_decode(Session::get('success'))}}
                    </div>
                @endif

                    <div class="text-danger mar-bt-10" id="paymentErrors">

                    </div>

                <div class="row">
                    <div class="dispute-main-title">Make Payment
                        <span class="text-info pull-right">Dispute Processing Fee:&nbsp;{{format_currency($claim_fee)}}</span>
                    </div>
                    <div class="dispute-wrapper">
                        <form method="post" id="paymentForm" class="" role="form" action="{{url('store/payClaimFee/'.$claim_id)}}">
                            {!! csrf_field() !!}
                            <div class="dp-box">
                                <div class="col-md-4"><label class="col-left">Name on Card:</label></div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" data-worldpay="name" name="name"
                                           placeholder="Name on card" required>
                                </div>
                            </div>
                            <div class="dp-box">
                                <div class="col-md-4"><label class="col-left">Card Number:</label></div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="number" size="20"
                                           placeholder="Card Number" data-worldpay="number" required>
                                </div>
                            </div>
                            <div class="dp-box">
                                <div class="col-md-4"><label class="col-left">CVC:</label></div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="cvc" size="4" placeholder="CVC"
                                           data-worldpay="cvc" required>
                                </div>
                            </div>
                            <div class="dp-box">
                                <div class="col-md-4"><label class="col-left">Expiration (MM/YYYY):</label></div>
                                <div class="col-md-2 pull-left">
                                    <input type="text" class="form-control" name="exp-month" size="2" placeholder="MM"
                                           data-worldpay="exp-month" required>

                                </div>
                                <span class="pull-left">&nbsp;/&nbsp;</span>

                                <div class="col-md-2 pull-left">
                                    <input type="text" class="form-control" name="exp-year" size="4" placeholder="YYYY"
                                           data-worldpay="exp-year" required>
                                </div>
                            </div>
                            <div class="dp-box">
                                <div class="col-md-4">&nbsp;</div>
                                <div class="col-md-8">
                                    <div class="col-right">
                                        <div aria-label="Basic example" role="group" class="btn-group">
                                            <button class="btn btn-default make-payment" type="submit">Submit</button>
                                            <a class="btn btn-grey" href="{{URL::previous()}}">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    <style>
        #loading-div-background {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            background: black;
            width: 100%;
            height: 100%;
        }

        #loading-div {
            width: 300px;
            height: 200px;
            text-align: center;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -150px;
            margin-top: -100px;
        }


    </style>
    <div id="loading-div-background">
        <div id="loading-div" class="ui-corner-all">
            <img style="width: 38px;" src="{!! asset('local/public/images/loading.gif') !!}" alt="Loading.."/>

            <h2 style="color:gray;font-weight:normal;margin-top: 25px;">Please wait....</h2>
        </div>
    </div>
    <?php
    $client_key = \Config::get('constants_brandstore.WORLDPAY_CLIENT_KEY');
    ?>
    <script src="https://cdn.worldpay.com/v1/worldpay.js"></script>
    <script type="text/javascript">

        jQuery(document).on("click", '.make-payment', function (e) {
            e.preventDefault();
            $("#loading-div-background").css({opacity: 0.8});
            $("#loading-div-background").show();
            //$("#loading-div-background").hide();

            jQuery('#paymentForm').submit();
        });
        var form = document.getElementById('paymentForm');

        Worldpay.useOwnForm({
            'clientKey': '{{$client_key}}',
            'form': form,
            'reusable': true,
            'callback': function (status, response) {
                document.getElementById('paymentErrors').innerHTML = '';
                if (response.error) {
                    $("#loading-div-background").css({opacity: 0});
                    $("#loading-div-background").hide();
                    Worldpay.handleError(form, document.getElementById('paymentErrors'), response.error);
                } else {
                    var token = response.token;
                    Worldpay.formBuilder(form, 'input', 'hidden', 'token', token);
                    form.submit();
                }
            }
        });
    </script>
@endsection
