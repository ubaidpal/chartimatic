@extends('Store::layouts.store-admin')

@section('content')

    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Brands</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="{{url('store/'.$store_id.'/admin/addBrand')}}"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="10%">No#</th>
                                    <th>Name</th>
                                    <th width="10%" class="text-center">Contact No:</th>
                                    <th width="7%" class="text-center">Created at</th>
                                    <th width="7%" class="text-center">Updated at</th>
                                    <th width="7%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$suppliers->isEmpty())
                                <?php
                                $count = $suppliers->count();
                                $currentPage = $suppliers->currentPage();
                                $perPage = $suppliers->perPage();
                                $counter = ($perPage * ($currentPage - 1));
                                ?>
                                @foreach($suppliers as $supplier)
                                <tr>
                                    <td width="10%" class="text-center">{{++$counter}}</td>
                                    <td>{{ucfirst($supplier->name)}}</td>
                                    <td>{{$supplier->contact_no}}</td>
                                    <td width="7%" class="text-center">{{dateFormat($supplier->created_at)}}</td>
                                    <td width="7%" class="text-center">{{dateFormat($supplier->updated_at)}}</td>
                                    <td class="text-center">
                                        <a href="{{url('store/'.$store_id.'/admin/addBrand/'.$supplier->id)}}"><i class="fa fa-pencil-square-o"></i></a>&nbsp;|&nbsp;
                                        <a href="{{url('store/'.$store_id.'/admin/deleteBrand/'.$supplier->id)}}" class="text-danger delete-supplier"><i class="fa fa-times-circle-o"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center" colspan="4">No record found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="pagination">
                            {{$suppliers->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('bottom-scripts')
    <script type="text/javascript">
        jQuery(document).on('click','.delete-supplier',function (e) {
            e.preventDefault();
            if(confirm('Are you sure?'))
            {
                window.location = $(this).attr('href');
            }
        });
    </script>
@endsection