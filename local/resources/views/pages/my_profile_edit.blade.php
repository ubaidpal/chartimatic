@extends('layouts.default')

@section('content')
  <div class="col-md-12">
    <div class="row">
      <div class="pro-header">
        <h1>My Profile</h1>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-3">
        <div class="row">
          <div class="cart-left-nav">
            <nav>
              <ul class="nav">
				<li><a class="active" href="{{url('my-orders')}}">My Profile</a></li>
                <li><a href="{{url('my-orders')}}">All Orders</a></li>
                <li><a href="{{url('shipping-addresses')}}">Shipping Address</a></li>
                <li><a href="{{url('my-feedback')}}">Manage Feedbacks</a></li>
                <li><a href="{{url('wishlist')}}">Wishlist</a></li>
                <!--<li><a href="#" class="active">Invoices</a></li>-->
              </ul>
            </nav>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="row">
			<div class="c-profile-edit">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="profile-edit-img">
                            <div class="profile-edit-img-wrapper">
                                <img alt="promotion banner" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-big.jpg') !!}">
                                <div class="edit-btn">edit</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="profile-edit-form">
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>First Name</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div><!-- /.form-group-item - Name -->
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div><!-- /.form-group-item - Email -->
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Gender</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsMale">
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsFemale">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.form-group-item - Gender -->
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Address</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div><!-- /.form-group-item - Address -->
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Zip / Postal Code</label>
                                    </div>
                                    <div class="col-sm-2 zip">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div><!-- /.form-group-item - Zip/Postal Code -->
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Country</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div><!-- /.form-group-item - Country -->
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>City</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div><!-- /.form-group-item - City -->
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-sm-4 pl0">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div><!-- /.form-group-item - Phone -->
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Mobile</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-sm-4 pl0">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div><!-- /.form-group-item - Mobile -->
                            <div class="form-group-btn">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="pull-right">
                                            <a href="javascript:void(0);" class="active btn btn-profile-edit">Submit</a>
                                            <a href="javascript:void(0);" class="btn btn-profile-edit">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.form-group-btn -->
                        </div><!-- /.profile-edit-form -->
                    </div>
                </div>
            </div><!-- /.c-profile-edit -->
        </div>
      </div>
    </div>
  </div>
@endsection





























