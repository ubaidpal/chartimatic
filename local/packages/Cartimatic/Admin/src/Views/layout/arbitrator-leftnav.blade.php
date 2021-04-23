<!-- Right Ad Panel -->
<div class="create_ad_panel">
    <div class="menu-btn">

        @role('super.admin')
        <a href="{{route('admin.home')}}" class="dashboard @if(\Request::is('admin')) active @endif">
            Dashboard
        </a>
        @endrole

        @permission('create.users')
        <a href="{{route('admin.users')}}" class="userM @if(\Request::is('admin/users')) active @endif">
            User Management
        </a>
        @endpermission

        @permission('arbitrator')
            <a href="{{route('super-admin.claims-unassigned')}}"
               class="claim @if(\Request::is('admin/super-admin/claims-unassigned')) active @endif">
                Claims
            </a>
        @endpermission

        @permission('resolved.disputes')
            <a href="{{route('super-admin.claims-resolved')}}"
               class="claim @if(\Request::is('admin/super-admin/claims-resolved')) active @endif">
                Resolved Claims
            </a>
        @endpermission

        @permission('accounts')
            <a href="{{url('admin/withdrawalRequests')}}"
               class="withdrawals @if(\Request::is('admin/withdrawalRequests')) active @endif">
                Withdrawals
            </a>
            <a href="{{url('admin/transactions')}}" class="transaction @if(\Request::is('admin/transactions')) active @endif">
                Transactions
            </a>
        @endpermission

        @role('super.admin')
        <a href="{{route('admin.categories')}}" class="dashboard @if(\Request::is('admin/categories')) active @endif">
            Categories
        </a>
        @endrole

        @role('super.admin')
       {{-- <a href="{{route('admin.subCategory')}}" class="dashboard @if(\Request::is('admin/subCategory')) active @endif">
            Sub Categories
        </a>--}}
        <a href="{{route('category.add-attributes')}}" class="dashboard @if(\Request::is('admin/category/*')) active @endif">
            Add Category Attributes
        </a>
        @endrole

        {{--@role('super.admin')
        <a href="{{route('tax_category.all-tax-categories')}}" class="dashboard @if(\Request::is('admin/tax_category/all*')) active @endif">
            Tax Categories
        </a>
        @endrole--}}


        @role('super.admin')
        <a href="{{route('contact.contact-request')}}" class="dashboard @if(\Request::is('admin/contact')) active @endif">
            Contact Request
        </a>
        @endrole


        @role('super.admin')
        <a href="{{route('admin.settings')}}" class="dashboard @if(\Request::is('admin/settings')) active @endif">
            Settings
        </a>
        <a href="{{route('admin.home-page-settings')}}" class="dashboard @if(\Request::is('admin/settings')) active @endif">
            Home Page Settings
        </a>
        @endrole
        @role('super.admin')
        <a href="{{url('admin/requests')}}" class="dashboard @if(\Request::is('admin/requests')) active @endif">
            Request
        </a>
        @endrole
        @if(isset(Auth::user()->id))
            <a href="{{url('admin/changePassword/'.Auth::user()->id)}}" id="{{Auth::user()->id}}"
               class="change-pass @if(\Request::is('admin/changePassword/'.Auth::user()->id)) active @endif">
                Change Password
            </a>
        @endif
    </div>
</div>
