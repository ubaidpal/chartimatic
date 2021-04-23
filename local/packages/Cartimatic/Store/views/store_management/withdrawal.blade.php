{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 06-May-16 6:44 PM
    * File Name    :

--}}
@extends('Store::layouts.store-admin')
@section('styles')
{!! HTML::style('local/public/assets/gentelella/css/icheck/flat/green.css') !!}

@endsection
@section('content')
        <!-- page content -->


<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Withdrawal
                {{--<small>
                    All Orders
                </small>--}}
            </h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="text">
                    <h2 class="">Your Balance:&nbsp; {{format_currency($available_balance)}}</h2>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">

                    @if(!empty($bank->id))
                        @if($pending_withdrawals->isEmpty())
                        <a href="" class="btn btn-primary" id="make_withdrawal" type="button">Make Withdrawal</a>
                        @endif
                        <a href="{{route('store.bankAccount', $user->username)}}" class="btn btn-warning" type="button">Change
                            Bank Account</a>
                    @else
                        <a href="{{route('store.bankAccount', $user->username)}}" class="btn btn-primary" type="button">Add
                            bank account</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Withdrawal
                    </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <section class="content invoice">


                        <!-- Table row -->
                        <div class="row">
                            @if(Session::has('message'))
                                <span class="error" style="color:#f00000">{{ Session::get('message') }}</span>
                            @endif
                            @if($pending_withdrawals->isEmpty())
                                <p>You currently have no withdrawals pending or queued for processing.</p>
                            @endif
                            @if(!$pending_withdrawals->isEmpty())
                                <div class="col-lg-12 col-sm-12">
                                    <h4>Pending Withdrawals</h4>
                                </div>
                                <div class="col-xs-12 table">
                                    <table class="table table-striped">
                                        <tbody>
                                        @foreach($pending_withdrawals as $pending)
                                            <tr>
                                                <td>{{ucfirst($pending->status)}}</td>
                                                <td>
                                                    {{format_currency($pending->amount - ($pending->amount * $pending->fee_percentage)/100)}}
                                                    <strong>to {{$pending->method}} Account</strong>

                                                    <div class="clearfix"></div>
                                                    Requested Date: &nbsp; {{$pending->created_at}}


                                                </td>
                                                <td>
                                                    @if($pending->status == 'pending')
                                       <a href="#" class="btn btn-danger cancel_Status" data-toggle="modal" data-target="#cancelTran" id="{{$pending->id}}">Cancel</a>
                                                    @endif

                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>

                                    </table>
                                </div>
                            @endif
                            <div class="col-lg-12 col-sm-12">
                                <div class="text">Your withdrawals will be processed within <strong>(7 - 14 business
                                        days)</strong></div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                    </section>
                </div>
            </div>
        </div>
    </div>
    <?php $fee_amount = (($available_balance - $pending_amount) * $fee_percentage) / 100; ?>
    <div class="row" style="display: none;" id="request_container">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Make Withdrawal Request
                    </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <section class="content invoice">


                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table">
                                <form method="post" action="{{url('store/sendWithdrawalRequest')}}" id="requestForm"
                                      enctype="multipart/form-data">
                                    <table class="table table-striped">
                                        <tbody>

                                        <tr>
                                            <td>Payment Type:</td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="payment_type"
                                                                       id="optionsRadios1" value="full" checked=""
                                                                       class="flat">
                                                                Available Balance
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="pull-left">
                                                                <input type="radio" name="payment_type"
                                                                       id="optionsRadios2" value="partial"> Other Amount
                                                                - $
                                                            </label>

                                                            <div class="col-sm-2 pull-left">
                                                                <input placeholder="Amount" type="text" name="amount"
                                                                       class="form-control full_refund" id="ex3"
                                                                       disabled>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    @if(count($errors) > 0)
                                                        @foreach ($errors->all() as $error)
                                                            <span class="error">{{ $error }}</span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Cartimatic Fee:
                                            </td>
                                            <td id="">

                                                <strong id="fee_amount">{{format_currency($fee_amount)}}</strong>
                                                ({{$fee_percentage}}% of the total
                                                withdrawal amount)
                                            </td>

                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>You are about to send
                                                <b id="myAmount">{{format_currency(($available_balance - $pending_amount)- $fee_amount)}}</b>
                                                to you your bank account
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <button type="submit" id="submit_request" class="btn btn-success">Submit
                                                    Request
                                                </button>
                                                <button type="button" id="canecl_request" class="btn btn-warning">
                                                    Cancel
                                                </button>
                                            </td>
                                        </tr>


                                        </tbody>

                                    </table>
                                </form>
                            </div>
                            <!-- /.col -->
                        </div>

                        <!-- /.row -->

                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: none;" id="balanced_out">
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Oops!</strong> You have not sufficient amount to proceed with withdrawal or there are pending withdrawals.
        </div>
    </div>
