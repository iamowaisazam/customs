
<li><a class="bg-green waves-effect waves-dark" href="{{URL::to('admin/dashboard')}}" 
    aria-expanded="false"><i class="icon-speedometer"></i>
    <span class="hide-menu">Dashboard</span></a>
</li>


    @if(Auth::user()->permission('usermanagment'))
        <li> <a class="has-arrow waves-effect waves-dark {{ request()->is('admin/users/*') ? 'active' : '' }} {{ request()->is('admin/roles/*') ? 'active' : '' }}  " href="javascript:void(0)" aria-expanded="false">
            <i class="icon-user"></i>
            <span class="hide-menu"> Users Management </span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/users/*') ? 'in' : '' }} {{ request()->is('admin/roles/*') ? 'in' : '' }} ">
                <li><a class="{{ request()->is('admin/users/*') ? 'active' : ''}}"  href="{{URL::to('admin/users/index')}}">All Users</a></li>
                <li><a class="{{ request()->is('admin/roles/*') ? 'active' : '' }}" href="{{URL::to('admin/roles/index')}}">All Roles</a></li>
            </ul>
        </li>
    @endif

    @if(Auth::user()->permission('customers'))
        <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/customers/*') ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
            <i class="mdi mdi-border-all"></i>
            <span class="hide-menu"> Customers</span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/customers/*') ? 'in' : '' }}">
                <li><a class="{{ request()->is('admin/customers/create') ? 'active' : ''}}"  
                    href="{{URL::to('admin/customers/create')}}">Create New Customer</a></li>
                <li><a 
                    class="{{ request()->is('admin/customers/*') && request()->is('admin/customers/create') == false  ? 'active' : '' }}" 
                    href="{{URL::to('admin/customers')}}">View Customers</a>
                </li>
                <li><a href="#" >View Customers Statements</a></li>
            </ul>
        </li>
    @endif

    @if(Auth::user()->permission('vendors'))
        <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/vendors/*') ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
            <i class="mdi mdi-border-all"></i>
            <span class="hide-menu">Vendors</span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/vendors/*') ? 'in' : '' }}">
                <li><a class="{{ request()->is('admin/vendors/create') ? 'active' : ''}}"  
                    href="{{URL::to('admin/vendors/create')}}">Create New Vendor</a>
                </li>
                <li><a 
                    class="{{ request()->is('admin/vendors/*') && request()->is('admin/vendors/create') == false  ? 'active' : '' }}" 
                    href="{{URL::to('admin/vendors')}}">View Vendor</a>
                </li>
            </ul>
        </li>
    @endif
    
    @if(Auth::user()->permission('job/consignment'))
        <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/consignments/*') ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
            <i class="mdi mdi-border-all"></i>
            <span class="hide-menu">Job / Consignment</span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/consignments/*') ? 'in' : '' }}">
                <li><a class="{{ request()->is('admin/consignments/create') ? 'active' : ''}}"  
                    href="{{URL::to('admin/consignments/create')}}">Create Consignment</a>
                </li>
                <li><a 
                    class="{{ request()->is('admin/consignments/*') && request()->is('admin/consignments/create') == false  ? 'active' : '' }}" 
                    href="{{URL::to('admin/consignments')}}">View Consignments</a>
                </li>
            </ul>
        </li>
    @endif

    {{-- <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Payment Request </span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="app-calendar.html">Create Payment Request</a></li>
            <li><a href="app-calendar.html">View Payment Request</a></li>
            
        </ul>
    </li>

    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Delivery Challan</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="app-calendar.html">Create Delivery Challan</a></li>
            <li><a href="app-calendar.html">View Delivery Challan</a></li>
            
        </ul>
    </li>

    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Jobs Tracking And status</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="app-calendar.html">View Jobs Tracking And status</a></li>
            
        </ul>
    </li>

    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">job History</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="app-calendar.html">View Job History</a></li>
            
        </ul>
    </li>
    
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Accounts &amp; Finance </span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="app-calendar.html">View Accounts &amp; Finance </a></li>
            
        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Reports </span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="app-calendar.html">View Customer Reports </a></li>
            <li><a href="app-calendar.html">View Jobs Reports </a></li>
            <li><a href="app-calendar.html">View Vendors Reports </a></li>
            <li><a href="app-calendar.html">View Consignment Reports </a></li>
            <li><a href="app-calendar.html">View payments Reports </a></li>
            <li><a href="app-calendar.html">View Delivery challan Reports </a></li>
            
        </ul>
    </li>
  
 
   
    --}}
   
   
   


{{-- <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-google-pages"></i>
    <span class="hide-menu"> Pages </span></a>    
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/page/create')}}">Add New pages</a></li>
        <li><a href="{{URL::to('admin/page/index')}}">All pages</a></li>
    </ul>
</li> --}}

{{-- <li class="perent_Product">
    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
        <i class="mdi mdi-border-all"></i>
        <span class="hide-menu">Inventory</span>
    </a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/collections/index')}}" class="collection-link-tag">All Collection</a></li>
        <li><a href="{{URL::to('admin/categories/index')}}" class="category-link-tag">All Category</a></li>
        <li><a href="{{URL::to('admin/products/index')}}" class="product-link-tag">All Products</a></li>
        <li><a href="{{URL::to('admin/variations/index')}}" class="variation-link-tag">All Variations</a></li>
    </ul>
</li> --}}

{{-- <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
    <i class="ti-money"></i>
    <span class="hide-menu">Sales</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/orders/index')}}">All Orders</a></li>
        <li><a href="{{URL::to('admin/payment/index')}}">Payment Methods</a></li>
    </ul>
</li> --}}

{{-- <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-folder-multiple-outline"></i>
    <span class="hide-menu"> Filemanager </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/filemanager/create')}}">Add New File</a></li>
        <li><a href="{{URL::to('admin/filemanager')}}">All Files</a></li>
    </ul>
</li> --}}

{{-- <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
    <i class="mdi mdi-monitor"></i>
    <span class="hide-menu"> Report </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/reports/clients/index')}}">Customer</a></li>
        <li><a href="{{URL::to('admin/reports/product/index')}}">Product</a></li>
        <li><a href="{{URL::to('admin/reports/inventory/index')}}">Inventory</a></li>
    </ul>
</li> --}}


{{-- <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
    <i class="mdi mdi-monitor"></i>
    <span class="hide-menu"> Customization </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/menus/index')}}">Menus</a></li>
        <li><a href="{{URL::to('admin/sliders/index')}}">Sliders</a></li>
        <li><a href="{{URL::to('admin/newsletter/index')}}">Newsletter</a></li>
    </ul>
</li> --}}

<li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
    <i class="ti-settings"></i>
    <span class="hide-menu">Settings</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/settings/edit')}}?group=general_settings">General Settings</a>
        </li>  
        <li><a href="{{URL::to('admin/settings/edit')}}?group=theme_settings">Theme Settings</a>
        </li>  
    </ul>
</li>

<li><a class=" waves-effect waves-dark" href="{{URL::to('/admin/logout')}}" 
    aria-expanded="false"><i class="icon-speedometer"></i>
    <span class="hide-menu">Logout</span></a>
</li>