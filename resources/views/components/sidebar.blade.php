<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}" style="font-size: 18px">POS CUY</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}" style="font-size: 18px">PC</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link" style="font-size: 15px">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->roles == 'ADMIN')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.index') }}" style="font-size: 15px">
                        <i class="fas fa-user"></i><span>Pengguna</span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('product.index') }}" class="nav-link" style="font-size: 15px">
                    <i class="fas fa-cubes-stacked"></i><span>Produk</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('order.index') }}" class="nav-link" style="font-size: 15px">
                    <i class="fas fa-receipt"></i><span>Order</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
