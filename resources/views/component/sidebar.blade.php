<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link <?= $title == 'Dashboard' ? 'active' : '' ?>" href="{{ url('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Orders</div>
                <a class="nav-link <?= $title == 'Orders' ? 'active' : '' ?>" href="{{ url('orders') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                    Orders
                </a>
                <a class="nav-link <?= $title == 'List Orders' ? 'active' : '' ?>" href="{{ url('list_orders') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list-check"></i></div>
                    List Orders
                </a>
                <div class="sb-sidenav-menu-heading">Management</div>
                <a class="nav-link <?= $title == 'Custommers' ? 'active' : '' ?>" href="{{ url('custommers') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Custommers
                </a>
                <a class="nav-link <?= $title == 'Inventory' ? 'active' : '' ?>" href="{{ url('inventory') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                    Inventory
                </a>
            </div>
        </div>
    </nav>
</div>
