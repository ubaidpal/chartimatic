@extends('Admin::layout.store-admin')
@section('content')
    <!-- Post Div-->
    @include('Admin::layout.arbitrator-leftnav')
    @include('Admin::alert.alert')
    <div class="ad_main_wrapper" id="ad_main_wrapper">
        <div class="task_inner_wrapper">
            <div class="main_heading">
                <h1>Contact Request</h1>
            </div>
            <div style="text-align: center;">
                <img id="loading-div" style="display: none; " src="{{asset('local/public/images/loading.gif')}}"/>
            </div>
            @include('includes.alerts')
            <div class="row">
                <div class="col-sm-12">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-sort="ascending"
                                aria-label="Name: activate to sort column descending">Sr#
                            </th>
                            <th class="sorting" tabindex="1" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending">Name
                            </th>
                            <th class="sorting" tabindex="2" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Office: activate to sort column ascending">Company
                            </th>
                            <th class="sorting" tabindex="3" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending">Company Name
                            </th>
                            <th class="sorting" tabindex="4" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Start date: activate to sort column ascending">Mobile No
                            </th>
                            <th class="sorting" tabindex="4" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Start date: activate to sort column ascending">Country/Region
                            </th>
                            <th class="sorting" tabindex="4" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Start date: activate to sort column ascending">Detail
                            </th>
                            <th class="sorting" tabindex="5" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Salary: activate to sort column ascending">Status
                            </th>
                            <th class="sorting" tabindex="5" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Salary: activate to sort column ascending">Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($requests as $request)
                            <tr>
                                <td>{{$request->id}}</td>
                                <td>{{$request->first_name.' '.$request->last_name}}</td>
                                <td>{{$request->company}}</td>
                                <td>{{$request->company_title}}</td>
                                <td>{{$request->phone}}</td>
                                <td>{{$request->countryDetail->name}}</td>
                                <td title="{{$request->detail}}">{{\Illuminate\Support\Str::limit($request->detail,20)}}</td>
                                <td>
                                    @if($request->status == 0)
                                        Pending
                                    @elseif($request->status == 1)
                                        Rejected
                                    @else
                                        Resolved
                                    @endif
                                </td>
                                <td>
                                    @if($request->status == 0)
                                        <a href="{{route('contact.create-user',[\Vinkla\Hashids\Facades\Hashids::connection('main')->encode($request->id)])}}" class="orngBtn fltL search-btn" data-toggle="confirmation"
                                           data-singleton="true">Resolve</a>
                                        <a href="{{route('contact.reject',[\Vinkla\Hashids\Facades\Hashids::connection('main')->encode($request->id)])}}"
                                           class="orngBtn fltL search-btn" data-toggle="confirmation" data-singleton="true">Reject</a>
                                    @endif
                                    {{--<a href="" class="orngBtn fltL search-btn">In Process</a>--}}
                                </td>
                            </tr>
                        @endforeach
                        {{--@endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                </div>
                <div class="col-sm-7" style="margin-top: -25px">

                </div>
            </div>
        </div>

    </div>

    <style>
        .user-table div.role {
            width: 120px;
        }
    </style>


@endsection

@section('footer-scripts')
    {!! HTML::script('local/public/assets/js/bootstrap-confirmation.js') !!}
    <style>
        .search-btn {
            margin: 0 5px 6px 0;
            padding: 1px 6px;
        }
    </style>
    <script>
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]'
            // other options
        });
    </script>
@endsection
