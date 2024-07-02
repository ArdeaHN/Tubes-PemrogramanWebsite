<nav class="navbar-vertical navbar">
    <div class="vh-100" data-simplebar>
        <!-- Brand logo -->
        <a href="#" class="navbar-brand fw-bold fs-3">Zemilan</a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"> <i
                        class="nav-icon fe fe-home me-2"></i>Dasbor</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.user.index') }}"
                    class="nav-link {{ Request::routeIs('admin.user.index') ? 'active' : '' }}"> <i
                        class="nav-icon fe fe-users me-2"></i> Pengguna</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'category') || strpos(Route::currentRouteName(), 'product') ? 'active' : '' }}"
                    href="{{ route('admin.product.index') }}" data-bs-toggle="collapse" data-bs-target="#navProduct"><i
                        aria-expanded="false" aria-controls="navProduct" class="nav-icon fe fe-box me-2"></i> Manajemen
                    Produk</a>
                <div class="collapse" id="navProduct" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}"
                                class="nav-link {{ Request::routeIs('admin.product.index') ? 'active' : 'collapsed' }}">
                                Produk</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category') }}"
                                class="nav-link {{ Request::routeIs('admin.category') ? 'active' : '' }} ">Kategori</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('coupon.index') }}"
                    class="nav-link {{ Request::routeIs('coupon.index') ? 'active' : '' }}"> <i
                        class="nav-icon fe fe-gift me-2"></i>Manajemen Kupon</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link "> <i class="nav-icon fe fe-database me-2"></i>Manajemen Pesanan</a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link "> <i class="nav-icon fe fe-pocket me-2"></i> Laporan Keuangan</a>
            </li>
        </ul>
    </div>
</nav>
