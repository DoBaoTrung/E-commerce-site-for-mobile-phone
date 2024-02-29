@include('client.auth.login')
<nav class="navbar navbar-expand-lg navbar-light bg-secondary position-fixed fixed-top"
    style="box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, 0.07);">
    <div class="container">
        <div class="col-lg-4">
            <a class="navbar-brand fs-3 text-white" href="{{ route('client.home') }}">Verina</a>
        </div>
        <div class="col-lg-4">
            <form>
                <div class="input-group">
                    <input type="search" name="search-product" id="search-product" class="form-control"
                        placeholder="Tìm kiếm">
                    <button class="btn btn-danger"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> --}}
        <div class="authentication col-lg-3 d-flex justify-content-end">
            @if (Auth::check())
                <div class="check-order">
                    <a href="{{ route('client.order.checkoutOrder') }}" class="text-white text-decoration-none">
                        <i class="fas fa-truck"></i>
                        <span class="mx-2">Kiểm tra đơn hàng</span>
                    </a>
                </div>
                <div class="user-cart">
                    <a href="{{ route('client.cart') }}">
                        <i class="fas fa-shopping-cart text-white mx-3"></i>
                    </a>
                </div>
                <ul class="user-loginned user-nav m-0">
                    <li id="user-name-header" class="text-white">{{ Auth::user()->full_name }}</li>
                    <ul class="user-subnav list-unstyled bg-white" style="padding: 8px 16px;">
                        <li><a class="text-decoration-none" href="{{ route('client.order.index') }}">Đơn hàng của bạn</a></li>
                        <li>Profile</li>
                        <li><a class="text-decoration-none" href="{{ route('client.logout') }}">Logout</a></li>
                    </ul>
                </ul>
            @else
                <a type="button" class="user-no-login text-white text-decoration-none me-3" data-bs-toggle="modal"
                    data-bs-target="#login-modal">Đăng nhập</a>
                <a class="user-no-login text-white text-decoration-none" href="{{ route('client.register') }}">Đăng ký</a>
            @endif

            {{-- <ul class="user-loginned user-nav m-0" style="display: none;">
                <li id="user-name-header" class="text-white">sssasd</li>
                <ul class="user-subnav list-unstyled bg-white" style="padding: 8px 16px;">
                    <li>Profile</li>
                    <li><a class="text-dark text-decoration-none" href="{{ route('client.logout') }}">Logout</a></li>
                </ul>
            </ul>
            <a type="button" class="user-no-login text-white text-decoration-none me-3" data-bs-toggle="modal"
                data-bs-target="#login-modal">Đăng nhập</a>
            <a class="user-no-login text-white text-decoration-none" href="{{ route('client.register') }}">Đăng ký</a> --}}
        </div>
    </div>
</nav>
