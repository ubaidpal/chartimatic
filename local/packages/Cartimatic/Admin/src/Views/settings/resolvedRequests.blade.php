@extends('Admin::layout.store-admin')
@section('content')
    <!-- Post Div-->
    @include('Admin::layout.arbitrator-leftnav')
    @include('Admin::alert.alert')

    <div class="ad_main_wrapper" id="ad_main_wrapper">
        <div class="task_inner_wrapper">
                        <div class="task-tabs">
                            <a href="{{url('admin/requests')}}"
                               class="@if($type == 'pending') active @endif">Pending</a>
                            <a href="{{url('admin/requests/resolved-status')}}"
                               class="@if($type == 'resolved') active @endif">Resolved</a>
                        </div>



            {!! Form::open(['route'=> 'admin.assign-permission']) !!}

            <div class="assigned-task-wrapper">
                <div class="user-table heading">
                    <div class="name" style="width: 18%">Store Name</div>
                    <div class="email" style="width: 59%;">Detail</div>

                    <div class="action" style=" width: 21%">Actions</div>
                </div>

                @if(count($requests) > 0)
                    @foreach($requests as $request)
                        <div class="user-table">
                            <div class="name" style="width: 18%">{{$request->user->displayname}}</div>
                            <div class="email" style="width: 59%;">{{\Illuminate\Support\Str::limit($request->detail,250)}}</div>
                            <div class="action" style=" width:21%">
                                <a title="Edit permissions" href="{{url('admin/requests/view-description/'.$request->id)}}" class="editUser" id="{{$request->id}}">View</a>|
                                <?php if($request->status == 1){ ?>
                                 <span title="Edit permissions" class="editUser">
                                    Resolved
                                </span>
                                <?php } ?>

                            </div>

                        </div>
                    @endforeach
                @else
                    No record found
                @endif
            </div>
            {!! Form::close() !!}
        </div>
        {!!  $requests->render() !!}
    </div>

    <style>
        .user-table div.role {
            width: 120px;
        }
    </style>
<script>
    $(document).on("click", ".resolved", function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var get_id = e.target.id;
        jQuery.ajax({
            type: "Post",
            url: '{{url("admin/requests/status-changed")}}',
            data: {id: get_id ,'_token': $('input[name=_token]').val()},
            success: function (data) {
                if (data == 1) {
                    window.location.reload();
                }
            }, error: function (xhr, ajaxOptions, thrownError) {
                alert("ERROR:" + xhr.responseText + " - " + thrownError);
            }
        });
    });
</script>
@endsection