</div>
<div id="cancelTran" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cancel Transaction</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel this transaction.</p>
            </div>
            <div class="modal-footer">
                <input class="canTran" type="hidden" name="canTran" value="">
                <a href="#" style="margin-bottom: 0;" class="btn btn-danger cancelT" data-dismiss="modal">Yes</a>
                <a href="#" class="btn btn-default" data-dismiss="modal">No</a>
            </div>
        </div>

    </div>
</div>
<!-- /page content -->
@endsection
@section('scripts')

    {!! HTML::script('local/public/assets/store/general.js') !!}
    <script src="{{url('local/public/assets/js/jquery.validate.min.js')}}"></script>

    <script type="text/javascript">

        $(document).on("click", ".cancel_Status", function (e) {

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            var canTran = e.target.id;
            $(".canTran").val(canTran);
            return false;
        });
        $('.cancelT').click(function (e) {
            e.preventDefault();
            var withdrawal_id =  $('.canTran').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            jQuery.ajax({
                type: "Post",
                url: '{{url('store/cancelWithdrawalRequest')}}',
                data: {withdrawal_id: withdrawal_id},
                success: function (data) {
                    if (data > 0) {
                        $("#cancelTran").hide();
                        var url = '{{url('store/withdrawals')}}';
                        document.location.reload(true);
                        window.location = url;
                    } else {
                        return false;
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });

        jQuery(document).on('click', '.cancel_request', function (e) {
            e.preventDefault();
            var appendthis = ("<div class='modal-overlay js-modal-close'></div>");

            $("body").append(appendthis);
            $(".modal-overlay").fadeTo(500, 0.7);

            $('#cancel_request').fadeIn($(this).data());

            var url = jQuery(this).attr('href');
            jQuery('#confirm').attr('href', url);
        });

        jQuery(document).on('click', '#submit_request', function (e) {
            e.preventDefault();
            jQuery('#requestForm').submit();
        });
        jQuery(document).on('click', '#make_withdrawal', function (e) {
            e.preventDefault();
            var balance = {{$available_balance - $pending_amount}};
            if (balance > 10) {
                jQuery('#request_container').show(0, function (e) {
                    $('html, body').animate({
                        scrollTop: $("#request_container").offset().top
                    }, 2000);
                });
            } else {
                jQuery('#balanced_out').show(0, function (e) {
                    $('html, body').animate({
                        scrollTop: $("#balanced_out").offset().top
                    }, 2000);
                });
            }
        });
        jQuery(document).on('click', '#canecl_request', function (e) {
            e.preventDefault();
            jQuery('#request_container').hide('slow');
        });
        jQuery(document).on('click', 'input[name="payment_type"]', function (e) {
            if (jQuery(this).val() == 'partial') {
                jQuery('input[name="amount"]').prop('disabled', false);
            } else {
                jQuery('input[name="amount"]').prop('disabled', true).val("").removeClass('error');
                jQuery('#fee_amount').text('${{$fee_amount}}');
                jQuery('#amount-error').css('display', 'none');
            }
        });

        jQuery('input[name="amount"]').keyup('keyup', function (e) {
            var amount = jQuery(this).val();
            var available = {{$available_balance-$pending_amount}};
            var percentage = {{$fee_percentage}};
            if (amount > 0 && amount <= available) {
                fee = (amount * percentage) / 100;
                fee = Math.round(fee * 100) / 100;
                jQuery('#fee_amount').text('$' + fee);
                myAmount = Math.round((amount - fee) * 100) / 100;
                jQuery("#myAmount").text('$' + myAmount);
            } else {
                jQuery('#fee_amount').text('$0.00');
            }
        });

        jQuery(document).ready(function (e) {
            jQuery('#requestForm').validate({
                errorElement: 'span',
                rules: {
                    "payment_type": {required: true},
                    "amount": {
                        required: function (e) {
                            if (jQuery('input[name="payment_type"]').val() == 'partial') {
                                return false;
                            } else {
                                return true;
                            }
                        }, max:{{$available_balance - $pending_amount}}, min: 10, number: true
                    }
                }
            });
        });
    </script>
@endsection
