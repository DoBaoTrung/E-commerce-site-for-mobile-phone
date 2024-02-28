<div class="fixed-sidebar">
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin.home') }}" class="brand-link">
            <img src="{{ asset('img/shop_logo.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Administrator</span>
        </a>
        
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset(Storage::url(Auth::guard('admin')->user()->avatar)) }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ ucfirst(Auth::guard('admin')->name) }}</a>
                </div>
            </div>
    
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item menu">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Customers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link">
                                    <i class="far fa-user nav-icon"></i>
                                    <p>User</p> 
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item menu">
                        <a href="{{ route('admin.manufacturers.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Manufacturers</p>
                        </a>
                    </li>
                    <li class="nav-item menu">
                        <a href="{{ route('admin.products.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-item menu">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tag"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li class="nav-item menu">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-ruler"></i>
                            <p>Sizes</p>
                        </a>
                    </li>
                    <li class="nav-item menu">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-paint-brush"></i>
                            <p>Colors</p>
                        </a>
                    </li>
                    <li class="nav-item menu">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Orders</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
