
@extends('Store::layouts.store-admin')
@section('styles')
  {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
  {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
@stop
@section('content')
@include('Admin::alert.alert')
<div class="ad_main_wrapper" id="ad_main_wrapper">
  <div class="task_inner_wrapper">
    <div class="main_heading">
      <h1>All Tax Categories</h1>
      <div class="pull-right">
        <a class="btn btn-primary" href="{{url("store/".Auth::user()->username."/admin/get-add-tax-categories")}}" title="Add New Tax Category">Add New Tax Category</a>
      </div>
    </div>
    <div style="text-align: center;">
      <img id="loading-div" style="display: none; " src="{{asset('local/public/images/loading.gif')}}"/>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
          <tr role="row">
            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending"
                aria-label="Name: activate to sort column descending" style="width: 137px;">Sr#
            </th>
            <th class="sorting" tabindex="1" aria-controls="example" rowspan="1" colspan="1"
                aria-label="Position: activate to sort column ascending" style="width: 219px;">Name
            </th>
            <th class="sorting" tabindex="2" aria-controls="example" rowspan="1" colspan="1"
                aria-label="Office: activate to sort column ascending" style="width: 100px;">Tax Code
            </th>
            <th class="sorting" tabindex="3" aria-controls="example" rowspan="1" colspan="1"
                aria-label="Age: activate to sort column ascending" style="width: 43px;">Value
            </th>
            <th class="sorting" tabindex="4" aria-controls="example" rowspan="1" colspan="1"
                aria-label="Start date: activate to sort column ascending" style="width: 91px;">Is Percent
            </th>
            <th class="sorting" tabindex="5" aria-controls="example" rowspan="1" colspan="1"
                aria-label="Salary: activate to sort column ascending" style="width: 76px;">Actions
            </th>
          </tr>
          </thead>
          <tbody>
          @foreach($tax_categories as $k => $tax_category)
          <tr>
            <td><?php echo $k+1; ?></td>
            <td>{{$tax_category->name}}</td>
            <td>{{$tax_category->tax_code}}</td>
            <td>{{$tax_category->value}}</td>
            <td>@if($tax_category->is_percent == 0) In Percent @else In Value @endif</td>
            <td><a href="{{url("store/".Auth::user()->username."/admin/edit-tax-categories/".$tax_category->id."")}}">Edit</a>&nbsp;|&nbsp;<a style="cursor: pointer" data-href="{{url("store/".Auth::user()->username."/admin/delete-tax-categories/".$tax_category->id."")}}" data-toggle="confirmation">Delete</a></td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <?php
    $to = ($tax_categories->currentPage() * $tax_categories->perPage());
    if ($to > $tax_categories->total()) {
    $to = $tax_categories->total();
    }
    if ($tax_categories->currentPage() > 1) {
    $from = ($tax_categories->currentPage() * $tax_categories->perPage()) - $tax_categories->perPage();
    } else {
    $from = 1;
    }
    ?>
    <div class="row">
      <div class="col-sm-5">
        <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing {{$from}} to {{$to}} of {{$tax_categories->total()}} categories
        </div>
      </div>
      <div class="col-sm-7" style="margin-top: -25px">
        {{$tax_categories->links()}}
      </div>
    </div>
  </div>

</div>

<style>
  .user-table div.role {
    width: 120px;
  }
</style>


@stop
@section('scripts')
  {!! HTML::script('local/public/assets/gentelella/js/datatables/jquery.dataTables.min.js') !!}
  {!! HTML::script('local/public/assets/gentelella/js/datatables/dataTables.bootstrap.js') !!}
  {!! HTML::script('local/public/assets/gentelella/js/datatables/dataTables.buttons.min.js') !!}
  {!! HTML::script('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.js') !!}
  {!! HTML::script('local/public/assets/gentelella/js/datatables/jszip.min.js') !!}
  {!! HTML::script('local/public/assets/gentelella/js/datatables/pdfmake.min.js') !!}
  {!! HTML::script('local/public/assets/gentelella/js/datatables/vfs_fonts.js') !!}
  {!! HTML::script('local/public/assets/gentelella/js/datatables/buttons.html5.min.js') !!}
  {!! HTML::script('local/public/assets/gentelella/js/datatables/buttons.print.min.js') !!}
  {!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/bootstrap-tooltip.js') !!}
  {!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/confirmation.js') !!}
  {!! HTML::script('local/public/assets/gentelella/js/pace/pace.min.js') !!}
  {!! HTML::script('local/public/assets/js/jquery.validate.min.js') !!}
  <script>
    var handleDataTableButtons = function () {
              "use strict";
              0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
                responsive: !0
              })
            },
            TableManageButtons = function () {
              "use strict";
              return {
                init: function () {
                  handleDataTableButtons()
                }
              }
            }();


    $('.close').click(function(e){
      $('.alert').hide('slow');
      $('.alert-error').hide('slow');
    });


  </script>
  <script type="text/javascript">
    TableManageButtons.init();
  </script>

@stop
