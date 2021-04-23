@extends('layouts.default')

@section('styles')

    {!! HTML::style('local/public/assets/plugins/jquery-cropper/css/cropper.min.css') !!}
    {!! HTML::style('local/public/assets/plugins/jquery-cropper/css/main.css') !!}
@endsection

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
      @include('includes.buyer_profile_navigation')
      <div class="col-md-9">
        <div class="row">
        <form action="{{url('save-user-profile-info')}}" method="post" id="edit_user_detail_form" name="edit_user_detail_form">
        <div class="c-profile-edit">
            <div class="row">
                <div class="col-sm-3">
                    <div class="profile-edit-img crop-avatar" data-aspect-ratio="353/403" data-height="806"
                         data-width="706" data-image-src-id="thumb_{{$user->id}}" data-item-id="1"
                         data-update-id="-1">
                        <div class="profile-edit-img-wrapper avatar-view" title="Change the avatar">
                            <img id="thumb_{{$user->id}}"
                                 src="{{$user->profile_photo_url}}"
                                 alt="photo" class="img-responsive" onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';">
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
                                    <input type="text" class="form-control edit_buyer_detail" value="{{$user->first_name}}" name="first_name" id="first_name" style="display: none;">
                                    <div class="buyer-detail">{{$user->first_name}}</div>
                                </div>
                            </div>
                        </div><!-- /.form-group-item - Name -->
                        <div class="form-group-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Last Name</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control edit_buyer_detail" value="{{$user->last_name}}" name="last_name" id="last_name" style="display: none;">
                                    <div class="buyer-detail">{{$user->last_name}}</div>
                                </div>
                            </div>
                        </div><!-- /.form-group-item - Name -->
                        <!-- <div class="form-group-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Email</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control edit_buyer_detail" value="{{$user->email}}" name="email" id="email" style="display: none;">
                                    <div class="buyer-detail">{{$user->email}}</div>
                                </div>
                            </div>
                        </div> /.form-group-item - Email -->
                        <div class="form-group-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Gender</label>
                                </div>
                                <div class="col-sm-6">
                                    <div id="edit_buyer_detail" class="edit_buyer_detail" style="display: none;">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" id="gender" @if($user->gender == 1) checked="checked" @endif value="1">
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" id="gender" @if($user->gender == 2) checked="checked" @endif value="2">
                                                Female
                                            </label>
                                        </div>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" id="gender" @if($user->gender == 3) checked="checked" @endif value="3">
                                                Other
                                            </label>
                                        </div>
                                    </div>
                                    <div class="buyer-detail">
                                        @if($user->gender == 3) Other @endif
                                        @if($user->gender == 1) Male @endif
                                        @if($user->gender == 2) Female @endif
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
                                    <input type="text" class="form-control edit_buyer_detail" name="contact_info" value="{{$user->contact_info}}" id="contact_info" style="display: none;">

                                    <div class="buyer-detail">{{$user->contact_info}}</div>
                                </div>
                            </div>
                        </div><!-- /.form-group-item - Address -->
                        <div class="form-group-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Zip / Postal Code</label>
                                </div>
                                <div class="col-sm-2 zip">
                                    <input type="text" class="form-control edit_buyer_detail" value="{{$user->postal_zip_code}}" name="postal_zip_code" id="postal_zip_code" style="display: none;">
                                    <div class="buyer-detail">{{$user->postal_zip_code}}</div>
                                </div>
                            </div>
                        </div><!-- /.form-group-item - Zip/Postal Code -->
                        <div class="form-group-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Country</label>
                                </div>
                                <div class="col-sm-6">
                                    {!!  Form::select('country',
                                        $countries, $user->country, ['id' => 'country', 'class' => 'form-control edit_buyer_detail', 'style' => 'display:none;' ])
                                    !!}
                                    @if($errors->first('country'))
                                        <span>{{ $errors->first('country') }}</span>
                                    @endif
                                    <div class="buyer-detail">{{getCountryName( $user->country )}}</div>
                                </div>
                            </div>
                        </div><!-- /.form-group-item - Country -->
                        <div class="form-group-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>City/State/County</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control edit_buyer_detail" name="city_state_county" id="city_state_county" style="display: none;" value="{{$user->city_state_county}}">
                                    <div class="buyer-detail">{{$user->city_state_county}}</div>
                                </div>
                            </div>
                        </div><!-- /.form-group-item - City -->
                        <div class="form-group-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Phone</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control edit_buyer_detail" name="phone" value="{{$user->phone}}" id="phone" style="display: none;">

                                    <div class="buyer-detail">{{$user->phone}}</div>
                                </div>
                            </div>
                        </div><!-- /.form-group-item - Phone -->
                        <div class="form-group-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Mobile</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control edit_buyer_detail" name="mobile" value="{{$user->mobile}}" id="mobile" style="display: none;">
                                    <div class="buyer-detail">{{$user->mobile}}</div>
                                </div>
                            </div>
                        </div><!-- /.form-group-item - Mobile -->
                        <div class="form-group-btn">
                            <div class="row">
                                <div class="col-sm-3">
                                    <a href="javascript:void(0);" class="active btn btn-profile-edit">Edit Detail</a>
                                    <a href="javascript:void(0);" class="btn btn-default btn-profile-save" style="display: none">Save Detail</a>
                                </div>
                            </div>
                        </div><!-- /.form-group-btn -->
                    </div><!-- /.profile-edit-form -->
                </div>
            </div>
        </div><!-- /.c-profile-edit -->
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('footer-scripts')
    @include('Admin::modals.cropper', ['url'=> url('update_user_profile_picture')])

    {!! HTML::script('local/public/assets/plugins/jquery-cropper/js/cropper.min.js') !!}
    {!! HTML::script('local/public/assets/plugins/jquery-cropper/js/main.js') !!}

<script>
    $(".btn-profile-edit").click(function(e){
        $(".btn-profile-save").show();
        $(".btn-profile-edit").hide();

        $(".edit_buyer_detail").show();
        $(".buyer-detail").hide();

    });

    $(".btn-profile-save").click(function(e){
        $("#edit_user_detail_form").submit();
    });
</script>
@endsection
