
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
            </ul>
        </li>
    @endif

    @if(Auth::user()->permission('consignments.list') || Auth::user()->permission('consignments.create'))
        <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/consignments/*') ? 'active' : '' }} " href="javascript:void(0)" aria-expanded="false">
            <i class="mdi mdi-border-all"></i>
            <span class="hide-menu">Job / Consignment</span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/consignments/*') ? 'in' : '' }}">
                
                @if(Auth::user()->permission('consignments.create'))
                <li><a class="{{ request()->is('admin/consignments/create') ? 'active' : ''}}"  
                    href="{{URL::to('admin/consignments/create/edit')}}">Create Consignment</a>
                </li>
                @endif

                @if(Auth::user()->permission('consignments.list'))
                <li><a 
                    class="{{ request()->is('admin/consignments/*') && request()->is('admin/consignments/create') == false  ? 'active' : '' }}" 
                    href="{{URL::to('admin/consignments')}}">View Consignments</a>
                </li>
                @endif
            </ul>
        </li>
    @endif

    @if(Auth::user()->permission('payorders.list'))
        <li><a class="waves-effect waves-dark {{ request()->is('admin/payorders/*') ? 'active' : '' }}" href="{{URL::to('admin/payorders')}}" aria-expanded="false">
            <i class="mdi mdi-border-all"></i>
            <span class="hide-menu">Payorders</span>
          </a>
        </li>
    @endif

    @if(Auth::user()->permission('delivery-challans.list') || Auth::user()->permission('delivery-challans.create'))<li><a class="waves-effect waves-dark {{ request()->is('admin/delivery-challans/*') ? 'active' : '' }} " href="{{URL::to('admin/delivery-challans')}}" aria-expanded="false"><i class="mdi mdi-border-all"></i><span class="hide-menu">Delivery Challans</span></a></li>
    @endif


    @if(Auth::user()->permission('delivery-intimation.list'))
    <li><a class="waves-effect waves-dark {{ request()->is('admin/delivery-intimations/*') ? 'active' : '' }}" href="{{URL::to('admin/delivery-intimations')}}" aria-expanded="false">
        <i class="mdi mdi-border-all"></i>
        <span class="hide-menu">Delivery Intimation</span></a>
     </li>
    @endif

    @if(Auth::user()->permission('reports.customerstatement'))
    <li><a class="waves-effect waves-dark {{ request()->is('admin/customerstatement') ? 'active' : '' }}" href="{{URL::to('admin/customerstatement')}}" aria-expanded="false">
        <i class="mdi mdi-border-all"></i>
        <span class="hide-menu">Customer Statement</span></a>
    </li>
    @endif

    @if(Auth::user()->permission('reports.jobtracking'))
    <li><a class="waves-effect waves-dark {{ request()->is('admin/jobtracking') ? 'active' : '' }}" href="{{URL::to('admin/jobtracking')}}" aria-expanded="false">
        <i class="mdi mdi-border-all"></i>
        <span class="hide-menu">Job Tracking</span></a>
     </li>
    @endif
    
    @if(Auth::user()->permission('reports.jobstatus'))
     <li><a class="waves-effect waves-dark {{ request()->is('admin/jobstatus') ? 'active' : '' }}" href="{{URL::to('admin/jobstatus')}}" aria-expanded="false">
        <i class="mdi mdi-border-all"></i>
        <span class="hide-menu">Job Status</span></a>
     </li>
    @endif

    @if(Auth::user()->permission('masters.menu'))
        <li><a class="has-arrow waves-effect waves-dark {{ request()->is('admin/masters*') ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="false">
            <i class="mdi mdi-border-all"></i>
            <span class="hide-menu">Masters</span></a>
            <ul aria-expanded="false" class="collapse {{ request()->is('admin/masters/*') ? 'in' : '' }}">

                @if(Auth::user()->permission('masters.account'))
                 <li><a href="{{URL::to('admin/masters/account')}}">Account</a></li>  
                @endif

                @if(Auth::user()->permission('masters.favor'))
                 <li><a href="{{URL::to('admin/masters/favor')}}">Favor</a></li>  
                @endif

          

                @if(Auth::user()->permission('masters.locations'))
                 <li><a href="{{URL::to('admin/masters/locations')}}">Locations</a></li>  
                @endif

                @if(Auth::user()->permission('masters.pol'))
                <li><a href="{{URL::to('admin/masters/pol')}}">POL</a></li>  
               @endif

               @if(Auth::user()->permission('masters.pod'))
               <li><a href="{{URL::to('admin/masters/pod')}}">POD</a></li>  
              @endif

              @if(Auth::user()->permission('masters.vessels'))
               {{-- <li><a href="{{URL::to('admin/masters/vessels')}}">Vessels</a></li>   --}}
              @endif

              @if(Auth::user()->permission('masters.documents'))
               <li><a href="{{URL::to('admin/masters/documents')}}">Documents</a></li>  
              @endif

            </ul>
        </li>
    @endif
    
    @if(Auth::user()->permission('settings.menu'))
        <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class="ti-settings"></i>
            <span class="hide-menu">Settings</span></a>
            <ul aria-expanded="false" class="collapse">
                @if(Auth::user()->permission('settings.general'))
                <li><a href="{{URL::to('admin/settings/edit')}}?group=general_settings">General Settings</a>
                </li>  
                @endif
                
                @if(Auth::user()->permission('settings.theme'))
                  <li>
                    <a href="{{URL::to('admin/settings/edit')}}?group=theme_settings">Theme Settings</a>
                  </li>  
                @endif
            </ul>
        </li>
    @endif

<li><a class=" waves-effect waves-dark" href="{{URL::to('/admin/logout')}}" 
    aria-expanded="false"><i class="icon-speedometer"></i>
    <span class="hide-menu">Logout</span></a>
</li>