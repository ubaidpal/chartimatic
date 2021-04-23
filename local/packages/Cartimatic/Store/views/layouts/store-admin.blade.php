<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>Cartimatic @if(isset($title)) | {{$title}} @endif  </title>

    <!-- Bootstrap core CSS -->

    <link href="{!! asset('local/public/assets/gentelella/css/bootstrap.min.css') !!}" rel="stylesheet">

    <link href="{!! asset('local/public/assets/gentelella/fonts/css/font-awesome.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('local/public/assets/gentelella/css/animate.min.css') !!}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{!! asset('local/public/assets/gentelella/css/custom.css') !!}" rel="stylesheet">
    <link href="{!! asset('local/public/assets/gentelella/css/icheck/flat/green.css') !!}" rel="stylesheet">
    <link href="{!! asset('local/public/assets/css/spectrum.css') !!}" rel="stylesheet">
    @yield('styles')

    <script src="{!! asset('local/public/assets/gentelella/js/jquery.min.js') !!}"></script>
    <script src="{!! asset('local/public/assets/js/spectrum.js') !!}"></script>
    @yield('header-scripts')

    <!--[if lt IE 9]>
    <script src="{!! asset('local/public/assets/gentelella/fonts/css/font-awesome.min.css') !!}"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body class="nav-md">

