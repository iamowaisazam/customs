
<li><a class=" waves-effect waves-dark" href="{{URL::to('admin/dashboard')}}" 
    aria-expanded="false"><i class="icon-speedometer"></i>
    <span class="hide-menu">Dashboard</span></a>
</li>

<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
    <i class="icon-user"></i>
    <span class="hide-menu"> Users </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/users/index')}}">All Users</a></li>
        <li><a href="{{URL::to('admin/roles/index')}}">All Roles</a></li>
    </ul>
</li>

<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-google-pages"></i>
    <span class="hide-menu"> Pages </span></a>    
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/page/create')}}">Add New pages</a></li>
        <li><a href="{{URL::to('admin/page/index')}}">All pages</a></li>
    </ul>
</li>

<li class="perent_Product">
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
</li>

<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
    <i class="ti-money"></i>
    <span class="hide-menu">Sales</span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/orders/index')}}">All Orders</a></li>
        <li><a href="{{URL::to('admin/payment/index')}}">Payment Methods</a></li>
    </ul>
</li>

<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-folder-multiple-outline"></i>
    <span class="hide-menu"> Filemanager </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/filemanager/create')}}">Add New File</a></li>
        <li><a href="{{URL::to('admin/filemanager')}}">All Files</a></li>
    </ul>
</li>

<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
    <i class="mdi mdi-monitor"></i>
    <span class="hide-menu"> Report </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/reports/clients/index')}}">Customer</a></li>
        <li><a href="{{URL::to('admin/reports/product/index')}}">Product</a></li>
        <li><a href="{{URL::to('admin/reports/inventory/index')}}">Inventory</a></li>
    </ul>
</li>


<li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
    <i class="mdi mdi-monitor"></i>
    <span class="hide-menu"> Customization </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{URL::to('admin/menus/index')}}">Menus</a></li>
        <li><a href="{{URL::to('admin/sliders/index')}}">Sliders</a></li>
        <li><a href="{{URL::to('admin/newsletter/index')}}">Newsletter</a></li>
    </ul>
</li>

<li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
    <i class="ti-settings"></i>
    <span class="hide-menu">Settings</span></a>
    <ul aria-expanded="false" class="collapse">
       @foreach (explode(',',$_s['grouping']) as $item)
        <li><a href="{{URL::to('admin/settings/edit')}}?group={{$item}}">
          {{ ucwords(str_ireplace("_", " ",$item))}}</a></li>  
       @endforeach
    </ul>
</li>

<li><a class=" waves-effect waves-dark" href="{{URL::to('/admin/logout')}}" 
    aria-expanded="false"><i class="icon-speedometer"></i>
    <span class="hide-menu">Logout</span></a>
</li>