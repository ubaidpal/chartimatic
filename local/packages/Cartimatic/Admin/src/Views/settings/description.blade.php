@extends('Admin::layout.store-admin')
@section('content')
    <!-- Post Div-->
    @include('Admin::layout.arbitrator-leftnav')
    @include('Admin::alert.alert')
    <div class="ad_main_wrapper" id="ad_main_wrapper">
        <div class="task_inner_wrapper">
            <div class="main_heading">
                <h1>Description</h1>

            </div>
            <div class="assigned-task-wrapper">
                <div class="user-table heading">
                    <div class="email" style="width: 59%;">Detail</div>

                </div>
                        <div class="user-table">
                            <div class="name" style="width: 18%">{{$request->detail}}</div>

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
