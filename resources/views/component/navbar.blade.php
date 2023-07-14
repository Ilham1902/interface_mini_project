<nav class="sb-topnav navbar navbar-expand navbar-dark text-light" style="background-color: #4169E1">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ url('index.html') }}" style="font-family:sans-serif">INDI
        TECHNOLOGY</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-light" id="sidebarToggle"
        href="{{ url('#!') }}"><i class="fas fa-bars"></i></button>

    @if ($title == 'Orders' && empty($child_title))
        {{-- <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <span class="input-group-text" id="search"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control" id="cari" placeholder="Cari" aria-describedby="search"
                    style="height: unset !important;">
            </div>
        </div> --}}
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <a href="{{ route('cart') }}" class="text-light float-end mt-2 me-3"><i
                    class="fa-solid fa-cart-shopping fs-3"></i><span
                    class="position-absolute translate-middle badge rounded-pill bg-danger">{{ $count_item }}</span></a>
        </div>
    @endif
</nav>
