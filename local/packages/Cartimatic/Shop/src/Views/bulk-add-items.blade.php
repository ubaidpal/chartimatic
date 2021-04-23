@extends('Store::layouts.store-admin')
@section('styles')
    {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
    {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
@stop
@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Push Items to Shop
                    <small>
                        (Link Road Branch)
                    </small>
                </h3>
            </div>

            <a href="{{URL::previous()}}" class="btn btn-success pull-right" type="button">Back</a>


        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Select</th>
                                <th>No.</th>
                                <th>Name</th>

                                <th>Available</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th colspan="7">
                                    Rice
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="checkbox" name="middle-name">
                                    </div>
                                </td>
                                <td>1</td>

                                <td>Karnal</td>
                                <td>
                                    105
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="number" value="52" name="middle-name">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="checkbox" name="middle-name">
                                    </div>
                                </td>
                                <td>1</td>

                                <td>Asli Banaspati</td>
                                <td>
                                    105
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="number" value="52" name="middle-name">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="checkbox" name="middle-name">
                                    </div>
                                </td>
                                <td>1</td>

                                <td>Kachi Basmati</td>
                                <td>
                                    105
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="number" value="52" name="middle-name">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th colspan="7">
                                    Daals
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="checkbox" name="middle-name">
                                    </div>
                                </td>
                                <td>1</td>

                                <td>Mash</td>
                                <td>
                                    105
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="number" value="52" name="middle-name">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="checkbox" name="middle-name">
                                    </div>
                                </td>
                                <td>1</td>

                                <td>Masoor</td>
                                <td>
                                    105
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="number" value="52" name="middle-name">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="checkbox" name="middle-name">
                                    </div>
                                </td>
                                <td>1</td>

                                <td>Channa</td>
                                <td>
                                    105
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input id="middle-name" class="form-control col-md-2 col-xs-2" type="number" value="52" name="middle-name">
                                    </div>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-success" type="button">Add</button>

                        <button class="btn btn-primary" type="button">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('scripts')


@stop