<div class="container body">


    <div class="main_container">

        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{url('admin/dashboard')}}" class="site_title">
                        @if(!empty($store_db_name))
                            <span>{{ucfirst(str_replace('-',' ',$store_db_name))}}</span>
                        @else
                            <span>Cartimatic</span>
                        @endif
                    </a>
                </div>
                <div class="clearfix"></div>


                <!-- menu prile quick info -->

                <!-- /menu prile quick info -->

                <br/>
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li>
                                <a href="{{url('admin/dashboard')}}">
                                    <i class="fa fa-tachometer"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-section">
                                <a href="{{url('store/'.Auth::user()->username.'/admin/orders')}}">
                                    <i class="fa fa-file-text-o"></i>
                                    Orders
                                    <span class="label label-success pull-right">{{countOrdersCurrentUser()}}</span>
                                </a>

                            </li>

                            <li>
                                <a href="#"><i class="fa fa-list-ul"></i> Configuration
                                </a>
                                <ul class="nav child_menu" style="display: none">
                                    <li>
                                        <a href="{{url("store/".Auth::user()->username."/admin/all-tax-categories/")}}">
                                            Tax Categories
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('store/'.$user->username.'/admin/suppliers')}}"><i class="fa fa-truck"></i>Suppliers</a>
                                    </li>

                                   {{-- <li>
                                        <a href="{{url('store/'.$user->username.'/admin/lineItem')}}"><i class=""></i>Line Items</a>
                                    </li>--}}

                                    <li>
                                        <a href="{{url('store/'.$user->username.'/admin/ageGroup')}}"><i class=""></i>{{Session::get('SYSTEM_CONFIGURATION.PRODUCT_VARIABLE_1')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{url('store/'.$user->username.'/admin/productTemplate')}}"><i class=""></i>Product
                                            Template</a>
                                    </li>

                                    <li>
                                        <a href="{{url('store/'.$user->username.'/admin/unit')}}"><i class=""></i>Unit</a>
                                    </li>

                                    <li>
                                        <a href="{{url('store/'.$user->username.'/admin/productGroup')}}"><i class=""></i>Product Group</a>
                                    </li>
                                    <li>
                                        <a href="{{url('store/'.$user->username.'/admin/calenderSeason')}}"><i class=""></i>Calender Season</a>
                                    </li>
                                    <li>
                                        <a href="{{url('store/'.$user->username.'/admin/lifeType')}}"><i class=""></i>{{Session::get('SYSTEM_CONFIGURATION.PRODUCT_VARIABLE_3')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{url('store/'.$user->username.'/admin/productGender')}}"><i class=""></i>{{Session::get('SYSTEM_CONFIGURATION.PRODUCT_VARIABLE_4')}}</a>
                                    </li>

                                    <li>
                                        <a href="{{url('store/'.$user->username.'/admin/valueAddition')}}"><i class=""></i>{{Session::get('SYSTEM_CONFIGURATION.PRODUCT_VARIABLE_5')}}</a>
                                    </li>
                                </ul>
                            </li>

                            <li>

                                <a href="#"><i class="fa fa-list-ul"></i> Manage Products
                                </a>

                                <ul class="nav child_menu" style="display: none">
                                    <li>
                                        <a href="{{url("store/".Auth::user()->username."/admin/manage-product/")}}">
                                            All products
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('store/'.$user->username.'/admin/add-new-product')}}">
                                            Add Product
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{url('store/'.$user->username.'/admin/brands')}}"><i class=""></i>Brands</a>
                                    </li>

                                   {{-- <li>
                                        <a href="{{url('store/'.$user->username.'/admin/productGroups')}}"><i class=""></i>Product
                                            Groups</a>
                                    </li>--}}

                                </ul>
                            </li>
                            
                            <li>
                                <a href="#"><i class="fa fa-folder-open-o"></i> Inventory Management</a>
                                <ul class="nav child_menu" style="display: none;">
                                    <li>
                                        <a href="{{url('store/'.$user->username.'/admin/purchase-orders')}}">Purchase Order</a>
                                    </li>
                                    <li>
                                        <a href="{{url('admin/store/grn')}}">GRN</a>

                                    </li>
                                </ul>
                            </li>
                            
                            <li>
                                <a><i
                                            class="fa fa-id-card-o"></i> Manage Employees
                                </a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{url('admin/store/employees')}}">All Employees</a></li>
                                    <li><a href="{{url('admin/store/employees/create')}}">Add New</a></li>
                                    <li><a href="{{url('admin/store/employees/roles')}}">All Roles</a></li>
                                    <li><a href="{{url('admin/store/employees/create-role')}}">Add New Role</a></li>
                                </ul>
                            </li>
                            
                            @if(!$is_market_place)

                            @endif
                            <li class="nav-section">

                                <a href="{{url('store/'.Auth::user()->username.'/admin/feedback')}}"><i class="fa fa-commenting-o"></i>
                                    Feedbacks
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/store/'.Auth::user()->username.'/admin/page_analytics')}}"><i
                                            class="fa fa-line-chart"></i> Analytics </a>
                            </li>
                            
                            <li>
                                <a href="{{route('store.statement',Auth::user()->username)}}"><i
                                            class="fa fa-files-o"></i> Statements </a>
                            </li>
                            
                            
                            
                            <li>
                                <a>
                                    <i class="fa fa-file-excel-o"></i> Reports
                                </a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{url('store/admin/report/sales')}}">Sales</a></li>
                                    <li><a href="{{url('store/admin/report/products')}}">Products</a></li>
                                    <li><a href="{{url('store/admin/report/lost')}}">Damaged/Lost</a></li>
                                </ul>
                            </li>
                            
                            <li class="nav-section">
                                <a href="{{route('store.withdrawal',Auth::user()->username)}}"><i class="fa fa-money"></i> Withdrawals </a>

                            <li>
                                <a><i
                                            class="fa fa-calculator"></i> Manage Shops
                                </a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{url('admin/store/shop')}}">All Shops</a></li>
                                    <li><a href="{{url('admin/store/add-shop')}}">Add New</a></li>
                                </ul>

                            </li>
                            <li>
                                <a>
                                    <i class="fa fa-envelope-open-o"></i> Requests
                                </a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{url('admin/store/requests')}}">All Requests</a></li>
                                </ul>
                            </li>
                            
                            <li class="sales-channel">
                                <a href="{{url('store/'.$user->username.'/admin/salesChannel')}}">SALES CHANNEL <i class="fa fa-cog"></i></a>
                            </li>
                            
                            <li>
                                <a><i
                                            class="fa fa-shopping-bag"></i>Marketplace
                                </a>
                            </li>
                             @if(Auth::user()->registered_via == 'marketplace' && empty(Auth::user()->store_enabled))
                                <li>
                                    <a href="{{url('store/'.Auth::user()->username.'/admin/enableStore')}}"><i class="fa fa-laptop"></i>
                                        Online Store</a>
                                </li>
                            @else
                                <li>
                                    <a href="#"><i class="fa fa-laptop"></i> Online Store</a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a target="_blank" href="{{$store_url}}">Website Preview</a></li>
                                        <li><a target="_blank"
                                               href="//{{env('MARKET_PLACE_URL','shahalmionline.pk')}}/store/{{Auth::user()->username}}">Market Place Preview</a></li>
                                        <li>
                                            <a href="{{url('store/'.Auth::user()->username.'/admin/theme')}}">Themes</a>
                                        </li>
                                        <li>
                                            <a href="{{url('store/'.Auth::user()->username.'/admin/pages')}}">Pages</a>
                                        </li>
                                        <li>
                                            <a href="{{url('store/'.Auth::user()->username.'/admin/domains')}}">Domain Manager</a>
                                        </li>
                                        <li>
                                            <a href="{{url('store/'.Auth::user()->username.'/admin/showContactUsData')}}">Contact Us</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            <li>
                                <a><i
                                            class="fa fa-calculator"></i> Manage POS
                                </a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{url('admin/store/pos')}}">All POS</a></li>
                                    <li><a href="{{url('admin/store/add-pos')}}">Add New</a></li>
                                    <li>
                                        <a>
                                            Returns
                                        </a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="{{url('store/admin/returns/all')}}">All</a></li>
                                            <li><a href="{{url('store/admin/returns/normal')}}">Normal Returns</a></li>
                                            <li><a href="{{url('store/admin/returns/seasonal')}}">Seasonal Returns</a></li>
                                            <li><a href="{{url('store/admin/returns/damage')}}">Damaged</a></li>
                                            <li><a href="{{url('store/admin/returns/lost')}}">Lost</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <!--<div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>-->
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:void(0);" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                @if(file_exists(url(Auth::user()->profile_photo_url)))
                                    <img src="{{url(Auth::user()->profile_photo_url)}}"
                                         alt=""
                                         onError="this.onerror=null;this.src='{{getEmployeeDefaultImage()}}';">
                                @else
                                    <img src="">
                                @endif
                                {{Auth::user()->displayname}}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="{{url('store/'.Auth::user()->username)}}"><i class="fa fa-desktop pull-right"></i> Store
                                        Preview</a></li>

                                <li><a href="{{url('store/'.Auth::user()->username.'/admin/edit-page-layout')}}"><i
                                                class="fa fa-tachometer pull-right"></i>Edit Profile</a></li>
                                <!--<li>
                                      <a href="javascript:void(0);">
                                          <span class="badge bg-red pull-right">50%</span>
                                          <span>Settings</span>
                                      </a>
                                  </li>
                                  <li>
                                      <a href="javascript:void(0);">Help</a>
                                  </li>-->
                                <li><a href="{{url('settings/change-password')}}"><i class="fa fa-key pull-right"></i>Change Password</a>
                                </li>
                                <li><a href="{{url('configuration')}}"><i class="fa fa-cog pull-right"></i>Configuration</a>
                                <li><a href="{{url('store/'.$user->username.'/admin/general-settings')}}"><i class="fa fa-cog pull-right"></i>General Settings</a>
                                </li>

                                <li><a href="{{url('store/'.$user->username.'/admin/subscription')}}"><i class="fa fa-money pull-right"></i>Subscription</a> </li>

                                <li><a href="{{url('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>

                        @include('Store::includes.notifications')

                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->


        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Cartimatic - Admin Pannel by <a href="https://blueorcastudios.com">Blue Orca Studios</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<script src="{!! asset('local/public/assets/gentelella/js/bootstrap.min.js') !!}"></script>

<!-- bootstrap progress js -->
<script src="{!! asset('local/public/assets/gentelella/js/progressbar/bootstrap-progressbar.min.js') !!}"></script>
<script src="{!! asset('local/public/assets/gentelella/js/custom.js') !!}"></script>
<!-- icheck -->
<script src="{!! asset('local/public/assets/gentelella/js/icheck/icheck.min.js') !!}"></script>
{!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/bootstrap-tooltip.js') !!}
{!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/confirmation.js') !!}
<script src="{!! asset('local/public/assets/store/general.js') !!}"></script>

@include('Store::modal.master')
@yield('bottom-scripts')
@yield('scripts')

</body>

</html>