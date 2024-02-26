<div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
        <ul>
            <li class="active">
                <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('admin/assets/img/icons/dashboard.svg') }}"
                        alt="img" /><span> Dashboard</span>
                </a>
            </li>
            <li class="submenu">
                <a href=""><img src="{{ asset('admin/assets/img/icons/product.svg') }}" alt="img" /><span>
                        Product</span>
                    <span class="menu-arrow"></span></a>
                <ul>
                    <li>
                        <a href="{{route('admin.products')}}">Product List</a>
                    </li>
                    <li>
                        <a href="{{route('admin.product.add')}}">Add Product</a>
                    </li>
                    <li>
                        <a href="{{route('admin.categories')}}">Category List</a>
                    </li>
                    <li>
                        <a href="{{route('admin.category.add')}}">Add Category</a>
                    </li>
                    <li>
                        <a href="{{route('admin.subcategories')}}">Sub Category List</a>
                    </li>
                    <li>
                        <a href="{{route('admin.subcategory.add')}}">Add Sub Category</a>
                    </li>
                    <li>
                        <a href="{{route('admin.brands')}}">Brand List</a>
                    </li>
                    <li>
                        <a href="{{route('admin.brand.add')}}">Add Brand</a>
                    </li>
                </ul>
            </li>
            <li class="submenu">
                <a href="javascript:void(0);"><img src="{{ asset('admin/assets/img/icons/sales1.svg') }}"
                        alt="img" /><span> Sales</span>
                    <span class="menu-arrow"></span></a>
                <ul>
                    <li>
                        <a href="saleslist.html">Orders List</a>
                    </li>
                    <li><a href="pos.html">All Orders</a></li>
                    <li>
                        <a href="salesreturnlists.html">Completed Order List</a>
                    </li>
                    <li>
                        <a href="createsalesreturns.html">Returned Order List</a>
                    </li>
                </ul>
            </li>

            <li class="submenu">
                <a href="javascript:void(0);"><img src="{{ asset('admin/assets/img/icons/time.svg') }}"
                        alt="img" /><span> Report</span>
                    <span class="menu-arrow"></span></a>
                <ul>
                    <li>
                        <a href="purchaseorderreport.html">Purchase order report</a>
                    </li>
                    <li>
                        <a href="inventoryreport.html">Inventory Report</a>
                    </li>
                    <li>
                        <a href="salesreport.html">Sales Report</a>
                    </li>
                </ul>
            </li>
            @if (Auth::guard('admin')->user()->role === 'super_admin')
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('admin/assets/img/icons/users1.svg') }}"
                            alt="img" /><span> Users</span>
                        <span class="menu-arrow"></span></a>
                    <ul>
                        <li>
                            <a href="{{route('admin.user.add')}}">New User </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users') }}">Users List</a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="submenu">
                <a href="javascript:void(0);"><img src="{{ asset('admin/assets/img/icons/settings.svg') }}"
                        alt="img" /><span> Settings</span>
                    <span class="menu-arrow"></span></a>
                <ul>
                    <li>
                        <a href="generalsettings.html">General Settings</a>
                    </li>
                    <li>
                        <a href="emailsettings.html">Email Settings</a>
                    </li>
                    <li>
                        <a href="paymentsettings.html">Payment Settings</a>
                    </li>
                    <li>
                        <a href="currencysettings.html">Currency Settings</a>
                    </li>
                    <li>
                        <a href="grouppermissions.html">Group Permissions</a>
                    </li>
                    <li>
                        <a href="taxrates.html">Tax Rates</a>
                    </li>
                </ul>
            </li>
            <hr>
            <li>
                <a class="btn btn-primary text-white" href="{{ route('home.index') }}"><img src="{{ asset('admin/assets/img/icons/time.svg') }}"
                        alt="img" /><span class="text-white"> Visit Ecom Client</span>
                </a>
            </li>
        </ul>
    </div>
</div>
