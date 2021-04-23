@extends('Store::layouts.static')
@section('content')
    <div class="sale-channel-container">
        <div class="page-heading">Bank Transfer</div>

        <div class="row">
            <div class="col-md-3">
                <div class="sc_left">
                    <div class="sub-heading">Payment</div>
                    <p>Transfer your desired amount to the Cartimatic bank account</p>
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-md-8 col-md-offset-1">
                <div class="sc-right-content">
                    <div class="bank-transfer-block">

                        <div class="head">
                            <div class="invoice-no">Invoice # 1234154</div>
                            <div class="amount-container">
                                <div class="total-txt">
                                    <div>Total</div>
                                    <div class="smal">(PKR)</div>
                                </div>
                                <div class="amount">Rs. 3000</div>
                            </div>
                        </div>

                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bank Account Number</label>
                                <input type="text" class="form-control" placeholder="001124145452145651154">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Account Title</label>
                                        <input type="text" class="form-control" placeholder="Cartimatic">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Bank Name</label>
                                        <input type="text" class="form-control" placeholder="Mezan Bank">
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
