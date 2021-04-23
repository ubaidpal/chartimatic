@extends('layouts.default')

@section('content')
  <div class="col-md-12">
    <div class="row">
      <div class="pro-header">
        <div class="col-md-9">
          <div class="row">
            @include('includes.breadcrumbs', array('category'=> $productDetail->category_id))
          </div>
        </div>
        <div class="col-md-3">
          <div class="row">
            <form class="navbar-form p0 m0" role="search">
              <div class="input-group add-on">
                <input type="text" class="form-control" placeholder="Search in laptops" name="srch-term" id="srch-term">

                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <p>This product was deleted / removed by owner. Please contact with admin for further query.</p>
    </div>
  </div>
@endsection
