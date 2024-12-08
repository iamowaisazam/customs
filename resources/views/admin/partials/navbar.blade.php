
    @if(Auth::user()->permission('users.dashboard'))
    <li><a class="bg-green waves-effect waves-dark" href="{{URL::to('admin/dashboard')}}" 
        aria-expanded="false"><i class="icon-speedometer"></i>
        <span class="hide-menu">Dashboard</span></a>
    </li>
    @endif

    @if(Auth::user()->permission('users.list') || Auth::user()->permission('users.create'))
        <li> <a class="has-arrow waves-effect waves-dark {{ request()->is('admin/users/*') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
            <i class="icon-user"></i>
            <span class="hide-menu"> Users Management </span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/users/*') ? 'in' : '' }}">
                
                @if(Auth::user()->permission('users.create'))
                <li><a class="{{ request()->is('admin/users/create') ? 'active' : ''}}"  
                    href="{{URL::to('admin/users/create')}}">Create New</a></li>
                @endif

                @if(Auth::user()->permission('users.list'))
                <li><a class="{{ request()->is('admin/users/*') && request()->is('admin/users/create') == false  ? 'active' : '' }} "
                    href="{{URL::to('admin/users/index')}}">View Users</a></li>
                @endif

            </ul>
        </li>
    @endif

    @if(Auth::user()->permission('roles.list') || Auth::user()->permission('roles.create'))
        <li> <a class="has-arrow waves-effect waves-dark {{ request()->is('admin/roles/*') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
            <i class="icon-user"></i>
            <span class="hide-menu"> Roles Management </span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/roles/*') ? 'in' : '' }} ">

                @if(Auth::user()->permission('roles.create'))
                <li><a class="{{ request()->is('admin/roles/create') ? 'active' : ''}}"  href="{{URL::to('admin/roles/create')}}">Create New</a></li>
                @endif

                @if(Auth::user()->permission('roles.list'))
                <li><a class="{{ request()->is('admin/roles/*') && request()->is('admin/roles/create') == false  ? 'active' : '' }}" href="{{URL::to('admin/roles/index')}}">View Roles</a></li>
                @endif

            </ul>
        </li>
    @endif
    
    
    @if(Auth::user()->permission('customers.list') || Auth::user()->permission('customers.create'))
        <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/customers/*') ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
            <i class="mdi mdi-border-all"></i>
            <span class="hide-menu"> Customers</span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/customers/*') ? 'in' : '' }}">
                @if(Auth::user()->permission('customers.create'))
                <li><a class="{{ request()->is('admin/customers/create') ? 'active' : ''}}"  
                    href="{{URL::to('admin/customers/create')}}">Create New Customer</a></li>
                @endif
                @if(Auth::user()->permission('customers.list'))
                <li><a 
                    class="{{ request()->is('admin/customers/*') && request()->is('admin/customers/create') == false  ? 'active' : '' }}" 
                    href="{{URL::to('admin/customers')}}">View Customers</a>
                </li>
                @endif
                @if(Auth::user()->permission('customers.statement'))
                <li><a href="{{URL::to('admin/customerstatement')}}" >View Customers Statements</a></li>
                @endif
            </ul>
        </li>
    @endif

    
    @if(Auth::user()->permission('vendors.list') || Auth::user()->permission('vendors.create'))
        <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/vendors/*') ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
            <i class="mdi mdi-border-all"></i>
            <span class="hide-menu">Vendors</span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/vendors/*') ? 'in' : '' }}">  
                @if(Auth::user()->permission('vendors.create')) 
                <li><a class="{{ request()->is('admin/vendors/create') ? 'active' : ''}}"  
                    href="{{URL::to('admin/vendors/create')}}">Create New Vendor</a>
                </li>
                @endif

                @if(Auth::user()->permission('vendors.list')) 
                <li><a 
                    class="{{ request()->is('admin/vendors/*') && request()->is('admin/vendors/create') == false  ? 'active' : '' }}" 
                    href="{{URL::to('admin/vendors')}}">View Vendor</a>
                </li>
                @endif
            </ul>
        </li>
    @endif
   

    @if(Auth::user()->permission('jobs-consignment.list') || Auth::user()->permission('jobs-consignment.create'))
        <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/consignments/*') ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
            <i class="mdi mdi-border-all"></i>
            <span class="hide-menu">Job / Consignment</span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/consignments/*') ? 'in' : '' }}">
                
                @if(Auth::user()->permission('jobs-consignment.create'))
                <li><a class="{{ request()->is('admin/consignments/create') ? 'active' : ''}}"  
                    href="{{URL::to('admin/consignments/create/edit')}}">Create Consignment</a>
                </li>
                @endif

                @if(Auth::user()->permission('jobs-consignment.list'))
                <li><a 
                    class="{{ request()->is('admin/consignments/*') && request()->is('admin/consignments/create') == false  ? 'active' : '' }}" 
                    href="{{URL::to('admin/consignments')}}">View Consignments</a>
                </li>
                @endif
            </ul>
        </li>
    @endif

    <li><a class="waves-effect waves-dark {{ request()->is('admin/payorders/*') ? 'active' : '' }}" href="{{URL::to('admin/payorders')}}" aria-expanded="false">
      <i class="mdi mdi-border-all"></i>
      <span class="hide-menu">Payorders</span></a>
    </li>

    @if(Auth::user()->permission('delivery-challans.list') || Auth::user()->permission('delivery-challans.create'))<li><a class="waves-effect waves-dark {{ request()->is('admin/delivery-challans/*') ? 'active' : '' }} " href="{{URL::to('admin/delivery-challans')}}" aria-expanded="false"><i class="mdi mdi-border-all"></i><span class="hide-menu">Delivery Challans</span></a></li>
    @endif


    @if(Auth::user()->permission('delivery-intimation.list'))
    <li><a class="waves-effect waves-dark {{ request()->is('admin/delivery-intimations/*') ? 'active' : '' }}" href="{{URL::to('admin/delivery-intimations')}}" aria-expanded="false">
        <i class="mdi mdi-border-all"></i>
        <span class="hide-menu">Delivery Intimation</span></a>
     </li>
    @endif

    {{-- @if(Auth::user()->permission('payorders.list')) --}}
   
    {{-- @endif --}}

    <li><a class="waves-effect waves-dark {{ request()->is('admin/jobtracking') ? 'active' : '' }}" href="{{URL::to('admin/jobtracking')}}" aria-expanded="false">
        <i class="mdi mdi-border-all"></i>
        <span class="hide-menu">Job Tracking</span></a>
     </li>

     <li><a class="waves-effect waves-dark {{ request()->is('admin/jobstatus') ? 'active' : '' }}" href="{{URL::to('admin/jobstatus')}}" aria-expanded="false">
        <i class="mdi mdi-border-all"></i>
        <span class="hide-menu">Job Status</span></a>
     </li>
    
    @if(Auth::user()->permission('settings.menu'))
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
    @endif

<li><a class=" waves-effect waves-dark" href="{{URL::to('/admin/logout')}}" 
    aria-expanded="false"><i class="icon-speedometer"></i>
    <span class="hide-menu">Logout</span></a>
</li>