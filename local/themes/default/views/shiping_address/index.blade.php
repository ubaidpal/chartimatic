@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="pro-header">
                    <h1>Manage Shipping Address</h1>
                </div>
            </div>
        </div>
        <style>
        .shipping-form {
            height: 500px;
            overflow-y: scroll;
        }
    </style>
        <div class="col-md-12">
            <div class="row">
                @include('includes.buyer_profile_navigation')
                <div class="col-md-9">
                    <div class="row">
                        <div class="order-title-box">
                            <div class="col-md-12">Shipping Address</div>
                        </div>

                        <div class="shipping-wrapper">
                            @foreach($previousAddresses as $address)
                            <div class="shipping-list delete_address_{{$address->id}}">
                                <div class="col-md-10">
                                    <div class="shiping-address">
                                        <div class="buyer-name">{{ucwords($address->first_name).' '.ucwords($address->last_name)}}</div>
                                        <address>
                                            <strong> {{$address->st_address_1}}</strong><br>
                                            {{$address->st_address_2}}
                                            <abbr title="Phone">P:</abbr> {{$address->phone_number}}
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="shiping-address pull-right">
                                        <div class="btn-group m0" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-edit mr10" data-toggle="modal" data-target="#editAddress_{{$address->id}}">Edit</button>
                                            <button data-toggle="modal" data-target="#deleteAddress" class="btn btn-delete delete" id="{{$address->id}}">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <div id="editAddress_{{$address->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Update Address</h4>
                                            </div>
                                            <div class="modal-body shipping-form">
                                                {!! Form::open(['url' => url("store/add/shipping/address/no-brand"), 'class' => 'form-block form-horizontal', 'role' => 'form', 'id' => 'new_shipping_detail', "enctype"=>"multipart/form-data"]) !!}
                                                <input class="editAddress" type="hidden" name="address_id" value="{{$address->id}}">
                                                <input class="fromManagePage" type="hidden" name="fromManagePage" value="1">

                                                <div class="form-box">
                                                    <label for="full_name">First Name <span>(Required)</span></label>
                                                    <input type="text" class="form-control" value="{{ucwords($address->first_name)}}" name="first_name" id="first_name" placeholder="Enter First Name">
                                                    @if($errors->has('first_name'))
                                                        <span id="cat-error" style="color: red;">{{ $errors->first('first_name') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-box">
                                                    <label for="full_name">Last Name <span>(Required)</span></label>
                                                    <input type="text" class="form-control" value="{{ucwords($address->last_name)}}" name="last_name" id="last_name" placeholder="Enter Last Name">
                                                    @if($errors->has('last_name'))
                                                        <span id="cat-error" style="color: red;">{{ $errors->first('last_name') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-box">
                                                    <label for="country_id">Country <span>(Required)</span></label>
                                                    <?php if(isset($addressData['country_id'])){$countryToBeDeliverd = $addressData['country_id'];}else{$countryToBeDeliverd = Auth::user()->country;}?>
                                                    {!!  Form::select('countries', $countries, $countryToBeDeliverd, ['class' => 'form-control' , 'id' => 'countryToBeShipped' ,'required' => 'required'])!!}
                                                    @if($errors->has('countries'))
                                                        <span id="cat-error" style="color: red;">{{ $errors->first('countries') }}</span>
                                                    @endif
                                                </div>


                                                <div class="form-box">
                                                    <label for="address_1">Address line 1</label>
                                                    <input type="text" class="form-control" id="address_1" value="{{$address->st_address_1}}" name="st_address_1" placeholder="Enter Address line 1">
                                                    @if($errors->has('st_address_1'))
                                                        <span id="cat-error" style="color: red;">{{ $errors->first('st_address_1') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-box">
                                                    <label for="address_2">Address line 2</label>
                                                    <input type="text" class="form-control" id="address_2" value="{{$address->st_address_2}}" name="st_address_2" placeholder="Enter Address line 2">
                                                    @if($errors->has('st_address_2'))
                                                        <span id="cat-error" style="color: red;">{{ $errors->first('st_address_2') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-box">
                                                    <label for="city">City</label>
                                                    <input type="text" class="form-control" id="city" value="{{$address->city}}" name="city" placeholder="Enter City">
                                                    @if($errors->has('city'))
                                                        <span id="cat-error" style="color: red;">{{ $errors->first('city') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-box">
                                                    <label for="state">State</label>
                                                    <input type="text" class="form-control" id="state" value="{{$address->state}}" name="state" placeholder="Enter Name">
                                                    @if($errors->has('state'))
                                                        <span id="cat-error" style="color: red;">{{ $errors->first('state') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-box">
                                                    <label for="postal_code">Postal code</label>
                                                    <input type="text" class="form-control" id="postal_code" value="{{$address->zip_code}}" name="zip_code" placeholder="Enter Postal Code">
                                                    @if($errors->has('zip_code'))
                                                        <span id="cat-error" style="color: red;">{{ $errors->first('zip_code') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-box">
                                                    <label for="phone_number">Phone number</label>
                                                    <input type="text" class="form-control" id="phone_number" value="{{$address->phone_number}}" name="phone_number" placeholder="Enter Phone Number">
                                                    @if($errors->has('phone_number'))
                                                        <span id="cat-error" style="color: red;">{{ $errors->first('phone_number') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-box">
                                                    <label for="email_address">Email address</label>
                                                    <input class="form-control" type="text" value="{{ $address->email}}" id="email" name="email_address"
                                                           placeholder="Email address">
                                                    @if($errors->has('email_address'))
                                                        <span id="cat-error" style="color: red;">{{ $errors->first('email_address') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-box">
                                                    <label for="re_enter_email">Re-enter your email address</label>
                                                    <input class="form-control" type="text" id="re_enter_email"  name="re_enter_email" value="{{ $address->email}}"
                                                           placeholder="Re-enter your email address">
                                                    @if($errors->has('re_enter_email'))
                                                        <span id="cat-error" style="color: red;">{{ $errors->first('re_enter_email') }}</span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" onclick="$('#editAddress_<?php echo $address->id?>').submit();" class="btn btn-success updateAddressBtn">Update</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="deleteAddress" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Record</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this product in your wishList.</p>
                    </div>
                    <div class="modal-footer">
                        <input class="delAddress" type="hidden" name="delParent" value="">
                        <button type="button" class="btn btn-danger deleteAddressBtn" data-dismiss="modal">Delete</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    @include('includes.searchQueryScript.searchScript')
    <script>
        $(document).on("click", ".delete", function (e) {

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            var delAddress = e.target.id;
            $(".delAddress").val(delAddress);
            return false;
        });

        $('.deleteAddressBtn').click(function (e) {
            e.preventDefault();
            var delAddress = $('.delAddress').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            jQuery.ajax({
                type: "Post",
                url: '{{url('store/sofDeleteAddressInfo/')}}',
                data: {address_id: delAddress},
                success: function (data) {
                    if (data > 0) {
                        $("#deleteAddress").hide();
                        $(".delete_address_" + delAddress).remove();
                    } else {
                        return false;
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });
</script>
@endsection
