<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'LaraShop') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            @auth
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
            @endauth
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/home" class="nav-link {{ set_active('home') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">TRANSACTIONS</li>
                <li class="nav-item">
                    <a href="{{ route('product-enter.index') }}" class="nav-link {{ set_active(['product-enter.index','product-enter.edit']) }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Barang Masuk</p>
                    </a>
                </li>
                <li class="nav-header">DATA MASTER</li>
                {{-- <li class="nav-item">
                    <a href="{{ route('products.create') }}" class="nav-link {{ set_active('products.create') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Upload Product</p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link {{ set_active(['products.index','products.edit']) }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Daftar Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ set_active('categories*') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('partners.index') }}" class="nav-link {{ set_active('partners*') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Partners</p>
                    </a>
                </li>
                @role('super-admin|admin')
                <li class="nav-header">USERS</li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ set_active('users*') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Users</p>
                    </a>
                </li>
                @endrole
                @hasrole('super-admin')
                <li class="nav-item {{ set_open(['roles*','permissions*','assign*']) }}">
                    <a href="#" class="nav-link {{ set_active(['roles*','permissions*','assign*']) }}">
                        <i class="nav-icon fas fa-tachometer-alt "></i>
                        <p>
                            Roles & Permissions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link {{ set_active('roles*') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link {{ set_active('permissions*')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('assign.index') }}" class="nav-link {{ set_active('assign*')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Assign Permissions</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endhasrole
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
