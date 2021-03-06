<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            JUNGE SHOP
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggel navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- Left Side Of Navbar --}}
            <ul class="navbar-nav mr-auto">

            </ul>

            {{-- 登录注册开始 --}}
            {{-- Right Side Of Navbar --}}
            <ul class="navbar-nav navbar-right">
                {{-- Authentication Links --}}
                @guest
                    <li class="nav-item"><a href="{{ route('login')}}" class="nav-link">登录</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">注册</a></li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link mt-1"><i class="fa fa-shopping-cart"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://cdn.learnku.com/uploads/avatars/30140_1555818602.jpg!/both/380x380" class="img-responsive img-circle" width="30px" height="30px">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="{{ route('user_addresses.index') }}" class="dropdown-item">收货地址</a>
                            <a href="{{ route('orders.index') }}" class="dropdown-item">我的订单</a>
                            <a href="{{ route('products.favorites') }}" class="dropdown-item">我的收藏</a>
                            <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="#" class="dropdown-item">退出</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            {{-- 登录注册结束 --}}
        </div>
    </div>
</nav>