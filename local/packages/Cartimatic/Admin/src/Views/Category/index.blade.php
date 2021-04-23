@extends('Admin::layout.store-admin')
@section('content')
        <!-- Post Div-->
@include('Admin::layout.arbitrator-leftnav')
@include('Admin::alert.alert')
<div class="ad_main_wrapper" id="ad_main_wrapper">
    <div class="task_inner_wrapper">
        <div class="main_heading">
            <h1>Add Category Attributes</h1>
        </div>
        <div style="position: absolute; top: 30px; left: 630px;">
            <img id="loading-div" style="display: none; " src="{{asset('local/public/images/loading.gif')}}" />
        </div>
        <div class="assigned-task-wrapper" id="all-categories">

            {!! Form::open(['route'=>'category.save-attribute','id'=>'attributes']) !!}
            <div class="add-form-block">
                <div class="user-title">Select Category * :</div>
                <div class="user-input">{!!  Form::select('categories', $categories , 0, ['class' => 'user-input' , 'id' => 'category' ])!!}</div>

                <div class="user-input" style="margin-left: 20px" id="load-child-box">
                    <button type="button" class="orngBtn mr10" id="load-child">Load Child Category</button>
                </div>
            </div>
            <div class="add-form-block assign-btn">
                <div class="user-title">&nbsp;</div>
                <div class="user-input">
                    <button type="submit" class="orngBtn mr10" id="assign-attribute">Assign Attributes</button>
                    <a type="submit" class="greyBtn" id="btn-proceed" href="{{Request::url() }}">Cancel</a>
                </div>

            </div>
            {!! Form::close() !!}
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
    <style>
        .add-form-block div.user-input select {
            width: 420px;
        }

        .assigned-task-wrapper {
            margin-bottom: 10px;
        }

        .orngBtn:disabled, .greyBtn:disabled {
            opacity: 0.5;
        }

        .added-value {
            font-size: 15px;
            font-weight: normal;
            line-height: normal;
            color: #ee4b08;
            float: left;
            width: 100%;
            margin-bottom: 15px;
        }

        .value-box {
            border: 1px solid #e1e1e1;
            float: left;
            margin-right: 5px;
            padding: 0 11px;
        }

        .value-text {
            float: left;
            margin-right: 8px;
        }

        .remove-value {
            cursor: pointer;
            float: right;
        }

        .add-form-block.add-value-btn {
            border-bottom: 3px solid #e1e1e1;
        }

        .remove-field {
            cursor: pointer;
            margin-left: 14px;
        }

        .default-attribute > input {
            margin-left: 7px;
        }

        .default-attribute {
            float: right;
            margin-right: 23px;
        }
        .add-form-block div.user-input input{
            width: 420px;
            padding: 5px 0 0 5px;
            margin: 0 10px 0 0;
        }
        .add-form-block{
            border-bottom: 1px solid #e1e1e1;
            padding: 4px 15px;
            line-height: 23px;
            min-height: 64px;
            box-sizing: border-box;
        }
    </style>
    {!! HTML::script('local/public/assets/admin/category-attributes.js') !!}
    {!! HTML::script('local/public/assets/plugins/multi-select/jquery.multiselect.js') !!}
    {!! HTML::style('local/public/assets/plugins/multi-select/jquery.multiselect.css') !!}
@endsection
